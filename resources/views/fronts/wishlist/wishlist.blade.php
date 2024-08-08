@extends('fronts.layouts.app')
@section('content')

    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Wishlist</a></li>
                </ul>
            </div>
        </div>
    </div>

    @livewire('component-wishlist')

@endsection
@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "BreadcrumbList",
          "itemListElement": [

          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{url('/')}}"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "Wishlist",
            "item": "{{ url()->current()}}"
          }

          ]
        }
        </script>
@stop
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
        function deletewishlistCart(productId) {
            var token = "{{ csrf_token() }}";
            axios.post("{{ route('delete.wishlist') }}", {
                    id: productId,
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
