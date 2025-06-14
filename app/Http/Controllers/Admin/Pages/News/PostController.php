<?php

namespace App\Http\Controllers\Admin\Pages\News;

use App\Models\NewsPost;
use App\Helpers\RoleTrait;
use App\Helpers\SlugHelper;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['posts'] = NewsPost::latest()->get();
        $data['prefix'] = $this->setPrefix();

        return view('user.pages.news-posts-index', $data);
    }

    public function view($code)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['post'] = NewsPost::where('code', $code)->first();
        $data['category'] = NewsCategory::all();

        $data['prefix'] = $this->setPrefix();

        return view('user.pages.news-posts-view', $data);
    }

    public function create()
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['posts'] = NewsPost::all();
        $data['category'] = NewsCategory::all();
        $data['prefix'] = $this->setPrefix();

        return view('user.pages.news-posts-create', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'image' => 'required|mimes:webp,jpg,jpeg,png|max:2048',
                'content' => 'required',
                'keywords' => 'required',
                'metadesc' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Judul postingan tidak boleh kosong.',
                'image.required' => 'Gambar tidak boleh kosong.',
                'image.mimes' => 'Format file wajib WEBP, JPG, JPEG atau PNG.',
                'image.max' => 'Format file tidak boleh lebih dari 2MB.',
                'content.required' => 'Isi Konten tidak boleh kosong.',
                'keywords.required' => 'Keywords tidak boleh kosong.',
                'metadesc.required' => 'Deksripsi Meta tidak boleh kosong.',
                'category_id.required' => 'Kategori tidak boleh kosong.',
            ]
        );

        $post = new NewsPost;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'post-' . $post->slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/news');

            // Membuat direktori jika belum ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            // Mengompres gambar dan menyimpannya
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image->getRealPath());
            $image->scaleDown(height: 300)->save($destinationPath . '/' . $name);

            // Menyimpan nama file gambar ke database
            $post->image = "news/" . $name;
        }
        $post->author_id = Auth::user()->id;
        $post->name = $request->name;
        $post->slug = SlugHelper::generate($request->name);
        $post->code = Str::random(6);
        $post->content = $request->content;
        $post->keywords = $request->keywords;
        $post->metadesc = $request->metadesc;
        $post->category_id = $request->category_id;
        $post->save();


        Alert::success('Success', 'Post berhasil ditambahkan.');
        return back();
    }
    public function update(Request $request, $code)
    {
        $request->validate(
            [
                'name' => 'required',
                'image' => 'mimes:webp,jpg,jpeg,png|max:2048',
                'content' => 'required',
                'keywords' => 'required',
                'metadesc' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Judul postingan tidak boleh kosong.',
                'image.required' => 'Gambar tidak boleh kosong.',
                'image.mimes' => 'Format file wajib WEBP, JPG, JPEG atau PNG.',
                'image.max' => 'Format file tidak boleh lebih dari 2MB.',
                'content.required' => 'Isi Konten tidak boleh kosong.',
                'keywords.required' => 'Keywords tidak boleh kosong.',
                'metadesc.required' => 'Deksripsi Meta tidak boleh kosong.',
                'category_id.required' => 'Kategori tidak boleh kosong.',
            ]
        );

        $post = NewsPost::where('code', $code)->first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'post-' . $post->slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/news');

            // Membuat direktori jika belum ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Hapus foto lama jika ada
            if ($post->image && File::exists(storage_path('app/public/images/' . $post->image))) {
                File::delete(storage_path('app/public/images/' . $post->image));
            }

            // Mengompres gambar dan menyimpannya
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image->getRealPath());
            $image->scaleDown(height: 300)->save($destinationPath . '/' . $name);

            // Menyimpan nama file gambar ke database
            $post->image = "news/" . $name;
        }
        $post->author_id = Auth::user()->id;
        $post->name = $request->name;
        $post->slug = SlugHelper::generate($request->name);
        $post->content = $request->content;
        $post->keywords = $request->keywords;
        $post->metadesc = $request->metadesc;
        $post->category_id = $request->category_id;
        $post->save();


        Alert::success('Success', 'Post berhasil diupdate.');
        return back();
    }

    public function destroy(Request $request, $slug)
    {
        $destinationPaths = storage_path('app/public/images/');

        $post = NewsPost::where('slug', $slug)->first();
        if ($post) {
            if ($post->image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . $post->image); // hapus gambar lama
            }

            $post->delete();
            Alert::success('Success', 'Post berhasil dihapus.');
            return back();
        } else {
            Alert::error('Error', 'Post not found.');
            return back();
        }
    }
}
