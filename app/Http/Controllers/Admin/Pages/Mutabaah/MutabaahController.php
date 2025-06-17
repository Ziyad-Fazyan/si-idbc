<?php

namespace App\Http\Controllers\Admin\Pages\Mutabaah;

use App\Models\Mutabaah;
use App\Models\Mahasiswa;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Models\MutabaahField;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\DB;

class MutabaahController extends Controller
{
    use RoleTrait;

    public function index(Request $request)
    {
        $query = Mutabaah::with('mahasiswa')->orderBy('tanggal', 'desc');
        
        // Filter berdasarkan mahasiswa
        if ($request->has('mahasiswa') && $request->mahasiswa) {
            $query->where('author_id', $request->mahasiswa);
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        
        $data['mutabaahs'] = $query->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['mahasiswa'] = Mahasiswa::orderBy('mhs_name')->get();
        
        // Ambil key dari data pertama (jika ada), pastikan bentuk array
        $data['headers'] = $data['mutabaahs']->first() && is_array($data['mutabaahs']->first()->data)
            ? array_keys($data['mutabaahs']->first()->data)
            : [];
            
        // Data untuk modal isi massal
        $data['fields'] = MutabaahField::all();
        $data['mahasiswas'] = Mahasiswa::where('mhs_stat', 1)->orderBy('mhs_name')->get();

        return view('user.musyrif.index', $data);
    }

    public function create()
    {
        $data['fields'] = MutabaahField::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['mahasiswas'] = Mahasiswa::where('mhs_stat', 1)->orderBy('mhs_name')->get();
        return view('user.musyrif.create', $data);
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        $fields = MutabaahField::all();
        $inputData = $request->input('data', []);
        $data = [];
        
        // Persiapkan data mutabaah
        foreach ($fields as $field) {
            if ($field->field_type === 'boolean') {
                $data[$field->field_name] = isset($inputData[$field->field_name]) && $inputData[$field->field_name];
            } else {
                $data[$field->field_name] = $inputData[$field->field_name] ?? null;
            }
        }

        // Cek apakah ini pengisian massal atau single
        if ($request->has('mahasiswa_ids') && is_array($request->mahasiswa_ids)) {
            // Pengisian massal untuk banyak mahasiswa
            DB::beginTransaction();
            try {
                foreach ($request->mahasiswa_ids as $mahasiswaId) {
                    Mutabaah::create([
                        'author_id' => $mahasiswaId,
                        'tanggal' => $request->tanggal,
                        'data' => $data,
                    ]);
                }
                DB::commit();
                return redirect()->route('musyrif.mutabaah.index')->with('success', 'Data mutabaah massal berhasil disimpan');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } else {
            // Validasi untuk pengisian single
            $request->validate([
                'author_id' => 'required|exists:mahasiswas,id',
            ]);
            
            // Pengisian untuk satu mahasiswa
            Mutabaah::create([
                'author_id' => $request->author_id,
                'tanggal' => $request->tanggal,
                'data' => $data,
            ]);

            return redirect()->route('musyrif.mutabaah.index')->with('success', 'Data mutabaah berhasil disimpan');
        }
    }

    public function delete(Mutabaah $mutabaah)
    {
        $mutabaah->delete();
        return redirect()->route('musyrif.mutabaah.index')->with('success', 'Data mutabaah berhasil dihapus');
    }
}
