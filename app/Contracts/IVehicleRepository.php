<?php

namespace App\Contracts;

use App\DTO\VehicleDTO;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

interface IVehicleRepository
{
    public function getAllVehicles(): ?Collection;

    public function getVehicleById(int $vehicleId): ?Vehicle;

    public function createVehicle(VehicleDTO $vehicleDTO): Vehicle;
}
