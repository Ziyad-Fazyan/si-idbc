<?php

namespace App\Http\Controllers\Admin\Pages\Finance;

use App\Helpers\roleTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TicketSupport;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TicketSupportController extends Controller
{
    use roleTrait;

    public function index()
    {
        $userId = Auth::user()->raw_type;

        // dd($userId);
        if ($userId === 0) {

            $data['ticket'] = TicketSupport::whereNotNull('code')->latest()->get();
        } else {

            $data['ticket'] = TicketSupport::whereNotNull('code')->where('dept_id', $userId)->latest()->get();
        }
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();

        return view('user.finance.pages.support-ticket-index', $data);
    }

    public function view(Request $request, $code)
    {
        $data['ticket'] = TicketSupport::where('code', $code)->first();
        $data['support'] = TicketSupport::where('codr', $code)->latest()->get();
        $data['prefix'] = $this->setPrefix();
        $data['web'] = webSettings::where('id', 1)->first();

        // dd($checkStatus);
        $checkStatus = TicketSupport::where('code', $code)->first();
        if ($checkStatus->raw_stat_id === 2) {
            Alert::error('error', 'Ticket Sudah diClose');
            return back();
        } else {

            return view('user.finance.pages.support-ticket-view', $data);
        }
    }

    public function storeReply(Request $request, $code)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // UPDATE TICKET
        $ticket = TicketSupport::where('code', $code)->first();
        $ticket->stat_id = $request->stat_id;
        $ticket->updated_at = now();
        $ticket->save();

        $rticket = new TicketSupport;
        $rticket->codr = $code;
        $rticket->core = Str::random(6);
        $rticket->prio_id = $ticket->raw_prio_id;
        $rticket->dept_id = $ticket->raw_dept_id;
        $rticket->sent_to = $ticket->raw_dept_id;
        $rticket->admin_id = Auth::user()->id;
        $rticket->subject = $request->subject;
        $rticket->message = $request->message;
        $rticket->save();



        Alert::success('Berhasil', 'Ticket telah berhasil dibuat!');
        return back();
    }
}
