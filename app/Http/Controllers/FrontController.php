<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Lead;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Coupon;
use App\Models\Review;
use App\Mail\OrderMail;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserCart;
use App\Models\Subscribe;
use App\Models\CustomPage;
use App\Models\ContactLead;
use App\Mail\ContactEnquiry;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class FrontController extends Controller
{

    function toindex()
    {
        $products = Product::with('category')->where('status', 1)->orderby("id", "DESC")->orderby("stock", "DESC")->paginate(12);
        return view('fronts.pages.web', compact('products'));
    }


    function tocart()
    {
        $carts = session()->get('cart');
        return view('fronts.cart.cart', compact('carts'));
    }

    /**
     * Ajax Part are Given Below
     *
     */


    public function getRefId(Request $request)
    {
        $id = User::where('user_name', $request->ref_id)->first();
        if ($id == '') {
            return "<span class='help-block'><strong class='text-danger'>Sponsor ID Not Found</strong></span>";
        } else {
            return "<span class='help-block'><strong class='text-success'>Your Sponsor is: $id->name</strong></span>
                     <input type='hidden' id='referrer_id' value='$id->id' name='referrer_id'>";
        }
    }



    function  toaddcart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $product_id = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $product = Product::findOrFail($product_id);

        if ($quantity > $product->temp_stock) {
            return back()->with('warning', 'Requested quantity exceeds available stock!');
        }

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
            $cart[$product_id]['net_amount'] += $quantity * $product->sale_price;
        } else {
            $cart[$product_id] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'image' => $product->thumbphotos,
                'product_name' => $product->product_name,
                'net_amount' => $quantity * $product->sale_price,
                'rate' => $product->sale_price,
                'stock' => $product->stock,
            ];
        }

        $product->temp_stock -= $quantity;
        $product->save();

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }


    function toaddcartonchange(Request $request)
    {
        $cart = session()->get('cart');
        $product_id = $request->id;
        $newQuantity = $request->newQuantity > 0 ? $request->newQuantity : $cart[$product_id]['quantity'];

        $product = Product::findOrFail($product_id);

        if ($newQuantity > $product->stock) {

            return response()->json(['warning' => 'Requested quantity exceeds available stock!']);
        }

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $newQuantity;
            $cart[$product_id]['net_amount'] = $product->sale_price * $newQuantity;
        } else {
            $cart[$product_id] = [
                'product_id' => $product->id,
                'quantity' => $newQuantity,
                'image' => $product->thumbphotos,
                'product_name' => $product->product_name,
                'net_amount' => $product->sale_price * $newQuantity,
                'rate' => $product->sale_price,
            ];
        }

        $amount = $cart[$product_id]['net_amount'];


        $product->temp_stock = $newQuantity;
        $product->save();
        session()->put('cart', $cart);

        $htmlContent = View::make('fronts.cart.added_cart', compact('cart'))->render();

        return response()->json(['html' => $htmlContent, 'amount' => get_setting('symbol') . $amount]);
        // return back()->with('success', 'Cart updated successfully!');
    }



    function tocarddelete(Request $request)
    {
        $cart = session()->get('cart');
        $product_id =  $request->id;
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }
        $product = Product::findOrFail($product_id);
        $product->temp_stock = $product->stock;
        $product->save();

        $request->session()->put('cart', $cart);
        back()->with('success', 'Successfully Update!');
        return $cart;
    }



    function tocheckout()
    {
        $user = Auth::user();
        $carts = session()->get('cart');
        return view('fronts.checkout.checkout', compact('user', 'carts'));
    }

    public function get_city(Request $request)
    {
        $country_info = Country::where('name', $request->country_name)->first();
        $state_info = State::where('name', $request->state_name)->first();

        $cities = City::where('country_id', $country_info->id)->where('state_id', $state_info->id)->get();
        $html = '';

        foreach ($cities as $row) {
            //            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }


        echo json_encode($html);
    }

    public function get_state(Request $request)
    {
        $country_info = Country::where('name', $request->country_name)->first();

        $states = State::where('country_id', $country_info->id)->get();
        $html = '';

        foreach ($states as $row) {
            //            $val = $row->id . ' | ' . $row->name;
            $html .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }


        echo json_encode($html);
    }



    // function tocheckstore(Request $request)
    // {
    //     $this->validate($request, [
    //         "username" => 'required',
    //         "email" => "required|email",
    //         "mobile" => "required",
    //         "state" => "required",
    //         "city" => "required",
    //         "street_address" => "required",
    //         "post_code" => "required",
    //         "check" => "required",
    //     ]);


    //     $userdetails = [
    //         "name" => $request->username,
    //         "email" => $request->email,
    //         "mobile" => $request->mobile,
    //         "state" => $request->state,
    //         "city" => $request->city,
    //         "street_address" => $request->street_address,
    //         "post_code" => $request->post_code,
    //         "check" => $request->check,
    //     ];
    //     product_stock();
    //     $cart =  session()->get('cart');

    //     if ($cart !== null) {
    //         $cartCount = count($cart);
    //         if ($cartCount <= 0) {
    //             return redirect()->back()->with('warning', 'Cart Is Empty')->with('userdetail', $userdetails);
    //         }
    //     } else {
    //         return redirect()->back()->with('warning', 'Cart Is Empty')->with('userdetail', $userdetails);
    //     }

    //     $netAmounts = array_column($cart, 'net_amount');
    //     $totalNetAmount = array_sum($netAmounts);

    //     if ($totalNetAmount < 500) {
    //         return redirect()->back()->with('message_warning', 'Order Must be Minimun 500')->with('userdetail', $userdetails);
    //     }

    //     $lead = new Lead();
    //     $lead->user_name = $request->username;
    //     $lead->email = $request->email;
    //     $lead->phone = $request->mobile;
    //     $lead->address = $request->street_address;
    //     $lead->products = json_encode($cart);
    //     $lead->net_amount =   $totalNetAmount;

    //     $user = User::where('email', $request->email)->first();

    //     if ($user) {
    //         if (!auth()->check()) {
    //             $lead->error_reason = "Email Already Exist";
    //             $lead->save();
    //             return redirect()->back()->with('message', 'User Already Exist Please Login First')->with('userdetail', $userdetails);
    //         }
    //     } else {
    //         $user = new User();
    //         $user->name = $request->username;
    //         $user->email = $request->email;
    //         $user->referrer_id = 1;
    //         $user->mobile = $request->mobile;
    //         $user->street_address = $request->street_address;
    //         $user->post_code = $request->post_code;
    //         $user->password = Hash::make(123);
    //         if ($user->save()) {
    //             $idpre = 10000;
    //             $profileID = $idpre + $user->id;
    //             User::whereId($user->id)->update([
    //                 'user_name' => 'EWC' . $profileID,
    //             ]);
    //         }
    //     }

    //     if ($request->coupon) {
    //         $coupons = Coupon::where('coupen_name', $request->coupon)->where('status', 1)->where('share_with', '<>', 0)->first();

    //         if ((isset($coupons))) {
    //             $coupon_code = $request->coupon;
    //             $main_amount = $request->main_amount;
    //             $coupon_code_amount = $request->coupen_amount;
    //         } else {
    //             $lead->error_reason = "Coupen Error";
    //             $lead->save();
    //             if (!auth()->check()) {
    //                 Auth::login($user);
    //                 toastr()->warning('Coupen Not Valid Try Again Another');
    //                 return redirect('/user/home')->with('success', 'You are now Impersonating ' . $user->name);
    //             }
    //             toastr()->warning('Coupen Not Valid');
    //             return redirect()->back();
    //         }
    //     }


    //     $lead->save();

    //     $order = new Order();
    //     $order->user_name = $request->username;
    //     $order->email =    $request->email;
    //     $order->phone =    $request->mobile;
    //     $order->state =    $request->state;
    //     $order->city =     $request->city;
    //     $order->address =  $request->street_address;
    //     $order->pincode =  $request->post_code;
    //     $order->delivery_by = $request->delivered == 1 ? "Courier" : "Self";
    //     $order->courier_amount = $request->delivered == 1 ? get_setting('shipping_charge') : null;


    //     if ($request->same_as_shipping && $request->same_as_shipping != "same_as_shipping") {
    //         $order->shipping_address_id = isset($request->same_as_shipping) ?? $request->same_as_shipping;
    //         $ShippingAddress = ShippingAddress::find($request->same_as_shipping);
    //         $order->shipping_address = json_encode($ShippingAddress);
    //     }

    //     $order->order_id =  uniqid();
    //     $order->user_id =  Auth::user()->id ?? $user->id;

    //     $order->coupon_code =  isset($coupon_code) ? $coupon_code : null;
    //     $order->coupon_code_amount =  isset($coupon_code_amount) ? $coupon_code_amount : null;
    //     $order->main_amount =  isset($main_amount) ? $main_amount : null;


    //     $order->products = json_encode($cart);
    //     $order->net_amount =   $totalNetAmount;
    //     if ($order->save()) {

    //         $userUpdate = User::find(Auth::user()->id ?? $user->id);
    //         $userUpdate->mobile = $userUpdate->mobile ?? $request->mobile;
    //         $userUpdate->state = $userUpdate->state ?? $request->state;
    //         $userUpdate->city = $userUpdate->city ?? $request->city;
    //         $userUpdate->street_address = $userUpdate->street_address ?? $request->street_address;
    //         $userUpdate->post_code = $userUpdate->post_code ?? $request->post_code;
    //         $userUpdate->save();

    //         $lead = Lead::find($lead->id);
    //         $lead->status = 1;
    //         $lead->order_id = $order->id;
    //         $lead->error_reason = "Order Complete";
    //         $lead->save();
    //         stock_maintain($cart);
    //         if ($request->payment_status == 1) {
    //             $url = config('cashfree.mode') === 'test' ? config('cashfree.urls.test') : config('cashfree.urls.production');
    //             $ch = curl_init();
    //             $gate_way_amount = $request->delivered == 1 ? $totalNetAmount + get_setting('shipping_charge') : $totalNetAmount;
    //             $orderData = [
    //                 'order_id' => $order->order_id, // Replace with your unique order ID
    //                 'order_amount' =>  $gate_way_amount, // Replace with the order amount
    //                 'order_currency' => 'INR',
    //                 'customer_details' => [
    //                     "customer_id" => 'customer_' . rand(111111111, 999999999),
    //                     "customer_name" => $request->input('username'),
    //                     "customer_email" => $request->input('email'),
    //                     "customer_phone" => $request->input('mobile')
    //                 ],
    //                 "order_meta" => [
    //                     "return_url" => 'https://cupofdeals.com/cashfree/payments/success/?order_id={order_id}',
    //                     // "notify_url" => 'http://localhost/project/webhook/cashfree/{order_id}',
    //                 ]

    //             ];


    //             $response = Http::withHeaders([
    //                 'X-Client-Id' => env('CASHFREE_APP_ID'),
    //                 'X-Client-Secret' => env('CASHFREE_SECRET_KEY'),
    //                 'x-api-version' => '2023-08-01',
    //                 'Accept' => 'application/json',
    //                 'Content-Type' => 'application/json',
    //             ])->post($url . '/orders', $orderData);

    //             if ($response->successful()) {
    //                 $responseData = $response->json();

    //                 $session_id = $responseData['payment_session_id'];
    //                 return view('fronts.checkout.cashfree', compact('session_id'));
    //                 exit;
    //             }
    //         } else {
    //             orderMail($order);
    //             if (Auth::check()) {
    //                 session()->forget('cart');
    //                 UserCart::where('user_id', Auth::user()->id)->delete();
    //                 return redirect()->route('thankyou');
    //             }

    //             if (!auth()->check()) {
    //                 session()->forget('cart');
    //                 Auth::loginUsingId($order->user_id);
    //                 UserCart::where('user_id', $order->user_id)->delete();
    //                 return redirect()->route('thankyou');
    //             }
    //             return redirect()->route('thankyou');
    //         }
    //     }
    // }

    function tocheckstore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'post_code' => 'required',
            'check' => 'required',
        ]);


        $userdetails = [
            "name" => $request->username,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "state" => $request->state,
            "city" => $request->city,
            "street_address" => $request->street_address,
            "post_code" => $request->post_code,
            "check" => $request->check,
        ];

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('userdetail', $userdetails);
        }


        product_stock();
        $cart =  session()->get('cart');

        if ($cart !== null) {
            $cartCount = count($cart);
            if ($cartCount <= 0) {
                return redirect()->back()->with('warning', 'Cart Is Empty')->with('userdetail', $userdetails);
            }
        } else {
            return redirect()->back()->with('warning', 'Cart Is Empty')->with('userdetail', $userdetails);
        }

        $netAmounts = array_column($cart, 'net_amount');
        $totalNetAmount = array_sum($netAmounts);

        if ($totalNetAmount < 500) {
            return redirect()->back()->with('message_warning', 'Order Must be Minimun 500')->with('userdetail', $userdetails);
        }

        $lead = new Lead();
        $lead->user_name = $request->username;
        $lead->email = $request->email;
        $lead->phone = $request->mobile;
        $lead->address = $request->street_address;
        $lead->products = json_encode($cart);
        $lead->net_amount =   $totalNetAmount;

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (!auth()->check()) {
                $lead->error_reason = "Email Already Exist";
                $lead->save();
                return redirect()->back()->with('message', 'User Already Exist Please Login First')->with('userdetail', $userdetails);
            }
        } else {
            $user = new User();
            $user->name = $request->username;
            $user->email = $request->email;
            $user->referrer_id = 1;
            $user->mobile = $request->mobile;
            $user->street_address = $request->street_address;
            $user->post_code = $request->post_code;
            $user->password = Hash::make(123);
            if ($user->save()) {
                $idpre = 10000;
                $profileID = $idpre + $user->id;
                User::whereId($user->id)->update([
                    'user_name' => 'EWC' . $profileID,
                ]);
            }
        }

        if ($request->coupon) {
            $coupons = Coupon::where('coupen_name', $request->coupon)->where('status', 1)->where('share_with', '<>', 0)->first();

            if ((isset($coupons))) {
                $coupon_code = $request->coupon;
                $main_amount = $request->main_amount;
                $coupon_code_amount = $request->coupen_amount;
            } else {
                $lead->error_reason = "Coupen Error";
                $lead->save();
                if (!auth()->check()) {
                    Auth::login($user);
                    toastr()->warning('Coupen Not Valid Try Again Another');
                    return redirect('/user/home')->with('success', 'You are now Impersonating ' . $user->name);
                }
                toastr()->warning('Coupen Not Valid');
                return redirect()->back();
            }
        }


        $lead->save();

        $order = new Order();
        $order->user_name = $request->username;
        $order->email =    $request->email;
        $order->phone =    $request->mobile;
        $order->state =    $request->state;
        $order->city =     $request->city;
        $order->address =  $request->street_address;
        $order->pincode =  $request->post_code;
        $order->delivery_by = $request->delivered == 1 ? "Courier" : "Self";
        $order->courier_amount = $request->delivered == 1 ? get_setting('shipping_charge') : null;


        if ($request->same_as_shipping && $request->same_as_shipping != "same_as_shipping") {
            $order->shipping_address_id = isset($request->same_as_shipping) ?? $request->same_as_shipping;
            $ShippingAddress = ShippingAddress::find($request->same_as_shipping);
            $order->shipping_address = json_encode($ShippingAddress);
        }

        $order->order_id =  uniqid();
        $order->user_id =  Auth::user()->id ?? $user->id;

        $order->coupon_code =  isset($coupon_code) ? $coupon_code : null;
        $order->coupon_code_amount =  isset($coupon_code_amount) ? $coupon_code_amount : null;
        $order->main_amount =  isset($main_amount) ? $main_amount : null;


        $order->products = json_encode($cart);
        $order->net_amount =   $totalNetAmount;
        if ($order->save()) {

            $userUpdate = User::find(Auth::user()->id ?? $user->id);
            $userUpdate->mobile = $userUpdate->mobile ?? $request->mobile;
            $userUpdate->state = $userUpdate->state ?? $request->state;
            $userUpdate->city = $userUpdate->city ?? $request->city;
            $userUpdate->street_address = $userUpdate->street_address ?? $request->street_address;
            $userUpdate->post_code = $userUpdate->post_code ?? $request->post_code;
            $userUpdate->save();

            $lead = Lead::find($lead->id);
            $lead->status = 1;
            $lead->order_id = $order->id;
            $lead->error_reason = "Order Complete";
            $lead->save();
            stock_maintain($cart);
            orderMail($order);

            if ($request->payment_status == 1) {
                $url = config('cashfree.mode') === 'test' ? config('cashfree.urls.test') : config('cashfree.urls.production');
                $ch = curl_init();
                $gate_way_amount = $request->delivered == 1 ? $totalNetAmount + get_setting('shipping_charge') : $totalNetAmount;
                $orderData = [
                    'order_id' => $order->order_id, // Replace with your unique order ID
                    'order_amount' =>  $gate_way_amount, // Replace with the order amount
                    'order_currency' => 'INR',
                    'customer_details' => [
                        "customer_id" => 'customer_' . rand(111111111, 999999999),
                        "customer_name" => $request->input('username'),
                        "customer_email" => $request->input('email'),
                        "customer_phone" => $request->input('mobile')
                    ],
                    "order_meta" => [
                        "return_url" => url('/cashfree/payments/success/?order_id={order_id}'),
                        // "notify_url" => 'http://localhost/project/webhook/cashfree/{order_id}',
                    ]
                    // Add other required order parameters here
                ];


                $response = Http::withHeaders([
                    'X-Client-Id' => env('CASHFREE_APP_ID'),
                    'X-Client-Secret' => env('CASHFREE_SECRET_KEY'),
                    'x-api-version' => '2023-08-01',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])->post($url . '/orders', $orderData);

                if ($response->successful()) {
                    $responseData = $response->json();

                    $session_id = $responseData['payment_session_id'];
                    return view('fronts.checkout.cashfree', compact('session_id'));
                    exit;
                }
            }

            // else {
            //     orderMail($order);
            //     if (Auth::check()) {
            //         session()->forget('cart');
            //         UserCart::where('user_id', Auth::user()->id)->delete();
            //         return redirect()->route('thankyou');
            //     }

            //     if (!auth()->check()) {
            //         session()->forget('cart');
            //         Auth::loginUsingId($order->user_id);
            //         UserCart::where('user_id', $order->user_id)->delete();
            //         return redirect()->route('thankyou');
            //     }
            //     return redirect()->route('thankyou');
            // }
        }
    }

    // public function cashfreeSuccess(Request $request)
    // {
    //     $url = config('cashfree.mode') === 'test' ? config('cashfree.urls.test') : config('casfree.urls.production');
    //     $response = Http::withHeaders([
    //         'accept' => 'application/json',
    //         'x-api-version' => '2023-08-01',
    //         'X-Client-Id' => config('cashfree.app_id'),
    //         'X-Client-Secret' => config('cashfree.secret_key')
    //     ])->get($url . '/orders/' . $request->get('order_id') . '/payments');

    //     $payments = $response->json();

    //     if ($response->successful()) {
    //         $payments = $response->json();
    //         $order = Order::where('order_id', $request->get('order_id'))->first();
    //         $order->payment_status = $payments[0]['payment_status'] ?? '';
    //         $order->payment_by = 0;
    //         if ($order->save()) {
    //             orderMail($order);
    //             if (Auth::check()) {
    //                 session()->forget('cart');
    //                 UserCart::where('user_id', Auth::user()->id)->delete();
    //                 return redirect()->route('thankyou')->with('orderid', $request->get('order_id'));
    //             }

    //             if (!auth()->check()) {
    //                 session()->forget('cart');
    //                 Auth::loginUsingId($order->user_id);
    //                 UserCart::where('user_id', $order->user_id)->delete();

    //                 return redirect()->route('thankyou')->with('orderid', $request->get('order_id'));
    //             }
    //             return redirect()->route('thankyou')->with('orderid', $request->get('order_id'));
    //         }
    //     } else {
    //         $error = $response->json();
    //         dd($error);
    //     }
    // }

    public function cashfreeSuccess(Request $request)
    {
        $url = config('cashfree.mode') === 'test' ? config('cashfree.urls.test') : config('casfree.urls.production');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'x-api-version' => '2023-08-01',
            'X-Client-Id' => config('cashfree.app_id'),
            'X-Client-Secret' => config('cashfree.secret_key')
        ])->get($url . '/orders/' . $request->get('order_id') . '/payments');

        $payments = $response->json();

        if ($response->successful()) {
            $payments = $response->json();
            $order = Order::where('order_id', $request->get('order_id'))->first();
            $order->payment_status = $payments[0]['payment_status'] ?? '';
            $order->payment_by = 0;

            if ($order->save()) {
                if (Auth::check()) {
                    session()->forget('cart');
                    UserCart::where('user_id', Auth::user()->id)->delete();
                    return redirect()->route('thankyou', ['id' => $order->order_id]);
                }

                if (!auth()->check()) {
                    session()->forget('cart');
                    Auth::loginUsingId($order->user_id);
                    UserCart::where('user_id', $order->user_id)->delete();

                    return redirect()->route('thankyou', ['id' => $order->order_id]);
                }
                return redirect()->route('thankyou', ['id' => $order->order_id]);
            }
        } else {
            $error = $response->json();
            dd($error);
        }
    }

    public function handleCashfreeWebhook(Request $request)
    {
        Log::info('Received Cashfree webhook payload: ' . $request->getContent());
        $payload = json_decode($request->getContent(), true);
    }

    function tocouponcode(Request $request)
    {
        $cart =  session()->get('cart');
        $netAmounts = array_column($cart, 'net_amount');
        $totalNetAmount = array_sum($netAmounts);

        $coupon = Coupon::where('coupen_name', $request->coupen_code)->where('status', 1)->first();

        if ($cart == null) {
            return "<span class='help-block pl-2'><strong class='text-danger'>Cart Is Empty </strong></span>";
        }
        if ($coupon == '') {
            return "<span class='help-block pl-2'><strong class='text-danger'>Coupen is Not Valid </strong></span>";
        } else {
            $amount = ($coupon->coupen_amount  / 100) * $totalNetAmount;
            $main_amount = $totalNetAmount - $amount;
            return "<span class='help-block pl-2'><strong class='text-success'>Coupen is Valid : $coupon->coupen_amount% Discount</strong></span><br><br>
            <input type='hidden' id='main_amount'  value='$main_amount' name='main_amount' readonly>
            <input type='hidden' id='coupen_amount' value='$coupon->coupen_amount' name='coupen_amount'>
             <ul><li>Main Total:<span> Rs.$main_amount/-</span></li> </ul>
            ";
        }
    }

    function toproduct()
    {
        $products = Product::where('status', 1)
            ->orderBy("stock", "DESC")
            ->orderby('id', 'DESC')->paginate(32);
        return view('fronts.product.product', compact('products'));
    }

    function toproductdetail($slug)
    {
        $products = Product::where('product_slug', $slug)
            ->with(['category', 'reviews' => function ($query) {
                $query->where('status', 1);
            }])->firstOrFail();

        $productInCart = null;
        if ($products) {
            $cart2 =  session()->get('cart');
            if ($cart2 && array_key_exists($products->id, $cart2)) {
                $productInCart = $cart2[$products->id];
            }

            $relate_products = Product::where('status', 1)->orWhere('category_id', $products->category_id)
                ->orderby('stock', 'DESC')
                ->orderby('id', 'DESC')->take(6)->get();
            return view('fronts.product.detail', compact('products', 'relate_products', 'productInCart'));
        }
        return redirect()->to('/')->with('info', 'Product Doesnot Exist');
    }



    function tocategorydetail($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        if ($category) {
            $products = Product::where('category_id', $category->id)
                ->paginate(20);
            return view('fronts.category.category_product', compact('products'));
        } else {
            abort(404, 'Category not found');
        }
    }

    function tocontactus()
    {
        return view('fronts.contactus.contactus');
    }

    function tocontactemail(Request $request)
    {
        // $this->validate($request, [
        //     "g-recaptcha-response" => "required"
        // ]);
        $this->validate($request, [
            "username" => "required",
            "email" => "required",
            "phone" => "required",
            "message" => "required",
        ]);

        $lead = new ContactLead();
        $lead->contact_name = $request->username;
        $lead->contact_email = $request->email;
        $lead->contact_phone = $request->phone;
        $lead->contact_message = $request->message;
        $lead->save();

        $data = [
            "username" => $request->username,
            "email" => $request->email,
            "phone" => $request->phone,
            "subject" => $request->subject,
            "message" => $request->message,
        ];
        // Mail::to(['chetankumar24825@gmail.com', 'banotra@gmail.com'])->send(new ContactEnquiry($data));
        return redirect()->back()->with('success', "Thank you for reaching out, our team representative will reply you soon");
    }


    function toShippingAddress(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'post_code' => 'required',
        ]);
        $ShippingAddress = new ShippingAddress();
        $ShippingAddress->user_name =    $request->user_name;
        $ShippingAddress->phone =    $request->mobile;
        $ShippingAddress->user_id = Auth::user()->id;
        $ShippingAddress->state =    $request->state;
        $ShippingAddress->city =     $request->city;
        $ShippingAddress->address =  $request->street_address;
        $ShippingAddress->pincode =  $request->post_code;
        $ShippingAddress->country =  $request->country;
        if ($ShippingAddress->save()) {
            return redirect()->back()->with('success', "Add SuccessFully");
        }
    }

    function toShippingAddressUpdate(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'post_code' => 'required',
            'shipping_id' => 'required',
        ]);
        $ShippingAddress = ShippingAddress::findorFail($request->shipping_id);
        $ShippingAddress->user_name =    $request->user_name;
        $ShippingAddress->phone =    $request->mobile;
        $ShippingAddress->user_id = Auth::user()->id;
        $ShippingAddress->state =    $request->state;
        $ShippingAddress->city =     $request->city;
        $ShippingAddress->address =  $request->street_address;
        $ShippingAddress->pincode =  $request->post_code;
        $ShippingAddress->country =  $request->country;
        if ($ShippingAddress->save()) {
            return redirect()->back()->with('success', "Update SuccessFully");
        }
    }

    function toshippingdelete(Request $request)
    {
        $ShippingAddress = ShippingAddress::find($request->id);
        if ($ShippingAddress) {
            $ShippingAddress->delete();
            back()->with('success', 'Delete successfully!');
            return response()->json(['success' => true, 'message' => 'Delete successfully']);
        }
        back()->with('warning', 'Record doesnot Exist in Wishlist');
        return response()->json(['error' => true, 'message' => 'User not authenticated']);
    }


    function totrack(Request $request)
    {
        if ($request->order_id) {
            $order = Order::where('order_id', $request->order_id)->first();
            if ($order) {
                return view('fronts.order_track.order_track', compact('order'));
            }
            return redirect()->back()->with('warning', 'Order does not Exist');
        } else {
            return view('fronts.order_track.order_track');
        }
    }

    function tosearchproduct(Request $request)
    {
        try {
            // $category = Category::where('slug', $request->category)->firstOrFail();
            $products = Product::where('status', 1)
                // ->where('category_id', $category->id)
                ->where('product_name', 'like', '%' . $request->product_name . '%')
                ->orderBy('id', 'DESC')
                ->paginate(30);

            // $cateId = $request->category;
            $searchProduct = $request->product_name;
            return view('fronts.product.product', compact('products', 'searchProduct'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Product not found.', $e);
        }
    }



    function toverification()
    {
        $order = Order::where('order_id', '65c74f30a0629')->first();
        return view('mail.verification', compact('order'));
    }

    function tocustompage($slug)
    {
        $page = CustomPage::where('slug', $slug)->where('status', 1)->first();
        if ($page) {
            return view('fronts.pages.custompage', compact('page'));
        } else {
            abort(404, 'Page not found');
        }
    }

    function toSitemap()
    {
        $products = Product::where('status', 1)->get();
        $pages = CustomPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return response()->view('fronts.sitemap.sitemap', [
            'products' => $products,
            'pages' => $pages,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    function popuplogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            cart_to_product();
            product_cart();
            return redirect()->back()->with('success', 'Login successfully')->with('userdetail', json_decode($request->userdetail, true));
        }
        return redirect()->back()->with('error', 'Please Enter Valid  Password')->with('userdetail', json_decode($request->userdetail, true));
    }

    function thankyou($slug)
    {
        if (auth()->user()) {
            $order = Order::where('order_id', $slug)->where('user_id', auth()->user()->id)->first();
            if ($order) {
                return view('fronts.thankyou.thankyou', compact('order'));
            }
        }
    }

    public function toreviews(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email',
            'rate' => 'required|integer|between:1,5',
            'comment' => 'required|string',
            'product_id' => 'required|integer',
        ]);

        $userId = auth()->user()->id;
        $productId = $request->product_id;

        $orders = Order::where('user_id', $userId)->pluck('products')->all();
        $mergedOrders = collect($orders)->flatMap(function ($order) {
            return collect(json_decode($order, true));
        });

        $productExists = $mergedOrders->contains(function ($product) use ($productId) {
            return isset($product['product_id']) && $product['product_id'] == $productId;
        });

        if ($productExists) {
            Review::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'rate' => $request->rate,
                'comment' => $request->comment,
                'product_id' => $request->product_id,
            ]);

            return redirect()->back()->with('success', 'Review Submitted Successfully');
        }

        return redirect()->back()->with('warning', 'You cannot review this product.');
    }

    function tosubscribesuser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribes,email_id',
        ]);
        $subscribe = new Subscribe();
        $subscribe->email_id = $request->email;
        $subscribe->save();
        return redirect()->back()->with('success', 'Subscribed Successfully');
    }
}
