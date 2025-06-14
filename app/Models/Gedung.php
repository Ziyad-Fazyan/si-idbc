<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ruangs()
    {
        return $this->hasMany(Ruang::class, 'gedung_id');
    }
}
