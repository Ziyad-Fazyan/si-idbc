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
            $foto = fopen($request->file('foto')->getRealPath(), 'r');

            // Kirim ke API FastAPI /embedding
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
                return back()->with('error', '❌ Gagal mendapatkan embedding wajah.');
            }

            $mhs = Mahasiswa::find($request->mahasiswas_id);
            $mhs->face_embedding = json_encode($embedding);
            $mhs->save();

            return back()->with('success', "✅ Embedding wajah tersimpan untuk {$mhs->mhs_name}.");
        } catch (\Exception $e) {
            return back()->with('error', '⚠️ Gagal menghubungi API Face Recognition: ' . $e->getMessage());
        }
    }

    // Cek wajah dari foto yang di-upload dan bandingkan dengan mahasiswa lain
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        try {
            $foto = fopen($request->file('foto')->getRealPath(), 'r');

            // Dapatkan embedding dari API FastAPI
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
                return back()->with('error', '❌ Wajah tidak terdeteksi atau gagal mendapat embedding.');
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
                            'kelas' => $mhs->kelas ? $mhs->kelas->name : 'Tidak ada kelas',
                            'program_studi' => $mhs->kelas && $mhs->kelas->pstudi ? $mhs->kelas->pstudi->name : 'Tidak ada prodi',
                            'status' => $mhs->mhs_stat,
                        ],
                    ];
                }
            }

            if (!$bestMatch) {
                return back()->with('error', '❌ Tidak ada mahasiswa dengan wajah yang cocok.');
            }

            // Cari jadwal kuliah hari ini untuk kelas mahasiswa
            $today = now()->format('Y-m-d');
            $jadwalHariIni = null;

            if ($bestMatch['mahasiswa_data']['kelas'] !== 'Tidak ada kelas') {
                $jadwalHariIni = JadwalKuliah::whereHas('kelas', function ($query) use ($bestMatch) {
                    $query->where('name', $bestMatch['mahasiswa_data']['kelas']);
                })
                    ->where('date', $today)
                    ->first();
            }

            // Simpan hasil ke session
            Session::put('face_results', [$bestMatch]);
            Session::put('jadwal_hari_ini', $jadwalHariIni);

            return redirect()->route('absen.face-results');
        } catch (\Exception $e) {
            return back()->with('error', '⚠️ Gagal memproses wajah: ' . $e->getMessage());
        }
    }

    // Fungsi untuk membandingkan wajah
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
