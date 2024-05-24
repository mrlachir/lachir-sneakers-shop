@include('layouts.navigation')
<x-app-layout>
    <div class="container mx-auto px-4">
        <!-- Sneaker Details -->
        <div class="flex flex-col lg:flex-row">
            <div class="mt-12 lg:w-1/2">
                <img src="{{ Storage::url($sneaker->image_path) }}" alt="{{ $sneaker->name }}" class="w-full h-auto object-cover">
                <!-- Add Review -->
            <div class="mt-8">
                
                @if (session('error'))
                    <div class="bg-red-500 text-white p-2 mt-4 rounded">{{ session('error') }}</div>
                @endif

                <form action="{{ route('sneakers.addReview', $sneaker->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold mb-4 py-2 px-4 rounded">
                        Add Review
                    </button>
                    @auth
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                        
                        <select name="rating" id="rating" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="1">1 - Very Poor</option>
                            <option value="2">2 - Poor</option>
                            <option value="3">3 - Average</option>
                            <option value="4">4 - Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    @endauth
                    
                </form>
            </div>
            </div>
            <div class="mt-12 lg:w-1/2 lg:pl-8">
                <h2 class="text-2xl font-semibold">{{ $sneaker->name }}</h2>
                <p class="text-gray-700 mt-4">{{ $sneaker->description }}</p>
                <p class="mt-2">{{ $sneaker->brand->name }}</p>
                <p class="mt-2">
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
                    <div class="flex">
                        <div style="width: 50%;" class="mb-4 mt-4">
                            <label for="size" class="block text-sm font-medium text-gray-700">Choose Size</label>
                            <select style="width: 90%;" name="size" id="size" class="mt-1 block w-full rounded">
                                @foreach ($availableSizes as $size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="width: 50%;" class="mb-4 mt-4">
                            <label for="color" class="block text-sm font-medium text-gray-700">Choose Color</label>
                            <select style="width: 90%;" name="color" id="color" class="mt-1 block w-full rounded">
                                @foreach ($availableColors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Price and Add to Cart Button -->
                    <div class="flex justify-between items-center mt-4">
                            <p style="font-size: 25px;color: seagreen" class="text-lg font-semibold">${{ $sneaker->price }}</p>
                            <button style="width: 50%;" class="bg-green-800 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" type="submit" data-sneaker-id="{{ $sneaker->id }}">
                                Add to Cart
                            </button>
                    </div>

                    
                </form>

                <div class="mt-20">
                    <div class="flex flex-col items-center justify-center mt-4">
                        <div style="margin-top: 60px; width: 100%; border-top: #606060 solid 2px;"></div>
                        <h2 style="margin-top: -19px; font-size: 22px; padding: 0 20px; background-color: #fff; width: fit-content;">
                            <b>Customer Reviews</b>
                        </h2>
                    </div>  
                    @foreach ($topReviews as $review)
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
            </div>
        </div>
    
        <!-- Customer Reviews -->
        
    
            

            
    
        <!-- Related Products -->
        <!-- You May Also Like -->
<div style="background-color: #fff; height: fit-content; padding-bottom: 50px;">
    @if ($relatedSneakers->count() > 0)
        <div class="flex flex-col items-center justify-center mt-4">
            <div style="margin-top: 60px; width: 90%; border-top: #606060 solid 2px;"></div>
            <h2 style="margin-top: -40px; font-size: 50px; padding: 0 30px; background-color: #fff; width: fit-content;">
                <b>You May Also Like</b>
            </h2>
        </div>
        
        <div class="flex items-center justify-center mt-2 gap-3">
            <div class="p-6 border-gray-200 flex items-center justify-center">
                <div class="gap-4 flex items-center justify-center" >
                    @foreach ($relatedSneakers as $related)
                        <a href="{{ route('sneakers.show', $related->id) }}">
                            <div style="width: 250px; height:auto;" class=" border rounded-lg bg-white">
                                <!-- Sneaker Image -->
                                <div style="overflow: hidden;" class="relative mb-4">
                                    <img style="height: auto" src="{{ Storage::url($related->image_path) }}" alt="{{ $related->name }}" class="w-full h-40 object-cover">
                                </div>
                                <!-- Sneaker Info -->
                                <div style="font-size: 10px;" class="px-2 mt-2 text-gray-700 font-semibold">{{ $related->name }}</div>
                                <div class="px-2 mt-2 text-green-700">${{ $related->price }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
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


