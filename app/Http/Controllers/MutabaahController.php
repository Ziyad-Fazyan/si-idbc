<?php

namespace App\Http\Controllers;

use App\Models\Mutabaah;
use App\Models\MutabaahField;
use Illuminate\Http\Request;

class MutabaahController extends Controller
{
    public function index()
    {
        $mutabaahs = Mutabaah::where('user_id', auth()->id())->orderBy('tanggal', 'desc')->get();
        return view('mutabaah.index', compact('mutabaahs'));
    }

    public function create()
    {
        $fields = MutabaahField::all();
        return view('mutabaah.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $fields = MutabaahField::all();

        $data = [];
        foreach ($fields as $field) {
            if ($field->field_type === 'boolean') {
                $data[$field->field_name] = $request->has($field->field_name);
            } else {
                $data[$field->field_name] = $request->input($field->field_name);
            }
        }

        Mutabaah::create([
            'user_id' => auth()->id(),
            'tanggal' => $request->tanggal,
            'data' => $data,
        ]);

        return redirect()->route('mutabaah.index')->with('success', 'Data mutabaah berhasil disimpan');
    }
}
