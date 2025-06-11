<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'kuri_id');
    }
}
