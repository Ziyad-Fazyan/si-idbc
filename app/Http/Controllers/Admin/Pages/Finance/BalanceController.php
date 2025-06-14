<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Models\Balance;
use App\Helpers\RoleTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BalanceController extends Controller
{
    use RoleTrait;

    public function index()
    {

        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['balance'] = Balance::all();
        $data['balIncome'] = Balance::where('type', 1)->sum('value');
        $data['balExpense'] = Balance::where('type', 2)->sum('value');
        $data['balPending'] = Balance::where('type', 0)->sum('value');
        $data['balSekarang'] = $data['balIncome'] - $data['balExpense'];

        return view('user.finance.pages.keuangan-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|integer',
            'desc' => 'required|string',
            'value' => 'required|string',
        ]);

        $balance = new Balance;
        $balance->value = $request->value;
        $balance->type = $request->type;
        $balance->desc = $request->desc;
        $balance->code = uniqid();
        $balance->author_id = Auth::user()->id;

        $balance->save();

        Alert::success('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'type' => 'required|integer',
            'desc' => 'required|string',
            'value' => 'required|string',
        ]);

        $balance = Balance::where('code', $code)->first();
        $balance->value = $request->value;
        $balance->type = $request->type;
        $balance->desc = $request->desc;
        // $balance->code = uniqid();
        $balance->author_id = Auth::user()->id;

        $balance->save();

        Alert::success('success', 'Data berhasil ditambahkan');
        return back();
    }

    public function destroy($code)
    {
        $balance = Balance::where('code', $code)->first();
        $balance->delete();

        Alert::success('success', 'Data berhasil dihapus');
        return back();
    }
}
