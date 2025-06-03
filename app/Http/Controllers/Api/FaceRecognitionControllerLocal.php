<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FaceRecognitionController extends Controller
{
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswas_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|image|max:2048',
        ]);

        try {
            $base64 = base64_encode(file_get_contents($request->file('foto')));
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
                return response()->json(['error' => 'Wajah tidak terdeteksi'], 400);
            }

            $mhs = Mahasiswa::find($request->mahasiswas_id);
            $mhs->face_token = $faceToken;
            $mhs->save();

            return response()->json(['message' => 'Face token berhasil disimpan', 'data' => $mhs]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        try {
            $base64 = base64_encode(file_get_contents($request->file('foto')));

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
                return response()->json(['error' => 'Wajah tidak terdeteksi'], 400);
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
                        'mahasiswa_data' => [
                            'id' => $user->id,
                            'nim' => $user->mhs_nim,
                            'name' => $user->mhs_name,
                            'kelas' => $user->kelas->name ?? 'Tidak ada kelas',
                            'program_studi' => $user->kelas->pstudi->name ?? 'Tidak ada prodi',
                            'status' => $user->mhs_stat
                        ]
                    ];
                }
            }

            $now = Carbon::now();
            $hariIni = $now->dayOfWeekIso; // Senin = 1, Minggu = 7
            $waktuDatang = $now->format('H:i:s');
            $jadwalHariIni = null;
            if ($bestMatch) {
                // Ambil kelas pertama yang terkait dengan mahasiswa
                $kelas = $user->kelas()->first();
                $kelasId = $kelas ? $kelas->id : null;

                if ($kelasId) {
                    $jadwalHariIni = JadwalKuliah::where('kelas_id', $kelasId)
                        ->where('days_id', $hariIni)
                        ->where('start', '<=', $waktuDatang)
                        ->where('ended', '>=', $waktuDatang)
                        ->first();
                }
            }

            // Store results in session
            Session::put('face_results', [$bestMatch]);
            Session::put('jadwal_hari_ini', $jadwalHariIni);

            return response()->json([
                'result' => $bestMatch,
                'jadwal_hari_ini' => $jadwalHariIni
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal proses wajah: ' . $e->getMessage()], 500);
        }
    }

    public function hasilAbsen()
    {
        $results = Session::get('face_results', []);

        if (empty($results)) {
            return response()->json(['error' => 'Tidak ada hasil yang ditemukan.'], 404);
        }

        return response()->json(['results' => $results]);
    }

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
            return [
                'similarity' => 0,
                'status' => '⚠️ Error membandingkan wajah',
            ];
        }
    }
}
