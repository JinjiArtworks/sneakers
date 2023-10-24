<?php

use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ListProductController;
use App\Http\Controllers\Admin\Resources\AddCategoriesController;
use App\Http\Controllers\Customers\CartController;
use App\Http\Controllers\Customers\CheckoutProductController;
use App\Http\Controllers\Customers\HomeController;
use App\Http\Controllers\Customers\ProductController;

use App\Http\Controllers\Admin\ReturnOrderController;
use App\Http\Controllers\Customers\RiwayatPesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/informasi-produk', [ProductController::class, 'infoProduct'])->name('infoProduct');

// Route::group(['as' => 'nav.'], function () {
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/detail-product/{id}', [ProductController::class, 'detail']);
// });

Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'products.'], function () {
        Route::post('/store-wishlist', [ProductController::class, 'addToWishlist'])->name('addToWishlist');
        Route::get('/belanja', [ProductController::class, 'search'])->name('search');
        // Route::get('/belanja', [ProductController::class, 'searchByCat'])->name('searchByCat');
    });
    Route::group(['as' => 'categories.'], function () {
        Route::get('category', [CategoryController::class, 'index'])->name('index');
        Route::get('/detail-category/{id}', [CategoryController::class, 'detail']);
    });
    // Route::group(['as' => 'wishlist.'], function () {
    //     Route::get('/wishlist', [WishlistController::class, 'index'])->name('index');
    //     Route::get('/remove-wishilist', [WishlistController::class, 'destroy'])->name('remove');
    // });
    Route::group(['as' => 'cart.'], function () {
        Route::post('/update-address', [CartController::class, 'update'])->name('updateAddress');
        Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add');
        Route::get('/cart', [CartController::class, 'index'])->name('index');
        Route::get('/remove-from-cart/{id}', [CartController::class, 'destroy'])->name('delete');
    });
    Route::group(['as' => 'checkout.'], function () {
        // Route::get('/checkout', [CheckoutProductController::class, 'index'])->name('index');
        Route::post('/checkout', [CheckoutProductController::class, 'index'])->name('index');
        Route::post('/checkout/payments', [CheckoutProductController::class, 'store'])->name('store');
    });
    Route::group(['as' => 'history-order.'], function () {
        Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('index');
        Route::get('/detail-pesanan/{id}', [RiwayatPesananController::class, 'detailsOrder'])->name('detail');
        Route::get('/orders-delete/{id}', [RiwayatPesananController::class, 'remove'])->name('delete');
        Route::get('/send-review-rating/{id}', [RiwayatPesananController::class, 'reviewPages'])->name('reviewPages');
        Route::post('/send-review/{id}', [RiwayatPesananController::class, 'storeReview'])->name('review');
        Route::post('/send-returns/{id}', [RiwayatPesananController::class, 'storeReturns'])->name('returns');
        Route::post('/send-returns-back/{id}', [RiwayatPesananController::class, 'storeReturnsBack'])->name('sendReturnsBack');
        Route::post('/accept-item/{id}', [RiwayatPesananController::class, 'acceptOrder'])->name('acceptOrder');
    });
    // Route::group(['as' => 'faq.'], function () {
    //     // Route::get('create-faq', [HomeController::class, 'create'])->name('create');
    //     Route::get('edit-faq/{id}', [HomeController::class, 'edit'])->name('edit');
    //     Route::post('store-faq', [HomeController::class, 'store'])->name('store');
    //     Route::put('update-faq/{id}', [HomeController::class, 'update'])->name('update');
    //     Route::get('delete-faq/{id}', [HomeController::class, 'destroy'])->name('delete');
    // });
});


Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'dashboard.'], function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('index');
        Route::get('/admin-dashboard/details/{id}', [DashboardController::class, 'detail'])->name('details');
        Route::put('/admin-dashboard/details/send-item/{id}', [DashboardController::class, 'update'])->name('update');
    });
    Route::group(['as' => 'products.'], function () {
        Route::get('admin-products', [ListProductController::class, 'index'])->name('index');
        Route::get('create-products', [ListProductController::class, 'create'])->name('create');
        Route::get('edit-products/{id}', [ListProductController::class, 'edit'])->name('edit');
        Route::post('store-products', [ListProductController::class, 'store'])->name('store');
        Route::put('update-products/{id}', [ListProductController::class, 'update'])->name('update');
        Route::get('delete-products/{id}', [ListProductController::class, 'destroy'])->name('delete');
    });

    Route::group(['as' => 'categories.'], function () {
        Route::get('list-category', [AddCategoriesController::class, 'index'])->name('index');
        Route::get('create-category', [AddCategoriesController::class, 'create'])->name('create-category');
        Route::get('edit-category/{id}', [AddCategoriesController::class, 'edit'])->name('edit-category');
        Route::post('store-category', [AddCategoriesController::class, 'store'])->name('store-category');
        Route::put('update-category/{id}', [AddCategoriesController::class, 'update'])->name('update-category');
        Route::get('delete-category/{id}', [AddCategoriesController::class, 'destroy'])->name('delete-category');
    });

    // Route::group(['as' => 'return.'], function () {
    //     Route::get('/data-return', [ReturnOrderController::class, 'index'])->name('index');
    //     Route::get('/details-return/{id}', [ReturnOrderController::class, 'details'])->name('details');
    //     Route::put('/update-return/{id}', [ReturnOrderController::class, 'update'])->name('update');
    //     Route::post('/confirm-return/{id}', [ReturnOrderController::class, 'confirmReturn'])->name('confirm');
    //     Route::get('/delete-return/{id}', [ReturnOrderController::class, 'destroy'])->name('delete');
    // });
    // // Route::group(['as' => 'resources.'], function () {
    // //     Route::get('/admin-resources', [ResourcesController::class, 'index'])->name('index');

    // //     Route::get('/add-kupons', [CouponController::class, 'index'])->name('index');
    // //     Route::get('create-kupons', [CouponController::class, 'create'])->name('create-kupons');
    // //     Route::get('edit-kupons/{id}', [CouponController::class, 'edit'])->name('edit-kupons');
    // //     Route::post('store-kupons', [CouponController::class, 'store'])->name('store-kupons');
    // //     Route::put('update-kupons/{id}', [CouponController::class, 'update'])->name('update-kupons');
    // //     Route::get('delete-kupons/{id}', [CouponController::class, 'destroy'])->name('delete-kupons');

    // //     Route::get('/add-detail-produk', [DetailsProductController::class, 'index'])->name('index');
    // //     Route::get('create-detail-produk', [DetailsProductController::class, 'create'])->name('create');
    // //     Route::get('edit-detail-produk/{id}', [DetailsProductController::class, 'edit'])->name('edit');
    // //     Route::post('store-detail-produk', [DetailsProductController::class, 'store'])->name('store');
    // //     Route::put('update-detail-produk/{id}', [DetailsProductController::class, 'update'])->name('update');
    // //     Route::get('delete-detail-produk/{id}', [DetailsProductController::class, 'destroy'])->name('delete');




    // //     Route::get('/add-alergi', [AlergiController::class, 'index'])->name('index');
    // //     Route::get('create-alergi', [AlergiController::class, 'create'])->name('create-alergi');
    // //     Route::get('edit-alergi/{id}', [AlergiController::class, 'edit'])->name('edit-alergi');
    // //     Route::post('store-alergi', [AlergiController::class, 'store'])->name('store-alergi');
    // //     Route::put('update-alergi/{id}', [AlergiController::class, 'update'])->name('update-alergi');
    // //     Route::get('delete-alergi/{id}', [AlergiController::class, 'destroy'])->name('delete-alergi');
    // // });
    // Route::group(['as' => 'admin-faq.'], function () {
    //     Route::get('admin-faq', [FaqController::class, 'index'])->name('index');
    //     Route::get('edit-faq/{id}', [FaqController::class, 'edit'])->name('edit');
    //     Route::post('store-faq', [FaqController::class, 'store'])->name('store');
    //     Route::put('update-faq/{id}', [FaqController::class, 'update'])->name('update');
    //     Route::get('delete-faq/{id}', [FaqController::class, 'destroy'])->name('delete');
    // });
});
// Route::get('/checkout', function () {
//     return view('customers.checkout');
// });
require __DIR__ . '/auth.php';
