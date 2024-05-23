@include('layouts.navigation')
{{-- resources/views/pages/about.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-4">About Us</h1>
                <p class="text-lg mb-4">
                    <!-- Add your about us content here -->
                    Welcome to our website. We are dedicated to providing you with the best service.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')

