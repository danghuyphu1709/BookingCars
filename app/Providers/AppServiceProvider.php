<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Interface\UserRepositoryInterface::class,\App\Repositories\Repository\UserRepository::class);
        $this->app->bind(\App\Repositories\Interface\PermissionsInterface::class,\App\Repositories\Repository\PermissionsRepository::class);
        $this->app->bind(\App\Repositories\Interface\RoleInterface::class,\App\Repositories\Repository\RoleRepository::class);
        $this->app->bind(\App\Repositories\Interface\ServiceInterface::class,\App\Repositories\Repository\ServiceRepository::class);
        $this->app->bind(\App\Repositories\Interface\CarInterface::class,\App\Repositories\Repository\CarRepository::class);
        $this->app->bind(\App\Repositories\Interface\TypeCarInterface::class,\App\Repositories\Repository\TypeCarRepository::class);
        $this->app->bind(\App\Repositories\Interface\DestinationPointInterface::class,\App\Repositories\Repository\DestinationPointRepository::class);
        $this->app->bind(\App\Repositories\Interface\StartingPointInterface::class,\App\Repositories\Repository\StartingPointRepository::class);
        $this->app->bind(\App\Repositories\Interface\CityProvinceInterface::class,\App\Repositories\Repository\CityProvinceRepository::class);
        $this->app->bind(\App\Repositories\Interface\AreaInterface::class,\App\Repositories\Repository\AreaRepository::class);
        $this->app->bind(\App\Repositories\Interface\RoadRouteInterface::class,\App\Repositories\Repository\RoadRouteRepository::class);
        $this->app->bind(\App\Repositories\Interface\TicketInterface::class,\App\Repositories\Repository\TicketRepository::class);
        $this->app->bind(\App\Repositories\Interface\DepartureTimeInterface::class,\App\Repositories\Repository\DepartureTimeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
