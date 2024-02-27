<?php

namespace App\Http\Controllers;

use App\Contracts\IOrganizationRepository;
use App\DTO\OrganizationDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationServices\CreateOrganizationService;
use App\Services\OrganizationServices\DeleteOrganizationService;
use App\Services\OrganizationServices\UpdateOrganizationService;
use App\Services\UsersOrganizationsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrganizationController extends Controller
{

    public function __construct(private IOrganizationRepository $repository)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $organizations = $this->repository->getAllOrganizations();
        return OrganizationResource::collection($organizations);
    }

    /**
     * @throws BusinessException
     */
    public function store(OrganizationRequest $request, CreateOrganizationService $service):
    OrganizationResource
    {
        $validated = $request->validated();
        $organization = $service->createOrganization(OrganizationDTO::fromArray($validated));
        return new OrganizationResource($organization);
    }

    public function show(int $id): OrganizationResource
    {
        $organization = $this->repository->getOrganizationById($id);

        if ($organization === null) {
            throw new BusinessException(__('messages.organization_not_found'));
        }
        return new OrganizationResource($organization);
    }

    /**
     * @throws BusinessException
     */
    public function update(OrganizationRequest $request, UpdateOrganizationService $service, int $organizationId): OrganizationResource
    {
        $validated = $request->validated();
        $organization = $service->updateOrganization($validated, $organizationId);
        return new OrganizationResource($organization);
    }

    public function destroy(int $id, DeleteOrganizationService $service): JsonResponse
    {
        $result = $service->deleteOrganization($id);
        return response()->json(["result" => "$result"]);
    }

    /**
     * @throws BusinessException
     */
    public function getUserOrganizations(
        int $organizationId,
        UsersOrganizationsService $service
    ):
    AnonymousResourceCollection
    {
        $organizations = $service->getUserOrganizations($organizationId);
        return OrganizationResource::collection($organizations);
    }

    /**
     * @throws BusinessException
     */
    public function getUserOrganization(
        int $userId,
        int $organizationId,
        UsersOrganizationsService $service
    ): OrganizationResource
    {
        $organization = $service->getUserOrganization($userId, $organizationId);
        return new OrganizationResource($organization);
    }
}
