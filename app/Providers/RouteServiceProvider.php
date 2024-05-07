<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutesV1();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutesV1()
    {
        Route::group([
            'prefix' => 'api/v1',
            'middleware' => 'api',
        ], function () {
            $pathRoutes = 'routes/V1';

            //API Routes Auth
            Route::prefix('auth')
            ->namespace($this->namespace)
            ->group(base_path($pathRoutes . '/Auth/api.php'));

            //API Routes Users
            Route::prefix('users')
            ->namespace($this->namespace)
            ->group(base_path($pathRoutes . '/User/api.php'));

            //API Routes Companies
            Route::prefix('companies')
            ->namespace($this->namespace)
            ->group(base_path($pathRoutes . '/Company/api.php'));


        //API Routes Companies
            Route::prefix('employees')
            ->namespace($this->namespace)
            ->group(base_path($pathRoutes . '/Employee/api.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
