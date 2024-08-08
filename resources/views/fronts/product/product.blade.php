@extends('fronts.layouts.app')
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Products</a></li>
                </ul>
            </div>
        </div>
    </div>

    @livewire('product-model', ['product' => $searchProduct ?? ''])




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
      "name": "Products",
      "item": "{{ url()->current()}}"
    }

    ]
  }
  </script>
@stop
