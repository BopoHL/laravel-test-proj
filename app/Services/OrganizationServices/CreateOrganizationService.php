<?php

namespace App\Services\OrganizationServices;

use App\Contracts\IOrganizationRepository;
use App\DTO\OrganizationDTO;
use App\Exceptions\BusinessException;
use App\Models\Organization;

class CreateOrganizationService
{
    public function __construct(private IOrganizationRepository $repository)
    {
    }

    public function createOrganization(OrganizationDTO $organizationDTO): Organization
    {
        $organizationWithName = $this->repository->getOrganizationByName
        ($organizationDTO->getName());

        if ($organizationWithName !== null) {
            throw new BusinessException(__('messages.organization_already_exist'));
        }

        return $this->repository->createOrganization($organizationDTO);
    }
}
