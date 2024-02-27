<?php

namespace App\Services\VehicleServices;

use App\Contracts\IVehicleRepository;
use App\Exceptions\BusinessException;
use App\Models\FuelSensor;
use Illuminate\Database\Eloquent\Collection;

class VehiclesFuelSensorsService
{
    public function __construct(
        private IVehicleRepository $vehicleRepository,
    )
    {
    }

    public function getVehicleFuelSensors(int $vehicleId): Collection
    {
        $vehicle = $this->vehicleRepository->getVehicleById($vehicleId);
        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }

        return $vehicle->fuelSensors()->get();
    }

    public function getVehicleFuelSensor(int $vehicleId, int $fuelSensorId): FuelSensor
    {
        $vehicle = $this->vehicleRepository->getVehicleById($vehicleId);
        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }

        $fuelSensor = $vehicle->fuelSensors()->find($fuelSensorId);
        if ($fuelSensor === null) {
            throw new BusinessException(__('messages.fuel_sensor_not_found'));
        }
        return $fuelSensor;
    }
}
