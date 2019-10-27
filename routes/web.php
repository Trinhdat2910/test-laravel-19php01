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
    return view('welcome');
});

Auth::routes();

Route::group(['namespace' => 'Admin'], function(){
    Route::get('/admin', 'HomeController@index')->name('admin');
    Route::group(['prefix'=>'admin'], function() {
        Route::group(['prefix'=>'products'], function() {
            Route::get('/add', ['as' => 'admin.products.add', 'uses' =>'ProductsController@getAdd']);
            Route::post('/postadd', ['as' => 'admin.products.postadd', 'uses' =>'ProductsController@postAdd']);
        });
    });
});