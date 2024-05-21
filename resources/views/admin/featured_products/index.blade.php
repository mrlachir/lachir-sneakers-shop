<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Featured Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add Featured Product Button -->
            <div class="mb-4">
                <a href="{{ route('admin.featured_products.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Add Featured Product
                </a>
            </div>
            
            <!-- Display Featured Products -->
            @if ($featuredProducts->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-2">Featured Products</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($featuredProducts as $featuredProduct)
                                <div class="p-4 border rounded-lg">
                                    <!-- Sneaker Image -->
                                    <img src="{{ Storage::url($featuredProduct->sneaker->image_path) }}" alt="{{ $featuredProduct->sneaker->name }}" class="w-full h-40 object-cover mb-2">
                                    
                                    <!-- Sneaker Info -->
                                    <div class="text-gray-800 font-semibold">{{ $featuredProduct->order }}</div>
                                    <div class="text-gray-800 font-semibold">{{ $featuredProduct->sneaker->name }}</div>
                                    <div class="mt-2 text-gray-700">Brand: {{ $featuredProduct->sneaker->brand->name }}</div>
                                    <div class="mt-2 text-gray-700">Category: {{ $featuredProduct->sneaker->category->name }}</div>
                                    <div class="mt-2 text-gray-700">Price: ${{ $featuredProduct->sneaker->price }}</div>

                                    
                                    <!-- Action Buttons -->
                                    <div class="flex justify-between mt-4">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.featured_products.edit', $featuredProduct->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.featured_products.destroy', $featuredProduct->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p>No featured products found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
