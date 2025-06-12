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
    
    public function mahasiswaDetails()
    {
        return $this->hasOne(MahasiswaDetails::class);
    }

    public function taka()
    {
        return $this->belongsTo(TahunAkademik::class, 'taka_id');
    }

    public function year()
    {
        return $this->belongsTo(TahunAkademik::class, 'year_id');
    }

    public function absensiMahasiswas()
    {
        return $this->hasMany(AbsensiMahasiswa::class, 'author_id');
    }

    public function tagihanKuliahs()
    {
        return $this->hasMany(TagihanKuliah::class, 'users_id');
    }

    public function ticketSupports()
    {
        return $this->hasMany(TicketSupport::class, 'users_id');
    }

    public function studentScores()
    {
        return $this->hasMany(StudentScore::class, 'student_id');
    }

    public function hasilStudis()
    {
        return $this->hasMany(HasilStudi::class, 'student_id');
    }

    public function mutabaahs()
    {
        return $this->hasMany(Mutabaah::class, 'author_id');
    }
}
