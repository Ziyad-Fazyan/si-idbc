<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ATTRIBUTES ID HARI
    public function getDaysIdAttribute($value)
    {
        $daysids = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => "Jum'at",
            6 => 'Sabtu',
        ];

        return isset($daysids[$value]) ? $daysids[$value] : 'Unknown';
    }

    public function getRawDaysIdAttribute()
    {
        return $this->attributes['days_id'];
    }

    // ATTRIBUTES ID METODE PERTEMUAN
    public function getMethIdAttribute($value)
    {
        $methids = [
            0 => 'Tatap Muka',
            1 => 'Teleconference',
        ];

        return isset($methids[$value]) ? $methids[$value] : 'Unknown';
    }

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'makul_id',);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }
}
