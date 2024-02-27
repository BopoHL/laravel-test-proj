<?php

use App\Http\Controllers\FuelSensorController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user_id}', [UserController::class, 'show']);
Route::delete('/users/{user_id}', [UserController::class, 'destroy']);
Route::post('/users', [UserController::class, 'store']);
Route::match(['put', 'patch'], '/users/{user_id}', [UserController::class, 'update']);

Route::get('/organizations/{organization_id}/users', [UserController::class, 'getOrganizationUsers']);
Route::get('/organizations/{organization_id}/users/{user_id}', [UserController::class, 'getOrganizationUser']);

Route::get('/organizations', [OrganizationController::class, 'index']);
Route::get('/organizations/{organization_id}', [OrganizationController::class, 'show']);
Route::delete('/organizations/{organization_id}', [OrganizationController::class, 'destroy']);
Route::post('/organizations', [OrganizationController::class, 'store']);
Route::match(['put', 'patch'], '/organizations/{organization_id}', [OrganizationController::class,
    'update']);

Route::get('/users/{user_id}/organizations', [OrganizationController::class, 'getUserOrganizations']);
Route::get('/users/{user_id}/organizations/{organization_id}', [OrganizationController::class, 'getUserOrganization']);

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehicles/{vehicle_id}', [VehicleController::class, 'show']);
Route::delete('/vehicles/{vehicle_id}', [VehicleController::class, 'destroy']);
Route::post('/vehicles', [VehicleController::class, 'store']);
Route::match(['put', 'patch'], '/vehicles', [VehicleController::class, 'update']);

Route::get('/organizations/{organization_id}/vehicles', [VehicleController::class, 'getOrganizationVehicles']);
Route::get('/organizations/{organization_id}/vehicles/{vehicle_id}', [VehicleController::class, 'getOrganizationVehicle']);

Route::get('/fuelsensors', [FuelSensorController::class, 'index']);
Route::get('/fuelsensors/{fuelsensor_id}', [FuelSensorController::class, 'show']);
Route::delete('/fuelsensors/{fuelsensor_id}', [FuelSensorController::class, 'destroy']);
Route::post('/fuelsensors', [FuelSensorController::class, 'store']);
Route::match(['put', 'patch'], '/fuelsensors/{fuelsensor_id}', [FuelSensorController::class, 'update']);

Route::get('/vehicles/{vehicle_id}/fuelsensors', [FuelSensorController::class, 'getVehicleFuelSensors']);
Route::get('/vehicles/{vehicle_id}/fuelsensors/{fuelsensor_id}', [FuelSensorController::class, 'getVehicleFuelSensor']);
