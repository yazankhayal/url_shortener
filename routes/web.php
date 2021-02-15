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

Auth::routes();

Route::get('/', 'HomePageController@index')->name('index');

Route::post('/url/post', 'URLController@url_post')->name('url.post');
Route::get('{code?}', 'URLController@url_view')->name('url_view');

Route::get('/home', 'HomeController@index')->name('home');
