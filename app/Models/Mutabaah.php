<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mutabaah extends Model
{
    use SoftDeletes;

    protected $fillable = ['author_id', 'tanggal', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'author_id');
    }
}
