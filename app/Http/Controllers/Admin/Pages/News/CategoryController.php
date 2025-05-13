<?php

namespace App\Http\Controllers\Admin\Pages\News;

use App\Helper\roleTrait;
use Illuminate\Support\Str;
use App\Models\newsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['web'] = webSettings::where('id', 1)->first();

        $data['category'] = newsCategory::all();
        $data['prefix'] = $this->setPrefix();

        return view('user.pages.news-category-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'desc' => 'required',
            ],
            [
                'name.required' => 'Nama Kategori wajib diisi.',
                'desc.required' => 'Deskripsi Kategori wajib diisi.',
            ]
        );

        $category = new newsCategory;
        $category->name = $request->name;
        $category->code = Str::random(6);
        $category->slug = Str::slug($request->name);
        $category->desc = $request->desc;
        $category->save();

        Alert::success('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate(
            [
                'name' => 'required',
                'desc' => 'required',
            ],
            [
                'name.required' => 'Nama Kategori wajib diisi.',
                'desc.required' => 'Deskripsi Kategori wajib diisi.',
            ]
        );

        $category = newsCategory::where('code', $code)->first();
        $category->name = $request->name;
        // $category->code = Str::random(6);
        $category->slug = Str::slug($request->name);
        $category->desc = $request->desc;
        $category->save();

        Alert::success('success', 'Data berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {
        $category = newsCategory::where('code', $code)->first();
        $category->delete();

        Alert::success('success', 'Data berhasil dihapus');
        return back();
    }
}
