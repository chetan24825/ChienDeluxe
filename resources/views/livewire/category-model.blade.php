<div>
    @section('meta_title'){{ $slug->meta_title }}@stop
    @section('meta_description'){{ $slug->meta_description }}@stop
    @section('meta_keywords'){{ $slug->meta_keywords }}@stop

        <div class="breadcum-area">
            <div class="container-fluid">
                <div class="row">
                    <ul>
                        <li><a wire:navigate href="{{ route('webpage') }}">Home</a></li>
                        <li><a wire:navigate href="{{ url()->current() }}">Category</a></li>
                        <li><a wire:navigate
                                href="{{ url()->current() }}">{{ ucwords(str_replace('-', ' ', getCategorySlugFromUrl(url()->current()))) }}</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">


                <div class="list-btn">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach (App\Models\Attribute::where('attribute_status', 1)->get() as $key => $data)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ ++$key == $attri ? 'active' : '' }}"
                                    id="{{ $data->attribute_slug }}" data-bs-toggle="tab"
                                    data-bs-target="#{{ $data->attribute_slug }}" type="button" role="tab"
                                    aria-controls="{{ $data->attribute_slug }}"
                                    aria-selected="{{ ++$key == $attri ? 'true' : 'false' }}"
                                    wire:click="setProducts({{ $data->id }})">{{ $data->attribute_name }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                
                    @foreach (App\Models\Attribute::where('attribute_status', 1)->get() as $key => $data)
                        <div class="tab-pane fade {{ ++$key == $attri ? 'show active' : '' }}"
                            id="{{ $data->attribute_slug }}" role="tabpanel"
                            aria-labelledby="{{ $data->attribute_slug }}">

                            <div class="row mt-4">
                                <div class="col-sm-2">
                                    <div class="card border-secondary" style="margin-top: 27px">
                                        <div class="card-body">
                                            <h3 class="h5 card-title">Colors</h3>
                                            <div class="row">
                                                @foreach ($colors as $key => $data)
                                                    <div class="col-12">
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="cartCheck{{ $key }}">
                                                            <label class="colour-colorDisplay" for="cartCheck{{ $key }}"
                                                                style="background-color: {{ $data->code }};">
                                                            </label>
                                                            <span class="fs">{{ $data->name }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                
                                                @if ($colors->hasMorePages())
                                                    <div class="text-center mt-3">
                                                        <button wire:click="loadMore" class="badge badge-dark">Load
                                                            More</button>
                                                    </div>
                                                @endif
                                
                                
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="card border-secondary mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">Price Range</h5>
                                            <!-- Simple slider -->
                                            <div class="form-group">
                                                <input type="range" class="form-control-range" id="formControlRange">
                                            </div>
                                            <!-- End of Slider -->
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Min</label>
                                                    <input class="form-control mt-2" placeholder="0" type="number">
                                                </div>
                                                <div class="form-group text-right col-md-12">
                                                    <label>Max</label>
                                                    <input class="form-control mt-2" placeholder="1,0000" type="number">
                                                </div>
                                            </div>
                                            <button class="btn btn-block btn-primary mt-2">Apply</button>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <div class="col-md-10">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-md-3">

                                                <div class="product-box mt-4">
                                                    <div class="product-img">
                                                        <img src="{{ uploaded_asset($product->thumbphotos) }}"
                                                            class="img-fluid">

                                                        <div class="cart-area">
                                                            <ul>
                                                                <li><a
                                                                        wire:click.debounce.1000ms="addToCart({{ $product->id }})"><i
                                                                            class="las la-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a wire:navigate
                                                                href="{{ route('product.detail', $product->product_slug) }}">{{ Str::words($product->product_name, 3, '...') }}</a>
                                                        </h3>
                                                        <div class="price-tab">
                                                            <div class="prd-category">
                                                                <a
                                                                    href="{{ route('category.detail', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                                                            </div>

                                                            <div class="price">
                                                                {{ get_setting('symbol') }}{{ $product->sale_price }}
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="empty-space"></div>
    </div>

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
            "item": "{{url('/')}}"
          },
          
          {
            "@type": "ListItem",
            "position": 2,
            "name": "{{  ucwords(str_replace("-"," ",getCategorySlugFromUrl(url()->current())))}}",
            "item": "{{ url()->current()}}"
          }

          ]
        }
        </script>
@stop
