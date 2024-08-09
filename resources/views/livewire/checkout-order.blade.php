<div class="col-md-5">
    <div class="cart-right">

        <div class="order-info">
            <h4>Order Information</h4>
            <div class="order-header">
                <h3>#</h3>
                <h3>Product</h3>
                <h3>Q/R</h3>
                <h3>Total</h3>
            </div>
        </div>

        @forelse ($carts ?? [] as $productId => $cart)
            <div class="order-area">
                <div class="order-pack">
                    <img loading="lazy" src="{{ uploaded_asset($cart['image']) }}" width="50">
                    <h3>{{ Str::words($cart['product_name'], 4, '...') }}</h3>
                </div>
                <div class="order-pack">
                    <div class="quantity-checkout">
                        <div class="cart-quant">
                            <div class="quantity">
                                <button class="minus" wire:click='decrementQty({{ $cart['product_id'] }})'>-</button>
                                <input class="quantity-input" type="text" value="{{ $cart['quantity'] }}" readonly>
                                <button class="plus" wire:click='incrementQty({{ $cart['product_id'] }})'>+</button>
                            </div>
                        </div>

                    </div>
                </div>
                {{ get_setting('symbol') }}{{ $cart['net_amount'] }}
            </div>
        @empty
            <div class="text-center m-2">
                <strong class="font">Cart Is Empty</strong>
            </div>
        @endforelse

        <div class="sub-total">
            @php
                if (isset($carts)) {
                    $netAmounts = array_column($carts, 'net_amount');
                    $totalNetAmount = array_sum($netAmounts);
                } else {
                    $totalNetAmount = 0;
                }
            @endphp
            <p>Subtotal <span>{{ get_setting('symbol') }}{{ $totalNetAmount }}</span></p>
        </div>



        <div class="shipping">
            <p>Shipping</p>

            <p class="shipping-bar">Express
                <span>{{ get_setting('symbol') }}{{ get_setting('shipping_charge') }}</span>
            </p>

            <p>By clicking on "Proceed to purchase" you can log in or create your account and enjoy shopping
                without
                costs
            </p>
        </div>

        <div class="sub-total">
            @if (isset($promoCodeSession['promoCode']) && isset($promoCodeSession['promoCode']['amount']))
                <p>
                    Promo Code ({{ $promoCodeSession['promoCode']['amount'] }}%)
                    <span>
                        {{ get_setting('symbol') }}
                        {{ $totalNetAmount * ($promoCodeSession['promoCode']['amount'] / 100) }}
                        <i class="las la-trash-alt text-danger blockquote" wire:click='removePromoCode()'></i>
                    </span>
                </p>
            @endif
        </div>

        <div class="total">
            <p>Total
                <span>
                    {{ get_setting('symbol') }}
                    {{ get_setting('shipping_charge') + $totalNetAmount - (isset($promoCodeSession['promoCode']['amount']) ? $totalNetAmount * ($promoCodeSession['promoCode']['amount'] / 100) : 0) }}
                </span>

            </p>
        </div>
       
    </div>
</div>
