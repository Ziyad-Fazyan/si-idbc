<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\Mahasiswa;
use App\Models\MahasiswaDetails;
use App\Helpers\roleTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaHealthController extends Controller
{
    use roleTrait;

    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['students'] = Mahasiswa::with('mahasiswaDetails')->get();

        return view('user.admin.pages.mahasiswa-health.index', $data);
    }    public function edit($code)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['student'] = Mahasiswa::with('mahasiswaDetails')->where('mhs_code', $code)->first();

        if (!$data['student']) {
            Alert::error('Error', 'Data mahasiswa tidak ditemukan');
            return redirect()->route($data['prefix'] . 'mahasiswa-health.index');
        }

        return view('user.admin.pages.mahasiswa-health.edit', $data);
    }

    public function update(Request $request, $code)
    {
        $user = Mahasiswa::where('mhs_code', $code)->first();

        if (!$user) {
            Alert::error('Error', 'Data mahasiswa tidak ditemukan');
            return redirect()->route($this->setPrefix() . 'mahasiswa-health.index');
        }

        $request->validate([
            'mhs_biometric' => 'nullable|string|max:255',
            'mhs_iq' => 'nullable|integer',
            'mhs_logic' => 'nullable|integer',
            'mhs_riwayat_kesehatan' => 'nullable|string',
            'mhs_goldar' => 'nullable|string|max:3',
            'mhs_tinggi_badan' => 'nullable|numeric',
            'mhs_berat_badan' => 'nullable|numeric',
        ]);

        // Update atau buat data detail mahasiswa
        $details = $user->mahasiswaDetails;
        if (!$details) {
            $details = new MahasiswaDetails();
            $details->mahasiswa_id = $user->id;
        }

        $details->mhs_biometric = $request->mhs_biometric;
        $details->mhs_iq = $request->mhs_iq;
        $details->mhs_logic = $request->mhs_logic;
        $details->mhs_riwayat_kesehatan = $request->mhs_riwayat_kesehatan;
        $details->mhs_goldar = $request->mhs_goldar;
        $details->mhs_tinggi_badan = $request->mhs_tinggi_badan;
        $details->mhs_berat_badan = $request->mhs_berat_badan;
        $details->save();

        Alert::success('Success', 'Data kesehatan mahasiswa berhasil diperbarui');
        return redirect()->route($this->setPrefix() . 'mahasiswa-health.index');
    }
}