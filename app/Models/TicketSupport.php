<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketSupport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function getDeptIdAttribute($value)
    {
        $deptIds = [
            0 => 'Web Administrator',       // => Prefix web-admin  => For Website Development
            1 => 'Departement Finance',     // => Prefix finance    => For Pelayanan Administrasi Umum dan Keuangan ( BAU )
            2 => 'Departement Absen',       // => Prefix absen    => For Penerimaan Mahasiswa, Etc. ( Absen Staff )
            3 => 'Departement Academic',    // => Prefix academic   => For Pelayanan Akademik ( BAAK Staff )
            4 => 'Departement Musyrif',    // => Prefix musyrif      => For Penghubung antar departement dan dosen
            5 => 'Departement Support',     // => Prefix support    => For IT Technical, Lab Technician, Helper
            6 => 'Departement Site Manager',     // => Prefix Site Manager    => For 
        ];

        return isset($deptIds[$value]) ? $deptIds[$value] : 'Unknown';
    }

    public function getRawDeptIdAttribute()
    {
        return $this->attributes['dept_id'];
    }
    public function getPrioIdAttribute($value)
    {
        $prioIds = [
            0 => 'Rendah',
            1 => 'Medium',
            2 => 'Tinggi',
            3 => 'Urgent',
        ];

        return isset($prioIds[$value]) ? $prioIds[$value] : 'Unknown';
    }

    public function getRawPrioIdAttribute()
    {
        return $this->attributes['prio_id'];
    }
    public function getStatIdAttribute($value)
    {
        $statIds = [
            0 => 'Open',
            1 => 'In Progress',
            2 => 'Closed',
            3 => 'Answered',
            4 => 'Student Reply',
            5 => 'On Hold',
            6 => 'Pending Student',
        ];

        return isset($statIds[$value]) ? $statIds[$value] : 'Unknown';
    }

    public function getRawStatIdAttribute()
    {
        return $this->attributes['stat_id'];
    }

    public function users()
    {
        return $this->belongsTo(Mahasiswa::class, 'users_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
