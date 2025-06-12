<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Models\Gedung;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class GedungController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['gedung'] = Gedung::all();
        $data['gedung'] = Gedung::paginate(10);

        return view('user.admin.master-inventory.gedung.index', $data);
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
        try {
            $gedung = Gedung::where('code', $code)->first();

            if ($gedung->ruangs()->exists()) {
                Alert::error('Error', 'Gedung tidak dapat dihapus karena masih terkait dengan data Ruang!');
                return back();
            }

            $gedung->delete();

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
