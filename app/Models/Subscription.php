<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Subscription extends Model
{
    use HasFactory , Prunable;

    protected $fillable = [
        'user_id',
        'status', 'is_subscribed' ,'start_subscription_data' , 'subscription_end_data' , 'plan_id', 'price' 
    ];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function plan(){
        return $this->belongsTo(Plan::class)->withDefault();
    }
    
    public function prunable(){
        return static::whereDate('subscription_end_data' , '<=' , now()->subYear());
    }
}
