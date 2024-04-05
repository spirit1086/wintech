<?php
use App\Modules\User\Enums\TokenEnum;
use App\Modules\Wallet\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'api/','middleware' => ['api','throttle:60,1']], function() {
    Route::group(['namespace' => 'App\Modules\Wallet\Controllers', 'prefix' => 'wallet'], function () {
        Route::group(['middleware' => ['auth:sanctum','ability:' . TokenEnum::ACCESS_TOKEN->value]], function() {
            Route::post('/add', [WalletController::class, 'addUserWallet']);
        });
    });
});
