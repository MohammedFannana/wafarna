<?php

use App\Http\Controllers\Front\ComplaintController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\WaitingProductController;
use App\Http\Controllers\Front\SubscriptionController;

use App\Http\Controllers\Front\WhatsAppController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\MarkNotificationAsRead;
use Illuminate\Support\Facades\Route;


Route::get('/' , [HomeController::class ,'view'])->name('index.view')->middleware('guest');


Route::post('/complaint' , [ComplaintController::class,'sendMail'])->name('complaint.mail');



Route::middleware('auth')->group(function () {

    Route::get('/wafarna' , [HomeController::class ,'index'])->name('home');
    Route::get('/notification' , [MessageController::class ,'index'])->name('notification');
    Route::resource('/product' , ProductController::class);
    Route::middleware(MarkNotificationAsRead::class)->resource('/waitingProduct' , WaitingProductController::class);

    Route::middleware(MarkNotificationAsRead::class)->get('plan', [SubscriptionController::class , 'index'])->name('plan');

    Route::post('subscriptions', [SubscriptionController::class , 'store'])->name('subscriptions.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/convert', [ProfileController::class, 'convertCustomerToMerchant'])->name('profile.convert');

    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/password', [ProfileController::class, 'password'])->name('password.edit');
    Route::middleware(MarkNotificationAsRead::class)->get('/send-whatsapp/{phone}/{message}', [WhatsAppController::class, 'sendWhatsApp'])->name('whatsapp');
});



require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

