<?php

use App\Http\Controllers\Api\V1\AccessTokensController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\ForgetPassword;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\profileController;
use App\Http\Controllers\Api\V1\registeredController;
use App\Http\Controllers\Api\V1\WaitingProductController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(CheckApiToken::class)->prefix('/v1')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('products/', [ProductsController::class, 'store']);
        Route::get('products/{category}', [ProductsController::class, 'index']);

        Route::get('waitingProduct/', [WaitingProductController::class, 'index']);
        Route::post('waitingProduct/', [WaitingProductController::class, 'store']);
        Route::put('waitingProduct/{waitingProduct}', [WaitingProductController::class, 'update']);

        Route::get('notification/', [NotificationController::class, 'index']);
        Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'destroy']);

        Route::get('/profile', [profileController::class, 'index']);
        Route::put('/profile/{profile}', [profileController::class, 'update']);

        Route::post('profile/change-password', [profileController::class, 'change_password']);
    });

    Route::post('forget-password', [ForgetPassword::class, 'forget_password']);
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])->middleware('guest:sanctum');
    Route::post('auth/register', [registeredController::class, 'store'])->middleware('guest:sanctum');
});
