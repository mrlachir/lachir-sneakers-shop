
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Slideshow') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.slideshows.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Slide Title -->
                        <div class="mt-4">
                            <label for="title"
                                class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>
                            <input id="title" class="block mt-1 w-full" type="text" name="title" required
                                autofocus />
                            @error('title')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <!-- Slide Description -->
                        <div class="mt-4">
                            <label for="description"
                                class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                            <textarea id="description" class="block mt-1 w-full" name="description" rows="3"></textarea>
                            @error('description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slide Image -->
                        <div class="mt-4"> 
                            <label for="image_path"
                                class="block font-medium text-sm text-gray-700">{{ __('Slide Image') }}</label>
                            <input id="image_path" class="block mt-1 w-full" type="file" name="image_path"
                                required />
                            @error('image_path')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        <!-- Slide Link -->
                        <div class="mt-4">
                            <label for="link"
                                class="block font-medium text-sm text-gray-700">{{ __('Slide Link') }}</label>
                            <input id="link" class="block mt-1 w-full" type="text" name="link" />
                            @error('link')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="mt-4">
                            <label for="order"
                                class="block font-medium text-sm text-gray-700">{{ __('Order') }}</label>
                            <input id="order" class="block mt-1 w-full" type="number" min="1" name="order" value="0"
                                required />
                            @error('order')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Is Active -->
                        <div class="mt-4">
                            <label for="is_active"
                                class="block font-medium text-sm text-gray-700">{{ __('Is Active') }}</label>
                            <select id="is_active" name="is_active"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" selected>{{ __('Yes') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                            @error('is_active')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection