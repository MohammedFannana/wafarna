<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;

class InactiveSubscriptionMerchant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:inactive-subscription-merchant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $subscriptions = Subscription::where('subscription_end_data','<', now()->toDateString())->get();

        foreach($subscriptions as $subscription){
            $subscription->update([
                'status' => 'inactive',
                'is_subscribed' => 'false',
            ]);

        }
        
    }
}
