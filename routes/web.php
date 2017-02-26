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

Auth::routes();
Route::get('/', 'IndexController@login');
Route::get('/home', 'HomeController@index');
Route::get('/main', 'IndexController@index');
Route::get('add_item', 'AddItemController@add_item');
Route::get('add_item_post', 'AddItemController@add_item_post');
