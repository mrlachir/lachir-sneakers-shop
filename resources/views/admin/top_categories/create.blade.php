
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Top Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.top_categories.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Category Selection -->
                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Select Category</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mt-4">
                            <label for="image_path" class="block font-medium text-sm text-gray-700">{{ __('Top Category Image') }}</label>
                            <input id="image_path" class="block mt-1 w-full" type="file" name="image_path" required />
                            @error('image_path')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="mt-4">
                            <label for="order" class="block font-medium text-sm text-gray-700">Order</label>
                            <input id="order" name="order" type="number" min="0" class="mt-1 block w-full" />
                            @error('order')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection