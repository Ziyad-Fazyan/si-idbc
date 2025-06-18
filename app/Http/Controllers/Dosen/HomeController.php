<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Notification;
use Illuminate\Http\Request;
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
    public function index()
    {

        $dosenId = Auth::guard('dosen')->user()->id;
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['feedback'] = FBPerkuliahan::whereHas('jadkul', function ($query) use ($dosenId) {
            $query->where('dosen_id', $dosenId);
        })->get();
        $data['notify'] = Notification::whereIn('send_to', [0, 2])->latest()->paginate(5);

        return view('dosen.home-index', $data);
    }
    public function profile()
    {

        $data['web'] = WebSettings::where('id', 1)->first();
        return view('dosen.home-profile', $data);
    }

    public function saveImageProfile(Request $request)
    {
        $request->validate([
            'dsn_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        $user = Auth::guard('dosen')->user();

        if ($request->hasFile('dsn_image')) {
            $image = $request->file('dsn_image');
            $name = 'profile-' . $user->dsn_code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/profile/dosen');
            $destinationPaths = storage_path('app/public/images');

            // Ensure the destination directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Compress image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image->getRealPath());
            // $image->resize(width: 250);
            $image->scaleDown(height: 300);
            $image->toPng()->save($destinationPath . '/' . $name);

            if ($user->dsn_image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $user->dsn_image); // hapus gambar lama
            }
            $user->dsn_image = "profile/dosen/" . $name;
            $user->save();

            Alert::success('Success', 'Data berhasil diupdate');
            return redirect()->route('dosen.home-profile');
        }
    }

    public function saveDataProfile(Request $request)
    {

        $request->validate([
            'dsn_name' => 'required|string|max:255',
            'dsn_nidn' => 'required|string|max:255|unique:users,user,' . Auth::guard('dosen')->user()->id,
            'dsn_birthplace' => 'required|string|max:255', // New field
            'dsn_birthdate' => 'required|date', // New field
            'dsn_gend' => 'required|string|max:1', // New field
        ]);
        $user = Auth::guard('dosen')->user();

        $user->dsn_name = $request->dsn_name;
        $user->dsn_nidn = $request->dsn_nidn;
        $user->dsn_birthplace = $request->dsn_birthplace; // New field
        $user->dsn_birthdate = $request->dsn_birthdate; // New field
        $user->dsn_gend = $request->dsn_gend; // New field


        $user->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }

    public function saveDataKontak(Request $request)
    {

        $request->validate([
            'dsn_phone' => 'required|numeric|unique:users,phone,' . Auth::guard('dosen')->user()->id,
            'dsn_mail' => 'required|email|max:255|unique:users,email,' . Auth::guard('dosen')->user()->id,
        ]);
        $user = Auth::guard('dosen')->user();

        $user->dsn_phone = $request->dsn_phone;
        $user->dsn_mail = $request->dsn_mail;


        $user->save();

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

        $user = Auth::guard('dosen')->user();

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
}
