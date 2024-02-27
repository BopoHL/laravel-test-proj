<?php

namespace App\Providers;

use App\Contracts\IFuelSensorRepository;
use App\Contracts\IOrganizationRepository;
use App\Contracts\IUserRepository;
use App\Contracts\IVehicleRepository;
use App\Repositories\FuelSensorRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IOrganizationRepository::class, OrganizationRepository::class);
        $this->app->bind(IVehicleRepository::class, VehicleRepository::class);
        $this->app->bind(IFuelSensorRepository::class, FuelSensorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
