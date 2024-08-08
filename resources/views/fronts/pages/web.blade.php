@extends('fronts.layouts.app')
@section('content')
    @include('fronts.inc.slider')
    {{-- @include('fronts.inc.category') --}}


    <div class="container">
        <div class="row">
            <div class="title">
                <h3>Best Seller </h3>
            </div>
        </div>
        @livewire('productlists')
    </div>
    @include('fronts.inc.accessries')
    @include('fronts.inc.testimonial')
@endsection

@section('schema')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{config('app.name')}}",
      "alternateName": "{{ config('app.name')}}",
      "url": "{{url('/')}}",
      "logo": "{{ uploaded_asset(get_setting('web_logo')) }}",
      "contactPoint": {
        "@type": "customer service",
        "telephone": "{{ get_setting('comany_phone') }}",
        "contactType": "sales",
        "contactOption": "TollFree",
        "areaServed": "IN",
        "availableLanguage": ["en","Hindi"]
      },
      "sameAs": "{{url('/')}}"
    }
    </script>
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
                    // toastr.success('Product added to cart successfully!', 'success');
                    location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').on('click', function() {
                var button = $(this);
                var cart = $('#cart');
                var cartTotal = cart.attr('data-totalitems');
                var newCartTotal = parseInt(cartTotal) + 1;

                button.addClass('sendtocart');
                setTimeout(function() {
                    button.removeClass('sendtocart');
                    cart.addClass('shake').attr('data-totalitems', newCartTotal);
                    setTimeout(function() {
                        cart.removeClass('shake');
                    }, 500);
                }, 1000);
            });
        });
    </script>
@endsection
