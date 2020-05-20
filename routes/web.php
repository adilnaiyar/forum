<?php

use App\Http\Controllers\UserNotification;

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/discussion', 'DiscussionController');

Route::resource('/discussion/{discussion}/reply', 'ReplyController');

Route::post('/discussion/{discussion}/reply/{replies}/mark-as-best-reply', 'DiscussionController@bestreply')->name('discussions.best-reply');

Route::get('users/notifications', [UserNotification::class, 'notifications'])->name('users.notifications');

