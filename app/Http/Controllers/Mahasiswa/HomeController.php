<?php

namespace App\Http\Controllers\Mahasiswa;

use PDF;
use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Ruang;
use App\Models\Balance;
use App\Models\Kurikulum;
use App\Models\MataKuliah;
use Illuminate\Support\Str;
use App\Models\JadwalKuliah;
use App\Models\Notification;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\TagihanKuliah;
use App\Models\TahunAkademik;
use App\Models\HistoryTagihan;
use App\Models\AbsensiMahasiswa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use App\Models\FeedBack\FBPerkuliahan;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Drivers\Gd\Driver;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('mahasiswa')->user();
        $data['web'] = WebSettings::where('id', 1)->first();

        // Mengambil kelas pertama dari relasi many-to-many
        $kelas = $user->kelas->first();

        if ($kelas) {
            $data['tagihan'] = TagihanKuliah::where('users_id', $user->id)
                ->orWhere('proku_id', $kelas->proku_id)
                ->orWhere('prodi_id', $kelas->pstudi_id)
                ->sum('price');

            $data['jadkul'] = JadwalKuliah::where('kelas_id', $kelas->id)->count();
        } else {
            $data['tagihan'] = TagihanKuliah::where('users_id', $user->id)->sum('price');
            $data['jadkul'] = 0;
        }

        $data['history'] = HistoryTagihan::where('users_id', $user->id)
            ->where('stat', 1)
            ->whereHas('tagihan', function ($query) use ($request) {
                $query->select('price');
            })
            ->with('tagihan')
            ->get()
            ->sum(function ($history) {
                return $history->tagihan->price;
            });

        $data['sisatagihan'] = $data['tagihan'] - $data['history'];
        $data['habsen'] = AbsensiMahasiswa::where('author_id', $user->id)->where('absen_type', 'H')->count();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->latest()->paginate(5);

        // dd($data['notif']);
        // dd($data['history']);


        return view('mahasiswa.home-index', $data);
    }
    public function profile()
    {

        $data['web'] = WebSettings::where('id', 1)->first();

        return view('mahasiswa.home-profile', $data);
    }

    public function jadkulIndex()
    {
        $data['kuri'] = Kurikulum::all();
        $data['taka'] = TahunAkademik::all();
        // $data['dosen'] = MataKuliah::where('dosen');
        $data['pstudi'] = ProgramStudi::all();
        $data['matkul'] = MataKuliah::all();
        $user = Auth::guard('mahasiswa')->user();
        $kelasIds = $user->kelas->pluck('id');
        $data['jadkul'] = JadwalKuliah::whereIn('kelas_id', $kelasIds)->get();
        $data['ruang'] = Ruang::all();
        $data['kelas'] = Kelas::all();
        $data['web'] = WebSettings::where('id', 1)->first();


        return view('mahasiswa.pages.mhs-jadkul-index', $data);
    }
    public function jadkulAbsen($code)
    {
        $now = Carbon::now();
        $hariIni = $now->dayOfWeekIso; // Senin = 1, Minggu = 7
        $waktuDatang = $now->format('H:i:s');
        // Get jadkul id from code
        $jadkul = JadwalKuliah::where('code', $code)->first();
        if (!$jadkul) {
            Alert::error('Error', 'Jadwal kuliah tidak ditemukan');
            return back();
        }
        $jadkul_id = $jadkul->id;

        $checkAbsen = AbsensiMahasiswa::where('jadkul_id', $jadkul_id)->where('author_id', Auth::guard('mahasiswa')->user()->id)->count();
        $checkDate = JadwalKuliah::where('code', $code)->where('days_id', $hariIni)
            ->where('start', '<=', $waktuDatang)
            ->where('ended', '>=', $waktuDatang)->count();

        // dd($timeStart);
        if ($checkAbsen === 0) {
            if ($checkDate !== 0) {
                $data['web'] = WebSettings::where('id', 1)->first();
                $data['kuri'] = Kurikulum::all();
                $data['taka'] = TahunAkademik::all();
                // $data['dosen'] = MataKuliah::where('dosen');
                $data['pstudi'] = ProgramStudi::all();
                $data['matkul'] = MataKuliah::all();
                $data['jadkul'] = JadwalKuliah::where('code', $code)->first();
                $data['ruang'] = Ruang::all();
                $data['kelas'] = Kelas::all();

                // dd($data['jadkul']);

                return view('mahasiswa.pages.mhs-jadkul-absen', $data);
            } else {

                Alert::error('Error', 'Kamu belum bisa absen pada saat ini.');
                return back();
            }
        } else {
            Alert::error('Error', 'Kamu sudah absen untuk matakuliah ini.');
            return back();
        }
    }

    public function jadkulAbsenStore(Request $request)
    {
        $request->validate([
            'absen_type' => 'required|string',
            'jadkul_id' => 'required|integer',
            'days_id' => 'required|integer',
            'absen_time' => 'required|string',
            'author_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $timeStart = now()->format('H:i:s');
        $checkStart = JadwalKuliah::where('id', $request->jadkul_id)->first();

        if (!$checkStart) {
            Alert::error('Error', 'Jadwal kuliah tidak ditemukan.');
            return back();
        }

        // Cek sudah absen belum
        $jadkul = JadwalKuliah::where('id', $request->jadkul_id)->first();
        if (!$jadkul) {
            Alert::error('Error', 'Jadwal kuliah tidak ditemukan.');
            return back();
        }
        $jadkul_id = $jadkul->id ?? null;

        $sudahAbsen = AbsensiMahasiswa::where('jadkul_id', $jadkul_id)
            ->where('author_id', $request->author_id)
            ->where('absen_date', $request->absen_date)
            ->exists();

        if ($sudahAbsen) {
            Alert::error('Error', 'Mahasiswa sudah absen untuk matakuliah ini.');
            return back();
        }

        if ($timeStart >= $checkStart->ended) {
            Alert::error('Error', 'Waktu perkuliahan telah selesai. Tidak bisa melakukan absensi.');
            return back();
        }

        if ($timeStart < $checkStart->start) {
            Alert::error('Error', 'Waktu absen belum dimulai. Silakan coba nanti.');
            return back();
        }

        // Simpan data absen
        $absen = new AbsensiMahasiswa;
        $absen->author_id = $request->author_id;
        $absen->jadkul_id = $jadkul_id;
        $absen->absen_date = $request->absen_date;
        $absen->absen_time = $request->absen_time;
        $absen->absen_type = $request->absen_type;
        $absen->code = uniqid();
        
        // Jika ada gambar dari face recognition atau upload manual
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'presensi-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/presensi');

            // Membuat direktori jika belum ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Mengompres gambar dan menyimpannya
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image->getRealPath());
            $image->scaleDown(height: 300)->save($destinationPath . '/' . $name);

            // Menyimpan nama file gambar ke database
            $absen->image = "presensi/" . $name;
        } 
        // Jika ada gambar dari face recognition yang disimpan di session
        elseif (Session::has('face_image_path')) {
            $absen->image = Session::get('face_image_path');
            Session::forget('face_image_path');
        }
        
        $absen->save();

        // Tentukan pesan berdasarkan sumber request (dari mahasiswa atau dari pengenalan wajah)
        $referer = request()->headers->get('referer');
        $isFromFaceRecognition = str_contains($referer, 'face-results');

        if ($isFromFaceRecognition) {
            Alert::success('Success', 'Absensi berhasil dicatat melalui pengenalan wajah.');
            return redirect()->route('absen.absen-wajah-index');
        } else {
            Alert::success('Success', 'Kamu telah berhasil absen pada matakuliah ini.');
            return redirect()->route('absen.absen-wajah-index');
        }
    }

    public function saveImageProfile(Request $request)
    {
        $request->validate([
            'mhs_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        $user = Auth::guard('mahasiswa')->user();

        if ($request->hasFile('mhs_image')) {
            $image = $request->file('mhs_image');
            $name = 'profile-' . $user->mhs_code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/profile');
            $destinationPaths = storage_path('app/public/images');

            // Compress image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image->getRealPath());
            // $image->resize(width: 250);
            $image->scaleDown(height: 300);
            $image->toPng()->save($destinationPath . '/' . $name);

            if ($user->mhs_image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $user->mhs_image); // hapus gambar lama
            }
            $user->mhs_image = "profile/" . $name;
            $user->save();

            Alert::success('Success', 'Data berhasil diupdate');
            return redirect()->route('mahasiswa.home-profile');
        }
    }

    public function saveDataProfile(Request $request)
    {

        $request->validate([
            'mhs_name' => 'required|string|max:255',
            'mhs_nim' => 'required|string|max:255|unique:users,user,' . Auth::guard('mahasiswa')->user()->id,
            'mhs_birthplace' => 'required|string|max:255',
            'mhs_birthdate' => 'required|date',
        ]);
        $user = Auth::guard('mahasiswa')->user();

        $user->mhs_name = $request->mhs_name;
        $user->mhs_nim = $request->mhs_nim;
        $user->mhs_gend = $request->mhs_gend;
        $user->mahasiswaDetails->mhs_reli = $request->mhs_reli;
        $user->save();

        // Update atau buat data detail mahasiswa
        $details = $user->mahasiswaDetails;
        if (!$details) {
            $details = new \App\Models\MahasiswaDetails();
            $details->mahasiswa_id = $user->id;
        }

        $details->mhs_birthplace = $request->mhs_birthplace;
        $details->mhs_birthdate = $request->mhs_birthdate;
        $details->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }

    public function saveDataKontak(Request $request)
    {

        $request->validate([
            'mhs_phone' => 'required|numeric|unique:users,phone,' . Auth::guard('mahasiswa')->user()->id,
            'mhs_mail' => 'required|email|max:255|unique:users,email,' . Auth::guard('mahasiswa')->user()->id,
            'mhs_parent_father' => 'nullable|string|max:255',
            'mhs_parent_mother' => 'nullable|string|max:255',
            'mhs_parent_father_phone' => 'nullable|string|max:14',
            'mhs_parent_mother_phone' => 'nullable|string|max:14',
            'mhs_parent_wali_name' => 'string|max:14',
            'mhs_parent_wali_phone' => 'string|max:14',
            'mhs_addr_domisili' => 'nullable|string|max:4192',
            'mhs_addr_kelurahan' => 'nullable|string|max:255',
            'mhs_addr_kecamatan' => 'nullable|string|max:255',
            'mhs_addr_kota' => 'nullable|string|max:255',
            'mhs_addr_provinsi' => 'nullable|string|max:255',
        ]);
        $user = Auth::guard('mahasiswa')->user();

        $user->mhs_phone = $request->mhs_phone;
        $user->mhs_mail = $request->mhs_mail;
        $user->save();

        // Update atau buat data detail mahasiswa
        $details = $user->mahasiswaDetails;
        if (!$details) {
            $details = new \App\Models\MahasiswaDetails();
            $details->mahasiswa_id = $user->id;
        }

        $details->mhs_parent_father = $request->mhs_parent_father;
        $details->mhs_parent_father_phone = $request->mhs_parent_father_phone;
        $details->mhs_parent_mother = $request->mhs_parent_mother;
        $details->mhs_parent_mother_phone = $request->mhs_parent_mother_phone;
        $details->mhs_wali_name = $request->mhs_wali_name;
        $details->mhs_wali_phone = $request->mhs_wali_phone;
        $details->mhs_addr_domisili = $request->mhs_addr_domisili;
        $details->mhs_addr_kelurahan = $request->mhs_addr_kelurahan;
        $details->mhs_addr_kecamatan = $request->mhs_addr_kecamatan;
        $details->mhs_addr_kota = $request->mhs_addr_kota;
        $details->mhs_addr_provinsi = $request->mhs_addr_provinsi;
        $details->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }

    public function saveDataPassword(Request $request)
    {
        // Validate the request...
        $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'same:new_password_confirmed'],
        ]);

        $user = Auth::guard('mahasiswa')->user();

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            Alert::error('Error', 'Password lama yang diberikan tidak cocok dengan catatan kami.');
            return back();
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Success', 'Password berhasil diubah!');
        return back();
    }

    public function tagihanIndexAjax()
    {
        $user = Auth::guard('mahasiswa')->user();

        $data['tagihan'] = TagihanKuliah::where('users_id', $user->id)->orwhere(
            'proku_id',
            $user->kelas->first()?->proku?->id
        )->orwhere(
            'prodi_id',
            $user->kelas->first()?->proku?->id
        )->latest()->get();
        $data['history'] = HistoryTagihan::where('users_id', Auth::guard('mahasiswa')->user()->id)->where('stat', 1)->latest()->get();

        return response()->json($data);
    }

    public function tagihanIndex()
    {
        $user = Auth::guard('mahasiswa')->user();
        // Mencari tagihan berdasarkan `users_id`
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['tagihan'] = TagihanKuliah::where('users_id', $user->id)->orwhere(
            'proku_id',
            $user->kelas->first()?->proku?->id
        )->orwhere(
            'prodi_id',
            $user->kelas->first()?->proku?->id
        )->latest()->get();
        $data['history'] = HistoryTagihan::where('users_id', Auth::guard('mahasiswa')->user()->id)->where('stat', 1)->latest()->get();


        return view('mahasiswa.pages.mhs-tagihan-index', $data);
    }
    public function tagihanView($code)
    {
        // Mencari tagihan berdasarkan `users_id`
        $user = Auth::guard('mahasiswa')->user();
        $data['web'] = WebSettings::where('id', 1)->first();
        $checkData = HistoryTagihan::where('tagihan_code', $code)->where('users_id', $user->id)->where('stat', 1)->first();
        if ($checkData !== null) {

            Alert::error('error', 'Kamu sudah membayar tagihan ini');
            return back();
        } else {
            $data['tagihan'] = TagihanKuliah::where('code', $code)->first();

            return view('mahasiswa.pages.mhs-tagihan-view', $data);
        }
    }

    public function tagihanPayment(Request $request, $code)
    {
        $tagihan = TagihanKuliah::where('code', $code)->first();

        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');

        $response = []; // <- Inisialisasi dulu

        DB::transaction(function () use ($request, $tagihan, &$response) {
            $donation = \App\Models\HistoryTagihan::create([
                'users_id'      => Auth::guard('mahasiswa')->user()->id,
                'tagihan_code'  => $tagihan->code, // pakai dari model, jangan $request->code
                'code'          => Str::random(9),
                'desc'          => $request->note,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'     => $donation->code,
                    'gross_amount' => $request->amount,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email'      => $request->email,
                ],
                'item_details' => [
                    [
                        'id'            => $tagihan->code,
                        'price'         => $request->amount,
                        'quantity'      => 1,
                        'name'          => $request->note,
                        'brand'         => 'Tagihan Kuliah',
                        'category'      => 'Tagihan Kuliah',
                        'merchant_name' => config('app.name'),
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            $response['code_uniq'] = $donation->code;
            $response['snap_token'] = $snapToken;
        });

        return response()->json([
            'status'     => 'success',
            'snap_token' => $response['snap_token'],
            'code_uniq'  => $response['code_uniq'],
        ]);
    }

    public function tagihanSuccess(Request $request, $code)
    {
        $tagihan = HistoryTagihan::where('code', $code)->first();
        $tagihan->stat = 1;
        $tagihan->save();

        $balance = new Balance;
        $balance->value = $tagihan->tagihan->price;
        $balance->type = 1;
        $balance->desc = 'Reff pembayaran mahasiswa #' . $code;
        $balance->code = uniqid();
        $balance->author_id = Auth::guard('mahasiswa')->user()->id;

        $balance->save();

        Alert::success('Success', 'Tagihan telah dibayar');
        return redirect()->route('mahasiswa.home-tagihan-index');
    }

    public function tagihanInvoice(Request $request, $code)
    {
        $data['history'] = HistoryTagihan::where('code', $code)->first();

        // Load view into a variable

        // return view('mahasiswa.pages.mhs-tagihan-invoice', $data);
        $view = view('mahasiswa.pages.mhs-tagihan-invoice', $data);

        // Load the HTML content of the view
        $html = $view->render();

        // Load HTML content into DOMPDF
        $pdf = PDF::loadHtml($html)->setPaper('a4');

        // Save the PDF file to storage
        $pdf->save(storage_path('app/public/invoices/Invoice-Pembayaran-' . $data['history']->tagihan->name . '-' . $data['history']->tagihan_code . '.pdf'));

        // Or you can return the PDF to be downloaded
        return $pdf->download('Invoice-Pembayaran-' . $data['history']->tagihan->name . '-' . $data['history']->tagihan_code . '.pdf');
    }

    public function storeFBPerkuliahan(Request $request, $code)
    {
        $user = Auth::guard('mahasiswa')->user();

        $checkData = FBPerkuliahan::where('fb_jakul_code', $code)->where('fb_users_code', $user->mhs_code)->first();

        $request->validate([
            'fb_score' => 'required|in:Tidak Puas,Cukup Puas,Sangat Puas',
            'fb_reason' => 'required'
        ], [
            'fb_score.required' => 'Skor feedback harus diisi.',
            'fb_score.in' => 'Skor feedback harus salah satu dari: Tidak Puas, Cukup Puas, Sangat Puas.',
            'fb_reason.required' => 'Alasan feedback harus diisi.',
        ]);

        if ($checkData !== null) {
            Alert::error('Error', 'Kamu sudah memberikan FeedBack pada perkuliahan ini.');
            return back();
        } else {
            $fb = new FBPerkuliahan;

            $fb->fb_users_code = $user->mhs_code;
            $fb->fb_jakul_code = $code;
            $fb->fb_code = uniqid(8);
            $fb->fb_score = $request->fb_score;
            $fb->fb_reason = $request->fb_reason;

            $fb->save();

            Alert::success('Sukses', 'Terima kasih telah memberi FeedBack ^_^');
            return back();
        }
    }
}
