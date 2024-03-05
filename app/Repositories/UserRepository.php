<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements IUserRepository
{

    public function getAllUsers(): ?Collection
    {
        return User::all();
    }

    public function getUserById(int $userId): ?User
    {
        /** @var User|null $user */
        $user = User::query()->find($userId);
        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $email)->first();
        return $user;
    }

//    public function getOrganizationUsers(int $organizationId): ?Collection
//    {
//        $organization = Organization::query()->find($organizationId);
//
//        if ($organization == null) {
//            return null;
//        }
//
//        return $organization->users->get();
//    }
//
//    public function getOrganizationUser(int $userId, int $organizationId): ?User
//    {
//        $organization = Organization::query()->find($organizationId);
//
//        if ($organization == null) {
//            return null;
//        }
//
//        return $organization->users->find($userId);
//    }

    public function createUser(UserDTO $userDTO): User
    {

        $user = new User();
        $user->name = $userDTO->getName();
        $user->surname = $userDTO->getSurname();
        $user->age = $userDTO->getAge();
        $user->email = $userDTO->getEmail();
        $user->confirmed_email = 'Not confirmed';

        $user->save();

        return $user;
    }

//    public function updateUser(array $validated, int $userId): ?User
//    {
//        $user = User::query()->find($userId);
//        $user->update($validated);
//
//        return $user;
//    }

//    public function deleteUser(User $user)
//    {
//        $user->delete();
//    }
}
