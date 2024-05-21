<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])
            ->latest()
            ->paginate(10);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load('brand', 'category'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'brand_id' => 'sometimes|required|integer|exists:brands,id',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}