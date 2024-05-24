@include('layouts.navigation')

<x-app-layout>
    <div>
        <!-- slides -->
        <div>
            <div class="slider">
                @foreach ($slideshows->where('is_active', true)->sortBy('order') as $slideshow)
    <div>
        <a href="{{ $slideshow->link }}">
            <img src="{{ Storage::url($slideshow->image_path) }}" alt="{{ $slideshow->title }}">
        </a>
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
                    style="margin-top:-40px; font-size:50px; padding: 0 30px; background-color: #fff;
                font-size: 50; width: fit-content;">
                    <b>BRANDS</b>
                </h2>
            </div>
            <dir class="images-tag flex items-center justify-center mt-2 gap-2">
                @foreach ($brands as $brand)
                    <a href="all/sneakers/brand/{{ $brand->name }}">
                        <div style="width: 200px;" class="images-tag-contener images-tag flex items-center justify-center mt-2">
                            <img src="{{ Storage::url($brand->image_path) }}" alt="{{ $brand->name }} " >
                            {{-- <div>{{ $brand->name }}</div> --}}
                        </div>
                    </a>
                @endforeach
            </dir>
        </div>


        <!-- Featured Products -->
        <div style="background-color: rgb(225, 228, 232); height:fit-content;padding-bottom: 50px">
            @if ($featuredProducts->count() > 0)
                <div style="" class="flex flex-col items-center justify-center mt-4">
                    <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
                    </div>
                    <h2
                        style="margin-top:-40px; font-size:50px; padding: 0 30px; background-color: rgb(225, 228, 232);
            font-size: 50; width: fit-content;">
                        <b>Featured Sneakers</b>
                    </h2>

                </div>
                <a href="all/sneakers">
                    <button class="view-all-btn ">View all</button>
                </a>


                <div class="images-tag flex items-center justify-center mt-2 gap-3">
                    <div class="p-6  border-gray-200 flex items-center justify-center">
                        <div class="gap-4 flex items-center justify-center" style="width: 100%">
                            @foreach ($featuredProducts as $featuredProduct)
                                @if ($featuredProduct->sneaker->stock >= 1)
                                    <a href="{{ route('sneakers.show', $featuredProduct->sneaker->id) }}">
                                        <div  class="border rounded-lg bg-white">
                                            <!-- Sneaker Image -->
                                            <div style="overflow: hidden" class="relative mb-4">
                                                <img src="{{ Storage::url($featuredProduct->sneaker->image_path) }}"
                                                    alt="{{ $featuredProduct->sneaker->name }}"
                                                    class="w-full h-40 object-cover">
                                            </div>
                                            <!-- Sneaker Info -->
                                            
                                            <div class="px-2 mt-2 text-gray-700">
                                                {{ $featuredProduct->sneaker->name }}</div>
                                            <div class="px-2 mt-2 text-green-700">
                                                ${{ $featuredProduct->sneaker->price }}
                                            </div>
                                                
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif
        </div>

        <!-- Hot Categories -->
        <div style="background-color: #fff; height:fit-content;padding-bottom: 50px">
            <div style="" class="flex flex-col items-center justify-center mt-4">
                <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
                </div>
                <h2
                    style="margin-top:-40px; font-size:50px; padding: 0 30px; background-color: #fff;
                font-size: 50; width: fit-content;">
                    <b>TOP CATEGORIES</b>
                </h2>
            </div>

            <dir  class="images-tag flex items-center justify-center mx-10 gap-2">
                @foreach ($topCategories as $topcategory)
                    <a href="http://127.0.0.1:8000/all/sneakers/category/{{ $topcategory->category->name }}">
                        <div  class="images-tag-contener images-tag flex items-center justify-center mt-2">
                            <img  style="width: 100%;" src="{{ Storage::url($topcategory->image_path) }}" alt="{{ $topcategory->name }}">
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

        padding-bottom: 45px;
        width: 30px;
        height: 30px;
        /* color: #f3f3f3; */
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
        position: absolute ;
        margin-top: -55px;
        font-size: 25px;
        border: #333 solid 1px;
        padding: 0 10px;
        background-color: rgb(225, 228, 232);
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
        height: auto;
        margin: 0;
        transition: transform .4s ease, -webkit-transform .4s ease !important;
    }

    .images-tag img:hover {
        transform: scale(1.1);
    }
</style>
@include('layouts.footer')
