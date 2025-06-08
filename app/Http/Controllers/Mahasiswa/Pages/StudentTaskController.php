<?php

namespace App\Http\Controllers\Mahasiswa\Pages;

use App\Models\studentTask;
use Illuminate\Support\Str;
use App\Models\studentScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\webSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StudentTaskController extends Controller
{
    public function index()
    {
        $user = Auth::guard('mahasiswa')->user();
        $data['web'] = webSettings::where('id', 1)->first();
        $data['stask'] = StudentTask::whereHas('jadkul', function ($query) use ($user) {
            $query->whereIn('kelas_id', $user->kelas()->pluck('kelas.id'));
        })->get();

        return view('mahasiswa.pages.stask-index', $data);
    }

    public function view($code)
    {

        $data['stask'] = StudentTask::where('code', $code)->first();
        $data['web'] = webSettings::where('id', 1)->first();
        $score = studentScore::where('stask_id', $data['stask']->id)->where('student_id', Auth::guard('mahasiswa')->user()->id)->get();
        if ($score->count() == 1) {
            Alert::error('Error', 'Kamu sudah mengumpulkan tugas ini.');
            return back();
        } else {
            return view('mahasiswa.pages.stask-view', $data);
        }
    }

    public function store(Request $request, $code)
    {
        $request->validate([
            'desc' => 'required',
            'file_1' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_2' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_3' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_4' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_5' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_6' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_7' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
            'file_8' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:20480',
        ], [
            'desc.required' => 'Deskripsi Jawaban tugas harus diisi.',
            'file_1.required' => 'File 1 harus diunggah.',
            'file_1.mimes' => 'File 1 harus berupa file dokumen PDF, Word, Excel, atau gambar.',
            'file_1.max' => 'File 1 tidak boleh lebih dari 20 MB.',
            // Add similar messages for other files if needed
        ]);

        try {
            $stask = studentTask::where('code', $code)->first();
            $user = Auth::guard('mahasiswa')->user();
            $task = new studentScore;

            for ($i = 1; $i <= 8; $i++) {
                $fileKey = 'file_' . $i;

                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    
                    if (!$file->isValid()) {
                        throw new \Exception('File upload failed for ' . $fileKey);
                    }

                    $filename = time() . '-part-' . $i . '-' . $user->id . '.' . $file->getClientOriginalExtension();
                    
                    // Create directory if it doesn't exist
                    $storage_path = storage_path('app/public/tugas');
                    if (!file_exists($storage_path)) {
                        mkdir($storage_path, 0755, true);
                    }
                    
                    // Store file directly using move
                    if ($file->move($storage_path, $filename)) {
                        $task->{$fileKey} = 'tugas/' . $filename;
                    } else {
                        throw new \Exception('Failed to move uploaded file ' . $fileKey);
                    }
                }
            }

            $task->stask_id = $stask->id;
            $task->desc = $request->desc;
            $task->status = 'Terkumpul';
            $task->code = Str::of(mt_rand(100000, 999999))->limit(6, '');
            $task->student_id = $user->id;
            $task->save();

            Alert::success('Sukses', 'Tugas berhasil disimpan');
            return redirect()->route('mahasiswa.akademik.tugas-index');
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan tugas: ' . $e->getMessage());
            return back();
        }

        // $khs = HasilStudi::where('student_id', $user->id)->where('smt_id', $user->taka->raw_semester)->first();
        // // dd($khs->count())

        // if ($khs === null) {
        //     $ckhs = new HasilStudi;
        //     $ckhs->student_id = $user->id;
        //     $ckhs->taka_id = $user->taka->id;
        //     $ckhs->smt_id = $user->taka->raw_semester;
        //     $ckhs->score_tugas = 10;
        //     $ckhs->max_tugas = 1;
        //     $ckhs->code = Str::random(6);
        //     $ckhs->save();
        // } elseif ($khs !== null) {
        //     $ukhs = HasilStudi::where('student_id', $user->id)->where('smt_id', $user->taka->raw_semester)->first();
        //     $ukhs->score_tugas += 10;
        //     $ukhs->max_tugas += 1;
        //     $ukhs->save();
        // }

        Alert::success('Sukses', 'Tugas berhasil disimpan');
        return redirect()->route('mahasiswa.akademik.tugas-index');
    }
}
