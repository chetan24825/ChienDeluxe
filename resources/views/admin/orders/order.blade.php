@extends('admin.layouts.app')
@section('admin-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>

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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Net Amount</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Created At</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($orders as $key => $cate)
                        <tr>
                            <td>{{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                            <td>
                                <a>
                                    {{ $cate->user_name }}
                                </a>
                            </td>

                            <td>
                                <a>
                                    @if ($cate)
                                    @if (isset($cate->shipping_address))
                                    {{ isset(json_decode($cate->shipping_address)->phone) ? json_decode($cate->shipping_address)->phone : 'N/A' }}
                                    @else
                                    {{ isset($cate->phone) ? $cate->phone : 'N/A' }}
                                    @endif
                                    @else
                                    N/A
                                    @endif
                                </a>
                            </td>

                            @if ($cate->main_amount)
                            <td><span>{{ get_setting('symbol') }}{{ $cate->main_amount }}</span></td>
                            @else
                            <td><span>{{ get_setting('symbol') }}{{ $cate->net_amount }}</span></td>
                            @endif

                            <td class="project-state text-left">
                                @if ($cate->status == 0)
                                <span class="badge badge-warning ">Pending</span>
                                @endif

                                @if ($cate->status == 1)
                                <span class="badge badge-success">Order Delivered</span>
                                @endif

                                @if ($cate->status == 2)
                                <span class="badge badge-danger"> Order Cancel</span>
                                @endif

                                @if ($cate->status == 3)
                                <span class="badge badge-info"> Confirmed</span>
                                @endif

                                @if ($cate->status == 4)
                                <span class="badge badge-dark"> On Delivery</span>
                                @endif
                            </td>

                            <td>

                                @if ($cate->payment_status == "PENDING")
                                <span class="badge badge-warning"> {{$cate->payment_status}}</span>
                                @elseif($cate->payment_status == "SUCCESS")
                                <span class="badge badge-success"> {{$cate->payment_status}}</span>
                                @else
                                <span class="badge badge-info">{{$cate->payment_status}}</span>
                                @endif
                            </td>

                            <td class="project-state  text-left">
                                <span>{{ date('j M Y', strtotime($cate->created_at)) }}</span>
                            </td>


                            <td class="project-actions text-left">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.order.view', $cate->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a class="btn btn-dark btn-sm" href="{{ route('order.invoice', $cate->id) }}">
                                    <i class="fas fa-file-invoice">
                                    </i>

                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Not Data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class=" d-flex mt-5 justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('admin-script')
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection