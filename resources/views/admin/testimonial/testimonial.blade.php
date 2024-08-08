@extends('admin.layouts.main')
@section('content')
    <div class="col-lg-9 col-md-8 mainpage" id="profile-description">
        @include('admin.admintopbar.topbar')

        <div class="jobs_manage">
            <div class="row">

                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <hr>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="manage_bidders">
                            <div class="view_chart">
                                <div class="view_chart_header">
                                    <h4>Create Testimonial</h4>
                                </div>
                                <div class="post_job_body mt-0" style="border-bottom: 1px solid #EBEDF3;">
                                    @if (session()->get('success'))
                                        <span class="alert alert-success cus">
                                            {{ session()->get('success') }}
                                        </span>
                                    @endif
                                    <form action="{{ route('admin.appearence.testimonial.create') }}" id="basic-form"
                                        class="comment-form dark-fields" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group ">
                                                    <label class="label15">User Name<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="job-input" name="user_name"
                                                        value="{{ old('user_name') }}">
                                                    @error('user_name')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group ">
                                                    <label class="label15">Select Rating <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="rating" class="job-input">
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                    @error('rating')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="form-group ">
                                                    <label for="signinSrEmail">Select The Image </label>

                                                    <div class="input-group" data-toggle="aizuploader" data-type="image"
                                                        data-multiple="false">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                Browse
                                                            </div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="photos" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">

                                                    </div>
                                                    <small class="text-muted">
                                                        Use 600x600 sizes images.</small>
                                                    @error('photos')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>

                                                <div class="form-group ">
                                                    <label class="label15">Content <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea id="ckeditor" name="content" required>{{ old('content') }}</textarea>
                                                    @error('content')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn-link-dark dash-btn main_lg_btn" type="Submit"
                                                id="change-btn">SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="manage_bidders">
                            <div class="view_chart p-5">
                                <a href="{{ route('admin.appearence.testimonial.list') }}" class="main_lg_btn mr-5"><i
                                        class="las la-power-off"></i>
                                    List Of Testimonial</a>
                            </div>


                            <div class="view_chart">
                                <div class="view_chart_header">
                                    <h4>Testimonial</h4>
                                </div>
                                <div class="post_job_body mt-0" style="border-bottom: 1px solid #EBEDF3;">
                                    @if (session()->get('successmain'))
                                        <span class="alert alert-success cus">
                                            {{ session()->get('successmain') }}
                                        </span>
                                    @endif
                                    <form action="{{ route('admin.appearence.testimonial') }}" id="basic-form"
                                        class="comment-form dark-fields" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group ">
                                                    <label class="label15">Main Title
                                                    </label>

                                                    <textarea name="main_title_testimonial" cols="30" class="form-control" rows="3">{{ get_setting('main_title_testimonial') }}</textarea>

                                                    @error('main_title_testimonial')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group ">
                                                    <label class="label15">Sub Title
                                                    </label>
                                                    <textarea name="sub_title_testimonial" cols="30" class="form-control" rows="3">{{ get_setting('sub_title_testimonial') }}</textarea>

                                                    @error('sub_title_testimonial')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn-link-dark dash-btn main_lg_btn" type="Submit"
                                                id="change-btn">SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/editors.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('form').click(function() {
                id = '#' + $(this).attr('id');
                $(id).parsley();
            })
        });
    </script>
    <script src="{{ asset('/js/parsley.min.js') }}"></script>
@endsection
@section('style')
    {{-- POP UP MEDIA LIBRARY --}}
    <link href="{{ url('/') }}/css/vendor.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/aiz-core.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/css/parsley.css') }}">
@endsection
