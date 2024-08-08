<div class="foot-whtsap">

    <span style="font-size:30px;cursor:pointer" onclick="openNav()">
        <p class="test" id="cart" class="cart" data-totalitems="0">
            {{$carts}}
        </p>
        <i class="las la-shopping-cart"></i>
         @php
            if (session('cart') ?? []) {
                $netAmounts = array_column(session('cart'), 'net_amount');
                $totalNetAmount = array_sum($netAmounts);
            } else {
                $totalNetAmount = 0;
            }

        @endphp
        <p>{{ get_setting('symbol') }}{{$totalNetAmount}}</p>
    </span>

</div>
