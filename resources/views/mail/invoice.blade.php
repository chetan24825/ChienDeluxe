<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice {{ env('APP_URL') }}</title>
    <meta http-equiv="Content-Type" content="text/html;" />
    <meta charset="UTF-8">
    <style media="all">
        @font-face {
            font-family: 'Roboto';
            src: url("{{ static_asset('front/fonts/maicons.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: 'Roboto';
            color: #333542;
        }

        body {
            font-size: .875rem;
        }

        .gry-color *,
        .gry-color {
            color: #878f9c;
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .5rem .7rem;
        }

        table.padding td {
            padding: .7rem;
        }

        table.sm-padding td {
            padding: .2rem .7rem;
        }

        .border-bottom td,
        .border-bottom th {
            border-bottom: 1px solid #eceff4;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: .85rem;
        }

        .currency {}
    </style>
</head>

<body>
    <div>
        @php
            $logo = $logo ?? get_setting('web_logo');
        @endphp
        <div style="background: #eceff4;padding: 1.5rem;">
            <table>
                <tr>
                    <td>
                        @if ($logo != null)
                            <img loading="lazy" src="{{ uploaded_asset($logo) }}" height="40"
                                style="display:inline-block;">
                        @else
                            <img loading="lazy" src="{{ static_asset('assets/img/logo.png') }}" height="40"
                                style="display:inline-block;">
                        @endif
                    </td>

                </tr>
            </table>
            <table>
                <tr>
                    <td style="font-size: 1.2rem;" class="strong">{{ get_setting('website_name') }}</td>
                    <td class="text-right">{{ get_setting('comany_address') }}</td>
                </tr>

                <tr>
                    <td class="gry-color small">Email : {{ get_setting('comany_email') }}</td>
                    <td class="text-right small"><span class="gry-color small">Order ID:</span> <span
                            class="strong">{{ $order->order_id }}</span></td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone : {{ get_setting('comany_phone') }}</td>
                    <td class="text-right small"><span class="gry-color small">Order Date :</span>
                        <span class=" strong">{{ date('d-m-Y', strtotime($order->created_at)) }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div style="padding: 1.5rem;padding-bottom: 0">
            <table>
                @php
                    $shipping_address = json_decode($order->shipping_address);
                @endphp
                <tr>
                    <td class="strong small gry-color">Bill to :</td>
                </tr>
                <tr>
                    <td class="strong">{{ $shipping_address->user_name ?? $order->user_name }}</td>
                </tr>


                <tr>
                    <td class="gry-color small">
                        {{ $shipping_address->city ?? $order->city }}, {{ $shipping_address->state ?? $order->state }}
                        ,{{ $shipping_address->pincode ?? $order->pincode }}
                        <br>
                        ({{ $shipping_address->address ?? $order->address }})
                    </td>
                </tr>
                <tr>
                    <td class="gry-color small"> Email : {{ $order->email }}</td>
                </tr>
                <tr>
                    <td class="gry-color small">Phone : {{ $shipping_address->phone ?? $order->phone }}</td>
                </tr>
            </table>
        </div>


        <div style="padding: 1.5rem;">
            <table class="padding text-left small border-bottom">
                <thead>
                    <tr class="gry-color" style="background: #eceff4;">
                        <th width="35%">Product Name</th>
                        <th width="15%">Delivery Type</th>
                        <th width="10%">Qty</th>
                        <th width="15%">Unit Price</th>
                        <th width="10%">Tax</th>
                        <th width="15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="strong">
                    @foreach (json_decode($order->products) as $key => $orderDetail)
                        <tr class="">
                            <td>{{ $orderDetail->product_name }}</td>
                            <td>
                                @if ($order->payment_by == 1)
                                    Cash On Delivery
                                @endif
                            </td>
                            <td class="gry-color">{{ $orderDetail->quantity }}</td>
                            <td class="gry-color currency">
                                Rs.{{ $orderDetail->rate }}/-</td>
                            <td class="gry-color currency">
                                0</td>
                            <td class="text-right currency">
                                Rs.{{ $orderDetail->net_amount }}/-</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:0 1.5rem;">
            <table style="width: 40%;margin-left:auto;" class="text-right sm-padding small strong">
                <tbody>
                    <tr>
                        <th class="gry-color text-left">Sub Total</th>
                        <td class="currency">Rs.{{ $order->net_amount }}/-</td>
                    </tr>
                    <tr>
                        <th class="gry-color text-left">Shipping Cost</th>
                        <td class="currency">{{ $order->courier_amount ?? '0' }}/-</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="gry-color text-left">Total Tax</th>
                        <td class="currency">0/-</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="gry-color text-left">Coupon</th>
                        <td class="currency">Rs.{{ ($order->coupon_code_amount / 100) * $order->net_amount }}/-</td>
                    </tr>


                    <tr>
                        <th class="text-left strong">Grand Total</th>
                        <td class="currency">
                            @if ($order->main_amount)
                                Rs.{{ ($order->main_amount ?? 0) + ($order->courier_amount ?? 0) }}/-
                            @else
                                Rs.{{ ($order->net_amount ?? 0) + ($order->courier_amount ?? 0) }}/-
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
