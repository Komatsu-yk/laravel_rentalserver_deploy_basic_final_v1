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

Route::get('/', 'PostController@index');

Auth::routes();

Route::resource('posts', 'PostController');

Route::get('/users/edit', 'UserController@edit')->name('users.edit');
Route::patch('/users', 'UserController@update')->name('users.update');

Route::resource('users', 'UserController')->only([
    'show',
]);

Route::resource('follows', 'FollowController')->only([
    'index', 'store', 'destroy'
]);
Route::get('/follower', 'FollowController@followerIndex');