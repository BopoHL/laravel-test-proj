<?php

namespace App\DTO;

class VehicleDTO
{
    public function __construct(
        private string $name,
        private int $organization_id,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromArray(array $data): static
    {
        return new static(name: $data['name'], organization_id: $data['organization_id']);
    }

    public function getOrganizationId(): int
    {
        return $this->organization_id;
    }
}
