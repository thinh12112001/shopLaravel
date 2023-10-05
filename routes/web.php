<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\CouponController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\MainMenuController;


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
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function() {

    Route::prefix('admin')->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::delete('destroy', [MenuController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function() {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::delete('destroy', [ProductController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

         #Slider
         Route::prefix('sliders')->group(function() {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::delete('destroy', [SliderController::class, 'destroy']);
        });

        #Cart
        Route::get('customers', [CartController::class, 'index']);
        Route::get('customers/view/{customer}', [CartController::class, 'show']);
        Route::delete('customers/destroy', [CartController::class, 'destroy']);

        #Revenue
        Route::get('revenue/list', [RevenueController::class, 'index'])->name('dashboard');

        #Comment
        Route::get('comment/list', [CommentController::class, 'index']);
        // Route::post('comment/list', [CommentController::class, 'index']);
        Route::post('allow-comment', [App\Http\Controllers\ProductController::class, 'allow_comment']);
        Route::post('reply-comment', [App\Http\Controllers\ProductController::class, 'reply_comment']);

        #Facebook login
        // Route::get('login-facebook', [LoginController::class, 'login_facebook']);
        // Route::get('callback', [LoginController::class, 'callback_facebook']);

        #Blog
        Route::prefix('blog')->group(function() {
            Route::get('list', [BlogController::class, 'index']);
            Route::get('add', [BlogController::class, 'create']);
            Route::post('add', [BlogController::class, 'store']);
            Route::get('edit/{blog}', [BlogController::class, 'show']);
            Route::post('edit/{blog}', [BlogController::class, 'update']);
            Route::delete('destroy', [BlogController::class, 'destroy']);
        });

        #Coupon
        Route::prefix('coupons')->group(function() {
            Route::get('list', [CouponController::class, 'index']);
            Route::get('add', [CouponController::class, 'create']);
            Route::post('add', [CouponController::class, 'store']);
            Route::get('edit/{coupon}', [CouponController::class, 'show']);
            Route::post('edit/{coupon}', [CouponController::class, 'update']);
            Route::delete('destroy', [CouponController::class, 'destroy']);
        });


    });

});

Route::get('/', [MainPageController::class, 'index']);
Route::post('/services/load-product', [MainPageController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html', [MainMenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);

Route::post('add-cart-main-page', [App\Http\Controllers\CartController::class, 'addcartmainpage']);

Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\CartController::class, 'addCart']);
#paypal
Route::post('paypal', [App\Http\Controllers\CartController::class, 'paypal']);

#Quick View
Route::post('/quickview', [App\Http\Controllers\ProductController::class, 'quickview']);

#Show Popup
// Route::post('/show-popup/{product_id}', [App\Http\Controllers\CartController::class, 'showPopup'])->name('show.popup');
Route::match(['get', 'post'], '/show-popup/{product_id}', [App\Http\Controllers\CartController::class, 'showPopup'])->name('show.popup');

#Chart
Route::post('filterbydate', [RevenueController::class, 'filter_by_date']);
Route::post('dashboardfilter', [RevenueController::class, 'dashboard_filter'])->name('dashboard_filter');

#Comment
Route::post('load-comment', [App\Http\Controllers\ProductController::class, 'load_comment']);
Route::post('send-comment', [App\Http\Controllers\ProductController::class, 'send_comment']);

#Blog
Route::get('blog', [App\Http\Controllers\BlogController::class, 'index']);
Route::get('blog/detail/{id}-{slug}.html', [App\Http\Controllers\BlogController::class, 'detail']);

#Rating
Route::post('/insert-rating', [App\Http\Controllers\ProductController::class, 'insert_rating']);

#Send mail coupon
Route::get('/send-mail-vip/{start_date}/{end_date}/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}', [App\Http\Controllers\MailController::class, 'send_mail_vip']);
Route::get('/send-mail/{start_date}/{end_date}/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}', [App\Http\Controllers\MailController::class, 'send_mail']);
Route::get('/mail-example', [App\Http\Controllers\MailController::class, 'mail_example']);

#Check and remove coupon
Route::post('/check_coupon', [App\Http\Controllers\CartController::class, 'check_coupon']);
Route::post('/remove_coupon', [App\Http\Controllers\CartController::class, 'remove_coupon']);
