<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Response;

class profileController extends Controller
{


    public function index(Request $request)
    {

        $user_type = User::where('id', '=', Auth::guard('sanctum')->id())->value('user_type');
        $categories = Category::all(['id', 'name']);
        $merchant = User::findOrFail(Auth::guard('sanctum')->id());

        $categoryMerchantIds = $merchant->categories()->pluck('id', 'name')->toArray();



        if ($user_type == "customer") {

            return [
                'code' => 200,
                'user' => $request->user(),
            ];
        } else if ($user_type == "merchant") {

            return [
                'code' => 200,
                'user' => $request->user(),
                'categories' => $categories,
                'categoryMerchantIds' => $categoryMerchantIds,
            ];
        }
    }



    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'user_type' => ['in:customer,merchant'],
            'phone' => ['sometimes', 'required', Rule::unique('users')->ignore($user->id)],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'image' => ['sometimes', 'required', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],

            'discription' => ['nullable', 'string', 'sometimes', Rule::requiredIf($user->user_type == 'merchant')],
            'commercial_register' => ['nullable', 'sometimes', Rule::requiredIf($user->user_type == 'merchant'), 'numeric', Rule::unique(User::class)->ignore($user->id)],
            // ,Rule::requiredIf($user->user_type == 'merchant')
            'categories_id' => ['nullable', 'array', 'sometimes', function ($attribute, $value, $fail) use ($user) {
                if ($user->user_type === 'merchant' && empty($value)) {
                    $fail($attribute . ' is required for merchant.');
                }
            },],
            'categories_id.*' => ['exists:categories,id'],
            'website_link' => ['nullable', 'url'],
        ]);


        $old_image = $user->image;

        $validated = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('/images/profiles', 'public');

            $validated['image'] = $path;
        }


        DB::beginTransaction();

        try {

            $user->update($validated);

            // after update image delete the old image
            if ($old_image && $old_image != $user->image) {
                Storage::disk('public')->delete($old_image);
            }


            $user_type = $user->user_type;

            if ($user_type === "merchant") {


                CategoryUser::where('user_id', $user->id)->delete();


                foreach ($request->categories_id ?? [] as $category_id) {

                    CategoryUser::create([
                        'user_id' => $user->id,
                        'category_id' => $category_id
                    ]);
                }
            }


            DB::commit();

            return [
                'code' => 200,
                'message' => "تم تعديل البيانات بنجاح",
            ];
        } catch (Exception $e) {

            DB::rollBack();
            return Response::json([
                'message' => 'error',
            ], 400);
        }
    }

    public function change_password(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return [
            'code' => 200,
            'message' => "تم تحديث كلمة المرور بنجاح",
        ];
    }
}
