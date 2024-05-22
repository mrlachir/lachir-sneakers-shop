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
                        <p>Your cart is empty.</p>
                    @else
                        @foreach ($carts as $cart)
                            <div class="flex justify-between items-center border-b border-gray-200 py-4">
                                <div class="flex">
                                    <div class="mr-4">
                                        <div class="relative mb-4">
                                            <img src="{{ Storage::url($cart->sneaker->image_path) }}"
                                                alt="{{ $cart->sneaker->name }}" class="w-full h-40 object-cover">
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ $cart->sneaker->name }}</h3>
                                        <p>Brand: {{ $cart->sneaker->brand->name }}</p>
                                        <p>Price: ${{ $cart->sneaker->price }}</p>
                                        <p>Color: {{ $cart->sneaker->color_code }}</p>
                                        <p>Size: {{ $cart->sneaker->size }}</p>
                                        <p>Stock: {{ $cart->sneaker->stock }}</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex">
                                        <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" min="1" max="{{ $cart->sneaker->stock }}" name="quantity" value="{{ $cart->quantity }}"
                                                min="1">
                                            <button type="submit">Update</button>
                                        </form>
                                        <form action="{{ route('carts.destroy', $cart->id) }}" method="POST"
                                            class="ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Remove</button>
                                        </form> 
                                    </div>
                                </div>
                                <div>
                                    <p>Total: ${{ $cart->sneaker->price * $cart->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <p>Total Price: ${{ $totalPrice }}</p>
                            
                            <form action="{{ route('checkout.show') }}">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Checkout</button>
                            </form>
                            <!-- Add this button wherever you want to display the clear cart button -->
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Clear Cart</button>
                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
