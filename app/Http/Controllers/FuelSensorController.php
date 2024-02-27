<?php

namespace App\Http\Controllers;

use App\Contracts\IFuelSensorRepository;
use App\DTO\FuelSensorDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\FuelSensorRequest;
use App\Http\Resources\FuelSensorResource;
use App\Services\FuelSensorServices\CreateFuelSensorService;
use App\Services\FuelSensorServices\DeleteFuelSensorService;
use App\Services\FuelSensorServices\UpdateFuelSensorService;
use App\Services\VehicleServices\VehiclesFuelSensorsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FuelSensorController extends Controller
{

    public function __construct(private IFuelSensorRepository $repository)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $fuelSensors = $this->repository->getAllFuelSensors();
        return FuelSensorResource::collection($fuelSensors);
    }

    public function store(FuelSensorRequest $request, CreateFuelSensorService $service):
    FuelSensorResource
    {
        $validated = $request->validated();
        $fuelSensor = $service->createFuelSensor(FuelSensorDTO::fromArray($validated));
        return new FuelSensorResource($fuelSensor);
    }

    /**
     * @throws BusinessException
     */
    public function show(int $id): FuelSensorResource
    {
        $fuelSensor = $this->repository->getFuelSensorById($id);

        if ($fuelSensor === null) {
            throw new BusinessException(__('messages.fuelSensor_not_found'));
        }
        return new FuelSensorResource($fuelSensor);
    }

    /**
     * @throws BusinessException
     */
    public function update(FuelSensorRequest $request, UpdateFuelSensorService $service, int $fuelSensorId): FuelSensorResource
    {
        $validated = $request->validated();
        $fuelSensor = $service->updateFuelSensor($validated, $fuelSensorId);
        return new FuelSensorResource($fuelSensor);
    }

    /**
     * @throws BusinessException
     */
    public function destroy(int $id, DeleteFuelSensorService $service): JsonResponse
    {
        $result = $service->deleteFuelSensor($id);
        return response()->json(["result" => "$result"]);
    }

    /**
     * @throws BusinessException
     */
    public function getVehicleFuelSensors(
        int                             $fuelSensorId,
        VehiclesFuelSensorsService $service
    ):
    AnonymousResourceCollection
    {
        $fuelSensors = $service->getVehicleFuelSensors($fuelSensorId);
        return FuelSensorResource::collection($fuelSensors);
    }

    /**
     * @throws BusinessException
     */
    public function getVehicleFuelSensor(
        int                             $vehicleId,
        int                             $fuelSensorId,
        VehiclesFuelSensorsService $service
    ): FuelSensorResource
    {
        $fuelSensor = $service->getVehicleFuelSensor($vehicleId, $fuelSensorId);
        return new FuelSensorResource($fuelSensor);
    }
}
