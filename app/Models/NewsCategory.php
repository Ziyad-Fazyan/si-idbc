<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(NewsPost::class, 'category_id');
    }
}
