<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);

Route::get('/my_orders', [FrontendOrderController::class, 'myOrder']);
Route::get('/my_orders/{orderId}', [FrontendOrderController::class, 'myOrderShow']);

Route::controller(FrontendController::class)->group(function () {

    Route::get('/', 'index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');

    Route::get('/new-arrivals', 'newArrival');
    Route::get('/featured-products', 'featuredProducts');

    Route::get('/order-confirmed', 'orderConfirmed');

    Route::get('/search', 'searchProducts');

    Route::get('/women', 'womenShow');
    Route::get('/man', 'manShow');
    Route::get('/designer', 'designerShow');
    Route::get('/sale', 'saleShow');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order/{orderId}', [OrderController::class, 'show']);

    Route::get('/profile', [FrontendUserController::class, 'index']);
    Route::post('/profile', [FrontendUserController::class, 'updateUserDetail']);

    Route::get('/address', [AddressController::class, 'addressShow']);
    Route::get('/address/create', [AddressController::class, 'addressCreate']);
    Route::post('/address', [AddressController::class, 'addressStore']);
    Route::get('/address/{address_id}/edit', [AddressController::class, 'addressEdit']);
    Route::put('/address/{address_id}', [AddressController::class, 'addressUpdate']);
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // Admin
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products/create', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/products/{product_id}/delete', 'destroy');
        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');

        Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete', 'deleteProdColor');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category', 'store')->name('category.store');
        Route::get('/category/{category}/edit', 'edit')->name('category.show');
        Route::put('/category/{category}', 'update')->name('category.update');
        Route::get('/category/{category}/delete', 'destroy')->name('category.destroy');
    });

    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
    });

    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
    });

    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('setting.store');

    Route::get('/brands', Index::class);
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::get('/users/{user_id}/delete', 'destroy');
    });
});
