<!-- resources/views/admin/sneakers/add-color.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Color to {{ $sneaker->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.sneakers.store-color', $sneaker->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
                            <input id="image" name="image" type="file" class="mt-1 block w-full" />
                            @error('image')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="color_code" class="block font-medium text-sm text-gray-700">Color Code</label>
                            <input id="color_code" name="color_code" type="text" class="mt-1 block w-full" value="{{ old('color_code') }}" />
                            @error('color_code')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stock</label>
                            <input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" value="{{ old('stock') }}" />
                            @error('stock')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Add Color
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
