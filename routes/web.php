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

Route::get('/', function () {
    return view('home.index');
})->name('home');
Route::get('/about', function () {
    return view('home.about');
});
Route::get('/men', function () {
    return view('home.men.index');
});
Route::get('/detail', function () {
    return view('home.detail.index');
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
        });
    });
});
