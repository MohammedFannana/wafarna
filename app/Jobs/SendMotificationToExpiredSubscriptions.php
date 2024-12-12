<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Notifications\ExpiredSubscriptionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendMotificationToExpiredSubscriptions implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscriptions = Subscription::with('user')
            ->whereDate('subscription_end_data', '=', now()->toDateString())
            ->cursor();
    
    
        foreach ($subscriptions as $subscription) {
            if ($subscription->user) {
                $subscription->user->notify(new ExpiredSubscriptionNotification($subscription));
                Log::info("Notified user {$subscription->user->id} for subscription {$subscription->id}.");
            } 
        }
    }
    

}
