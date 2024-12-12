<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{
    public function index(){
        $plans = Plan::all();
        return view('front.subscribe' , compact('plans'));
    }

    public function store(Request $request){

        // Authorize the action using the merchant_subscription gate
        if (Gate::allows('merchant_subscription')) {
            return redirect()->route('plan')
                                ->with('error', ' عذرًا، لديك اشتراك نشط حاليًا. يُرجى الانتظار حتى انتهاء اشتراكك الحالي لتتمكن من الاشتراك مرة أخرى. ');
        }
            

        $validated = $request->validate([
            'plan_id' => ['required' , 'integer'],
            'period' => ['required' , 'int' , 'min:1']

        ]);

        $plan = Plan::findOrFail($request->post('plan_id'));
        $periodInMonths = (int) $validated['period'];


        Subscription::create([
            'plan_id' => $plan->id,
            'user_id' => $request->user()->id,
            'price' => $plan->price,
            // sensrio
            'start_subscription_data' => now(),
            // 
            'subscription_end_data'  => Carbon::now()->addMonths($periodInMonths),
            'status' => 'active',
            'is_subscribed' => 'true'
        ]);


    }
}
