<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image_path')->store('public/categories');

        Category::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete the old image file
            Storage::delete('public/' . $category->image_path);

            // Store the new image in the storage/app/public directory
            $imagePath = $request->file('image_path')->store('public');

            // Update the image filename in the database
            $category->image_path = basename($imagePath);
        }

        // Update other fields
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
