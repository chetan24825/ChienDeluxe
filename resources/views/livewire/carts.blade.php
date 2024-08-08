<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="cart-left">
                <h4>Cart</h4>
                @if (count($carts ?? []) > 0)
                    <p>You Have {{ count($carts) }} item in your Cart</p>
                @endif


                @forelse ($carts ?? [] as $productId => $cart)
                    <div class="product-cart mt-3">
                        <div class="cart-box ">
                            <div class="cart-img">
                                <img src="{{ uploaded_asset($cart['image']) }}" width="150" />

                                <div class="cart-detail">
                                    <h4>Brand Name Here</h4>
                                    <h3>{{ Str::words($cart['product_name'], 4, '...') }}</h3>
                                    <p class="select-color">Color:<strong>Color Name</strong></p>
                                    <p class="size">Size:<strong>42</strong></p>
                                </div>
                            </div>

                            <div class="cart-quant">
                                <div class="quantity">
                                    <button class="minus"
                                        wire:click='decrementQty({{ $cart['product_id'] }})'>-</button>
                                    <input type="text" value="{{ $cart['quantity'] }}" readonly="">
                                    <button class="plus"
                                        wire:click='incrementQty({{ $cart['product_id'] }})'>+</button>
                                </div>
                            </div>
                            <div class="cart-price">
                                <b>{{ get_setting('symbol') }}{{ $cart['net_amount'] }}</b>
                            </div>



                        </div>

                        <div class="remove-cart">

                            <a href="javascript:void(0)" wire:click='addToWishlist({{ $cart['product_id'] }})'><i
                                    class="las la-heart"></i> Wishlist</a>
                            <a href="javascript:void(0)" wire:click='tocarddelete({{ $cart['product_id'] }})'><i
                                    class="las la-trash-alt"></i>
                                Remove</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center m-5">
                        <strong> Cart Is Empty</strong>

                    </div>
                @endforelse






                <div class="row justify-content-center">
                    <div class="promo-code col-md-7">
                        <form method="post" action="#">
                            <input type="text" placeholder="Please enter your Promotional Code">
                            <button type="button">Apply</button>
                        </form>
                    </div>
                </div>



            </div>
        </div>
        @if (count($carts ?? []) > 0)
            <div class="col-md-4">
                @php
                    if (isset($carts)) {
                        $netAmounts = array_column($carts, 'net_amount');
                        $totalNetAmount = array_sum($netAmounts);
                    } else {
                        $totalNetAmount = 0;
                    }

                @endphp
                <div class="cart-right">
                    <div class="sub-total">
                        <p>Subtotal <span>{{ get_setting('symbol') }}{{ $totalNetAmount }}</span></p>
                    </div>


                    <div class="shipping">
                        <p>Shipping</p>

                        <p class="shipping-bar">Express <span>
                                {{ get_setting('symbol') }}{{ get_setting('shipping_charge') }}</span></p>

                        <p>By clicking on "Proceed to purchase" you can log in or create your account and enjoy shopping
                            without
                            costs
                        </p>
                    </div>

                    <div class="total">
                        <p>Total
                            <span>{{ get_setting('symbol') }}{{ $totalNetAmount + get_setting('shipping_charge') }}</span>
                        </p>
                    </div>
                    <div class="payment-btn">
                        <a href="{{ route('checkout.view') }}" class="purchase-btn">Proceed to purchase</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
