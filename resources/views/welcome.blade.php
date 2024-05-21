<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
 

{{-- @include('layouts.navigation') --}}
<x-app-layout>
    <div>
        <div class="slider">
            <a href="{{ route('login') }}" class="w-full h-full">
                <img src="{{ asset('storage/Hero_Banner_V3.jpg') }}" alt="Hero Banner Image">
            </a>
            <a href="{{ route('login') }}" class="w-full h-full">
                <img src="{{ asset('storage/halad_image.png') }}" alt="Hero Banner Image">
            </a>
        </div>
        <div class="ctrl-container">
            <button class="custom-prev" aria-label="previous" type="button"><i class="fas fa-angle-left"></i></button>
            <button class="custom-next" aria-label="next" type="button"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>

    <div style="background-color: #fff; height:fit-content;padding-bottom: 50px">
        <div style="" class="flex flex-col items-center justify-center mt-4">
            <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
            </div>
            <h2 style="margin-top:-40px; padding: 0 30px; background-color: #fff;
            font-size: 50; width: fit-content;"><b>BRANDS</b></h2>
        </div>
        <dir class="images-tag flex items-center justify-center mt-2 gap-2">
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
        </dir>
    </div>
    <div style="background-color: #F3F4F6; height:fit-content;padding-bottom: 50px">

        <div style="" class="flex flex-col items-center justify-center mt-4">
            <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
            </div>
            <h2 style="margin-top:-40px; padding: 0 30px; background-color: #F3F4F6;
            font-size: 50; width: fit-content;"><b>BRANDS</b></h2>
            
        </div>
        <button class="view-all-btn ">View all</button>

        <dir class="images-tag flex items-center justify-center mt-2 gap-2">
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
        </dir>

    </div>

    <div style="background-color: #fff; height:fit-content;padding: 50px">
        <div style="" class="flex flex-col items-center justify-center mt-4">
            <div style="margin-top:60px;width: 90%; border-top: #606060 solid 2px;">
            </div>
            <h2 style="margin-top:-40px; padding: 0 30px; background-color: #fff;
            font-size: 50; width: fit-content;"><b>BRANDS</b></h2>
        </div>
        <dir class="images-tag flex items-center justify-center mt-2 gap-3">
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
            <div class="images-tag-contener images-tag flex items-center justify-center mt-2">
                <img src="{{ asset('storage/SHOP_DUNKS_WHATS_NEW.png') }}">
            </div>
        </dir>
    </div>
</x-app-layout>


<style>
    .slider {
        width: max;
        height: fit-content;
        margin: 0 ;
        padding-bottom: 10px;
    }
    .custom-next,.custom-prev {
        background: none;

        padding-bottom:  31px;
        width: 30px;
        height: 30px;
        color: f3f3f3;
        font-size: 2rem;
        cursor: pointer;
        margin: 0 10px;
    }
    .custom-prev:hover,.custom-next:hover {
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
    .view-all-btn{
        margin-left:83%; margin-top: -52px; font-size: 20px; border: #333 solid 1px; padding: 0 10px; background-color: #F3F4F6;
        transition: transform .4s ease;
    }
    .view-all-btn:hover{
        background-color: #333;
        color: #f3f3f3;
        transform: scale(1.1) ;

    }




    .images-tag-contener{
        overflow: hidden;
    }
    .images-tag img{
        width: 100%;
        height: auto;
        margin: 0;
        transition: transform .4s ease, -webkit-transform .4s ease !important;
    }
    .images-tag img:hover {
        transform: scale(1.1) ;
    }
</style>


<script>
    $(document).ready(function() {
        $('.slider').slick({
            autoplay: true,
            autoplaySpeed: 4000,
            prevArrow: $(".custom-prev"),
            nextArrow: $(".custom-next")
        });
    });
</script>
