<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSemesterAttribute($value)
    {
        $semesters = [
            0 => 'Belum dipilih',
            1 => 'Semester I',
            2 => 'Semester II',
            3 => 'Semester III',
            4 => 'Semester IV',
            5 => 'semester V',
            6 => 'Semester VI',
            7 => 'Semester VII',
            8 => 'Semester VIII',
        ];

        return isset($semesters[$value]) ? $semesters[$value] : 'Unknown';
    }


    public function getRawSemesterAttribute()
    {
        return $this->attributes['semester'];
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'taka_id');
    }

    public function programKuliahs()
    {
        return $this->hasMany(ProgramKuliah::class, 'taka_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'taka_id');
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'taka_id');
    }
}
