<?php

namespace App\Providers;

use App\Listeners\NotificationForProductAvailability;
use App\Listeners\NotificationForWaitingProductCreate;
use App\Models\User;
use App\Models\WaitingProduct;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen('product.availability' , NotificationForProductAvailability::class);
        Event::listen('waiting.product.create' , NotificationForWaitingProductCreate::class);

        Paginator::useBootstrapFive();

        // show  available waiting product button 
        Gate::define('waiting_product_available', function (User $user , WaitingProduct $waiting_product) {
            
            return $waiting_product->user_id !== $user->id;

        });


        // allow only merchant to access to add new product page
        Gate::define('add_producta_available' ,function(User $user){
            return $user->user_type === 'merchant';
        });


        //allow only subscription merchant add new product 
        Gate::define('merchant_subscription', function (User $user) {
            // Check if the user has subscriptions and if the subscriptions are not null
            if ($user->subscriptions && $user->subscriptions->isNotEmpty()) {
                // Check if the user has an active subscription
                $activeSubscription = $user->subscriptions->firstWhere('is_subscribed', true);
                return $activeSubscription && $activeSubscription->status === 'active';
            }
        
            // If no subscriptions, deny access
            return false;
        });


        // allow delete admin only by super_admin
        Gate::define('allow_delete_admin' ,function(User $user){
            return $user->role === 'super_admin';
        });
        
        //
        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }
        });
        

    }
}
