@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>







        <div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.category') }}">
                            @csrf
                            <div class="form-group">
                                <label for="category_name" class="col-form-label">Category Name:</label>
                                <input type="text" id="category_name" class="form-control" name="category" required>
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
                                    <input type="hidden" name="image" value="" class="selected-files">
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
                    <h3 class="card-title">Category</h3>


                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">New</button>

                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr class="text-center">
                                <th>
                                    #
                                </th>
                                <th>
                                    Category Name
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Visible
                                </th>

                                <th>
                                    Sort Position
                                </th>


                                <th>
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($category as $key => $cate)
                                <tr>
                                    <td class="project-state">
                                        {{ $key + 1 + ($category->currentPage() - 1) * $category->perPage() }}</td>
                                    <td class="project-state">
                                        <a>
                                            {{ $cate->category_name }}
                                        </a>

                                    </td>


                                    <td class="project-state">
                                        @if ($cate->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>

                                    <td class="project-state">
                                        @if ($cate->visible == 0)
                                            <span class="badge badge-dark">Both</span>
                                        @endif
                                        @if ($cate->visible == 1)
                                            <span class="badge badge-dark">Header</span>
                                        @endif
                                        @if ($cate->visible == 2)
                                            <span class="badge badge-dark">Footer</span>
                                        @endif
                                        @if ($cate->visible == 3)
                                            <span class="badge badge-danger">None</span>
                                        @endif
                                    </td>

                                    <td class="project-state">
                                        <a>
                                            <span class="badge badge-dark">{{ $cate->sort }}</span>

                                        </a>
                                    </td>


                                    <td class="project-actions ">

                                        <a class="btn btn-info  btn-sm" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal{{ $cate->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.category.delete', $cate->id) }}"
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
                                                    <form method="POST" action="{{ route('admin.editcategory') }}">
                                                        @csrf
                                                        <input type="hidden" name="catid"
                                                            value="{{ $cate->id }}">
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Category
                                                                Name</label>
                                                            <input type="text" class="form-control" id="cname"
                                                                value="{{ $cate->category_name }}" name="cname">
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
                                                                <input type="hidden" name="image"
                                                                    value="{{ $cate->image }}" class="selected-files">
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
                                                            <label for="recipient-name"
                                                                class="col-form-label">Visible</label>
                                                            <select name="visible" id="visible" class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->visible == 0 ? 'selected' : '' }}>
                                                                    Both</option>
                                                                <option
                                                                    value="1"{{ $cate->visible == 1 ? 'selected' : '' }}>
                                                                    Header</option>
                                                                <option
                                                                    value="2"{{ $cate->visible == 2 ? 'selected' : '' }}>
                                                                    Footer</option>
                                                                <option
                                                                    value="3"{{ $cate->visible == 3 ? 'selected' : '' }}>
                                                                    None</option>
                                                            </select>
                                                        </div>




                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->status == 0 ? 'selected' : '' }}>
                                                                    InActive</option>
                                                                <option
                                                                    value="1"{{ $cate->status == 1 ? 'selected' : '' }}>
                                                                    Active</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">
                                                                Sort Position</label>
                                                            <input type="text" class="form-control" id="cname"
                                                                value="{{ $cate->sort }}" name="sort">
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
                        {{ $category->links() }}
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
@endsection


@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
