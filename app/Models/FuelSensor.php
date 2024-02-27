<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int fuel_amount
 * @property int vehicle_id
 */
class FuelSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuel_amount',
        'vehicle_id'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
