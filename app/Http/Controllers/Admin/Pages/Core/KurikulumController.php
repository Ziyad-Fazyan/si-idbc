<?php

namespace App\Http\Controllers\Admin\Pages\Core;

use App\Models\Dosen;
use App\Helpers\RoleTrait;
use App\Models\Kurikulum;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class KurikulumController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['kurikulum'] = Kurikulum::all();

        return view('user.admin.master.admin-kurikulum-index', $data);
    }
    public function view($id)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['kuri'] = Kurikulum::all();
        $data['taka'] = TahunAkademik::all();
        $data['pstudi'] = ProgramStudi::all();
        $data['dosen'] = Dosen::all();
        $data['matkul'] = MataKuliah::where('kuri_id', $id)->get();

        return view('user.admin.master.admin-matkul-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3',
            'desc' => 'required|string|max:4192',
            'year_start' => 'required|integer',
            'year_ended' => 'required|integer',
        ]);

        $kurikulum = new Kurikulum;
        $kurikulum->name = $request->name;
        $kurikulum->code = $request->code;
        $kurikulum->desc = $request->desc;
        $kurikulum->year_start = $request->year_start;
        $kurikulum->year_ended = $request->year_ended;
        $kurikulum->save();

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3',
            'desc' => 'required|string|max:4192',
            'year_start' => 'required|integer',
            'year_ended' => 'required|integer',
        ]);

        $kurikulum = Kurikulum::where('code', $code)->first();
        $kurikulum->name = $request->name;
        $kurikulum->code = $request->code;
        $kurikulum->desc = $request->desc;
        $kurikulum->year_start = $request->year_start;
        $kurikulum->year_ended = $request->year_ended;

        $kurikulum->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {

        $kurikulum = Kurikulum::where('code', $code)->first();
        $kurikulum->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
