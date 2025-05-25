<?php

namespace App\Http\Controllers;

use App\Models\MutabaahField;
use Illuminate\Http\Request;

class MutabaahFieldController extends Controller
{
    public function index()
    {
        $fields = MutabaahField::all();
        return view('mutabaah_fields.index', compact('fields'));
    }

    public function create()
    {
        return view('mutabaah_fields.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required|unique:mutabaah_fields,field_name',
            'label' => 'required',
            'field_type' => 'required|in:boolean,text,integer',
        ]);

        MutabaahField::create($request->all());

        return redirect()->route('mutabaah-fields.index')->with('success', 'Field berhasil ditambahkan');
    }

    public function destroy(MutabaahField $mutabaahField)
    {
        $mutabaahField->delete();
        return redirect()->route('mutabaah-fields.index')->with('success', 'Field berhasil dihapus');
    }
}
