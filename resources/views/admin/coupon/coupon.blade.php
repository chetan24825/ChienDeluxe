@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Coupon</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
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

        <div class="d-flex flex-row-reverse m-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">New
                Coupon</button>
        </div>




        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Coupon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.coupen') }}">
                            @csrf

                            <div class="form-group">
                                <label for="coupen_name" class="col-form-label">Coupon Name:</label>
                                <input type="text" id="coupen_name" class="form-control" name="coupen_name"
                                    value="{{ old('coupen_name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="coupen_amount" class="col-form-label">Coupon Amount (%)</label>
                                <input type="text" id="coupen_amount" class="form-control" name="coupen_amount"
                                    value="{{ old('coupen_amount') }}" required>
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
                    <h3 class="card-title">Coupon</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Coupon Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Share With</th>
                                <th>Created At</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($coupons as $key => $cate)
                                <tr>
                                    <td>{{ $key + 1 + ($coupons->currentPage() - 1) * $coupons->perPage() }}</td>
                                    <td>
                                        {{ $cate->coupen_name }}
                                        <br>
                                        <a>
                                            {{ $cate->coupen_code }}
                                        </a>

                                    </td>


                                    <td>
                                        <span class="badge badge-success">{{ $cate->coupen_amount }}%</span>
                                    </td>


                                    <td>
                                        @if ($cate->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                    </td>



                                    <td>
                                        @if ($cate->share_with == 0)
                                            <span class="badge badge-warning">None</span>
                                        @endif

                                        @if ($cate->share_with == 1)
                                            <span class="badge badge-success">Free User</span>
                                        @endif

                                        @if ($cate->share_with == 2)
                                            <span class="badge badge-danger">Subscribe Users</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span>{{ date('j M Y', strtotime($cate->created_at)) }}</span>
                                    </td>


                                    <td>

                                        <a class="btn btn-info btn-sm" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#exampleModal{{ $cate->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.coupen.delete', $cate->id) }}"
                                            onclick="return confirm('Do You Want To Delete ?')">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="exampleModal{{ $cate->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create Coupon</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('admin.coupen.edit') }}">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $cate->id }}">

                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Coupon
                                                                Name</label>
                                                            <input type="text" class="form-control" id="coupen_name"
                                                                value="{{ $cate->coupen_name }}" name="coupen_name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Coupon
                                                                Amount(%)</label>
                                                            <input type="text" class="form-control" id="coupen_amount"
                                                                value="{{ $cate->coupen_amount }}" name="coupen_amount">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->status == 0 ? 'selected' : '' }}>
                                                                    Expired</option>
                                                                <option
                                                                    value="1"{{ $cate->status == 1 ? 'selected' : '' }}>
                                                                    Active</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Share
                                                                With</label>
                                                            <select name="share_with" id="share_with"
                                                                class="form-control">
                                                                <option
                                                                    value="0"{{ $cate->share_with == 0 ? 'selected' : '' }}>
                                                                    None</option>
                                                                <option
                                                                    value="1"{{ $cate->share_with == 1 ? 'selected' : '' }}>
                                                                    Free User</option>
                                                                <option
                                                                    value="2"{{ $cate->share_with == 2 ? 'selected' : '' }}>
                                                                    Subscribe Users</option>
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
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
