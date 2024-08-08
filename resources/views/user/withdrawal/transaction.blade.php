@extends('user.layout.main')

@section('user-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaction History</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transaction History</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction History</h3>

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
                                <th>Transaction Id</th>
                                <th>Title</th>
                                <th>Credit</th>
                                <th>Debit</th>

                                <th>Balance</th>
                                <th>Created At</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($transacrtion as $key => $trans)
                                <tr>
                                    <td>
                                        {{ $key + 1 + ($transacrtion->currentPage() - 1) * $transacrtion->perPage() }}
                                    </td>
                                    <td>
                                        {{ $trans->trans_id }}
                                    </td>

                                    <td>
                                        @if ($trans->status == 2)
                                            Withdrawal
                                        @endif

                                        @if ($trans->status == 1)
                                            Level
                                        @endif
                                    </td>



                                    <td>
                                        @if ($trans->symbol == '+')
                                            <span class=" text-success">{{ get_setting('symbol') }}{{$trans->new_bal}}</span>
                                        @endif

                                    </td>


                                    <td>
                                        @if ($trans->symbol == '-')
                                        <span class=" text-danger">{{ get_setting('symbol') }}{{$trans->new_bal}}</span>

                                        @endif
                                    </td>



                                    <td class="project_progress">
                                        {{ get_setting('symbol') }}{{ $trans->new_bal }}
                                    </td>

                                    <td>
                                        {{ date('j M Y', strtotime($trans->created_at)) }}

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
                        {{ $transacrtion->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
@endsection
