<?php

namespace App\Contracts;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function getAllUsers(): ?Collection;

    public function getUserById(int $userId): ?User;

    public function getUserByEmail(string $email): ?User;

//    public function getOrganizationUsers(int $organizationId): ?Collection;
//
//    public function getOrganizationUser(int $userId, int $organizationId): ?User;

    public function createUser(UserDTO $userDTO): User;

//    public function updateUser(array $validated, int $userId): ?User;

//    public function deleteUser(User $user);
}
