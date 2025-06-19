<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbum extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Get author name with fallback for deleted users
    public function getAuthorNameAttribute()
    {
        return $this->author ? $this->author->name : 'Unknown Author';
    }

    // Relationship with author (assuming 'author_id' points to a User model)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
