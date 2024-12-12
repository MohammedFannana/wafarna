<?php

use App\Console\Commands\DeleteWaitingProductEndDate;
use App\Console\Commands\InactiveSubscriptionMerchant;
use App\Console\Commands\SendMotificationToExpiredSubscriptions;
use App\Models\WaitingProduct;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(DeleteWaitingProductEndDate::class)->daily();
Schedule::command(InactiveSubscriptionMerchant::class)->daily();
Schedule::command('model:prune')->monthly('03:00');
Schedule::command(SendMotificationToExpiredSubscriptions::class)->everyMinute();
