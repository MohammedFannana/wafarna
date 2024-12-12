<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\WaitingProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;


class WaitingProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $waiting_products = WaitingProduct::with(['category','user'])
        ->when($request->search, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        })
        ->paginate(8);

        return view('dashboard.waiting-products.index', compact('waiting_products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(WaitingProduct $product)
    {
        return view('dashboard.waiting-products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaitingProduct $product)
    {
        $categories = Category::all(['id', 'name']);

        $users = User::all(['id' , 'name']);

        return view('dashboard.waiting-products.edit', compact(['product' , 'categories' ,'users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validated = $request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'category_id' => ['exists:categories,id' ],
            'user_id' => ['exists:categories,id' ],
            'day_count' => ['numeric'],
        ]);


        $product = WaitingProduct::findOrFail($id);
        $createdAt = $product->created_at; // قيمة created_at
        $dayCount = intval($validated['day_count']);   // قيمة day_count
        // تحويل created_at إلى كائن Carbon
        $carbonDate = Carbon::parse($createdAt);

        // التحقق مما إذا كان الوقت بعد الساعة 12pm
        if ($carbonDate->hour >= 12) {
            $dayCount += 1; // إضافة يوم واحد إذا كان الوقت بعد الساعة 12pm
        }

        // إضافة الأيام إلى التاريخ
        $endDate = $carbonDate->addDays($dayCount)->startOfDay()->toDateString();

        $validated['end_date'] = $endDate;


        $product->update($validated);

        return redirect()->back()->with('success', 'تم تعديل الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaitingProduct $product)
    {
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'تم حذف الطلب بنجاح');
    }
}
