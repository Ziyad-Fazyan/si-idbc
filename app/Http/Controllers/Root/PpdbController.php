<?php

namespace App\Http\Controllers\Root;

use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\ProgramKuliah;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use RealRashid\SweetAlert\Facades\Alert;

class PpdbController extends Controller
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
    
    public function store(Request $request) 
    { 
        $user = new Mahasiswa; 
        $school_name = webSettings::find(1)->school_name;

        $request->validate([ 
            'mhs_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196', 
            'mhs_name' => 'required|string|max:255', 
            'mhs_user' => 'required|string|max:255|unique:mahasiswas,mhs_user' . $user->id, 
            'mhs_birthplace' => 'nullable|string|max:255', 
            'mhs_birthdate' => 'nullable|date', 
            'mhs_gend' => 'nullable|string', 
            'mhs_phone' => 'required|numeric|unique:users,phone,' . $user->id, 
            'mhs_mail' => 'required|email|max:255|unique:users,email,' . $user->id, 
            'mhs_stat' => 'nullable|string', 
        ]); 

        $user->class_id = 0; 
        $user->mhs_name = $request->mhs_name; 
        $user->mhs_user = $request->mhs_user; 
        $user->mhs_nim = $request->mhs_nim; 
        $user->mhs_gend = $request->mhs_gend; 
        $user->mhs_birthplace = $request->mhs_birthplace; 
        $user->mhs_birthdate = $request->mhs_birthdate; 
        $user->mhs_reli = $request->mhs_reli; 
        $user->mhs_phone = $request->mhs_phone; 
        $user->mhs_mail = $request->mhs_mail; 
        $user->mhs_parent_mother = $request->mhs_parent_mother; 
        $user->mhs_parent_mother_phone = $request->mhs_parent_mother_phone; 
        $user->mhs_parent_father = $request->mhs_parent_father; 
        $user->mhs_parent_father_phone = $request->mhs_parent_father_phone; 
        $user->mhs_wali_name = $request->mhs_wali_name; 
        $user->mhs_wali_phone = $request->mhs_wali_phone; 
        $user->mhs_addr_domisili = $request->mhs_addr_domisili; 
        $user->mhs_addr_kelurahan = $request->mhs_addr_kelurahan; 
        $user->mhs_addr_kecamatan = $request->mhs_addr_kecamatan; 
        $user->mhs_addr_kota = $request->mhs_addr_kota; 
        $user->mhs_addr_provinsi = $request->mhs_addr_provinsi; 
        $user->mhs_stat = 0; // Status pendaftaran baru
        $user->mhs_code = 'MHS-' . Str::random(8); 

        $user->password = Hash::make("maba-$school_name"); 
        $user->save(); 
        
        if ($request->hasFile('mhs_image')) { 
            $image = $request->file('mhs_image'); 
            $name = 'profile-' . $user->mhs_code . '-' . uniqid() . '.' . $image->getClientOriginalExtension(); 
            $destinationPath = storage_path('app/public/images/profile/mahasiswa'); 
            $destinationPaths = storage_path('app/public/images'); 

            // Compress image 
            $manager = new ImageManager(new Driver()); 
            $image = $manager->read($image->getRealPath()); 
            $image->scaleDown(height: 300); 
            $image->toPng()->save($destinationPath . '/' . $name); 

            if ($user->mhs_image != 'default/default-profile.jpg') { 
                File::delete($destinationPaths . '/' . $user->mhs_image); // hapus gambar lama 
            } 
            $user->mhs_image = "profile/mahasiswa/" . $name; 
            $user->save(); 
        } 

        Alert::success('Berhasil', 'Pendaftaran baru berhasil ditambahkan'); 
        return redirect()->route('ppdb.form'); 
    }

    public function index()
    {
        $data['fakultas'] = Fakultas::all();
        $data['proku'] = ProgramKuliah::all();
        $data['notify'] = Notification::whereIn('send_to', [0, 3])->get();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['title'] = " - Form Pendaftaran Lengkap";
        $data['menu'] = "Form Pendaftaran Lengkap";

        // Add empty collections for address cascading dropdowns to avoid undefined variable errors
        $data['provinces'] = collect();
        $data['cities'] = collect();
        $data['districts'] = collect();
        $data['villages'] = collect();

        return view('root.pages.ppdb-form', $data);
    }
}