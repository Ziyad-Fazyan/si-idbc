<?php

namespace App\Http\Controllers\Admin\Pages\Publikasi;

use App\Helpers\RoleTrait;
use App\Helpers\SlugHelper;
use Illuminate\Support\Str;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['album'] = GalleryAlbum::latest()->paginate(24);

        return view('user.pages.publikasi.gallery-index', $data);
    }

    public function search(Request $request)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $search = $request->input('search');
        $album = GalleryAlbum::where('name', 'like', "%$search%")->paginate(24);

        return view('user.pages.publikasi.gallery-index', ['album' => $album], $data);
    }

    public function create()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();

        return view('user.pages.publikasi.gallery-create', $data);
    }
    public function show($slug)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['album'] = GalleryAlbum::where('slug', $slug)->first();

        return view('user.pages.publikasi.gallery-show', $data);
    }
    public function edit($slug)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['album'] = GalleryAlbum::where('slug', $slug)->first();

        return view('user.pages.publikasi.gallery-edit', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_1' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_2' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_3' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_4' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_5' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_6' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_7' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_8' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_9' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_10' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_11' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_12' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_13' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_14' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_15' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_16' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_17' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_18' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_19' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_20' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $coverPath = $request->file('cover')->store('images/gallery', 'public');

        $album = new GalleryAlbum;
        $album->author_id = Auth::user()->id;
        $album->name = $request->name;
        $album->slug = SlugHelper::generate($request->name);
        $album->desc = $request->desc;
        $album->cover = $coverPath;
        for ($i = 1; $i <= 20; $i++) {
            $image_name = 'file_' . $i;
            if ($request->hasFile($image_name)) {

                $image = $request->file($image_name);
                $name = 'images/gallery/' . uniqid() . ('file_' . $i) . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/gallery/');
                $image->move($destinationPath, $name);
                if ($album->$image_name != 'gallery_image.png') {
                    File::delete($destinationPath . '/' . $album->$image_name); // hapus gambar lama
                }

                $album->$image_name = $name;
            }
        }
        $album->save(); // Pastikan album disimpan terlebih dahulu



        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }
    public function update(Request $request, $slug)
    {
        $prefix = $this->setPrefix();
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $album = GalleryAlbum::where('slug', $slug)->firstOrFail();

        // Handle cover image upload if provided
        if ($request->hasFile('cover')) {
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $coverPath = $request->file('cover')->store('images/gallery/', 'public');

            // Delete old cover if exists
            if ($album->cover && $album->cover != 'gallery_image.png') {
                Storage::disk('public')->delete($album->cover);
            }

            $album->cover = $coverPath;
        }

        // Update other album details
        $album->author_id = Auth::user()->id;
        $album->name = $request->name;
        $album->slug = SlugHelper::generate($request->name);
        $album->desc = $request->desc;

        // Handle file uploads (file_1 to file_20)
        for ($i = 1; $i <= 20; $i++) {
            $image_name = 'file_' . $i;

            if ($request->hasFile($image_name)) {
                $request->validate([
                    $image_name => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $image = $request->file($image_name);
                $name = 'images/gallery/' . uniqid() . '_' . $image_name . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/gallery/');
                $image->move($destinationPath, $name);

                // Delete old file if exists and is not default
                if ($album->$image_name && $album->$image_name != 'gallery_image.png' && $album->$image_name != 'images/gallery/album-a.jpg' && $album->$image_name != 'images/gallery/album-b.jpg' && $album->$image_name != 'images/gallery/album-c.jpg') {
                    Storage::disk('public')->delete($album->$image_name);
                }

                $album->$image_name = $name;
            }
        }

        $album->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return redirect()->route($prefix . 'publish.album-edit', $album->slug);
    }
}
