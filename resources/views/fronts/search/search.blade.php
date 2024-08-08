@extends('fronts.layouts.app')
@section('content')
    <div class="pack-breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcumb-text text-center">
                        <h5>demo Products</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products wow fadeInUp animated">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('fronts.inc.product_category')
                </div>

                {{-- home-product --}}
                <div class="col-md-9 ">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-3 mt-3">
                                <div class="product-pack">
                                    <div class="product-img">
                                        <img loading="lazy" src="{{ uploaded_asset($product->thumbphotos) }}" class="img-fluid">
                                        <div class="product-variation">
                                            <ul>
                                                <li><a
                                                        href="{{ route('product.detail', $product->product_slug) }}">{{ count(explode(',', $product->photos)) }}</a>
                                                </li>
                                                <li><a href="javascript:void(0)"><i class="lab la-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-info">
                                        <h1><a
                                                href="{{ route('product.detail', $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h1>
                                        <div class="price">
                                            <div class="price-txt">
                                                <del>Rs.{{ $product->market_price }}/-</del>
                                                <span>Rs.{{ $product->sale_price }}/-</span>
                                            </div>
                                        </div>

                                        @if ($product->in_stock == 1 && $product->temp_stock > 0)
                                            <a href="javascript:void(0)" class="cart-link selectpack"
                                                onclick="addToCart({{ $product->id }})">Add to Cart</a>
                                        @else
                                            <a href="javascript:void(0)" class="cart-dark">Out Of Stock</a>
                                        @endif


                                    </div>

                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 cus">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

    <div class="empty-space"></div>
@endsection
@section('script')
    <script>
        function addToCart(productId) {
            var token = "{{ csrf_token() }}";
            axios.post("{{ route('add.cart') }}", {
                    product_id: productId,
                    '_token': token,
                })
                .then(function(response) {
                    console.log(response.data);
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
