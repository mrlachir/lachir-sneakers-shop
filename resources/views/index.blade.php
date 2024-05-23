@include('layouts.navigation')

<x-app-layout>
    <div>
        <!-- slides -->
        <div>
            <div class="slider">
                @foreach ($slideshows->where('is_active', true) as $slideshow)
                    <div>
                        <a href="{{ $slideshow->link }}"><img src="{{ Storage::url($slideshow->image_path) }}"
                                alt="{{ $slideshow->title }}"></a>
                    </div>
                @endforeach

            </div>
            <div class="ctrl-container">
                <button class="custom-prev" aria-label="previous" type="button"><i class="fas fa-angle-left"></i></button>
                <button class="custom-next" aria-label="next" type="button"><i class="fas fa-angle-right"></i></button>
            </div>
        </div>


        <!-- Brands -->
        <div style="background-color: #fff; height:fit-content;padding-bottom: 50px">
            <div style="" class="flex flex-col items-center justify-center mt-4">
                <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
                </div>
                <h2
                    style="margin-top:-40px; padding: 0 30px; background-color: #fff;
                font-size: 50; width: fit-content;">
                    <b>BRANDS</b>
                </h2>
            </div>
            <dir class="images-tag flex items-center justify-center mt-2 gap-2">
                @foreach ($brands as $brand)
                    <a href="{{ route('login') }}">
                        <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                            <img src="{{ Storage::url($brand->image_path) }}" alt="{{ $brand->name }}">
                            {{-- <div>{{ $brand->name }}</div> --}}
                        </div>
                    </a>
                @endforeach
            </dir>
        </div>


        <!-- Featured Products -->
        <div style="background-color: #F3F4F6; height:fit-content;padding-bottom: 50px">
            @if ($featuredProducts->count() > 0)
                <div style="" class="flex flex-col items-center justify-center mt-4">
                    <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
                    </div>
                    <h2
                        style="margin-top:-40px; padding: 0 30px; background-color: #F3F4F6;
            font-size: 50; width: fit-content;">
                        <b>Featured Sneakers</b>
                    </h2>

                </div>
                {{-- @php
                    $brandName = 'nike'; // This can be a dynamic value
                @endphp --}}
                <a href="all/sneakers">
                    <button class="view-all-btn ">View all</button>
                </a>


                <div class="images-tag flex items-center justify-center mt-2 gap-3">
                    <div class="p-6 border-b border-gray-200 flex items-center justify-center">
                        <div class="gap-4 flex items-center justify-center" style="width: 60%">
                            @foreach ($featuredProducts as $featuredProduct)
                                @if ($featuredProduct->sneaker->stock >= 1)
                                    <a href="{{ route('sneakers.show', $featuredProduct->sneaker->id) }}">
                                        <div class="p-4 border rounded-lg bg-white">
                                            <!-- Sneaker Image -->
                                            <div class="relative mb-4">
                                                <img src="{{ Storage::url($featuredProduct->sneaker->image_path) }}"
                                                    alt="{{ $featuredProduct->sneaker->name }}"
                                                    class="w-full h-40 object-cover">
                                            </div>
                                            <!-- Sneaker Info -->
                                            <div class="text-gray-800 font-semibold mb-1">{{ $featuredProduct->order }}
                                            </div>
                                            <div class="text-gray-800 font-semibold">
                                                {{ $featuredProduct->sneaker->name }}</div>
                                            <div class="mt-2 text-gray-700">Brand:
                                                {{ $featuredProduct->sneaker->brand->name }}</div>
                                            <div class="mt-2 text-gray-700">Category:
                                                {{ $featuredProduct->sneaker->category->name }}</div>
                                            <div class="mt-2 text-gray-700">Price:
                                                ${{ $featuredProduct->sneaker->price }}</div>
                                            <button class="add-to-cart"
                                                data-sneaker-id="{{ $featuredProduct->sneaker->id }}">Add to
                                                Cart</button>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <p>No featured products found.</p>
            @endif
        </div>

        <!-- Hot Categories -->
        <div style="background-color: #fff; height:fit-content;padding-bottom: 50px">
            <div style="" class="flex flex-col items-center justify-center mt-4">
                <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
                </div>
                <h2
                    style="margin-top:-40px; padding: 0 30px; background-color: #fff;
                font-size: 50; width: fit-content;">
                    <b>HOT CATEGORIES</b>
                </h2>
            </div>
            <dir class="images-tag flex items-center justify-center mt-2 gap-2">
                @foreach ($topCategories as $topcategory)
                    <a href="{{ route('login') }}">
                        <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                            <img src="{{ Storage::url($topcategory->image_path) }}" alt="{{ $topcategory->name }}">
                        </div>
                    </a>
                @endforeach
            </dir>
        </div>

    </div>
</x-app-layout>










<style>
    .slider {
        width: max;
        height: fit-content;
        margin: 0;
        padding-bottom: 10px;
    }

    .custom-next,
    .custom-prev {
        background: none;

        padding-bottom: 31px;
        width: 30px;
        height: 30px;
        color: f3f3f3;
        font-size: 2rem;
        cursor: pointer;
        margin: 0 10px;
    }

    .custom-prev:hover,
    .custom-next:hover {
        background-color: #333;
        color: #f3f3f3;
    }

    .ctrl-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        position: absolute;
        left: 50%;
        top: 40%;
        transform: translateX(-50%);
    }

    .slick-slide {
        margin: 0px;
        height: 450px;
    }

    .slick-slide img {
        width: 100%;
        height: auto;

    }

    .view-all-btn {
        margin-left: 80%;
        margin-top: -52px;
        font-size: 20px;
        border: #333 solid 1px;
        padding: 0 10px;
        background-color: #F3F4F6;
        transition: transform .4s ease;
    }

    .view-all-btn:hover {
        background-color: #333;
        color: #f3f3f3;
        transform: scale(1.1);
    }




    .images-tag-contener {
        overflow: hidden;
    }

    .images-tag img {
        width: 100%;
        height: auto;
        margin: 0;
        transition: transform .4s ease, -webkit-transform .4s ease !important;
    }

    .images-tag img:hover {
        transform: scale(1.1);
    }
</style>
@include('layouts.footer')
