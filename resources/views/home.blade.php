<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="slideshow">
                        <div class="slide">
                            <img src="https://picsum.photos/id/1015/1200/400" alt="Slide 1" />
                        </div>
                        <div class="slide">
                            <img src="https://picsum.photos/id/1016/1200/400" alt="Slide 2" />
                        </div>
                        <div class="slide">
                            <img src="https://picsum.photos/id/1018/1200/400" alt="Slide 3" />
                        </div>
                    </div>
                    <h1 class="text-3xl text-gray-800 font-bold mt-6">Welcome to LACHIR</h1>
                    <p class="text-gray-700 mt-2">Discover the latest sneaker releases and trends.</p>
                    <a href="#" class="text-indigo-500 hover:text-indigo-700 font-semibold underline mt-4 inline-block">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>