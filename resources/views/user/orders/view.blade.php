@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>

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
                                <th>#</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach (json_decode($order->products) as $key => $product)
                                <tr>
                                    <td>{{ $index++ }}.</td>
                                    <td><img height="50px" width="50px" src="{{ uploaded_asset($product->image) }}"
                                            class="img-fluid">
                                    </td>
                                    <td style="width: 300px">{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td><span
                                            class="badge bg-warning">{{ get_setting('symbol') }}{{ $product->net_amount }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($order->main_amount)
                                <tr>
                                    <td><span class="badge bg-info">Coupon Code:</span></td>
                                    <td><span class="badge bg-dark">{{ $order->coupon_code }}</span></td>
                                    <td></td>
                                    <td><span
                                            class="badge bg-warning">{{ get_setting('symbol') }}{{ $order->net_amount - $order->main_amount + $order->courier_amount }}
                                        </span></td>
                                </tr>
                            @endif
                            @if ($order->delivery_by == 'Courier')
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Courier Amount</td>
                                    <td></td>
                                    <td>
                                        <span class="badge bg-warning">{{ get_setting('symbol') }}
                                            {{ $order->courier_amount }}
                                        </span>
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Amount</td>
                                <td></td>
                                <td>
                                    <span class="badge bg-warning">{{ get_setting('symbol') }}

                                        @if ($order->main_amount)
                                            {{ $order->main_amount + $order->courier_amount }}
                                        @else
                                            {{ $order->net_amount + $order->courier_amount }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>


        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order Detail</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Order Id</label>
                                <input type="text" id="inputName" class="form-control" value="{{ $order->order_id }}"
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus">Payment Type</label>
                                <select name="payment_by" class="form-control" disabled>
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
                                                value="{{ $order->payment_status }}" readonly >
                                    
                                    
                                </div>


                            <div class="form-group">
                                <label>Order Status</label>
                                <select name="status" class="form-control" disabled>
                                    <option value="0"{{ $order->status == 0 ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"{{ $order->status == 1 ? 'selected' : '' }}>
                                        Delivered</option>

                                    <option value="3"{{ $order->status == 3 ? 'selected' : '' }}>
                                        Confirmed</option>

                                    <option value="4"{{ $order->status == 4 ? 'selected' : '' }}>
                                        On Delivery</option>

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
                    @if ($order->courier_company)
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
                                            value="{{ $order->courier_company }}" disabled>
                                    </div>
                                    <div class="col-lg-12 p-2">
                                        <label>Tracking No</label>
                                        <input type="text" class="form-control" name="tracking_no"
                                            placeholder="Tracking No" value="{{ $order->tracking_no }}" disabled>

                                    </div>
                                    <div class="col-lg-12 p-2">
                                        <label>Courier Date</label>
                                        <input type="text" class="form-control " name="courier_date"
                                            placeholder="Enter Date" value="{{ $order->courier_date }}" disabled>

                                    </div>

                                </div>

                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Bill To</h3>
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
                                    value="{{ $order->user_name }}" step="1" readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputSpentBudget">Email</label>
                                <input type="email" name="email" id="inputSpentBudget" class="form-control"
                                    value="{{ $order->email }}" step="1" readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">Phone</label>
                                <input type="text" name="phone" id="inputEstimatedDuration" class="form-control"
                                    value="{{ $order->phone }}" step="0.1"readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">State</label>
                                <input type="text" name="state" id="inputEstimatedDuration" class="form-control"
                                    value="{{ $order->state }}" step="0.1"readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">City</label>
                                <input type="text" name="city" id="inputEstimatedDuration" class="form-control"
                                    value="{{ $order->city }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">Pincode</label>
                                <input type="text" name="pincode" id="inputEstimatedDuration" class="form-control"
                                    value="{{ $order->pincode }}"  readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">Address</label>
                                <textarea name="address" class="form-control"cols="4" rows="4" readonly>{{ $order->address }}</textarea>
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
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">User Name</label>
                                    <input type="text" name="user_name" id="inputEstimatedBudget"
                                        class="form-control"
                                        value="{{ json_decode($order->shipping_address)->user_name }}" step="1"
                                        readonly>
                                </div>



                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Phone</label>
                                    <input type="text" name="phone" id="inputEstimatedDuration"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->phone }}"
                                        step="0.1"readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">State</label>
                                    <input type="text" name="state" id="inputEstimatedDuration"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->state }}"
                                        step="0.1"readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">City</label>
                                    <input type="text" name="city" id="inputEstimatedDuration"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->city }}"
                                        step="0.1" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Pincode</label>
                                    <input type="text" name="pincode" id="inputEstimatedDuration"
                                        class="form-control" value="{{ json_decode($order->shipping_address)->pincode }}"
                                        step="0.1" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Address</label>
                                    <textarea name="address" class="form-control"cols="4" rows="4" readonly>{{ json_decode($order->shipping_address)->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    @else
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
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">User Name</label>
                                    <input type="text" name="user_name" id="inputEstimatedBudget"
                                        class="form-control" value="{{ $order->user_name }}" step="1" readonly>
                                </div>


                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Phone</label>
                                    <input type="text" name="phone" id="inputEstimatedDuration"
                                        class="form-control" value="{{ $order->phone }}" step="0.1"readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">State</label>
                                    <input type="text" name="state" id="inputEstimatedDuration"
                                        class="form-control" value="{{ $order->state }}" step="0.1"readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">City</label>
                                    <input type="text" name="city" id="inputEstimatedDuration"
                                        class="form-control" value="{{ $order->city }}" step="0.1" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Pincode</label>
                                    <input type="text" name="pincode" id="inputEstimatedDuration"
                                        class="form-control" value="{{ $order->pincode }}" step="0.1" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputEstimatedDuration">Address</label>
                                    <textarea name="address" class="form-control"cols="4" rows="4" readonly>{{ $order->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>

        </section>

    </div>
@endsection
