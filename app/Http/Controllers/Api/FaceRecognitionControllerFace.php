<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FaceRecognitionController extends Controller
{
    // Ambil semua mahasiswa
    public function listMahasiswa()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return response()->json(['data' => $mahasiswas]);
    }

    // Simpan embedding wajah
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|string', // Base64 encoded image
        ]);

        try {
            // Decode the base64 image
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->foto));

            // Call Face++ API to detect face
            $client = new Client();
            $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
                'form_params' => [
                    'api_key' => env('FACE_API_KEY'),
                    'api_secret' => env('FACE_API_SECRET'),
                    'image_base64' => base64_encode($imageData),
                ]
            ]);

            $data = json_decode($res->getBody(), true);
            $faceToken = $data['faces'][0]['face_token'] ?? null;

            if (!$faceToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'No face detected'
                ], 400);
            }

            // Save face token to student
            $mhs = Mahasiswa::find($request->mahasiswa_id);
            $mhs->face_token = $faceToken;
            $mhs->save();

            return response()->json([
                'success' => true,
                'message' => 'Face token registered successfully',
                'data' => [
                    'mahasiswa_id' => $mhs->id,
                    'name' => $mhs->mhs_name,
                    'face_token' => $faceToken
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register face: ' . $e->getMessage()
            ], 500);
        }
    }

    // Cek wajah dan cari mahasiswa terdekat
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|string', // Base64 encoded image
            'save_image' => 'sometimes|boolean' // Whether to save the image
        ]);

        try {
            // Decode the base64 image
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->foto));
            $base64 = base64_encode($imageData);

            // Optionally save the image
            $fotoPath = null;
            if ($request->get('save_image', false)) {
                $fotoName = 'face_recognition_' . time() . '.jpg';
                $fotoPath = 'presensi/' . $fotoName;
                $destinationPath = storage_path('app/public/images/presensi');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Compress and save image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($imageData);
                $image->scaleDown(height: 300)->save($destinationPath . '/' . $fotoName);
            }

            // Detect face
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
                return response()->json([
                    'success' => false,
                    'message' => 'No face detected in the image'
                ], 400);
            }

            // Compare with registered students
            $users = Mahasiswa::whereNotNull('face_token')->get();
            $highestSimilarity = 0;
            $bestMatch = null;

            foreach ($users as $user) {
                $comparisonResult = $this->compareFaces($user, $inputToken);

                if ($comparisonResult['similarity'] > $highestSimilarity) {
                    $highestSimilarity = $comparisonResult['similarity'];
                    $bestMatch = [
                        'mahasiswa_id' => $user->id,
                        'name' => $user->mhs_name,
                        'nim' => $user->mhs_nim,
                        'similarity' => $comparisonResult['similarity'],
                        'status' => $comparisonResult['similarity'] >= 80 ? 'match' : 'no_match',
                        'confidence' => $comparisonResult['similarity']
                    ];
                }
            }

            if (!$bestMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching student found'
                ], 404);
            }

            // Get today's schedule if needed
            $now = Carbon::now();
            $hariIni = $now->dayOfWeekIso;
            $waktuDatang = $now->format('H:i:s');

            $mahasiswaData = Mahasiswa::with(['kelas.pstudi'])->find($bestMatch['mahasiswa_id']);
            $jadwalHariIni = null;

            if ($mahasiswaData) {
                $kelas = $mahasiswaData->kelas()->first();
                $kelasId = $kelas ? $kelas->id : null;

                if ($kelasId) {
                    $jadwalHariIni = JadwalKuliah::where('kelas_id', $kelasId)
                        ->where('days_id', $hariIni)
                        ->where('start', '<=', $waktuDatang)
                        ->where('ended', '>=', $waktuDatang)
                        ->first();
                }

                // Add more student data to response
                $bestMatch['kelas'] = $mahasiswaData->kelas->count() > 0 ?
                    $mahasiswaData->kelas->pluck('name')->implode(', ') : 'Tidak ada kelas';
                $bestMatch['program_studi'] = $mahasiswaData->kelas->count() > 0 &&
                    $mahasiswaData->kelas->first()->pstudi ?
                    $mahasiswaData->kelas->first()->pstudi->name : 'Tidak ada prodi';
                $bestMatch['status_mahasiswa'] = $mahasiswaData->mhs_stat;
            }

            $response = [
                'success' => true,
                'message' => 'Face recognition completed',
                'data' => [
                    'recognition_result' => $bestMatch,
                    'schedule_today' => $jadwalHariIni,
                    'image_path' => $fotoPath
                ]
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process face recognition: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi cosine similarity
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
                'status' => $similarity >= 80 ? 'match' : 'no_match',
            ];
        } catch (\Exception $e) {
            return [
                'similarity' => 0,
                'status' => 'error',
            ];
        }
    }
}
