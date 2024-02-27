<?php

namespace App\Http\Controllers;

use App\Contracts\IVehicleRepository;
use App\DTO\VehicleDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Services\OrganizationServices\OrganizationsVehiclesService;
use App\Services\VehicleServices\CreateVehicleService;
use App\Services\VehicleServices\DeleteVehicleService;
use App\Services\VehicleServices\UpdateVehicleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{

    public function __construct(private IVehicleRepository $repository)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $vehicles = $this->repository->getAllVehicles();
        return VehicleResource::collection($vehicles);
    }

    public function store(VehicleRequest $request, CreateVehicleService $service):
    VehicleResource
    {
        $validated = $request->validated();
        $vehicle = $service->createVehicle(VehicleDTO::fromArray($validated));
        return new VehicleResource($vehicle);
    }

    public function show(int $id): VehicleResource
    {
        $vehicle = $this->repository->getVehicleById($id);

        if ($vehicle === null) {
            throw new BusinessException(__('messages.vehicle_not_found'));
        }
        return new VehicleResource($vehicle);
    }

    /**
     * @throws BusinessException
     */
    public function update(VehicleRequest $request, UpdateVehicleService $service, int
    $vehicleId): VehicleResource
    {
        $validated = $request->validated();
        $vehicle = $service->updateVehicle($validated, $vehicleId);
        return new VehicleResource($vehicle);
    }

    /**
     * @throws BusinessException
     */
    public function destroy(int $id, DeleteVehicleService $service): JsonResponse
    {
        $result = $service->deleteVehicle($id);
        return response()->json(["result" => "$result"]);
    }

    /**
     * @throws BusinessException
     */
    public function getOrganizationVehicles(
        int $vehicleId,
        OrganizationsVehiclesService $service
    ):
    AnonymousResourceCollection
    {
        $vehicles = $service->getOrganizationVehicles($vehicleId);
        return VehicleResource::collection($vehicles);
    }

    /**
     * @throws BusinessException
     */
    public function getOrganizationVehicle(
        int $organizationId,
        int $vehicleId,
        OrganizationsVehiclesService $service
    ): VehicleResource
    {
        $vehicle = $service->getOrganizationVehicle($organizationId, $vehicleId);
        return new VehicleResource($vehicle);
    }
}
