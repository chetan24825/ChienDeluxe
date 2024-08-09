<?php

// use App\Http\Controllers\AdminAuth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AizUploadController;
use App\Livewire\LoginPage;
use App\Livewire\RegisterPage;
/*
|--------------------------------------------------------------------------
| LiveWire Component
|--------------------------------------------------------------------------
*/
use App\Livewire\CategoryModel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/cache_clear', function () {
    Artisan::call('cache:clear');
});

Route::get('/view_clear', function () {
    Artisan::call('view:clear');
});
Route::get('/config_clear', function () {
    Artisan::call('config:cache');
});
Route::get('/route_clear', function () {
    Artisan::call('route:clear');
});

Route::get('/refresh-csrf', function () {
    return csrf_token();
});

Route::post('/popuplogin', [FrontController::class, 'popuplogin'])->name('popuplogin');
Route::get('/thankyou', [FrontController::class, 'thankyou'])->name('thankyou');
// Route::get('/thankyou/{id}/order', [FrontController::class, 'thankyou'])->name('thankyou');

Route::post('/reviews', [FrontController::class, 'toreviews'])->name('reviews');
Route::get('/verify', [FrontController::class, 'toverification']);
Route::get('sitemap.xml', [FrontController::class, 'toSitemap'])->name('sitemap');




Route::get('/', [FrontController::class, 'toindex'])->name('webpage');
Route::get('/cart', [FrontController::class, 'tocart'])->name('cart.view');

Route::post('/subscribes', [FrontController::class, 'tosubscribesuser'])->name('subscribes.user');


Route::get('/checkout', [FrontController::class, 'tocheckout'])->name('checkout.view');
Route::post('/checkout', [FrontController::class, 'tocheckstore']);
Route::post('/webhook/cashfree', [FrontController::class, 'handleCashfreeWebhook']);
Route::any('cashfree/payments/success', [FrontController::class, 'cashfreeSuccess'])->name('cashfree.success');

Route::get('/products', [FrontController::class, 'toproduct'])->name('product.view');
Route::get('/p/{slug}', [FrontController::class, 'toproductdetail'])->name('product.detail');




// Route::get('/category/{slug}', [FrontController::class, 'tocategorydetail'])->name('category.detail');

Route::get('/order-track', [FrontController::class, 'totrack'])->name('order.track');
Route::get('/search', [FrontController::class, 'tosearchproduct'])->name('search.product');

Route::post('/toShippingAddress', [FrontController::class, 'toShippingAddress'])->name('toShippingAddress');
Route::post('/toShippingAddressUpdate', [FrontController::class, 'toShippingAddressUpdate'])->name('toShippingAddressupdate');


Route::get('/wishlist', [WishlistController::class, 'towishlist'])->name('wishlist')->middleware('auth');

Route::get('/contact-us', [FrontController::class, 'tocontactus'])->name('contactus');
Route::post('/contact-us', [FrontController::class, 'tocontactemail']);

//Custom page
Route::get('/page/{slug}', [FrontController::class, 'tocustompage'])->name('custom.page');

// livireComponent
Route::get('category/{slug}', CategoryModel::class)->name('category.detail');

// Admin
Route::get('/admin', [AdminController::class, 'tologinadmin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.post.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
//User Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/{username?}', RegisterPage::class)->name('user.register');
    Route::get('/user/login', LoginPage::class)->name('user.login');
});


//ajax
Route::post('/get/ref/id', [FrontController::class, 'getRefId'])->name('get.ref.id');
Route::post('/add-to-cart', [FrontController::class, 'toaddcart'])->name('add.cart');
Route::post('/quantity', [FrontController::class, 'toaddcartonchange'])->name('add.cart.onchange');
Route::post('/delete', [FrontController::class, 'tocarddelete'])->name('add.cart.delete');
Route::post('/get-city', [FrontController::class, 'get_city'])->name('get-city');
Route::post('/get-state', [FrontController::class, 'get_state'])->name('get-state');
Route::post('/get/code', [FrontController::class, 'tocouponcode'])->name('get.coupon.code');
Route::post('/wishlist/add', [WishlistController::class, 'towishlistadd'])->name('add.wishlist');
Route::post('/wishlist/delete', [WishlistController::class, 'towishlistdelete'])->name('delete.wishlist');
Route::post('/shipping/delete', [FrontController::class, 'toshippingdelete'])->name('shipping.delete');




Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');


Auth::routes();
Route::middleware(["auth", "checkUserStatus"])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        // Home
        Route::get('/home', [HomeController::class, 'index'])->name('home');


        Route::get('/profile', [UserController::class, 'toprofile'])->name('user.profile');
        Route::post('/profile', [UserController::class, 'toprofileedit']);

        Route::get('/my-referral', [UserController::class, 'todirectreffer'])->name('user.directreffer');
        Route::get('/tier', [UserController::class, 'tolistlevel'])->name('user.level');
        Route::post('/tier', [UserController::class, 'tolistlevel'])->name('user.level1');
        // Route::get('/get/ref/', [FrontController::class, 'getRef'])->name('get.ref');

        // Orders
        Route::get('/orders', [UserController::class, 'toorder'])->name('user.order');
        Route::get('/order/{id}', [UserController::class, 'toorderview'])->name('user.order.view');


        //Withdrawal
        Route::get('/withdrawal', [UserController::class, 'towithdrawal'])->name('user.withdrawal');
        Route::post('/withdrawal', [UserController::class, 'withdrawalRequest']);

        //Transaction
        Route::get('/transaction-history', [UserController::class, 'totransaction'])->name('user.transaction');


        //Rewards
        Route::get('/rewards', [UserController::class, 'torewards'])->name('user.rewards');



        //Uploads
        Route::any('/uploaded-files/file-info', [AizUploadController::class, 'file_info'])->name('uploaded-files.info');
        Route::resource('/uploaded-files', App\Http\Controllers\AizUploadController::class);
        Route::get('/uploaded-files/destroy/{id}', [AizUploadController::class, 'destroy'])->name('uploaded-files.destroy1');
    });
});
