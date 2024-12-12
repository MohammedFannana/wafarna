<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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

        // $id = $request->query('id');

        
        // Get the authenticated user (single instance)
        $user = Auth::guard('sanctum')->user();


        // Fetch waiting products with the specified conditions
        $waiting_products = WaitingProduct::where('status', 'pinding')
            ->where(function ($query) use ($user) {
                // First condition: user_id matches the authenticated user's ID
                $query->where('user_id', $user->id)
                    ->orWhereHas('category', function ($query) use ($user) {
                        // Second condition: category association
                        $query->whereIn('category_id', $user->categories()->pluck('categories.id'));
                    });
            })
            ->latest() // Order by most recent
            ->get();

        return response()->json($waiting_products, 200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::guard('sanctum')->user()->id,
            'status' => 'pinding'
        ]);


        $validated = $request->validate([
            'name' => ['required','string'],
            'description' => ['required','string'],
            'category_id' => ['required','exists:categories,id' ],
            'user_id' => ['required' , 'exists:users,id' ],
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


        return [
            'code' => 200,
            'message' => " تم اضافة طلب الانتظار بنجاح'",
            'product' => $waiting_product,
        ];

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $waiting_product = WaitingProduct::findOrFail($id);


        $request->merge([
            'status' => 'complete',
            'provider_id' => Auth::guard('sanctum')->user()->id,
        ]);
        
        $validated = $request->validate([
            'status' => ['sometimes', 'required' ,'in:pinding,complete'],
            'provider_id' => ['sometimes', 'required' , 'exists:users,id']
        ]);


        $waiting_product->update([
            'status' => $validated['status'],
            'provider_id' => $validated['provider_id'],
        ]);

        event('product.availability' , $waiting_product);

        return [
            'code' => 200,
            'message' => " تم تأكيد الطلب بنجاح ",
            'product' => $waiting_product,
        ];

    }

}
