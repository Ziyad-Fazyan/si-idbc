<?php

namespace App\Http\Controllers\Dosen\Akademik;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\HasilStudi;
use App\Models\studentTask;
use Illuminate\Support\Str;
use App\Models\JadwalKuliah;
use App\Models\studentScore;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiMahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah yang diampu oleh dosen
     */
    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user()->id;

        // Ambil jadwal kuliah yang diampu oleh dosen yang login
        $data['jadkul'] = JadwalKuliah::where('dosen_id', $dosenId)
            ->with(['matkul', 'kelas'])
            ->get()
            ->unique('makul_id'); // Menghilangkan duplikat mata kuliah

        return view('dosen.pages.nilai.index', $data);
    }

    /**
     * Menampilkan detail mata kuliah dengan daftar mahasiswa dan tugas
     */
    public function mataKuliahDetail($id)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user()->id;

        // Ambil data mata kuliah
        $data['matkul'] = MataKuliah::findOrFail($id);

        // Validasi bahwa dosen yang login adalah pengajar mata kuliah ini
        $isDosenMatkul = JadwalKuliah::where('makul_id', $id)
            ->where('dosen_id', $dosenId)
            ->exists();

        if (!$isDosenMatkul) {
            Alert::error('Error', 'Anda tidak memiliki akses untuk mata kuliah ini');
            return redirect()->route('dosen.akademik.nilai-index');
        }

        // Ambil jadwal kuliah untuk mata kuliah ini
        $jadkul = JadwalKuliah::where('makul_id', $id)
            ->where('dosen_id', $dosenId)
            ->first();

        // Ambil daftar mahasiswa yang mengambil mata kuliah ini
        $kelasIds = JadwalKuliah::where('makul_id', $id)
            ->pluck('kelas_id')
            ->toArray();

        $data['mahasiswa'] = Mahasiswa::whereHas('kelas', function($query) use ($kelasIds) {
            $query->whereIn('kelas.id', $kelasIds);
        })->get();

        // Ambil daftar tugas untuk mata kuliah ini
        $data['tugas'] = studentTask::where('jadkul_id', $jadkul->id)->get();

        // Ambil nilai tugas untuk setiap mahasiswa
        $data['nilai'] = [];
        $data['nilai_dikunci'] = []; // Array untuk menyimpan status kunci nilai per mahasiswa
        foreach ($data['mahasiswa'] as $mahasiswa) {
            foreach ($data['tugas'] as $tugas) {
                $nilai = studentScore::where('student_id', $mahasiswa->id)
                    ->where('stask_id', $tugas->id)
                    ->first();

                $data['nilai'][$mahasiswa->id][$tugas->id] = $nilai;
            }

            // Cek apakah nilai sudah dikunci untuk setiap mahasiswa
            $data['nilai_dikunci'][$mahasiswa->id] = HasilStudi::where('student_id', $mahasiswa->id)
                ->where('taka_id', $mahasiswa->taka_id)
                // ->where('is_locked', 1)
                ->exists();
        }

        return view('dosen.pages.nilai.detail', $data);
    }

    /**
     * Menyimpan nilai tugas mahasiswa
     */
    public function simpanNilai(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.*' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|array',
            'matkul_id' => 'required|exists:mata_kuliahs,id'
        ]);

        $dosenId = Auth::guard('dosen')->user()->id;
        $matkulId = $request->matkul_id;

        // Validasi bahwa dosen yang login adalah pengajar mata kuliah ini
        $isDosenMatkul = JadwalKuliah::where('makul_id', $matkulId)
            ->where('dosen_id', $dosenId)
            ->exists();

        if (!$isDosenMatkul) {
            Alert::error('Error', 'Anda tidak memiliki akses untuk mata kuliah ini');
            return redirect()->route('dosen.akademik.nilai-index');
        }

        // Ambil jadwal kuliah untuk mata kuliah ini
        $jadkul = JadwalKuliah::where('makul_id', $matkulId)
            ->where('dosen_id', $dosenId)
            ->first();

        // Simpan nilai untuk setiap mahasiswa dan tugas
        foreach ($request->nilai as $mahasiswaId => $tugasNilai) {
            foreach ($tugasNilai as $tugasId => $nilai) {
                // Cek apakah nilai sudah dikunci
                $nilaiDikunci = HasilStudi::where('student_id', $mahasiswaId)
                    ->where('taka_id', Mahasiswa::find($mahasiswaId)->taka_id)
                    ->where('is_locked', 1)
                    ->exists();

                if ($nilaiDikunci) {
                    continue; // Lewati jika nilai sudah dikunci
                }

                // Cek apakah nilai sudah ada
                $score = studentScore::where('student_id', $mahasiswaId)
                    ->where('stask_id', $tugasId)
                    ->first();

                if ($score) {
                    // Update nilai yang sudah ada
                    $score->score = $nilai;
                    $score->comment = $request->komentar[$mahasiswaId][$tugasId] ?? null;
                    $score->save();
                } else {
                    // Buat nilai baru
                    $score = new studentScore();
                    $score->student_id = $mahasiswaId;
                    $score->stask_id = $tugasId;
                    $score->dosen_id = $dosenId;
                    $score->code = Str::random(6);
                    $score->score = $nilai;
                    $score->comment = $request->komentar[$mahasiswaId][$tugasId] ?? null;
                    $score->save();
                }

                // Update hasil studi
                $this->updateHasilStudi($mahasiswaId);
            }
        }

        Alert::success('Sukses', 'Nilai berhasil disimpan');
        return redirect()->back();
    }

    /**
     * Mengunci nilai mahasiswa agar tidak bisa diubah
     */
    public function kunciNilai($id)
    {
        $dosenId = Auth::guard('dosen')->user()->id;
        $matkulId = $id;

        // Validasi bahwa dosen yang login adalah pengajar mata kuliah ini
        $isDosenMatkul = JadwalKuliah::where('makul_id', $matkulId)
            ->where('dosen_id', $dosenId)
            ->exists();

        if (!$isDosenMatkul) {
            Alert::error('Error', 'Anda tidak memiliki akses untuk mata kuliah ini');
            return redirect()->route('dosen.akademik.nilai-index');
        }

        // Ambil jadwal kuliah untuk mata kuliah ini
        $jadkul = JadwalKuliah::where('makul_id', $matkulId)
            ->where('dosen_id', $dosenId)
            ->first();

        // Ambil daftar mahasiswa yang mengambil mata kuliah ini
        $kelasIds = JadwalKuliah::where('makul_id', $matkulId)
            ->pluck('kelas_id')
            ->toArray();

        $mahasiswa = Mahasiswa::whereHas('kelas', function($query) use ($kelasIds) {
            $query->whereIn('kelas.id', $kelasIds);
        })->get();

        // Kunci nilai untuk setiap mahasiswa
        foreach ($mahasiswa as $mhs) {
            $hasilStudi = HasilStudi::where('student_id', $mhs->id)
                ->where('taka_id', $mhs->taka_id)
                ->first();

            if ($hasilStudi) {
                $hasilStudi->is_locked = 1;
                $hasilStudi->save();
            }
        }

        Alert::success('Sukses', 'Nilai berhasil dikunci');
        return redirect()->back();
    }

    /**
     * Menampilkan rekap nilai mahasiswa
     */
    public function rekapNilai($id)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user()->id;

        // Ambil data mata kuliah
        $data['matkul'] = MataKuliah::findOrFail($id);

        // Validasi bahwa dosen yang login adalah pengajar mata kuliah ini
        $isDosenMatkul = JadwalKuliah::where('makul_id', $id)
            ->where('dosen_id', $dosenId)
            ->exists();

        if (!$isDosenMatkul) {
            Alert::error('Error', 'Anda tidak memiliki akses untuk mata kuliah ini');
            return redirect()->route('dosen.akademik.nilai-index');
        }

        // Ambil jadwal kuliah untuk mata kuliah ini
        $jadkul = JadwalKuliah::where('makul_id', $id)
            ->where('dosen_id', $dosenId)
            ->first();

        // Ambil daftar mahasiswa yang mengambil mata kuliah ini
        $kelasIds = JadwalKuliah::where('makul_id', $id)
            ->pluck('kelas_id')
            ->toArray();

        $data['mahasiswa'] = Mahasiswa::whereHas('kelas', function($query) use ($kelasIds) {
            $query->whereIn('kelas.id', $kelasIds);
        })->get();

        // Ambil daftar tugas untuk mata kuliah ini
        $data['tugas'] = studentTask::where('jadkul_id', $jadkul->id)->get();

        // Ambil nilai tugas untuk setiap mahasiswa
        $data['nilai'] = [];
        $data['rata_rata'] = [];

        foreach ($data['mahasiswa'] as $mahasiswa) {
            $totalNilai = 0;
            $jumlahTugas = 0;

            foreach ($data['tugas'] as $tugas) {
                $nilai = studentScore::where('student_id', $mahasiswa->id)
                    ->where('stask_id', $tugas->id)
                    ->first();

                $data['nilai'][$mahasiswa->id][$tugas->id] = $nilai;

                if ($nilai && $nilai->score !== null) {
                    $totalNilai += $nilai->score;
                    $jumlahTugas++;
                }
            }

            // Hitung rata-rata nilai
            $data['rata_rata'][$mahasiswa->id] = $jumlahTugas > 0 ? $totalNilai / $jumlahTugas : 0;

            // Update hasil studi dengan rata-rata nilai
            $hasilStudi = HasilStudi::where('student_id', $mahasiswa->id)
                ->where('taka_id', $mahasiswa->taka_id)
                ->first();

            if (!$hasilStudi) {
                $hasilStudi = new HasilStudi();
                $hasilStudi->student_id = $mahasiswa->id;
                $hasilStudi->taka_id = $mahasiswa->taka_id;
                $hasilStudi->smt_id = $mahasiswa->taka->raw_semester;
                $hasilStudi->code = Str::random(6);
            }

            $hasilStudi->score_tugas = $data['rata_rata'][$mahasiswa->id];
            $hasilStudi->max_tugas = $jumlahTugas;
            $hasilStudi->save();
        }

        return view('dosen.pages.nilai.rekap', $data);
    }

    /**
     * Update hasil studi berdasarkan nilai tugas
     */
    private function updateHasilStudi($mahasiswaId)
    {
        $mahasiswa = Mahasiswa::find($mahasiswaId);

        // Ambil semua nilai tugas mahasiswa
        $nilaiTugas = studentScore::where('student_id', $mahasiswaId)
            ->whereNotNull('score')
            ->get();

        $totalNilai = 0;
        $jumlahTugas = count($nilaiTugas);

        foreach ($nilaiTugas as $nilai) {
            $totalNilai += $nilai->score;
        }

        // Hitung rata-rata nilai
        $rataRata = $jumlahTugas > 0 ? $totalNilai / $jumlahTugas : 0;

        // Update atau buat hasil studi
        $hasilStudi = HasilStudi::where('student_id', $mahasiswaId)
            ->where('taka_id', $mahasiswa->taka_id)
            ->first();

        if (!$hasilStudi) {
            $hasilStudi = new HasilStudi();
            $hasilStudi->student_id = $mahasiswaId;
            $hasilStudi->taka_id = $mahasiswa->taka_id;
            $hasilStudi->smt_id = $mahasiswa->taka->raw_semester;
            $hasilStudi->code = Str::random(6);
        }

        $hasilStudi->score_tugas = $rataRata;
        $hasilStudi->max_tugas = $jumlahTugas;
        $hasilStudi->save();

        return $hasilStudi;
    }
}
