@include('layouts.navigation')
{{-- resources/views/pages/contact.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-4">Contact Us</h1>
                <div class="text-lg mb-4">
                    <p><strong>Address:</strong> 216 HAY L9NABEL TAWJTAT LMARROUK</p>
                    <p><strong>Phone:</strong> +212 6 9754 3162</p>
                    <p><strong>Email:</strong> <a href="mailto:911LACHI@GMAIL.COM">911LACHI@GMAIL.COM</a></p>
                    <p><strong>Website:</strong> HADA NNIT</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('layouts.footer')
