<?php

namespace App\Providers;

use App\Modules\ApiServices\Interfaces\BankRatesServiceInterface;
use App\Modules\ApiServices\Services\CbrApiService;
use App\Modules\Rate\Interfaces\RateInterface;
use App\Modules\Rate\Interfaces\RateServiceInterface;
use App\Modules\Rate\Repositories\RateRepository;
use App\Modules\Rate\Services\RateService;
use App\Modules\User\Interfaces\UserRepositoryInterface;
use App\Modules\User\Interfaces\UserServiceInterface;
use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Services\UserService;
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
            return new RateService(new RateRepository());
        });
        $this->app->bind(BankRatesServiceInterface::class, function (Application $app) {
            return new CbrApiService();
        });
        $this->app->bind(UserRepositoryInterface::class, function (Application $app) {
            return new UserRepository();
        });
        $this->app->bind(UserServiceInterface::class, function (Application $app) {
            return new UserService(new UserRepository());
        });
    }
}
