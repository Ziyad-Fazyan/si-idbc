<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getDsnStatAttribute($value)
    {
        $dsnstats = [
            0 => 'Dosen Tidak Aktif',
            1 => 'Dosen Aktif',
        ];

        return isset($dsnstats[$value]) ? $dsnstats[$value] : 'Unknown';
    }

    public function getRawDsnStatAttribute()
    {
        return $this->attributes['dsn_stat'];
    }

    public function programStudis()
    {
        return $this->hasMany(ProgramStudi::class, 'head_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'dosen_id');
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_1');
    }

    public function mataKuliahs2()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_2');
    }

    public function mataKuliahs3()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_3');
    }

    public function jadwalKuliahs()
    {
        return $this->hasMany(JadwalKuliah::class, 'dosen_id');
    }

    public function absensiDosens()
    {
        return $this->hasMany(AbsensiDosen::class, 'dosen_id');
    }

    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class, 'dosen_id');
    }

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class, 'dosen_id');
    }
}
