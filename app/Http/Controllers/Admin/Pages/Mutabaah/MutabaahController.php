<?php

namespace App\Http\Controllers\Admin\Pages\Mutabaah;

use App\Models\Mutabaah;
use App\Models\Mahasiswa;
use App\Helpers\roleTrait;
use Illuminate\Http\Request;
use App\Models\MutabaahField;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;

class MutabaahController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['mutabaahs'] = Mutabaah::with('mahasiswa')->orderBy('tanggal', 'desc')->get();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['mahasiswa'] = Mahasiswa::orderBy('mhs_name')->get();

        return view('user.musyrif.index', $data);
    }

    public function create()
    {
        $data['fields'] = MutabaahField::all();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['mahasiswas'] = Mahasiswa::where('mhs_stat', 1)->orderBy('mhs_name')->get();
        return view('user.musyrif.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:mahasiswas,id',
            'tanggal' => 'required|date',
        ]);

        $fields = MutabaahField::all();

        $inputData = $request->input('data', []);

        $data = [];
        foreach ($fields as $field) {
            if ($field->field_type === 'boolean') {
                $data[$field->field_name] = isset($inputData[$field->field_name]) && $inputData[$field->field_name];
            } else {
                $data[$field->field_name] = $inputData[$field->field_name] ?? null;
            }
        }

        Mutabaah::create([
            'author_id' => $request->author_id,
            'tanggal' => $request->tanggal,
            'data' => $data,
        ]);

        return redirect()->route('musyrif.mutabaah.index')->with('success', 'Data mutabaah berhasil disimpan');
    }

    public function delete(Mutabaah $mutabaah)
    {
        $mutabaah->delete();
        return redirect()->route('musyrif.mutabaah.index')->with('success', 'Data mutabaah berhasil dihapus');
    }
}
