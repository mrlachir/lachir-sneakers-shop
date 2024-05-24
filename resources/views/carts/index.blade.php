@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($carts->isEmpty())
                        <p class="text-center text-gray-600">Your cart is empty.</p>
                    @else
                        @foreach ($carts as $cart)
                            <div class="flex justify-between items-center border-b border-gray-200 py-4">
                                <div style="width: 50%" class="flex">
                                    <div class="mr-4 w-24 h-24">
                                        <a href="{{ route('sneakers.show', $cart->sneaker->id) }}">
                                        <img src="{{ Storage::url($cart->sneaker->image_path) }}"
                                            alt="{{ $cart->sneaker->name }}" class="w-full h-full object-cover rounded">
                                        </a>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $cart->sneaker->name }}</h3>
                                        <p class="text-gray-600">Brand: {{ $cart->sneaker->brand->name }}</p>
                                        <p class="text-gray-600">Price: ${{ $cart->sneaker->price }}</p>
                                        <p class="text-gray-600">Color: {{ $cart->sneaker->color_code }}</p>
                                        <p class="text-gray-600">Size: {{ $cart->sneaker->size }}</p>
                                        <p class="text-gray-600">Stock: {{ $cart->sneaker->stock }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                            min="1" max="{{ $cart->sneaker->stock }}" class="w-16 p-2 border rounded">
                                        <button type="submit" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">Update</button>
                                    </form>
                                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Remove</button>
                                    </form>
                                </div>
                                <div class="text-gray-800 font-semibold">
                                    <p>Total: ${{ $cart->sneaker->price * $cart->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <p class="text-lg font-semibold text-gray-800">Total Price: ${{ $totalPrice }}</p>
                            <div class="flex space-x-4 mt-4">
                                <form action="{{ route('checkout.show') }}">
                                    @csrf
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Checkout</button>
                                </form>
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Clear Cart</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')
