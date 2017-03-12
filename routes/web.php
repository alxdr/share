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
Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index');
	Route::get('/main', 'IndexController@index')->name('main');
	Route::get('add_item', 'ItemController@add_item');
	Route::post('add_item_post', 'ItemController@add_item_post');
	Route::get('update_item', 'ItemController@update_item');
	Route::post('update_item_post', 'ItemController@update_item_post');
	Route::post('delete_item_post', 'ItemController@delete_item_post');
	Route::get('bid_item', 'BidController@bid_item');
	Route::post('submit_bid_info', 'BidController@bid_for_item')->name('submit_bid_info');
	Route::get('message', 'MessageController@convo');
	Route::get('send', 'MessageController@send');
	Route::post('send', 'MessageController@sending');
});
?>
