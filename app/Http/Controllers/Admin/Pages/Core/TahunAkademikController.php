<?php

namespace App\Http\Controllers\Admin\Pages\Core;

use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class TahunAkademikController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['taka'] = TahunAkademik::all();
        // $data['dosen'] = Dosen::where('dsn_stat', 1)->get();

        return view('user.admin.master.admin-taka-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:999999',
            'semester' => 'required|string',
            'year_start' => 'required|integer',
        ]);

        $taka = new TahunAkademik;
        $taka->name = $request->name;
        $taka->code = $request->code;
        $taka->semester = $request->semester;
        $taka->year_start = $request->year_start;
        $taka->save();

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:999999',
            'semester' => 'required|string',
            'year_start' => 'required|integer',
            'is_active' => 'required|integer',
        ]);

        $taka = TahunAkademik::where('code', $code)->first();
        $taka->name = $request->name;
        $taka->code = $request->code;
        $taka->semester = $request->semester;
        $taka->year_start = $request->year_start;
        $taka->is_active = $request->is_active;
        $taka->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {

        $taka = TahunAkademik::where('code', $code)->first();
        $taka->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
