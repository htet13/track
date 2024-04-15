<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\CityRepository;
use App\Repositories\IssuerRepository;
use App\Repositories\CarNoRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\AdvanceEmployeeRepository;
use App\Repositories\ReportRepository;
use App\Repositories\TrackRepository;
use App\Repositories\BonusRepository;
use App\Repositories\SalaryRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\IssuerRepositoryInterface;
use App\Repositories\Interfaces\CarNoRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\AdvanceEmployeeRepositoryInterface;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\Interfaces\TrackRepositoryInterface;
use App\Repositories\Interfaces\BonusRepositoryInterface;
use App\Repositories\Interfaces\SalaryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(IssuerRepositoryInterface::class, IssuerRepository::class);
        $this->app->bind(CarNoRepositoryInterface::class, CarNoRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(AdvanceEmployeeRepositoryInterface::class, AdvanceEmployeeRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(TrackRepositoryInterface::class, TrackRepository::class);
        $this->app->bind(BonusRepositoryInterface::class, BonusRepository::class);
        $this->app->bind(SalaryRepositoryInterface::class, SalaryRepository::class);
        Paginator::useBootstrap();
    }
}
