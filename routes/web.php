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

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'PageController@index')->name('home');
Route::get('/belanja', 'PageController@belanja')->name('belanja');
Route::get('{slug}', 'PageController@detailProduct')->where('slug', '[0-9\-]+[a-z\-]+');
Route::get('toko/{slug}', 'PageController@detailToko')->where('slug', '[a-z\-]+');

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

Route::get('payment-confirmation', 'PaymentConfirmationController@create')
->name('payment-confirmation.create');
Route::post('payment-confirmation', 'PaymentConfirmationController@store')
->name('payment-confirmation.store');
Route::get('payment-confirmation/{paymentConfirmation}/edit', 'PaymentConfirmationController@edit')
->name('payment-confirmation.edit');
Route::get('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@show')
->name('payment-confirmation.show');
Route::patch('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@update')
->name('payment-confirmation.update');
Route::delete('payment-confirmation/{paymentConfirmation}', 'PaymentConfirmationController@destroy')
->name('payment-confirmation.destroy');

//order (pembelian)
Route::get('buy', 'BuyController@index')->name('buy.index');
Route::get('buy/completed', 'BuyController@completed')->name('buy.completed');
Route::get('buy/{order}', 'BuyController@show')->name('buy.show');
Route::post('buy/{order}/complete', 'BuyController@completing')->name('buy.completing');

//refund
Route::get('refund', 'RefundController@index')->name('refund.index');
Route::get('refund/{refund}', 'RefundController@show')->name('refund.show');

//order (penjualan)
Route::get('sales', 'SalesController@index')->name('sales.index');
Route::get('sales/{order}', 'SalesController@show')->name('sales.show');
Route::patch('sales/{order}/accept', 'SalesController@accept')->name('sales.accept');
Route::patch('sales/{order}/send', 'SalesController@send')->name('sales.send');
Route::patch('sales/{order}/update-resi', 'SalesController@updateResi')->name('sales.update.resi');

//pendapatan toko
Route::get('admin-payment', 'AdminPaymentController@index')->name('adminPayment.index');
Route::get('admin-payment/{adminPayment}', 'AdminPaymentController@show')->name('adminPayment.show');

//Store
Route::get('store/yours', 'StoreController@yours')->name('store.yours');
Route::get('store/create', 'StoreController@create')->name('store.create');
Route::post('store', 'StoreController@store')->name('store.store');
Route::get('store/{store}', 'StoreController@show')->name('store.show');
Route::patch('store/{store}', 'StoreController@update')->name('store.update');

//profile
Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::patch('profile', 'ProfileController@update')->name('profile.update');
Route::get('change-password', 'ProfileController@editPassword')->name('profile.change-password');
Route::patch('change-password', 'ProfileController@updatePassword')->name('profile.update-password');
Route::patch('profile/change-photo', 'ProfileController@changePhoto')->name('profile.change-photo');

//FOR ADMIN ROLE
Route::prefix('admin')->group(function(){
	//Dashboard
	Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

	//payment
	Route::get('payment', 'Admin\PaymentController@index')->name('admin.payment.index');
	Route::get('payment/{payment}/detail', 'Admin\PaymentController@detail')->name('admin.payment.detail');
	Route::patch('payment/{payment}/done', 'Admin\PaymentController@done')->name('admin.payment.done');

	//Admin Payment
	Route::get('admin-payment', 'Admin\AdminPaymentController@index')->name('admin.adminPayment.index');
	Route::get('admin-payment/create/{code}', 'Admin\AdminPaymentController@create')->name('admin.adminPayment.create');
	Route::post('admin-payment', 'Admin\AdminPaymentController@store')->name('admin.adminPayment.store');
	Route::get('admin-payment/{code}', 'Admin\AdminPaymentController@show')->name('admin.adminPayment.show');

	//refund
	Route::get('refund', 'Admin\RefundController@index')->name('admin.refund.index');
	Route::get('refund/create/{code}', 'Admin\RefundController@create')->name('admin.refund.create');
	Route::post('refund', 'Admin\RefundController@store')->name('admin.refund.store');
	Route::get('refund/{code}', 'Admin\RefundController@show')->name('admin.refund.show');

	//store
	Route::get('store', 'Admin\StoreController@index')->name('admin.store.index');
	Route::get('store/{store}', 'Admin\StoreController@show')->name('admin.store.show');
	Route::patch('store/{store}/activate', 'Admin\StoreController@activate')->name('admin.store.activate');
	Route::patch('store/{store}/nonactivate', 'Admin\StoreController@nonActivate')->name('admin.store.nonactivate');
});

//Additional for ajax
Route::get('additional/province', 'AdditionalController@province')->name('additional.province');
Route::get('additional/city/{province}', 'AdditionalController@city')->name('additional.city');