<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleTrait;
use App\Models\UAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiController extends Controller
{
    use RoleTrait;

    public function absenHarian()
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['userid'] = Auth::user()->id;
        $data['today'] = date('Y-m-d');
        $data['hadir'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['izin'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2, 3, 6, 7])->get();
        $data['sakit'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2])->get();
        // Filter data untuk terlambat (waktu masuk lebih dari jam 8 pagi)
        $data['terlambat'] = UAttendance::where('absen_user_id', $data['userid'])
            ->whereIn('absen_type', [0, 1, 5])
            ->whereTime('absen_time_in', '>', '08:00:00')
            ->get();
        $data['absen'] = UAttendance::where('absen_user_id', $data['userid'])->latest()->get();
        $data['prefix'] = $this->setPrefix();

        return view('user.pages.presensi-index', $data);
    }
    public function absenIzinCuti()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['userid'] = Auth::user()->id;
        $data['today'] = date('Y-m-d');
        $data['hadir'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['izin'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2, 3, 6, 7])->get();
        $data['sakit'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2])->get();
        // Filter data untuk terlambat (waktu masuk lebih dari jam 8 pagi)
        $data['terlambat'] = UAttendance::where('absen_user_id', $data['userid'])
            ->whereIn('absen_type', [0, 1, 5])
            ->whereTime('absen_time_in', '>', '08:00:00')
            ->get();
        $data['absen'] = UAttendance::where('absen_user_id', $data['userid'])->latest()->get();
        $data['prefix'] = $this->setPrefix();

        return view('user.pages.presensi-izin', $data);
    }

    public function absenView($code)
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['userid'] = Auth::user()->id;
        $data['today'] = date('Y-m-d');
        $data['prefix'] = $this->setPrefix();
        $data['hadir'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['izin'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2, 3, 6, 7])->get();
        $data['sakit'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2])->get();
        // Filter data untuk terlambat (waktu masuk lebih dari jam 8 pagi)
        $data['terlambat'] = UAttendance::where('absen_user_id', $data['userid'])
            ->whereIn('absen_type', [0, 1, 5])
            ->whereTime('absen_time_in', '>', '08:00:00')
            ->get();
        // Check Data Absen Hari Ini
        $data['absen'] = UAttendance::where('absen_user_id', $data['userid'])
            ->where('absen_code', $code)
            ->first();

        if ($data['absen']) {

            return view('user.pages.presensi-view', $data);
        } else {

            Alert::error('Kamu belum absen pada tanggal ini !');
            return back();
        }
    }

    public function presensiList()
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['userid'] = Auth::user()->id;
        $data['today'] = date('Y-m-d');
        $data['absen'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['prefix'] = $this->setPrefix();

        $data['hadir'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['izin'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2, 3, 6, 7])->get();
        $data['sakit'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2])->get();
        // Filter data untuk terlambat (waktu masuk lebih dari jam 8 pagi)
        $data['terlambat'] = UAttendance::where('absen_user_id', $data['userid'])
            ->whereIn('absen_type', [0, 1, 5])
            ->whereTime('absen_time_in', '>', '08:00:00')
            ->get();


        return view('user.home-presensi-view', $data);
    }
    public function presensiView($date)
    {
        $data['web'] = WebSettings::where('id', 1)->first();

        $data['userid'] = Auth::user()->id;
        $data['today'] = date('Y-m-d');
        $data['prefix'] = $this->setPrefix();
        $data['hadir'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [0, 1, 4, 5])->get();
        $data['izin'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2, 3, 6, 7])->get();
        $data['sakit'] = UAttendance::where('absen_user_id', $data['userid'])->whereIn('absen_type', [2])->get();
        // Filter data untuk terlambat (waktu masuk lebih dari jam 8 pagi)
        $data['terlambat'] = UAttendance::where('absen_user_id', $data['userid'])
            ->whereIn('absen_type', [0, 1, 5])
            ->whereTime('absen_time_in', '>', '08:00:00')
            ->get();
        // Check Data Absen Hari Ini
        $data['absen'] = UAttendance::where('absen_user_id', $data['userid'])
            ->where('absen_date', $date)
            ->first();


        // dd($data['absen']);

        if ($data['absen']) {

            return view('user.home-presensi-update', $data);
        } else {

            Alert::error('Kamu belum absen pada tanggal ini !');
            return back();
            // return view('user.home-presensi-index', $data);

        }
    }

    public function absenPulang(Request $request)
    {
        $absen = UAttendance::where('absen_user_id', $request->absen_user_id)->where('absen_date', $request->absen_date)->first();

        $absen->absen_time_out = $request->absen_time_out;
        $absen->absen_desc = $request->absen_desc;
        $absen->update();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }
}
