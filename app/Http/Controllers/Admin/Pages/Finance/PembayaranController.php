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
}
