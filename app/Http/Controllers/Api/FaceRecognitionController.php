<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'mahasiswas_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|image|max:2048',
        ]);

        try {
            $foto = fopen($request->file('foto')->getRealPath(), 'r');

            $client = new Client();
            $response = $client->post(env('FACE_API_URL'), [
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
                return response()->json(['error' => 'Gagal mendapatkan embedding wajah.'], 422);
            }

            $mhs = Mahasiswa::find($request->mahasiswas_id);
            $mhs->face_embedding = json_encode($embedding);
            $mhs->save();

            return response()->json([
                'message' => '✅ Embedding wajah berhasil disimpan.',
                'mahasiswa' => $mhs->mhs_name
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghubungi API Face Recognition: ' . $e->getMessage()], 500);
        }
    }

    // Cek wajah dan cari mahasiswa terdekat
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        try {
            $foto = fopen($request->file('foto')->getRealPath(), 'r');

            $client = new Client();
            $response = $client->post(env('FACE_API_URL'), [
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
            $inputEmbedding = $data['embedding'] ?? null;

            if (!$inputEmbedding) {
                return response()->json(['error' => 'Wajah tidak terdeteksi atau embedding kosong.'], 422);
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
                        'mahasiswa' => $mhs->mhs_name,
                        'similarity' => $similarity,
                        'status' => $similarity >= 0.5 ? '✅ Cocok' : '❌ Tidak Cocok',
                        'mahasiswa_data' => [
                            'id' => $mhs->id,
                            'nim' => $mhs->mhs_nim,
                            'name' => $mhs->mhs_name,
                            'kelas' => $mhs->kelas->count() > 0 ? $mhs->kelas->pluck('name')->implode(', ') : 'Tidak ada kelas',
                            'program_studi' => $mhs->kelas->count() > 0 && $mhs->kelas->first()->pstudi ? $mhs->kelas->first()->pstudi->name : 'Tidak ada prodi',
                            'status' => $mhs->mhs_stat,
                        ],
                    ];
                }
            }

            if (!$bestMatch) {
                return response()->json(['error' => 'Tidak ada mahasiswa dengan wajah yang cocok.'], 404);
            }

            // Cek jadwal hari ini
            $today = now()->format('Y-m-d');
            $jadwalHariIni = null;

            if ($bestMatch['mahasiswa_data']['kelas'] !== 'Tidak ada kelas') {
                $jadwalHariIni = JadwalKuliah::whereHas('kelas', function ($query) use ($bestMatch) {
                    $query->where('name', $bestMatch['mahasiswa_data']['kelas']);
                })->where('date', $today)->first();
            }

            return response()->json([
                'match' => $bestMatch,
                'jadwal_hari_ini' => $jadwalHariIni,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memproses wajah: ' . $e->getMessage()], 500);
        }
    }

    // Fungsi cosine similarity
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
