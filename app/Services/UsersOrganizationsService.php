<?php

namespace App\Services;

use App\Contracts\IOrganizationRepository;
use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersOrganizationsService
{
    public function __construct(
        private IUserRepository         $userRepository,
        private IOrganizationRepository $organizationRepository,
    )
    {
    }

    public function getOrganizationUsers(int $organizationId): Collection
    {
        $organization = $this->organizationRepository->getOrganizationById($organizationId);
        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }
        return $organization->users()->get();
    }

    public function getOrganizationUser(int $organizationId, int $userId): User
    {
        $organization = $this->organizationRepository->getOrganizationById($organizationId);
        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }
        $user = $organization->users()->find($userId);

        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }
        return $user;
    }

    public function getUserOrganizations(int $userId): Collection
    {
        $user = $this->userRepository->getUserById($userId);
        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }

        return $user->organizations()->get();
    }

    public function getUserOrganization(int $userId, int $organizationId): Organization
    {
        $user = $this->userRepository->getUserById($userId);
        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }

        $organization = $user->organizations()->find($organizationId);
        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }

        return $organization;
    }
}
