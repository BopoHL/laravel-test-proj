<?php

namespace App\DTO;

class FuelSensorDTO
{
    public function __construct(
        private int $fuelAmount,
        private int $vehicle_id,
    )
    {
    }

    public function getFuelAmount(): string
    {
        return $this->fuelAmount;
    }

    public function getVehicleId(): int
    {
        return $this->vehicle_id;
    }

    public static function fromArray(array $data): static
    {
        return new static(fuelAmount: $data['fuelAmount'], vehicle_id: $data['vehicle_id']);
    }


}
