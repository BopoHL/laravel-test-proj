<?php

namespace App\Services\VehicleServices;

use App\Contracts\IVehicleRepository;
use App\DTO\VehicleDTO;
use App\Models\Vehicle;

class CreateVehicleService
{
    public function __construct(private IVehicleRepository $repository)
    {
    }

    public function createVehicle(VehicleDTO $vehicleDTO): Vehicle
    {
        return $this->repository->createVehicle($vehicleDTO);
    }
}
