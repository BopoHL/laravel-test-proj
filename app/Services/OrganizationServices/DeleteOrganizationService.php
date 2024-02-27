<?php

namespace App\Services\OrganizationServices;

use App\Contracts\IOrganizationRepository;

class DeleteOrganizationService
{
    public function __construct(private IOrganizationRepository $repository)
    {
    }
    public function deleteOrganization(int $organizationId): string
    {
        $organization = $this->repository->getOrganizationById($organizationId);

        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }
        $organization->delete();
        return __('messages.delete_successful');
    }
}
