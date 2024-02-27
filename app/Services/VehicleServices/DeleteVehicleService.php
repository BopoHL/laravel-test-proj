<?php

namespace App\Services\VehicleServices;

use App\Contracts\IVehicleRepository;
use App\Exceptions\BusinessException;

class DeleteVehicleService
{
    public function __construct(private IVehicleRepository $repository)
    {
    }

    public function deleteVehicle(int $vehicleId): string
    {
        $vehicle = $this->repository->getVehicleById($vehicleId);

        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }
        $vehicle->delete();
        return __('messages.delete_successful');
    }
}
