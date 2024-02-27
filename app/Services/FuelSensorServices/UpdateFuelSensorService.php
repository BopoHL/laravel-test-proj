<?php

namespace App\Services\FuelSensorServices;

use App\Contracts\IFuelSensorRepository;
use App\Exceptions\BusinessException;
use App\Models\FuelSensor;

class UpdateFuelSensorService
{
    public function __construct(private IFuelSensorRepository $repository)
    {
    }
    public function updateFuelSensor(array $validated, $fuelSensorId): FuelSensor
    {
        $fuelSensor = $this->repository->getFuelSensorById($fuelSensorId);

        if ($fuelSensor === null) {
            throw new BusinessException(__('messages.fuelSensor_not_found'));
        }
        $fuelSensor->update($validated);
        return $fuelSensor;
    }
}
