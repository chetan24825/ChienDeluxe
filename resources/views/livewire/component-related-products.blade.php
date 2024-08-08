<div class="container">
    <div class="row">
        <div class="list-btn">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach (App\Models\Attribute::where('attribute_status', 1)->get() as $key => $data)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ ++$key == $attri ? 'active' : '' }}" id="{{ $data->attribute_slug }}"
                            data-bs-toggle="tab" data-bs-target="#{{ $data->attribute_slug }}" type="button"
                            role="tab" aria-controls="{{ $data->attribute_slug }}"
                            aria-selected="{{ ++$key == $attri ? 'true' : 'false' }}"
                            wire:click="setProducts({{ $data->id }})">{{ $data->attribute_name }}</button>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('category.detail', $slug->slug) }}" class="view-btn">View All</a>

        </div>
        <div class="tab-content" id="myTabContent">
            @foreach (App\Models\Attribute::where('attribute_status', 1)->get() as $key => $data)
                <div class="tab-pane fade {{ ++$key == $attri ? 'show active' : '' }}" id="{{ $data->attribute_slug }}"
                    role="tabpanel" aria-labelledby="{{ $data->attribute_slug }}">

                    <div class="row mt-4">
                        @foreach ($products as $product)
                            <div class="col-md-3">

                                <div class="product-box mt-4">
                                    <div class="product-img">
                                        <img src="{{ uploaded_asset($product->thumbphotos) }}" class="img-fluid">

                                        <div class="cart-area">
                                            <ul>
                                                <li><a wire:click.debounce.1000ms="addToCart({{ $product->id }})"><i
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
                                {{-- <div class="row">
                                        <div class="col-lg-12 cus">
                                            {{ $products->links() }}
                                        </div>
                                    </div> --}}

                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
