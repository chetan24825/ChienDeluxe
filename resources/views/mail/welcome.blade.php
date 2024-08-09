<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Welcome to cup of deals</title>
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


        /*
    .line {
    width: 100%;
    height: 1px;
    background: #eee;
    margin: 10px 0px;
} */

        .welcome-header {
            background: #eee;
            padding: 12px 0px;
            border-radius: 10px 10px 0px 0px;
        }

        .welcome-header img {
            background: #fff;
            padding: 10px 20px;
            margin-bottom: 0px;
            border-radius: 9px;
        }

        .welcome-msg {
            margin: 20px 0px;
        }

        .welcome-msg img {
            width: 90px;
        }

        .welcome-msg p {
            width: fit-content;
            background: #f44f08;
            color: #fff;
            margin: 0px auto;
            padding: 10px 27px;
            font-size: 0.95rem;
            border-radius: 42px;
            font-weight: 500;
        }

        a.user-name {
            text-decoration: none;
            color: #f44f08;
        }

        ul.login-detail li {
            margin: 6px 0px;
            border-bottom: 1px solid #e1dfdf;
        }

        ul.login-detail {
            padding: 0px;
            list-style: none;
            background: #f44f08;
            text-align: center;
            padding: 8px 19px;
            border-radius: 6px;
            width: fit-content;
            margin: 0px auto;
            display: flex;
            justify-content: center;
            box-sizing: border-box;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border: 1px solid #eee;
        }

        ul.login-detail li {
            padding: 4px 0px;
            border-bottom: 0px solid #e1dfdf;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0px 10px;
            color: #fff;
            border-right: 1px solid #eee;
        }

        ul.login-detail li:last-child {
            border: none;
        }

        ul.login-detail li a {
            /* text-decoration: none; */
            color: #f44f08;
        }

        .share-link {
            background: green;
            padding: 20px 20px;
            margin-top: 20px;
        }

        .share-link h3 {
            color: #fff;
            font-size: 1.5rem;
        }

        .share-link p {
            background: transparent;
            padding: 0px 63px;
            text-align: center;
            color: #fff;
        }

        .share-link a {
            background: #fff;
            padding: 10px 26px;
            margin: 0px auto;
            display: table;
            margin-top: 16px;
            border: 2px dashed #f44f08;
            font-weight: 600;
            color: #333;
        }

        ul.login-detail h3 {
            background: #f44f08;
            color: #fff;
            padding: 10px 0px;
            font-size: 1.2rem;
        }

        h5.acc-title {
            margin: 7px auto;
            width: fit-content;
            font-size: 1rem;
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
                                <div class="welcome-header">
                                    <center><img src="{{ asset('logo.png') }}" width="160"></center>
                                </div>
                                <div class="line"></div>

                                <div class="welcome-msg">
                                    <center><img src="{{ asset('celebrate.png') }}" width="160"></center>
                                    <h3>Welcome <a href="#" class="user-name">{{ $user['name'] }}</a> to The <a
                                            href="{{ route('/') }}" class="user-name">{{ config('app.name') }}</a>
                                    </h3>


                                    <h4>Here is Your Account Login Details</h4>

                                    <ul class="login-detail">
                                        <li>
                                            Username: <span>{{ $user['email'] }}</span>
                                        </li>
                                        <li>Password: <span>{{ $password }}</span></li>
                                    </ul>


                                </div>

                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td align="left">
                                                <table role="presentation" border="0" cellpadding="0"
                                                    cellspacing="0">
                                                    <tbody>

                                                        <tr>
                                                            <td class="item-type" style="border: none;">
                                                                <a href="{{ route('user.profile') }}"
                                                                    class="view-btn">My Profile</a>

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
                                    <span class="apple-link">{{ config('app.name') }}</span>

                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
