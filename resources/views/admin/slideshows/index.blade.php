<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Slideshows
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('admin.slideshows.create') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New
                        Slideshow</a>

                    @if ($slideshows->count() > 0)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-4">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Slideshows</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">List of slideshows.</p>
                            </div>
                            <div class="border-t border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Slide Image</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Info</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($slideshows as $slideshow)
                                            <tr>
                                                <td class="px-6 py-4">
                                                    <img src="{{ Storage::url($slideshow->image_path) }}"
                                                        alt="Slideshow Image" class="h-20 w-auto">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        <div class="font-medium">{{ $slideshow->title }}</div>
                                                        <dl class="mt-2 space-y-2">
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 inline">
                                                                    Link:</dt>
                                                                <dd class="text-sm text-gray-500 inline">
                                                                    {{ $slideshow->link }}</dd>
                                                            </div>
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 inline">
                                                                    Description:</dt>
                                                                <dd class="text-sm text-gray-500 inline">
                                                                    {{ $slideshow->description }}</dd>
                                                            </div>
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 inline">
                                                                    Order:</dt>
                                                                <dd class="text-sm text-gray-500 inline">
                                                                    {{ $slideshow->order }}</dd>
                                                            </div>
                                                            <div>
                                                                <dt class="text-sm font-medium text-gray-500 inline">
                                                                    Active:</dt>
                                                                <dd class="text-sm text-gray-500 inline">
                                                                    {{ $slideshow->is_active ? 'Yes' : 'No' }}</dd>
                                                            </div>
                                                        </dl>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.slideshows.edit', $slideshow->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                                    <form
                                                        action="{{ route('admin.slideshows.destroy', $slideshow->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="mt-4">No slideshows found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
