<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use App\Models\Sneaker;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function index()
    {
        $featuredProducts = FeaturedProduct::with('sneaker')->get();
        return view('admin.featured_products.index', compact('featuredProducts'));
    }

    public function create()
{
    // Get all featured sneaker ids
    $featuredSneakerIds = FeaturedProduct::pluck('sneaker_id')->toArray();

    // Get unique sneakers not in the featured list
    $sneakers = Sneaker::select('id', 'name', 'price', 'brand_id')
        ->whereNotIn('id', $featuredSneakerIds)
        ->groupBy('name', 'brand_id', 'price', 'id')
        ->with('brand')
        ->get();

    return view('admin.featured_products.create', compact('sneakers'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'sneaker_id' => 'required|exists:sneakers,id',
        'order' => 'required|integer|min:1',
    ]);

    FeaturedProduct::create([
        'sneaker_id' => $validatedData['sneaker_id'],
        'order' => $validatedData['order'],
    ]);

    return redirect()->route('admin.featured_products.index')->with('success', 'Featured product created successfully.');
}

public function edit(FeaturedProduct $featuredProduct)
{
    // Get all featured sneaker ids except the current one
    $featuredSneakerIds = FeaturedProduct::where('id', '!=', $featuredProduct->id)
        ->pluck('sneaker_id')
        ->toArray();

    // Get unique sneakers not in the featured list except the current one
    $sneakers = Sneaker::whereNotIn('id', $featuredSneakerIds)
        ->with('brand')
        ->get()
        ->unique(function ($item) {
            return $item->name . '|' . $item->brand->name;
        });

    return view('admin.featured_products.edit', compact('featuredProduct', 'sneakers'));
}




    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sneaker_id' => 'required|exists:sneakers,id',
            'order' => 'required|integer|min:1',
        ]);

        $featuredProduct = FeaturedProduct::findOrFail($id);

        $featuredProduct->update($validatedData);

        return redirect()->route('admin.featured_products.index')->with('success', 'Featured product updated successfully.');
    }

    public function destroy(FeaturedProduct $featuredProduct)
    {
        $featuredProduct->delete();
        return redirect()->route('admin.featured_products.index')->with('success', 'featured_products deleted successfully.');
    }
    
}
