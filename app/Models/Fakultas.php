<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function head()
    {
        return $this->belongsTo(Dosen::class, 'head_id');
    }

    public function programStudis()
    {
        return $this->hasMany(ProgramStudi::class, 'faku_id');
    }
}
