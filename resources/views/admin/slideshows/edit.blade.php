
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Slideshow
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Edit Slideshow Form -->
                    <form method="POST" action="{{ route('admin.slideshows.update', $slideshow->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Slide Image -->
                        <div class="mt-4">
                            <label for="current_image" class="block font-medium text-sm text-gray-700">Current Slide Image</label>
                            <img src="{{ Storage::url($slideshow->image_path) }}" alt="Current Slide Image" class="mt-2 w-64" />
                        </div>

                        <!-- Slide Image -->
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">New Slide Image</label>
                            <input id="image" name="image" type="file" class="mt-1 block w-full" />
                            @error('image')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Title -->
                        <div class="mt-4">
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', $slideshow->title) }}" />
                            @error('title')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Description -->
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea id="description" name="description" class="mt-1 block w-full">{{ old('description', $slideshow->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Link -->
                        <div class="mt-4">
                            <label for="link" class="block font-medium text-sm text-gray-700">Slide Link</label>
                            <input id="link" name="link" type="text" class="mt-1 block w-full" value="{{ old('link', $slideshow->link) }}" />
                            @error('link')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Order -->
                        <div class="mt-4">
                            <label for="order" class="block font-medium text-sm text-gray-700">Order</label>
                            <input id="order" name="order" type="number" min="1" class="mt-1 block w-full" value="{{ old('order', $slideshow->order) }}" />
                            @error('order')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Activation -->
                        <div class="mt-4">
                            <label for="is_active" class="block font-medium text-sm text-gray-700">Is Active</label>
                            <select id="is_active" name="is_active" class="mt-1 block w-full">
                                <option value="1" {{ $slideshow->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$slideshow->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection