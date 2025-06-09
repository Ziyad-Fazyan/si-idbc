<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;

class FaceRecognitionController extends Controller
{
    protected $faceApiUrl;
    protected $faceApiKey;

    public function __construct()
    {
        $this->faceApiUrl = rtrim(env('FACE_API_URL'), '/') . '/';
        $this->faceApiKey = env('FACE_API_KEY');
        
        if (empty($this->faceApiKey)) {
            throw new \RuntimeException('FACE_API_KEY is not configured');
        }
    }

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
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $mhs = Mahasiswa::findOrFail($request->mahasiswas_id);
            
            // Persiapkan file untuk dikirim
            $fileStream = fopen($request->file('foto')->getRealPath(), 'r');
            
            try {
                $client = new Client([
                    'timeout' => 15,
                    'connect_timeout' => 10,
                ]);

                $response = $client->post($this->faceApiUrl . 'api/register', [
                    'headers' => [
                        'x-api-key' => $this->faceApiKey
                    ],
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $fileStream,
                            'filename' => $request->file('foto')->getClientOriginalName(),
                        ],
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                
                if (empty($data['face_token'])) {
                    throw new \Exception('Invalid response from face recognition API');
                }

                $mhs->face_token = $data['face_token'];
                $mhs->save();

                return back()->with('success', "✅ Wajah terdaftar untuk {$mhs->mhs_name}");
            } finally {
                if (is_resource($fileStream)) {
                    fclose($fileStream);
                }
            }
        } catch (\Exception $e) {
            Log::error('Face registration failed: ' . $e->getMessage());
            return back()->with('error', '⚠️ Gagal mendaftarkan wajah: ' . $e->getMessage());
        }
    }

    // Cek wajah dari foto yang di-upload
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Proses penyimpanan gambar
            $fotoName = 'face_recognition_' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $fotoPath = $this->simpanGambar($request->file('foto'), $fotoName);

            // Dapatkan semua mahasiswa yang sudah terdaftar
            $mahasiswas = Mahasiswa::whereNotNull('face_token')->with('kelas.pstudi')->get();

            $bestMatch = null;
            $highestSimilarity = 0.5; // Minimum threshold

            foreach ($mahasiswas as $mhs) {
                $verificationResult = $this->verifyFaceWithApi(
                    $request->file('foto')->getRealPath(),
                    $mhs->face_token,
                    $request->file('foto')->getClientOriginalName()
                );

                if ($verificationResult['matched'] && $verificationResult['similarity'] > $highestSimilarity) {
                    $highestSimilarity = $verificationResult['similarity'];
                    $bestMatch = $this->prepareMatchData($mhs, $verificationResult['similarity']);
                }
            }

            if (!$bestMatch) {
                return back()->with('error', '❌ Tidak ada mahasiswa dengan wajah yang cocok (similarity > 0.5)');
            }

            // Cek jadwal kuliah
            $jadwalHariIni = $this->getJadwalHariIni($bestMatch['mahasiswa_data']['id']);

            // Simpan hasil ke session
            Session::put([
                'face_image_path' => $fotoPath,
                'face_results' => [$bestMatch],
                'jadwal_hari_ini' => $jadwalHariIni
            ]);

            return redirect()->route('absen.face-results');
        } catch (\Exception $e) {
            Log::error('Face verification failed: ' . $e->getMessage());
            return back()->with('error', '⚠️ Gagal memproses wajah: ' . $e->getMessage());
        }
    }

    /**
     * Simpan gambar yang diupload
     */
    protected function simpanGambar($file, $filename)
    {
        $destinationPath = storage_path('app/public/images/presensi');
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        $image->scaleDown(height: 300);
        $image->save($destinationPath . '/' . $filename);

        return 'presensi/' . $filename;
    }

    /**
     * Verifikasi wajah dengan API
     */
    protected function verifyFaceWithApi($imagePath, $faceToken, $originalFilename)
    {
        $fileStream = fopen($imagePath, 'r');
        
        try {
            $client = new Client([
                'timeout' => 15,
                'connect_timeout' => 10,
            ]);

            $response = $client->post($this->faceApiUrl . 'api/verify', [
                'headers' => [
                    'x-api-key' => $this->faceApiKey
                ],
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => $fileStream,
                        'filename' => $originalFilename,
                    ],
                    [
                        'name' => 'face_token',
                        'contents' => $faceToken
                    ]
                ],
            ]);

            return json_decode($response->getBody(), true);
        } finally {
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }
        }
    }

    /**
     * Siapkan data match untuk ditampilkan
     */
    protected function prepareMatchData($mhs, $similarity)
    {
        return [
            'mahasiswa' => $mhs->mhs_name,
            'similarity' => $similarity,
            'status' => $similarity >= 0.5 ? '✅ Cocok' : '❌ Tidak Cocok',
            'mahasiswa_data' => [
                'id' => $mhs->id,
                'nim' => $mhs->mhs_nim,
                'name' => $mhs->mhs_name,
                'kelas' => $mhs->kelas->count() > 0 ? $mhs->kelas->pluck('name')->implode(', ') : 'Tidak ada kelas',
                'program_studi' => $mhs->kelas->count() > 0 && $mhs->kelas->first()->pstudi 
                    ? $mhs->kelas->first()->pstudi->name 
                    : 'Tidak ada prodi',
                'status' => $mhs->mhs_stat,
            ],
        ];
    }

    /**
     * Dapatkan jadwal hari ini untuk mahasiswa
     */
    protected function getJadwalHariIni($mahasiswaId)
    {
        $now = Carbon::now();
        $mahasiswa = Mahasiswa::with('kelas')->find($mahasiswaId);

        if (!$mahasiswa || $mahasiswa->kelas->isEmpty()) {
            return null;
        }

        return JadwalKuliah::where('kelas_id', $mahasiswa->kelas->first()->id)
            ->where('days_id', $now->dayOfWeekIso)
            ->where('start', '<=', $now->format('H:i:s'))
            ->where('ended', '>=', $now->format('H:i:s'))
            ->first();
    }
}