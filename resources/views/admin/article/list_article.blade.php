@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blogs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Blogs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Of Blogs</h3>


                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Blogs
                                </th>
                                <th>
                                    Category
                                </th>

                                <th>
                                    Status
                                </th>
                                <th>
                                    Operation
                                </th>


                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($article as $key => $cate)
                                <tr>
                                    <td>{{ $key + 1 + ($article->currentPage() - 1) * $article->perPage() }}</td>
                                    <td>
                                        <a>
                                            {{ $cate->article_title }}
                                        </a>

                                    </td>

                                    <td >

                                        <span class="badge badge-danger">{{ $cate->category->category_name }}</span>
                                    </td>


                                    <td >
                                        @if ($cate->article_status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td >



                                        <a class="btn btn-info btn-sm" href="{{ route('admin.article.edit', $cate->id) }}">
                                            <i class="fas fa-pencil-alt"></i> </a>

                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Do You Want To Delete ?')"
                                            href="{{ route('admin.article.delete', $cate->id) }}">
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
                        {{ $article->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
