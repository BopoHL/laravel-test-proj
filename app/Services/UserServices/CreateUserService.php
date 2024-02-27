<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;

class CreateUserService
{
    public function __construct(private IUserRepository $repository)
    {
    }

    public function createUser(UserDTO $userDTO)
    {
        $userWithEmail = $this->repository->getUserByEmail($userDTO->getEmail());

        if ($userWithEmail !== null) {
            throw new BusinessException(__('messages.email_already_exist'));
        }
        return $this->repository->createUser($userDTO);
    }
}
