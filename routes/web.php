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


Route::group(['prefix' => '/restaurant', 'as' => 'restaurant','namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'RestaurantController@index')->name('.index');

    Route::group(['prefix' => '{restaurant}'], function () {

        Route::get('/', 'RestaurantController@show')->name('.show');

        Route::group(['prefix' => '/product', 'as' => '.product'], function () {

            Route::get('/', 'ProductController@index')->name('.product.index');

            Route::group(['prefix' => '{product}'], function () {
                Route::get('/', 'ProductController@show')->name('.show');                 
            });

        });
    });
});
