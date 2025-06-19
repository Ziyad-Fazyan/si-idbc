<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gedung extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ruangs()
    {
        return $this->hasMany(Ruang::class, 'gedung_id');
    }
}
