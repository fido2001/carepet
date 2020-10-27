<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');
Route::get('/petshop', 'PetShopController@index');
Route::get('/petowner', 'PetownerController@index');
