<?php

namespace App\Services\OrganizationServices;

use App\Contracts\IOrganizationRepository;
use App\Exceptions\BusinessException;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class OrganizationsVehiclesService
{
    public function __construct(
        private IOrganizationRepository $organizationRepository,
    )
    {
    }

    public function getOrganizationVehicles(int $organizationId): Collection
    {
        $organization = $this->organizationRepository->getOrganizationById($organizationId);
        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }

        return $organization->vehicles()->get();
    }

    public function getOrganizationVehicle(int $organizationId, int $vehicleId): Vehicle
    {
        $organization = $this->organizationRepository->getOrganizationById($organizationId);
        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }

        $vehicle = $organization->vehicles()->find($vehicleId);
        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }
        return $vehicle;
    }
}
