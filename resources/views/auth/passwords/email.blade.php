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
                    <li><a wire:navigate href="{{ route('webpage') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Reset Password</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="Contact-box-form sign-up-box">
                        <div class="sec-title text-left" style="margin-bottom:20px;">
                            <h2>Reset Password</h2>

                        </div>
                        <div class="form-inner">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
