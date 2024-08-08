<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="cart-left">
                <h4>My Favourites</h4>
                <p>You Have 1 item in your Wishlist</p>
                <div class="row">
                    @forelse ($wishlistProduct as $wishlist)
                        <div class="col-md-6">
                            <div class="product-cart mt-2">
                                <div class="cart-box">
                                    <div class="cart-img">
                                        <img src="{{ uploaded_asset($wishlist->product->thumbphotos) }}"
                                            width="150" />

                                        <div class="cart-detail">
                                            <h4>Brand Name Here</h4>
                                            <h3>{{ Str::words($wishlist->product->product_name, 3, '...') }}</h3>
                                            <p class="select-color">Color:<strong>Color Name</strong></p>
                                            <p class="size">Size:<strong>42</strong></p>
                                        </div>
                                    </div>

                                    @if (isset($cart) && is_countable($cart) && count($cart) > 0 && array_key_exists($wishlist->product->id, $cart))
                                        <div class="cart-quant">
                                            <div class="quantity">
                                                <button class="minus"
                                                    wire:click="decrementQty({{ $wishlist->product->id }})">-</button>
                                                <input type="number" placeholder="Qty" min="1"
                                                    value="{{ $cart[$wishlist->product->id]['quantity'] }}" readonly>
                                                <button class="plus"
                                                    wire:click="incrementQty({{ $wishlist->product->id }})">+</button>
                                            </div>
                                        </div>
                                    @endif



                                    <div class="cart-price">
                                        @if (isset($cart) && is_countable($cart) && count($cart) > 0 && array_key_exists($wishlist->product->id, $cart))
                                            <b>{{ get_setting('symbol') }}{{ $cart[$wishlist->product->id]['net_amount'] }}</b>
                                        @else
                                            <b>{{ get_setting('symbol') }}{{ $wishlist->product->sale_price }}</b>
                                        @endif

                                    </div>
                                </div>

                                <div class="remove-cart">
                                    @if (!isset($cart) || !is_countable($cart) || !array_key_exists($wishlist->product->id, $cart))
                                        <a href="javascript:void(0)"
                                            wire:click.debounce.1000ms="addToCart({{ $wishlist->id }})">
                                            <i class="las la-shopping-cart"></i>Add To Cart
                                        </a>
                                    @endif
                                    <a href="javascript:void(0)"
                                        wire:click='removeFromWishlist({{ $wishlist->id }})'><i
                                            class="las la-trash-alt"></i> Remove</a>
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="col-md-12">
                            <Strong>Empty Wishlist</Strong>
                        </div>
                    @endforelse


                    @include('fronts.inc.subscribe')



                </div>
            </div>
        </div>
    </div>
</div>
