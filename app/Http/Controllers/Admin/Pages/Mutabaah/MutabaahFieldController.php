<?php

namespace App\Http\Controllers\Admin\Pages\Mutabaah;

use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Models\MutabaahField;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;

class MutabaahFieldController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['fields'] = MutabaahField::all();
        $data['prefix'] = $this->setPrefix();
        return view('user.musyrif.fields.index', $data);
    }

    public function create()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();

        return view('user.musyrif.fields.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required|unique:mutabaah_fields,field_name',
            'label' => 'required',
            'field_type' => 'required|in:boolean,text,integer',
        ]);

        MutabaahField::create($request->all());

        return redirect()->route('musyrif.mutabaah-fields.index')->with('success', 'Field berhasil ditambahkan');
    }

    public function destroy(MutabaahField $mutabaahField)
    {
        $mutabaahField->delete();
        return redirect()->route('musyrif.mutabaah-fields.index')->with('success', 'Field berhasil dihapus');
    }
}
