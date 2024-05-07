<?php

namespace App\Providers;

use App\Interfaces\Services\ReadingServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Services\ReReadingServiceInterface;
use App\Interfaces\Services\WorkFileServiceInterface;
use App\Interfaces\Services\WorkRouteServiceInterface;
use App\Models\Reading;
use App\Models\RouteReReading;
use App\Models\WorkRouteProgramation;
use App\Models\WorkRoute;
use App\Models\WorkClient;
use App\Observers\ReadingObserver;
use App\Observers\WorkRouteProgramationObserver;
use App\Observers\WorkRouteObserver;
use App\Observers\WorkClientObserver;
use App\Observers\RouteReReadingObserver;
use App\Observers\V1\ActionByObserver;
use App\Services\ReadingService;
use App\Services\UserService;
use App\Services\WorkFileService;
use App\Services\ReReadingService;
use App\Services\WorkRouteService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $services = [
            UserServiceInterface::class => UserService::class,
        ];

        foreach ($services as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ActionByObserve
        foreach (glob(app_path('Models/*.php')) as $filename) {
            $modelName = 'App\\Models\\' . str_replace('.php', '', basename($filename));
            $reflectionClass = new \ReflectionClass($modelName);

            if ($reflectionClass->isSubclassOf(Model::class)) {
                $modelName::observe(ActionByObserver::class);
            }
        }

        //Custom Observers
    }
}
