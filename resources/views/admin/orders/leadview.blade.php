@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lead View</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Lead View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">User Information

                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">User Name</label>
                                <input type="text" name="user_name" id="inputEstimatedBudget" class="form-control"
                                    value="{{ $leads->user_name }}" step="1" disabled>
                            </div>

                            <div class="form-group">
                                <label for="inputSpentBudget">Email</label>
                                <input type="email" name="email" id="inputSpentBudget" class="form-control"
                                    value="{{ $leads->email }}" step="1" disabled>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">Phone</label>
                                <input type="text" name="phone" id="inputEstimatedDuration" class="form-control"
                                    value="{{ $leads->phone }}" step="0.1" disabled>
                            </div>



                            <div class="form-group">
                                <label for="inputEstimatedDuration">Address</label>
                                <textarea name="address" class="form-control"cols="4" rows="4" disabled>{{ $leads->address }}</textarea>
                            </div>

                            @if ($leads->error_reason)
                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Error </label>
                                    <textarea name="address" class="form-control"cols="4" rows="4" disabled>{{ $leads->error_reason }}</textarea>
                                </div>
                            @endif

                        </div>
                    </div>


                </div>

                <div class="col-md-6">



                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Detail</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach (json_decode($leads->products) as $product)
                                    <div class="col-lg-4 p-2">
                                        <label>Product</label>
                                        <input type="text" class="form-control " id="exampleInputEmail"
                                            name="product_name[{{ $product->product_id }}]" placeholder="Enter Product Name"
                                            value="{{ $product->product_name }}" disabled>
                                    </div>
                                    <div class="col-lg-4 p-2">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control " id="exampleInputEmail"
                                            name="quantity[{{ $product->product_id }}]" placeholder="Quantity"
                                            value="{{ $product->quantity }}" disabled>

                                    </div>
                                    <div class="col-lg-4 p-2">
                                        <label>Amount</label>
                                        <input type="text" class="form-control " id="exampleInputEmail"
                                            name="amount[{{ $product->product_id }}]" placeholder="Enter Order Id"
                                            value="{{ $product->net_amount }}" disabled>

                                    </div>
                                @endforeach
                            </div>



                            <div class="row">
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4 p-1">
                                    <label> <strong>Total Amount :</strong></label>
                                </div>
                                <div class="col-lg-4 ">

                                    <input type="text" class="form-control " id="exampleInputEmail" name="net_amount"
                                        placeholder="Enter Net Amount" value="{{ $leads->net_amount }}" disabled>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
