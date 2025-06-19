<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function taka()
    {
        return $this->belongsTo(TahunAkademik::class, 'taka_id');
    }
    public function pstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'pstudi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'proku_id');
    }

    public function tagihanKuliahs()
    {
        return $this->hasMany(TagihanKuliah::class, 'proku_id');
    }
}
