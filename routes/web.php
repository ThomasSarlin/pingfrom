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

Route::get('/', 'PagesController@index');
Route::get('/chat', 'PostsController@index');
Route::get('/ping', 'PingsController@index');
Route::get('/stats', 'PagesController@stats');

Route::resource('minimalusers','UserController');
Route::resource('posts','PostsController');
Route::resource('ping', 'PingsController');
Route::get('ping/ping','Pingscontroller@ping');