<?php

namespace App\Models\FeedBack;

use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FBPerkuliahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function jadkul()
    {
        return $this->belongsTo(JadwalKuliah::class, 'fb_jakul_code', 'code');
    }
}
