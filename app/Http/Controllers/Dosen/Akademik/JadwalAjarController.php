<?php

namespace App\Http\Controllers\Dosen\Akademik;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\FeedBack\FBPerkuliahan;
use RealRashid\SweetAlert\Facades\Alert;


class JadwalAjarController extends Controller
{
    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user();
        $data['jadkul'] = JadwalKuliah::where('dosen_id', $dosenId->id)->latest()->get();

        return view('dosen.pages.jadwal-index', $data);
    }
    public function viewAbsen($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $dosenId = Auth::guard('dosen')->user();
        $jadkul = JadwalKuliah::where('code', $code)->first();
        $data['kelas'] = Kelas::where('code', $code)->first();
        $data['student'] = $data['kelas']->mahasiswa;
        $data['absen'] = AbsensiMahasiswa::where('jadkul_code', $code)->get();

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
}
