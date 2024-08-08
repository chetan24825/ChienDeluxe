@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <form action="{{ route('admin.order.edit', $order->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    
                    <div class="col-md-6">
                        
                         <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product Detail</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach (json_decode($order->products) as $product)
                                        <div class="col-lg-4 p-2">
                                            <label>Product</label>
                                            <input type="text" class="form-control " id="exampleInputEmail"
                                                name="product_name[{{ $product->product_id }}]"
                                                placeholder="Enter Product Name" value="{{ $product->product_name }}"
                                                disabled>
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

                                @if ($order->main_amount)
                                    <div class="row">
                                        <div class="col-lg-12 p-2">
                                        </div>
                                        <div class="col-lg-4 p-2">
                                            <label> <strong>Coupon Code:</strong></label>
                                        </div>
                                        <div class="col-lg-4 p-2">

                                            <input type="text" id="inputName" class="form-control"
                                                value="{{ $order->coupon_code }}" name="coupon_code" readonly>

                                        </div>
                                        <div class="col-lg-4 p-2">
                                            <input type="text" class="form-control " id="exampleInputEmail"
                                                name="coupon_code_amount" placeholder="Enter Net Amount"
                                                value="{{ $order->coupon_code_amount }}" disabled>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-4 p-1">
                                        <label> <strong>Sub Amount :</strong></label>
                                    </div>
                                    <div class="col-lg-4 ">

                                        <input type="text" class="form-control " id="exampleInputEmail"
                                            name="net_amount" placeholder="Enter Net Amount"
                                            value="{{ $order->net_amount }}" disabled>
                                    </div>
                                </div>
                                
                                 @if ($order->courier_amount)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4 p-1">
                                            <label> <strong>Shipping Amount :</strong></label>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <input type="text" class="form-control " id="exampleInputEmail"
                                                value="{{ $order->courier_amount }}" disabled>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 p-2">
                                        <hr>
                                    </div>
                                    <div class="col-lg-4 p-2">
                                    </div>
                                    <div class="col-lg-4 p-3">
                                        <label> <strong>Total Amount :</strong></label>
                                    </div>
                                    <div class="col-lg-4 p-2">
                                        @if ($order->main_amount)
                                            <input type="text" class="form-control " id="exampleInputEmail"
                                                name="main_amount" placeholder="Enter Net Amount"
                                                value="{{ $order->main_amount + $order->courier_amount }}" disabled >
                                        @else
                                            <input type="text" class="form-control " id="exampleInputEmail"
                                                name="net_amount" placeholder="Enter Net Amount"
                                                value="{{ $order->net_amount + $order->courier_amount }}" disabled>
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Order Detail</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Order Id</label>
                                    <input type="text" id="inputName" class="form-control"
                                        value="{{ $order->order_id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Payment Type</label>
                                    <select name="payment_by" class="form-control">
                                        <option value="0"{{ $order->payment_by == 0 ? 'selected' : '' }}>
                                            Other</option>
                                        <option value="1"{{ $order->payment_by == 1 ? 'selected' : '' }}>
                                            Cash On Delivery</option>

                                    </select>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="inputStatus">Payment Status</label>
                                    <input type="text" class="form-control " id="exampleInputEmail"
                                                name="payment_status" placeholder="Enter Payment Status"
                                                value="{{ $order->payment_status }}" >
                                    
                                    
                                </div>


                                <div class="form-group">
                                    <label>Order Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0"{{ $order->status == 0 ? 'selected' : '' }}>
                                            Pending</option>

                                        <option value="3"{{ $order->status == 3 ? 'selected' : '' }}>
                                            Confirmed</option>

                                        <option value="4"{{ $order->status == 4 ? 'selected' : '' }}>
                                            On Delivery</option>

                                        <option value="1"{{ $order->status == 1 ? 'selected' : '' }}>
                                            Delivered</option>

                                        <option value="2"{{ $order->status == 2 ? 'selected' : '' }}>
                                            Cancel</option>

                                    </select>
                                    @error('status')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Courier</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 p-2">
                                        <label>Courier Company</label>
                                        <input type="text" class="form-control " id="exampleInputEmail"
                                            name="courier_company" placeholder="Enter Courier Company"
                                            value="{{ $order->courier_company }}">
                                    </div>
                                    <div class="col-lg-12 p-2">
                                        <label>Tracking No</label>
                                        <input type="text" class="form-control" name="tracking_no"
                                            placeholder="Tracking No" value="{{ $order->tracking_no }}">

                                    </div>
                                    <div class="col-lg-12 p-2">
                                        <label>Courier Date</label>
                                        <input type="text" class="form-control " name="courier_date"
                                            placeholder="Enter Date" value="{{ $order->courier_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ $order->shipping_address_id == null ? 'Billing and Shipping Address' : 'Billing Address' }}
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">User Name</label>
                                    <input type="text" name="user_name" id="inputEstimatedBudget" class="form-control"
                                        value="{{ $order->user_name }}" step="1">
                                </div>

                                <div class="form-group">
                                    <label for="inputSpentBudget">Email</label>
                                    <input type="email" name="email" id="inputSpentBudget" class="form-control"
                                        value="{{ $order->email }}" step="1">
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Phone</label>
                                    <input type="text" name="phone" id="inputEstimatedDuration" class="form-control"
                                        value="{{ $order->phone }}" step="0.1">
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">State</label>
                                    <input type="text" name="state" id="inputEstimatedDuration" class="form-control"
                                        value="{{ $order->state }}" step="0.1">
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">City</label>
                                    <input type="text" name="city" id="inputEstimatedDuration" class="form-control"
                                        value="{{ $order->city }}" step="0.1">
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Pincode</label>
                                    <input type="number" name="pincode" id="inputEstimatedDuration" class="form-control"
                                        value="{{ $order->pincode }}" step="0.1">
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Address</label>
                                    <textarea name="address" class="form-control"cols="4" rows="4">{{ $order->address }}</textarea>
                                </div>
                            </div>
                        </div>

                        @if ($order->shipping_address_id)
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Shipping Address</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="shipping_address[id]" id="inputEstimatedBudget"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->id }}">
                                    <input type="hidden" name="shipping_address[user_id]" id="inputEstimatedBudget"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->user_id }}">

                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">User Name</label>
                                        <input type="text" name="shipping_address[user_name]"
                                            id="inputEstimatedBudget" class="form-control"
                                            value="{{ json_decode($order->shipping_address)->user_name }}"
                                            step="1">
                                    </div>



                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Phone</label>
                                        <input type="text" name="shipping_address[phone]" id="inputEstimatedDuration"
                                            class="form-control"
                                            value="{{ json_decode($order->shipping_address)->phone }}" step="0.1">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">State</label>
                                        <input type="text" name="shipping_address[state]" id="inputEstimatedDuration"
                                            class="form-control"
                                            value="{{ json_decode($order->shipping_address)->state }}" step="0.1">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">City</label>
                                        <input type="text" name="shipping_address[city]" id="inputEstimatedDuration"
                                            class="form-control"
                                            value="{{ json_decode($order->shipping_address)->city }}" step="0.1">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Pincode</label>
                                        <input type="number" name="shipping_address[pincode]"
                                            id="inputEstimatedDuration" class="form-control"
                                            value="{{ json_decode($order->shipping_address)->pincode }}" step="0.1">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Address</label>
                                        <textarea name="shipping_address[address]" class="form-control"cols="4" rows="4">{{ json_decode($order->shipping_address)->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 mb-5">
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
