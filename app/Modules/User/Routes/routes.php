<?php
use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\AuthController;
use App\Modules\User\Enums\TokenEnum;

Route::group(['prefix'=> 'api/','middleware' => ['api','throttle:60,1']], function() {
    Route::group(['namespace' => 'App\Modules\User\Controllers', 'prefix' => 'auth'], function () {
        Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
        Route::post('/authentification', [AuthController::class, 'authentification'])->name('authentification');
        Route::post('/generate-token', [AuthController::class, 'generateToken'])->name('generateToken');
        Route::group(['middleware' => ['auth:sanctum','ability:' . TokenEnum::REFRESH_TOKEN->value]], function() {
            Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
        });
    });


});
