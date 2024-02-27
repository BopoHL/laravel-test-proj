<?php

namespace App\Services\OrganizationServices;

use App\Contracts\IOrganizationRepository;
use App\Exceptions\BusinessException;
use App\Models\Organization;

class UpdateOrganizationService
{
    public function __construct(private IOrganizationRepository $repository)
    {
    }
    public function updateOrganization(array $validated, $organizationId): Organization
    {
        $organization = $this->repository->getOrganizationById($organizationId);

        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }
        $organization->update($validated);
        return $organization;
    }
}
