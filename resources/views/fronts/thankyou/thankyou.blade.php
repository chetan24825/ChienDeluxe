@extends('fronts.layouts.app')
@section('content')
    <div class="banner-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <div class="banner-txt text-center thank-text">

                        <i class="las la-check thanx"></i>
                        <h1>
                            THANKS FOR YOUR ORDER<br>
                            <span>Your Order No. {{ $order->order_id }} is in the progress.</span><br>

                        </h1>


                        {{-- payment_status --}}
                        @if ($order->payment_status != 'SUCCESS')
                            <h1>
                                Your Payment Failed
                            </h1>
                            <a href="{{ route('home') }}" class="btn btn-info back-btn cont-btn">PayNow</a>
                        @endif


                        @if ($order->payment_status == 'SUCCESS' && auth()->check())
                            <div class="call">
                                <strong>For any queries feel free to contact us at: </strong><br>

                                <a href="tel:{{ explode(',', get_setting('comany_phone'))[0] }}" class="thnx-cont"><i
                                        class="las la-phone"></i> {{ explode(',', get_setting('comany_phone'))[0] }}</a>
                            </div>
                            <a href="{{ route('webpage') }}" class="btn btn-info back-btn cont-btn">Continue Shopping</a>

                            <a href="{{ route('home') }}" class="btn btn-info back-btn">Back to Dashboard</a>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
