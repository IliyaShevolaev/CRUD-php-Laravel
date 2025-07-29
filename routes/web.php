<?php

use App\Models\User\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store')->name('register.store');

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@store')->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/show-profile', 'App\Http\Controllers\Auth\ProfileController@index')->name('profile.index');
    Route::get('/edit-profile/{owner}', 'App\Http\Controllers\Auth\ProfileController@edit')->name('profile.edit');
    Route::patch('/edit-profile/{owner}', 'App\Http\Controllers\Auth\ProfileController@update')->name('profile.update');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@destroy')->name('login.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'App\Http\Controllers\User\UserController@index');

    Route::resource('users', \App\Http\Controllers\User\UserController::class);
    Route::resource('departments', \App\Http\Controllers\User\DepartmentController::class);
    Route::resource('positions', \App\Http\Controllers\User\PositionController::class);
});

Route::get('/test', function() {

});
