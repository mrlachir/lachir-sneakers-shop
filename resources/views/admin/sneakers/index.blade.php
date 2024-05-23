<!-- resources/views/admin/sneakers/index.blade.php -->
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Sneakers by Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add Sneaker Button -->
            <div class="mb-4">
                <a href="{{ route('admin.sneakers.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Add Sneaker
                </a>
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.sneakers.index') }}" class="mb-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Existing names select input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <select id="name" name="name" class="mt-1 block w-full">
                            <option value="">All Names</option>
                            @foreach ($existingNames as $name)
                                <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <!-- Existing brands select input -->
                        <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                        <select id="brand_id" name="brand_id" class="mt-1 block w-full">
                            <option value="">All Brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <!-- Existing categories select input -->
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <!-- Existing colors select input -->
                        <label for="color_code" class="block text-sm font-medium text-gray-700">Color</label>
                        <select id="color_code" name="color_code" class="mt-1 block w-full">
                            <option value="">All Colors</option>
                            @foreach ($existingColors as $color)
                                <option value="{{ $color }}" {{ request('color_code') == $color ? 'selected' : '' }}>{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                        <input id="size" name="size" type="text" class="mt-1 block w-full" value="{{ request('size') }}">
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" value="{{ request('stock') }}">
                    </div>
                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700">Price Min</label>
                        <input id="price_min" name="price_min" type="number" min="0" class="mt-1 block w-full" value="{{ request('price_min') }}">
                    </div>
                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700">Price Max</label>
                        <input id="price_max" name="price_max" type="number" min="0" class="mt-1 block w-full" value="{{ request('price_max') }}">
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center mt-4">
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="brand_asc" {{ request('sort_by') == 'brand_asc' ? 'selected' : '' }}>Brand (A-Z)</option>
                            <option value="brand_desc" {{ request('sort_by') == 'brand_desc' ? 'selected' : '' }}>Brand (Z-A)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="category_asc" {{ request('sort_by') == 'category_asc' ? 'selected' : '' }}>Category (A-Z)</option>
                            <option value="category_desc" {{ request('sort_by') == 'category_desc' ? 'selected' : '' }}>Category (Z-A)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="color_asc" {{ request('sort_by') == 'color_asc' ? 'selected' : '' }}>Color (A-Z)</option>
                            <option value="color_desc" {{ request('sort_by') == 'color_desc' ? 'selected' : '' }}>Color (Z-A)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="size_asc" {{ request('sort_by') == 'size_asc' ? 'selected' : '' }}>Size (L to H)</option>
                            <option value="size_desc" {{ request('sort_by') == 'size_desc' ? 'selected' : '' }}>Size (H to L)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="stock_asc" {{ request('sort_by') == 'stock_asc' ? 'selected' : '' }}>Stock (L to H)</option>
                            <option value="stock_desc" {{ request('sort_by') == 'stock_desc' ? 'selected' : '' }}>Stock (H to L)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex items-center">
                        <select id="sort_by" name="sort_by" class="block w-full max-w-xs">
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price (L to H)</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price (H to L)</option>
                        </select>
                    </div>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                    </div>
                </div>
                
            </form>

            <!-- Sneakers Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($sneakers as $sneaker)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ Storage::url($sneaker->image_path) }}" alt="{{ $sneaker->name }}" class="w-16 h-16 object-cover">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $sneaker->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->brand->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->color_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->size }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sneaker->category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.sneakers.edit', $sneaker->id) }}" class="text-blue-500 hover:text-blue-700">Edit |</a>
                                        <form action="{{ route('admin.sneakers.destroy', $sneaker->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete |</button>
                                        </form>
                                        <a href="{{ route('admin.sneakers.add-size', $sneaker->id) }}" class="text-green-500 hover:text-blue-700">Add Size |</a>
                                        <a href="{{ route('admin.sneakers.add-color', $sneaker->id) }}" class="text-pink-500 hover:text-blue-700">Add Color |</a>
                                        <a href="{{ route('admin.sneakers.add-category', $sneaker->id) }}" class="text-cyan-500 hover:text-blue-700">Add Category</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 whitespace-nowrap text-center">No sneakers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $sneakers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

