<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutabaah extends Model
{
    protected $fillable = ['author_id', 'tanggal', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'author_id');
    }
}
