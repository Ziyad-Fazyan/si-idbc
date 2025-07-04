<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function markAsRead()
    {
        $this->read = true;
        $this->save();
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'auth_id');
    }
}
