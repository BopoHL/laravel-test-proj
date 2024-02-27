<?php

namespace App\Repositories;

use App\Contracts\IVehicleRepository;
use App\DTO\VehicleDTO;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository implements IVehicleRepository
{

    public function getAllVehicles(): ?Collection
    {
        return Vehicle::all();
    }

    public function getVehicleById(int $vehicleId): ?Vehicle
    {
        /** @var Vehicle|null $vehicle */

        $vehicle = Vehicle::query()->find($vehicleId);
        return $vehicle;
    }

    public function createVehicle(VehicleDTO $vehicleDTO): Vehicle
    {
        $vehicle = new Vehicle();
        $vehicle->name = $vehicleDTO->getName();
        $vehicle->organization_id = $vehicleDTO->getOrganizationId();

        $vehicle->save();

        return $vehicle;
    }
}
