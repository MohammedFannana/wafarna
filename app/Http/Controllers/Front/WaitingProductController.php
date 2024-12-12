<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\WaitingProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WaitingProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $waiting_products = WaitingProduct::where('status', 'pinding')
        ->where(function($query) use ($user) {
            $query->where('user_id', $user->id) // Second condition (user_id)
                    ->orWhereHas('category', function($query) use ($user) {
                    // Third condition (category association)
                    $query->whereIn('category_id', $user->categories()->pluck('categories.id'));
            });
        })
        ->latest() // Order by most recent
        ->get();



        return view('front.waiting-orders' ,compact('waiting_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(['name' , 'id']);
        return view('front.wait-product' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::user()->id,
            'status' => 'pinding'
        ]);


        $validated = $request->validate([
            'name' => ['required','string'],
            'description' => ['required','string'],
            'category_id' => ['required','exists:categories,id' ],
            'user_id' => ['exists:users,id' ],
            'day_count' => ['required','numeric','min:1'],
        ]);

        // $createdAt = now(); // قيمة created_at
        $dayCount = intval($validated['day_count']);   // قيمة day_count
        // تحويل created_at إلى كائن Carbon
        $carbonDate = Carbon::parse(now());

        // التحقق مما إذا كان الوقت بعد الساعة 12pm
        if ($carbonDate->hour >= 12) {
            $dayCount += 1; // إضافة يوم واحد إذا كان الوقت بعد الساعة 12pm
        }

        // إضافة الأيام إلى التاريخ
        $endDate = $carbonDate->addDays($dayCount)->startOfDay()->toDateString();

        $validated['end_date'] = $endDate;

        $waiting_product = WaitingProduct::create($validated);

        event('waiting.product.create' , $waiting_product);


        return redirect()->back()->with('success', 'تم اضافة الطلب بنجاح');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $waiting_product = WaitingProduct::findOrFail($id);


        if(Gate::denies('waiting_product_available' , [$waiting_product] )){
            abort(403);
        }

        $request->merge([
            'provider_id' => Auth::user()->id,
        ]);
        
        $validated = $request->validate([
            'status' => ['in:pinding,complete'],
            'provider_id' => ['exists:users,id']
        ]);


        $waiting_product->update([
            'status' => $validated['status'],
            'provider_id' => $validated['provider_id'],
        ]);

        event('product.availability' , $waiting_product);

        return redirect()->back()->with('success', 'تم تأكيد الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
