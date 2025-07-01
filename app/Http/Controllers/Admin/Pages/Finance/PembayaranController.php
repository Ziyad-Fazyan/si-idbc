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
        $data['unpaidTagihan'] = TagihanKuliah::whereDoesntHave('historyTagihans', function ($query) {
            $query->where('stat', 1);
        })->with('mahasiswa')->get();

        return view('user.finance.pages.unpaid-mahasantri', $data);
    }
}
