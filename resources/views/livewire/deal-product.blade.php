<div>
    @if ($product)
        <div class="product-pack">
            <div class="product-img">
               <a wire:navigate href="{{ route('product.detail', $product->product_slug) }}" title="View details of {{ $product->product_name }}">
                <img loading="lazy" src="{{ uploaded_asset($product->thumbphotos) }}" class="img-fluid" alt="{{ $product->product_name }}">
                </a>

                <div class="product-variation">
                    <ul>
                        <li><a wire:navigate href="{{ route('product.detail', $product->product_slug) }}" title="View images of {{ $product->product_name }}"><i
                                    class="las la-camera"></i> {{ count(explode(',', $product->photos)) }}</a>
                        </li>

                        @if ($product->video_link)
                            <li><a wire:navigate href="{{ route('product.detail', $product->product_slug) }}" title="Watch video of {{ $product->product_name }}"><i
                                        class="lab la-youtube"></i></a></li>
                        @endif

                    </ul>

                </div>


            </div>

            <div class="product-info">
                <h1><a wire:navigate
                        href="{{ route('product.detail', $product->product_slug) }}" title="{{ $product->product_name }}">{{ $product->product_name }}
                    </a>
                </h1>
                <div class="price">
                    <div class="price-txt">
                        <del>{{ get_setting('symbol') }}{{ $product->market_price }}</del>
                        <span>{{ get_setting('symbol') }}{{ $product->sale_price }}</span>
                    </div>
                </div>

                @if ($product->in_stock == 1 && $product->stock > 0)
                    <div class="page-wrapper">
                        <button class="add-to-cart-btn cart-link" data-productid="{{ $product->id }}"
                            wire:click.debounce.1000ms="addToCart({{ $product->id }})" title="Add {{ $product->product_name }} to cart">
                            Add to Cart
                            <span class="cart-item"></span>
                        </button>
                    </div>
                @else
                    <a href="javascript:void(0)" class="cart-dark" title="{{ $product->product_name }} is out of stock">Out Of Stock</a>
                @endif

            </div>

        </div>
    @else
        <div class="side-banner">
            <div class="side-img">
                <img loading="lazy" src="{{ uploaded_asset(get_setting('slider_top_image')) }}" class="img-fluid" alt="Promotional banner">
            </div>
        </div>

        <div class="mt-2"></div>

        <div class="side-banner">
            <div class="side-img">
                <img loading="lazy" src="{{ uploaded_asset(get_setting('slider_bottom_image')) }}" class="img-fluid" alt="Promotional banner">
            </div>
        </div>
    @endif

</div>



