<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsensiDosen extends Model
{
    use SoftDeletes;

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
        return $this->attributes['absen_type'];
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function jadkul() 
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadkul_id');
    }
}
