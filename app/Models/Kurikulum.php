<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'kuri_id');
    }
}
