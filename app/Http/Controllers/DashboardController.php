<?php

namespace App\Http\Controllers;

use App\Models\AbsensiMahasiswa;
use App\Models\JadwalKuliah;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

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
        
        // Return JSON if AJAX request
        $isAjax = $request->ajax();

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
        $hadir = $absensiHariIni->filter(function($record) {
            return $record->getRawOriginal('absen_type') === 'H';
        })->count();
        
        $tidakHadir = $absensiHariIni->filter(function($record) {
            return in_array($record->getRawOriginal('absen_type'), ['S', 'I']);
        })->count();

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
                    'status' => $absensi->getRawOriginal('absen_type') ?? 'Unknown',
                    'waktu' => Carbon::parse($absensi->created_at)->format('H:i'),
                    'matkul' => $absensi->jadkul->matkul->name ?? 'Unknown',
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

                // Pastikan kita mengakses atribut absen_type dengan benar
                $hadir = $absensi->filter(function($record) {
                    return $record->getRawOriginal('absen_type') === 'H';
                })->count();
                
                $attendanceRate = $totalMhs > 0 ? ($hadir / $totalMhs) * 100 : 0;

                return [
                    'id' => $kelas->id,
                    'name' => $kelas->name,
                    'icon' => '💻',
                    'attendance_rate' => round($attendanceRate),
                    'grade' => $this->calculateGrade($attendanceRate)
                ];
            })
            ->filter()
            ->sortByDesc('attendance_rate')
            ->take(3)
            ->values()
            ->toArray();

        // Get student of the week (based on highest attendance and/or scores)
        $studentOfWeek = Mahasiswa::with(['kelas'])
            ->whereHas('kelas')
            ->withCount(['absensiMahasiswa as attendance_count' => function ($query) {
                $query->where('absen_type', 'H')
                    ->whereDate('absen_date', '>=', Carbon::now()->subDays(7));
            }])
            ->orderBy('attendance_count', 'desc')
            ->first();
            
        // Get multiple students of the week for slider
        $studentsOfWeek = Mahasiswa::with(['kelas'])
            ->whereHas('kelas')
            ->withCount(['absensiMahasiswa as attendance_count' => function ($query) {
                $query->where('absen_type', 'H')
                    ->whereDate('absen_date', '>=', Carbon::now()->subDays(7));
            }])
            ->orderBy('attendance_count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'mhs_name' => $student->mhs_name,
                    'mhs_nim' => $student->mhs_nim,
                    'mhs_image' => $student->mhs_image,
                    'kelas_name' => $student->kelas->first() ? $student->kelas->first()->name : null,
                    'attendance_count' => $student->attendance_count
                ];
            });

        // Get current active session and upcoming sessions
        $now = Carbon::now();
        $currentTime = $now->format('H:i:s');

        // Find current active session
        $activeSession = JadwalKuliah::with(['matkul', 'dosen'])
            ->where('days_id', $dayOfWeekIso)
            ->where('start', '<=', $currentTime)
            ->where('ended', '>=', $currentTime)
            ->first();
            
        // Get multiple active sessions for slider
        $activeSessions = JadwalKuliah::with(['matkul', 'dosen'])
            ->where('days_id', $dayOfWeekIso)
            ->where(function($query) use ($currentTime) {
                $query->where('start', '<=', $currentTime)
                      ->where('ended', '>=', $currentTime);
            })
            ->orWhere(function($query) use ($currentTime, $dayOfWeekIso) {
                $query->where('days_id', $dayOfWeekIso)
                      ->where('start', '<=', Carbon::parse($currentTime)->addHours(1))
                      ->where('start', '>=', $currentTime);
            })
            ->orderBy('start')
            ->take(3)
            ->get();

        // Find upcoming sessions
        $upcomingSessions = JadwalKuliah::with(['matkul', 'dosen'])
            ->where('days_id', $dayOfWeekIso)
            ->where('start', '>', $currentTime)
            ->orderBy('start')
            ->take(2)
            ->get();

        $data = compact(
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
            'kelasPerformance',
            'studentOfWeek',
            'studentsOfWeek',
            'activeSession',
            'activeSessions',
            'upcomingSessions'
        );
        
        if ($isAjax) {
            return response()->json($data);
        }
        
        return view('dashboard', $data);
    }
}