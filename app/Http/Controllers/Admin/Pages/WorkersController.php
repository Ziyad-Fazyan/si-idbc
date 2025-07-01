<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Helpers\RoleTrait;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Drivers\Gd\Driver;

class WorkersController extends Controller
{
    use RoleTrait;

    // KHUSUS KELOLA DATA ROLE ADMIN
    public function indexAdmin()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['admin'] = User::where('type', 0)->get();

        return view('user.admin.pages.workers-admin-index', $data);
    }
    public function createAdmin()
    {
        $data['admin'] = User::where('type', 0)->get();
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();

        return view('user.admin.pages.workers-admin-create', $data);
    }
    public function editAdmin(Request $request, $code)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['admin'] = User::where('type', 0)->where('code', $code)->first();

        return view('user.admin.pages.workers-admin-edit', $data);
    }
    public function storeAdmin(Request $request)
    {
        try {
            $user = new User;

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'name' => 'required|string|max:255',
                'user' => 'required|string|max:255|unique:users,user,' . $user->id,
                'birth_place' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'phone' => 'required|numeric|unique:users,phone,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'gend' => 'nullable|string',
                'status' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->name = $request->name;
            $user->user = $request->user;
            $user->status = $request->status;
            $user->birth_place = $request->birth_place;
            $user->birth_date = $request->birth_date;
            $user->gend = $request->gend;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->reli = $request->reli;
            $user->contact_name_1 = $request->contact_name_1;
            $user->contact_name_2 = $request->contact_name_2;
            $user->contact_phone_1 = $request->contact_phone_1;
            $user->contact_phone_2 = $request->contact_phone_2;
            $user->type = $request->type;
            $user->code = Str::random(6);


            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                // Detach semua kelas yang ada
                $user->kelas()->detach();

                // Attach kelas baru
                // Periksa apakah class_id adalah array atau nilai tunggal
                if (is_array($request->class_id)) {
                    // Jika array, attach semua kelas yang dipilih
                    $user->kelas()->attach($request->class_id);
                } else {
                    // Jika nilai tunggal, cari kelas dan attach
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'profile-' . $user->code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->image); // hapus gambar lama
                }
                $user->image = "profile/" . $name;
                $user->save();
            }

            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function updateAdmin(Request $request, $code)
    {
        try {
            $user = User::where('type', 0)->where('code', $code)->firstOrFail(); // Menggunakan firstOrFail agar melempar 404 jika tidak ditemukan

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'name' => 'required|string|max:255',
                'user' => 'required|string|max:255|unique:users,user,' . $user->id,
                'phone' => 'required|numeric|unique:users,phone,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'gend' => 'nullable|string',
                'status' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->name = $request->name;
            $user->user = $request->user;
            $user->status = $request->status;
            $user->birth_place = $request->birth_place;
            $user->birth_date = $request->birth_date;
            $user->gend = $request->gend;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->reli = $request->reli;
            $user->contact_name_1 = $request->contact_name_1;
            $user->contact_name_2 = $request->contact_name_2;
            $user->contact_phone_1 = $request->contact_phone_1;
            $user->contact_phone_2 = $request->contact_phone_2;
            $user->type = $request->type;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                // Detach semua kelas yang ada
                $user->kelas()->detach();

                // Attach kelas baru
                // Periksa apakah class_id adalah array atau nilai tunggal
                if (is_array($request->class_id)) {
                    // Jika array, attach semua kelas yang dipilih
                    $user->kelas()->attach($request->class_id);
                } else {
                    // Jika nilai tunggal, cari kelas dan attach
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'profile-' . $user->code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->image); // hapus gambar lama
                }
                $user->image = "profile/" . $name;
                $user->save();
            }

            Alert::success('Success', 'Data berhasil diupdate');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function destroyAdmin(Request $request, $code)
    {
        try {
            $destinationPaths = storage_path('app/public/images');

            $admin = User::where('code', $code)->firstOrFail();
            if ($admin->image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $admin->image);
            }

            $admin->delete();
            Alert::success('Success', 'Pengguna berhasil dihapus.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
            return back();
        }
    }
    // KHUSUS KELOLA DATA ROLE WORKER
    public function indexWorkers()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['admin'] = User::whereIn('type', [1, 2, 3, 4, 5, 6])->get();

        return view('user.admin.pages.workers-staff-index', $data);
    }
    public function createWorkers()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['admin'] = User::whereIn('type', [1, 2, 3, 4, 5, 6])->get();

        return view('user.admin.pages.workers-staff-create', $data);
    }
    public function editWorkers(Request $request, $code)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['admin'] = User::whereIn('type', [1, 2, 3, 4, 5, 6])->where('code', $code)->first();

        return view('user.admin.pages.workers-staff-edit', $data);
    }
    public function storeWorkers(Request $request)
    {
        try {
            $user = new User;

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'name' => 'required|string|max:255',
                'user' => 'required|string|max:255|unique:users,user,' . $user->id,
                'birth_place' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'phone' => 'required|numeric|unique:users,phone,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'gend' => 'nullable|string',
                'status' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->name = $request->name;
            $user->user = $request->user;
            $user->status = $request->status;
            $user->birth_place = $request->birth_place;
            $user->birth_date = $request->birth_date;
            $user->gend = $request->gend;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->reli = $request->reli;
            $user->contact_name_1 = $request->contact_name_1;
            $user->contact_name_2 = $request->contact_name_2;
            $user->contact_phone_1 = $request->contact_phone_1;
            $user->contact_phone_2 = $request->contact_phone_2;
            $user->type = $request->type;
            $user->code = Str::random(6);


            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                // Detach semua kelas yang ada
                $user->kelas()->detach();

                // Attach kelas baru
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'profile-' . $user->code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->image);
                }
                $user->image = "profile/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function updateWorkers(Request $request, $code)
    {
        try {
            $user = User::whereIn('type', [1, 2, 3, 4, 5, 6])->where('code', $code)->firstOrFail();

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'name' => 'required|string|max:255',
                'user' => 'required|string|max:255|unique:users,user,' . $user->id,
                'phone' => 'required|numeric|unique:users,phone,' . $user->id,
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'gend' => 'nullable|string',
                'status' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->name = $request->name;
            $user->user = $request->user;
            $user->status = $request->status;
            $user->birth_place = $request->birth_place;
            $user->birth_date = $request->birth_date;
            $user->gend = $request->gend;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->reli = $request->reli;
            $user->contact_name_1 = $request->contact_name_1;
            $user->contact_name_2 = $request->contact_name_2;
            $user->contact_phone_1 = $request->contact_phone_1;
            $user->contact_phone_2 = $request->contact_phone_2;
            $user->type = $request->type;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                // Detach semua kelas yang ada
                $user->kelas()->detach();

                // Attach kelas baru
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'profile-' . $user->code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->image);
                }
                $user->image = "profile/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil diupdate');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function destroyWorkers(Request $request, $code)
    {
        try {
            $destinationPaths = storage_path('app/public/images');

            $admin = User::where('code', $code)->firstOrFail();
            if ($admin->image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $admin->image);
            }

            $admin->delete();
            Alert::success('Success', 'Pengguna berhasil dihapus.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
            return back();
        }
    }
    // KHUSUS KELOLA DATA ROLE DOSEN
    public function indexLecture()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['dosen'] = Dosen::all();

        return view('user.admin.pages.workers-lecture-index', $data);
    }
    public function createLecture()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['dosen'] = Dosen::all();

        return view('user.admin.pages.workers-lecture-create', $data);
    }
    public function editLecture(Request $request, $code)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['dosen'] = Dosen::where('dsn_code', $code)->first();

        return view('user.admin.pages.workers-lecture-edit', $data);
    }
    public function storeLecture(Request $request)
    {
        try {
            $user = new Dosen;

            $request->validate([
                'dsn_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'dsn_name' => 'required|string|max:255',
                'dsn_user' => 'required|string|max:255|unique:users,user,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_birthplace' => 'required|string|max:255',
                'dsn_birthdate' => 'required|date',
                'dsn_phone' => 'required|numeric|unique:users,phone,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_mail' => 'required|email|max:255|unique:users,email,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_gend' => 'nullable|string',
                'dsn_stat' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->dsn_name = $request->dsn_name;
            $user->dsn_user = $request->dsn_user;
            $user->dsn_nidn = $request->dsn_nidn;
            $user->dsn_stat = $request->dsn_stat;
            $user->dsn_birthplace = $request->dsn_birthplace;
            $user->dsn_birthdate = $request->dsn_birthdate;
            $user->dsn_gend = $request->dsn_gend;
            $user->dsn_phone = $request->dsn_phone;
            $user->dsn_mail = $request->dsn_mail;
            $user->dsn_code = Str::random(6);

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                $user->kelas()->detach();
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('dsn_image')) {
                $image = $request->file('dsn_image');
                $name = 'profile-' . $user->dsn_code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile/dosen');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->dsn_image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->dsn_image);
                }
                $user->dsn_image = "profile/dosen/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function updateLecture(Request $request, $code)
    {
        try {
            $user = Dosen::where('dsn_code', $code)->firstOrFail();

            $request->validate([
                'dsn_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'dsn_name' => 'required|string|max:255',
                'dsn_user' => 'required|string|max:255|unique:users,user,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_phone' => 'required|numeric|unique:users,phone,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_mail' => 'required|email|max:255|unique:users,email,' . $user->id, // Perhatikan unique ke tabel users
                'dsn_gend' => 'nullable|string',
                'dsn_stat' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->dsn_name = $request->dsn_name;
            $user->dsn_user = $request->dsn_user;
            $user->dsn_stat = $request->dsn_stat;
            $user->dsn_birthplace = $request->dsn_birthplace;
            $user->dsn_birthdate = $request->dsn_birthdate;
            $user->dsn_gend = $request->dsn_gend;
            $user->dsn_phone = $request->dsn_phone;
            $user->dsn_mail = $request->dsn_mail;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                $user->kelas()->detach();
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
            if ($request->hasFile('dsn_image')) {
                $image = $request->file('dsn_image');
                $name = 'profile-' . $user->dsn_code . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/profile/dosen');
                $destinationPaths = storage_path('app/public/images');

                // Compress image
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image->getRealPath());
                $image->scaleDown(height: 300);
                $image->toPng()->save($destinationPath . '/' . $name);

                if ($user->dsn_image != 'default/default-profile.jpg') {
                    File::delete($destinationPaths . '/' . $user->dsn_image);
                }
                $user->dsn_image = "profile/dosen/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil diupdate');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function destroyLecture(Request $request, $code)
    {
        try {
            $destinationPaths = storage_path('app/public/images');

            $dosen = Dosen::where('dsn_code', $code)->firstOrFail();
            if ($dosen->dsn_image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $dosen->dsn_image);
            }

            $dosen->delete();
            Alert::success('Success', 'Pengguna berhasil dihapus.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
            return back();
        }
    }
    // KHUSUS KELOLA DATA ROLE MAHASISWA
    public function indexStudent()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['student'] = Mahasiswa::all();

        return view('user.admin.pages.workers-student-index', $data);
    }
    public function createStudent()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['kelas'] = Kelas::all();
        $data['student'] = Mahasiswa::all();

        return view('user.admin.pages.workers-student-create', $data);
    }
    public function editStudent(Request $request, $code)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['kelas'] = Kelas::all();
        $data['student'] = Mahasiswa::where('mhs_code', $code)->first();

        return view('user.admin.pages.workers-student-edit', $data);
    }
    public function storeStudent(Request $request)
    {
        try {
            $user = new Mahasiswa;

            $request->validate([
                'mhs_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'mhs_name' => 'required|string|max:255',
                'mhs_user' => 'required|string|max:255|unique:mahasiswas,mhs_user,' . $user->id, // Sesuaikan dengan tabel Mahasiswa
                'mhs_birthplace' => 'nullable|string|max:255',
                'mhs_birthdate' => 'nullable|date',
                'mhs_gend' => 'nullable|string',
                'mhs_phone' => 'required|numeric|unique:mahasiswas,mhs_phone,' . $user->id, // Sesuaikan dengan tabel Mahasiswa
                'mhs_mail' => 'required|email|max:255|unique:mahasiswas,mhs_mail,' . $user->id, // Sesuaikan dengan tabel Mahasiswa
                'mhs_stat' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->mhs_name = $request->mhs_name;
            $user->mhs_user = $request->mhs_user;
            $user->mhs_nim = $request->mhs_nim;
            $user->mhs_gend = $request->mhs_gend;
            $user->mhs_phone = $request->mhs_phone;
            $user->mhs_mail = $request->mhs_mail;
            $user->mhs_stat = $request->mhs_stat;
            $user->mhs_code = Str::random(6);

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Buat data detail mahasiswa
            $details = new \App\Models\MahasiswaDetails();
            $details->mahasiswa_id = $user->id;
            $details->mhs_reli = $request->mhs_reli;
            $details->mhs_birthplace = $request->mhs_birthplace;
            $details->mhs_birthdate = $request->mhs_birthdate;
            $details->mhs_parent_mother = $request->mhs_parent_mother;
            $details->mhs_parent_mother_phone = $request->mhs_parent_mother_phone;
            $details->mhs_parent_father = $request->mhs_parent_father;
            $details->mhs_parent_father_phone = $request->mhs_parent_father_phone;
            $details->mhs_wali_name = $request->mhs_wali_name;
            $details->mhs_wali_phone = $request->mhs_wali_phone;
            $details->mhs_addr_domisili = $request->mhs_addr_domisili;
            $details->mhs_addr_kelurahan = $request->mhs_addr_kelurahan;
            $details->mhs_addr_kecamatan = $request->mhs_addr_kecamatan;
            $details->mhs_addr_kota = $request->mhs_addr_kota;
            $details->mhs_addr_provinsi = $request->mhs_addr_provinsi;
            $details->save();

            // Update relasi kelas
            if ($request->class_id) {
                $user->kelas()->detach();
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
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
                    File::delete($destinationPaths . '/' . $user->mhs_image);
                }
                $user->mhs_image = "profile/mahasiswa/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function updateStudent(Request $request, $code)
    {
        try {
            $user = Mahasiswa::where('mhs_code', $code)->firstOrFail();

            $request->validate([
                'mhs_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8196',
                'mhs_name' => 'required|string|max:255',
                // 'mhs_user' => 'string|max:255|unique:mahasiswas,mhs_user,' . $user->id, // Unique validation dihilangkan untuk update jika user tidak berubah
                'mhs_birthplace' => 'nullable|string|max:255',
                'mhs_birthdate' => 'nullable|date',
                'mhs_gend' => 'nullable|string',
                'mhs_phone' => 'required|numeric|unique:mahasiswas,mhs_phone,' . $user->id,
                'mhs_mail' => 'required|email|max:255|unique:mahasiswas,mhs_mail,' . $user->id,
                'mhs_stat' => 'nullable|string',
                'password' => 'nullable|string',
                'password_confirm' => 'nullable|string|same:password',
            ]);


            $user->mhs_name = $request->mhs_name;
            // $user->mhs_user = $request->mhs_user; // Biasanya username tidak diubah saat update atau harus ada validasi khusus
            $user->mhs_nim = $request->mhs_nim;
            $user->mhs_gend = $request->mhs_gend;
            $user->mhs_phone = $request->mhs_phone;
            $user->mhs_mail = $request->mhs_mail;
            $user->mhs_stat = $request->mhs_stat;

            // Update atau buat data detail mahasiswa
            $details = $user->mahasiswaDetails;
            if (!$details) {
                $details = new \App\Models\MahasiswaDetails();
                $details->mahasiswa_id = $user->id;
            }

            $details->mhs_reli = $request->mhs_reli;
            $details->mhs_birthplace = $request->mhs_birthplace;
            $details->mhs_birthdate = $request->mhs_birthdate;
            $details->mhs_parent_mother = $request->mhs_parent_mother;
            $details->mhs_parent_mother_phone = $request->mhs_parent_mother_phone;
            $details->mhs_parent_father = $request->mhs_parent_father;
            $details->mhs_parent_father_phone = $request->mhs_parent_father_phone;
            $details->mhs_wali_name = $request->mhs_wali_name;
            $details->mhs_wali_phone = $request->mhs_wali_phone;
            $details->mhs_addr_domisili = $request->mhs_addr_domisili;
            $details->mhs_addr_kelurahan = $request->mhs_addr_kelurahan;
            $details->mhs_addr_kecamatan = $request->mhs_addr_kecamatan;
            $details->mhs_addr_kota = $request->mhs_addr_kota;
            $details->mhs_addr_provinsi = $request->mhs_addr_provinsi;
            $details->save();


            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update relasi kelas
            if ($request->class_id) {
                $user->kelas()->detach();
                if (is_array($request->class_id)) {
                    $user->kelas()->attach($request->class_id);
                } else {
                    $kelas = Kelas::find($request->class_id);
                    if ($kelas) {
                        $user->kelas()->attach($kelas->id);
                    }
                }
            }
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
                    File::delete($destinationPaths . '/' . $user->mhs_image);
                }
                $user->mhs_image = "profile/mahasiswa/" . $name;
                $user->save();
            }
            Alert::success('Success', 'Data berhasil diupdate');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
            return back()->withInput();
        }
    }
    public function destroyStudent(Request $request, $code)
    {
        try {
            $destinationPaths = storage_path('app/public/images');

            $student = Mahasiswa::where('mhs_code', $code)->firstOrFail();
            if ($student->mhs_image != 'default/default-profile.jpg') {
                File::delete($destinationPaths . '/' . $student->mhs_image);
            }

            if ($student->mahasiswaDetails) {
                $student->mahasiswaDetails->delete();
            }

            $student->delete();
            Alert::success('Success', 'Pengguna berhasil dihapus.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
            return back();
        }
    }
}
