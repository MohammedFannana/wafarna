<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', '=', 'admin')
        ->orWhere('role', '=', 'super_admin')->paginate(8);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = new User();
        return view('dashboard.admins.create',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'role' => 'admin',
    
        ]);

        $valideted = $request->validate([
            'phone' => ['required', Rule::unique('users')],
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['string', 'in:admin'],
            'user_type' => ['string', 'in:customer,merchant'],
            'commercial_register' => ['int' , 'nullable', Rule::requiredIf($request->user_type == 'merchant') ,  Rule::unique(User::class) ],
        ]);

        Hash::make($valideted['password']);

        
        $user = User::create($valideted);

        if($user->user_type === 'merchant'){
            Subscription::create([
                'user_id' => $user->id,
                'status' => 'active',
                'is_subscribed' => 'true',
                'start_subscription_data' => now(),
                'price' => '0',
            ]);
        }


        return redirect()->route('dashboard.admin.index')->with('success', 'تم انشاء المسؤول بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::where('id', '=', $id)->first();
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $valideted = $request->validate([
            'phone' => [Rule::unique(User::class)->ignore($id)],
            'name' => ['string', 'min:3'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'commercial_register' => ['int' , 'nullable', Rule::requiredIf($request->user_type == 'merchant') ,  Rule::unique(User::class)->ignore($id) ],
            'user_type'=> ['in:customer,merchant'],
        ]);

        $user = User::findOrFail($id);

        $user->update($valideted);

        if($user->user_type === 'merchant'){
            Subscription::create([
                'user_id' => $user->id,
                'status' => 'active',
                'is_subscribed' => 'true',
                'start_subscription_data' => now(),
                'price' => '0',
            ]);
        }

        return redirect()->back()->with('success', 'تم تعديل بيانات المسؤول  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('allow_delete_admin')) {
            abort(403);
        }

        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('dashboard.admin.index')->with('success', 'تم حذف المسؤول بنجاح');
    }
}
