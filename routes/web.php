<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/editProfile', 'AdminController@editProfile')->name('edit.profile.admin');
    Route::patch('/editProfile', 'AdminController@updateProfile')->name('edit.profile.admin');
    Route::get('/editPassword', 'AdminController@editPassword')->name('edit.password.admin');
    Route::patch('/editPassword', 'AdminController@updatePassword')->name('edit.password.admin');
    Route::get('users-management', 'AdminController@showUsersManagement')->name('show.users-management');
    Route::post('users-management', 'AdminController@storeDataPetshop')->name('store.petshop');
    Route::get('users-management/{user}/edit', 'AdminController@editUsersManagement')->name('edit.users-management');
    Route::patch('users-management/{user}', 'AdminController@updateUsersManagement')->name('update.users-management');
    Route::delete('users-management/{user}', 'AdminController@destroyUsersManagement')->name('destroy.users-management');
    Route::get('/produk', 'ProdukController@indexAdmin')->name('index.produk.admin');
});

Route::prefix('petshop')->middleware('auth')->group(function () {
    Route::get('/', 'PetshopController@index')->name('petshop.index');
    Route::get('/editProfile', 'PetshopController@editProfile')->name('edit.profile.petshop');
    Route::patch('/editProfile', 'PetshopController@updateProfile')->name('edit.profile.petshop');
    Route::get('/editPassword', 'PetshopController@editPassword')->name('edit.password.petshop');
    Route::patch('/editPassword', 'PetshopController@updatePassword')->name('edit.password.petshop');
    Route::get('/produk', 'ProdukController@indexPetshop')->name('index.produk.petshop');
    Route::post('/produk', 'ProdukController@store')->name('store.produk.petshop');
    Route::get('/produk/{dataProduk}/edit', 'ProdukController@edit')->name('edit.produk.petshop');
    Route::patch('/produk/{dataProduk}', 'ProdukController@update')->name('update.produk.petshop');
});

Route::prefix('petowner')->middleware('auth')->group(function () {
    Route::get('/', 'PetownerController@index')->name('petowner.index');
    Route::get('/editProfile', 'PetownerController@editProfile')->name('edit.profile');
    Route::patch('/editProfile', 'PetownerController@updateProfile')->name('edit.profile');
    Route::get('/editPassword', 'PetownerController@editPassword')->name('edit.password');
    Route::patch('/editPassword', 'PetownerController@updatePassword')->name('edit.password');
    Route::get('/produk', 'ProdukController@indexPetowner')->name('index.produk.petowner');
    Route::get('/produk/{dataProduk}', 'ProdukController@show')->name('show.produk.petowner');
    Route::get('/produk/{dataProduk}/sale', 'ProdukController@sale')->name('sale.produk.petowner');
    Route::post('/produk/sale', 'ProdukController@purchase')->name('purchase.produk.petowner');
    Route::get('/historySale', 'ProdukController@historyPetowner')->name('history.produk.petowner');
});
