<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AbsensiMahasiswa;
use App\Models\JadwalKuliah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mendapatkan jadwal kuliah hari ini
     */
    public function jadwalHariIni(Request $request)
    {
        try {
            $now = Carbon::now();
            $hari = strtolower($now->format('l'));

            $jadwal = JadwalKuliah::with(['mataKuliah', 'kelas', 'ruang'])
                ->where('hari', $hari)
                ->orderBy('jam_mulai')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'mata_kuliah' => $item->mataKuliah->nama,
                        'kelas' => $item->kelas->nama,
                        'ruang' => $item->ruang->nama,
                        'jam_mulai' => $item->jam_mulai,
                        'jam_selesai' => $item->jam_selesai
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan jadwal',
                'data' => $jadwal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan riwayat absensi mahasiswa
     */
    public function riwayatAbsensi(Request $request)
    {
        try {
            $mahasiswaId = $request->query('mahasiswa_id');
            $tanggalMulai = $request->query('tanggal_mulai');
            $tanggalSelesai = $request->query('tanggal_selesai');

            $query = AbsensiMahasiswa::with(['jadwalKuliah.mataKuliah'])
                ->where('mahasiswa_id', $mahasiswaId);

            if ($tanggalMulai && $tanggalSelesai) {
                $query->whereBetween('created_at', [
                    Carbon::parse($tanggalMulai)->startOfDay(),
                    Carbon::parse($tanggalSelesai)->endOfDay()
                ]);
            }

            $riwayat = $query->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'mata_kuliah' => $item->jadwalKuliah->mataKuliah->nama,
                        'tanggal' => Carbon::parse($item->created_at)->format('Y-m-d'),
                        'jam' => Carbon::parse($item->created_at)->format('H:i:s'),
                        'status' => $item->status,
                        'foto' => url('storage/' . $item->foto)
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan riwayat absensi',
                'data' => $riwayat
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}