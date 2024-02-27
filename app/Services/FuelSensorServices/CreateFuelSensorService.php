<?php

namespace App\Services\FuelSensorServices;

use App\Contracts\IFuelSensorRepository;
use App\DTO\FuelSensorDTO;
use App\Models\FuelSensor;

class CreateFuelSensorService
{
    public function __construct(private IFuelSensorRepository $repository)
    {
    }

    public function createFuelSensor(FuelSensorDTO $fuelSensorDTO): FuelSensor
    {
        return $this->repository->createFuelSensor($fuelSensorDTO);
    }
}
