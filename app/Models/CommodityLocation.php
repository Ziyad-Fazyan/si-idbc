<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommodityLocation extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the commodities associated with the commodity location.
     */
    public function commodities()
    {
        return $this->hasMany(Commodity::class);
    }
}
