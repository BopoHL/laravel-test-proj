<?php

namespace App\Services\FuelSensorServices;

use App\Contracts\IFuelSensorRepository;
use App\Exceptions\BusinessException;

class DeleteFuelSensorService
{
    public function __construct(private IFuelSensorRepository $repository)
    {
    }

    public function deleteFuelSensor(int $fuelSensorId): string
    {
        $fuelSensor = $this->repository->getFuelSensorById($fuelSensorId);

        if ($fuelSensor === null) {
            throw new BusinessException(__('messages.fuelSensor_not_found'));
        }
        $fuelSensor->delete();
        return __('messages.delete_successful');
    }
}
