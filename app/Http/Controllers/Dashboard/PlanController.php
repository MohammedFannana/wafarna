<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return view('dashboard.plans.index' , compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.plans.create', [
            'plan' => new Plan()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'status' => 'active',
        ]);

        $valideted = $request->validate([
            'name' => ['required'],
            'description' => ['required', 'string'],
            'price' => ['required','numeric','min:0'],
            'period' => ['required' , 'integer','min:1'],
            'status' => ['in:active,Inactive']
        ]);


        Plan::create($valideted);
        return redirect()->route('dashboard.plans.index')->with('success', 'تم انشاء الاشتراك بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan = Plan::findOrFail($id);
        return view('dashboard.plans.edit', compact('plan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valideted = $request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'price' => ['numeric','min:0'],
            'period' => ['integer','min:1']
        ]);
    
        
        $plan = Plan::findOrFail($id);

        $plan->update($valideted);

        return redirect()->back()->with('success', 'تم تعديل الاشتراك بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect()->back()->with('success', 'تم حذف الاشتراك بنجاح');


    }
}
