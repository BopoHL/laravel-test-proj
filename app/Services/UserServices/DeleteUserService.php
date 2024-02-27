<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Services\BusinessException;

class DeleteUserService
{
    public function __construct(private IUserRepository $repository)
    {
    }

    public function deleteUser(int $userId)
    {
        $user = $this->repository->getUserById($userId);

        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }
        $user->delete();
        return __('messages.delete_successful');
    }
}
