{{-- <div>
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
</div> --}}

<div class="details col-md-6">
    <div class="brand-share">
        <h3>{{ $products->category->category_name }}</h3>
        <i class="las la-heart"></i>
    </div>

    <h3 class="product-title">{{ $products->product_name }}</h3>
    <h4 class="price">Price: <span>{{ get_setting('symbol') }}{{ $net_amount }}</span></h4>
    <div class="choose-color">
        <h5 class="colors"><span class="mb-2">Choose Color:</span><br>
            <div class="mt-3">
                <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                <span class="color green"></span>
                <span class="color blue"></span>
                <span class="color Red"></span>

            </div>
        </h5>
    </div>

    @if ($products->attributes)
        @php
            $attributes = json_decode($products->attributes, true); // Decode the JSON into an associative array
        @endphp
        @foreach ($attributes as $attribute)
            <div class="choose-size">
                <h5 class="sizes">
                    <span class="mb-2">Choose {{ App\Models\AttributeVariable::where('status', 1)->where('id',$attribute)->first()->name }}:</span>
                    <a href="#">{{ App\Models\AttributeVariable::where('status', 1)->where('id',$attribute)->first()->name }} Guide</a>
                </h5>
                <select>
                    <option value="">99</option>
                </select>
            </div>
        @endforeach
    @endif



    <div class="descrition">
        <h3>Description</h3>
        <p>{!! $products->description !!}</p>

        {{-- <div class="product-code">
            <p>Product Code : 3DAM08AM10TH78</p>
        </div> --}}
    </div>

    {{-- <div class="details-list">
        <h3>Details</h3>
        <ul>
            <li>Composition 70% Cashmere 30% Silk</li>
            <li>Oval neckline </li>
            <li>Lorem ipsum, dolor sit </li>

        </ul>

    </div> --}}

    <div class="action">
        <button class="add-to-cart btn btn-default" type="button" wire:click='addToCart({{ $products->id }})'>add to
            cart</button>
    </div>
</div>
