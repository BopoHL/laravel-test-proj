<?php

namespace App\Repositories;

use App\Contracts\IFuelSensorRepository;
use App\DTO\FuelSensorDTO;
use App\Models\FuelSensor;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class FuelSensorRepository implements IFuelSensorRepository
{

    public function getAllFuelSensors(): ?Collection
    {
        return FuelSensor::all();
    }

    public function getFuelSensorById(int $fuelSensorId): ?FuelSensor
    {
        /** @var FuelSensor|null $fuelSensor */
        $fuelSensor = FuelSensor::query()->find($fuelSensorId);
        return $fuelSensor;
    }

    public function createFuelSensor(FuelSensorDTO $fuelSensorDTO): FuelSensor
    {
        $fuelSensor = new FuelSensor();
        $fuelSensor->fuel_amount = $fuelSensorDTO->getFuelAmount();
        $fuelSensor->vehicle_id = $fuelSensorDTO->getVehicleId();

        $fuelSensor->save();

        return $fuelSensor;
    }
}
