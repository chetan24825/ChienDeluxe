@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

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
                                <th >
                                    #
                                </th>
                                <th >
                                    User Name
                                </th>
                                <th >
                                    Mobile Number
                                </th>
                                <th>
                                    Joining Date
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th  class="text-center">
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>
                                        {{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}
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
                                    <td>
                                        {{ $user->mobile }}
                                    </td>
                                   
                                   <td>{{  date('j M Y', strtotime($user->created_at))}}</td>
                                   
                                    <td class="project-state">
                                        <span class="badge badge-success">Active</span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.user.login', $user->id) }}" target="blank">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <!--<a class="btn btn-danger btn-sm" href="#">-->
                                        <!--    <i class="fas fa-trash">-->
                                        <!--    </i>-->
                                        <!--</a>-->
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
