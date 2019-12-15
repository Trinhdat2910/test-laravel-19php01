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

Route::get('/',['as' => 'home.index', 'uses' =>'HomeController@index']);
Route::get('/home',['as' => 'home', 'uses' =>'HomeController@index']);
Route::get('/collection/{key}',['as' => 'home.collection', 'uses' =>'HomeController@collection']);
Route::get('/products/{id}',['as' => 'home.product.detail', 'uses' =>'ProductsController@detail']);
Route::get('/getZise',['as' => 'home.product.getSize', 'uses' =>'ProductsController@getSize']);
Route::get('/about', function () {
    return view('home.about');
});


// Route::get('/home', function () {
//     return view('home');
// })->name('home');
Auth::routes(['verify' => false, 'register' => false]);
Route::group(['namespace' => 'Auth'], function() {

    Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@showRegister']);
    Route::post('/register', ['as' => 'register', 'uses' => 'RegisterController@create']);
});
Auth::routes();
Route::group(['middleware' => 'verified'], function(){
    Route::post('/addCart',['as' => 'home.product.addCart', 'uses' =>'CartController@addCart']);
    Route::get('/cart',['as' => 'home.cart', 'uses' =>'CartController@getCart']);
    Route::get('/removeItemCart/{id}',['as' => 'home.cart.removeItem', 'uses' =>'CartController@removeItemCart']);
    Route::post('/updateCart',['as' => 'home.cart.updateCart', 'uses' =>'CartController@updateCart']);
    Route::post('/cart/order',['as' => 'home.products.order', 'uses' =>'CartController@orderCart']);
    Route::get('/order',['as' => 'home.products.getOrder', 'uses' =>'CartController@getOrderByUser']);
    Route::get('/profile/{id}',['as' => 'home.user.getProfile', 'uses' =>'UsersController@getProfile']);
    Route::post('/profile/{id}',['as' => 'home.user.update', 'uses' =>'UsersController@update']);

});
Route::group(['namespace' => 'Admin', 'middleware' => 'verified', 'middleware' => 'administrator'], function(){
    Route::get('/admin', 'HomeController@index')->name('admin');
    Route::group(['prefix'=>'admin'], function() {
        // products
        Route::group(['prefix'=>'products'], function() {
            Route::get('/add', ['as' => 'admin.products.add', 'uses' =>'ProductsController@getAdd']);
            Route::post('/postadd', ['as' => 'admin.products.postadd', 'uses' =>'ProductsController@postAdd']);
            Route::get('/list', ['as' => 'admin.products.list', 'uses' =>'ProductsController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.products.getEdit', 'uses' =>'ProductsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.products.postEdit', 'uses' =>'ProductsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.products.delete', 'uses' =>'ProductsController@delete']);
            Route::get('/detail/{id}', ['as' => 'admin.products.detail', 'uses' =>'ProductsController@detail']);
        });
        //supplier
        Route::group(['prefix'=>'supplier'], function() {
            Route::get('/add', ['as' => 'admin.supplier.add', 'uses' =>'SupplierController@getAdd']);
            Route::post('/postadd', ['as' => 'admin.supplier.postadd', 'uses' =>'SupplierController@postAdd']);
            Route::get('/list', ['as' => 'admin.supplier.list', 'uses' =>'SupplierController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.supplier.getEdit', 'uses' =>'SupplierController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.supplier.postEdit', 'uses' =>'SupplierController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.supplier.delete', 'uses' =>'SupplierController@delete']);
        });
        // warehouse
        Route::group(['prefix'=>'warehouse'], function() {
            Route::get('/add', ['as' => 'admin.warehouse.add', 'uses' =>'WarehouseController@getAdd']);
            Route::post('/postadd', ['as' => 'admin.warehouse.postadd', 'uses' =>'WarehouseController@postAdd']);
            Route::get('/list', ['as' => 'admin.warehouse.list', 'uses' =>'WarehouseController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.warehouse.getEdit', 'uses' =>'WarehouseController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.warehouse.postEdit', 'uses' =>'WarehouseController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.warehouse.delete', 'uses' =>'WarehouseController@delete']);
            Route::get('/approved/{id}', ['as' => 'admin.warehouse.approved', 'uses' =>'WarehouseController@approved']);
            Route::get('/payment/{id}', ['as' => 'admin.warehouse.payment', 'uses' =>'WarehouseController@payment']);
        });
        // products
        Route::group(['prefix'=>'users'], function() {
            Route::get('/list', ['as' => 'admin.users.list', 'uses' =>'UsersController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.users.getEdit', 'uses' =>'UsersController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.users.postEdit', 'uses' =>'UsersController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.users.delete', 'uses' =>'UsersController@delete']);
            Route::get('/detail/{id}', ['as' => 'admin.users.detail', 'uses' =>'UsersController@detail']);
            Route::get('/add', ['as' => 'admin.users.add', 'uses' =>'UsersController@getAdd']);
            Route::post('/add', ['as' => 'admin.users.postAdd', 'uses' =>'UsersController@postAdd']);
        });
        Route::group(['prefix'=>'transaction'], function() {
            Route::get('/list', ['as' => 'admin.transaction.list', 'uses' =>'TransactionController@index']);
        });
        Route::group(['prefix'=>'order'], function() {
            Route::get('/list', ['as' => 'admin.order.list', 'uses' =>'OrderController@index']);
            Route::get('/detail/{id}', ['as' => 'admin.order.detail', 'uses' =>'OrderController@detail']);
            Route::get('/edit/{id}', ['as' => 'admin.order.edit', 'uses' =>'OrderController@edit']);
            Route::post('/update/{id}', ['as' => 'admin.order.update', 'uses' =>'OrderController@update']);
            Route::get('/delete/{id}', ['as' => 'admin.order.delete', 'uses' =>'OrderController@delete']);
        });
    });
});
