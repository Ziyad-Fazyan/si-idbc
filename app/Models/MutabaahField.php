<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutabaahField extends Model
{
    protected $fillable = ['field_name', 'label', 'field_type', 'options'];

    protected $casts = [
        'options' => 'array',
    ];
}
