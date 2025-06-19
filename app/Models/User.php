<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getTypeAttribute($value)
    {
        $types = [
            0 => 'Web Administrator',       // => Prefix web-admin  => For Website Development
            1 => 'Departement Finance',     // => Prefix finance    => For Pelayanan Administrasi Umum dan Keuangan ( BAU )
            2 => 'Departement Absen',       // => Prefix absen      => For Penerimaan Mahasiswa, Etc. ( Absen Staff )
            3 => 'Departement Academic',    // => Prefix academic   => For Pelayanan Akademik ( BAAK Staff )
            4 => 'Departement Musyrif',    // => Prefix musyrif   => For Penghubung antar departement dan dosen
            5 => 'Departement Support',     // => Prefix support    => For IT Technical, Lab Technician, Helper
            6 => 'Departement Site Manager',     // => Prefix Site Manager    => For
        ];

        return isset($types[$value]) ? $types[$value] : 'Unknown';
    }

    public function getRawTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function getAgamaAttribute($value)
    {
        $relis = [
            0 => 'Belum Memilih',
            1 => 'Agama Islam',
            2 => 'Agama Kristen Katholik',
            3 => 'Agama Kristen Protestan',
            4 => 'Agama Hindu',
            5 => 'Agama Buddha',
            6 => 'Agama Konghuchu',
            7 => 'Kepercayaan Lainnya',
        ];

        return isset($relis[$value]) ? $relis[$value] : 'Unknown';
    }


    public function getRawReliAttribute()
    {
        return $this->attributes['reli'];
    }

    public function getPhoneAttribute($value)
    {
        // Periksa apakah nomor telepon dimulai dengan "0"
        if (strpos($value, '0') === 0) {
            // Jika ya, ubah menjadi "+62" dan hapus angka "0" di awal
            return '62' . substr($value, 1);
        }

        // Jika tidak dimulai dengan "0", biarkan seperti itu
        return $value;
    }

    public function uAttendance()
    {
        return $this->hasMany(UAttendance::class, 'absen_user_id');
    }

    public function balances()
    {
        return $this->hasOne(Balance::class, 'author_id');
    }

    public function ticketSupports()
    {
        return $this->hasMany(TicketSupport::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'auth_id');
    }

    public function posts()
    {
        return $this->hasMany(NewsPost::class, 'author_id');
    }

    public function albums()
    {
        return $this->hasMany(GalleryAlbum::class, 'author_id');
    }

    public function documents()
    {
        return $this->hasMany(DocsResource::class, 'author_id');
    }
}
