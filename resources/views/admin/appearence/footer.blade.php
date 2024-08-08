@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Footer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Footer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">
            <form action="{{route('admin.footer')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General Appearence</h3>
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
                                            <label for="inputName">Facebook Link</label>
                                            <input type="text" id="inputName" class="form-control" name="facebook_link"
                                                value="{{ get_setting('facebook_link') }}" >
                                            @error('facebook_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Instagram Link</label>
                                            <input type="text" id="inputName" class="form-control" name="instagram_link"
                                                value="{{ get_setting('instagram_link') }}" >
                                            @error('instagram_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputName">Twitter Link</label>
                                            <input type="text" id="inputName" class="form-control" name="twitter_link"
                                                value="{{ get_setting('twitter_link') }}" >
                                            @error('twitter_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for="inputName">Linkedin Link</label>
                                            <input type="text" id="inputName" class="form-control" name="linkedin_link"
                                                value="{{ get_setting('linkedin_link') }}" >
                                            @error('linkedin_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputName">YouTube Link</label>
                                            <input type="text" id="inputName" class="form-control" name="youtube_link"
                                                value="{{ get_setting('youtube_link') }}" >
                                            @error('youtube_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="inputName">Iframe YouTube Link</label>
                                            <input type="text" id="inputName" class="form-control" name="iframe_link"
                                                value="{{ get_setting('iframe_link') }}" >
                                            @error('iframe_link')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputDescription">About Description</label>
                                            <textarea id="inputDescription" class="form-control" name="about_description" rows="4" >{{ get_setting('about_description') }}</textarea>
                                            @error('about_description')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="inputDescription">Copy Right</label>
                                            <textarea id="summernote" class="form-control" name="copy_right" rows="4" >{!! get_setting('copy_right') !!}</textarea>
                                            @error('copy_right')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
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
        <!-- /.content -->
    </div>
@endsection

@section('admin-style')
    {{-- POP UP MEDIA LIBRARY --}}
    <link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('aizfiles/vendors.js') }}"></script>
    <link href="{{ asset('aizfiles/aiz-core.css') }}" rel="stylesheet">
@endsection

