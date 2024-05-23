@include('layouts.navigation')
<x-app-layout>
    <div class="container mx-auto px-4">
        <!-- Sneaker Details -->
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/2">
                <img src="{{ Storage::url($sneaker->image_path) }}" alt="{{ $sneaker->name }}" class="w-full h-80 object-cover">
            </div>
            <div class="lg:w-1/2 lg:pl-8">
                <h2 class="text-2xl font-semibold">{{ $sneaker->name }}</h2>
                <p class="text-gray-700 mt-4">{{ $sneaker->description }}</p>
                <p class="text-lg font-semibold mt-4">Price: ${{ $sneaker->price }}</p>
                <p class="mt-2">Brand: {{ $sneaker->brand->name }}</p>
                <p class="mt-2">Category: {{ $sneaker->category->name }}</p>
                <p class="mt-2">Average Rating: 
                    @if ($averageRating)
                        @for ($i = 0; $i < floor($averageRating); $i++)
                            ★
                        @endfor
                        @for ($i = floor($averageRating); $i < 5; $i++)
                            ☆
                        @endfor
                        ({{ round($averageRating, 2) }} / 5)
                    @else
                        No ratings yet
                    @endif
                </p>
                <form id="add-to-cart-form" method="POST">
                    @csrf
                    <input type="hidden" name="sneakerName" value="{{ $sneaker->name }}">
                    <input type="hidden" name="sneaker_id" value="{{ $sneaker->id }}">
                    <div class="mb-4">
                        <label for="size" class="block text-sm font-medium text-gray-700">Choose Size</label>
                        <select name="size" id="size" class="mt-1 block w-full">
                            @foreach ($availableSizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="color" class="block text-sm font-medium text-gray-700">Choose Color</label>
                        <select name="color" id="color" class="mt-1 block w-full">
                            @foreach ($availableColors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" data-sneaker-id="{{ $sneaker->id }}">
                        Add to Cart
                    </button>
                
                </form>
            </div>
        </div>
    
        <!-- Customer Reviews -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold">Customer Reviews</h3>
            @foreach ($sneaker->reviews as $review)
            
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="text-lg font-semibold">{{ $review->user->name }}</div>
                        <div class="ml-4 text-yellow-500">
                            @for ($i = 0; $i < $review->rating; $i++)
                                ★
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++)
                                ☆
                            @endfor
                        </div>
                    </div>
                    <p class="mt-2">{{ $review->comment }}</p>
                    @if (auth()->id() == $review->user_id)
                        <form action="{{ route('reviews.delete', $review->id) }}" method="POST" class="inline" data-refresh>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    
            <!-- Add Review -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Add a Review</h3>
                @if (session('error'))
                    <div class="bg-red-500 text-white p-2 mt-4">{{ session('error') }}</div>
                @endif
                
                <form action="{{ route('sneakers.addReview', $sneaker->id) }}" method="POST">
                    @csrf
                    @auth
                    
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                        <select name="rating" id="rating" class="mt-1 block w-full">
                            <option value="1">1 - Very Poor</option>
                            <option value="2">2 - Poor</option>
                            <option value="3">3 - Average</option>
                            <option value="4">4 - Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full"></textarea>
                    </div>
                    @endauth
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit Review
                    </button>
                </form>
            </div>
            
    
        <!-- Related Products -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold">You May Also Like</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                @foreach ($relatedSneakers as $related)
                    <div class="border rounded-lg p-4">
                        <a href="{{ route('sneakers.show', $related->id) }}">
                            <img src="{{ Storage::url($related->image_path) }}" alt="{{ $related->name }}" class="w-full h-40 object-cover">
                            <div class="mt-2 text-gray-800 font-semibold">{{ $related->name }}</div>
                            <div class="mt-2 text-gray-700">Price: ${{ $related->price }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Item added to cart') {
                    // Optionally update cart count in the navbar
                    updateCartCount(data.cartCount);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function updateCartCount(count) {
            const cartCountElement = document.querySelector('.cart-count');
            if (count > 0) {
                cartCountElement.textContent = count;
                cartCountElement.classList.remove('hidden');
            } else {
                cartCountElement.classList.add('hidden');
            }
        }
    </script>

</x-app-layout>
@include('layouts.footer')


