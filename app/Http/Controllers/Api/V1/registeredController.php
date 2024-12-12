<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CategoryUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class registeredController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_type'=> ['required' , 'in:customer,merchant'],
            'email' => ['required', 'email', 'max:255',  Rule::unique(User::class)],
            'phone' => ['required', 'string', 'max:255',  Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'commercial_register' => ['int' , 'nullable', Rule::requiredIf($request->user_type == 'merchant') ,  Rule::unique(User::class) ],
            // 'category_id' => ['nullable', "required_if:user_type,==,merchant", "exists:categories,id"]
            'categories_id' =>['nullable','array' , "required_if:user_type,==,merchant",
            ],
            'categories_id.*' => ['exists:categories,id'],
        ]);


        DB::beginTransaction();

        try{

            if($request->user_type === 'customer'){

                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'user_type' => $validated['user_type'],
                    'role' => 'user',
                    'password' => Hash::make($validated['password']),
                ]);
    
            }else if($request->user_type === 'merchant'){
                
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
    


            DB::commit();


        }catch(Exception $e){

            DB::rollBack();
            return Response::json([
                'message' => 'error',
            ],400);

        }


        // Auth::guard('sanctum')->login($user);

        return[
            'code' => 200,
            'message' => "تم تسجيل الحساب بنجاح",
        ];

    }
}
