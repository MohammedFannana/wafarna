<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\MerchantController;
use App\Http\Controllers\Dashboard\PlanController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\WaitingProductController;
use App\Http\Middleware\DashboardAccess;
use Illuminate\Support\Facades\Route;


// , 'can:dashboard_access'

Route::middleware(['auth' , DashboardAccess::class])->as('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->middleware(['verified'])->name('dashboard');

    Route::resource('/user' , UserController::class);
    Route::resource('/admin' , AdminController::class);
    Route::resource('/category' , CategoryController::class);
    Route::resource('/merchant' , MerchantController::class);
    Route::resource('/product' , ProductController::class);
    Route::resource('/plans' , PlanController::class);

    Route::get('/product/merchants/{merchant}' , [ProductController::class ,'details'])->name('merchants.details');
    Route::resource('/waiting/products' , WaitingProductController::class);
    Route::get('/home/information' , [HomeController::class ,'index'])->name('home.information.index');
    Route::get('/home/information/{id}/edit' , [HomeController::class ,'edit'])->name('home.information.edit');
    Route::put('/home/information/{id}/update' , [HomeController::class ,'update'])->name('home.information.update');



});


?>