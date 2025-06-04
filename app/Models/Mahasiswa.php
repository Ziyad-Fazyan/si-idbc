<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";
    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getMhsStatAttribute($value)
    {
        $mhsstats = [
            0 => 'Calon Mahasiswa',
            1 => 'Mahasiswa Aktif',
            2 => 'Mahasiswa Non-Aktif',
            3 => 'Mahasiswa Alumni',
        ];

        return isset($mhsstats[$value]) ? $mhsstats[$value] : 'Unknown';
    }
    public function getRawMhsStatAttribute()
    {
        return $this->attributes['mhs_stat'];
    }

    public function getMhsPhoneAttribute($value)
    {
        // Periksa apakah nomor telepon dimulai dengan "0"
        if (strpos($value, '0') === 0) {
            // Jika ya, ubah menjadi "+62" dan hapus angka "0" di awal
            return '62' . substr($value, 1);
        }

        // Jika tidak dimulai dengan "0", biarkan seperti itu
        return $value;
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mahasiswa');
    }

    public function taka()
    {
        return $this->belongsTo(TahunAkademik::class, 'taka_id');
    }

    public function mahasiswaDetails()
    {
        return $this->hasOne(MahasiswaDetails::class);
    }
    
    public function absensiMahasiswa()
    {
        return $this->hasMany(AbsensiMahasiswa::class, 'author_id');
    }
}
