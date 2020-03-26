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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'PostController@index')->name('posts.index');
    Route::get('/posts/create', 'PostController@showCreateForm')->name('posts.create');
    Route::post('/posts/create', 'PostController@create');
    Route::get('/posts/{post}', 'PostController@detail')->name('posts.detail');
    Route::get('/posts/{post}/edit', 'PostController@showEditForm')->name('posts.edit');
    Route::post('/posts/{post}/edit', 'PostController@edit');
    Route::delete('/posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    Route::get('/{user}', 'UserController@index')->name('user.index');
    Route::delete('/posts/{post}/unfavorite', 'FavoriteController@destroy')->name('favorites.unfavorite');
    Route::post('/posts/{post}/favorite', 'FavoriteController@store')->name('favorites.favorite');
    Route::post('/posts/{post}/replyCreate', 'PostController@replyCreate')->name('reply.create');
    Route::get('/', function () {
        return redirect(route('posts.index'));
    });
    Route::get('/posts/{post}/replyCreate', function () {
        return redirect()->route('posts.index');
    });
    Route::get('/posts/{post}/unfavorite', function () {
        return redirect()->route('posts.index');
    });
    Route::get('/posts/{post}/favorite', function () {
        return redirect()->route('posts.index');
    });
});
