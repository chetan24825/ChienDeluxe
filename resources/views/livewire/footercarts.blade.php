<div class="side-off" id="side-off">
    <h3>Your Purchase</h3>

    @foreach (session('cart') ?? [] as $productId => $cart)
        <hr>
        <div class="side-box">
            <div class="cart-img-name">
                <h3>{{ Str::words($cart['product_name'], 20, '...') }}</h3>
                <div class="total-price  d-flex justify-content-between">
                    <strong>({{ $cart['rate'] }} x {{ $cart['quantity'] }})</strong>

                    <div class="quantity">

                        <button class="minus" wire:click='decrementQty({{ $cart['product_id'] }} )'>-</button>

                        <input type="text" value="{{ $cart['quantity'] }}" readonly>

                        <button class="plus" wire:click='incrementQty({{ $cart['product_id'] }})'>+</button>

                    </div>
                    {{get_setting('symbol')}}{{ $cart['net_amount'] }}
                    <span class="trash-btn-footer" wire:click="tocarddelete({{ $cart['product_id'] }})">
                        <i class="las la-trash"></i>
                    </span>
                    
                    <style>
                      .trash-btn-footer {
                          cursor: pointer;
                          font-size: 18px;
                      }
                     </style>
                </div>
            </div>
        </div>
    @endforeach
    <hr>
    <div class="price-bar">
        @php
            if (session('cart') ?? []) {
                $netAmounts = array_column(session('cart'), 'net_amount');
                $totalNetAmount = array_sum($netAmounts);
            } else {
                $totalNetAmount = 0;
            }

        @endphp
        <h3>{{get_setting('symbol')}}{{ $totalNetAmount }}</h3>
    </div>
    <hr>

    <a href="{{ route('checkout.view') }}" class="side-check">Checkout</a>
</div>
