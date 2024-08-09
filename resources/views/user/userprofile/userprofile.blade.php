@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('user.profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        @if (Auth::user()->profile_image)
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ uploaded_asset(Auth::user()->profile_image) }}" alt="User profile picture">
                                        @else
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('backend/dist/img/user.png') }}" alt="User profile picture">
                                        @endif

                                    </div>

                                    <h3 class="profile-username text-center">{{ Auth::user()->name }}
                                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                                    </h3>

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
                                        
                                        
                                        <li class="nav-item"><a class="nav-link" href="#changepassword"
                                                data-toggle="tab">Change
                                                Password</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label  class="col-form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ Auth::user()->name }}" placeholder="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label  class="col-form-label">Email</label>

                                                    <input type="email" class="form-control" name="email"
                                                         value="{{ Auth::user()->email }}"
                                                        placeholder="">
                                                </div>


                                                <div class="col-sm-6">
                                                    <label  class="col-form-label">State</label>
                                                    <select class=" form-control @error('state') is-invalid @enderror "
                                                        data-live-search="true" data-placeholder="Select your country"
                                                        name="state" >
                                                        @foreach (\App\Models\State::where('country_id', 99)->get() as $key => $state)
                                                            <option value="{{ $state->name }}"
                                                                {{ $state->name == Auth::user()->state ? 'selected' : '' }}>
                                                                {{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label  class="col-form-label">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        value="{{ Auth::user()->city }}" placeholder="">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label  class="col-form-label">Zipcode</label>
                                                    <input type="text" class="form-control" name="post_code"
                                                        value="{{ Auth::user()->post_code }}" placeholder="">
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Phone</label>
                                                    <input type="text" class="form-control" name="mobile"
                                                        value="{{ Auth::user()->mobile }}" placeholder="">
                                                </div>

                                                <div class="col-sm-6 mt-2">
                                                    <div class="form-group">
                                                        <label for="signinSrEmail">User Profile</label>
                                                        <div class="input-group" data-toggle="aizuploader"
                                                            data-type="image" data-multiple="false">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    Browse
                                                                </div>
                                                            </div>
                                                            <div class="form-control file-amount">Choose File</div>
                                                            <input type="hidden" name="profile_image"
                                                                value="{{ Auth::user()->profile_image }}"
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
                                                        class="col-form-label">Address</label>
                                                    <textarea class="form-control" id="inputExperience" rows="5" cols="4" name="street_address"
                                                        placeholder="">{{ Auth::user()->street_address }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                       


                                      

                                        <div class="tab-pane" id="changepassword">
                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <label  class="col-form-label">New Passwprd</label>
                                                    <input type="password" class="form-control" name="password"
                                                         value="" placeholder="">
                                                </div>

                                                <div class="col-sm-12">
                                                    <label  class=" col-form-label">Confirm
                                                        Password</label>

                                                    <input type="password" class="form-control" name="confirmpassword"
                                                         value="" placeholder="">
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
