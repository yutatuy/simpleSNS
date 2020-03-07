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
    return view('index');
});
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/create', 'PostController@showCreateForm')->name('posts.create');
Route::post('/posts/create', 'PostController@create');
Route::get('/posts/{post}', 'PostController@detail')->name('posts.detail');
Route::get('/posts/{post}/edit', 'PostController@showEditForm')->name('posts.edit');
Route::post('/posts/{post}/edit', 'PostController@edit');
Route::get('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');

// Route::get('/', 'HomeController@index')->name('home');
