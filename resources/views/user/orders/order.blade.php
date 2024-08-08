@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                <th>Product Name</th>
                                <th>Order Id</th>
                                <th>Net Amount</th>
                                <th>Delivery</th>
                                <th>Status</th>
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
                                        <a href="{{ route('user.order.view', encrypt($cate->id)) }}" class="order-product">
                                            @php
                                                $products = json_decode($cate->products, true);
                                                $firstProduct = reset($products);
                                            @endphp

                                            {{ Str::words($firstProduct['product_name'],4,'') }}
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            {{ $cate->order_id }}
                                        </a>
                                    </td>

                                    @if ($cate->main_amount)
                                        <td><span >{{ get_setting('symbol') }}{{ $cate->main_amount }}</span></td>
                                    @else
                                        <td><span >{{ get_setting('symbol') }}{{ $cate->net_amount }}</span></td>
                                    @endif
                                    
                                    <td><span >{{ $cate->delivery_by }}</span></td>
    
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
                                        {{-- <span class="badge badge-success">{{  custom_date($cate->created_at) }}</span> --}}
                                        <span >{{  date('j M Y', strtotime($cate->created_at));}}</span>
                                    </td>


                                    <td class="project-actions text-left">
                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('user.order.view', encrypt($cate->id)) }}">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                        
                                        <a class="btn btn-success btn-sm " href="{{ route('order.invoice', $cate->id) }}">
                                            <i class="fas fa-file-invoice ">
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
