@if (App\Models\Slider::where('status', 1)->get()->count() > 0)
    <div class="slider-area">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">

                @foreach (App\Models\Slider::where('status', 1)->get() as $key => $data)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}" {{ $key == 0 ? "aria-current='true'" : '' }}
                        aria-label="Slide {{ $key }}"></button>
                @endforeach

            </div>
            <div class="carousel-inner">
                @foreach (App\Models\Slider::where('status', 1)->get() as $key => $slide)
                    <div class="carousel-item @if ($key == 0) active @endif">
                        <img src="{{ uploaded_asset($slide->slider_image) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block slider-text">
                            <h1>{{ $slide->slider_title }}</h1>
                            <p>{{ $slide->slider_description }}</p>
                            @if ($slide->slider_link)
                                <a href="{{ $slide->slider_link }}">Shop Now</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>





            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endif
