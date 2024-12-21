<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'category' => new Category()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valideted = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'discription' => ['required', 'string'],
            'image' => ['required', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
        ]);

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('images/categories', 'public');  //store image in public disk insde storge folder inside  folder ,'public' or['disk' => 'public]
            $valideted['image'] = $path;
        }

        Category::create($valideted);
        return redirect()->route('dashboard.category.index')->with('success', 'تم انشاء القسم بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['string'],
            'discription' => ['string'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],

        ]);

        

        $category = Category::findOrFail($id);


        $validated = $request->except('image');

        $old_image = $category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('/images/categories', 'public');

            $validated['image'] = $path;
        }

        $category->update($validated);

        // after update image delete the old image
        if ($old_image && $old_image != $category->image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->back()->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.category.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
