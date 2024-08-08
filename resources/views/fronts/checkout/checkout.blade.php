@extends('fronts.layouts.app')
@section('content')
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Checkout</a></li>

                </ul>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="cart-left">
                    <h4>Checkout Details</h4>

                    <div class="billing-box">
                        <form method="post" action="{{ route('checkout.view') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="" name="username" value="<?php echo isset($user) ? $user['name'] : $userdetail['name'] ?? old('username'); ?>"
                                            required />
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" placeholder="" name="email" value="<?php echo isset($user) ? $user['email'] : $userdetail['email'] ?? old('email'); ?>"
                                            required />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="number" placeholder="" name="mobile" value="<?php echo isset($user['mobile']) ? $user['mobile'] : (isset($userdetail['mobile']) ? $userdetail['mobile'] : old('mobile')); ?>"
                                            required>
                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input type="text" placeholder="" value="<?php echo isset($user) ? $user['street_address'] : $userdetail['street_address'] ?? old('street_address'); ?>"
                                            name="street_address" />
                                        @error('street_address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Country</label>

                                        <select class="@error('type') is-invalid @enderror" data-live-search="true"
                                            name="country" value="{{ old('country') }}" required>
                                            @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                                <option {{ 'India' == $country->name ? 'selected' : '' }}
                                                    value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" placeholder="" value="<?php echo isset($user) ? $user['state'] : $userdetail['state'] ?? old('state'); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Town/City</label>
                                        <input type="text" placeholder="Town/City" name="city"
                                            value="<?php echo isset($user) ? $user['city'] : $userdetail['city'] ?? old('city'); ?>">
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" placeholder="" name="post_code" value="<?php echo isset($user) ? $user['post_code'] : $userdetail['post_code'] ?? old('post_code'); ?>"
                                            required>
                                        @error('post_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Additional Message</label>
                                        <textarea></textarea>
                                    </div>
                                </div>

                            </div>

                           
                            <div class="row ">

                               
                                <div class="col-md-12">
                                    <p><input type="checkbox" style="width: 3%" name="check" checked> I agree to the
                                        @foreach (App\Models\CustomPage::where('status', 1)->Where('viewby', '<>', 1)->Where('viewby', '<>', 3)->where('slug', 'terms-condition')->get() as $page)
                                            <a wire:navigate class="text-primary"
                                                href="{{ $page->link ?? route('custom.page', $page->slug) }}">{{ $page->page_name }}</a>
                                        @endforeach
                                        Return Policy
                                        &amp; Privacy Policy
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button>Continue to payment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @livewire('checkout-order')
        </div>
    </div>


    {{-- <div class="checkout-page">
        <div class="container-fluid">
            <div class="billing-info">
                <form method="post" action="{{ route('checkout.view') }}">
                    @csrf
                    <div class="row">
                        @if (session('userdetail'))
                            @php
                                $userdetail = session('userdetail');
                            @endphp
                        @endif
                        <div class="col-md-7">
                            <h3>Billing Details</h3>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Name" name="username" value="<?php echo isset($user) ? $user['name'] : $userdetail['name'] ?? old('username'); ?>"
                                        required>
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Email" name="email" value="<?php echo isset($user) ? $user['email'] : $userdetail['email'] ?? old('email'); ?>"
                                        required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="number" placeholder="Phone Number" name="mobile"
                                        value="<?php echo isset($user['mobile']) ? $user['mobile'] : (isset($userdetail['mobile']) ? $userdetail['mobile'] : old('mobile')); ?>" required>
                                    @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <select class="@error('type') is-invalid @enderror" data-live-search="true"
                                        name="country" value="{{ old('country') }}" required>
                                        @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                            <option {{ 'India' == $country->name ? 'selected' : '' }}
                                                value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    @php
                                        $state_detail = isset($userdetail['state'])
                                            ? $userdetail['state']
                                            : (isset($user['state'])
                                                ? $user['state']
                                                : '');
                                    @endphp
                                    <select class="@error('state') is-invalid @enderror" data-live-search="true"
                                        data-placeholder="Select your country" name="state" required>
                                        @foreach (\App\Models\State::where('country_id', 99)->get() as $key => $state)
                                            <option value="{{ $state->name }}"
                                                {{ $state_detail == $state->name || (!$state_detail == $state->name && $state->name == 'Punjab') ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                        <div class="error">{{ $errors->first('state') }}</div>
                                    @endif
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Town/City" name="city"
                                        value="<?php echo isset($user) ? $user['city'] : $userdetail['city'] ?? old('city'); ?>">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <textarea placeholder="Address" name="street_address"><?php echo isset($user) ? $user['street_address'] : $userdetail['street_address'] ?? old('street_address'); ?></textarea>
                                    @error('street_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Postal Code" name="post_code"
                                        value="<?php echo isset($user) ? $user['post_code'] : $userdetail['post_code'] ?? old('post_code'); ?>" required>
                                    @error('post_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @auth
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <p> <input type="checkbox" name="same_as_shipping" class="single-checkbox"
                                                        value="same_as_shipping" style="width: 30px" checked> Same As Billing
                                                    Address By Default </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="card">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">Add New Shipping Address</button>
                                        </div>
                                    </div>



                                    @forelse (\App\Models\ShippingAddress::where('user_id', auth()->user()->id)->get() as $ShippingAddress)
                                        <div class="col-sm-8 mt-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between"> <input
                                                            type="checkbox" class="single-checkbox" name="same_as_shipping"
                                                            value="{{ $ShippingAddress->id }}" style="width: 30px">
                                                        {{ $ShippingAddress->user_name }}


                                                        <div class="d-inline">
                                                            <i onclick="confirmDelete(event)" class="las la-trash"
                                                                data-id="{{ $ShippingAddress->id }}"></i>

                                                            <i class="las la-edit" data-toggle="modal"
                                                                data-target="#exampleModal{{ $ShippingAddress->id }}"></i>
                                                        </div>
                                                    </h5>

                                                    <p class="card-text">
                                                        <!--{{ $ShippingAddress->phone }},-->
                                                        <!--{{ $ShippingAddress->country }},-->
                                                        <!--{{ $ShippingAddress->state }},-->
                                                        <!--{{ $ShippingAddress->city }},-->
                                                        {{ $ShippingAddress->address }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                            @endauth

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p class="agree-box"><input type="checkbox" name="check" checked> I agree to the
                                        @foreach (App\Models\CustomPage::where('status', 1)->Where('viewby', '<>', 1)->Where('viewby', '<>', 3)->where('slug', 'terms-condition')->get() as $page)
                                            <a wire:navigate class="text-primary"
                                                href="{{ $page->link ?? route('custom.page', $page->slug) }}">{{ $page->page_name }}</a>
                                        @endforeach
                                        Return Policy
                                        &amp; Privacy Policy
                                    </p>
                                </div>
                            </div>
                        </div>

                        @livewire('checkout-order')
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Shipping Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('toShippingAddress') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Full Name" name="user_name" class="form-control"
                                        value="" required>
                                    @error('user_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" placeholder="Phone Number" name="mobile" class="form-control"
                                        value="" required>
                                    @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control @error('type') is-invalid @enderror"
                                        data-live-search="true" name="country" value="{{ old('country') }}" required>
                                        @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                            <option {{ 'India' == $country->name ? 'selected' : '' }}
                                                value="{{ $country->name }}">
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class=" form-control @error('state') is-invalid @enderror "
                                        data-live-search="true" data-placeholder="Select your country" name="state"
                                        required>
                                        @foreach (\App\Models\State::where('country_id', 99)->get() as $key => $state)
                                            <option value="{{ $state->name }}"
                                                {{ 'Punjab' == $state->name ? 'selected' : '' }}>
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                        <div class="error">{{ $errors->first('state') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Town/City" name="city" class="form-control"
                                        value="" required>
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea placeholder="Address" name="street_address" class="form-control" required></textarea>
                                    @error('street_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Postal Code" class="form-control"
                                        name="post_code" required>
                                    @error('post_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    @auth
        @foreach (\App\Models\ShippingAddress::where('user_id', auth()->user()->id)->get() as $ShippingAddress)
            <div class="modal fade" id="exampleModal{{ $ShippingAddress->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Edit Shipping Address </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('toShippingAddressupdate') }}" method="POST">
                            @csrf
                            <div class="modal-body">

                                <input type="hidden" value="{{ $ShippingAddress->id }}" name="shipping_id">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="User Name" class="form-control"
                                                name="user_name" value="{{ $ShippingAddress->user_name }}" required>
                                            @error('user_name')
                                                <div class="text-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Phone Number"
                                                name="mobile" value="{{ $ShippingAddress->phone }}" required>
                                            @error('mobile')
                                                <div class="text-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <select class="form-control @error('country') is-invalid @enderror"
                                                data-live-search="true" name="country" required>
                                                @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ $country->name == $ShippingAddress->country ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class=" form-control @error('state') is-invalid @enderror "
                                                data-live-search="true" data-placeholder="Select your country" name="state"
                                                required>
                                                @foreach (\App\Models\State::where('country_id', 99)->get() as $key => $state)
                                                    <option value="{{ $state->name }}"
                                                        {{ $state->name == $ShippingAddress->state ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('state'))
                                                <div class="error">
                                                    {{ $errors->first('state') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Town/City" class="form-control"
                                                name="city" value="{{ $ShippingAddress->city }}" required>
                                            @error('city')
                                                <div class="text-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea placeholder="Address" class="form-control" name="street_address" required>{{ $ShippingAddress->address }}</textarea>
                                            @error('street_address')
                                                <div class="text-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Postal Code" class="form-control"
                                                value="{{ $ShippingAddress->pincode }}" name="post_code" required>
                                            @error('post_code')
                                                <div class="text-danger">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endauth --}}


    <div class="modal fade" style="top: 122px;" id="popupForm" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Login In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="alert alert-warning text-center" role="alert">
                    User Already Exist Please Login First
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('popuplogin') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="userdetail"
                                value="{{ isset($userdetail) ? json_encode($userdetail) : '' }}">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email/Username" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <button type="submit" class="chekout-btn-chetan">Login </button>
                            </div>
                        </div>
                    </form>

                    <p class="text-center crete-line"> <a href='{{ route('password.request') }}'>Reset Password</a> </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Warning Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The Order Must Be Minimum Amount of {{ get_setting('symbol') }}500
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
       

        function confirmDelete(event) {
            var confirmation = confirm('Do You Want To Delete ?');
            if (confirmation) {
                var id = event.target.dataset.id;
                var token = "{{ csrf_token() }}";
                console.log(id);

                $.ajax({
                    type: "POST",
                    url: "{{ route('shipping.delete') }}",
                    data: {
                        'id': id,
                        '_token': token
                    },
                    success: function(data) {
                        if (data) {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>

    <script>
        $(document).ready(function() {


            $('.single-checkbox').click(function() {
                if ($(this).prop("checked") == true) {
                    $('.single-checkbox').not(this).prop('disabled', true);
                } else {
                    $('.single-checkbox').prop('disabled', false);
                }
            });
        });

        $(document).ready(function() {
            $(document).on('keyup', '#coupon_code', function() {
                var coupen_code = $('#coupon_code').val();
                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    url: "{{ route('get.coupon.code') }}",
                    data: {
                        'coupen_code': coupen_code,
                        '_token': token
                    },
                    success: function(data) {
                        $("#ref").html(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.selectpack').on('change', function() {
                var productId = $(this).data('product-id');
                var newQuantity = $(this).val();
                var token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    url: "{{ route('add.cart.onchange') }}",
                    data: {
                        'id': productId,
                        'newQuantity': newQuantity,
                        '_token': token
                    },
                    success: function(data) {
                        if (data) {
                            location.reload();
                        }
                    }
                });
            });
        });

        function deleteCart(productId) {
            var token = "{{ csrf_token() }}";
            axios.post("{{ route('add.cart.delete') }}", {
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


        $(document).on('change', '[name=country]', function() {
            $(this).find("option:selected").each(function() {
                var country = $(this).val();
                get_state(country);
            });
        }).change();


        $(document).on('change', '[name=state]', function() {
            var country = $('select[name="country"]').val();
            var state = $('select[name="state"]').val();
            get_city(country, state);
        }).change();




        function get_state(country) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-state') }}",
                type: 'POST',
                data: {
                    country_name: country
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="state"]').html(obj);
                        // AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(country, state) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-city') }}",
                type: 'POST',
                data: {
                    country_name: country,
                    state_name: state,
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="city"]').html(obj);
                        // AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    </script>

    <script>
        function toggleCheckbox1(checkboxId) {
            $('#' + checkboxId).closest('ul').find('input[type="checkbox"]').each(function() {
                if (this.id !== checkboxId) {
                    $(this).prop('checked', false);
                }
            });
        }

        function toggleCheckbox(checkboxId) {
            $('#' + checkboxId).closest('ul').find('input[type="checkbox"]').each(function() {
                if (this.id !== checkboxId) {
                    $(this).prop('checked', false);
                }
            });

            var isChecked = $('#' + checkboxId).prop('checked');

            if (isChecked) {
                var selectedValue = $('#' + checkboxId).val();
                if (selectedValue == 1) {
                    $('.shipping_charge').show();
                    $('.totalNetAmount').hide();
                    $('.totalNetAmountshipping').show();
                    console.log("Selected Value Delivered:", selectedValue);
                } else {
                    $('.shipping_charge').hide();
                    $('.totalNetAmount').show();
                    $('.totalNetAmountshipping').hide();
                    console.log("Selected Value Itself:", selectedValue);
                }
            } else {
                var itselfChecked = $('#it_self').prop('checked');
                if (!itselfChecked) {
                    $('#delivered').prop('checked', true);
                    toggleCheckbox('delivered');
                }
            }
        }

        toggleCheckbox('delivered');
    </script>

    <script>
        $(document).ready(function() {

            @if (Session::has('message'))
                $('#popupForm').modal('show');
            @endif

            @if (Session::has('message_warning'))
                $('#warning').modal('show');
            @endif

        });
    </script>
@endsection
