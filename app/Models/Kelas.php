<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function pstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'pstudi_id');
    }
    public function proku()
    {
        return $this->belongsTo(ProgramKuliah::class, 'proku_id');
    }
    public function taka()
    {
        return $this->belongsTo(TahunAkademik::class, 'taka_id');
    }
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswa');
    }
    public function jadwalKuliahs()
    {
        return $this->hasMany(JadwalKuliah::class, 'kelas_id');
    }
}
