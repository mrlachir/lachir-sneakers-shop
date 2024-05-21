<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\FeaturedProduct;
use App\Models\Slideshow;
use App\Models\TopCategory;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    
    // public function index()
    // {
    //     $slideshows = Slideshow::latest()->take(3)->get();
    //     $featuredProducts = FeaturedProduct::with('sneaker')->latest()->take(6)->get();
    //     $topCategories = TopCategory::with('category')->latest()->take(3)->get();

    //     return response()->json([
    //         'slideshows' => $slideshows,
    //         'featuredProducts' => $featuredProducts,
    //         'topCategories' => $topCategories,
    //     ]);
    // }
    public function index()
    {
        // Fetch data for slideshow
        $slideshows = Slideshow::all();

        // Fetch data for featured products
        $featuredProducts = FeaturedProduct::with('sneaker')->get();
        // $featuredProducts = FeaturedProduct::with(['sneaker' => function ($query) {
        //     $query->where('stock', '>', 1)
        //         ->orderBy('stock', 'desc');
        // }])->get();

        // Fetch data for top categories
        $topCategories = TopCategory::all();

        // $brands = Brand::all();
        $query = Brand::query();
        $brands = $query->paginate(6);



        return view('index', compact('slideshows', 'featuredProducts', 'topCategories', 'brands'));
    }


    public function updateHomepageData(Request $request)
    {
        // Update slideshow images
        if ($request->has('slideshows')) {
            foreach ($request->slideshows as $slideshow) {
                Slideshow::findOrFail($slideshow['id'])->update([
                    'image_url' => $slideshow['image_url'],
                ]);
            }
        }

        // Update featured products
        if ($request->has('featuredProducts')) {
            foreach ($request->featuredProducts as $featuredProduct) {
                FeaturedProduct::findOrFail($featuredProduct['id'])->update([
                    'sneaker_id' => $featuredProduct['sneaker_id'],
                ]);
            }
        }

        // Update top categories
        if ($request->has('topCategories')) {
            foreach ($request->topCategories as $topCategory) {
                TopCategory::findOrFail($topCategory['id'])->update([
                    'category_id' => $topCategory['category_id'],
                ]);
            }
        }

        return response()->json('Homepage data updated successfully');
    }
}