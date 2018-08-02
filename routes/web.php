<?php

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
//Auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

// FOR USER ROLE
Route::get('/', 'PageController@index')->name('home');

//product
Route::get('product/create', 'ProductController@create')->name('product.create');
Route::post('product', 'ProductController@store')->name('product.store');
Route::get('product/yours', 'ProductController@yours')->name('product.yours');
Route::get('product/{product}', 'ProductController@show')->name('product.show');
Route::get('product/{product}/edit', 'ProductController@edit')->name('product.edit');
Route::patch('product/{product}', 'ProductController@update')->name('product.update');
Route::delete('product/{product}', 'ProductController@destroy')->name('product.destory');
Route::get('product/{product}/setKosong', 'ProductController@setKosong')->name('product.setkosong');
Route::get('product/{product}/setTersedia', 'ProductController@setTersedia')->name('product.settersedia');

//cart
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::patch('cart/{cart}/change-jne-service', 'CartController@update')->name('cart.change-jne-service');
Route::delete('cart/{cart}/destroy', 'CartController@destroy')->name('cart.destroy');
Route::patch('cart/{cart_detail}/update-quantity', 'CartController@updateCartQuantity')->name('cart.update-quantity');
Route::delete('cart/{cart_detail}/delete-detail-cart', 'CartController@deleteCartDetail')->name('cart.delete-cart-detail');

//pembayaran (pembelian)
Route::get('payment', 'PaymentController@index')->name('payment.index');
Route::post('payment', 'PaymentController@store')->name('payment.store');
Route::get('payment/{code}', 'PaymentController@show')->name('payment.show');
Route::get('payment/{payment}/detail', 'PaymentController@detail')->name('payment.detail');
Route::patch('payment/{payment}/done', 'PaymentController@done')->name('payment.done');

Route::get('payment-confirmation', 'PaymentConfirmationController@create')->name('payment-confirmation.create');
Route::post('payment-confirmation', 'PaymentConfirmationController@store')->name('payment-confirmation.store');
Route::get('payment-confirmation/{paymentConfirmation}/edit', 'PaymentConfirmationController@edit')->name('payment-confirmation.edit');
Route::get('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@show')->name('payment-confirmation.show');
Route::patch('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@update')->name('payment-confirmation.update');
Route::delete('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@destroy')->name('payment-confirmation.destroy');

//order (pembelian)
Route::get('buy', 'BuyController@index')->name('buy.index');
Route::get('buy/completed', 'BuyController@completed')->name('buy.completed');
Route::get('buy/{order}', 'BuyController@show')->name('buy.show');
Route::post('buy/{order}/complete', 'BuyController@completing')->name('buy.completing');

//order (penjualan)
Route::get('sales', 'SalesController@index')->name('sales.index');
Route::get('sales/{order}', 'SalesController@show')->name('sales.show');
Route::patch('sales/{order}/accept', 'SalesController@accept')->name('sales.accept');
Route::patch('sales/{order}/send', 'SalesController@send')->name('sales.send');
Route::patch('sales/{order}/update-resi', 'SalesController@updateResi')->name('sales.update.resi');

//Store
Route::get('store', 'StoreController@index')->name('store.index');
Route::get('store/yours', 'StoreController@yours')->name('store.yours');
Route::get('store/create', 'StoreController@create')->name('store.create');
Route::post('store', 'StoreController@store')->name('store.store');
Route::get('store/{store}', 'StoreController@show')->name('store.show');
Route::patch('store/{store}', 'StoreController@update')->name('store.update');
Route::patch('store/{store}/activate', 'StoreController@activate')->name('store.activate');
Route::patch('store/{store}/nonactivate', 'StoreController@nonActivate')->name('store.nonactivate');

//FOR ADMIN ROLE
//Dashboard
Route::get('dashboard', 'PageController@dashboard')->name('dashboard');

//Additional for ajax
Route::get('additional/province', 'AdditionalController@province')->name('additional.province');
Route::get('additional/city/{province}', 'AdditionalController@city')->name('additional.city');