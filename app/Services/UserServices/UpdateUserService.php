<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;

class UpdateUserService
{
    public function __construct(private IUserRepository $repository)
    {
    }

    public function updateUser(array $validated, $userId)
    {
        $user = $this->repository->getUserById($userId);

        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }
        $user->update($validated);
        return $user;
    }
}
