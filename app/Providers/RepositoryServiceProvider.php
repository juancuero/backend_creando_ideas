<?php

namespace App\Providers;


use App\Interfaces\Repositories\UserRepository;
use App\Interfaces\Repositories\CompanyRepository;
use App\Interfaces\Repositories\EmployeeRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentEmployeeRepository;

use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, function () {
            return new EloquentUserRepository(new User());
        });

        $this->app->singleton(CompanyRepository::class, function () {
            return new EloquentCompanyRepository(new Company());
        });

        $this->app->singleton(EmployeeRepository::class, function () {
            return new EloquentEmployeeRepository(new Employee());
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            UserRepository::class,
        ];
    }
}
