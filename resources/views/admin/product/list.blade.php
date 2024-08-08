@extends('admin.layouts.app')
@section('admin-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
       


        <div class="d-flex flex-row-reverse m-2">
            <a href="{{ route('admin.product') }}" class="btn btn-primary">New Product</a>
        </div>

        <section class="content">
            <div class="card">
                 <form action="{{ route('admin.product.search') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                    value="{{ request()->search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="input-group input-group-sm" style="width: 250px;">
                            <select name="paginate" class="form-control float-right">
                                @foreach ([15, 30, 50, 100, 150, 200] as $value)
                                    <option value="{{ $value }}"
                                        {{ request()->paginate == $value ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                    Product Stock
                                </th>

                                <th>
                                    Market Price
                                </th>

                                <th>
                                    Sale Price
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

                            @forelse ($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                    <td>
                                        <a>
                                           {{ Str::words($product->product_name, 4, ' ') }}
                                        </a>
                                        <br />
                                        <small>
                                            {{ $product->category->category_name }}
                                        </small>

                                    </td>
                                    
                                    <td>
                                        <strong >{{$product->stock}}</strong>
                                    </td>

                                    <td> <strong class="badge badge-success">{{ get_setting('symbol') }}{{ $product->market_price }}</strong> </td>


                                    <td> <strong class="badge badge-success">{{ get_setting('symbol') }}{{ $product->sale_price }}</strong> </td>


                                    <td class="project-state">
                                        @if ($product->status == 1)
                                            <span class="badge badge-info">Publish</span>
                                        @else
                                            <span class="badge badge-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-center">

                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('admin.product.edit', $product->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.product.delete', $product->id) }}"
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('admin-script')
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
@endsection
