<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Melakukan absensi dengan kamera wajah
     */
    public function absensiWajah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|max:5000', // Maksimal 5MB
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jadwal_id' => 'required|exists:jadwal_kuliahs,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cek apakah jadwal valid untuk hari ini
        $jadwal = JadwalKuliah::find($request->jadwal_id);
        $today = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();

        // Cek apakah jadwal untuk hari ini
        $jadwalHari = strtolower(Carbon::now()->locale('id')->dayName);
        if ($jadwal->hari != $jadwalHari) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal tidak tersedia untuk hari ini'
            ], 400);
        }

        // Cek apakah dalam rentang waktu absensi (15 menit sebelum dan 30 menit setelah jadwal)
        $jadwalMulai = Carbon::parse($today . ' ' . $jadwal->jam_mulai);
        $batasAwal = (clone $jadwalMulai)->subMinutes(15);
        $batasAkhir = (clone $jadwalMulai)->addMinutes(30);

        if ($now->lt($batasAwal) || $now->gt($batasAkhir)) {
            return response()->json([
                'success' => false,
                'message' => 'Diluar waktu absensi'
            ], 400);
        }

        // Cek apakah sudah absen sebelumnya
        $existingAbsensi = AbsensiMahasiswa::where('author_id', $request->mahasiswa_id)
            ->where('jadkul_code', $jadwal->code)
            ->whereDate('created_at', $today)
            ->first();

        if ($existingAbsensi) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absensi untuk jadwal ini'
            ], 400);
        }

        // Simpan foto absensi
        $foto = $request->file('foto');
        $filename = 'absensi_' . time() . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
        $path = $foto->storeAs('public/absensi', $filename);

        // Buat record absensi
        $absensi = AbsensiMahasiswa::create([
            'author_id' => $request->mahasiswa_id,
            'jadkul_code' => $jadwal->code,
            'dsn_stat' => 'H', // Hadir
            'foto' => $filename,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'keterangan' => 'Absensi via aplikasi mobile',
            'verified_by' => $request->user()->id, // Admin yang memverifikasi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil disimpan',
            'data' => $absensi
        ]);
    }

    /**
     * Mendapatkan jadwal kuliah hari ini
     */
    public function jadwalHariIni(Request $request)
    {
        $mahasiswaId = $request->mahasiswa_id;
        $mahasiswa = Mahasiswa::find($mahasiswaId);
        
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $today = strtolower(Carbon::now()->locale('id')->dayName);
        $jadwal = JadwalKuliah::where('kelas_id', $mahasiswa->kelas_id)
            ->where('hari', $today)
            ->with(['matkul', 'dosen', 'ruang'])
            ->get();

        // Cek status absensi untuk setiap jadwal
        $jadwal->each(function($item) use ($mahasiswaId) {
            $absensi = AbsensiMahasiswa::where('author_id', $mahasiswaId)
                ->where('jadkul_code', $item->code)
                ->whereDate('created_at', Carbon::today())
                ->first();
            
            $item->status_absensi = $absensi ? $absensi->absen_type : null;
        });

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    }

    /**
     * Mendapatkan riwayat absensi mahasiswa
     */
    public function riwayatAbsensi(Request $request)
    {
        $mahasiswaId = $request->mahasiswa_id;
        $absensi = AbsensiMahasiswa::where('author_id', $mahasiswaId)
            ->with(['jadkul.matkul', 'jadkul.dosen'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $absensi
        ]);
    }
}