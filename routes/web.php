<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SaleController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PayPalController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ServiceController;


Route::group( ['namespace' => 'Frontend'], function () {
    Route::get( '/', [ HomeController::class, 'home'])->name('front');
    Route::get( '/about', [ AboutController::class, 'about'])->name('about');
    Route::get( '/contact', [ ContactController::class, 'contact'])->name('contact');
    Route::post( '/contact-store', [ ContactController::class, 'contact_store'])->name('contact.store');
    Route::get( '/gallery', [ GalleryController::class, 'gallery'])->name('gallery');
    Route::get( '/gallery-details/{id}', [ GalleryController::class, 'gallery_details'])->name('gallery.details');
    Route::get( '/sale', [ SaleController::class, 'sale'])->name('sale');
    Route::get( '/service', [ ServiceController::class, 'service'])->name('service');
    Route::get( 'global-data', 'LibController@index');
    Route::get( 'get-menus', 'HomeController@menus');
    Route::get( 'get-home-page', 'HomeController@homePage');
});
Route::group(['middleware' => 'auth'], function () {
    //profile
    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('profile-update', [ProfileController::class, 'profile_update'])->name('user.profile.update');
    Route::post('password-update', [ProfileController::class, 'password_update'])->name('user.password.update');
    //order
    Route::get('my-order', [ App\Http\Controllers\Frontend\UserController::class, 'user_order'])->name('user.order');
    Route::get('my-order/destroy/{id}', [ App\Http\Controllers\Frontend\UserController::class, 'user_order_destroy'])->name('user.order.destroy');
    Route::get('buy-now/{id}', [App\Http\Controllers\Frontend\UserController::class, 'buy_now'])->name('buy.now');

    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::post('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

});


// payment process page
Route::get('payment-process',[CartController::class, 'viewPaymentPage'])->name('payment.process');

//cart
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
//download
Route::get('checkout/{id}', [App\Http\Controllers\Frontend\UserController::class, 'checkout'])->name('checkout');
Route::get('search', [App\Http\Controllers\Frontend\SearchController::class, 'search'])->name('search');
Route::get('portfolio/{slug}', [App\Http\Controllers\Frontend\PortfolioController::class, 'portfolio_by_type'])->name('portfolio.type');
Route::get('category/{slug}', [App\Http\Controllers\Frontend\PortfolioController::class, 'portfolio_by_category'])->name('portfolio.category');
// Route::post('add-to-cart', [CartController::class, 'add_cart'])->name('add.cart');


Route::post('user-register', [App\Http\Controllers\Frontend\UserController::class, 'user_register'])->name('user.register');

    Route::get('user-logout', [App\Http\Controllers\Frontend\UserController::class, 'user_logout'])->name('user.logout');


// USER LOGIN
Route::get( 'login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get( 'login-check', 'Auth\LoginController@loginCheck');

// USER DASHBOARD
Route::group( ['namespace' => 'Frontend', 'prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::view( 'dashboard', 'layouts.frontend_app' );
    Route::view( 'profile', 'layouts.frontend_app' );
});

// ==========ADMIN LOGIN==========
Route::get( 'admin/login', 'Auth\AdminLoginController@login' )->name( 'admin.loginme' );


// AUTH VERIFY FALSE
Auth::routes(['verify' => false]);

// FOR STORAGE LINKED IN PUBLIC FOLDER
Route::get( '/sym', function () {
    File::link( storage_path( 'app/public' ), public_path( 'storage' ));
    return response()->json( "Link Create Successfully!" );
});

// CACHE CLEAR
Route::get( '/clear', function () {
    Artisan::call( 'optimize:clear' );
    return response()->json( "Cache Cleared Successfully!" );
});
