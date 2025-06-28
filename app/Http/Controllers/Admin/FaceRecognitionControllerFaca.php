<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FaceRecognitionControllerFaca extends Controller
{
    // Halaman untuk upload foto dan memilih mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return view('user.absen.pages.absen-wajah', compact('mahasiswas'));
    }
    public function daftar()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return view('user.absen.pages.daftar-wajah', compact('mahasiswas'));
    }

    public function hasilAbsen()
    {
        $results = Session::get('face_results', []);

        if (empty($results)) {
            return redirect()->route('upload.wajah')->with('error', '⚠️ Tidak ada hasil yang ditemukan.');
        }

        return view('user.absen.pages.hasil-absen', compact('results'));
    }

    // Simpan face_token setelah upload foto
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswas_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|image|max:2048',
        ]);

        try {
            // Konversi foto ke base64
            $base64 = base64_encode(file_get_contents($request->file('foto')));

            // Panggil API Face++ untuk mendeteksi wajah
            $client = new Client();
            $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
                'form_params' => [
                    'api_key' => env('FACE_API_KEY'),
                    'api_secret' => env('FACE_API_SECRET'),
                    'image_base64' => $base64,
                ]
            ]);

            $data = json_decode($res->getBody(), true);
            $faceToken = $data['faces'][0]['face_token'] ?? null;

            if (!$faceToken) {
                return back()->with('error', '❌ Wajah tidak terdeteksi. Gunakan foto yang jelas.');
            }

            // Simpan face_token ke mahasiswa
            $mhs = Mahasiswa::find($request->mahasiswas_id);
            $mhs->face_token = $faceToken;
            $mhs->save();

            return back()->with('success', "✅ Face token tersimpan untuk {$mhs->mhs_name}.");
        } catch (\Exception $e) {
            return back()->with('error', '⚠️ Gagal menghubungi Face++: ' . $e->getMessage());
        }
    }

    // Cek wajah dari foto yang di-upload dan bandingkan dengan mahasiswa lain
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        try {
            $foto = $request->file('foto');
            $fotoContents = file_get_contents($foto->getRealPath());
            $base64 = base64_encode($fotoContents);

            // Simpan foto untuk digunakan nanti dalam absensi
            $fotoName = 'face_recognition_' . time() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'presensi/' . $fotoName;
            $destinationPath = storage_path('app/public/images/presensi');
            
            // Pastikan direktori ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Kompres dan simpan gambar
            $manager = new ImageManager(new Driver());
            $image = $manager->read($foto->getRealPath());
            $image->scaleDown(height: 300)->save($destinationPath . '/' . $fotoName);

            $client = new Client();
            $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
                'form_params' => [
                    'api_key' => env('FACE_API_KEY'),
                    'api_secret' => env('FACE_API_SECRET'),
                    'image_base64' => $base64,
                ],
                'timeout' => 10,
            ]);

            $data = json_decode($res->getBody(), true);
            $inputToken = $data['faces'][0]['face_token'] ?? null;

            if (!$inputToken) {
                return back()->with('error', '❌ Wajah tidak terdeteksi. Pastikan wajah terlihat jelas.');
            }

            $users = Mahasiswa::whereNotNull('face_token')->get();
            $highestSimilarity = 0;
            $bestMatch = null;

            foreach ($users as $user) {
                $comparisonResult = $this->compareFaces($user, $inputToken);

                if ($comparisonResult['similarity'] > $highestSimilarity) {
                    $highestSimilarity = $comparisonResult['similarity'];
                    $bestMatch = [
                        'mahasiswa' => $user->mhs_name,
                        'similarity' => $comparisonResult['similarity'],
                        'status' => $comparisonResult['status'],
                    ];
                }
            }

            // Simpan hanya 1 data ke session
            $now = Carbon::now();
            $hariIni = $now->dayOfWeekIso; // Senin = 1, Minggu = 7
            $waktuDatang = $now->format('H:i:s');
            $userId = $bestMatch['mahasiswa'] ?? null;
            $jadwalHariIni = null;
            $mahasiswaData = null;

            if ($userId) {
                // Cari data mahasiswa berdasarkan nama
                $mahasiswaData = Mahasiswa::where('mhs_name', $userId)->first();
                if ($mahasiswaData) {
                    // Tambahkan data mahasiswa ke hasil pengenalan wajah
                    $bestMatch['mahasiswa_data'] = [
                        'id' => $mahasiswaData->id,
                        'nim' => $mahasiswaData->mhs_nim,
                        'name' => $mahasiswaData->mhs_name,
                        'kelas' => $mahasiswaData->kelas->count() > 0 ? $mahasiswaData->kelas->pluck('name')->implode(', ') : 'Tidak ada kelas',
                        'program_studi' => $mahasiswaData->kelas->count() > 0 && $mahasiswaData->kelas->first()->pstudi ? $mahasiswaData->kelas->first()->pstudi->name : 'Tidak ada prodi',
                        'status' => $mahasiswaData->mhs_stat
                    ];

                    // Cari jadwal kuliah hari ini untuk kelas mahasiswa
                    // Ambil kelas pertama yang terkait dengan mahasiswa
                    $kelas = $mahasiswaData->kelas()->first();
                    $kelasId = $kelas ? $kelas->id : null;

                    $jadwalHariIni = null;
                    if ($kelasId) {
                        $jadwalHariIni = JadwalKuliah::where('kelas_id', $kelasId)
                            ->where('days_id', $hariIni)
                            ->where('start', '<=', $waktuDatang)
                            ->where('ended', '>=', $waktuDatang)
                            ->first();
                    }
                }
            }

            // Simpan path foto ke session untuk digunakan saat menyimpan absensi
            Session::put('face_image_path', $fotoPath);
            Session::put('face_results', [$bestMatch]);
            Session::put('jadwal_hari_ini', $jadwalHariIni);

            return redirect()->route('absen.face-results');
        } catch (\Exception $e) {
            return back()->with('error', '⚠️ Gagal memproses wajah: ' . $e->getMessage());
        }
    }

    // Fungsi untuk membandingkan wajah
    private function compareFaces($user, $inputToken)
    {
        try {
            $client = new Client();
            $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/compare', [
                'form_params' => [
                    'api_key' => env('FACE_API_KEY'),
                    'api_secret' => env('FACE_API_SECRET'),
                    'face_token1' => $user->face_token,
                    'face_token2' => $inputToken,
                ]
            ]);

            $data = json_decode($res->getBody(), true);
            $similarity = $data['confidence'] ?? 0;

            return [
                'similarity' => $similarity,
                'status' => $similarity >= 80 ? '✅ Cocok' : '❌ Tidak Cocok',
            ];
        } catch (\Exception $e) {
            // Handle error for comparison
            return [
                'similarity' => 0,
                'status' => '⚠️ Error membandingkan wajah',
            ];
        }
    }
}
