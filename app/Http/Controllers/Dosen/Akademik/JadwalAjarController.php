<?php

namespace App\Http\Controllers\Dosen\Akademik;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use App\Models\AbsensiDosen;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\FeedBack\FBPerkuliahan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class JadwalAjarController extends Controller
{
    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user();
        $data['jadkul'] = JadwalKuliah::with(['matkul', 'dosen', 'kelas', 'ruang'])
            ->where('dosen_id', $dosenId->id)
            ->latest()
            ->get();

        return view('dosen.pages.jadwal-index', $data);
    }
    public function viewAbsen($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user();
        $data['jadkul'] = JadwalKuliah::where('code', $code)->first();
        if (!$data['jadkul']) {
            Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
            return back();
        }

        // Get students from the class
        $data['student'] = Mahasiswa::whereHas('kelas', function ($q) use ($data) {
            $q->where('kelas.id', $data['jadkul']->kelas_id);
        })->get();
        $data['absen'] = AbsensiMahasiswa::where('jadkul_code', $code)->get();

        // Get lecturer's attendance for this session
        $data['dosen_absen'] = AbsensiDosen::where('jadkul_code', $code)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        return view('dosen.pages.jadwal-absen', $data);
    }
    public function viewFeedBack($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['feedback'] = FBPerkuliahan::where('fb_jakul_code', $code)->get();
        $data['code'] = $code;

        return view('dosen.pages.jadwal-feedback', $data);
    }
    public function updateAbsen(Request $request, $code)
    {

        $absen = AbsensiMahasiswa::where('code', $code)->first();

        $absen->absen_desc = $request->absen_desc;
        $absen->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function storeOrUpdateAbsenMahasiswa(Request $request)
    {
        $request->validate([
            'jadkul_code' => 'required|string',
            'absen_type' => 'required|array',
            'absen_desc' => 'nullable|array',
        ]);

        $jadkul_code = $request->jadkul_code;
        $absen_types = $request->absen_type;
        $absen_descs = $request->absen_desc ?? [];

        foreach ($absen_types as $mahasiswa_id => $absen_type) {
            $absen_desc = isset($absen_descs[$mahasiswa_id]) ? $absen_descs[$mahasiswa_id] : null;

            $absen = AbsensiMahasiswa::where('jadkul_code', $jadkul_code)
                ->where('author_id', $mahasiswa_id)
                ->first();

            if ($absen) {
                $absen->absen_type = $absen_type;
                $absen->absen_desc = $absen_desc;
                $absen->absen_date = now()->toDateString();
                $absen->absen_time = now()->toTimeString();
                $absen->save();
            } else {
                $absen = new AbsensiMahasiswa();
                $absen->jadkul_code = $jadkul_code;
                $absen->author_id = $mahasiswa_id;
                $absen->absen_type = $absen_type;
                $absen->absen_desc = $absen_desc;
                $absen->absen_date = now()->toDateString();
                $absen->absen_time = now()->toTimeString();
                $absen->code = \Illuminate\Support\Str::uuid();
                $absen->save();
            }
        }

        Alert::success('Success', 'Absensi mahasiswa berhasil disimpan');
        return back();
    }
    public function dosenAbsen(Request $request, $code)
    {
        $request->validate([
            'absen_type' => 'required|in:H,I,S',
            'deskripsi_materi' => 'required|string',
        ]);

        try {
            $jadkul = JadwalKuliah::where('code', $code)->first();
            if (!$jadkul) {
                Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
                return back();
            }

            // Check if lecturer already attended today
            $existingAbsen = AbsensiDosen::where('jadkul_code', $code)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if ($existingAbsen) {
                Alert::error('Error', 'Anda sudah melakukan absensi untuk jadwal ini hari ini');
                return back();
            }

            $dosen = Auth::guard('dosen')->user();
            $absensi = new AbsensiDosen;
            $absensi->jadkul_code = $code;
            $absensi->dosen_id = $dosen->id;
            $absensi->absen_type = $request->absen_type;
            $absensi->mata_kuliah = $jadkul->matkul->name;
            $absensi->deskripsi_materi = $request->deskripsi_materi;
            $absensi->absen_date = now()->toDateString();
            $absensi->absen_time = now()->toTimeString();
            $absensi->code = (string) \Illuminate\Support\Str::uuid();

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'absensi_dosen_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/absensi_dosen', $filename);
                $absensi->image = $filename;
            }

            $absensi->save();

            Alert::success('Success', 'Absensi berhasil disimpan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
