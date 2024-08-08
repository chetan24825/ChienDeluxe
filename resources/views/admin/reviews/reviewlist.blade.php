@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">

        <div class="d-flex flex-row-reverse m-2">


            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                Add reviews
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.reviews.add') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Product
                                        Name</label>

                                    <select name="product_id" class="form-control" required>
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"> {{ Str::words($product->product_name, 5, '..') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">User
                                        Name</label>
                                    <input type="text" class="form-control" name="user_name" id="recipient-name"
                                        value="{{ old('user_name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email</label>
                                    <input type="text" class="form-control" id="recipient-name" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Rate
                                        Star</label>
                                    <select name="rate" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Status:</label>
                                    <select name="status" class="form-control" required>
                                        <option value="0">Draft
                                        </option>
                                        <option value="1">
                                            Publish</option>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Comment:</label>
                                    <textarea class="form-control" name="comment" id="message-text" required>{{ old('comment') }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Product Name
                                </th>

                                <th>
                                    User Name
                                </th>

                                <th>
                                    Rating
                                </th>

                                <th>
                                    Comment
                                </th>

                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($reviews as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 + ($reviews->currentPage() - 1) * $reviews->perPage() }}</td>

                                    <td>
                                        {{ Str::words($product->product->product_name, 3, '..') }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $product->user_name }}
                                        </a>

                                    </td>



                                    <td class="project-state">
                                        @for ($i = 1; $i <= $product->rate; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    </td>

                                    <td> <strong class="badge badge-success">
                                            {{ Str::words($product->comment, 5, '..') }}
                                        </strong>
                                    </td>

                                    <td class="project-state">
                                        @if ($product->status == 1)
                                            <span class="badge badge-info">Publish</span>
                                        @else
                                            <span class="badge badge-danger">Draft</span>
                                        @endif
                                    </td>

                                    <td class="project-actions">

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#exampleModal{{ $product->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </button>


                                        <div class="modal fade" id="exampleModal{{ $product->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.reviews.edit', $product->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Product
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    name="product_name" id="recipient-name"
                                                                    value="{{ $product->product->product_name }}"
                                                                    disabled>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">User
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    name="user_name" id="recipient-name"
                                                                    value="{{ $product->user_name }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Email</label>
                                                                <input type="text" class="form-control"
                                                                    id="recipient-name" name="email"
                                                                    value="{{ $product->email }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Rate
                                                                    Star</label>
                                                                <select name="rate" class="form-control">
                                                                    <option value="1"
                                                                        {{ $product->rate == '1' ? 'selected' : '' }}>1
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $product->rate == '2' ? 'selected' : '' }}>2
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $product->rate == '3' ? 'selected' : '' }}>3
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $product->rate == '4' ? 'selected' : '' }}>4
                                                                    </option>
                                                                    <option value="5"
                                                                        {{ $product->rate == '5' ? 'selected' : '' }}>5
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Status:</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Draft</option>
                                                                        <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Publish</option>
                                                                    </select>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text"
                                                                    class="col-form-label">Comment:</label>
                                                                <textarea class="form-control" name="comment" id="message-text">{{ $product->comment }}</textarea>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.reviews.delete', $product->id) }}"
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
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
