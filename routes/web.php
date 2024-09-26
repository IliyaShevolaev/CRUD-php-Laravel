<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.main');
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/posts', "App\Http\Controllers\PostController@index")->name('post.index');
Route::get('/create', "App\Http\Controllers\PostController@create")->name('post.create');
Route::get('/posts/{post}', "App\Http\Controllers\PostController@show")->name('post.show');
Route::get('/posts/{post}/edit', "App\Http\Controllers\PostController@edit")->name('post.edit');

Route::post('/posts', 'App\Http\Controllers\PostController@store')->name('post.store');

Route::patch('/posts/{post}', "App\Http\Controllers\PostController@update")->name('post.update');

Route::delete('/posts/{post}', "App\Http\Controllers\PostController@destroy")->name('post.delete');
