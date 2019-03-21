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

Route::get('home', 'HomeController@index');

//Product's route
Route::get('product/index','ProductsController@index');
Route::get('product/view/{id}','ProductsController@show');
Route::get('search', 'ProductsController@search');
Route::get('filter', 'ProductsController@filter');



