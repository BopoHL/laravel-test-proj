<?php

namespace App\Contracts;

use App\DTO\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

interface IOrganizationRepository
{
    public function getAllOrganizations(): ?Collection;

    public function getOrganizationById(int $organizationId): ?Organization;

    public function getOrganizationByName(string $name): ?Organization;


//    public function getUserOrganizations(int $userId): ?Collection;
//
//    public function getUserOrganization(int $organizationId, int $userId): ?Organization;

    public function createOrganization(OrganizationDTO $organizationDTO): Organization;

//    public function updateOrganization(OrganizationDTO $organizationDTO): ?Organization;
//
//    public function deleteOrganization(int $organizationId);
}
