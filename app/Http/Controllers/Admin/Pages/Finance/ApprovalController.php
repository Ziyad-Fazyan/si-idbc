<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Helpers\roleTrait;
use App\Models\uAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends Controller
{
    use roleTrait;

    public function indexAbsen()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['absen'] = uAttendance::where('absen_approve', 1)->latest()->get();

        return view('user.finance.pages.approval-absen-index', $data);
    }
    public function indexAbsenApproved()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['absen'] = uAttendance::where('absen_approve', 2)->latest()->get();

        return view('user.finance.pages.approval-absen-index', $data);
    }
    public function indexAbsenRejected()
    {
        $data['web'] = webSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['absen'] = uAttendance::where('absen_approve', 3)->latest()->get();

        return view('user.finance.pages.approval-absen-index', $data);
    }

    public function updateAbsenAccept(Request $request, $code)
    {
        $absen = uAttendance::where('absen_code', $code)->first();
        $absen->absen_approve = 2;
        $absen->save();

        Alert::success('success', 'Absensi Berhasil Disetujui.');
        return back();
    }
    public function updateAbsenReject(Request $request, $code)
    {
        $absen = uAttendance::where('absen_code', $code)->first();
        $absen->absen_approve = 3;
        $absen->save();

        Alert::success('success', 'Absensi Berhasil Disetujui.');
        return back();
    }
}
