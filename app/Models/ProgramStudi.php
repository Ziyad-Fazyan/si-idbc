<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function head()
    {
        return $this->belongsTo(Dosen::class, 'head_id');
    }
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'faku_id');
    }

    public function programKuliahs()
    {
        return $this->hasMany(ProgramKuliah::class, 'pstudi_id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'pstudi_id');
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'pstudi_id');
    }

    public function tagihanKuliahs()
    {
        return $this->hasMany(TagihanKuliah::class, 'prodi_id');
    }
}
