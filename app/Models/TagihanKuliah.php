<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagihanKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function prokuu()
    {
        return $this->belongsTo(ProgramKuliah::class, 'proku_id');
    }
    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'users_id');
    }
    public function historyTagihans()
    {
        return $this->hasMany(HistoryTagihan::class, 'tagihan_code');
    }
}
