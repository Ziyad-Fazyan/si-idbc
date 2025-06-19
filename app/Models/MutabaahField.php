<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutabaahField extends Model
{
    use SoftDeletes;

    protected $fillable = ['field_name', 'label', 'field_type', 'options'];

    protected $casts = [
        'options' => 'array',
    ];
}
