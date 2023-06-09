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
Route::get('/', function () {
    return redirect()->route('store.index');
});

Route::group(['prefix' => '/store', 'as' => 'store','namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'StoreController@index')->name('.index');

    Route::post('/datatable', 'StoreController@datatable')->name('.datatable');

    Route::group(['prefix' => '{store}'], function () {

        Route::get('/', 'StoreController@show')->name('.show');

        Route::group(['prefix' => '/food', 'as' => '.food'], function () {

            Route::get('/', 'FoodController@index')->name('.index');

            Route::post('/datatable', 'FoodController@datatable')->name('.datatable');

            Route::group(['prefix' => '{food}'], function () {
                Route::get('/', 'FoodController@show')->name('.show');                 
            });

        });
    });
});
