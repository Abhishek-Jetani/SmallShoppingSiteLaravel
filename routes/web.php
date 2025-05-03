<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// admin 
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;

// user
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AllPagesController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserOrderController;
use App\Http\Controllers\AdminManageCustomerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



// ==========================================   Admin Routes   ==================================================
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('users', [AdminManageCustomerController::class, 'index'])->name('users.index');

    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // admin change password 
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard/stats', 'getStats')->name('admin.dashboard.stats');

        Route::get('/admin-change-password', 'adminchangePassword')->name('admin.changePassword');
        Route::post('/admin-change-password', 'adminchangePasswordSave')->name('admin.postChangePassword');
    });

    // Product
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('product', 'index')->name('product.index');
        Route::get('product/create', 'create')->name('product.create');
        Route::post('product/store', 'store')->name('product.store');
        Route::get('product/edit/{id}', 'edit')->name('product.edit');
        Route::put('product/update/{product}', 'update')->name('product.update');
        Route::get('product/show/{product}', 'show')->name('product.show');
        Route::delete('product/delete/{product}', 'destroy')->name('product.destroy');
        Route::get('admin/product/filter', 'filter')->name('product.filter');
        Route::post('/products/exclude-multiple', 'deleteMultiple')->name('product.deleteMultiple');
        // excel 
        Route::post('/products/export', 'export')->name('admin.products.export');
        Route::get('download/excel', 'downloadExcel')->name('download.excel');
        Route::post('/products/import', 'import')->name('admin.products.import');
        Route::post('users-import', 'import')->name('users.import');
    });

    // Order 
    Route::controller(AdminUserOrderController::class)->group(function () {
        Route::get('/orders', 'userAllOrders')->name('admin.usersAllOrder');
        Route::delete('/admin/orders/{id}', 'destroy')->name('admin.deleteUserOrder');
    });

    // Customer {user} 
    Route::controller(AdminManageCustomerController::class)->group(function () {
        Route::get('customer', 'index')->name('admin.manageCustomer.index');
        Route::get('activate-user/{userId}', 'activateUser')->name('admin.activateCustomer');
        Route::get('deactivate-user/{userId}', 'deactivateUser')->name('admin.deactivateCustomer');
        Route::delete('delete/{userId}', 'deleteUser')->name('admin.deleteCustomer');
        Route::delete('permanentDelete/{trashedUser}', 'permanentDeleteUser')->name('admin.permanentDeleteCustomer');
        Route::delete('restore/{trashedUser}', 'restoreUser')->name('admin.restoreCustomer');
        Route::get('customer/trashUser', 'trashedUser')->name('admin.trashedUser');
    });

    // Profile
    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('admin.profile');
        Route::post('profile/{user}', 'update')->name('admin.profile.update');
    });

    // Category
    Route::controller(AdminCategoryController::class)->group(function () {
        Route::resource('category', AdminCategoryController::class);
    });
});


// ==========================================   User Routes   ==================================================
Route::group(['middleware' => ['isUser', 'auth', 'verified']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('user.homepage')->middleware(['auth', 'verified']);;

    // change password 
    Route::controller(UserController::class)->group(function () {
        Route::get('/change-password', 'changePassword')->name('changePassword');
        Route::post('/change-password', 'changePasswordSave')->name('postChangePassword');
    });

    // Profile edit 
    Route::controller(UserProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::post('profile/{user}', 'update')->name('profile.update');
    });

    // Wishlist 
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('wishlist.index');
        Route::delete('/wishlist/{wishlist}', 'destroy')->name('wishlist.destroy');
    });

    // product
    Route::controller(ProductController::class)->group(function () {
        Route::post('/add-to-wishlist/{product_id}', 'addToWishlist')->name('wishlist.add');
    });

    // Order 
    Route::controller(OrderController::class)->group(function () {
        Route::post('orders', 'placeOrder')->name('order.place');
        Route::get('orders/show', 'getUserOrders')->name('order.getUserOrders');
        Route::get('orders/pdf', 'user_allorder_pdf')->name('order.user_allorder_pdf');
        Route::post('/update-cart-quantity/{cartId}', 'updateQuantity')->name('update.cart.quantity');
    });

    //stripe payment
    Route::controller(PaymentController::class)->group(function () {
        Route::get('checkout', 'checkout')->name('checkout');
        Route::post('checkout', 'processCheckout')->name('checkout.process');
    });
});


// ==========================================   Other/Common Routes   ==================================================
Route::group([], function () {
    Auth::routes();

    // home without login
    Route::controller(HomeController::class)->group(function () {
        // test
        Route::get('/welcome', 'welcome')->name('welcome');
        Route::get('/', 'index')->middleware('revalidate')->name('home');
        Route::get('/latest_product_home', 'latest_product_home')->name('user.latest_product_home');
    });

    // static pages
    Route::controller(AllPagesController::class)->group(function () {
        Route::get('aboutus', 'aboutus')->name('user.aboutus');
        Route::get('privacy_policy', 'privacy_policy')->name('user.privacy_policy');
        Route::get('term_condition', 'term_condition')->name('user.term_condition');
    });

    // Product 
    Route::controller(ProductController::class)->group(function () {
        Route::resource('products', ProductController::class);
        Route::get('/product/{product}', 'product_detail')->name('product.product_detail');
        Route::get('/products', 'index')->name('products.index');
        Route::post('/products/category', 'getProductsByCategory')->name('products.byCategory');
        Route::post('/products/all', 'getAllProducts')->name('products.all');
    });

    // Cart
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/add-to-cart/{productId}', 'addToCart')->name('cart.add');
        Route::delete('/cart/{cart}', 'destroy')->name('cart.destroy');
        Route::post('/update-cart-quantity/{cartId}', 'updateQuantity')->name('cart.updateQuantity');
        Route::get('/cart/count', 'getCartProductCount');
        Route::get('/cart/check/{productId}', 'isProductInCart')->name('cart.isProductInCart');
    });

    // for state, city 
    Route::controller(AddressController::class)->group(function () {
        Route::get('/states', 'getStates');
        Route::get('/cities', 'getCities');
    });

    // admin login routes 
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/login', 'showLoginForm');
        Route::post('/admin/admin_login', 'login')->name('admin.admin_login');
    });

    // email varification 
    Route::group([], function () {

        Route::get('/email/verify', function () {
            return view('auth.verify');
        })->middleware('auth')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $r) {
            $r->fulfill();
            return redirect('/');
        })->middleware(['auth', 'signed'])->name('verification.verify');
        Route::post('/email/verification-notification', function (Request $r) {
            $r->user()->sendEmailVerificationNotification();
            return back()->with('resent', 'Verification link sent ');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    });

});
