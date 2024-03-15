<?php

namespace App\Providers;

use App\Modules\Rate\Interfaces\RateInterface;
use App\Modules\Rate\Interfaces\RateServiceInterface;
use App\Modules\Rate\Repositories\RateRepository;
use App\Modules\Rate\Services\RateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(RateInterface::class, function (Application $app) {
            return new RateRepository();
        });
        $this->app->bind(RateServiceInterface::class, function (Application $app) {
            return new RateService();
        });
    }
}
