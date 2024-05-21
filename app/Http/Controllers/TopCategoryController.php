<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TopCategory;
use Illuminate\Support\Facades\Storage;

class TopCategoryController extends Controller
{
    public function index()
    {
        $topCategories = TopCategory::all();
        return view('admin.top_categories.index', compact('topCategories'));
    }

    public function create()
{
    $categories = Category::all();
    return view('admin.top_categories.create', compact('categories'));
}

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ]);

        // $imageName = time() . '.' . $request->image_path->extension();
        // $request->image_path->move(public_path('images'), $imageName);
        $imagePath = $request->file('image_path')->store('public/top_catigory');

        TopCategory::create([
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.top_categories.index')->with('success', 'Top category created successfully.');
    }

    public function edit(TopCategory $topCategory)
    {
        $categories = Category::all();
        return view('admin.top_categories.edit', compact('topCategory', 'categories'));
    }

    public function update(Request $request, TopCategory $topCategory)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional in the update
            'category_id' => 'required',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete the old image file
            Storage::delete('public/' . $topCategory->image_path);

            // Store the new image in the storage/app/public directory
            $imagePath = $request->file('image_path')->store('public');

            // Update the image filename in the database
            $topCategory->image_path = basename($imagePath);
        }

        $topCategory->category_id = $request->category_id;
        $topCategory->order = $request->order;
        $topCategory->save();

        return redirect()->route('admin.top_categories.index')->with('success', 'Top category updated successfully.');
    }

    public function destroy(TopCategory $topCategory)
    {
        $topCategory->delete();
        return redirect()->route('admin.top_categories.index')->with('success', 'Top category deleted successfully.');
    }
}
