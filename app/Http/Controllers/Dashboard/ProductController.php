<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\User;
use App\Models\UserProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $products = Product::with(['category'])
        ->when($request->search, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        })
        ->paginate(8);

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);
        $merchants = User::where('user_type' , '=' , 'merchant')->get(['id', 'name']);


        return view('dashboard.products.create', [
            'product' => new Product(),
            'categories' => $categories,
            'merchants' => $merchants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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

        return redirect()->route('dashboard.product.index')->with('success', 'تم انشاء منتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {    
        return view('dashboard.products.show', compact('product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(['id', 'name']);
        $merchants = User::where('user_type' , '=' , 'merchant')->get(['id', 'name']);

        return view('dashboard.products.edit', compact(['product' , 'categories' , 'merchants']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'category_id' => ['exists:categories,id'],
            'user_id' => ['exists:users,id'],
            'price' => [' numeric'],
            'phone' => ['string'],
            'place' => ['string'],
        ]);

        $product = Product::findOrFail($id);
        

        $validated = $request->except('image');

        $old_image = $product->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('/images/products', 'public');

            $validated['image'] = $path;
        }


        $product->update($validated);


        // after update image delete the old image
        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }


        return redirect()->back()->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if ($product->image || Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('dashboard.product.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
