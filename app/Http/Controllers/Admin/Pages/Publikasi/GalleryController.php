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
use Exception; // Tambahkan ini untuk menangkap Exception umum

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

        try {
            // Upload cover image
            $coverPath = $request->file('cover')->store('images/gallery', 'public');

            $album = new GalleryAlbum;
            $album->author_id = Auth::user() ? Auth::user()->id : null; // Handle jika tidak ada user yang login
            $album->name = $request->name;
            $album->slug = SlugHelper::generate($request->name);
            $album->desc = $request->desc;
            $album->cover = $coverPath;

            // Handle multiple file uploads (file_1 to file_20)
            for ($i = 1; $i <= 20; $i++) {
                $image_name_field = 'file_' . $i; // Nama field di form
                if ($request->hasFile($image_name_field)) {
                    $image = $request->file($image_name_field);
                    // Gunakan Storage::putFile untuk menyimpan file dengan nama unik dan aman
                    $fileName = 'images/gallery/' . uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('images/gallery', $image, basename($fileName));
                    $album->$image_name_field = $fileName;
                }
            }
            $album->save();

            Alert::success('Success', 'Data album berhasil ditambahkan!');
            return back();
        } catch (Exception $e) {
            // Jika terjadi error, hapus file cover yang mungkin sudah terupload
            if (isset($coverPath) && Storage::disk('public')->exists($coverPath)) {
                Storage::disk('public')->delete($coverPath);
            }

            // Loop untuk menghapus file_x yang mungkin sudah terupload
            if (isset($album)) {
                for ($i = 1; $i <= 20; $i++) {
                    $image_name_field = 'file_' . $i;
                    if (isset($album->$image_name_field) && Storage::disk('public')->exists($album->$image_name_field)) {
                        Storage::disk('public')->delete($album->$image_name_field);
                    }
                }
            }

            Alert::error('Error', 'Gagal menambahkan data album: ' . $e->getMessage()); // Tampilkan pesan error detail (opsional, untuk debugging)
            // Atau cukup: Alert::error('Error', 'Gagal menambahkan data album. Silakan coba lagi.');
            return back()->withInput(); // Mengembalikan input yang sudah diisi
        }
    }

    public function update(Request $request, $slug)
    {
        $prefix = $this->setPrefix();
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Validasi untuk file_x yang di-upload saat update
            'file_1' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        try {
            $album = GalleryAlbum::where('slug', $slug)->firstOrFail();

            // Handle cover image upload if provided
            if ($request->hasFile('cover')) {
                // Hapus cover lama jika ada dan bukan gambar default
                if ($album->cover && $album->cover != 'gallery_image.png' && Storage::disk('public')->exists($album->cover)) {
                    Storage::disk('public')->delete($album->cover);
                }
                $coverPath = $request->file('cover')->store('images/gallery/', 'public');
                $album->cover = $coverPath;
            }

            // Update other album details
            $album->author_id = Auth::user() ? Auth::user()->id : null; // Pastikan ada user yang login
            $album->name = $request->name;
            $album->slug = SlugHelper::generate($request->name);
            $album->desc = $request->desc;

            // Handle file uploads (file_1 to file_20)
            for ($i = 1; $i <= 20; $i++) {
                $image_name_field = 'file_' . $i;

                if ($request->hasFile($image_name_field)) {
                    $image = $request->file($image_name_field);
                    // Hapus file lama jika ada dan bukan gambar default
                    if (
                        $album->$image_name_field && $album->$image_name_field != 'gallery_image.png' &&
                        $album->$image_name_field != 'images/gallery/album-a.jpg' &&
                        $album->$image_name_field != 'images/gallery/album-b.jpg' &&
                        $album->$image_name_field != 'images/gallery/album-c.jpg' &&
                        Storage::disk('public')->exists($album->$image_name_field)
                    ) {
                        Storage::disk('public')->delete($album->$image_name_field);
                    }
                    $fileName = 'images/gallery/' . uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('images/gallery', $image, basename($fileName));
                    $album->$image_name_field = $fileName;
                }
            }

            $album->save();

            Alert::success('Success', 'Data album berhasil diperbarui!');
            return redirect()->route($prefix . 'publish.album-edit', $album->slug);
        } catch (Exception $e) {
            Alert::error('Error', 'Gagal memperbarui data album: ' . $e->getMessage()); // Tampilkan pesan error detail (opsional)
            // Atau cukup: Alert::error('Error', 'Gagal memperbarui data album. Silakan coba lagi.');
            return back()->withInput();
        }
    }

    public function destroy($slug)
    {
        try {
            $album = GalleryAlbum::where('slug', $slug)->firstOrFail();

            // Hapus file cover
            if ($album->cover && $album->cover != 'gallery_image.png' && Storage::disk('public')->exists($album->cover)) {
                Storage::disk('public')->delete($album->cover);
            }

            // Hapus semua file_x
            for ($i = 1; $i <= 20; $i++) {
                $image_name_field = 'file_' . $i;
                if (
                    $album->$image_name_field && $album->$image_name_field != 'gallery_image.png' &&
                    $album->$image_name_field != 'images/gallery/album-a.jpg' &&
                    $album->$image_name_field != 'images/gallery/album-b.jpg' &&
                    $album->$image_name_field != 'images/gallery/album-c.jpg' &&
                    Storage::disk('public')->exists($album->$image_name_field)
                ) {
                    Storage::disk('public')->delete($album->$image_name_field);
                }
            }

            $album->delete();

            Alert::success('Success', 'Album berhasil dihapus!');
            return back();
        } catch (Exception $e) {
            Alert::error('Error', 'Gagal menghapus album: ' . $e->getMessage());
            return back();
        }
    }
}
