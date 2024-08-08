@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Leads</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Leads</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leads</h3>

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
                                <th>Email</th>
                                <th>Net Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Reason</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($leads as $key => $cate)
                                <tr>
                                    <td>{{ $key + 1 + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                                    <td>
                                        <a>
                                            {{ $cate->user_name }}
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            {{ $cate->email }}
                                        </a>
                                    </td>

                                    @if ($cate->main_amount)
                                        <td><span class="badge badge-warning">{{ get_setting('symbol') }}{{ $cate->main_amount }}</span></td>
                                    @else
                                        <td><span class="badge badge-warning">{{ get_setting('symbol') }}{{ $cate->net_amount }}</span></td>
                                    @endif

                                    <td class="project-state text-left">
                                        @if ($cate->status == 0)
                                            <span class="badge badge-warning ">Pending</span>
                                        @endif

                                        <!--@if ($cate->status == 1)-->
                                        <!--    <span class="badge badge-success"> Order Procide</span>-->
                                        <!--@endif-->

                                    </td>

                                    

                                    <td class="project-state  text-left">
                                        <span class="badge badge-success">{{ $cate->created_at }}</span>
                                    </td>
                                    
                                    @if ($cate->error_reason != 'Order Complete')
                                     <td><span class="badge badge-warning">{{ $cate->error_reason }}</span></td>
                                    @else
                                     <td></td>
                                    @endif
                                    



                                    <td class="project-actions text-left">

                                        
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.order.leads.view', $cate->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                        
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.order.leads.delete', $cate->id) }}"
                                            onclick="return confirm('Do You Want To Delete ?')">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Not Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class=" d-flex mt-5 justify-content-center">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
