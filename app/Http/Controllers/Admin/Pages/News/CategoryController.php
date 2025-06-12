<?php

namespace App\Http\Controllers\Admin\Pages\News;

use App\Helpers\RoleTrait;
use App\Helpers\SlugHelper;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['category'] = NewsCategory::all();
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

        $category = new NewsCategory;
        $category->name = $request->name;
        $category->code = Str::random(6);
        $category->slug = SlugHelper::generate($request->name);
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

        $category = NewsCategory::where('code', $code)->first();
        $category->name = $request->name;
        // $category->code = Str::random(6);
        $category->slug = SlugHelper::generate($request->name);
        $category->desc = $request->desc;
        $category->save();

        Alert::success('success', 'Data berhasil diupdate');
        return back();
    }

    public function destroy(Request $request, $code)
    {
        $category = NewsCategory::where('code', $code)->first();
        $category->delete();

        Alert::success('success', 'Data berhasil dihapus');
        return back();
    }
}
