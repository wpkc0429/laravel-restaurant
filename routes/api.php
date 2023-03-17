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

    Route::get('/stores', 'StoreController@index')->name('.store.index');

    Route::group(['prefix' => '/store', 'as' => '.store'], function () {

        Route::post('/', 'StoreController@store')->name('.store');
        Route::group(['prefix' => '{store_id}'], function () {
            Route::get('/', 'StoreController@show')->name('.show');
            Route::put('/', 'StoreController@update')->name('.update');
            Route::delete('/', 'StoreController@destroy')->name('.destroy');

            Route::get('/foods', 'FoodController@index')->name('.food.index');

            Route::group(['prefix' => '/food', 'as' => '.food'], function () {

                Route::post('/', 'FoodController@store')->name('.store');
                Route::group(['prefix' => '{food_id}'], function () {
                    Route::get('/', 'FoodController@show')->name('.show');
                    Route::put('/', 'FoodController@update')->name('.update');
                    Route::delete('/', 'FoodController@destroy')->name('.destroy');                   
                });

            });
        });

    });

});
