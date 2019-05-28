<?php

use App\Events\ChatMessageEvent;
use App\Events\ControlChannelEvent;
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

Route::post('/chat/{chat}', function (App\Chat $chat, Request $request) {
    
    broadcast(new ChatMessageEvent(
            Auth::user()->name,
            $chat,
            $request->input('message') //todo sanitize
            )
    )->toOthers();

	return ["ok" => true];
});

Route::get('/control', function () {
    
    broadcast(new ControlChannelEvent(
            Auth::user(),
            "msg control"
    ));

	return ["ok" => Auth::user()];
});

Route::get('/to/{chat}', function (App\Chat $chat) {

       broadcast(new ChatMessageEvent(
            Auth::user()->name,
            $chat,
            "HOLAAAA"
            )
    )->toOthers();


	return ["ok" => Auth::user()];
});

Route::get('/home', 'HomeController@index')->name('home');
