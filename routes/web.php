<?php

use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ListProductController;
use App\Http\Controllers\Admin\Resources\AddCategoriesController;
use App\Http\Controllers\Admin\Resources\AddModelsController;
use App\Http\Controllers\Customers\CartController;
use App\Http\Controllers\Customers\CheckoutProductController;
use App\Http\Controllers\Customers\HomeController;
use App\Http\Controllers\Customers\ProductController;

use App\Http\Controllers\Admin\ReturnOrderController;
use App\Http\Controllers\Customers\CategoryController;
use App\Http\Controllers\Customers\ModelController;
use App\Http\Controllers\Customers\RiwayatPesananController;
use App\Http\Controllers\Customers\UserController;
use App\Http\Controllers\Customers\WishlistController;
use App\Http\Controllers\Sellers\DashboardSellerController;
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
// });

Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'products.'], function () {
        Route::get('/detail-product-seller/{id}/{idProduct}/{userId}', [ProductController::class, 'detailProductIsSell']);
        Route::get('/detail-product/{id}', [ProductController::class, 'detail']);
        Route::get('belanja', [ProductController::class, 'search'])->name('search');
        Route::post('store-product-seller', [ProductController::class, 'storeProductSeller'])->name('store-product-seller');

        // Route::get('/belanja', [ProductController::class, 'searchByCat'])->name('searchByCat');
    });
    Route::group(['as' => 'users.'], function () {
        Route::post('update-to-buyer', [UserController::class, 'switchToBuyer'])->name('switch-to-buyer');
        Route::post('update-to-seller', [UserController::class, 'switchToSeller'])->name('switch-to-seller');
        Route::post('top-up-saldo', [UserController::class, 'topUpSaldo'])->name('top-up-saldo');
        // Route::get('/belanja', [ProductController::class, 'searchByCat'])->name('searchByCat');
    });
    Route::group(['as' => 'categories.'], function () {
        Route::get('models', [ModelController::class, 'index'])->name('index');
        Route::get('/detail-models/{id}', [ModelController::class, 'detail']);
    });
    Route::group(['as' => 'wishlist.'], function () {
        Route::post('store-wishlist', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('index');
        Route::get('/remove-wishilist', [WishlistController::class, 'destroy'])->name('remove');
    });
    Route::group(['as' => 'cart.'], function () {
        Route::post('/update-address', [CartController::class, 'update'])->name('updateAddress');
        Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add');
        Route::get('/cart', [CartController::class, 'index'])->name('index');
        Route::get('/getCities/{id}', [CartController::class, 'getCities'])->name('getCities'); // ajax
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
        // Route::post('/send-returns/{id}', [RiwayatPesananController::class, 'storeReturns'])->name('returns');
        // Route::post('/send-returns-back/{id}', [RiwayatPesananController::class, 'storeReturnsBack'])->name('sendReturnsBack');
        Route::post('/accept-item/{id}', [RiwayatPesananController::class, 'acceptOrder'])->name('acceptOrder');
        Route::post('/send-review/{id}', [RiwayatPesananController::class, 'storeReview'])->name('send-review');
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
        Route::put('/admin-dashboard/details/send-item/{id}', [DashboardController::class, 'updateConfirmAdmin'])->name('update-confirm-admin');
        Route::put('/admin-dashboard/details/decline-item/{id}', [DashboardController::class, 'declineOrderAdmin'])->name('decline-order-admin');
    });
    Route::group(['as' => 'products.'], function () {
        Route::get('admin-products', [ListProductController::class, 'index'])->name('index');
        Route::get('create-products', [ListProductController::class, 'create'])->name('create');
        Route::post('store-products', [ListProductController::class, 'store'])->name('store');
        Route::get('edit-products/{id}', [ListProductController::class, 'edit'])->name('edit');
        Route::put('update-products/{id}', [ListProductController::class, 'update'])->name('update');
        Route::get('delete-products/{id}', [ListProductController::class, 'destroy'])->name('delete');
    });

    Route::group(['as' => 'models.'], function () {
        Route::get('list-models', [AddModelsController::class, 'index'])->name('index');
        Route::get('create-models', [AddModelsController::class, 'create'])->name('create-models');
        Route::get('edit-models/{id}', [AddModelsController::class, 'edit'])->name('edit-models');
        Route::post('store-models', [AddModelsController::class, 'store'])->name('store-models');
        Route::put('update-models/{id}', [AddModelsController::class, 'update'])->name('update-models');
        Route::get('delete-models/{id}', [AddModelsController::class, 'destroy'])->name('delete-models');
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

    // // });
    // Route::group(['as' => 'admin-faq.'], function () {
    //     Route::get('admin-faq', [FaqController::class, 'index'])->name('index');
    //     Route::get('edit-faq/{id}', [FaqController::class, 'edit'])->name('edit');
    //     Route::post('store-faq', [FaqController::class, 'store'])->name('store');
    //     Route::put('update-faq/{id}', [FaqController::class, 'update'])->name('update');
    //     Route::get('delete-faq/{id}', [FaqController::class, 'destroy'])->name('delete');
    // });
});


Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'seller.'], function () {
        Route::get('/seller-dashboard/{id}', [DashboardSellerController::class, 'index'])->name('index');
        Route::get('/seller-dashboard/details/{id}', [DashboardSellerController::class, 'detail'])->name('details');
        Route::get('seller-dashboard/list-order/{id}', [DashboardSellerController::class, 'detailListOrder'])->name('list-edit-order');
        Route::put('/seller-dashboard/list-order/send-item/{id}', [DashboardSellerController::class, 'updateListOrder'])->name('update-list-order');
        Route::get('/edit-seller-product/{id}', [DashboardSellerController::class, 'edit'])->name('edit-product');
        Route::put('update-seller-products/{id}', [DashboardSellerController::class, 'update'])->name('update-product');
        Route::get('/delete-seller-product/{id}', [DashboardSellerController::class, 'removeProduct'])->name('delete-product');
    });
});

// Route::get('/checkout', function () {
//     return view('customers.checkout');
// });
require __DIR__ . '/auth.php';
