@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.users.edit', $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        @if ($user->profile_image)
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ uploaded_asset($user->profile_image) }}" alt="User profile picture">
                                        @else
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('backend/dist/img/user.png') }}" alt="User profile picture">
                                        @endif

                                    </div>

                                    <h3 class="profile-username text-center">{{ $user->name }}
                                        <p class="text-muted text-center">{{ $user->email }}</p>
                                    </h3>


                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>UserId: </b> <a class="float-right">{{ $user->user_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Sponsor Name: </b> <a class="float-right">
                                                @if (isset($sponser->name))
                                                    {{ ucwords($sponser->name) }}
                                                @else
                                                    Admin
                                                @endif
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Balance </b> <a class="float-right">Rs.{{ $user->balance }}/-</a>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity"
                                                data-toggle="tab">User
                                                Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Bank
                                                Detail</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" href="#changepassword"
                                                data-toggle="tab">Change
                                                Password</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" href="#admin_access" data-toggle="tab">
                                                Admin Changes</a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-sm-3 col-form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $user->name }}" placeholder="Name">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-sm-2 col-form-label">Email</label>

                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $user->email }}" placeholder="Email">
                                                </div>


                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">State</label>
                                                    <input type="text" class="form-control" name="state"
                                                        value="{{ $user->state }}" placeholder="State">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        value="{{ $user->city }}" placeholder="City">
                                                </div>

                                                <div class="col-sm-12">
                                                    <label class="col-sm-6 col-form-label">Zipcode</label>
                                                    <input type="text" class="form-control" name="post_code"
                                                        value="{{ $user->post_code }}" placeholder="PinCode">
                                                </div>

                                                <div class="col-sm-6 mt-2">
                                                    <div class="form-group">
                                                        <label for="signinSrEmail">User Profile</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image"
                                                            data-multiple="false">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    Browse
                                                                </div>
                                                            </div>
                                                            <div class="form-control file-amount">Choose File</div>
                                                            <input type="hidden" name="profile_image"
                                                                value="{{ $user->profile_image }}"
                                                                class="selected-files">
                                                        </div>
                                                        <div class="file-preview box sm">

                                                        </div>
                                                        <small class="text-muted">
                                                            Use 300x300 sizes images.</small>
                                                        <br>
                                                        @error('profile_image')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ ucwords($message) }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="inputExperience"
                                                        class="col-sm-6 col-form-label">Address</label>
                                                    <textarea class="form-control" id="inputExperience" rows="5" cols="4" name="street_address"
                                                        placeholder="Address">{{ $user->street_address }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="timeline">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">Bank
                                                        Name</label>
                                                    <input type="text" class="form-control" name="bank_name"
                                                        value="{{ $user->bank_name }}" placeholder="Bank Name">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">Holder
                                                        Name</label>
                                                    <input type="text" class="form-control" name="account_name"
                                                        value="{{ $user->account_name }}" placeholder="Holder Name">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">Bank A/c
                                                        No</label>

                                                    <input type="text" class="form-control"
                                                        value="{{ $user->account_number }}" name="account_number"
                                                        placeholder="Account Number">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label class="col-sm-6 col-form-label">IFSC
                                                        Code</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->ifsc_code }}" placeholder="IFSC"
                                                        name="ifsc_code">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="changepassword">
                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <label class="col-form-label">New Passwprd</label>
                                                    <input type="password" class="form-control" name="password"
                                                        value="" placeholder="Password">
                                                </div>

                                                <div class="col-sm-12">
                                                    <label class=" col-form-label">Confirm
                                                        Password</label>

                                                    <input type="password" class="form-control" name="confirmpassword"
                                                        value="" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="admin_access">
                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <label class=" col-form-label">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1"{{ $user->status == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"{{ $user->status == 0 ? 'selected' : '' }}>
                                                            Ban</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection
@section('admin-style')
    {{-- POP UP MEDIA LIBRARY --}}
    <link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('aizfiles/vendors.js') }}"></script>
    <link href="{{ asset('aizfiles/aiz-core.css') }}" rel="stylesheet">
@endsection
