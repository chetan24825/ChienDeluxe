@extends('fronts.layouts.app')
@section('meta_title'){{ $products->meta_title }} @stop
@section('meta_keywords'){{ $products->meta_keyword }} @stop
@section('meta_description') {{ $products->meta_description }} @stop
@section('content')

    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ route('webpage') }}">Home</a></li>
                    <li><a wire:navigate
                            href="{{ route('category.detail', $products->category->slug) }}">{{ $products->category->category_name }}</a>
                    </li>
                    <li><a wire:navigate href="{{ url()->current() }}">{{ Str::words($products->product_name, 4, ' ') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="product-detail-box">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content col-md-10">
                            <div class="tab-pane active" id="pic-0"><img loading="lazy"
                                    src="{{ uploaded_asset($products->thumbphotos) }}" /></div>
                            @foreach (explode(',', $products->photos) as $key => $image)
                                <div class="tab-pane" id="pic-{{ ++$key }}">
                                    <img loading="lazy" src="{{ uploaded_asset($image) }}" />
                                </div>
                            @endforeach
                            @if ($products->video_link)
                                <div class="tab-pane" id="pic-img">
                                    <iframe loading="lazy" src="{{ $products->video_link }}" width="500" height="400">
                                    </iframe>
                                </div>
                            @endif
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs col-md-2">
                            <li class="active">
                                <a data-target="#pic-0" data-toggle="tab"><img loading="lazy"
                                        src="{{ uploaded_asset($products->thumbphotos) }}" /></a>
                            </li>
                            @foreach (explode(',', $products->photos) as $key => $image)
                                <li><a data-target="#pic-{{ ++$key }}" data-toggle="tab">
                                        <img loading="lazy" src="{{ uploaded_asset($image) }}" />
                                    </a></li>
                            @endforeach

                            @if ($products->video_link)
                                <li><a data-target="#pic-img" data-toggle="tab">
                                        <img loading="lazy"
                                            src="http://img.youtube.com/vi/{{ extractYoutubeVideoId($products->video_link) }}/0.jpg"
                                            alt="image" />

                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @livewire('detail-cart', ['products' => $products])
                </div>
            </div>
        </div>
    </div>

    {{-- 
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-1 col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview" style="width: 100px;">
                            <img loading="lazy" src="{{ uploaded_asset($products->thumbphotos) }}"
                                alt="{{ uploaded_asset($products->thumbphotos) }}" height="100px" width="100px" />

                        </div>

                        @foreach (explode(',', $products->photos) as $image)
                            <div class="product-preview" style="width: 100px;">
                                <img loading="lazy" src="{{ uploaded_asset($image) }}" alt="{{ uploaded_asset($image) }}"
                                    height="100px" width="100px" />
                            </div>
                        @endforeach
                        @if ($products->video_link)
                            <div id="product-preview" style="width: 100px;">
                                <img loading="lazy"
                                    src=" http://img.youtube.com/vi/{{ extractYoutubeVideoId($products->video_link) }}/0.jpg"
                                    alt="image" height="100px" width="168px;" />
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img loading="lazy" src="{{ uploaded_asset($products->thumbphotos) }}"
                                alt="{{ uploaded_asset($products->thumbphotos) }}" />
                        </div>
                        @foreach (explode(',', $products->photos) as $image)
                            <div class="product-preview">
                                <img loading="lazy" src="{{ uploaded_asset($image) }}"
                                    alt="{{ uploaded_asset($image) }}" />
                            </div>
                        @endforeach
                        @if ($products->video_link)
                            <div id="product-preview">
                                <iframe loading="lazy" width="500" height="400" src="{{ $products->video_link }}">
                                </iframe>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-detail-content">
                        <h1>{{ $products->product_name }}</h1>

                        <ul class="ratings pl-0">
                            <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li>
                            <li><i class="las la-star"></i></li>
                        </ul>




                        @livewire('detail-cart', ['products' => $products])

                        <div class="feature-addon">

                            <div class="left-addon">

                                <div class="wishlist">
                                    <a @guest id="signupbutton" @endguest href="javascript:void(0)"
                                        @auth onclick="addTowishlist({{ $products->id }})" @endauth> <i
                                            class="lar la-heart"></i> Add to wishlist</a>
                                </div>


                                <div class="wishlist social-sharing">

                                    <a href="javascript:void(0)"> <i class="las la-share"></i> Share</a>
                                    <ul class="share-list">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                target="_blank"><i class="lab la-facebook-f"></i></a></li>
                                        <li><a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}"
                                                target="_blank"><i class="lab la-instagram"></i></a></li>
                                        <li><a href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(uploaded_asset($products->thumbphotos)) }}&description={{ urlencode(strip_tags($products->description)) }}"
                                                target="_blank" rel="noopener noreferrer"> <i
                                                    class="lab la-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>


                        <ul class="features-status">

                            <li><label>Availability: </label>
                                @if ($products->in_stock == 1 && $products->stock > 0)
                                    <span>In Stock</span>
                                @else
                                    <span>Out Of Stock</span>
                                @endif
                            </li>
                            <li><label>Categories: </label><span><a wire:navigate
                                        href="{{ route('category.detail', $products->category->slug) }}">{{ $products->category->category_name }}</a></span>
                            </li>
                            <li><label>Tags:</label>
                                @foreach (explode(',', $products->tags) as $tag)
                                    <span><a href="#">{{ $tag }}</a>,</span>
                                @endforeach
                            </li>

                        </ul>


                    </div>

                </div>

            </div>


            <div class="full-description">
                <div class="row">

                    <h3>Description</h3>
                    {!! $products->description !!}
                </div>
            </div>


            <div class="card text-body mt-3">
                @foreach ($products->reviews as $key => $review)
                    <div class="card-body p-4">
                        @if ($review->key == 0)
                            <h4 class="mb-0">Recent comments</h4>
                            <p class="fw-light mb-4 pb-2">Latest Comments</p>
                        @endif
                        <div class="d-flex flex-start">

                            <div>
                                <h6 class="fw-bold mb-1">{{ $review->user_name }}</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($review->created_at)->format('F d, Y') }}

                                        @for ($i = 1; $i <= $review->rate; $i++)
                                            <i class="las la-star text-warning"></i>
                                        @endfor
                                    </p>
                                </div>
                                <p class="mb-0">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-0">
                @endforeach


            </div>

            @auth
                <style>
                    .rate {
                        float: left;
                        height: 46px;
                        padding: 0 10px;
                    }

                    .rate:not(:checked)>input {
                        position: absolute;
                        top: 0px;
                        clip: rect(0, 0, 0, 0);
                        /* Further ensure hidden */
                        clip-path: inset(50%);
                        height: 1px;
                        width: 1px;
                        overflow: hidden;
                        border: 0;
                        margin: -1px;
                        padding: 0;
                        white-space: nowrap;
                    }

                    .rate:not(:checked)>label {
                        float: right;
                        width: 1em;
                        overflow: hidden;
                        white-space: nowrap;
                        cursor: pointer;
                        font-size: 30px;
                        color: #ccc;
                    }

                    .rate:not(:checked)>label:before {
                        content: '★ ';
                    }

                    .rate>input:checked~label {
                        color: #ffc700;
                    }

                    .rate:not(:checked)>label:hover,
                    .rate:not(:checked)>label:hover~label {
                        color: #deb217;
                    }

                    .rate>input:checked+label:hover,
                    .rate>input:checked+label:hover~label,
                    .rate>input:checked~label:hover,
                    .rate>input:checked~label:hover~label,
                    .rate>label:hover~input:checked~label {
                        color: #c59b08;
                    }
                </style>

                <div class="full-description">
                    <h3>Reviews</h3>

                    <form action="{{ route('reviews') }}" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="inputName">Your Name</label>
                                    <input type="text" id="inputName" name="user_name" value="{{ old('user_name') }}"
                                        class="form-control" required>
                                    @error('user_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <div class="form-group">
                                    <label for="inputName">Your Email</label>
                                    <input type="text" id="inputName" name="email" value="{{ old('email') }}"
                                        class="form-control" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3 ">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    <br>
                                    @error('rate')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputName">Comment</label>
                                    <textarea name="comment" class="form-control" cols="30" rows="4" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>


                            <div class="col-12">
                                <input type="submit" value="Submit" class="btn btn-success">
                            </div>

                        </div>
                    </form>

                </div>
            @endauth


        </div>
    </div> --}}



    <div class="container-fluid">
        <div class="row">
            <div class="title">
                <h3>Releated Products </h3>

            </div>
        </div>

        @livewire('component-related-products', ['slug' => $products->category->slug])

        @include('fronts.inc.subscribe')
    </div>
@endsection

@section('schema')



    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "{{ $products->category->category_name }}",
      "item": "{{ route('category.detail', $products->category->slug) }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $products->product_name }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>



    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": @json($products->product_name),
            "image": @json(uploaded_asset($products->thumbphotos)),
            "description": @json(Str::words(strip_tags($products->description), 40, '...')),
            "offers": {
                "@type": "Offer",
                "url": @json(url()->current()),
                "priceCurrency": "INR",
                "price": @json($products->sale_price),
                "availability": "https://schema.org/InStock",
                "itemCondition": "https://schema.org/NewCondition",
                "priceValidUntil": @json(now()->addYear()->format('Y-m-d')),
                "seller": {
                    "@type": "Organization",
                    "name": @json(config('app.name'))
                }
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": @json(number_format($products->averageRating(), 1)),
               "reviewCount": @json($products->reviews->count() > 0 ? $products->reviews->count() : 6)
            }
            @if($products->reviews->count() > 0)
            ,"review": [
                @foreach($products->reviews as $review)
                {
                    "@type": "Review",
                    "author": {
                        "@type": "Person",
                        "name": @json($review->user_name)
                    },
                    "reviewRating": {
                        "@type": "Rating",
                        "ratingValue": @json($review->rate)
                    },
                    "reviewBody": @json($review->comment)
                }@if (!$loop->last),@endif
                @endforeach
            ]
            @endif
        }
        </script>





@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('front/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/nouislider.min.css') }}">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"] {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('front/js/slick.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $("#product-main-img").slick({
                infinite: true,
                speed: 300,
                dots: false,
                arrows: true,
                fade: true,
                asNavFor: "#product-imgs",
            });

            $("#product-imgs").slick({
                slidesToShow: 10,
                slidesToScroll: 1,
                arrows: true,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: 0,
                vertical: true,
                asNavFor: "#product-main-img",
                responsive: [{
                    breakpoint: 991,
                    settings: {
                        vertical: false,
                        arrows: false,
                        dots: true,
                    },
                }, ],
            });
        })(jQuery);
    </script>
    <script>
        function addTowishlist(productId) {
            var token = "{{ csrf_token() }}";
            axios.post("{{ route('add.wishlist') }}", {
                    id: productId,
                    '_token': token,
                })
                .then(function(response) {
                    console.log(response.data);
                    // toastr.success('Product added to cart successfully!', 'success');
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function addToCart(productId) {
            var token = "{{ csrf_token() }}";
            axios.post("{{ route('add.cart') }}", {
                    product_id: productId,
                    '_token': token,
                })
                .then(function(response) {
                    console.log(response.data);
                    // toastr.success('Product added to cart successfully!', 'success');
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
