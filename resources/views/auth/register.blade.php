@extends('fronts.layouts.app')
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ route('webpage') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>



    <div class="contact-page bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="Contact-box-form sign-up-box">
                        <div class="sec-title text-left" style="margin-bottom:20px;">
                            <h2>Create An Account</h2>
                        </div>
                        @livewire('register-page')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
