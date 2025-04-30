<?php

namespace App\Http\Controllers\Admin\Pages\Core;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Helper\roleTrait;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\ProgramKuliah;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['kelas'] = Kelas::all();
        $data['taka'] = TahunAkademik::all();
        $data['pstudi'] = ProgramStudi::all();
        $data['proku'] = ProgramKuliah::all();
        $data['dosen'] = Dosen::all();

        return view('user.admin.master.admin-kelas-index', $data);
    }
    public function viewMahasiswa($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $class = Kelas::where('code', $code)->first();
        $data['kelas'] = Kelas::where('code', $code)->first();
        $data['taka'] = TahunAkademik::all();
        $data['mahasiswa'] = Mahasiswa::where('class_id', $class->id)->get();
        $data['pstudi'] = ProgramStudi::all();
        $data['proku'] = ProgramKuliah::all();
        $data['dosen'] = Dosen::all();

        // dd($data['mahasiswa']);

        return view('user.admin.master.admin-kelas-view-mahasiswa', $data);
    }
    public function cetakMahasiswa($code)
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $class = Kelas::where('code', $code)->first();
        $data['kelas'] = Kelas::where('code', $code)->first();
        $data['mahasiswa'] = Mahasiswa::where('class_id', $class->id)->get();

        return view('base.cetak.cetak-data-kehadiran', $data);
        // $pdf = PDF::loadView('base.cetak.cetak-data-kehadiran', $data);
       
        return $pdf->download('Daftar-Absen-'.$jadwal->matkul->name.'-'.$jadwal->pert_id.'-'.$request->kode_kelas.'.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'taka_id' => 'required|integer',
            'dosen_id' => 'required|integer',
            'proku_id' => 'required|integer',
            'capacity' => 'required|integer',
            'pstudi_id' => 'required|integer',
        ]);

        $kelas = new Kelas;
        $kelas->name = $request->name;
        $kelas->code = $request->code;
        $kelas->taka_id = $request->taka_id;
        $kelas->dosen_id = $request->dosen_id;
        $kelas->proku_id = $request->proku_id;
        $kelas->capacity = $request->capacity;
        $kelas->pstudi_id = $request->pstudi_id;
        $kelas->save();

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'taka_id' => 'required|integer',
            'dosen_id' => 'required|integer',
            'proku_id' => 'required|integer',
            'capacity' => 'required|integer',
            'pstudi_id' => 'required|integer',
        ]);

        $kelas = Kelas::where('code', $code)->first();
        $kelas->name = $request->name;
        $kelas->code = $request->code;
        $kelas->taka_id = $request->taka_id;
        $kelas->dosen_id = $request->dosen_id;
        $kelas->proku_id = $request->proku_id;
        $kelas->capacity = $request->capacity;
        $kelas->pstudi_id = $request->pstudi_id;
        $kelas->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {

        $kelas = Kelas::where('code', $code)->first();
        $kelas->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
