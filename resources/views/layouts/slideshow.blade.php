<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div id="slideshow" class="carousel slide relative" data-mdb-ride="carousel">
            <div class="carousel-inner py-5">
                {{-- @foreach($slides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $slide['image_url'] }}" class="block w-full h-64 object-cover" alt="{{ $slide['title'] }}">
                        <div class="carousel-caption hidden md:block absolute text-center">
                            <h5 class="text-xl">{{ $slide['title'] }}</h5>
                            <p>{{ $slide['description'] }}</p>
                        </div>
                    </div>
                @endforeach --}}
            </div>
            <button class="carousel-control-prev" type="button" data-mdb-target="#slideshow" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#slideshow" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>