<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CreateWaitingProductNotification;
use App\Notifications\ProductAvailabilityNotification;
use Illuminate\Support\Facades\Notification;

class NotificationForWaitingProductCreate
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
    public function handle($waiting_product)
    {
        $users = User::whereHas('categories', function ($query) use ($waiting_product) {
            $query->where('category_id', $waiting_product->category_id);
        })->get();


        foreach($users as $user){

            Notification::send($user , new CreateWaitingProductNotification);

        }

    }
}
