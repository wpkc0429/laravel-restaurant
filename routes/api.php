<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1', 'as' => 'api.v1','namespace' => 'App\Http\Controllers\API'], function () {

    Route::get('/restaurants', 'RestaurantController@index')->name('.restaurant.index');

    Route::group(['prefix' => '/restaurant', 'as' => '.restaurant'], function () {

        Route::post('/', 'RestaurantController@store')->name('.store');
        Route::group(['prefix' => '{restaurant}'], function () {
            Route::get('/', 'RestaurantController@show')->name('.show');
            Route::put('/', 'RestaurantController@update')->name('.update');
            Route::delete('/', 'RestaurantController@destroy')->name('.destroy');

            Route::get('/products', 'ProductController@index')->name('.product.index');

            Route::group(['prefix' => '/product', 'as' => '.product'], function () {

                Route::post('/', 'ProductController@store')->name('.store');
                Route::group(['prefix' => '{product}'], function () {
                    Route::get('/', 'ProductController@show')->name('.show');
                    Route::put('/', 'ProductController@update')->name('.update');
                    Route::delete('/', 'ProductController@destroy')->name('.destroy');                   
                });

            });
        });

    });

});
