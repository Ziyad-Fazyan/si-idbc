<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MahasiswaDetails extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getAgamaAttribute($value)
    {
        $mhsrelis = [
            0 => 'Belum Memilih',
            1 => 'Agama Islam',
            2 => 'Agama Kristen Katholik',
            3 => 'Agama Kristen Protestan',
            4 => 'Agama Hindu',
            5 => 'Agama Buddha',
            6 => 'Agama Konghuchu',
            7 => 'Kepercayaan Lainnya',
        ];

        return isset($mhsrelis[$value]) ? $mhsrelis[$value] : 'Unknown';
    }


    public function getRawMhsReliAttribute()
    {
        return $this->attributes['mhs_reli'];
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
