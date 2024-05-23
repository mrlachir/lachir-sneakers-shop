
@include('layouts.navigation')
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center">Order Confirmation</h2>
            <p class="text-gray-700 mt-4">Thank you for your purchase! Your order has been placed successfully.</p>

            <div class="mt-6">
                <h3 class="text-lg font-semibold">Order Details</h3>
                <p><strong>Order ID:</strong> {{ $recentOrder->id }}</p>
                <p><strong>Total Price:</strong> ${{ $recentOrder->total_price }}</p>
                {{-- <p><strong>Quantity:</strong> {{ $recentOrder->quantity }}</p> --}}
            </div>

            <div class="mt-6">
                <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Return to Home</a>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')