<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/wishlistHandler', 'App\Http\Controllers\WishlistController@wishlistHandler');
Route::post('/addComment', 'App\Http\Controllers\SingleProductController@addComment');
Route::post('/addRaiting', 'App\Http\Controllers\SingleProductController@addRaiting');
Route::post('/addToCart', 'App\Http\Controllers\SingleProductController@addToCart');
Route::get('/wishlistDelete/{user_id}/{wishl_id}', 'App\Http\Controllers\WishlistController@wishlistDelete');
Route::get('/search', 'App\Http\Controllers\ShopController@search');

Route::prefix('shop')->group(function () {
    Route::get('/', 'App\Http\Controllers\ShopController@index');
    Route::get('/short/{methodShort}/{shopProducts}', 'App\Http\Controllers\ShopController@short')
        ->where([
            'methodShort'  => '[0-9]',
            'shopProducts' => '.*'
        ]);
    Route::get('/quickView/{id_quickView}', 'App\Http\Controllers\ShopController@quickView');
    Route::get('/categories/{tagID}', 'App\Http\Controllers\ShopController@categories');
    Route::get('/size/{size_name}', 'App\Http\Controllers\ShopController@size');
    Route::get('/pricefromto/{priceFrom}/{priceTo}/{shopProducts}', 'App\Http\Controllers\ShopController@priceFromTo');
    Route::get('/searchAjax/{nameSearch}', 'App\Http\Controllers\ShopController@searchAjax');
    Route::get('/listproduct/{listProductsID}', 'App\Http\Controllers\ShopController@productsInShop');
    Route::get('/wishlists/{user_id}', 'App\Http\Controllers\ShopController@wishlists');
});
Route::prefix('product')->group(function () {
    Route::get('/{id}', 'App\Http\Controllers\SingleProductController@index');
    Route::get('/commentsAjax/{product_id}', 'App\Http\Controllers\SingleProductController@commentsAjax');
    Route::get('/raitingAjax/{product_id}', 'App\Http\Controllers\SingleProductController@raitingAjax');
});
Route::prefix('wishlist')->group(function () {
    Route::get('/', 'App\Http\Controllers\WishlistController@index');
    Route::get('/wishlist/{user_di}', 'App\Http\Controllers\WishlistController@wishlist');
});
Route::prefix('cart')->group(function () {
    Route::get('/', 'App\Http\Controllers\CartController@index');
    Route::get('/getProduct', 'App\Http\Controllers\CartController@getProduct');
    Route::get('/cartDelete/{id}', 'App\Http\Controllers\CartController@cartDelete');
    Route::get('/quantityChange/{id}/{method}', 'App\Http\Controllers\CartController@quantityChange');
});
Route::prefix('checkout')->group(function () {
    Route::get('/', 'App\Http\Controllers\ChechoutController@index');
    Route::get('/checkVoucher/{codeVoucher}', 'App\Http\Controllers\ChechoutController@checkVoucher');
});
Auth::routes(['verify' => true]);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// -----------------Login Google-----------------------
Route::get('google', [App\Http\Controllers\registerOrLoginController::class, 'redirectToGoogle'])->name('google');
Route::get('callback/google', [App\Http\Controllers\registerOrLoginController::class, 'handleGoogleCallback'])->name('callback/google');
//------------------Login && Register Normal------------
Route::post('postLogin', [App\Http\Controllers\registerOrLoginController::class, 'postLogin'])->name('postLogin');
Route::post('postRegister', [App\Http\Controllers\registerOrLoginController::class, 'postRegister'])->name('postRegister');


Route::get('my-account', [App\Http\Controllers\my_accountController::class, 'index'])->name('my-account');
Route::get('contact', [App\Http\Controllers\FeedbackController::class, 'index'])->name('contact');
Route::post('accountUpdate', [App\Http\Controllers\my_accountController::class, 'updateDetail']);
Route::post('feedback', [App\Http\Controllers\FeedbackController::class, 'postFeedback'])->name('feedback');
Route::post('crop', [App\Http\Controllers\my_accountController::class, 'crop'])->name('crop');
Route::post('payMomo', [App\Http\Controllers\CheckoutController::class, 'payMomo'])->name('payMomo');

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('manage-product', [App\Http\Controllers\AdminController::class, 'manage_product'])->name('manageProduct');
});
Route::prefix('/')->group(function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');
    Route::get('wishlists/{user_id}', 'App\Http\Controllers\HomeController@wishlists');
    Route::post('homeWishlistHandler', 'App\Http\Controllers\HomeController@wishlistHandler');
    Route::get('homeWishlistDelete/{user_id}/{wishl_id}', 'App\Http\Controllers\HomeController@wishlistDelete');
    Route::get('getProduct', 'App\Http\Controllers\HomeController@getProduct');
    Route::get('cartDelete/{id}', 'App\Http\Controllers\HomeController@cartDelete');
    Route::get('quantityChange/{id}/{method}', 'App\Http\Controllers\HomeController@quantityChange');
    Route::get('/listproduct/{listProductsID}', 'App\Http\Controllers\HomeController@productsInShop');
});




// code chưa xử lý
Route::get('/about-us', 'App\Http\Controllers\AboutUsController@index');
Route::get('/blog', 'App\Http\Controllers\BlogController@index');
Route::get('/error', 'App\Http\Controllers\ErrorController@index');
Route::get('/compare', 'App\Http\Controllers\CompareController@index');

