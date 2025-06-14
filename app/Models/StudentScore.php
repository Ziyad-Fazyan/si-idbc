<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studentTask()
    {
        return $this->belongsTo(StudentTask::class, 'stask_id');
    }

    public function student()
    {
        return $this->belongsTo(Mahasiswa::class, 'student_id',);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
