<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FaceRecognitionController extends Controller
{
    // Halaman untuk upload foto dan memilih mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return view('user.officer.pages.absen-wajah', compact('mahasiswas'));
    }
    public function daftar()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return view('user.officer.pages.daftar-wajah', compact('mahasiswas'));
    }

    public function hasilAbsen()
    {
        $results = Session::get('face_results', []);

        if (empty($results)) {
            return redirect()->route('upload.wajah')->with('error', '⚠️ Tidak ada hasil yang ditemukan.');
        }

        return view('user.officer.pages.hasil-absen', compact('results'));
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
            $foto = file_get_contents($request->file('foto'));
            $base64 = base64_encode($foto);

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
            $today = now()->format('Y-m-d');
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
                        'kelas' => $mahasiswaData->kelas ? $mahasiswaData->kelas->name : 'Tidak ada kelas',
                        'program_studi' => $mahasiswaData->kelas && $mahasiswaData->kelas->pstudi ? $mahasiswaData->kelas->pstudi->name : 'Tidak ada prodi',
                        'status' => $mahasiswaData->mhs_stat
                    ];

                    // Cari jadwal kuliah hari ini untuk kelas mahasiswa
                    $jadwalHariIni = JadwalKuliah::where('kelas_id', $mahasiswaData->class_id)
                        ->where('date', $today)
                        ->first();
                }
            }

            Session::put('face_results', [$bestMatch]);

            Session::put('jadwal_hari_ini', $jadwalHariIni);

            return redirect()->route('officer.face-results');
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
