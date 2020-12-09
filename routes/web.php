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

Route::get('/admin/restaurants/create', 'RestaurantController@create')->name('restaurants.create');

Route::post('/admin/restaurants', 'RestaurantController@store')->name('restaurants.store');

Route::get('/search', 'SearchController@search')->name('search');
