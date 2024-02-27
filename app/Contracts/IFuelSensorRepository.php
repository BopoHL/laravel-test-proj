<?php

namespace App\Contracts;

use App\DTO\FuelSensorDTO;
use App\Models\FuelSensor;
use Illuminate\Database\Eloquent\Collection;

interface IFuelSensorRepository
{
    public function getAllFuelSensors(): ?Collection;

    public function getFuelSensorById(int $fuelSensorId): ?FuelSensor;

    public function createFuelSensor(FuelSensorDTO $fuelSensorDTO): FuelSensor;

}
