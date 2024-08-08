<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CoupenController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\AppearenceController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\CustomPagesController;
use App\Http\Controllers\TestimonialController;



// Route::prefix('admin')->group(function () {
//     Route::get('/', [AdminController::class, 'tologinadmin'])->name('admin.login');
//     Route::post('login', [AdminController::class, 'login'])->name('admin.login');
//     Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
// });

// Route::middleware(['auth'])->group(function () {
Route::get('/generate-pdf/{id}', [OrderController::class, 'generatePDF'])->name('order.invoice');
// });

Route::middleware(['auth:admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        //Users
        Route::get('/user-list', [AdminController::class, 'toUser'])->name('admin.users');
        Route::get('/user-login/{id}', [AdminController::class, 'toUserLogin'])->name('admin.user.login');
        Route::get('/user-edit/{id}', [AdminController::class, 'toUseredit'])->name('admin.users.edit');
        Route::put('/user-edit/{id}', [AdminController::class, 'toUserEditUpdate']);

        // Subscribe
        Route::get('/subscribe', [AdminController::class, 'toSubscribe'])->name('admin.subscribe');
        Route::post('/subscribe', [AdminController::class, 'toSubscribeStore']);
        Route::get('/subscribe/delete/{id}', [AdminController::class, 'toSubscribeDelete'])->name('admin.subscribe.delete');
        Route::post('/subscribe/edit', [AdminController::class, 'toSubscribeEdit'])->name('admin.subscribe.edit');


        //Product
        Route::get('/product', [ProductController::class, 'toproduct'])->name('admin.product');
        Route::post('/product', [ProductController::class, 'toproductstore']);
        Route::get('/product/list', [ProductController::class, 'toproductlist'])->name('admin.product.list');
        Route::get('/product/edit/{id}', [ProductController::class, 'toproductedit'])->name('admin.product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'toproductupdate'])->name('admin.product.update');
        Route::get('/product/delete/{id}', [ProductController::class, 'toproductdelete'])->name('admin.product.delete');
        Route::post('/product/list', [ProductController::class, 'toproductsearch'])->name('admin.product.search');


        //ajax
        Route::post('/category/ajax', [CategoryController::class, 'toajaxsubcat'])->name('sub.category.ajax');

        //Category
        Route::get('/category', [CategoryController::class, 'tocategory'])->name('admin.category');
        Route::post('/category', [CategoryController::class, 'tocategorystore']);
        Route::get('/category/delete/{id}', [CategoryController::class, 'tocategorydelete'])->name('admin.category.delete');
        Route::post('/category-edit', [CategoryController::class, 'toeditcategory'])->name('admin.editcategory');


        //SubCategory
        Route::get('/sub-category', [CategoryController::class, 'tosubcategory'])->name('admin.sub.category');
        Route::post('/sub-category', [CategoryController::class, 'tosubcategorystore']);
        Route::get('/sub-category/delete/{id}', [CategoryController::class, 'tosubcategorydelete'])->name('admin.sub.category.delete');
        Route::post('/sub-category-edit', [CategoryController::class, 'tosubeditcategory'])->name('admin.sub.editcategory');



        //Reviews
        Route::get('/reviews', [AdminController::class, 'toReviews'])->name('admin.reviews');
        Route::put('/reviews/edit/{id}', [AdminController::class, 'toReviewsEdit'])->name('admin.reviews.edit');
        Route::get('/reviews/delete/{id}', [AdminController::class, 'toReviewsDelete'])->name('admin.reviews.delete');
        Route::post('/reviews/add', [AdminController::class, 'toReviewsAdd'])->name('admin.reviews.add');



        // Coupon
        Route::get('/coupon', [CoupenController::class, 'tocoupen'])->name('admin.coupen');
        Route::post('/coupon', [CoupenController::class, 'tocoupencreate']);
        Route::get('/coupon/delete/{slug}', [CoupenController::class, 'tocoupendelete'])->name('admin.coupen.delete');
        Route::post('/coupon/edit', [CoupenController::class, 'tocoupenedit'])->name('admin.coupen.edit');


        //Custom Meta Pages
        Route::get('/pages/meta', [AdminController::class, 'topagesmeta'])->name('admin.pages.meta');
        Route::post('/pages/meta', [AdminController::class, 'topagesmetastore']);
        Route::post('/pages/meta/edit', [AdminController::class, 'topagesmetastoreedit'])->name('admin.pages.meta.edit');
        Route::get('/pages/meta/delete/{slug}', [AdminController::class, 'topagesmetadelete'])->name('admin.pages.meta.delete');



        //Order
        Route::get('/orders', [OrderController::class, 'toorder'])->name('admin.order');
        Route::get('/order/{id}', [OrderController::class, 'toorderview'])->name('admin.order.view');
        Route::put('/order/{id}', [OrderController::class, 'toorderedit'])->name('admin.order.edit');
        // Route::get('/generate-pdf/{id}', [OrderController::class, 'generatePDF'])->name('order.invoice');


        // Testimonial
        Route::get('/testimonial', [TestimonialController::class, 'totestimonial'])->name('admin.testimonial');
        Route::post('/testimonial/create', [TestimonialController::class, 'createTestimonial'])->name('admin.testimonial.create');
        Route::get('/testimonial-list', [TestimonialController::class, 'listTestimonial'])->name('admin.testimonial.list');
        Route::post('/testimonial-list', [TestimonialController::class, 'editTestimonial']);
        Route::get('/testimonial/delete/{id}', [TestimonialController::class, 'totestimonialdelete'])->name('admin.testimonial.delete');


        //Order Leads
        Route::get('/orders/leads', [OrderController::class, 'tolead'])->name('admin.order.leads');
        Route::get('/orders/leads/{id}', [OrderController::class, 'toleadview'])->name('admin.order.leads.view');
        Route::get('/orders/leads/delete/{id}', [OrderController::class, 'toleaddelete'])->name('admin.order.leads.delete');



        //Appearence
        Route::get('/footer', [AppearenceController::class, 'tofooter'])->name('admin.footer');
        Route::post('/footer', [AppearenceController::class, 'tofooterstore']);
        Route::get('/header', [AppearenceController::class, 'toheader'])->name('admin.header');
        Route::post('/header', [AppearenceController::class, 'toheaderstore']);


        //Slider
        Route::get('/slider', [AppearenceController::class, 'toslider'])->name('admin.slider');
        Route::post('/slider', [AppearenceController::class, 'tosliderstore']);
        Route::post('/slider/update', [AppearenceController::class, 'tosliderupdate'])->name('admin.slider.update');
        Route::get('/slider/delete/{id}', [AppearenceController::class, 'tosliderdelete'])->name('admin.slider.delete');

        //Attribute
        Route::get('/attribute', [AppearenceController::class, 'toAttribute'])->name('admin.attribute');
        Route::post('/attribute', [AppearenceController::class, 'toAttributestore']);
        Route::post('/attribute/update', [AppearenceController::class, 'toAttributeupdate'])->name('admin.attribute.update');
        Route::get('/attribute/delete/{id}', [AppearenceController::class, 'toAttributedelete'])->name('admin.attribute.delete');


        // Leads
        Route::get('/leads', [LeadController::class, 'toleads'])->name('admin.leads');
        Route::get('/leads/edit/{slug}', [LeadController::class, 'toleadsview'])->name('admin.leads.edit');
        Route::post('/leads/update', [LeadController::class, 'toleadsupdate'])->name('admin.leads.update');
        Route::get('/leads/delete/{slug}', [LeadController::class, 'toleadsdelete'])->name('admin.leads.delete');


        //Pages
        Route::get('/pages', [CustomPagesController::class, 'topages'])->name('admin.pages');
        Route::get('/pages/create', [CustomPagesController::class, 'topagescreate'])->name('admin.pages.create');
        Route::post('/pages/create', [CustomPagesController::class, 'topagesstore']);
        Route::get('/pages/edit/{id}', [CustomPagesController::class, 'topagesview'])->name('admin.pages.view');
        Route::put('/pages/edit/{id}', [CustomPagesController::class, 'topagesedit'])->name('admin.pages.edit');
        Route::get('/pages/delete/{id}', [CustomPagesController::class, 'topagesdelete'])->name('admin.pages.delete');


        // Article
        Route::get('/blog/add', [ArticleController::class, 'toarticleadd'])->name('admin.article.add');
        Route::post('/blog/add', [ArticleController::class, 'toarticlestore']);
        Route::get('/blogs', [ArticleController::class, 'toarticle'])->name('admin.article');
        Route::get('/blog/{slug}', [ArticleController::class, 'toarticleedit'])->name('admin.article.edit');
        Route::post('/blog/{slug}', [ArticleController::class, 'toarticleupdate']);
        Route::get('/blog/delete/{slug}', [ArticleController::class, 'toarticledelete'])->name('admin.article.delete');



        // Upload
        Route::any('/uploaded-files/file-info', [AizUploadController::class, 'file_info'])->name('uploaded-files.info');
        Route::resource('/uploaded-files', App\Http\Controllers\AizUploadController::class);
        Route::get('/uploaded-files/destroy/{id}', [AizUploadController::class, 'destroy'])->name('uploaded-files.destroy1');
    });
});

Route::any('{any}', function () {
    return view('fronts.inc.error');
})->where('any', '.*');
