<?php

namespace App\Http\Controllers\Dosen\Akademik;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\HasilStudi;
use App\Models\StudentTask;
use Illuminate\Support\Str;
use App\Models\JadwalKuliah;
use App\Models\StudentScore;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiMahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah yang diampu oleh dosen
     */
    public function index()
    {
        try {
            $data['web'] = WebSettings::where('id', 1)->first();
            $dosenId = Auth::guard('dosen')->user()->id;
            $currentTakaId = $this->getCurrentTahunAkademik();

            // Ambil jadwal kuliah yang diampu oleh dosen yang login
            $data['jadkul'] = JadwalKuliah::where('dosen_id', $dosenId)
                ->with(['matkul', 'kelas'])
                ->get()
                ->unique('makul_id'); // Menghilangkan duplikat mata kuliah

            // Tambahkan informasi status penilaian untuk setiap mata kuliah
            foreach ($data['jadkul'] as $jadwal) {
                $jadwal->status_penilaian = $this->getStatusPenilaian($jadwal->makul_id, $dosenId);
                $jadwal->deadline_penilaian = $this->getDeadlinePenilaian($jadwal->makul_id);

                if ($jadwal->deadline_penilaian) {
                    $deadlineDate = Carbon::parse($jadwal->deadline_penilaian);
                    $jadwal->deadline_lewat = now()->gt($deadlineDate);
                    $jadwal->sisa_hari = now()->diffInDays($deadlineDate, false);
                    $jadwal->deadline_formatted = $deadlineDate->format('d M Y');
                } else {
                    $jadwal->deadline_lewat = false;
                    $jadwal->sisa_hari = null;
                    $jadwal->deadline_formatted = 'Belum ditentukan';
                }
            }

            // Cek apakah ada mata kuliah yang mendekati deadline
            $mataKuliahMendekatiBatas = $data['jadkul']
                ->filter(function ($jadwal) {
                    return $jadwal->sisa_hari !== null &&
                        $jadwal->sisa_hari <= 7 &&
                        $jadwal->sisa_hari >= 0 &&
                        $jadwal->status_penilaian != 'Semua dinilai' &&
                        $jadwal->status_penilaian != 'Nilai dikunci';
                })
                ->sortBy('sisa_hari')
                ->take(3);

            if ($mataKuliahMendekatiBatas->count() > 0) {
                $pesanAlert = 'Deadline penilaian mendekati batas:<br>';
                foreach ($mataKuliahMendekatiBatas as $jadwal) {
                    $pesanAlert .= "- {$jadwal->matkul->nama_mk} ({$jadwal->kelas->nama_kelas}): {$jadwal->deadline_formatted} (" .
                        ($jadwal->sisa_hari == 0 ? 'Hari ini' : "{$jadwal->sisa_hari} hari lagi") . ")<br>";
                }

                Alert::warning('Perhatian', $pesanAlert)->html();
            }

            // Cek apakah ada mata kuliah yang sudah melewati deadline
            $mataKuliahLewatBatas = $data['jadkul']
                ->filter(function ($jadwal) {
                    return $jadwal->deadline_lewat &&
                        $jadwal->status_penilaian != 'Semua dinilai' &&
                        $jadwal->status_penilaian != 'Nilai dikunci';
                })
                ->take(3);

            if ($mataKuliahLewatBatas->count() > 0) {
                $pesanAlert = 'Deadline penilaian sudah lewat:<br>';
                foreach ($mataKuliahLewatBatas as $jadwal) {
                    $pesanAlert .= "- {$jadwal->matkul->nama_mk} ({$jadwal->kelas->nama_kelas}): {$jadwal->deadline_formatted}<br>";
                }

                Alert::error('Perhatian', $pesanAlert)->html();
            }

            return view('dosen.pages.nilai.index', $data);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menampilkan daftar mata kuliah: ' . $e->getMessage());
            return view('dosen.pages.nilai.index', ['jadkul' => collect([])]);
        }
    }

    /**
     * Mendapatkan tahun akademik yang sedang aktif
     */
    private function getCurrentTahunAkademik()
    {
        $takaActive = DB::table('tahun_akademiks')
            ->where('is_active', 1)
            ->first();

        return $takaActive ? $takaActive->id : null;
    }

    /**
     * Mendapatkan status penilaian untuk mata kuliah
     */
    private function getStatusPenilaian($matkulId, $dosenId)
    {
        // Cek apakah ada tugas untuk mata kuliah ini
        $jadkulId = JadwalKuliah::where('makul_id', $matkulId)
            ->where('dosen_id', $dosenId)
            ->first();

        if (!$jadkulId) {
            return 'Belum ada jadwal';
        }

        $countTugas = StudentTask::where('jadkul_id', $jadkulId->id)->count();

        if ($countTugas == 0) {
            return 'Belum ada tugas';
        }

        // Cek apakah semua nilai sudah dikunci
        $kelasIds = JadwalKuliah::where('makul_id', $matkulId)
            ->pluck('kelas_id')
            ->toArray();

        $mahasiswaIds = Mahasiswa::whereHas('kelas', function ($query) use ($kelasIds) {
            $query->whereIn('kelas.id', $kelasIds);
        })->pluck('id')->toArray();

        $countMahasiswa = count($mahasiswaIds);

        if ($countMahasiswa == 0) {
            return 'Belum ada mahasiswa';
        }

        $countLocked = HasilStudi::whereIn('student_id', $mahasiswaIds)
            ->where('is_locked', 1)
            ->count();

        if ($countLocked == $countMahasiswa) {
            return 'Nilai dikunci';
        } else if ($countLocked > 0) {
            return 'Sebagian dikunci';
        } else {
            // Cek apakah semua mahasiswa sudah dinilai
            $tugasIds = StudentTask::where('jadkul_id', $jadkulId->id)->pluck('id')->toArray();
            $totalNilaiSeharusnya = count($mahasiswaIds) * count($tugasIds);

            $countNilai = StudentScore::whereIn('student_id', $mahasiswaIds)
                ->whereIn('stask_id', $tugasIds)
                ->whereNotNull('score')
                ->count();

            if ($countNilai == $totalNilaiSeharusnya) {
                return 'Semua dinilai';
            } else if ($countNilai > 0) {
                $percentage = round(($countNilai / $totalNilaiSeharusnya) * 100);
                return $percentage . '% dinilai';
            } else {
                return 'Belum dinilai';
            }
        }
    }

    /**
     * Mendapatkan deadline penilaian untuk mata kuliah
     */
    private function getDeadlinePenilaian($matkulId)
    {
        $matkul = MataKuliah::find($matkulId);

        if (!$matkul || !$matkul->taka) {
            return null;
        }

        // Asumsi: deadline penilaian adalah 2 minggu setelah akhir semester
        $endDate = $matkul->taka->end_date;

        if (!$endDate) {
            return null;
        }

        return Carbon::parse($endDate)->addDays(14)->format('d M Y');
    }

    /**
     * Menampilkan detail mata kuliah dengan daftar mahasiswa dan tugas
     */
    public function mataKuliahDetail($id)
    {
        try {
            $data['web'] = WebSettings::where('id', 1)->first();
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

            if (!$jadkul) {
                Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
                return redirect()->route('dosen.akademik.nilai-index');
            }

            // Ambil daftar mahasiswa yang mengambil mata kuliah ini
            $kelasIds = JadwalKuliah::where('makul_id', $id)
                ->pluck('kelas_id')
                ->toArray();

            $data['mahasiswa'] = Mahasiswa::whereHas('kelas', function ($query) use ($kelasIds) {
                $query->whereIn('kelas.id', $kelasIds);
            })->orderBy('mhs_name', 'asc')->get();

            // Ambil daftar tugas untuk mata kuliah ini
            $data['tugas'] = StudentTask::where('jadkul_id', $jadkul->id)
                ->orderBy('exp_date', 'asc')
                ->orderBy('exp_time', 'asc')
                ->get();

            // Ambil nilai tugas untuk setiap mahasiswa
            $data['nilai'] = [];
            $data['nilai_dikunci'] = false; // Default: nilai belum dikunci
            $data['nilai_dikunci_per_mahasiswa'] = []; // Array untuk menyimpan status kunci nilai per mahasiswa
            $data['progress_penilaian'] = []; // Array untuk menyimpan progress penilaian per mahasiswa

            foreach ($data['mahasiswa'] as $mahasiswa) {
                $nilaiTerkumpul = 0;
                $totalTugas = count($data['tugas']);

                foreach ($data['tugas'] as $tugas) {
                    $nilai = StudentScore::where('student_id', $mahasiswa->id)
                        ->where('stask_id', $tugas->id)
                        ->first();

                    $data['nilai'][$mahasiswa->id][$tugas->id] = $nilai;

                    if ($nilai && $nilai->score !== null) {
                        $nilaiTerkumpul++;
                    }
                }

                // Cek apakah nilai sudah dikunci untuk setiap mahasiswa
                $hasilStudi = HasilStudi::where('student_id', $mahasiswa->id)
                    ->where('taka_id', $mahasiswa->taka_id)
                    ->first();

                $data['nilai_dikunci_per_mahasiswa'][$mahasiswa->id] = $hasilStudi && $hasilStudi->is_locked == 1;

                // Jika ada satu mahasiswa yang nilainya dikunci, maka set nilai_dikunci = true
                if ($data['nilai_dikunci_per_mahasiswa'][$mahasiswa->id]) {
                    $data['nilai_dikunci'] = true;
                }

                // Hitung progress penilaian
                $data['progress_penilaian'][$mahasiswa->id] = $totalTugas > 0 ? round(($nilaiTerkumpul / $totalTugas) * 100) : 0;
            }

            // Tambahkan informasi deadline untuk setiap tugas
            foreach ($data['tugas'] as $tugas) {
                $tugas->deadline_passed = Carbon::now()->gt(Carbon::parse($tugas->exp_date . ' ' . $tugas->exp_time));
                $tugas->deadline_formatted = Carbon::parse($tugas->exp_date . ' ' . $tugas->exp_time)->format('d M Y H:i');
                $tugas->days_remaining = Carbon::now()->diffInDays(Carbon::parse($tugas->exp_date . ' ' . $tugas->exp_time), false);
            }

            // Tambahkan informasi status penilaian
            $data['status_penilaian'] = $this->getStatusPenilaian($id, $dosenId);
            $data['deadline_penilaian'] = $this->getDeadlinePenilaian($id);

            if ($data['deadline_penilaian']) {
                $deadlineDate = Carbon::parse($data['deadline_penilaian']);
                $data['deadline_lewat'] = now()->gt($deadlineDate);
                $data['deadline_formatted'] = $deadlineDate->format('d M Y');
                $data['sisa_hari'] = now()->diffInDays($deadlineDate, false);
            } else {
                $data['deadline_lewat'] = false;
                $data['deadline_formatted'] = 'Belum ditentukan';
                $data['sisa_hari'] = null;
            }

            // Cek hasil dari fungsi cekSemuaNilaiTerisi
            $data['cek_nilai'] = $this->cekSemuaNilaiTerisi($jadkul->id);

            return view('dosen.pages.nilai.detail', $data);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menampilkan detail mata kuliah: ' . $e->getMessage());
            return redirect()->route('dosen.akademik.nilai-index');
        }
    }

    /**
     * Menyimpan nilai tugas mahasiswa
     */
    public function simpanNilai(Request $request)
    {
        try {
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

            if (!$jadkul) {
                Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
                return redirect()->route('dosen.akademik.nilai-index');
            }

            // Mulai transaksi database untuk memastikan konsistensi data
            DB::beginTransaction();

            $nilaiTersimpan = 0;
            $nilaiDikunci = 0;
            $totalNilai = 0;

            // Simpan nilai untuk setiap mahasiswa dan tugas
            foreach ($request->nilai as $mahasiswaId => $tugasNilai) {
                $mahasiswa = Mahasiswa::find($mahasiswaId);

                if (!$mahasiswa) {
                    continue; // Lewati jika mahasiswa tidak ditemukan
                }

                // Cek apakah nilai sudah dikunci untuk mahasiswa ini
                $hasilStudi = HasilStudi::where('student_id', $mahasiswaId)
                    ->where('taka_id', $mahasiswa->taka_id)
                    ->first();

                $nilaiDiKunciUntukMahasiswa = $hasilStudi && $hasilStudi->is_locked == 1;

                if ($nilaiDiKunciUntukMahasiswa) {
                    $nilaiDikunci += count($tugasNilai);
                    continue; // Lewati jika nilai sudah dikunci
                }

                foreach ($tugasNilai as $tugasId => $nilai) {
                    $totalNilai++;

                    // Validasi tugas
                    $tugas = StudentTask::find($tugasId);
                    if (!$tugas || $tugas->jadkul_id != $jadkul->id) {
                        continue; // Lewati jika tugas tidak valid
                    }

                    // Cek apakah nilai sudah ada
                    $score = StudentScore::where('student_id', $mahasiswaId)
                        ->where('stask_id', $tugasId)
                        ->first();

                    if ($score) {
                        // Update nilai yang sudah ada
                        $score->score = $nilai;
                        $score->comment = $request->komentar[$mahasiswaId][$tugasId] ?? null;
                        $score->status = 'Sudah dinilai';
                        if (!$score->dosen_id) {
                            $score->dosen_id = $dosenId;
                        }
                        $score->save();
                    } else {
                        // Buat nilai baru
                        $score = new StudentScore();
                        $score->student_id = $mahasiswaId;
                        $score->stask_id = $tugasId;
                        $score->dosen_id = $dosenId;
                        $score->code = Str::random(6);
                        $score->score = $nilai;
                        $score->desc = ''; // Tambahkan nilai default untuk desc
                        $score->comment = $request->komentar[$mahasiswaId][$tugasId] ?? null;
                        $score->status = 'Sudah dinilai';
                        $score->save();
                    }

                    // Update hasil studi
                    $this->updateHasilStudi($mahasiswaId);
                    $nilaiTersimpan++;
                }
            }

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            if ($nilaiDikunci > 0 && $nilaiTersimpan == 0) {
                Alert::warning('Perhatian', 'Semua nilai sudah dikunci dan tidak dapat diubah');
            } else if ($nilaiDikunci > 0) {
                Alert::success('Sukses', "$nilaiTersimpan nilai berhasil disimpan. $nilaiDikunci nilai tidak dapat diubah karena sudah dikunci.");
            } else {
                Alert::success('Sukses', "$nilaiTersimpan nilai berhasil disimpan");
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            Alert::error('Error', 'Terjadi kesalahan saat menyimpan nilai: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Mengunci nilai mahasiswa agar tidak bisa diubah
     */
    public function kunciNilai($id)
    {
        try {
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

            if (!$jadkul) {
                Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
                return redirect()->route('dosen.akademik.nilai-index');
            }

            // Ambil daftar mahasiswa yang mengambil mata kuliah ini
            $kelasIds = JadwalKuliah::where('makul_id', $matkulId)
                ->pluck('kelas_id')
                ->toArray();

            $mahasiswa = Mahasiswa::whereHas('kelas', function ($query) use ($kelasIds) {
                $query->whereIn('kelas.id', $kelasIds);
            })->get();

            // Mulai transaksi database
            DB::beginTransaction();

            $berhasilDikunci = 0;
            $sudahDikunci = 0;

            // Kunci nilai untuk setiap mahasiswa
            foreach ($mahasiswa as $mhs) {
                $hasilStudi = HasilStudi::where('student_id', $mhs->id)
                    ->where('taka_id', $mhs->taka_id)
                    ->first();

                if ($hasilStudi) {
                    if ($hasilStudi->is_locked == 1) {
                        $sudahDikunci++;
                    } else {
                        $hasilStudi->is_locked = 1;
                        $hasilStudi->save();
                        $berhasilDikunci++;
                    }
                } else {
                    // Jika hasil studi belum ada, buat baru
                    $hasilStudi = new HasilStudi();
                    $hasilStudi->student_id = $mhs->id;
                    $hasilStudi->taka_id = $mhs->taka_id;
                    $hasilStudi->is_locked = 1;
                    $hasilStudi->code = Str::random(6);
                    $hasilStudi->save();
                    $berhasilDikunci++;
                }
            }

            // Commit transaksi
            DB::commit();

            if ($berhasilDikunci > 0) {
                Alert::success('Sukses', "$berhasilDikunci nilai mahasiswa berhasil dikunci");
            } else if ($sudahDikunci > 0) {
                Alert::info('Informasi', "Semua nilai mahasiswa ($sudahDikunci) sudah dikunci sebelumnya");
            } else {
                Alert::warning('Perhatian', 'Tidak ada nilai yang dikunci');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            Alert::error('Error', 'Terjadi kesalahan saat mengunci nilai: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Menampilkan rekap nilai mahasiswa
     */
    public function rekapNilai($id)
    {
        try {
            $data['web'] = WebSettings::where('id', 1)->first();
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

            if (!$jadkul) {
                Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
                return redirect()->route('dosen.akademik.nilai-index');
            }

            // Ambil daftar mahasiswa yang mengambil mata kuliah ini
            $kelasIds = JadwalKuliah::where('makul_id', $id)
                ->pluck('kelas_id')
                ->toArray();

            $data['mahasiswa'] = Mahasiswa::whereHas('kelas', function ($query) use ($kelasIds) {
                $query->whereIn('kelas.id', $kelasIds);
            })->orderBy('mhs_name', 'asc')->get();

            // Ambil daftar tugas untuk mata kuliah ini
            $data['tugas'] = StudentTask::where('jadkul_id', $jadkul->id)
                ->orderBy('exp_date', 'asc')
                ->orderBy('exp_time', 'asc')
                ->get();

            // Cek status penilaian
            $data['statusPenilaian'] = $this->cekSemuaNilaiTerisi($jadkul->id);

            // Ambil nilai tugas untuk setiap mahasiswa
            $data['nilai'] = [];
            $data['rata_rata'] = [];
            $data['nilai_huruf'] = [];
            $data['nilai_dikunci'] = [];
            $data['progress_penilaian'] = [];
            $totalMahasiswaDikunci = 0;
            $totalMahasiswaBelumDikunci = 0;

            foreach ($data['mahasiswa'] as $mahasiswa) {
                $totalNilai = 0;
                $jumlahTugas = 0;
                $jumlahTugasDinilai = 0;

                foreach ($data['tugas'] as $tugas) {
                    $nilai = StudentScore::where('student_id', $mahasiswa->id)
                        ->where('stask_id', $tugas->id)
                        ->first();

                    $data['nilai'][$mahasiswa->id][$tugas->id] = $nilai;

                    if ($nilai && $nilai->score !== null) {
                        $totalNilai += $nilai->score;
                        $jumlahTugasDinilai++;
                    }
                    $jumlahTugas++;
                }

                // Hitung rata-rata nilai
                $data['rata_rata'][$mahasiswa->id] = $jumlahTugasDinilai > 0 ? $totalNilai / $jumlahTugasDinilai : 0;

                // Konversi nilai ke huruf
                $data['nilai_huruf'][$mahasiswa->id] = $this->konversiNilai($data['rata_rata'][$mahasiswa->id]);

                // Ambil status kunci nilai
                $hasilStudi = HasilStudi::where('student_id', $mahasiswa->id)
                    ->where('taka_id', $mahasiswa->taka_id)
                    ->first();

                if (!$hasilStudi) {
                    $hasilStudi = new HasilStudi();
                    $hasilStudi->student_id = $mahasiswa->id;
                    $hasilStudi->taka_id = $mahasiswa->taka_id;
                    $hasilStudi->smt_id = $mahasiswa->taka->raw_semester ?? null;
                    $hasilStudi->code = Str::random(6);
                    // Inisialisasi nilai default
                    $hasilStudi->score_absen = 0;
                    $hasilStudi->score_uts = 0;
                    $hasilStudi->score_uas = 0;
                    $hasilStudi->score_tugas = 0;
                    $hasilStudi->max_absen = 0;
                    $hasilStudi->max_tugas = $jumlahTugas;
                    $hasilStudi->nilai_ips = 0;
                    $hasilStudi->nilai_ipk = 0;
                    $hasilStudi->is_locked = 0;
                }

                $data['nilai_dikunci'][$mahasiswa->id] = $hasilStudi->is_locked == 1;

                if ($data['nilai_dikunci'][$mahasiswa->id]) {
                    $totalMahasiswaDikunci++;
                } else {
                    $totalMahasiswaBelumDikunci++;
                }

                $hasilStudi->score_tugas = $data['rata_rata'][$mahasiswa->id];
                $hasilStudi->max_tugas = $jumlahTugas;
                $hasilStudi->save();

                // Hitung persentase penyelesaian penilaian
                $data['progress_penilaian'][$mahasiswa->id] = $jumlahTugas > 0 ? ($jumlahTugasDinilai / $jumlahTugas) * 100 : 0;
            }

            // Cek apakah semua nilai sudah dikunci
            $data['semuaNilaiDikunci'] = $totalMahasiswaBelumDikunci == 0 && $totalMahasiswaDikunci > 0;

            // Hitung persentase keseluruhan
            $totalMahasiswa = count($data['mahasiswa']);
            $data['persentaseKunci'] = $totalMahasiswa > 0 ? ($totalMahasiswaDikunci / $totalMahasiswa) * 100 : 0;

            // Ambil informasi deadline penilaian
            $data['deadlinePenilaian'] = $this->getDeadlinePenilaian($id);
            $data['deadlineLewat'] = $data['deadlinePenilaian'] ? now()->gt(Carbon::parse($data['deadlinePenilaian'])) : false;
            $data['sisaHari'] = $data['deadlinePenilaian'] ? now()->diffInDays(Carbon::parse($data['deadlinePenilaian']), false) : null;

            return view('dosen.pages.nilai.rekap', $data);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menampilkan rekap nilai: ' . $e->getMessage());
            return redirect()->route('dosen.akademik.nilai-index');
        }
    }

    /**
     * Update hasil studi mahasiswa
     */
    private function updateHasilStudi($mahasiswaId)
    {
        $mahasiswa = Mahasiswa::find($mahasiswaId);
        if (!$mahasiswa) {
            return null;
        }

        $takaId = $mahasiswa->taka_id;

        // Ambil semua nilai tugas mahasiswa
        $nilaiTugas = StudentScore::whereHas('studentTask', function ($query) {
            $query->whereNotNull('jadkul_id');
        })->where('student_id', $mahasiswaId)->get();

        // Hitung rata-rata nilai tugas
        $totalNilai = 0;
        $jumlahTugas = count($nilaiTugas);

        if ($jumlahTugas > 0) {
            foreach ($nilaiTugas as $nilai) {
                $totalNilai += $nilai->score;
            }
            $rataRata = $totalNilai / $jumlahTugas;
        } else {
            $rataRata = 0;
        }

        // Update atau buat hasil studi
        $hasilStudi = HasilStudi::where('student_id', $mahasiswaId)
            ->where('taka_id', $takaId)
            ->first();

        if (!$hasilStudi) {
            $hasilStudi = new HasilStudi();
            $hasilStudi->student_id = $mahasiswaId;
            $hasilStudi->taka_id = $takaId;
            $hasilStudi->smt_id = $mahasiswa->taka->raw_semester ?? null;
            $hasilStudi->code = Str::random(6);
            // Inisialisasi nilai default
            $hasilStudi->score_absen = 0;
            $hasilStudi->score_uts = 0;
            $hasilStudi->score_uas = 0;
            $hasilStudi->score_tugas = 0;
            $hasilStudi->max_absen = 0;
            $hasilStudi->max_tugas = 0;
            $hasilStudi->nilai_ips = 0;
            $hasilStudi->nilai_ipk = 0;
            $hasilStudi->is_locked = 0;
        }

        $hasilStudi->score_tugas = $rataRata;
        $hasilStudi->save();

        return $hasilStudi;
    }

    /**
     * Memeriksa apakah semua nilai sudah diisi untuk mata kuliah tertentu
     */
    private function cekSemuaNilaiTerisi($jadkulId)
    {
        // Ambil semua tugas untuk jadwal kuliah ini
        $tasks = StudentTask::where('jadkul_id', $jadkulId)->get();
        if ($tasks->isEmpty()) {
            return [
                'status' => false,
                'pesan' => 'Belum ada tugas yang dibuat',
                'belum_dinilai' => []
            ];
        }

        // Ambil semua mahasiswa yang terdaftar di mata kuliah ini
        $jadwal = JadwalKuliah::find($jadkulId);
        if (!$jadwal) {
            return [
                'status' => false,
                'pesan' => 'Jadwal kuliah tidak ditemukan',
                'belum_dinilai' => []
            ];
        }

        $mahasiswas = Mahasiswa::whereHas('kelas', function($query) use ($jadwal) {
            $query->where('kelas.id', $jadwal->kelas_id);
        })->get();

        if ($mahasiswas->isEmpty()) {
            return [
                'status' => false,
                'pesan' => 'Tidak ada mahasiswa yang terdaftar',
                'belum_dinilai' => []
            ];
        }

        // Cek apakah semua nilai sudah diisi
        $belumDinilai = [];
        foreach ($mahasiswas as $mahasiswa) {
            foreach ($tasks as $task) {
                $score = StudentScore::where('student_id', $mahasiswa->id)
                    ->where('stask_id', $task->id)
                    ->first();

                if (!$score) {
                    $belumDinilai[] = [
                        'mahasiswa_id' => $mahasiswa->id,
                        'mahasiswa_nama' => $mahasiswa->mhs_name,
                        'tugas_id' => $task->id,
                        'tugas_judul' => $task->title
                    ];
                }
            }
        }

        if (empty($belumDinilai)) {
            return [
                'status' => true,
                'pesan' => 'Semua nilai sudah terisi',
                'belum_dinilai' => []
            ];
        } else {
            return [
                'status' => false,
                'pesan' => 'Ada ' . count($belumDinilai) . ' nilai yang belum diisi',
                'belum_dinilai' => $belumDinilai
            ];
        }
    }

    /**
     * Konversi nilai angka ke huruf
     */
    private function konversiNilai($nilai)
    {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'A-';
        } elseif ($nilai >= 75) {
            return 'B+';
        } elseif ($nilai >= 70) {
            return 'B';
        } elseif ($nilai >= 65) {
            return 'B-';
        } elseif ($nilai >= 60) {
            return 'C+';
        } elseif ($nilai >= 55) {
            return 'C';
        } elseif ($nilai >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
