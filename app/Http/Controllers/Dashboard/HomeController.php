<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        
        $home_informations = Home::all();
        return view('dashboard.home-pages.index' , compact('home_informations'));

    }

    public function edit(string $id){
        
        $home_information = Home::findOrFail($id);

        return view('dashboard.home-pages.edit', compact('home_information'));

    }

    public function update(Request $request , string $id){

        $validated = $request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
        ]);
        
        $home_information = Home::findOrFail($id);
        
        $validated = $request->except('image');
        
        $old_image = $home_information->image; // Capture the existing image path before updating
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
        
            // Move the uploaded file to 'public/storage/images/products' and retain its original name
            $fileName = $file->getClientOriginalName();
            $path = 'storage/images/products/' . $fileName;
            $file->move(public_path('storage/images/products'), $fileName);
        
            $validated['image'] = $path; // Save relative path to the database
        }
        
        $home_information->update($validated);
        
        // Delete the old image if it exists and is different from the new image path
       // Delete the old image if it exists, the new image is uploaded, and the paths are different
        if ($old_image && isset($validated['image']) && $old_image != $validated['image']) {
            Storage::disk('public')->delete(str_replace('storage/', '', $old_image));
        }

        
        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
        
        
    }
}
