<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('', 'AdminController@index');
    Route::get('/editProfile', 'AdminController@editProfile')->name('edit.profile.admin');
    Route::patch('/editProfile', 'AdminController@updateProfile')->name('edit.profile.admin');
    Route::get('users-management', 'AdminController@showUsersManagement')->name('show.users-management');
    Route::post('users-management', 'AdminController@storeDataPetshop')->name('store.petshop');
    Route::get('users-management/{user}/edit', 'AdminController@editUsersManagement')->name('edit.users-management');
    Route::patch('users-management/{user}', 'AdminController@updateUsersManagement')->name('update.users-management');
    Route::delete('users-management/{user}', 'AdminController@destroyUsersManagement')->name('destroy.users-management');
});

Route::prefix('petshop')->middleware('auth')->group(function () {
    Route::get('', 'PetshopController@index');
    Route::get('/editProfile', 'PetshopController@editProfile')->name('edit.profile.petshop');
    Route::patch('/editProfile', 'PetshopController@updateProfile')->name('edit.profile.petshop');
});

Route::prefix('petowner')->middleware('auth')->group(function () {
    Route::get('', 'PetownerController@index');
    Route::get('/editProfile', 'PetownerController@editProfile')->name('edit.profile');
    Route::patch('/editProfile', 'PetownerController@updateProfile')->name('edit.profile');
});
