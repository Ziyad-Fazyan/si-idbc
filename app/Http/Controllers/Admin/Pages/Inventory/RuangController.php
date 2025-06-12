<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Models\Ruang;
use App\Models\Gedung;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class RuangController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['gedung'] = Gedung::all();
        $data['ruang'] = Ruang::all();

        return view('user.admin.master-inventory.ruang.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|integer',
            'type' => 'required|integer',
            'floor' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5',
        ]);

        $ruang = new Ruang;
        $ruang->gedung_id = $request->gedung_id;
        $ruang->type = $request->type;
        $ruang->floor = $request->floor;
        $ruang->name = $request->name;
        $ruang->code = $request->code;
        $ruang->save();

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'gedung_id' => 'required|integer',
            'type' => 'required|integer',
            'floor' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5',
        ]);

        $ruang = Ruang::where('code', $code)->first();
        $ruang->gedung_id = $request->gedung_id;
        $ruang->type = $request->type;
        $ruang->floor = $request->floor;
        $ruang->name = $request->name;
        $ruang->code = $request->code;
        $ruang->save();

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {
        try {
            $ruang = Ruang::where('code', $code)->first();

            if ($ruang->barang()->exists()) {
                Alert::error('Error', 'Ruangan tidak dapat dihapus karena masih terkait dengan Barang!');
                return back();
            }

            $ruang->delete();

            Alert::success('Success', 'Data Gedung berhasil dihapus');
            return back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Data Gedung tidak ditemukan!');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return back();
        }
    }
}
