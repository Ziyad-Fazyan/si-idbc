<?php

namespace App\Http\Controllers\Admin\Pages\Publikasi;

use App\Helpers\roleTrait;
use App\Models\docsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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

        if (!$docs) {
            Alert::error('Error', 'Document not found');
            return back();
        }

        // Hapus cover image
        if ($docs->cover) {
            $coverPath = storage_path('app/public/' . $docs->cover);
            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }
        }

        // Hapus document file
        if ($docs->path) {
            $filePath = storage_path('app/public/' . $docs->path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        // Hapus entri dari database
        $docs->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }

    public function download($code)
    {
        try {
            $docs = docsResource::where('code', $code)->firstOrFail();

            if (empty($docs->path)) {
                Alert::error('Error', 'Document file not found');
                return back();
            }

            $filePath = storage_path('app/public/' . $docs->path);

            if (!File::exists($filePath)) {
                Alert::error('Error', 'Document file not found on server');
                return back();
            }

            $extension = pathinfo($docs->path, PATHINFO_EXTENSION);
            $fileName = Str::slug($docs->name) . '.' . $extension;

            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Length' => filesize($filePath),
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Sat, 01 Jan 1990 00:00:00 GMT'
            ]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to download document');
            return back();
        }
    }
}
