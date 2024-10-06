<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store')->name('register.store');

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@store')->name('login.store');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@destroy')->middleware('auth')->name('login.logout');

Route::middleware('auth')->group(function () {
    Route::get('/posts', "App\Http\Controllers\Post\PostController@index")->name('post.index');
    Route::get('/create', "App\Http\Controllers\Post\PostController@create")->name('post.create');
    Route::get('/posts/find', "App\Http\Controllers\Post\PostController@find")->name('post.find');
    Route::get('/posts/{post}', "App\Http\Controllers\Post\PostController@show")->name('post.show');
    Route::get('/posts/{post}/edit', "App\Http\Controllers\Post\PostController@edit")->name('post.edit');
    Route::get('/posts/sort/{category}', "App\Http\Controllers\Post\PostController@sort")->name('post.sort');
    Route::post('/posts', 'App\Http\Controllers\Post\PostController@store')->name('post.store');
    Route::patch('/posts/{post}', "App\Http\Controllers\Post\PostController@update")->name('post.update');
    Route::delete('/posts/{post}', "App\Http\Controllers\Post\PostController@destroy")->name('post.delete');
});

Route::get('/admin', 'App\Http\Controllers\Auth\AdminController@index')->name('admin');