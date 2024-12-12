<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

            // ->where('user_type', '=', 'merchant')
        // ->when($select_show === 'active', function ($query) {
        //     $query->where('status', '=', 'نشط');
        // })
        // ->when($select_show === 'inactive', function ($query) {
        //     $query->where('status', '=', 'غير نشط');
        // })

        $merchants = User::where('user_type', '=', 'merchant')->with(['categories'])
        ->when($request->search, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        })
        ->paginate(8);


        return view('dashboard.merchants.index', compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);
        

        return view('dashboard.merchants.create', [
            'merchant' => new User(),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'role' => 'user',
            'user_type' => 'merchant',
        ]);


        $valideted = $request->validate([
            'phone' => ['required', Rule::unique('users')],
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'discription' => ['required' , 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'status' => ['required', 'in:نشط,غير نشط'],
            'role' => ['string', 'in:user'],
            'user_type' => ['string', 'in:merchant'],
            'commercial_register' => ['required' ,'numeric' , Rule::unique('users')],
            'categories_id' =>['array' , 'required'],
            'categories_id.*' => ['exists:categories,id' ],

        ]);


        Hash::make($valideted['password']);

        DB::beginTransaction();

        try {

            $merchant = User::create($valideted);


            foreach($valideted['categories_id'] as $category_id){

                CategoryUser::create([
                    'user_id' => $merchant->id,
                    'category_id' => $category_id
                ]);

            }

        
            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }    


        return redirect()->route('dashboard.merchant.index')->with('success', 'تم اضافة تاجر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merchant = User::where('id', '=', $id)->with(['categories', 'subscriptions'])->first();
        return view('dashboard.merchants.show', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all(['id', 'name']);
        $merchant = User::findOrFail($id);
        $categoryMerchantIds = $merchant->categories()->pluck('id','name')->toArray();

        return view('dashboard.merchants.edit', compact('merchant', 'categories' ,'categoryMerchantIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $valideted = $request->validate([
            'phone' => [Rule::unique(User::class)->ignore($id)],
            'name' => ['string', 'min:3'],
            'email' => ['email',Rule::unique(User::class)->ignore($id)],
            'discription' => ['string'],
            // 'status' => ['required', 'in:نشط,غير نشط'],
            'commercial_register' => ['numeric' , Rule::unique(User::class)->ignore($id)],
            'categories_id' =>['array'],
            'categories_id.*' => ['exists:categories,id' ],

        ]);

        $merchant = User::findOrFail($id);


        DB::beginTransaction();

        try {

            $merchant->update($valideted);


            CategoryUser::where('user_id' , $merchant->id )->delete();

            foreach($valideted['categories_id'] as $category_id){

                CategoryUser::create([
                    'user_id' => $merchant->id,
                    'category_id' => $category_id
                ]);

            }

            // Validate the incoming request
            $validatedData = $request->validate([
                'subscription_end_data' => ['required', 'date', 'after:now']
            ]);

            // Update the subscription record
            Subscription::where('user_id', $merchant->id)->update([
                'subscription_end_data' => $validatedData['subscription_end_data'],
                'status' => 'active',
                'is_subscribed' => true, // Use a boolean instead of a string for consistency
            ]);

        
            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }    


        return redirect()->route('dashboard.merchant.index')->with('success', 'تم تعديل بيانات التاجر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merchant = User::findOrFail($id);
        $merchant->delete();

        return redirect()->route('dashboard.merchant.index')->with('success', 'تم حذف التاجر بنجاح');
    }
}
