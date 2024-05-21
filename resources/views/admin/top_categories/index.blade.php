<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Top Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add Top Category Button -->
            <div class="mb-4">
                <a href="{{ route('admin.top_categories.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Add Top Category
                </a>
            </div>

            @if ($topCategories->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-2">Top Categories</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($topCategories as $topCategory)
                                <div class="p-4 border rounded-lg">
                                    <img src="{{ Storage::url($topCategory->image_path) }}" alt="Top Category Image" class="w-full h-40 object-cover mb-2">
                                    <div class="text-gray-800 font-semibold">{{ $topCategory->category->name }}</div>
                                    <div class="mt-2 text-gray-600">Order: {{ $topCategory->order }}</div>
                                    <div class="flex justify-between mt-4">
                                        <a href="{{ route('admin.top_categories.edit', $topCategory->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form action="{{ route('admin.top_categories.destroy', $topCategory->id) }}" method="POST">
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
                <p>No top categories found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
