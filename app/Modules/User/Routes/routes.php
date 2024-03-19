<?php
use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\AuthController;

Route::group(['prefix'=> 'api/','middleware' => ['api']], function() {
    Route::group(['namespace' => 'App\Modules\User\Controllers', 'prefix' => 'auth'], function () {
        Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
        Route::post('/authentification', [AuthController::class, 'authentification'])->name('authentification');
        Route::post('/generate-token', [AuthController::class, 'generateToken'])->name('generateToken');
    });
});
