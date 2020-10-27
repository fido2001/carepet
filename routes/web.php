<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('', 'AdminController@index');
    // Route::get('/{user:username}', 'AdminController@editProfile');
    // Route::patch('/{user:username}', 'AdminController@updateProfile');
});

Route::prefix('petshop')->middleware('auth')->group(function () {
    Route::get('', 'PetshopController@index');
    // Route::get('/{user:username}', 'PetshopController@editProfile');
    // Route::patch('/{user:username}', 'PetshopController@updateProfile');
});

Route::prefix('petowner')->middleware('auth')->group(function () {
    Route::get('', 'PetownerController@index');
    Route::get('/{user:username}', 'PetownerController@editProfile');
    Route::patch('/{user:username}', 'PetownerController@updateProfile');
});
