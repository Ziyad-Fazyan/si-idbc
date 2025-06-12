<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jadkul()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadkul_id',);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id',);
    }

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class, 'stask_id');
    }
}
