<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function kuri()
    {
        return $this->belongsTo(Kurikulum::class, 'kuri_id');
    }
    public function taka()
    {
        return $this->belongsTo(TahunAkademik::class, 'taka_id');
    }
    public function requ()
    {
        return $this->belongsTo(MataKuliah::class, 'requ_id');
    }
    public function pstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'pstudi_id');
    }
    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_1');
    }
    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_2');
    }
    public function dosen3()
    {
        return $this->belongsTo(Dosen::class, 'dosen_3');
    }

    public function jadwalKuliahs()
    {
        return $this->hasMany(JadwalKuliah::class, 'makul_id');
    }
}
