<?php

namespace App\Http\Controllers\Admin\Pages\Publikasi;

use App\Helper\roleTrait;
use App\Models\docsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class DocumentController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['docs'] = docsResource::orderBy('created_at', 'desc')->get();

        return view('user.pages.publikasi.document-index', $data);
    }
    public function create()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['docs'] = docsResource::latest();

        return view('user.pages.publikasi.document-create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'link' => 'nullable|max:255|url',
            'path' => 'nullable|mimes:pdf|max:8192',
        ]);

        $docs = new DocsResource;
        $docs->author_id = Auth::user()->id;
        $docs->name = $request->name;
        $docs->link = $request->link;
        $docs->code = uniqid();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = 'images/document/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/document/');
            $file->move($destinationPath, $fileName);

            // Hapus file lama jika sudah ada
            if (!empty($docs->cover) && $docs->cover != 'gallery_image.png') {
                File::delete($destinationPath . '/' . $docs->cover);
            }

            $docs->cover = $fileName;
        }
        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $fileName = 'document/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/document/');
            $file->move($destinationPath, $fileName);

            // Hapus file lama jika sudah ada
            if (!empty($docs->path) && $docs->path != 'docs-demo.pdf') {
                File::delete($destinationPath . '/' . $docs->path);
            }

            $docs->path = $fileName;
        }

        $docs->save();

        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function destroy(Request $request, $code)
    {
        $docs = docsResource::where('code', $code)->first();

        // Hapus dokumen (path)
        if ($docs->cover) {
            File::delete('/app/public/'.$docs->cover); // hapus gambar lama
        }
        if ($docs->path) {
            File::delete('/app/public/'.$docs->path); // hapus gambar lama
        }
        // Hapus entri dari database
        $docs->delete();

        // Tampilkan pesan sukses
        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }
}
