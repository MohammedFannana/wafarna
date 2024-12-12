<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user_type = User::where('id' ,'=' , Auth::id())->value('user_type');
        $categories = Category::all(['id', 'name']);
        $merchant = User::findOrFail(Auth::id());

        $categoryMerchantIds = $merchant->categories()->pluck('id','name')->toArray();


        
        if($user_type == "customer"){

            return view('profile.user-profile', [
                'user' => $request->user(),
            ]);

        }else if($user_type == "merchant"){
            return view('profile.merchant-profile', [

                'user' => $request->user(),
                'categories' => $categories,
                'categoryMerchantIds' => $categoryMerchantIds,
            ]);
        }
        
        
    }

    // convert customer to merchant
    public function convertCustomerToMerchant(Request $request){

        $categories = Category::all(['id', 'name']);
        $merchant = User::findOrFail(Auth::id());
        $categoryMerchantIds = $merchant->categories()->pluck('id','name')->toArray();


        return view('profile.merchant-profile', [
            'user' => $request->user(),
            'categories' => $categories,
            'categoryMerchantIds' => $categoryMerchantIds,
        ]);
    }

    

    public function update(Request $request, string $id)
    {


        $user = User::findOrFail($id);

        $validated = $request->validate([
            'user_type' => ['in:customer,merchant'],
            'phone' => ['required', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string','email','max:255',Rule::unique(User::class)->ignore($user->id),
            ],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],

            'discription' => ['nullable','string',Rule::requiredIf($user->user_type == 'merchant')],
            'commercial_register' => ['nullable',Rule::requiredIf($user->user_type == 'merchant'),'numeric', Rule::unique(User::class)->ignore($user->id)],
            // ,Rule::requiredIf($user->user_type == 'merchant')
            'categories_id' =>['nullable','array' , function ($attribute, $value, $fail) use ($user) {
                if ($user->user_type === 'merchant' && empty($value)) {
                    $fail($attribute.' is required for merchant.');
                }
            },],
            'categories_id.*' => ['exists:categories,id'],
            'website_link' => ['nullable' , 'url'], 
        ]);


        $old_image = $user->image;

        $validated = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('/images/profiles', 'public');

            $validated['image'] = $path;
        }

        DB::beginTransaction();

        try{

            $user->update($validated);

            // after update image delete the old image
            if ($old_image && $old_image != $user->image) {
                Storage::disk('public')->delete($old_image);
            }
    
            $user_type = User::where('id' ,'=' , Auth::id())->value('user_type');
    
    
            if($user_type == "merchant"){
    
                
                CategoryUser::where('user_id' ,$request->user()->id )->delete();
    
    
                foreach($request->categories_id ?? [] as $category_id){
    
                    CategoryUser::create([
                        'user_id' => $request->user()->id,
                        'category_id' => $category_id
                    ]);
    
                }
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('profile.edit')->with('error', $e->getMessage())->withInput();

        }




        return redirect()->route('profile.edit')->with('success', 'تم تعديل البيانات بنجاح');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function password(){
        return view('profile.update-password');
    }


}
