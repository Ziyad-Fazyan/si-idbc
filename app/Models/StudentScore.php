<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentScore extends Model
{
    use HasFactory, SoftDeletes;

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
