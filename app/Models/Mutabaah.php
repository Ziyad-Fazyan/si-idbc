<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutabaah extends Model
{
    protected $fillable = ['user_id', 'tanggal', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
