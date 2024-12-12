<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $categories =  $user->categories;
    
        return view('front.add-product', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Authorize the action using the merchant_subscription gate
    if (!Gate::allows('merchant_subscription')) {
        return redirect()->route('plan')
                            ->with('error', ' عذرًا، لا يمكنك إضافة سلعة إلا إذا كنت مشتركًا في الموقع. يُرجى الاشتراك للحصول على صلاحية إضافة السلع.  ');
    }


        $request->merge([
            'user_id' => Auth::user()->id,
        ]);


        $valideted = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required' , 'string'],
            'category_id' => ['required' , 'exists:categories,id' ],
            'user_id' => ['required' , 'exists:users,id'],
            'price' => ['required' , ' numeric'],
            'place' => ['required' , 'string'],
            'phone' => ['required' , 'string'],
            'image' => ['required', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
        ]);

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('images/products', 'public');  //store image in public disk insde storge folder inside  folder ,'public' or['disk' => 'public]
            $valideted['image'] = $path;
        }

        Product::create($valideted);

        return redirect()->route('product.create')->with('success', 'تم انشاء منتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::where('category_id','=' , $id)->with('user')->latest()->get();
        $unreadCount = Auth::user()->unreadNotifications()->count();

    
        return view('front.product' , compact(['products' , 'unreadCount']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
