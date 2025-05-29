<?php

namespace App\Http\Controllers\Admin\Pages\Core;

use App\Models\Kelas;
use App\Helpers\roleTrait;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ProgramStudi;
use App\Models\ProgramKuliah;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class KelasManagementController extends Controller
{
    use roleTrait;

    public function index($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['kelas'] = Kelas::where('code', $code)->first();
        $data['taka'] = TahunAkademik::all();
        $data['pstudi'] = ProgramStudi::all();
        $data['proku'] = ProgramKuliah::all();
        
        // Mendapatkan mahasiswa yang sudah terdaftar di kelas
        $data['enrolled_mahasiswa'] = $data['kelas']->mahasiswa;
        
        // Mendapatkan mahasiswa yang belum terdaftar di kelas
        $enrolledIds = $data['enrolled_mahasiswa']->pluck('id')->toArray();
        $data['available_mahasiswa'] = Mahasiswa::whereNotIn('id', $enrolledIds)
            ->where('mhs_stat', 1) // Hanya mahasiswa aktif
            ->get();

        return view('user.admin.master.admin-kelas-management', $data);
    }

    public function addMahasiswa(Request $request, $code)
    {
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:mahasiswas,id',
        ]);

        $kelas = Kelas::where('code', $code)->first();
        
        // Menambahkan mahasiswa ke kelas
        $kelas->mahasiswa()->attach($request->mahasiswa_ids);

        Alert::success('success', 'Mahasiswa berhasil ditambahkan ke kelas');
        return back();
    }

    public function removeMahasiswa(Request $request, $code)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
        ]);

        $kelas = Kelas::where('code', $code)->first();
        
        // Menghapus mahasiswa dari kelas
        $kelas->mahasiswa()->detach($request->mahasiswa_id);

        Alert::success('success', 'Mahasiswa berhasil dihapus dari kelas');
        return back();
    }
}