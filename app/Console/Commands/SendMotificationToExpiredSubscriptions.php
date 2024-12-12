<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\ExpiredSubscriptionNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendMotificationToExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-motification-to-expired-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
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
