
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Brand Creation Form -->
                    <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Brand Name -->
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Brand Name</label>
                            <input id="name" type="text" name="name"
                                class="mt-1 block w-full @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}" required autofocus />
                            @error('name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Brand Description -->
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Brand
                                Description</label>
                            <textarea id="description" name="description" class="mt-1 block w-full @error('description') border-red-500 @enderror"
                                value="{{ old('description') }}" required></textarea>
                            @error('description')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Brand Image -->
                        <div class="mt-4">
                            <label for="image_path" class="block font-medium text-sm text-gray-700">Brand Image</label>
                            <input id="image_path" type="file" name="image_path"
                                class="mt-1 block w-full @error('image_path') border-red-500 @enderror"
                                value="{{ old('image_path') }}" required />
                            @error('image_path')
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