@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Slider</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        @if ($errors->any())
            <div class="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Slider</h3>


                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">New</button>

                    <div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Slides</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.slider') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="slider_title" class="col-form-label">Slide Title:</label>
                                            <input type="text" id="slider_title" value="{{ old('slider_title') }}"
                                                class="form-control" name="slider_title">
                                        </div>

                                        <div class="form-group">
                                            <label for="signinSrEmail">Select The Image </label>

                                            <div class="input-group" data-toggle="aizuploader" data-type="image"
                                                data-multiple="false">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        Browse
                                                    </div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="slider_image" value="{{ old('slider_image') }}"
                                                    class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">

                                            </div>
                                            <small class="text-muted">
                                                Use 1920x992 sizes images.</small>
                                            <br>
                                            @error('slider_image')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="slider_description" class="col-form-label">Slide
                                                Description:</label>
                                            <textarea name="slider_description" id="slider_description" class="form-control" cols="30" rows="10">{{ old('slider_description') }}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="slider_link" class="col-form-label">Slide Link:</label>
                                            <input type="text" id="slider_link" value="{{ old('slider_link') }}"
                                                class="form-control" name="slider_link">
                                        </div>



                                        <div class="modal-footer " style="border: none">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Slider Image
                                </th>

                                <th>
                                    Slider Title
                                </th>

                                <th>
                                    Slider Desc
                                </th>

                                <th>
                                    Slider Link
                                </th>

                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($sliders as $key => $slide)
                                <tr>
                                    <td>{{ $key + 1 + ($sliders->currentPage() - 1) * $sliders->perPage() }}</td>

                                    <td>
                                        @if ($slide->slider_image)
                                            <img src="{{ uploaded_asset($slide->slider_image) }}" height="50px"
                                                class="rounded-circle" width="50px" alt="Slider">
                                        @else
                                            <span>NO Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $slide->slider_title }} </td>

                                    <td>
                                        {{ Str::words($slide->slider_description, 3, '...') }}
                                    </td>

                                    <td> {{ $slide->slider_link }}
                                    </td>





                                    <td class="project-state">
                                        @if ($slide->status == 1)
                                            <span class="badge badge-info">Publish</span>
                                        @else
                                            <span class="badge badge-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td class="project-actions ">

                                        <a class="btn btn-info  btn-sm" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal{{ $slide->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <div class="modal fade bd-example-modal-lg" id="exampleModal{{ $slide->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="POST" action="{{ route('admin.slider.update') }}">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $slide->id }}">

                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Status</label>
                                                                <select name="status" id="status"
                                                                    class="form-control">
                                                                    <option
                                                                        value="0"{{ $slide->status == 0 ? 'selected' : '' }}>
                                                                        Draft</option>
                                                                    <option
                                                                        value="1"{{ $slide->status == 1 ? 'selected' : '' }}>
                                                                        Publish</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="slider_title" class="col-form-label">Slide
                                                                    Title:</label>
                                                                <input type="text" id="slider_title"
                                                                    value="{{ $slide->slider_title }}"
                                                                    class="form-control" name="slider_title">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="signinSrEmail">Select The Image </label>

                                                                <div class="input-group" data-toggle="aizuploader"
                                                                    data-type="image" data-multiple="false">
                                                                    <div class="input-group-prepend">
                                                                        <div
                                                                            class="input-group-text bg-soft-secondary font-weight-medium">
                                                                            Browse
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-control file-amount">Choose File</div>
                                                                    <input type="hidden" name="slider_image"
                                                                        value="{{ $slide->slider_image }}"
                                                                        class="selected-files">
                                                                </div>
                                                                <div class="file-preview box sm">

                                                                </div>
                                                                <small class="text-muted">
                                                                    Use 1920x992 sizes images.</small>
                                                                <br>
                                                                @error('slider_image')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ ucwords($message) }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="slider_description"
                                                                    class="col-form-label">Slide
                                                                    Description:</label>
                                                                <textarea name="slider_description" id="slider_description" class="form-control" cols="30" rows="10">{{ $slide->slider_description }}</textarea>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="slider_link" class="col-form-label">Slide
                                                                    Link:</label>
                                                                <input type="text" id="slider_link"
                                                                    value="{{ $slide->slider_link }}"
                                                                    class="form-control" name="slider_link">
                                                            </div>



                                                            <div class="modal-footer " style="border: none">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Updated</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.slider.delete', $slide->id) }}"
                                            onclick="return confirm('Do You Want To Delete ?')">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Not Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class=" d-flex mt-5 justify-content-center">
                        {{ $sliders->links() }}
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
