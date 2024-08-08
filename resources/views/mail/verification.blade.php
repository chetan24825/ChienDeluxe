<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Simple Transactional Email</title>
    <style media="all" type="text/css">
        /* -------------------------------------
        GLOBAL RESETS
        ------------------------------------- */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: "Inter", sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
            line-height: 1.3;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: "Inter", sans-serif;
            font-size: 16px;
            vertical-align: top;
        }

        /* -------------------------------------
        BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f4f5f6;
            margin: 0;
            padding: 0;
        }

        .body {
            background-color: #f4f5f6;
            width: 100%;
        }

        .container {
            margin: 0 auto !important;
            max-width: 600px;
            padding: 0;
            padding-top: 24px;
            width: 600px;
        }

        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 600px;
            padding: 0;
        }

        /* -------------------------------------
        HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #ffffff;
            border: 1px solid #eaebed;
            border-radius: 16px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 24px;
        }

        .footer {
            clear: both;
            padding-top: 12px;
            text-align: center;
            width: 100%;
            padding-bottom: 10px;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #9a9ea6;
            font-size: 16px;
            text-align: center;
        }

        /* -------------------------------------
        TYPOGRAPHY
        ------------------------------------- */
        p {
            font-family: "Inter", sans-serif;
            font-size: 16px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 16px;
        }

        a {
            color: #0867ec;
            text-decoration: underline;
        }

        /* -------------------------------------
        BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            min-width: 100% !important;
            width: 100%;
        }

        .btn>tbody>tr>td {
            padding-bottom: 16px;
        }

        .btn table {
            width: auto;
        }

        .btn table td {
            background-color: #ffffff;
            border-radius: 4px;
            text-align: center;
        }

        .btn a {
            background-color: #ffffff;
            border: solid 2px #0867ec;
            border-radius: 4px;
            box-sizing: border-box;
            color: #0867ec;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            padding: 12px 24px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: #0867ec;
        }

        .btn-primary a {
            background-color: #0867ec;
            border-color: #0867ec;
            color: #ffffff;
        }

        .email-text h3 {
            text-align: center;
            font-size: 1.3rem;
            margin: 10px 0px;
            font-weight: 600;
            color: #333;
        }

        .email-text h4 {
            text-align: center;
            font-size: 1.2rem;
            margin: 10px 0px;
            font-weight: 600;
            color: #333;
        }

        p.time-zone {
            text-align: center;
            color: #4e4d4d;
            font-weight: 500;
        }

        td.item-type {
            width: 100%;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 4px 0px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        tr.total .item-type {
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
            padding: 6px 0px;
            font-size: 1.1rem;
        }

        tr.subtotal {
            color: #6a6767;
        }

        a.view-btn {
            background: #f44f08;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 10px auto;
        }

        p.tagline {
            margin-bottom: 0px;
            text-align: center;
            font-weight: 500;
        }

        span.apple-link {
            font-weight: 600;
            margin-bottom: 20px;
        }

        @media all {
            .btn-primary table td:hover {
                background-color: #ec0867 !important;
            }

            .btn-primary a:hover {
                background-color: #ec0867 !important;
                border-color: #ec0867 !important;
            }
        }

        /* -------------------------------------
        OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .text-link {
            color: #0867ec !important;
            text-decoration: underline !important;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 640px) {

            .main p,
            .main td,
            .main span {
                font-size: 16px !important;
            }

            .wrapper {
                padding: 8px !important;
            }

            .content {
                padding: 0 !important;
            }

            .container {
                padding: 0 !important;
                padding-top: 8px !important;
                width: 100% !important;
            }

            .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            .btn table {
                max-width: 100% !important;
                width: 100% !important;
            }

            .btn a {
                font-size: 16px !important;
                max-width: 100% !important;
                width: 100% !important;
            }
        }

        /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
        }


        td.item-type {
            width: 100%;
            display: table;
            border-bottom: 1px solid #eee;
            padding: 4px 0;
            margin-bottom: 10px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .item-name {
            display: inline-block;
            width: 70%;
        }

        .item-price {
            display: inline-block;
            width: 30%;
            text-align: right;
        }

        a.view-btn {
            background: #f44f08;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">
                        <!-- START MAIN CONTENT AREA -->
                        <tr>

                            <td class="wrapper email-text">
                                <center><img src="{{ uploaded_asset(get_setting('web_logo')) }}" width="160">
                                </center>
                                <h3>Thank you for your business!</h3>
                                <h4>Your Order No {{$order['order']->order_id }}</h4>
                                <p class="time-zone">
                                    {{ date('l, M j Y \a\t g.ia', strtotime($order['order']->created_at)) }}
                                </p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left">
                                                <table role="presentation" border="0" cellpadding="0"
                                                    cellspacing="0">
                                                    <tbody>
                                                        @foreach (json_decode($order['order']->products) as $product)
                                                            <tr>
                                                                <td class="item-type">
                                                                    <div class="item-name">
                                                                        {{ Str::words($product->product_name,6, '...') }}
                                                                    </div>
                                                                    <div class="item-price">{{get_setting('symbol')}}{{ $product->net_amount }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr class="subtotal">
                                                            <td class="item-type">
                                                                <div class="item-name">Subtotal</div>
                                                                <div class="item-price">
                                                                    {{get_setting('symbol')}}{{ $order['order']->net_amount }}</div>
                                                            </td>
                                                        </tr>
                                                        <tr class="subtotal">
                                                            <td class="item-type">
                                                                <div class="item-name">Shipping Amount</div>
                                                                <div class="item-price">
                                                                    {{get_setting('symbol')}}{{ $order['order']->courier_amount }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="total">
                                                            <td class="item-type">
                                                                <div class="item-name">Total</div>
                                                                <div class="item-price">
                                                                    {{get_setting('symbol')}}{{ $order['order']->courier_amount + $order['order']->net_amount }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h4>Your Details</h4><br>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="item-type">
                                                                <div class="item-name">Shipping to</div>
                                                                <div class="item-price">
                                                                    {{ $order['order']->shipping_address_id == null ? $order['order']->state . ', ' . $order['order']->city . ', ' . $order['order']->address : json_decode($order['order']->shipping_address)->state . ', ' . json_decode($order['order']->shipping_address)->city . ', ' . json_decode($order['order']->shipping_address)->address }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="item-type">
                                                                <div class="item-name">Billing to</div>
                                                                <div class="item-price">
                                                                    {{ $order['order']->state . ', ' . $order['order']->city . ', ' . $order['order']->address }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none; text-align: center; margin: 30px;">
                                                                <a href="{{ route('home') }}" class="view-btn">View My
                                                                    Account</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="tagline">Thanks for being a great customer!</p>
                            </td>
                        </tr>
                        <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- START FOOTER -->
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Cup Of Deals</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
