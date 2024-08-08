@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Page Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Page Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>



        <!-- Main content -->
        <section class="content">
            <form action="{{ route('admin.pages.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
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


                                <div class="form-group">
                                    <label for="inputName">Page Name <span class="text-danger">*</span></label>
                                    <input type="text" id="inputName" class="form-control" name="page_name"
                                        value="{{ old('page_name') }}" required>
                                    @error('page_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="signinSrEmail">Select The Main Image </label>

                                    <div class="input-group" data-toggle="aizuploader" data-type="image"
                                        data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                Browse
                                            </div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input type="hidden" name="image" value="{{ old('image') }}"
                                            class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">

                                    </div>
                                    <small class="text-muted">
                                        Use 600x600 sizes images.</small>
                                    <br>
                                    @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label for="inputDescription">Short Description</label>
                                    <textarea class="form-control" name="short_description" rows="4">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputDescription">Description <span class="text-danger">*</span></label>
                                    <textarea id="ckeditor" class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" name="status" class="form-control custom-select" required>
                                        <option value="">Select</option>
                                        <option value="1" selected>Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Visible In </label>
                                    <select id="inputStatus" name="viewby" class="form-control custom-select" required>
                                        <option value="1">Header</option>
                                        <option value="0" selected>Footer</option>
                                        <option value="2">Both</option>
                                        <option value="3">None</option>


                                    </select>
                                    @error('viewby')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Sort </label>
                                    <input type="text" id="inputEstimatedDuration" class="form-control"
                                        value="{{ old('sort')??100 }}" name="sort" step="0.1">
                                    @error('sort')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Link </label>
                                    <input type="text" id="inputEstimatedDuration" class="form-control"
                                        value="{{ old('link') }}" name="link" step="0.1">
                                    @error('link')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Seo Section</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="inputName"> Meta Title</label>
                                    <input type="text" id="inputName" name="meta_title"
                                        value="{{ old('meta_title') }}" class="form-control">
                                    @error('meta_title')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName"> Meta Keywords</label>
                                    <input type="text" id="inputName" name="meta_keyword"
                                        value="{{ old('meta_keyword') }}" class="form-control">
                                    @error('meta_keyword')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription"> Meta Description</label>
                                    <textarea id="inputDescription" name="meta_description" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
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

@section('admin-script')
    <script src=" {{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('ckeditor');
            CKEDITOR.config.height = 300;
        });
    </script>
@endsection
