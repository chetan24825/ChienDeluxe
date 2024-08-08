@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
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
            </div>
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Of Leads</h3>

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
                                    User Email
                                </th>

                                <th>
                                    Subject
                                </th>
                                <th class="text-center">
                                    Read Status
                                </th>

                                <th class="text-center">
                                    Admin Status
                                </th>
                                <th style="width: 20%" class="text-center">
                                    Operation
                                </th>


                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($leads as $key => $cate)
                                <tr>
                                    <td>{{ $key + 1 + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                                    <td>
                                        <a>
                                            {{ $cate->contact_name }}
                                        </a>
                                        <br />
                                        <small>
                                            {{ $cate->contact_email }}
                                        </small>

                                    </td>

                                    <td title="{{ $cate->contact_message }}">{{ $cate->contact_subject }}</td>



                                    <td class="project-state">
                                        @if ($cate->read_status == 0)
                                            <span class="badge badge-success">UnRead</span>
                                        @else
                                            <span class="badge badge-danger">Read</span>
                                        @endif
                                    </td>

                                    <td class="project-state">
                                        @if ($cate->status == 1)
                                            <span class="badge badge-info">Interested</span>
                                        @endif

                                        @if ($cate->status == 2)
                                            <span class="badge badge-primary">Follow Up</span>
                                        @endif

                                        @if ($cate->status == 3)
                                            <span class="badge badge-danger">Denied</span>
                                        @endif

                                        @if ($cate->status == 4)
                                            <span class="badge badge-warning">Not-Decided </span>
                                        @endif

                                        @if ($cate->status == 5)
                                            <span class="badge badge-success">Converted</span>
                                        @endif

                                    </td>
                                    <td class="project-actions text-center">

                                        <a class="btn btn-info btn-sm" href="{{ route('admin.leads.edit', $cate->id) }}">
                                            <i class="fas fa-pencil-alt"></i> </a>

                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Do You Want To Delete ?')"
                                            href="{{ route('admin.leads.delete', $cate->id) }}">
                                            <i class="fas fa-trash">
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
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
