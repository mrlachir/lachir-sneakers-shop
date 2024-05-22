<!-- resources/views/admin/sneakers/index.blade.php -->

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
            height: 300px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            box-shadow: 4px 4px var(--main-color);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 20px;
            gap: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .card:last-child {
            justify-content: flex-end;
        }

        .card-img {
            transition: all 0.5s;
            display: flex;
            justify-content: center;
        }

        .card-img .img {
            width: 100px;
            height: 100px;
            background-size: cover;
            border-radius: 5px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            color: var(--font-color);
        }

        .card-subtitle {
            font-size: 14px;
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
            height: 35px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            border-radius: 5px;
            padding: 0 15px;
            transition: all 0.3s;
        }

        .card-btn svg {
            width: 100%;
            height: 100%;
            fill: var(--main-color);
            transition: all 0.3s;
        }

        .card-img:hover {
            transform: translateY(-3px);
        }

        .card-btn:hover {
            border: 2px solid var(--main-focus);
        }

        .card-btn:hover svg {
            fill: var(--main-focus);
        }

        .card-btn:active {
            transform: translateY(3px);
        }

        .filter-container {
            width: 25%;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .products-container {
            width: 75%;
            padding: 20px;
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
            <div class="container">
                <!-- Filter Form -->
                <div class="filter-container">
                    <form method="GET" class="mb-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mt-2 flex justify-end">
                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <select id="name" name="name" class="mt-1 block w-full">
                                    <option value="">All Names</option>
                                    @foreach ($existingNames as $name)
                                        <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                
                            @php
                                // Check if the current URL contains 'brand'
                                $isBrandPage = request()->is('all/sneakers/brand/*');
                            @endphp
                
                            @if (!$isBrandPage)
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
                            @endif
                
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
                                <div class="mt-1 block w-full">
                                    @foreach ($existingColors as $color)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="color_code_{{ $color }}" name="color_code[]" value="{{ $color }}"
                                                {{ in_array($color, request('color_code', [])) ? 'checked' : '' }}>
                                            <label for="color_code_{{ $color }}" class="ml-2 text-sm text-gray-700">{{ $color }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                
                            <div>
                                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                                <input id="size" name="size" type="text" class="mt-1 block w-full" value="{{ request('size') }}">
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
                                <select id="sort_by" name="sort_by" class="ml-2 block w-full max-w-xs">
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
                            <div class="card-img">
                                <div class="img"
                                    style="background-image: url('{{ Storage::url($sneaker->image_path) }}');"></div>
                            </div>
                            <div class="card-title">{{ $sneaker->name }}</div>
                            <div class="card-subtitle">{{ $sneaker->brand->name }}</div>
                            <div class="card-divider"></div>
                            <div class="card-footer">
                                <div class="card-price">${{ $sneaker->price }}</div>
                                <div class="card-actions">
                                    <form action="{{ route('cart.add', $sneaker->id) }}" method="POST">
                                        @csrf
                                        <button class="add-to-cart card-btn" data-sneaker-id="{{ $sneaker->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shopping-cart">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path
                                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h8.64a2 2 0 0 0 2-1.61L23 6H6">
                                                </path>
                                            </svg>
                                        </button>

                                    </form>
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
