@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Custom Pages</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Custom Pages</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Custom Pages</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">New</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Page Name</th>
                                <th>Description</th>
                                <th>Url Link</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($pages as $key => $cate)
                                <tr>
                                    <td>{{ $key + 1 + ($pages->currentPage() - 1) * $pages->perPage() }}</td>
                                    <td>
                                        <a>
                                            {{ $cate->page_name }}
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            {{ Str::words(strip_tags($cate->description),3,' ') }}
                                        </a>
                                    </td>
                                    
                                    <td>
                                        <a>
                                            {{ route('custom.page',$cate->slug) }}
                                        </a>
                                    </td>

                                    <td class="project-state text-left">
                                        @if ($cate->status == 0)
                                            <span class="badge badge-warning">Draft</span>
                                        @endif

                                        @if ($cate->status == 1)
                                            <span class="badge badge-success">Publish</span>
                                        @endif

                                    </td>

                                    <td class="project-state  text-left">
                                        <span class="badge badge-success">{{ $cate->created_at }}</span>
                                    </td>


                                    <td class="project-actions text-left">

                                        <a class="btn btn-info btn-sm" href="{{ route('admin.pages.view', $cate->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm" href="{{ route('admin.pages.delete', $cate->id) }}"
                                            onclick="return confirm('Do You Want To Delete ?')">
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
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
