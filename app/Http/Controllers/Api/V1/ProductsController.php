<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $products = Product::where('category_id', '=', $id)->with('user:id,name,phone,image,discription,website_link')->get();
        return  response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::guard('sanctum')->user();
        // dd($user);
        $subscribed = $user->subscriptions()->first();


        if (
            $subscribed && $user->user_type == 'merchant'
            && $subscribed->is_subscribed === 'true'
            && $subscribed->status === 'active'
        ) {

            $request->merge([
                'user_id' => Auth::guard('sanctum')->user()->id,
            ]);


            $valideted = $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'category_id' => ['required', 'exists:categories,id'],
                'user_id' => ['required', 'exists:users,id'],
                'price' => ['required', ' numeric'],
                'place' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'image' => ['required', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            ]);

            if ($request->hasFile('image')) {    //to check if image file is exit
                $file = $request->file('image');
                $path = $file->store('images/products', 'public');  //store image in public disk insde storge folder inside  folder ,'public' or['disk' => 'public]
                $valideted['image'] = $path;
            }

            $product = Product::create($valideted);


            return [
                'code' => 200,
                'message' => " تم انشاء المنتج بنجاح ",
                'product' => $product,
            ];
        } else {

            return [
                'code' => 401,
                'message' => " يجب ان عليك الاشتراك حتى تتمكن من اضافة منتجات ",
            ];
        }
    }
}
