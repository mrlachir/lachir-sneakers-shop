<!-- resources/views/admin/sneakers/index.blade.php -->


@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <style>
        .card {
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --main-color: #323232;
            --main-focus: #2d8cf0;
            width: 230px;
            height: fit-content;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            box-shadow: 4px 4px var(--main-color);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            /* padding: 20px; */
            gap: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            overflow: hidden;
        }

        .card:last-child {
            justify-content: flex-end;
        }

        .card img {
        height: auto;
        margin: 0;
        transition: transform .4s ease, -webkit-transform .4s ease !important;
    }

    .card img:hover {
        transform: scale(1.1);
    }

        .card-title {
            font-size: 10px;
            font-weight: 500;
            text-align: left;
            color: var(--font-color);
        }

        .card-subtitle {
            font-size: 10px;
            font-weight: 400;
            color: var(--font-color-sub);
        }

        .card-divider {
            width: 100%;
            border: 1px solid var(--main-color);
            border-radius: 50px;
        }

        .card-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .card-price {
            font-size: 20px;
            font-weight: 500;
            color: var(--font-color);
        }

        .card-price span {
            font-size: 20px;
            font-weight: 500;
            color: var(--font-color-sub);
        }

        .card-btn {
            height: 30px;
            color: #fff;
            background: #323232;
            border: 2px solid #323232;
            border-radius: 5px;
            padding: 0 10px;
            margin: 5px 0 0 0;
            transition: all 0.3s;
        }


        .card-btn:hover {
            color: #323232;
            background: #fff;
        }

        .filter-container {
            width: 25%;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .products-container {
            width: 75%;
            padding: 0 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .container {
            display: flex;
            flex-direction: row;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Form -->
            <form action="{{ route('sneakers.showAll.all') }}" method="GET" class="mb-4">
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" style="border-radius: 10px;" class="block w-full pl-10 pr-2 py-1 border border-gray-300 leading-5 bg-white placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-gray-600 focus:border-gray-600 sm:text-sm" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                </div>
            </form>

            <div class="container">
                <!-- Filter Form -->
                <div class="filter-container">
                    <form method="GET" class="mb-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mt-2 flex justify-end">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                            </div>
                            
                
                                <div>
                                    <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                                    <select id="brand_id" name="brand_id" class="mt-1 block w-full">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        
                
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="category_id" name="category_id" class="mt-1 block w-full">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div>
                                <label for="color_code" class="block text-sm font-medium text-gray-700">Color</label>
                                <div class="mt-1 block w-full flex flex-wrap">
                                    @foreach ($existingColors as $color)
                                        <div class="flex items-center mr-4 mb-2">
                                            <input type="checkbox" id="color_code_{{ $color }}" name="color_code[]" value="{{ $color }}"
                                                {{ in_array($color, request('color_code', [])) ? 'checked' : '' }}>
                                            <label for="color_code_{{ $color }}" class="ml-2 text-sm text-gray-700" style="width: 45px;">{{ $color }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                
                            <div>
                                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                                <select id="size" name="size" class="mt-1 block w-full">
                                    @foreach($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price Range</label>
                                <input id="price_min" name="price_min" type="range" min="0" max="5000" value="{{ request('price_min', 0) }}"
                                    class="mt-1 block w-full">
                                <input id="price_max" name="price_max" type="range" min="0" max="5000" value="{{ request('price_max', 5000) }}"
                                    class="mt-1 block w-full">
                                <div class="flex justify-between text-sm text-gray-700 mt-1">
                                    <span id="price_min_label">${{ request('price_min', 0) }}</span>
                                    <span id="price_max_label">${{ request('price_max', 5000) }}</span>
                                </div>
                            </div>
                        </div>
                
                        <div class="flex flex-wrap justify-between items-center mt-4">
                            <div class="mt-2 flex items-center">
                                <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
                                <select id="sort_by" name="sort_by" class="ml-2 block w-auto max-w-xs">
                                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                                    <option value="brand_asc" {{ request('sort_by') == 'brand_asc' ? 'selected' : '' }}>Brand (A-Z)</option>
                                    <option value="brand_desc" {{ request('sort_by') == 'brand_desc' ? 'selected' : '' }}>Brand (Z-A)</option>
                                    <option value="category_asc" {{ request('sort_by') == 'category_asc' ? 'selected' : '' }}>Category (A-Z)</option>
                                    <option value="category_desc" {{ request('sort_by') == 'category_desc' ? 'selected' : '' }}>Category (Z-A)</option>
                                    <option value="color_asc" {{ request('sort_by') == 'color_asc' ? 'selected' : '' }}>Color (A-Z)</option>
                                    <option value="color_desc" {{ request('sort_by') == 'color_desc' ? 'selected' : '' }}>Color (Z-A)</option>
                                    <option value="size_asc" {{ request('sort_by') == 'size_asc' ? 'selected' : '' }}>Size (Low to High)</option>
                                    <option value="size_desc" {{ request('sort_by') == 'size_desc' ? 'selected' : '' }}>Size (High to Low)</option>
                                    <option value="stock_asc" {{ request('sort_by') == 'stock_asc' ? 'selected' : '' }}>Stock (Low to High)</option>
                                    <option value="stock_desc" {{ request('sort_by') == 'stock_desc' ? 'selected' : '' }}>Stock (High to Low)</option>
                                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                

                <!-- Sneakers Cards -->
                <div class="products-container">
                    @forelse ($sneakers as $sneaker)
                    @if ($sneaker->stock>0)
                    <a href="{{ route('sneakers.show', $sneaker->id) }}">
                        <div class="card">
                            {{-- <div class="card-img">
                                <div class="img"
                                    style="background-image: url('{{ Storage::url($sneaker->image_path) }}');"></div>
                            </div> --}}
                            <div style="overflow: hidden;">
                                <img style="width: auto; height: auto;" src="{{ Storage::url($sneaker->image_path) }}" alt="">
                            </div>
                            <div style="padding: 0 20px 20px 20px;">
                                <div class="card-title">{{ $sneaker->name }}</div>
                                <div class="card-subtitle">{{ $sneaker->brand->name }}</div>
                                <div class="card-divider"></div>
                                <div class="card-footer">
                                    <div class="card-price">${{ $sneaker->price }}</div>
                                    <div class="card-actions">
                                        <form action="{{ route('cart.add', $sneaker->id) }}" method="POST">
                                            @csrf
                                            <button class="add-to-cart card-btn" data-sneaker-id="{{ $sneaker->id }}">
                                                Add to cart
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </a>
                    {{-- @else
                        <div class="text-center w-full">No sneakers found.</div> --}}
                    @endif
                    @empty
                        <div class="text-center w-full">No sneakers found.</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-4">
                {{ $sneakers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const priceMinInput = document.getElementById('price_min');
        const priceMaxInput = document.getElementById('price_max');
        const priceMinLabel = document.getElementById('price_min_label');
        const priceMaxLabel = document.getElementById('price_max_label');

        priceMinInput.addEventListener('input', () => {
            priceMinLabel.textContent = `$${priceMinInput.value}`;
        });

        priceMaxInput.addEventListener('input', () => {
            priceMaxLabel.textContent = `$${priceMaxInput.value}`;
        });
    });
</script>
@include('layouts.footer')