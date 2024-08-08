<div>
    <div class="price-tab" style="align-items: baseline;">
        <div class="main-price">
            <del>{{ get_setting('symbol') }}{{ $products->market_price }}</del>
        </div>
        <div class="sale-price big-price">
            <span id="sale_price"
                data-price="{{ $products->sale_price }}">{{ get_setting('symbol') }}{{ $net_amount }}
        </div>
        <p class="txt-tgline"><small>&nbsp;(Inclusive of All Taxes)</small></p>

    </div>

    <span class="stock-label"> Save
        {{ round((($products->market_price - $products->sale_price) / $products->market_price) * 100, 1) }}%({{ get_setting('symbol') }}{{ $products->market_price - $products->sale_price }})
        on this deal </span>


    <div class="cart-row detail-prdt-box">
    
        
        @if (isset($cart) && is_countable($cart) && count($cart) > 0 && array_key_exists($products->id, $cart))
            <div class="quantity">
                <button class="minus" wire:click='decrementQty({{ $products->id }})'>-</button>
                <input type="number" placeholder="Qty" class="selectpack" min="1"
                    data-product-id="{{ $products->id }}" value="{{ $quantity }}" readonly>
                <button class="plus" wire:click='incrementQty({{ $products->id }})'>+</button>
            </div>
        @endif

        @if ($products->in_stock == 1 && $products->stock > 0)
            <div class="cart-btn">
                <a href="javascript:void(0)" id="addToCart" wire:click='addToCart({{$products->id}})'>Add to Cart</a>
            </div>
        @else
            <div class="cart-btn1">
                <a href="javascript:void(0)">Out Of Stock</a>
            </div>
        @endif
    </div>
</div>
