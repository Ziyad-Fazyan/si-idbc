<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commodity extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'condition' => 'integer',
    ];

    /**
     * Get the commodity location associated with the commodity.
     */
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    /**
     * Get the commodity acquisition associated with the commodity.
     */
    public function commodity_acquisition()
    {
        return $this->belongsTo(CommodityAcquisition::class);
    }

    /**
     * Format a date value to Indonesian date format (dd-mm-yyyy).
     */
    public function indonesian_format_date($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Format a currency value to Indonesian currency format.
     */
    public function indonesian_currency($value)
    {
        return Number::format($value, 2);
    }

    /**
     * Get the name of the condition based on the condition code.
     */
    public function getConditionName()
    {
        return match ($this->condition) {
            1 => 'Baik',
            2 => 'Kurang Baik',
            3 => 'Rusak Berat',
            default => null
        };
    }
}
