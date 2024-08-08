@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Blogs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add New Blogs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">
            <form action="{{ route('admin.article.add') }}" method="POST" enctype="multipart/form-data">
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

                                <div class="form-group">
                                    <label for="inputStatus">Category</label>
                                    <select id="inputStatus" name="category_id" class="form-control custom-select" required>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Blogs Title</label>
                                    <input type="text" id="inputName" class="form-control" name="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
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
                                    <label for="inputDescription">Description</label>
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
                                        <option value="active"{{ old('status') == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive"{{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            InActive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Meta Title</label>
                                    <input type="text" id="inputEstimatedDuration" class="form-control"
                                        value="{{ old('meta_title') }}" name="meta_title" step="0.1">
                                    @error('meta_title')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Meta Keyword </label>
                                    <input type="text" id="inputEstimatedDuration" class="form-control"
                                        value="{{ old('meta_keyword') }}" name="meta_keyword" step="0.1">
                                    @error('meta_keyword')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration"> Meta Description </label>
                                    <textarea name="meta_description" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Sort </label>
                                    <input type="number" class="form-control" value="{{ old('sort') }}"
                                        name="sort"step="0.1">
                                    @error('sort')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="submit" value="Save Changes"
                                                class="btn btn-success float-right">
                                        </div>
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
@section('admin-script')
    <script src=" {{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('ckeditor');
            CKEDITOR.config.height = 300;
        });
    </script>
@endsection
