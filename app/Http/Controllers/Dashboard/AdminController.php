<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', '=', 'admin')->paginate(8);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admins.create', [
            'admin' => new User()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'role' => 'admin',
            'user_type' => 'customer',
        ]);

        $valideted = $request->validate([
            'phone' => ['required', Rule::unique('users')],
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['string', 'in:admin'],
            'user_type' => ['string', 'in:customer'],
        ]);

        Hash::make($valideted['password']);

        User::create($valideted);
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
        ]);


        $user = User::findOrFail($id);

        $user->update($valideted);

        return redirect()->back()->with('success', 'تم تعديل بيانات المسؤول  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('dashboard.admin.index')->with('success', 'تم حذف المسؤول بنجاح');
    }
}
