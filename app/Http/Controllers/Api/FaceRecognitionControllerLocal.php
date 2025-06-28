<?php

namespace App\Http\Controllers\Api;

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

class tesFaceRecognitionControllerLocal extends Controller
{
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|string', // Base64 encoded image
        ]);

        try {
            // Decode the base64 image
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->foto));

            // Temporary save the image to pass to API
            $tempPath = tempnam(sys_get_temp_dir(), 'face');
            file_put_contents($tempPath, $imageData);

            // Call face embedding API
            $client = new Client();
            $response = $client->post(env('FACE_API_URL'), [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($tempPath, 'r'),
                        'filename' => 'face_image.jpg',
                    ],
                ],
                'timeout' => 10,
            ]);

            // Clean up temp file
            unlink($tempPath);

            $data = json_decode($response->getBody(), true);
            $embedding = $data['embedding'] ?? null;

            if (!$embedding) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get face embedding'
                ], 400);
            }

            // Save embedding to student
            $mhs = Mahasiswa::find($request->mahasiswa_id);
            $mhs->face_embedding = json_encode($embedding);
            $mhs->save();

            return response()->json([
                'success' => true,
                'message' => 'Face embedding registered successfully',
                'data' => [
                    'mahasiswa_id' => $mhs->id,
                    'name' => $mhs->mhs_name,
                    'embedding_length' => count($embedding)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register face: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|string', // Base64 encoded image
            'save_image' => 'sometimes|boolean', // Whether to save the image
            'threshold' => 'sometimes|numeric|min:0|max:1' // Similarity threshold
        ]);

        try {
            // Decode the base64 image
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->foto));

            // Temporary save the image to pass to API
            $tempPath = tempnam(sys_get_temp_dir(), 'face');
            file_put_contents($tempPath, $imageData);

            // Get embedding from API
            $client = new Client();
            $response = $client->post(env('FACE_API_URL'), [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($tempPath, 'r'),
                        'filename' => 'face_image.jpg',
                    ],
                ],
                'timeout' => 10,
            ]);

            // Clean up temp file
            unlink($tempPath);

            $data = json_decode($response->getBody(), true);
            $inputEmbedding = $data['embedding'] ?? null;

            if (!$inputEmbedding) {
                return response()->json([
                    'success' => false,
                    'message' => 'No face detected or failed to get embedding'
                ], 400);
            }

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

            // Compare with registered students
            $mahasiswas = Mahasiswa::whereNotNull('face_embedding')->get();
            $threshold = $request->get('threshold', 0.5); // Default threshold 0.5
            $highestSimilarity = 0;
            $bestMatch = null;

            foreach ($mahasiswas as $mhs) {
                $storedEmbedding = json_decode($mhs->face_embedding, true);
                if (!$storedEmbedding) continue;

                $similarity = $this->cosineSimilarity($storedEmbedding, $inputEmbedding);

                if ($similarity > $highestSimilarity && $similarity >= $threshold) {
                    $highestSimilarity = $similarity;
                    $bestMatch = [
                        'mahasiswa_id' => $mhs->id,
                        'name' => $mhs->mhs_name,
                        'nim' => $mhs->mhs_nim,
                        'similarity' => $similarity,
                        'status' => $similarity >= $threshold ? 'match' : 'no_match',
                        'confidence' => $similarity
                    ];
                }
            }

            if (!$bestMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching student found above threshold'
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
                    $mahasiswaData->kelas->pluck('name')->implode(', ') : 'No class';
                $bestMatch['program_studi'] = $mahasiswaData->kelas->count() > 0 &&
                    $mahasiswaData->kelas->first()->pstudi ?
                    $mahasiswaData->kelas->first()->pstudi->name : 'No program study';
                $bestMatch['status_mahasiswa'] = $mahasiswaData->mhs_stat;
            }

            $response = [
                'success' => true,
                'message' => 'Face recognition completed',
                'data' => [
                    'recognition_result' => $bestMatch,
                    'schedule_today' => $jadwalHariIni,
                    'image_path' => $fotoPath,
                    'threshold_used' => $threshold
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

    public function hasilAbsen()
    {
        $results = Session::get('face_results', []);

        if (empty($results)) {
            return response()->json(['error' => 'Tidak ada hasil yang ditemukan.'], 404);
        }

        return response()->json(['results' => $results]);
    }

    private function cosineSimilarity(array $vec1, array $vec2): float
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        $length = count($vec1);

        for ($i = 0; $i < $length; $i++) {
            $dot += $vec1[$i] * $vec2[$i];
            $normA += $vec1[$i] * $vec1[$i];
            $normB += $vec2[$i] * $vec2[$i];
        }

        if ($normA == 0 || $normB == 0) return 0;

        return $dot / (sqrt($normA) * sqrt($normB));
    }
}
