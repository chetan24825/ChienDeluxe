@extends('fronts.layouts.app')
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>

    @livewire('carts')

   @include('fronts.inc.subscribe')

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
            "name": "Cart",
            "item": "{{ url()->current()}}"
          }

          ]
        }
        </script>
@stop



@endsection

@section('style')
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"] {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection
