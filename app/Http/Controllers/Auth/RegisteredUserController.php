<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::all(['id', 'name']);
        return view('auth.register' , [
            'categories' => $categories
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_type'=> ['required' , 'in:customer,merchant'],
            'email' => ['required', 'email', 'max:255',  Rule::unique(User::class)],
            'phone' => ['required', 'string', 'max:255',  Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'commercial_register' => ['int' , 'nullable', Rule::requiredIf($request->user_type == 'merchant') ,  Rule::unique(User::class) ],
            // 'category_id' => ['nullable', "required_if:user_type,==,merchant", "exists:categories,id"]
            'categories_id' =>['nullable','array' , function ($attribute, $value, $fail) use ($request) {
                if ($request->user_type === 'merchant' && empty($value)) {
                    $fail($attribute.' is required for merchant.');
                }
            },],
            'categories_id.*' => ['exists:categories,id'],
        ]);


        if($validated['user_type'] === 'customer'){

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'user_type' => $validated['user_type'],
                'role' => 'user',
                'password' => Hash::make($validated['password']),
            ]);

        }else if($validated['user_type'] === 'merchant'){
            
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'commercial_register' => $validated['commercial_register'],
                'user_type' => $validated['user_type'],
                'role' => 'user',
                'password' => Hash::make($validated['password']),
            ]);
        }


        event(new Registered($user));

        if($user->user_type == "merchant"){

            
            CategoryUser::where('user_id' ,$user->id )->delete();


            foreach($validated['categories_id'] ?? [] as $category_id){

                CategoryUser::create([
                    'user_id' => $user->id,
                    'category_id' => $category_id
                ]);

            }
        }


        Auth::login($user);

        return redirect()->route('home');
    }
}
