<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getTypeAttribute($value)
    {
        $types = [
            0 => 'Ruang Kelas',
            1 => 'Ruang Laboratorium',
            2 => 'Ruang Kerja',
            3 => 'Ruang Pribadi',
            4 => 'Fasilitas Umum',
        ];

        return isset($types[$value]) ? $types[$value] : 'Unknown';
    }

    public function getRawTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }

    public function barang()
    {
        return $this->hasMany(Commodity::class);
    }
    public function jadwalKuliahs()
    {
        return $this->hasMany(JadwalKuliah::class, 'ruang_id');
    }
}
