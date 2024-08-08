@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Header</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Header</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <form action="{{ route('admin.header') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputDescription">Company Name</label>
                                            <input type="text" name="latest_news" class="form-control" value="{{ get_setting('latest_news') }}">
                                            @error('latest_news')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Company Email</label>
                                            <input type="text" id="inputName" class="form-control" name="comany_email"
                                                value="{{ get_setting('comany_email') }}" required>
                                            @error('comany_email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputEstimatedDuration">Company Phone</label>
                                            <input type="text" id="inputEstimatedDuration" class="form-control"
                                                value="{{ get_setting('comany_phone') }}" name="comany_phone"
                                                step="0.1">
                                            @error('comany_phone')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputDescription">Company Address</label>
                                            <textarea class="form-control" name="comany_address" rows="4" required>{{ get_setting('comany_address') }}</textarea>
                                            @error('comany_address')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="signinSrEmail">Logo</label>

                                            <div class="input-group" data-toggle="aizuploader" data-type="image"
                                                data-multiple="false">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        Browse
                                                    </div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="web_logo" value="{{ get_setting('web_logo') }}"
                                                    class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">

                                            </div>
                                            <small class="text-muted">
                                                Use 300x300 sizes images.</small>
                                            <br>
                                            @error('web_logo')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputName">Meta Title</label>
                                            <input type="text" id="inputName" name="meta_title"
                                                value="{{ get_setting('meta_title') }}" class="form-control">
                                            @error('meta_title')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputName">Meta Keywords</label>
                                            <input type="text" id="inputName" name="meta_keywords"
                                                value="{{ get_setting('meta_keywords') }}" class="form-control">
                                            @error('meta_keywords')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputDescription">Description</label>
                                            <textarea id="inputDescription" name="meta_description" class="form-control" rows="4">{{ get_setting('meta_description') }}</textarea>
                                            @error('meta_description')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </section>

    </div>
@endsection

@section('admin-style')
    <link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('aizfiles/vendors.js') }}"></script>
    <link href="{{ asset('aizfiles/aiz-core.css') }}" rel="stylesheet">
@endsection
