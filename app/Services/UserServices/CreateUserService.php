<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Jobs\SendConfirmationEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

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

        $confirmationToken = Str::uuid();
        Cache::put('confirmation_token_' . $confirmationToken, $userDTO->getEmail(), 600);
        $confirmationLink = route('confirm.email', ['token' => $confirmationToken]);

        dispatch(new SendConfirmationEmail($userDTO->getEmail(), $confirmationLink));


        return $this->repository->createUser($userDTO);
    }
}
