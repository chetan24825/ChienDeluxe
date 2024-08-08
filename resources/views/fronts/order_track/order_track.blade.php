@extends('fronts.layouts.app')
@if (customUrl(request()->path()))
    @section('meta_title'){{ customUrl(request()->path())->meta_title }}@stop
    @section('meta_description'){{ customUrl(request()->path())->meta_description }}@stop
    @section('meta_keywords'){{ customUrl(request()->path())->meta_keywords }}@stop
@endif
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Order Track</a></li>
                </ul>
            </div>
        </div>
    </div>


    <style>
        .timeline {
            margin: 0 0 45px;
            padding: 0;
            position: relative;
        }

        .timeline>div {
            margin-bottom: 15px;
            margin-right: 10px;
            position: relative;
        }

        .timeline>div>.fa,
        .timeline>div>.fab,
        .timeline>div>.fad,
        .timeline>div>.fal,
        .timeline>div>.far,
        .timeline>div>.fas,
        .timeline>div>.ion,
        .timeline>div>.svg-inline--fa {
            background-color: #adb5bd;
            border-radius: 50%;
            font-size: 16px;
            height: 30px;
            left: 18px;
            line-height: 30px;
            position: absolute;
            text-align: center;
            top: 0;
            width: 30px;
        }

        .timeline>div>.timeline-item {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            border-radius: .25rem;
            background-color: #fff;
            color: #495057;
            margin-left: 60px;
            margin-right: 15px;
            margin-top: 0;
            padding: 0;
            position: relative;
        }



        .timeline>div>.timeline-item>.time {
            color: #999;
            float: right;
            font-size: 12px;
            padding: 10px;
        }

        .timeline>div>.timeline-item>.timeline-header {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            color: #495057;
            font-size: 16px;
            line-height: 1.1;
            margin: 0;
            padding: 10px;
        }

        .timeline>.time-label>span {
            border-radius: 4px;
            background-color: #fff;
            display: inline-block;
            font-weight: 600;
            padding: 5px;
        }

        .bg-yellow {
            background-color: #ffc107 !important;
        }

        .bg-blue {
            background-color: #007bff !important;
        }

        .bg-green {
            background-color: #28a745 !important;
        }

        .bg-red {
            background-color: #dc3545 !important;
        }

        .timeline>div>.timeline-item>.timeline-footer>a {
            color: #fff;
        }

        .btn-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }

        .bg-blue,
        .bg-blue>a {
            color: #fff !important;
        }

        .bg-green,
        .bg-green>a {
            color: #fff !important;
        }

        .bg-yellow,
        .bg-yellow>a {
            color: #1f2d3d !important;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-purple,
        .bg-purple>a {
            color: #fff !important;
        }

        element.style {}

        .timeline {
            margin: 0 0 45px;
            padding: 0;
            position: relative;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        user agent stylesheet div {
            display: block;
        }

        body {
            margin: 0;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .timeline::before {
            border-radius: .25rem;
            background-color: #dee2e6;
            bottom: 0;
            content: "";
            left: 31px;
            margin: 0;
            position: absolute;
            top: 0;
            width: 4px;
        }
    </style>

    <div class="products wow fadeInUp animated">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="{{ route('order.track') }}">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" name="order_id"
                                value="<?php echo isset($order->order_id) ? $order->order_id : old('order_id'); ?>" placeholder="Enter Order Id">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default bg-secondary">
                                    <i class="las la-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <hr>
                    @if (isset($order))
                        <div class="timeline">

                            @if ($order->status == 0)
                                <div class="time-label">
                                    <span class="bg-yellow">{{ date('jS F Y', strtotime($order->created_at)) }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">Support Team </a>Sent you an email
                                        </h3>
                                    </div>
                                </div>
                            @endif

                            @if ($order->status == 3)
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">Support Team </a>Sent you an email
                                        </h3>
                                    </div>
                                </div>

                                <div>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }}</a> Your
                                            Order
                                            Is
                                            Confirmed</h3>
                                        <div class="timeline-body">

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($order->status == 4)
                                <div class="time-label">
                                    <span class="bg-yellow">{{ date('jS F Y', strtotime($order->created_at)) }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">Support Team </a>Sent you an email
                                        </h3>
                                    </div>
                                </div>

                                <div>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }}</a> Your
                                            Order
                                            Is
                                            Confirmed</h3>
                                        <div class="timeline-body">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-clock bg-maroon"></i>

                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }} </a>Your
                                            Order
                                            Is
                                            On Delivery</h3>
                                    </div>
                                </div>
                            @endif

                            @if ($order->status == 1)
                                <div class="time-label">
                                    <span class="bg-yellow">{{ date('jS F Y', strtotime($order->created_at)) }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Support Team </a>Sent you an email
                                        </h3>
                                    </div>
                                </div>

                                <div>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }}</a> Your
                                            Order
                                            Is
                                            Confirmed</h3>
                                        <div class="timeline-body">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-clock bg-maroon"></i>

                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }} </a>Your
                                            Order
                                            Is
                                            On Delivery</h3>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-boxes-packing bg-green"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">{{ $order->user_name }} </a>Your
                                            Order
                                            Is Now
                                            Delivery</h3>

                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            @endif

                        </div>
                    @endif

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>



    <div class="empty-space"></div>
    
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
            "name": "Order Track",
            "item": "{{ url()->current()}}"
          }

          ]
        }
        </script>
       @stop
@endsection
