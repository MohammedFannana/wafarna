<?php

namespace App\Listeners;

use App\Notifications\ProductAvailabilityNotification;
use Illuminate\Support\Facades\Notification;

class NotificationForProductAvailability
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($waiting_product): void
    {
        
        Notification::send($waiting_product->user , new ProductAvailabilityNotification($waiting_product));

    }
}
