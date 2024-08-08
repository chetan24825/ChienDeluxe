@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Withdrawal History</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Withdrawal History</li>
                        </ol>
                    </div>
                </div>

            </div>

        </section>

        <section class="content-header">
            <div class="container-fluid">
                 @if($errors->has('amount'))
    <div class="alert alert-danger">
        {{ $errors->first('amount') }}
    </div>
@endif
                <div class="row">
                   

                    <div class="col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                <a href="#" class="text-white"> <i class="fas fa-users"></i></a>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text"><a href="#">My Income</a></span>
                                <span class="info-box-number">{{ Auth::user()->balance }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="col-md-3">
                        <button type="button" class=" btn btn-primary float-right" data-toggle="modal"
                            data-target="#exampleModal">
                            WithDrawal Request
                        </button>
                    </div>
                </div>
            </div>

        </section>



        <!-- /.modal -->

        <div class="modal fade" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Withdrawal Request</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('user.withdrawal') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group-prepend">
                                    <input type="number" class="form-control" placeholder="Enter Amount"
                                        id="recipient-name" name="amount" min='50' value="{{ old('amount') }}" required>
                                    <div class="input-group-text">₹</div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Withdrawal History</h3>

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
                                <th>
                                    #
                                </th>
                                <th>
                                    Transaction Id
                                </th>
                                <th>
                                    Amount
                                </th>

                                <th>
                                    Balance Amount
                                </th>

                                <th>
                                    Status
                                </th>


                                <th>Message</th>


                                <th>
                                    Time
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($withdrawal as $key => $withdraw)
                                <tr>
                                    <td>
                                        {{ $key + 1 + ($withdrawal->currentPage() - 1) * $withdrawal->perPage() }}
                                    </td>
                                    <td>
                                        {{ $withdraw->transaction_id }}
                                    </td>

                                    <td>
                                        <span class="badge badge-danger">{{ get_setting('symbol') }}{{ $withdraw->amount }}</span>
                                    </td>

                                    <td>
                                        <span class="badge badge-info">{{ get_setting('symbol') }}{{ $withdraw->balance_amount }}</span>
                                    </td>

                                    <td>
                                        @if ($withdraw->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                        @endif

                                        @if ($withdraw->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @endif

                                        @if ($withdraw->status == 2)
                                            <span class="badge badge-danger">Reject</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge badge-info">{{ $withdraw->remark }}</span>
                                    </td>

                                    <td>
                                        <span class="badge badge-success">{{ $withdraw->created_at }}</span>
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
                        {{ $withdrawal->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-style')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"] {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
