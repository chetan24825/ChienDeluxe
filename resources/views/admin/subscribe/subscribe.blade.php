@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subscribe</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Subscribe</li>
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Subscribe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.subscribe') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email_id" class="col-form-label">Subscribe Name:</label>
                                <input type="text" id="email_id" class="form-control" name="email_id"
                                    value="{{ old('email_id') }}" required>
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
                    <h3 class="card-title">Subscribe</h3>


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
                                    Email Id
                                </th>

                                <th>
                                    Status
                                </th>




                                <th>
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($subscribe as $key => $cate)
                                <tr>
                                    <td class="project-state">
                                        {{ $key + 1 + ($subscribe->currentPage() - 1) * $subscribe->perPage() }}</td>
                                    <td class="project-state">
                                        <a>
                                            {{ $cate->email_id }}
                                        </a>

                                    </td>


                                    <td class="project-state">
                                        @if ($cate->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions ">

                                        <a class="btn btn-info  btn-sm" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal{{ $cate->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.subscribe.delete', $cate->id) }}"
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Subscribe</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('admin.subscribe.edit') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $cate->id }}">
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Email
                                                                Name</label>
                                                            <input type="text" class="form-control" id="email_id"
                                                                value="{{ $cate->email_id }}" name="email_id">
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
                        {{ $subscribe->links() }}
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
