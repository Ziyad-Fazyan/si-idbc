<?php

namespace App\Http\Controllers\Dosen\Akademik;

use App\Models\Mahasiswa;
use App\Models\HasilStudi;
use App\Models\StudentTask;
use Illuminate\Support\Str;
use App\Models\JadwalKuliah;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StudentTaskController extends Controller
{
    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['jadkul'] = JadwalKuliah::all();
        $data['stask'] = StudentTask::all();

        return view('dosen.pages.student-task-index', $data);
    }

    public function create()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['jadkul'] = JadwalKuliah::all();
        $data['stask'] = StudentTask::latest()->paginate(5);

        return view('dosen.pages.student-task-create', $data);
    }
    public function view($code)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['jadkul'] = JadwalKuliah::all();
        $data['stask'] = StudentTask::latest()->paginate(5);
        $data['task'] = StudentTask::where('code', $code)->first();
        $data['score'] = StudentScore::where('stask_id', $data['task']->id)
            ->with(['studentTask.jadkul.matkul', 'student'])
            ->get();

        // dd($data['score']);

        return view('dosen.pages.student-task-view', $data);
    }
    public function viewDetail($code)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['stask'] = StudentTask::latest()->paginate(5);
        $data['score'] = StudentScore::where('code', $code)
            ->with(['studentTask.jadkul.matkul', 'student.kelas'])
            ->first();

        // dd($data['score']);

        return view('dosen.pages.student-task-view-score', $data);
    }
    public function edit($code)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['jadkul'] = JadwalKuliah::all();
        $data['stask'] = StudentTask::latest()->paginate(5);
        $data['task'] = StudentTask::where('code', $code)->first();

        return view('dosen.pages.student-task-edit', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'jadkul_id' => 'required',
                'exp_date'  => 'required',
                'exp_time'  => 'required',
                'title' => 'required|string',
                'detail_task' => 'required'
            ],
            [
                'jadkul_id.required' => 'Jadwal kuliah wajib dipilih.',
                'exp_date' => 'Batas Akhir Tanggal wajib diisi.',
                'exp_time' => 'Batas Akhir Waktu wajib diisi.',
                'title' => 'Judul tugas kuliah wajib diisi.',
                'detail_task' => 'Detail tugas kuliah wajib diisi.',
            ]
        );
        
        // Cek apakah sudah ada tugas dengan jadkul_id yang sama
        $existingTask = StudentTask::where('jadkul_id', $request->jadkul_id)->first();
        if ($existingTask) {
            Alert::error('Error', 'Tugas untuk jadwal kuliah ini sudah ada. Silakan edit tugas yang sudah ada atau pilih jadwal kuliah lain.');
            return back()->withInput();
        }
        
        $stask = new StudentTask;
        $stask->dosen_id = Auth::guard('dosen')->user()->id;
        $stask->code = Str::random(6);
        $stask->jadkul_id = $request->jadkul_id;
        $stask->exp_date = $request->exp_date;
        $stask->exp_time = $request->exp_time;
        $stask->title = $request->title;
        $stask->detail_task = $request->detail_task;
        $stask->save();

        Alert::success('Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $code)
    {
        $request->validate(
            [
                'jadkul_id' => 'required',
                'exp_date'  => 'required',
                'exp_time'  => 'required',
                'title' => 'required|string',
                'detail_task' => 'required'
            ],
            [
                'jadkul_id.required' => 'Jadwal kuliah wajib dipilih.',
                'exp_date' => 'Batas Akhir Tanggal wajib diisi.',
                'exp_time' => 'Batas Akhir Waktu wajib diisi.',
                'title' => 'Judul tugas kuliah wajib diisi.',
                'detail_task' => 'Detail tugas kuliah wajib diisi.',
            ]
        );
        $stask = StudentTask::where('code', $code)->first();
        $stask->dosen_id = Auth::guard('dosen')->user()->id;
        $stask->jadkul_id = $request->jadkul_id;
        $stask->exp_date = $request->exp_date;
        $stask->exp_time = $request->exp_time;
        $stask->title = $request->title;
        $stask->detail_task = $request->detail_task;
        $stask->save();

        Alert::success('Data berhasil diupdate');
        return back();
    }

    public function updateScore($code, Request $request)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:10',
            'comment' => 'nullable|string',
        ], [
            'score.required' => 'Nilai tugas wajib diisi.',
            'score.numeric' => 'Nilai tugas harus berupa angka.',
            'score.min' => 'Nilai tugas minimal 0.',
            'score.max' => 'Nilai tugas maksimal 10.',
        ]);

        $score = StudentScore::where('code', $code)->first();
        $score->score = $request->score;
        $score->comment = $request->comment;
        $score->status = 'Sudah dinilai';
        $score->save();

        $user = Mahasiswa::where('id', $request->student_id)->first();
        $khs = HasilStudi::where('student_id', $user->id)->where('smt_id', $user->taka->raw_semester)->first();
        // dd($khs->count())

        if ($khs === null) {
            $ckhs = new HasilStudi;
            $ckhs->student_id = $user->id;
            $ckhs->taka_id = $user->taka->id;
            $ckhs->smt_id = $user->taka->raw_semester;
            $ckhs->score_tugas = $request->score;
            $ckhs->max_tugas = 1;
            $ckhs->code = Str::random(6);
            $ckhs->save();
        } elseif ($khs !== null) {
            $ukhs = HasilStudi::where('student_id', $user->id)->where('smt_id', $user->taka->raw_semester)->first();
            $ukhs->score_tugas += $request->score;
            $ukhs->max_tugas += 1;
            $ukhs->save();
        }

        Alert::success('success', 'Tugas berhasil dinilai');
        return back();
    }

    public function destroy($code)
    {
        $stask = StudentTask::where('code', $code)->first();
        $stask->delete();

        Alert::success('success', 'Data berhasil dihapus');
        return back();
    }

    public function download($code, $fileNumber)
    {
        try {
            $score = StudentScore::where('code', $code)->firstOrFail();
            $fileKey = 'file_' . $fileNumber;
            
            if (empty($score->{$fileKey})) {
                Log::error('File download failed - empty file key: ' . $fileKey . ' for score code: ' . $code);
                Alert::error('Error', 'File tidak ditemukan.');
                return back();
            }

            // Log the stored file path from database
            Log::info('Stored file path: ' . $score->{$fileKey});

            // Fix path handling to use correct directory separators
            $filePath = str_replace('/', DIRECTORY_SEPARATOR, storage_path('app/public/' . $score->{$fileKey}));
            
            // Log the constructed file path
            Log::info('Attempting to download file: ' . $filePath);
            
            if (!file_exists($filePath)) {
                // Log the attempted file path and storage path for debugging
                Log::error('File download failed - file not found: ' . $filePath);
                Log::error('Storage path base: ' . storage_path('app/public'));
                Alert::error('Error', 'File tidak ditemukan di server.');
                return back();
            }

            // Log file size and permissions
            Log::info('File exists, size: ' . filesize($filePath));
            Log::info('File permissions: ' . substr(sprintf('%o', fileperms($filePath)), -4));

            $extension = pathinfo($score->{$fileKey}, PATHINFO_EXTENSION);
            $fileName = $score->student->mhs_name . '_tugas_' . $fileNumber . '.' . $extension;

            // Add force download header and specify file size for better download handling
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Length' => filesize($filePath)
            ];

            return response()->download($filePath, $fileName, $headers);
        } catch (\Exception $e) {
            Log::error('File download error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Alert::error('Error', 'Terjadi kesalahan saat mengunduh file: ' . $e->getMessage());
            return back();
        }
    }
}
