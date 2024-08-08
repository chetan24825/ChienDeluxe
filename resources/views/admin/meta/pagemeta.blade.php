@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pages Meta</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pages Meta</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        @if ($errors->any())
            <div class="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Of Pages</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#exampleModal"><i class="fa fa-fw fa-plus"></i>Add New
                            Page Meta</button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Page Meta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.pages.meta') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Current Url Path:</label>
                                            <input type="text" value="{{ old('url') }}" class="form-control"
                                                name="url" id="recipient-name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text1" class="col-form-label">Meta Title:</label>
                                            <input type="text" class="form-control" value="{{ old('meta_title') }}"
                                                name="meta_title" id="message-text1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text2" class="col-form-label">Meta Keyword:</label>
                                            <input type="text" class="form-control" value="{{ old('meta_keywords') }}"
                                                name="meta_keywords" id="message-text2" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text3" class="col-form-label">Meta Description:</label>
                                            <textarea class="form-control" name="meta_description" id="message-text3" required>{{ old('meta_keywords') }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
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
                                    Page Url Path
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Meta Title
                                </th>

                                <th>
                                    Meta Keywords
                                </th>

                                <th>
                                    Meta Description

                                </th>


                                <th class="text-center">
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($pagemeta as $key => $page)
                                <tr>
                                    <td>{{ $key + 1 + ($pagemeta->currentPage() - 1) * $pagemeta->perPage() }}</td>
                                    <td>
                                        @if ($page->main)
                                            <span class="badge badge-success">{{ $page->url }}</span>
                                        @else
                                            <a href='{{ url("/$page->url") }}' target="_blank">
                                                {{ url('/') }}
                                                <span class="text-info">/{{ $page->url }}</span>
                                            </a>
                                        @endif

                                    </td>

                                    <td>
                                        @if ($page->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif

                                    </td>

                                    <td>
                                        <a>
                                            {{ $page->meta_title }}
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            {{ Str::words($page->meta_keywords, 3, '...') }}
                                        </a>
                                    </td>

                                    <td>
                                        <a>
                                            {{ Str::words($page->meta_description, 3, '...') }}

                                        </a>
                                    </td>


                                    <td class="project-actions ">
                                        @if (!$page->main)
                                            <a class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this page?');"
                                                href="{{ route('admin.pages.meta.delete', $page->id) }}">
                                                <i class="fas fa-trash-alt"></i> </a>
                                        @endif



                                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal"
                                            data-target="#exampleModal{{ $page->id }}">
                                            <i class="fas fa-pencil-alt"></i> </a>



                                        <div class="modal fade" id="exampleModal{{ $page->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">New Page Meta</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('admin.pages.meta.edit') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Current
                                                                    Url Path:</label>
                                                                <input type="hidden" value="{{ $page->id }}"
                                                                    class="form-control" name="id"
                                                                    value="{{ $page->id }}" required>
                                                                <input type="text" value="{{ $page->url }}"
                                                                    class="form-control" name="url"
                                                                    id="recipient-name"
                                                                    {{ $page->main ? 'readonly' : '' }} required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text1" class="col-form-label">Meta
                                                                    Status:</label>
                                                                <select name="status" class="form-control">
                                                                    <option
                                                                        value="1"{{ $page->status == 1 ? 'selected' : '' }}>
                                                                        Active
                                                                    </option>
                                                                    <option
                                                                        value="0"{{ $page->status == 0 ? 'selected' : '' }}>
                                                                        InActive</option>

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text1" class="col-form-label">Meta
                                                                    Title:</label>
                                                                <input type="text" class="form-control"
                                                                    name="meta_title" value="{{ $page->meta_title }}"
                                                                    id="message-text1" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text2" class="col-form-label">Meta
                                                                    Keyword:</label>
                                                                <input type="text" class="form-control"
                                                                    name="meta_keywords"
                                                                    value="{{ $page->meta_keywords }}" id="message-text2"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text3" class="col-form-label">Meta
                                                                    Description:</label>
                                                                <textarea class="form-control" name="meta_description" id="message-text3" required>{{ $page->meta_description }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
                        {{ $pagemeta->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
