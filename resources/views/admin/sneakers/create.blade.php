

@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Sneaker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.sneakers.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Sneaker Name -->
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Sneaker Name</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full" />
                            @error('name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sneaker Description -->
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea id="description" name="description" class="mt-1 block w-full"></textarea>
                            @error('description')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Sneaker Price -->
                        <div class="mt-4">
                            <label for="price" class="block font-medium text-sm text-gray-700">Price</label>
                            <input id="price" name="price" type="number" min="0" class="mt-1 block w-full" min="0" />
                            @error('price')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Sneaker Color -->
                        <div class="mt-4">
                            <label for="color_code" class="block font-medium text-sm text-gray-700">Color</label>
                            <input id="color_code" name="color_code" type="text" class="mt-1 block w-full" />
                            @error('color')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sneaker Image -->
                        <div class="mt-4">
                            <label for="image_path"
                                class="block font-medium text-sm text-gray-700">{{ __('Sneaker Image') }}</label>
                            <input id="image_path" class="block mt-1 w-full" type="file" name="image_path"
                                required />
                            @error('image_path')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Brand Selection -->
                        <div class="mt-4">
                            <label for="brand" class="block font-medium text-sm text-gray-700">Select Brand</label>
                            <select id="brand" name="brand_id" class="mt-1 block w-full">
                                <option value="">Select Category</option>

                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Sneaker Size -->
                        <div class="mt-4">
                            <label for="size" class="block font-medium text-sm text-gray-700">Size</label>
                            <input id="size" name="size" type="text" class="mt-1 block w-full" />
                            @error('size')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Sneaker Stock -->
                        <div class="mt-4">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stock</label>
                            <input id="stock" name="stock" type="number" class="mt-1 block w-full" min="0"/>
                            @error('stock')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Category Selection -->
                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Select Category</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Create</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@endsection