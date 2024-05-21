<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imagePath = $request->file('image_path')->store('public/brands');

        Brand::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        return response()->json($brand);
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional in the update
        ]);

        if ($request->hasFile('image_path')) {
            // Delete the old image file
            Storage::delete('public/' . $brand->image_path);

            // Store the new image in the storage/app/public directory
            $imagePath = $request->file('image_path')->store('public');

            // Update the image filename in the database
            $brand->image_path = basename($imagePath);
        }

        // Update other fields
        $brand->name = $request->name;
        $brand->description = $request->description;

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}