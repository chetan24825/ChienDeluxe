@extends('fronts.layouts.app')
@section('meta_title') {{ $page->meta_title }} @stop
@section('meta_keywords') {{ $page->meta_keyword }} @stop
@section('meta_description') {{ $page->meta_description }} @stop
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ route('webpage') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">{{ $page->page_name }}</a></li>

                </ul>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="title-bar">
                    <h1>{{ $page->page_name }}</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {!! $page->description !!}
            </div>
        </div>

    </div>


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
            "name": "{{$page->page_name}}",
            "item": "{{ url()->current()}}"
          }

          ]
        }
        </script>
@stop

@endsection
