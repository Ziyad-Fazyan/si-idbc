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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class FaceRecognitionController extends Controller
{
    // Get list of students for face registration
    public function getStudents()
    {
        $mahasiswas = Mahasiswa::orderBy('mhs_name')->get();
        return response()->json([
            'success' => true,
            'data' => $mahasiswas
        ]);
    }

    // Upload face photo and save embedding
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswas_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|image|max:2048',
        ]);

        try {
            $foto = fopen($request->file('foto')->getRealPath(), 'r');

            // Send to FastAPI /embedding endpoint
            $client = new Client();
            $response = $client->post('http://127.0.0.1:5000/embedding', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $foto,
                        'filename' => $request->file('foto')->getClientOriginalName(),
                    ],
                ],
                'timeout' => 10,
            ]);

            $data = json_decode($response->getBody(), true);
            $embedding = $data['embedding'] ?? null;

            if (!$embedding) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get face embedding'
                ], 400);
            }

            $mhs = Mahasiswa::find($request->mahasiswas_id);
            $mhs->face_embedding = json_encode($embedding);
            $mhs->save();

            return response()->json([
                'success' => true,
                'message' => "Face embedding saved for {$mhs->mhs_name}",
                'data' => [
                    'mahasiswa_id' => $mhs->id,
                    'name' => $mhs->mhs_name
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process face recognition: ' . $e->getMessage()
            ], 500);
        }
    }

    // Check face against registered students
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        try {
            $foto = $request->file('foto');

            // Save the photo for attendance record
            $fotoName = 'face_recognition_' . time() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = 'presensi/' . $fotoName;
            $destinationPath = storage_path('app/public/images/presensi');

            // Ensure directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Compress and save image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($foto->getRealPath());
            $image->scaleDown(height: 300)->save($destinationPath . '/' . $fotoName);

            // Get embedding from FastAPI
            $fileStream = fopen($foto->getRealPath(), 'r');
            $client = new Client();
            $response = $client->post('http://127.0.0.1:5000/embedding', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $fileStream,
                        'filename' => $foto->getClientOriginalName(),
                    ],
                ],
                'timeout' => 10,
            ]);

            if (is_resource($fileStream)) {
                fclose($fileStream);
            }

            $data = json_decode($response->getBody(), true);
            $inputEmbedding = $data['embedding'] ?? null;

            if (!$inputEmbedding) {
                return response()->json([
                    'success' => false,
                    'message' => 'No face detected or failed to get embedding'
                ], 400);
            }

            $mahasiswas = Mahasiswa::whereNotNull('face_embedding')->get();

            $highestSimilarity = 0;
            $bestMatch = null;

            foreach ($mahasiswas as $mhs) {
                $storedEmbedding = json_decode($mhs->face_embedding, true);
                if (!$storedEmbedding) continue;

                $similarity = $this->cosineSimilarity($storedEmbedding, $inputEmbedding);

                if ($similarity > $highestSimilarity) {
                    $highestSimilarity = $similarity;
                    $bestMatch = [
                        'mahasiswa_id' => $mhs->id,
                        'name' => $mhs->mhs_name,
                        'nim' => $mhs->mhs_nim,
                        'similarity' => $similarity,
                        'match' => $similarity >= 0.5,
                        'kelas' => $mhs->kelas->count() > 0 ? $mhs->kelas->pluck('name')->implode(', ') : 'No class',
                        'program_studi' => $mhs->kelas->count() > 0 && $mhs->kelas->first()->pstudi ? $mhs->kelas->first()->pstudi->name : 'No program study',
                        'status' => $mhs->mhs_stat,
                    ];
                }
            }

            if (!$bestMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching student found'
                ], 404);
            }

            // Check schedule
            $now = Carbon::now();
            $hariIni = $now->dayOfWeekIso;
            $waktuDatang = $now->format('H:i:s');
            
            $jadwalHariIni = null;
            $kelas = $mhs->kelas()->first();
            $kelasId = $kelas ? $kelas->id : null;

            if ($kelasId) {
                $jadwalHariIni = JadwalKuliah::where('kelas_id', $kelasId)
                    ->where('days_id', $hariIni)
                    ->where('start', '<=', $waktuDatang)
                    ->where('ended', '>=', $waktuDatang)
                    ->first();
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'face_match' => $bestMatch,
                    'schedule' => $jadwalHariIni,
                    'image_path' => Storage::url('public/images/presensi/' . $fotoName),
                    'timestamp' => $now->toDateTimeString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process face: ' . $e->getMessage()
            ], 500);
        }
    }

    // Cosine similarity calculation
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