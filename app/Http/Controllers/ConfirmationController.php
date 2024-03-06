<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConfirmationController extends Controller
{

    public function __construct(private IUserRepository $repository)
    {

    }
    public function confirmEmail($token)
    {
        $email = Cache::get('confirmation_token_' . $token);

        if ($email !== null) {
            $user = $this->repository->getUserByEmail($email);
            $user->update(
                ['confirmed_email' => 'confirmed']
            );
            return new UserResource($user);
        } else {
            throw new BusinessException('Token undefined');
        }
    }
}
