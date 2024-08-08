
<h3>Your Purchase</h3>
@foreach ($cart ?? [] as $productId => $crt)
            <hr>
            <div class="side-box">
              <div class="cart-img-name">
                  <h3>{{ Str::words($crt['product_name'], 20, '...') }}</h3>
                  <div class="total-price  d-flex justify-content-between">
                      <strong>({{ $crt['rate'] }} x {{ $crt['quantity'] }})</strong>
                      <div class="quantity">
                                    <button class="minus">-</button>
                                    <input type="number" placeholder="Qty" class="selectpack" min="1"
                                        data-product-id="{{ $crt['product_id'] }}" value="{{ $crt['quantity'] }}"><button
                                        class="plus">+</button>
                                </div>
                  Rs.{{ $crt['net_amount'] }}/-
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
        <h3>Rs.{{$totalNetAmount}}/-</h3>
    </div>
    <hr>

    <a href="{{ route('checkout.view') }}" class="side-check">Checkout</a>