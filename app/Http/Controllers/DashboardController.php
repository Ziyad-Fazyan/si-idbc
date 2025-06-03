<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\JadwalKuliah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Calculate grade based on attendance rate
     * 
     * @param float $attendanceRate
     * @return string
     */
    private function calculateGrade($attendanceRate)
    {
        if ($attendanceRate >= 90) return 'A';
        if ($attendanceRate >= 80) return 'B';
        if ($attendanceRate >= 70) return 'C';
        if ($attendanceRate >= 60) return 'D';
        return 'E';
    }
    public function index(Request $request)
    {
        // Get filter parameters
        $kelasId = $request->input('kelas_id');
        $gender = $request->input('gender');

        // Get current date
        $today = Carbon::now();
        $dayOfWeekIso = $today->dayOfWeekIso; // 1 (Monday) through 7 (Sunday)
        $currentDate = $today->toDateString();

        // Get all classes for filter dropdown
        $kelas = Kelas::all();

        // Build query for students based on filters
        $mahasiswaQuery = Mahasiswa::query();

        if ($kelasId) {
            $mahasiswaQuery->whereHas('kelas', function ($query) use ($kelasId) {
                $query->where('kelas.id', $kelasId);
            });
        }

        if ($gender) {
            $mahasiswaQuery->where('mhs_gend', $gender);
        }

        // Count total students based on filters
        $totalMahasiswa = $mahasiswaQuery->count();

        // Get filtered student IDs
        $mahasiswaIds = $mahasiswaQuery->pluck('id')->toArray();

        // Get today's attendance records for filtered students
        $absensiHariIni = AbsensiMahasiswa::whereIn('author_id', $mahasiswaIds)
            ->whereHas('jadkul', function ($query) use ($dayOfWeekIso) {
                $query->where('days_id', $dayOfWeekIso);
            })
            ->whereDate('absen_date', $currentDate)
            ->get();

        // Count present and absent students
        $hadir = $absensiHariIni->where('absen_type', 'H')->count();
        $tidakHadir = $absensiHariIni->whereIn('absen_type', ['S', 'I'])->count();

        // Calculate students who haven't attended yet
        $belumAbsen = $totalMahasiswa - ($hadir + $tidakHadir);

        // Get detailed attendance data with student information
        $detailAbsensi = AbsensiMahasiswa::with(['mahasiswa', 'jadkul.matkul'])
            ->whereIn('author_id', $mahasiswaIds)
            ->whereHas('jadkul', function ($query) use ($dayOfWeekIso) {
                $query->where('days_id', $dayOfWeekIso);
            })
            ->whereDate('absen_date', $currentDate)
            ->get()
            ->map(function ($absensi) {
                return [
                    'id' => $absensi->id,
                    'nama' => $absensi->mahasiswa->mhs_name ?? 'Unknown',
                    'nim' => $absensi->mahasiswa->mhs_nim ?? '-',
                    'gender' => $absensi->mahasiswa->mhs_gend ?? '-',
                    'status' => $absensi->getRawAbsenTypeAttribute(),
                    'waktu' => Carbon::parse($absensi->created_at)->format('H:i'),
                    'matkul' => $absensi->jadkul->matkul->makul_name ?? 'Unknown',
                    'image' => $absensi->image ?? null,
                ];
            });

        // Get today's schedule for Main Video/Content Area
        $jadwalHariIni = JadwalKuliah::with(['matkul', 'dosen'])
            ->where('days_id', $dayOfWeekIso)
            ->orderBy('start')
            ->get();

        // Get featured course for Main Video/Content Area
        $featuredCourse = $jadwalHariIni->first();

        // Get class performance data
        $classPerformance = [];
        
        // Get top 3 classes with highest attendance rate
        $kelasPerformance = Kelas::withCount(['mahasiswa'])
            ->get()
            ->map(function ($kelas) use ($currentDate, $dayOfWeekIso) {
                $totalMhs = $kelas->mahasiswa_count;
                if ($totalMhs == 0) return null;
                
                $mahasiswaIds = $kelas->mahasiswa()->pluck('mahasiswas.id')->toArray();
                
                $absensi = AbsensiMahasiswa::whereIn('author_id', $mahasiswaIds)
                    ->whereHas('jadkul', function ($query) use ($dayOfWeekIso) {
                        $query->where('days_id', $dayOfWeekIso);
                    })
                    ->whereDate('absen_date', $currentDate)
                    ->get();
                
                $hadir = $absensi->where('absen_type', 'H')->count();
                $attendanceRate = $totalMhs > 0 ? ($hadir / $totalMhs) * 100 : 0;
                
                return [
                    'id' => $kelas->id,
                    'name' => $kelas->kelas_name,
                    'icon' => '💻', // Default icon
                    'attendance_rate' => round($attendanceRate),
                    'grade' => $this->calculateGrade($attendanceRate)
                ];
            })
            ->filter()
            ->sortByDesc('attendance_rate')
            ->take(3)
            ->values()
            ->toArray();

        return view('dashboard', compact(
            'totalMahasiswa', 
            'hadir', 
            'tidakHadir', 
            'belumAbsen', 
            'kelas', 
            'kelasId', 
            'gender',
            'detailAbsensi',
            'jadwalHariIni',
            'featuredCourse',
            'kelasPerformance'
        ));
    }
}
