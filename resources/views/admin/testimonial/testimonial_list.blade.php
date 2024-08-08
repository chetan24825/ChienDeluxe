@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Testimonial</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Testimonial</li>
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.testimonial.create') }}">
                            @csrf
                            <div class="form-group">
                                <label for="user_name" class="col-form-label">User Name:</label>
                                <input type="text" id="user_name" class="form-control" value="{{ old('user_name') }}"
                                    name="user_name" required>
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
                                    <input type="hidden" name="photos" value="{{ old('photos') }}" class="selected-files">
                                </div>
                                <div class="file-preview box sm">

                                </div>
                                <small class="text-muted">
                                    Use 600x600 sizes images.</small>
                                <br>
                                @error('photos')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Select
                                    Rating:</label>
                                <select name="rating" class="form-control">
                                    <option value="5" @selected(true)>
                                        5
                                    </option>
                                    <option value="4">
                                        4
                                    </option>
                                    <option value="3">
                                        3
                                    </option>
                                    <option value="2">
                                        2
                                    </option>
                                    <option value="1">
                                        1
                                    </option>
                                </select>

                                @error('servicescat')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="message-text3" class="col-form-label">
                                    Content:</label>
                                <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Select
                                    Status:</label>
                                <select name="status" class="form-control">

                                    <option value="2">
                                        Draft
                                    </option>
                                    <option value="1">
                                        Publish
                                    </option>
                                </select>

                                @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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



        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <em class="alert alert-danger">{{ $error }}</em>
            @endforeach
        @endif

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Testimonial</h3>


                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">New</button>

                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Operation</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($testimonial as $test)
                                <tr>
                                    <td>{{ ucwords(strtolower($test->user_name)) }}</td>

                                    <td>
                                        @for ($i = 1; $i <= $test->rate; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    </td>

                                    </td>

                                    <td style="width: 300px">
                                        {!! Str::words($test->content, 7, $end = '...') !!}
                                    </td>

                                    <td>
                                        @if ($test->status == 1)
                                            <span class="badge badge-success">Publish</span>
                                        @else
                                            <span class="badge badge-danger">Draft</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.testimonial.delete', $test->id) }}"
                                            onclick="return confirm('Do You want To delete ?')" class="btn btn-primary"
                                            title="delete">
                                            <i class="las la-trash-alt text-white"></i></a>



                                        <button type="button" class="btn btn-dark ckbutton" data-toggle="modal"
                                            title="Edit" cus={{ $test->id }}
                                            data-target="#exampleModal{{ $test->id }}"> <i
                                                class="las la-edit text-white"></i></button>


                                        <div class="modal fade" id="exampleModal{{ $test->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Services
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.testimonial.list') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="service_id"
                                                                value="{{ $test->id }}">

                                                            <div class="form-group">
                                                                <label for="user_name" class="col-form-label">User
                                                                    Name:</label>
                                                                <input type="text" id="user_name" class="form-control"
                                                                    name="user_name" value="{{ $test->user_name }}"
                                                                    required>
                                                                @error('user_name')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Select
                                                                    Rating:</label>
                                                                <select name="rating" class="form-control">
                                                                    <option
                                                                        value="5"{{ $test->rate == '5' ? 'selected' : '' }}>
                                                                        5
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $test->rate == '4' ? 'selected' : '' }}>
                                                                        4
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $test->rate == '3' ? 'selected' : '' }}>
                                                                        3
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $test->rate == '2' ? 'selected' : '' }}>
                                                                        2
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $test->rate == '1' ? 'selected' : '' }}>
                                                                        1
                                                                    </option>
                                                                </select>

                                                                @error('servicescat')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>



                                                            <div class="form-group row">
                                                                <label for="signinSrEmail">Gallery
                                                                    Images<small>(1000x1000)</small></label>
                                                                <div class="col-md-12">
                                                                    <div class="input-group" data-toggle="aizuploader"
                                                                        data-type="image" data-multiple="false">
                                                                        <div class="input-group-prepend">
                                                                            <div
                                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                                Browse
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-control file-amount">
                                                                            Choose File</div>
                                                                        <input type="hidden" name="photos"
                                                                            value="{{ $test->image }}"
                                                                            class="selected-files">
                                                                    </div>
                                                                    <div class="file-preview box sm">
                                                                    </div>
                                                                    @error('photos')
                                                                        <span class="text-danger" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group m-0F">
                                                                <label for="message-text"
                                                                    class="col-form-label">Content:</label>

                                                                <textarea class="form-control" name="content" cols="4" rows="4" required>{{ $test->content }}</textarea>
                                                                @error('content')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Select
                                                                    Status:</label>
                                                                <select name="status" class="form-control">

                                                                    <option
                                                                        value="2"{{ $test->status == 2 ? 'selected' : '' }}>
                                                                        Draft
                                                                    </option>
                                                                    <option value="1"
                                                                        {{ $test->status == 1 ? 'selected' : '' }}>
                                                                        Publish
                                                                    </option>
                                                                </select>

                                                                @error('status')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>


                                                                <button type="submit" class="btn btn-primary">Update
                                                                </button>


                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class=" d-flex mt-5 justify-content-center">
                        {{ $testimonial->links() }}
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
