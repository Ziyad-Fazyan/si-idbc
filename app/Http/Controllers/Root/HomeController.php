<?php

namespace App\Http\Controllers\Root;

use App\Models\Fakultas;
use App\Models\NewsPost;
use App\Models\KotakSaran;
use App\Models\DocsResource;
use App\Models\GalleryAlbum;
use App\Models\Notification;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\ProgramKuliah;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    private function setPrefix()
    {
        if (Auth::user()) {

            $rawType = Auth::user()->raw_type;
            switch ($rawType) {
                case 1:
                    return 'finance.';
                case 2:
                    return 'absen.';
                case 3:
                    return 'academic.';
                case 4:
                    return 'musyrif.';
                case 5:
                    return 'support.';
                case 6:
                    return 'sitemanager.';
                default:
                    return 'web-admin.';
            }
        }
    }


    public function index()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['album'] = GalleryAlbum::where('isPublish', 1)->latest()->paginate(3);
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Halaman Utama";
        return view('root.root-index', $data);
    }

    public function galleryIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        // $data['album'] = GalleryAlbum::where('slug', $slug)->first();
        $data['albums'] = GalleryAlbum::latest()->paginate(24);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Daftar Album Foto ";
        return view('root.pages.gallery-index', $data);
    }
    public function gallerySearch(Request $request)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        // $data['album'] = GalleryAlbum::where('slug', $slug)->first();
        $search = $request->input('search');
        $albums = GalleryAlbum::where('name', 'like', "%$search%")->paginate(24);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Daftar Album Foto ";
        return view('root.pages.gallery-index', compact('albums'), $data);
    }
    public function galleryShow($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['album'] = GalleryAlbum::where('slug', $slug)->first();
        $data['albums'] = GalleryAlbum::latest()->paginate(7);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Lihat Album " . $data['album']->name;
        return view('root.pages.gallery-view', $data);
    }

    public function postView($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['post'] = NewsPost::where('slug', $slug)->first();
        $data['posts'] = NewsPost::latest()->paginate(7);
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Lihat Postingan " . $data['post']->name;
        return view('root.pages.news-view', $data);
    }


    public function downloadIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Download";
        $data['prefix'] = $this->setPrefix();
        $data['docs'] = DocsResource::orderBy('created_at', 'desc')->get();

        return view('root.pages.document-index', $data);
    }
    public function adviceIndex()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Kotak Saran";
        $data['prefix'] = $this->setPrefix();
        return view('root.pages.advice-index', $data);
    }
    public function prodiIndex($slug)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['pstudi'] = ProgramStudi::where('slug', $slug)->first();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Program Studi " . $data['pstudi']->name;
        $data['prefix'] = $this->setPrefix();
        return view('root.pages.prodi-index', $data);
    }
    public function prokuIndex($code)
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['pstudi'] = ProgramKuliah::where('code', $code)->first();
        $data['title'] = " - ESEC Academy";
        $data['menu'] = "Program Kuliah " . $data['pstudi']->name;
        $data['prefix'] = $this->setPrefix();

        return view('root.pages.prodi-index', $data);
    }
    public function adviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'desc' => 'required',
        ]);

        $saran = new KotakSaran;
        $saran->name = $request->name;
        $saran->email = $request->email;
        $saran->subject = $request->subject;
        $saran->desc = $request->desc;
        if ($saran->save()) {
            Mail::send('base.resource.mail-kotak-saran-admin', ['saran' => $saran], function ($message) use ($saran) {
                $message->to([
                    'jaya.kusuma@internal-dev.id',
                    'mjaya69703@gmail.com'
                ]);
                $message->subject('[ SARAN ] - ESEC Academy - ' . $saran->subject);
                $message->from('admin@internal-dev.id', 'SIAKAD PT by Internal-Dev');
            });

            Alert::success('Sukses', 'Terima kasih telah mengirimkan Saran ^_^');
            return back();
        } else {
            Alert::error('Error', 'Email tidak berhasil dikirim.');
            return back();
        }
    }
}
