<?php

namespace App\Services\VehicleServices;

use App\Contracts\IVehicleRepository;
use App\Exceptions\BusinessException;
use App\Models\Vehicle;

class UpdateVehicleService
{
    public function __construct(private IVehicleRepository $repository)
    {
    }
    public function updateVehicle(array $validated, $vehicleId): Vehicle
    {
        $vehicle = $this->repository->getVehicleById($vehicleId);

        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }
        $vehicle->update($validated);
        return $vehicle;
    }
}
