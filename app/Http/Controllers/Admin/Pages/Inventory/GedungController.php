<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Models\Gedung;
use App\Helpers\roleTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class GedungController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['gedung'] = Gedung::all();

        return view('user.admin.master-inventory.admin-gedung-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3',
        ]);

        $gedung = new Gedung;
        $gedung->name = $request->name;
        $gedung->code = $request->code;
        $gedung->save();

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3',
        ]);

        $gedung = Gedung::where('code', $code)->first();
        $gedung->name = $request->name;
        $gedung->code = $request->code;
        $gedung->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {

        $gedung = Gedung::where('code', $code)->first();
        $gedung->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
