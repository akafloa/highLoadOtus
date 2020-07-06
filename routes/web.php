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
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/{nickName}', 'UserController@profile')->name('user_profile');
Route::get('/reports/mysql', 'ReportController@mysql');
Route::get('/reports/clickhouse', 'ReportController@clickhouse');

Route::get('/user/search/{name?}', 'UserController@search')->name('user_search');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/user/feed', 'UserController@feed')->name('feed');
    Route::get('/user/message/{toUserId?}', 'MessageController@index')->name('message');
    Route::post('/user/message/send', 'MessageController@send')->name('send');
    
    Route::get('/user/t/test', 'UserController@test');
    Route::get('/user/postadd', 'PostController@insert');
    Route::get('/user/test', function(){
        
        $localsocket = 'tcp://127.0.0.1:1234';
        $user = 5;
        $message = 'test';

        // соединяемся с локальным tcp-сервером
        $instance = stream_socket_client($localsocket);
        //dump($instance);
        // отправляем сообщение
        fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n");
    
        
    });
});