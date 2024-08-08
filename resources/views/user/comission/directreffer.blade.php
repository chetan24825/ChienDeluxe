@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Referral</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Referral</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Referral</h3>

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
                                    User Name
                                </th>
                                <!--<th>-->
                                <!--    Phone-->
                                <!--</th>-->
                                <th>
                                    Joining Date
                                </th>
                                <th>
                                    Commission
                                </th>

                                <th class="text-center">
                                    Status
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($direct_reffer as $key => $user)
                                <tr>
                                    <td>
                                        {{ $key + 1 + ($direct_reffer->currentPage() - 1) * $direct_reffer->perPage() }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $user->name }}
                                        </a>
                                        <br />
                                        <small>
                                            {{ $user->user_name }}
                                        </small>
                                    </td>

                                    <!--<td class="project_progress">-->
                                    <!--    {{ $user->mobile }}-->
                                    <!--</td>-->
                                    <td>
                                        <span
                                            class="badge badge-success">{{ date('j M Y', strtotime($user->created_at)) }}</span>
                                    </td>

                                    <td><span
                                            class="badge badge-warning">{{ get_setting('symbol') }}{{ App\Models\Commissions::where('user_id', Auth::user()->id)->where('from_user_id', $user->id)->sum('amount') }}
                                        </span></td>

                                    <td class="project-state">
                                        @if ($user->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Deactive</span>
                                        @endif
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
                        {{ $direct_reffer->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
