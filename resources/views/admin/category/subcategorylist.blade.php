@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Sub Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Sub Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.sub.category') }}">
                            @csrf

                            <div class="form-group">
                                <label for="category_name" class="col-form-label">Select Category Name:</label>
                                <select name="category_id" class="form-control select2">
                                    @foreach ($category as $cate)
                                        <option
                                            value="{{ $cate->id }}"{{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                            {{ $cate->category_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-form-label">Sub Category Name:</label>
                                <input type="text" id="category_name" class="form-control" name="sub_category_name"
                                    value="{{ old('sub_category_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="signinSrEmail">Select The Main Image </label>

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            Browse
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="sub_category_image" value="{{ old('sub_category_image') }}"
                                        class="selected-files">
                                </div>
                                <div class="file-preview box sm">

                                </div>
                                <small class="text-muted">
                                    Use 600x600 sizes images.</small>
                                <br>
                                @error('sub_category_image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="message-text1" class="col-form-label">Meta
                                    Title:</label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}"
                                    id="message-text1" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text2" class="col-form-label">Meta
                                    Keyword:</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ old('meta_keywords') }}" id="message-text2" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text3" class="col-form-label">Meta
                                    Description:</label>
                                <textarea class="form-control" name="meta_description" id="message-text3">{{ old('meta_description') }}</textarea>
                            </div>


                            <div class="modal-footer " style="border: none">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sub Category</h3>


                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">New</button>

                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th class="project-state">
                                    #
                                </th>
                                <th class="project-state">
                                    Sub Category Name
                                </th>

                                <th class="project-state">
                                    Category Name
                                </th>
                                <th class="project-state">
                                    User Banner
                                </th>

                                <th class="project-state">
                                    Status
                                </th>
                                <th>
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($subcategory as $key => $cate)
                                <tr>
                                    <td class="project-state">
                                        {{ $key + 1 + ($subcategory->currentPage() - 1) * $subcategory->perPage() }}</td>
                                    <td class="project-state">
                                        <span class="badge badge-info">
                                            {{ $cate->sub_category_name }}</span>
                                    </td>

                                    <td class="project-state">
                                        <span class="badge badge-warning">
                                            {{ $cate->category->category_name }}
                                        </span>
                                    </td>

                                    <td class="project-state">
                                        @if ($cate->banner == 1)
                                            <span class="badge badge-success">Banner</span>
                                        @else
                                            <span class="badge badge-danger">None</span>
                                        @endif
                                    </td>

                                    <td class="project-state">
                                        @if ($cate->sub_category_status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>

                                    <td class="project-actions">

                                        <a class="btn btn-info  btn-sm" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal{{ $cate->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.sub.category.delete', $cate->id) }}"
                                            onclick="return confirm('Do You Want To Delete ?')">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </td>
                                    <div class="modal fade bd-example-modal-lg" id="exampleModal{{ $cate->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('admin.sub.editcategory') }}">
                                                        @csrf
                                                        <input type="hidden" name="subcatid"
                                                            value="{{ $cate->id }}">

                                                        <div class="form-group">
                                                            <label for="category_name" class="col-form-label">Select
                                                                Category Name:</label>
                                                            <select name="category_id" class="form-control">
                                                                @foreach ($category as $categ)
                                                                    <option
                                                                        value="{{ $categ->id }}"{{ $cate->category_id == $categ->id ? 'selected' : '' }}>
                                                                        {{ $categ->category_name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Category
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                id="sub_category_name"
                                                                value="{{ $cate->sub_category_name }}"
                                                                name="sub_category_name">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="signinSrEmail">Select The Main Image </label>

                                                            <div class="input-group" data-toggle="aizuploader"
                                                                data-type="image" data-multiple="false">
                                                                <div class="input-group-prepend">
                                                                    <div
                                                                        class="input-group-text bg-soft-secondary font-weight-medium">
                                                                        Browse
                                                                    </div>
                                                                </div>
                                                                <div class="form-control file-amount">Choose File</div>
                                                                <input type="hidden" name="sub_category_image"
                                                                    value="{{ $cate->sub_category_image }}"
                                                                    class="selected-files">
                                                            </div>
                                                            <div class="file-preview box sm">

                                                            </div>
                                                            <small class="text-muted">
                                                                Use 600x600 sizes images.</small>
                                                            <br>
                                                            @error('sub_category_image')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ ucwords($message) }}</strong>
                                                                </span>
                                                            @enderror

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Status</label>
                                                            <select name="sub_category_status" id="sub_category_status"
                                                                class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->sub_category_status == 0 ? 'selected' : '' }}>
                                                                    InActive</option>
                                                                <option
                                                                    value="1"{{ $cate->sub_category_status == 1 ? 'selected' : '' }}>
                                                                    Active</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Banner</label>
                                                            <select name="banner" id="sub_category_status"
                                                                class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->banner == 0 ? 'selected' : '' }}>
                                                                    None</option>
                                                                <option
                                                                    value="1"{{ $cate->banner == 1 ? 'selected' : '' }}>
                                                                    Use Banner</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text1" class="col-form-label">Meta
                                                                Title:</label>
                                                            <input type="text" class="form-control" name="meta_title"
                                                                value="{{ $cate->meta_title }}" id="message-text1"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text2" class="col-form-label">Meta
                                                                Keyword:</label>
                                                            <input type="text" class="form-control"
                                                                name="meta_keywords" value="{{ $cate->meta_keywords }}"
                                                                id="message-text2" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text3" class="col-form-label">Meta
                                                                Description:</label>
                                                            <textarea class="form-control" name="meta_description" id="message-text3" required>{{ $cate->meta_description }}</textarea>
                                                        </div>

                                                        <div class="modal-footer " style="border: none">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Not Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class=" d-flex mt-5 justify-content-center">
                        {{ $subcategory->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-style')
    <style>
        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
            text-align: left;
            width: 100%;
        }
    </style>
    {{-- POP UP MEDIA LIBRARY --}}
    <link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('aizfiles/vendors.js') }}"></script>
    <link href="{{ asset('aizfiles/aiz-core.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}"> --}}
@endsection


@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
    {{-- <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        });
    </script> --}}
@endsection
