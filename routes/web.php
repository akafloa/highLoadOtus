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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{nickName}', 'UserController@profile')->name('user_profile');

Route::get('/user/search/{name?}', 'UserController@search')->name('user_search');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/user/feed', 'UserController@feed')->name('feed');
    Route::get('/user/message/{toUserId?}', 'MessageController@index')->name('message');
    Route::post('/user/message/send', 'MessageController@send')->name('send');
    
});