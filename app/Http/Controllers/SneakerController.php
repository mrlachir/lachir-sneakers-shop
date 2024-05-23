<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Review;
use App\Models\Size;
use App\Models\Sneaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SneakerController extends Controller
{
    protected $fillable = ['name', 'description', 'price', 'brand_id', 'color_code', 'image_path', 'category_id'];

    // SneakerController.php

    public function index(Request $request)
    {
        /// Retrieve existing names, colors, brands, categories for filtering
        $existingNames = Sneaker::pluck('name')->unique()->toArray();
        $existingColors = Sneaker::pluck('color_code')->unique()->toArray();
        $existingBrands = Brand::pluck('name')->toArray();
        $existingCategories = Category::pluck('name')->toArray();

        $query = Sneaker::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('color_code')) {
            $query->where('color_code', 'like', '%' . $request->input('color_code') . '%');
        }

        if ($request->filled('size')) {
            $query->where('size', 'like', '%' . $request->input('size') . '%');
        }

        if ($request->filled('stock')) {
            $query->where('stock', '>=', $request->input('stock'));
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // soert
        $sortBy = $request->input('sort_by');
        if ($sortBy === 'name_asc') {
            $query->orderBy('name');
        } elseif ($sortBy === 'name_desc') {
            $query->orderByDesc('name');
        } elseif ($sortBy === 'brand_asc') {
            $query->orderBy('brand_id');
        } elseif ($sortBy === 'brand_desc') {
            $query->orderByDesc('brand_id');
        } elseif ($sortBy === 'category_asc') {
            $query->orderBy('category_id');
        } elseif ($sortBy === 'category_desc') {
            $query->orderByDesc('category_id');
        } elseif ($sortBy === 'color_asc') {
            $query->orderBy('color_code');
        } elseif ($sortBy === 'color_desc') {
            $query->orderByDesc('color_code');
        } elseif ($sortBy === 'size_asc') {
            $query->orderBy('size');
        } elseif ($sortBy === 'size_desc') {
            $query->orderByDesc('size');
        } elseif ($sortBy === 'stock_asc') {
            $query->orderBy('stock');
        } elseif ($sortBy === 'stock_desc') {
            $query->orderByDesc('stock');
        } elseif ($sortBy === 'price_asc') {
            $query->orderBy('price');
        } elseif ($sortBy === 'price_desc') {
            $query->orderByDesc('price');
        }
        // Add sorting options for other columns as needed

        $sneakers = $query->paginate(10);
        // $query = Sneaker::query();


        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.sneakers.index', compact('sneakers', 'categories', 'brands', 'existingNames', 'existingColors', 'existingBrands', 'existingCategories'));
    }
    public function indexAll(Request $request)
    {
        // Retrieve existing names, colors, brands, categories for filtering
        $existingNames = Sneaker::pluck('name')->unique()->toArray();
        $existingColors = Sneaker::pluck('color_code')->unique()->toArray();
        $existingBrands = Brand::pluck('name')->toArray();
        $existingCategories = Category::pluck('name')->toArray();
        
        $search = $request->input('search');

        $query = Sneaker::with(['brand', 'category'])
            ->when($search, function($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhereHas('brand', function($query) use ($search) {
                                 $query->where('name', 'LIKE', "%{$search}%");
                             })
                             ->orWhereHas('category', function($query) use ($search) {
                                 $query->where('name', 'LIKE', "%{$search}%");
                             });
            });
        
        $this->applyFiltersAndSorting($request, $query);
        $sneakers = $query->paginate(10);

        $categories = Category::all();
        $brands = Brand::all();
        $title = 'All Sneakers';
    
        return view('sneakers.showAll', compact('sneakers', 'title', 'categories', 'brands', 'existingNames', 'existingColors', 'existingBrands', 'existingCategories', 'search'));
    }
    
    public function filterByBrand(Request $request, $brand)
    {
        $brand = Brand::where('name', $brand)->firstOrFail();
        $title = $brand->name;
    
        $query = Sneaker::where('brand_id', $brand->id);
        $this->applyFiltersAndSorting($request, $query);
    
        $sneakers = $query->paginate(10);
        $categories = Category::all();
        $brands = Brand::all();
        $existingColors = Sneaker::pluck('color_code')->unique()->toArray();
        $existingBrands = Brand::pluck('name')->toArray();
        $existingCategories = Category::pluck('name')->toArray();
        $existingNames = Sneaker::pluck('name')->unique()->toArray();
    
        return view('sneakers.showAll', compact('sneakers', 'title', 'existingNames', 'brands', 'categories', 'existingColors', 'existingBrands', 'existingCategories'));
    }
    
    public function filterByCategory(Request $request, $category)
    {
        $category = Category::where('name', $category)->firstOrFail();
        $title = $category->name;
    
        $query = Sneaker::where('category_id', $category->id);
        $this->applyFiltersAndSorting($request, $query);
    
        $sneakers = $query->paginate(10);
        $categories = Category::all();
        $brands = Brand::all();
        $existingColors = Sneaker::pluck('color_code')->unique()->toArray();
        $existingBrands = Brand::pluck('name')->toArray();
        $existingCategories = Category::pluck('name')->toArray();
        $existingNames = Sneaker::pluck('name')->unique()->toArray();
    
        return view('sneakers.showAll', compact('sneakers', 'title', 'existingNames', 'brands', 'categories', 'existingColors', 'existingBrands', 'existingCategories'));
    }
    
    private function applyFiltersAndSorting(Request $request, $query)
    {
        $filters = [
            'name' => 'like',
            'brand_id' => '=',
            'category_id' => '=',
            'size' => 'like',
            'stock' => '>=',
        ];
    
        foreach ($filters as $field => $operator) {
            if ($request->filled($field)) {
                $value = $request->input($field);
                if ($operator === 'like') {
                    $value = '%' . $value . '%';
                }
                $query->where($field, $operator, $value);
            }
        }
    
        if ($request->filled('color_code')) {
            $colors = $request->input('color_code');
            $query->whereIn('color_code', $colors);
        }
    
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
    
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }
    
        if ($request->filled('sort_by')) {
            $sortBy = $request->input('sort_by');
            $sortableFields = [
                'name', 'brand_id', 'category_id', 'color_code', 'size', 'stock', 'price'
            ];
    
            if (in_array(explode('_', $sortBy)[0], $sortableFields)) {
                $direction = (strpos($sortBy, 'desc') !== false) ? 'desc' : 'asc';
                $query->orderBy(explode('_', $sortBy)[0], $direction);
            }
        }
    }
    





    public function create(Request $request)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $baseSneaker = null;
        $action = $request->query('action');

        if ($request->has('base_sneaker_id')) {
            $baseSneaker = Sneaker::find($request->query('base_sneaker_id'));
        }

        return view('admin.sneakers.create', compact('brands', 'categories', 'baseSneaker', 'action'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'brand_id' => 'required|exists:brands,id',
            'color_code' => 'nullable|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image_path')->store('public');

        $sneaker = Sneaker::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'brand_id' => $validatedData['brand_id'],
            'color_code' => $validatedData['color_code'],
            'image_path' => $imagePath,
            'size' => $validatedData['size'],
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('admin.sneakers.index');
    }

    public function edit(Sneaker $sneaker)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.sneakers.edit', compact('sneaker', 'brands', 'categories'));
    }

    public function update(Request $request, Sneaker $sneaker)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'brand_id' => 'required|exists:brands,id',
            'color_code' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image_path')) {
            Storage::delete('public/' . $sneaker->image_path);
            $imagePath = $request->file('image_path')->store('public/sneakers');
            $validatedData['image_path'] = $imagePath;
        }

        $sneaker->update($validatedData);

        return redirect()->route('admin.sneakers.index')->with('success', 'Sneaker updated successfully.');
    }

    public function destroy(Sneaker $sneaker)
    {
        Storage::delete('public/' . $sneaker->image_path);
        $sneaker->delete();

        return redirect()->route('admin.sneakers.index')->with('success', 'Sneaker deleted successfully.');
    }
    //     // SneakerController.php
    public function addSize(Sneaker $sneaker)
    {
        return view('admin.sneakers.add-size', compact('sneaker'));
    }

    public function addColor(Sneaker $sneaker)
    {
        return view('admin.sneakers.add-color', compact('sneaker'));
    }

    public function addCategory(Sneaker $sneaker)
    {
        $categories = Category::all();
        return view('admin.sneakers.add-category', compact('sneaker', 'categories'));
    }

    public function storeSize(Request $request, Sneaker $sneaker)
    {
        $request->validate([
            'size' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
        ]);

        $newSneaker = $sneaker->replicate();
        $newSneaker->size = $request->input('size');
        $newSneaker->stock = $request->input('stock');
        $newSneaker->save();

        return redirect()->route('admin.sneakers.index')->with('success', 'New size added successfully.');
    }
    // SneakerController.php
    public function storeColor(Request $request, Sneaker $sneaker)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color_code' => 'required|string|max:10',
            'stock' => 'required|integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $newSneaker = $sneaker->replicate();
        $newSneaker->image_path = $imagePath;
        $newSneaker->color_code = $request->input('color_code');
        $newSneaker->stock = $request->input('stock');
        $newSneaker->save();

        return redirect()->route('admin.sneakers.index')->with('success', 'New color added successfully.');
    }

    public function storeCategory(Request $request, Sneaker $sneaker)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);

        $newSneaker = $sneaker->replicate();
        $newSneaker->category_id = $request->input('category_id');
        $newSneaker->stock = $request->input('stock');
        $newSneaker->save();

        return redirect()->route('admin.sneakers.index')->with('success', 'New category added successfully.');
    }

    public function show($id)
    {
        $sneaker = Sneaker::with('brand', 'category', 'reviews.user')->findOrFail($id);
        $relatedSneakers = Sneaker::inRandomOrder()->take(4)->get(); // Randomly select 4 sneakers
        // Get the quantity of the sneaker in the cart
        $cartQuantity = Cart::where('sneaker_id', $id)
            ->sum('quantity');

        // Get sizes and colors for the same sneaker name, description, and brand_id
        $availableSizes = Sneaker::where('name', $sneaker->name)
            ->where('description', $sneaker->description)
            ->where('brand_id', $sneaker->brand_id)
            ->pluck('size')
            ->unique();

        $availableColors = Sneaker::where('name', $sneaker->name)
            ->where('description', $sneaker->description)
            ->where('brand_id', $sneaker->brand_id)
            ->pluck('color_code')
            ->unique();

        $averageRating = $sneaker->averageRating();

        return view('sneakers.show', compact('sneaker', 'cartQuantity', 'relatedSneakers', 'availableSizes', 'availableColors', 'averageRating'));
    }

    public function addReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string'
        ]);

        $sneaker = Sneaker::findOrFail($id);

        // Ensure the user can add only one review per sneaker
        $existingReview = Review::where('user_id', auth()->id())
            ->whereHas('sneaker', function ($query) use ($sneaker) {
                $query->where('name', $sneaker->name);
            })
            ->first();

        if ($existingReview) {
            return redirect()->route('sneakers.show', $id)->with('error', 'You have already reviewed this sneaker.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'sneaker_id' => $id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment')
        ]);

        return redirect()->route('sneakers.show', $id)->with('success', 'Review added successfully.');
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $sneakerId = $review->sneaker_id; // Store the sneaker id to redirect back
        if ($review->user_id == auth()->id()) {
            $review->delete();
            return redirect()->route('sneakers.show', $sneakerId)->with('success', 'Review deleted successfully.');
        }

        return redirect()->route('sneakers.show', $sneakerId)->with('error', 'Unauthorized action.');
    }
}
