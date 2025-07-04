<?php

namespace App\Http\Controllers\Core;

use App\Helpers\RoleTrait;
use App\Helpers\SlugHelper;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NotifyController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['notify'] = Notification::all();

        return view('user.admin.system.notify-index', $data);
    }

    public function store(Request $request)
    {
        $notify = new Notification;

        $request->validate([
            'send_to' => 'required|integer',
            'dept_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'faku_id' => 'nullable|integer',
            'prodi_id' => 'nullable|integer',
            'proku_id' => 'nullable|integer',
            'class_id' => 'nullable|integer',
            'student_id' => 'nullable|integer',
            'lecture_id' => 'nullable|integer',
            'name' => 'required|string',
            'type' => 'required|string',
            'desc' => 'required|string',
        ]);

        $notify->auth_id = Auth::user()->id;
        $notify->send_to = $request->send_to;
        $notify->dept_id = $request->dept_id;
        $notify->user_id = $request->user_id;
        $notify->faku_id = $request->faku_id;
        $notify->prodi_id = $request->prodi_id;
        $notify->proku_id = $request->proku_id;
        // Jika class_id diisi, simpan sebagai array untuk mendukung relasi many-to-many
        if ($request->class_id) {
            $notify->class_id = $request->class_id;
        }
        $notify->student_id = $request->student_id;
        $notify->lecture_id = $request->lecture_id;
        $notify->name = $request->name;
        $notify->type = $request->type;
        $notify->slug = SlugHelper::generate($request->name);
        $notify->code = Str::random(7);
        $notify->desc = $request->desc;
        $notify->save();

        Alert::success('Succcess', 'Data berhasil ditambahkan!');
        return back();
    }

    public function update(Request $request, $code)
    {
        $notify = Notification::where('code', $code)->first();

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'desc' => 'required|string',
        ]);

        $notify->auth_id = Auth::user()->id;
        $notify->name = $request->name;
        $notify->type = $request->type;
        // $notify->code = Str::random(7);
        $notify->desc = $request->desc;
        $notify->save();

        Alert::success('Succcess', 'Data berhasil diupdate!');
        return back();
    }

    public function destroy($code)
    {
        $notify = Notification::where('code', $code)->first();
        $notify->delete();

        Alert::success('Succcess', 'Data berhasil dihapus!');
        return back();
    }
}
