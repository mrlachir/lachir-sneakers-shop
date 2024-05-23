
@extends('layouts.sidebarmenu')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Featured Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.featured_products.update', $featuredProduct->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Sneaker Selection -->
                        <div class="mt-4">
                            <label for="sneaker_id" class="block font-medium text-sm text-gray-700">Select Sneaker</label>
                            <select id="sneaker_id" name="sneaker_id" class="mt-1 block w-full">
                                @foreach ($sneakers as $sneaker)
                                    @php
                                        $sneakerIdentifier = $sneaker->name . ' | ' . $sneaker->brand->name . ' | $' . $sneaker->price;
                                    @endphp
                                    <option value="{{ $sneaker->id }}" {{ $featuredProduct->sneaker_id == $sneaker->id ? 'selected' : '' }}>
                                        {{ $sneakerIdentifier }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sneaker_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="mt-4">
                            <label for="order" class="block font-medium text-sm text-gray-700">Order</label>
                            <input id="order" name="order" type="number" min="1" class="mt-1 block w-full" value="{{ $featuredProduct->order }}" />
                            @error('order')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection