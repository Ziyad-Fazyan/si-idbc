<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteManage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'additional_content' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public static function getContent($section)
    {
        return self::where('section', $section)
            ->where('is_active', true)
            ->first();
    }
}
