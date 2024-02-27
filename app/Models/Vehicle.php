<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property int organization_id
 * @property FuelSensor[] $fuelSensors
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization_id'
    ];

    public function fuelSensors(): HasMany
    {
        return $this->hasMany(FuelSensor::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
