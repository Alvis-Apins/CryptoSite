<?php

use App\Http\Controllers\AddMoneyController;
use App\Http\Controllers\CryptoAssetsController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyWalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index']);
    });

Route::controller(CryptoAssetsController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/crypto-assets', 'index');
        Route::post('/crypto-assets/buy', 'store')
            ->name('crypto.buy');
    });

Route::controller(AddMoneyController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/add-money', 'index');
        Route::post('/add-money/valet', 'store')
            ->name('add.money');
    });

Route::controller(EvaluationController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/evaluation', 'index');
    });

Route::controller(MyWalletController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/my-wallet', 'index');
        Route::post('/my-wallet/sell', 'store')
            ->name('crypto.sell');
        Route::post('/my-wallet/sell-all', 'store')
            ->name('crypto.sell.all');
    });
