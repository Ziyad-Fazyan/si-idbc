<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiMahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getAbsenTypeAttribute($value)
    {
        $absentypes = [
            'H' => 'Hadir',
            'S' => 'Sakit',
            'I' => 'Izin',
        ];

        return isset($absentypes[$value]) ? $absentypes[$value] : 'Unknown';
    }

    public function getRawAbsenTypeAttribute()
    {
        return $this->getRawOriginal('absen_type') ?? 'Unknown';
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'author_id');
    }
    public function jadkul()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadkul_id');
    }
}
