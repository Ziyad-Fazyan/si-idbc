<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\RoleTrait;
use App\Models\TagihanKuliah;
use App\Models\HistoryTagihan;
use App\Models\Settings\WebSettings;

class PembayaranController extends Controller
{
    use RoleTrait;

    public function index(Request $request)
    {
        $data['income'] = HistoryTagihan::where('stat', 1)->whereHas('tagihan', function ($query) use ($request) {
            $query->select('price');
        })->with('tagihan')->get()->sum(function ($history) {
            return $history->tagihan->price;
        });
        $data['tagihan'] = TagihanKuliah::all();
        $data['history'] = HistoryTagihan::where('stat', 1)->latest()->get();
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();


        return view('user.finance.pages.pembayaran-index', $data);
    }

    public function unpaidMahasantri()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();

        // Get TagihanKuliah records where no related HistoryTagihan with stat=1 (paid) exists
        $unpaidTagihan = TagihanKuliah::whereDoesntHave('historyTagihans', function ($query) {
            $query->where('stat', 1);
        })->get();

        $globalBills = [];
        $individualBills = [];

        foreach ($unpaidTagihan as $bill) {
            if ($bill->users_id == 0) {
                // Global bill: find related students via kelas with matching proku_id or prodi_id
                $kelasQuery = \App\Models\Kelas::query();
                if ($bill->proku_id != 0) {
                    $kelasQuery->orWhere('proku_id', $bill->proku_id);
                }
                if ($bill->prodi_id != 0) {
                    $kelasQuery->orWhere('pstudi_id', $bill->prodi_id);
                }
                $kelasList = $kelasQuery->with('mahasiswa')->get();

                $students = collect();
                foreach ($kelasList as $kelas) {
                    $students = $students->merge($kelas->mahasiswa);
                }
                $students = $students->unique('id');

                $globalBills[] = [
                    'bill' => $bill,
                    'students' => $students,
                ];
            } else {
                // Individual bill
                $bill->load('mahasiswa');
                $individualBills[] = $bill;
            }
        }

        $data['globalBills'] = $globalBills;
        $data['individualBills'] = $individualBills;

        return view('user.finance.pages.unpaid-mahasantri', $data);
    }
}
