<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServices\CreateUserService;
use App\Services\UserServices\DeleteUserService;
use App\Services\UserServices\UpdateUserService;
use App\Services\UsersOrganizationsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{

    public function __construct(private IUserRepository $repository)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $users = $this->repository->getAllUsers();
        return UserResource::collection($users);
    }

    /**
     * @throws BusinessException
     */
    public function store(UserRequest $request, CreateUserService $service): UserResource
    {
        $validated = $request->validated();
        $user = $service->createUser(UserDTO::fromArray($validated));
        return new UserResource($user);
    }

    public function show(int $id): UserResource
    {
        $user = $this->repository->getUserById($id);

        if ($user === null) {
            throw new BusinessException(__('messages.user_not_found'));
        }
        return new UserResource($user);
    }

    /**
     * @throws BusinessException
     */
    public function update(UserRequest $request, UpdateUserService $service, int $userId)
    {
        $validated = $request->validated();
        $user = $service->updateUser($validated, $userId);
        return new UserResource($user);
    }

    public function destroy(int $id, DeleteUserService $service): JsonResponse
    {
        $result = $service->deleteUser($id);
        return response()->json(["result" => "$result"]);
    }

    /**
     * @throws BusinessException
     */
    public function getOrganizationUsers(int $organizationId, UsersOrganizationsService $service): AnonymousResourceCollection
    {
        $users = $service->getOrganizationUsers($organizationId);
        return UserResource::collection($users);
    }

    /**
     * @throws BusinessException
     */
    public function getOrganizationUser(int $organizationId, int $userId, UsersOrganizationsService $service): UserResource
    {
        $user = $service->getOrganizationUser($organizationId, $userId);
        return new UserResource($user);
    }
}
