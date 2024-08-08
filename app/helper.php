<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Level;
use App\Models\Upload;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\PageMeta;
use App\Models\UserCart;
use App\Models\Commissions;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use App\Models\BusinessSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;


if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $setting = BusinessSetting::where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}


if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset($path, $secure);
            // return app('url')->asset('public/' . $path, $secure);
        }
    }
}

if (!function_exists('getCategorySlugFromUrl')) {
    /**
     * Extracts the category slug from a given URL.
     *
     * @param  string  $url
     * @return string|null
     */
    function getCategorySlugFromUrl($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        return basename($path);
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}


if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = (isHttps() ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        return $root;
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        return getBaseURL() . 'public/';
    }
}

if (!function_exists('isHttps')) {
    function isHttps()
    {
        return !empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']);
    }
}


function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function levelCommision($id, $amount, $orderid)
{
    $usr = $id;
    $i = 1;
    $level = Level::count();

    while ($usr !== "" && $usr !== "0" && $i <= $level) {
        $me = User::find($usr);

        if (!$me) {
            break; // Exit the loop if the user is not found
        }

        $user = User::find($me->referrer_id);

        if (!$user) {
            break; // Exit the loop if the referrer is not found
        }

        $comission = Level::where('level', $i)->first();

        if ($comission && $comission->percentage > 0) {
            $com = ($amount * $comission->percentage) / 100;
            $new_bal = $user->balance + $com;

            $transaction =  Transaction::create([
                'message' => $i . ' Tier Referral Commission from ' . $user->user_name,
                'user_id' => $user->id,
                'trans_id' => getTrx(),
                'description' => $i . ' Tier Referral Commission from ' . $user->name,
                'amount' => $amount,
                'order_id' => $orderid,
                'old_bal' => $user->balance,
                'new_bal' => $new_bal,
                'status' => 1,
                'level' => $i
            ]);

            // Create a Commissions record
            $comm = new Commissions();
            $comm->user_id = $user->id;
            $comm->from_user_id = $me->id;
            $comm->level = $i;
            $comm->amount = $com;
            $comm->post_balance = $new_bal;
            $comm->trx = $transaction->trans_id;
            $comm->order_id = $orderid;

            $comm->mark = 2;
            $comm->details = 'Tier ' . $i . ' commission from ' . $user->user_name;
            $comm->save();

            $user->balance = $new_bal;
            $user->save();
        }

        $usr = $user->id;
        $i++;
    }

    return 0;
}




//MlM Level Plan

function getReferralLevels($userId, $level = 1): Collection
{
    $user = User::find($userId);

    if (!$user) {
        return collect(); // Return an empty collection if the user doesn't exist
    }
    $levels = collect([]);
    $referrals = $user->referrals;


    foreach ($referrals as $referral) {
        $levels->push([
            'user' => $referral->user,
            'level' => $level
        ]);
        // Recursively retrieve referral levels
        $nestedLevels = getReferralLevels($referral->user_id, $level + 1);
        $levels = $levels->merge($nestedLevels);
    }

    return $levels;
}

function paginate(Collection $items, $perPage)
{
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $paginatedItems = new LengthAwarePaginator($currentItems, count($items), $perPage);
    return $paginatedItems->setPath(request()->url());
}

function showBelow($id)
{
    $newArray = array();
    $underReferral = User::where('referrer_id', $id)->get();
    foreach ($underReferral as $value) {
        array_push($newArray, $value->id);
    }
    return $newArray;
}


function array_flatten($array)
{
    if (!is_array($array)) {
        return false;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result = array_merge($result, array($key => $value));
        }
    }
    return $result;
}

if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}


function OrderDistributeamount($products)
{
    foreach ($products as $product) {
        // Find the product by ID
        $prod = Product::find($product['product_id']);

        if ($prod) {
            // Calculate and store the distributed amount
            $distributedAmount = ($product['net_amount'] * $prod->distribute) / 100;
            $value[] = $distributedAmount;
        }
    }
    // Calculate the total distributed amount
    $totalDistributedAmount = array_sum($value);
    return $totalDistributedAmount;
}

if (!function_exists('custom_date')) {

    function custom_date($date)
    {

        if (isset($date)) {
            $dateTime = Carbon::parse($date); // Parse your date and time string
            $formattedTime = $dateTime->diffForHumans(); // Get the time difference in human-readable format
            return $formattedTime;
        }
        return "No Data";
    }
    # code...
}

if (!function_exists('random_image')) {

    function random_image()
    {
        $image = ['user1-128x128.jpg', 'user2-160x160.jpg', 'user3-128x128.jpg', 'user4-128x128.jpg', 'user5-128x128.jpg', 'user6-128x128.jpg', 'user7-128x128.jpg', 'user8-128x128.jpg'];

        return $randomValue = Arr::random($image);
    }
    # code...
}

if (!function_exists('stock_maintain')) {
    function stock_maintain($products)
    {
        $productIds = array_column($products, 'product_id');
        $productsData = Product::whereIn('id', $productIds)->get()->keyBy('id');
        foreach ($products as $product) {
            $productId = $product['product_id'];
            if (isset($productsData[$productId])) {
                $prod = $productsData[$productId];
                $UserProductquantity = $product['quantity'];
                $oldStock = $prod->stock;
                $newStock = $oldStock - $UserProductquantity;
                $prod->stock = $newStock;
                $prod->save();
            }
        }

        return true;
    }
}

if (!function_exists('extractYoutubeVideoId')) {
    function extractYoutubeVideoId($url)
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        } else {
            return null;
        }
    }
}



if (!function_exists('orderMail')) {
    function orderMail($order)
    {
        $orderMail = [
            'subject' => 'Order Verified',
            'content' => 'Your Order Has Been Verified By Our Team He will be Delivered Shortly',
            'link' => route('order.track'),
            'logo' => uploaded_asset(get_setting('web_logo')),
            'order' => $order,
        ];

        Mail::to(['chetankumar24825@gmail.com', $order->email])->send(new OrderMail($orderMail));
        return 1;
    }
}


function stock_counter($product_counter)
{
    $cart = Session::get('cart');
    $product = Product::findOrFail($product_counter);
    if (isset($cart[$product->id])) {
        return $cart[$product->id]['quantity'];
    } else {
        return 0;
    }
}


function product_stock()
{
    $cart = Session::get('cart');
    foreach ($cart as $key => $value) {
        $product = Product::findOrFail($key);
        if ($value['quantity'] > $product->stock) {
            if (isset($cart[$key])) {
                unset($cart[$key]);
            }
        }
    }
    session()->put('cart', $cart);
}

function product_cart1()
{
    if (auth()->check()) {
        $userCart = UserCart::where('user_id', auth()->user()->id)->get();
        $cart = Session::get('cart');
        foreach ($userCart as $value) {
            $product = Product::findOrFail($value->product_id);
            if ($value->quantity > $product->stock) {
                if (isset($cart[$value->product_id])) {
                    $userCart[$value->product_id]->delete();
                } else {
                    $cart[$product->id] = [
                        'product_id' => $product->id,
                        'quantity' => $product->quantity,
                        'image' => $product->thumbphotos,
                        'product_name' => $product->product_name,
                        'net_amount' => 1 * $product->sale_price,
                        'rate' => $product->sale_price,
                        'stock' => $product->stock,
                    ];
                }
            }
        }
        session()->put('cart', $cart);
    }
}

function product_cart()
{
    if (auth()->check()) {
        $userCart = UserCart::where('user_id', auth()->user()->id)->get();
        if ($userCart->isNotEmpty()) {
            $cart = Session::get('cart', []);
            foreach ($userCart as $value) {
                $product = Product::findOrFail($value->product_id);
                if ($value->quantity <= $product->stock) {
                    if (!isset($cart[$product->id])) {
                        $cart[$product->id] = [
                            'product_id' => $product->id,
                            'quantity' => $value->quantity,
                            'image' => $product->thumbphotos,
                            'product_name' => $product->product_name,
                            'net_amount' => $value->quantity * $product->sale_price,
                            'rate' => $product->sale_price,
                            'stock' => $product->stock,
                        ];
                    }
                }
            }
            Session::put('cart', $cart);
        }
    }
}

function cart_to_product()
{
    if (auth()->check()) {
        $carts = Session::get('cart');
        if ($carts && count($carts)) {
            foreach ($carts as $value) {
                $product = UserCart::where('user_id', auth()->user()->id)->where('product_id', $value['product_id'])->first();
                if (!$product) {
                    $userCart = new UserCart();
                    $userCart->user_id = auth()->user()->id;
                    $userCart->product_id = $value['product_id'];
                    $userCart->quantity = $value['quantity'];
                    $userCart->save();
                } else {
                    $product->quantity = $value['quantity'];
                    $product->save();
                }
            }
        }
    }
}


// function file_modify()
// {
//     $files = Upload::all();
//     foreach ($files as $file) {
//         $currentFilePath = $file['file_name'];
//         $Oldfile = basename($currentFilePath);
//         if (file_exists($currentFilePath)) {
//             $extension = pathinfo($currentFilePath, PATHINFO_EXTENSION);
//             $originalFileName = Str::slug(pathinfo($file['file_original_name'], PATHINFO_FILENAME));
//             $newFilePath = 'uploads/all/' . $originalFileName . '.' . $extension;
//             rename($currentFilePath, $newFilePath);
//             $file->file_name = $newFilePath;
//             $file->save();
//         } else {
//             echo "File does not exist: $currentFilePath<br>";
//         }
//     }
// }

function customUrl($path)
{
    $pageMeta = PageMeta::where('url', $path)->where('status', 1)->first();
    return $pageMeta;
}
