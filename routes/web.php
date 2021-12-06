<?php

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

Route::get('/', 'HomeController@index');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::get('register/cities/{id?}', 'Auth\RegisterController@cities')->name('select_city');	
Route::get('register/districts/{id?}', 'Auth\RegisterController@districts')->name('select_district');	
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::get('profile/cities/{id?}', ['as' => 'profile.select_city', 'uses' => 'ProfileController@cities']);
	Route::get('profile/districts/{id?}', ['as' => 'profile.select_district', 'uses' => 'ProfileController@districts']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

// manager protected routes
Route::group(['middleware' => ['auth', 'manager'], 'prefix' => 'manager'], function () {
	// sales transaction report
	Route::get('sales_transaction', 'Manager\SalesReportController@index')->name('manager.sales.index');  
	Route::get('sales_transaction/{year}/{month}', 'Manager\SalesReportController@show')->name('manager.sales.show');
	
	// distributor report
	Route::get('distributor', 'Manager\DistributorReportController@index')->name('manager.distributor.index');  
	Route::get('distributor/{provinceId}', 'Manager\DistributorReportController@show')->name('manager.distributor.show');
	
	// loan report
	Route::get('loan', 'Manager\LoanReportController@index')->name('manager.loan.index');
	Route::get('loan/{id}/{action}', 'Manager\LoanReportController@show')->name('manager.loan.show');
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
	// user management
	Route::get('user', 'Admin\UserController@index')->name('user.index');  
	Route::get('user/create', 'Admin\UserController@create')->name('user.create'); 
	Route::post('user', 'Admin\UserController@store')->name('user.store');
	Route::get('user/{id}', 'Admin\UserController@show')->name('user.show');
	Route::get('user/{id}/edit', 'Admin\UserController@edit')->name('user.edit');
	Route::get('user/cities/{id?}', 'Admin\UserController@cities')->name('user.select_city');	
	Route::get('user/districts/{id?}', 'Admin\UserController@districts')->name('user.select_district');	
	Route::patch('user/{id}', 'Admin\UserController@update')->name('user.update');
	Route::delete('user/{id}', 'Admin\UserController@destroy')->name('user.destroy');

	// production management
	Route::get('production', 'Admin\ProductionController@index')->name('production.index'); 
	Route::get('production/create', 'Admin\ProductionController@create')->name('production.create'); 
	Route::post('production', 'Admin\ProductionController@store')->name('production.store');
	Route::delete('production/{id}', 'Admin\ProductionController@destroy')->name('production.destroy');
	Route::get('production/{id}', 'Admin\ProductionDetailController@index')->name('production.show');
	Route::post('production/add', 'Admin\ProductionDetailController@store')->name('production.addItem');
	Route::post('production/{id}/produce', 'Admin\ProductionDetailController@produce')->name('production.produce');
	Route::delete('production/{id}/remove', 'Admin\ProductionDetailController@destroy')->name('production.removeItem');

	// sales transaction management
	Route::get('sales_transaction', 'Admin\SalesTransactionController@index')->name('admin.sales_transaction.index');  
	Route::get('sales_transaction/create', 'Admin\SalesTransactionController@create')->name('admin.sales_transaction.create'); 
	Route::post('sales_transaction', 'Admin\SalesTransactionController@store')->name('admin.sales_transaction.store');
	Route::get('sales_transaction/{id}/edit', 'Admin\SalesTransactionController@edit')->name('admin.sales_transaction.edit');
	Route::patch('sales_transaction/{id}', 'Admin\SalesTransactionController@update')->name('admin.sales_transaction.update')->where('id', '[0-9]+');
	Route::get('sales_transaction/{id}/{action}', 'Admin\SalesTransactionDetailController@index')->name('admin.sales_transaction.show')->where('id', '[0-9]+');
	Route::post('sales_transaction/add', 'Admin\SalesTransactionDetailController@store')->name('admin.sales_transaction.addItem');
	Route::post('sales_transaction/{id}/submit_order', 'Admin\SalesTransactionDetailController@submitOrder')->name('admin.sales_transaction.submitOrder');
	Route::post('sales_transaction/{id}/approve_loan', 'Admin\SalesTransactionDetailController@approveLoan')->name('admin.sales_transaction.approveLoan');
	Route::post('sales_transaction/{id}/finish', 'Admin\SalesTransactionDetailController@finishTransaction')->name('admin.sales_transaction.finishTransaction');
	Route::delete('sales_transaction/{id}/remove', 'Admin\SalesTransactionDetailController@destroy')->name('admin.sales_transaction.removeItem');
	
	// payment management
	Route::get('payment', 'Admin\PaymentController@index')->name('admin.payment.index');  
	Route::post('payment/{salesTransactionId}/{paymentId}/confirm_full_payment', 'Admin\PaymentController@confirmFullPayment')->name('payment.confirmFullPayment');
	Route::post('payment/{salesTransactionId}/{paymentId}/confirm_loan_payment', 'Admin\PaymentController@confirmLoanPayment')->name('payment.confirmLoanPayment');
	Route::get('payment/{id}/create', 'Admin\PaymentController@create')->name('admin.payment.create'); 
	Route::post('payment', 'Admin\PaymentController@store')->name('admin.payment.store');
	Route::get('payment/{id}', 'Admin\PaymentController@show')->name('admin.payment.show');

	// loan management
	Route::get('loan', 'Admin\PaymentController@loanIndex')->name('admin.loan.index');
	Route::get('loan/{id}/{action}', 'Admin\PaymentController@loanShow')->name('admin.loan.show');  

	// delivery management
	Route::get('delivery', 'Admin\DeliveryController@index')->name('delivery.index');  
	Route::get('delivery/{id}/create', 'Admin\DeliveryController@create')->name('delivery.create'); 
	Route::post('delivery', 'Admin\DeliveryController@store')->name('delivery.store');
	Route::get('delivery/{id}/edit', 'Admin\DeliveryController@edit')->name('delivery.edit');
	Route::get('delivery/{id}/editItem', 'Admin\DeliveryDetailController@edit')->name('delivery.editItem');
	Route::get('delivery/{id}/{action}', 'Admin\DeliveryDetailController@index')->name('delivery.show');
	Route::patch('delivery/{id}', 'Admin\DeliveryController@update')->name('delivery.update');
	Route::delete('delivery/{id}', 'Admin\DeliveryController@destroy')->name('delivery.destroy');
	Route::patch('delivery/{id}/updateItem', 'Admin\DeliveryDetailController@update')->name('delivery.updateItem');
	Route::delete('delivery/{id}/remove', 'Admin\DeliveryDetailController@destroy')->name('delivery.removeItem');

	// product return management
	Route::get('return', 'Admin\ProductReturnController@index')->name('admin.return.index');
	Route::get('return/{id}/create', 'Admin\ProductReturnController@create')->name('admin.return.create');
	Route::post('return', 'Admin\ProductReturnController@store')->name('admin.return.store');
	Route::get('return/{id}', 'Admin\ProductReturnDetailController@index')->name('admin.return.show');
	Route::get('return/{id}/editItem', 'Admin\ProductReturnDetailController@edit')->name('admin.return.editItem');
	Route::patch('return/{id}/updateItem', 'Admin\ProductReturnDetailController@update')->name('admin.return.updateItem');
	Route::delete('return/{id}/remove', 'Admin\ProductReturnDetailController@destroy')->name('admin.return.removeItem');
	Route::post('return/{id}/submit_return', 'Admin\ProductReturnDetailController@submitReturn')->name('admin.return.submit');
	Route::post('return/{id}/decline_return', 'Admin\ProductReturnDetailController@declineReturn')->name('admin.return.decline');
	Route::post('return/{id}/{salesTransactionId}/confirm_return', 'Admin\ProductReturnDetailController@confirmReturn')->name('admin.return.confirm');
	
	// goods management
	Route::get('goods', 'Admin\GoodsController@index')->name('goods.index'); 
	Route::get('goods/create', 'Admin\GoodsController@create')->name('goods.create');
	Route::post('goods', 'Admin\GoodsController@store')->name('goods.store');
	Route::get('goods/{id}/edit', 'Admin\GoodsController@edit')->name('goods.edit');
	Route::patch('goods/{id}', 'Admin\GoodsController@update')->name('goods.update');
	Route::delete('goods/{id}', 'Admin\GoodsController@destroy')->name('goods.destroy');

	// driver management
	Route::get('driver', 'Admin\DriverController@index')->name('driver.index'); 
	Route::get('driver/create', 'Admin\DriverController@create')->name('driver.create');
	Route::post('driver', 'Admin\DriverController@store')->name('driver.store');
	Route::get('driver/{id}/edit', 'Admin\DriverController@edit')->name('driver.edit');
	Route::patch('driver/{id}', 'Admin\DriverController@update')->name('driver.update');
	Route::delete('driver/{id}', 'Admin\DriverController@destroy')->name('driver.destroy');

	// vehicle management
	Route::get('vehicle', 'Admin\VehicleController@index')->name('vehicle.index'); 
	Route::get('vehicle/create', 'Admin\VehicleController@create')->name('vehicle.create');
	Route::post('vehicle', 'Admin\VehicleController@store')->name('vehicle.store');
	Route::get('vehicle/{id}/edit', 'Admin\VehicleController@edit')->name('vehicle.edit');
	Route::patch('vehicle/{id}', 'Admin\VehicleController@update')->name('vehicle.update');
	Route::delete('vehicle/{id}', 'Admin\VehicleController@destroy')->name('vehicle.destroy');
});

// distributor protected routes
Route::group(['middleware' => ['auth', 'distributor'], 'prefix' => 'distributor'], function () {
    // sales transaction management
	Route::get('sales_transaction', 'Distributor\SalesTransactionController@index')->name('distributor.sales_transaction.index');  
	Route::get('sales_transaction/create', 'Distributor\SalesTransactionController@create')->name('distributor.sales_transaction.create'); 
	Route::post('sales_transaction', 'Distributor\SalesTransactionController@store')->name('distributor.sales_transaction.store');
	Route::get('sales_transaction/{id}/{action}', 'Distributor\SalesTransactionDetailController@index')->name('distributor.sales_transaction.show');
	Route::post('sales_transaction/add', 'Distributor\SalesTransactionDetailController@store')->name('distributor.sales_transaction.addItem');
	Route::post('sales_transaction/{id}/order', 'Distributor\SalesTransactionDetailController@Order')->name('distributor.sales_transaction.order');
	Route::post('sales_transaction/{id}/finish', 'Distributor\SalesTransactionDetailController@finishTransaction')->name('distributor.sales_transaction.finishTransaction');
	Route::delete('sales_transaction/{id}/remove', 'Distributor\SalesTransactionDetailController@destroy')->name('distributor.sales_transaction.removeItem');

	// payment management
	Route::get('payment', 'Distributor\PaymentController@index')->name('distributor.payment.index');  
	Route::get('payment/{id}/create', 'Distributor\PaymentController@create')->name('distributor.payment.create');
	Route::post('payment', 'Distributor\PaymentController@store')->name('distributor.payment.store');
	Route::get('payment/{id}', 'Distributor\PaymentController@show')->name('distributor.payment.show');

	// product return management
	Route::get('return', 'Distributor\ProductReturnController@index')->name('distributor.return.index');
	Route::get('return/{id}/create', 'Distributor\ProductReturnController@create')->name('distributor.return.create');
	Route::post('return', 'Distributor\ProductReturnController@store')->name('distributor.return.store');
	Route::get('return/{id}', 'Distributor\ProductReturnDetailController@index')->name('distributor.return.show');
	Route::get('return/{id}/editItem', 'Distributor\ProductReturnDetailController@edit')->name('distributor.return.editItem');
	Route::patch('return/{id}/updateItem', 'Distributor\ProductReturnDetailController@update')->name('distributor.return.updateItem');
	Route::delete('return/{id}/remove', 'Distributor\ProductReturnDetailController@destroy')->name('distributor.return.removeItem');
	Route::post('return/{id}/submit_return', 'Distributor\ProductReturnDetailController@submitReturn')->name('distributor.return.submit');
	
	// loan management
	Route::get('loan/{id}', 'Distributor\PaymentController@loanShow')->name('distributor.loan.show');  

});
