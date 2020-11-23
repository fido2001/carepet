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
    Route::get('/paket', 'PaketController@indexAdmin')->name('index.paket.admin');
    Route::get('/paket-create', 'PaketController@create')->name('create.paket.admin');
    Route::post('/paket-create', 'PaketController@store')->name('store.paket.admin');
    Route::get('/paket/{paket}/edit', 'PaketController@edit')->name('edit.paket.admin');
    Route::patch('/paket/{paket}', 'PaketController@update')->name('update.paket.admin');
    Route::get('/historyPackages', 'PaketController@historyAdmin')->name('history.paket.admin');
    Route::get('/historyPackages/{paketuser}', 'PaketController@historyAdminDetail')->name('historyDetail.paket.admin');
    Route::patch('/historyPackages/{paketuser}', 'PaketController@verifikasiPembayaran')->name('verifikasi.pembayaran.admin');
    Route::get('/historyMedicine', 'ProdukController@historyAdmin')->name('history.produk.admin');
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
    Route::get('/paket', 'PaketController@indexPetshop')->name('index.paket.petshop');
    Route::get('/historyPackages', 'PaketController@historyPetshop')->name('history.paket.petshop');
    Route::get('/historyPackages/{paketuser}', 'PaketController@historyPetshopDetail')->name('historyDetail.paket.petshop');
    Route::get('/historyMedicine', 'ProdukController@historyPetshop')->name('history.produk.petshop');
    Route::get('/progress/{paketuser}', 'ProgressController@index')->name('index.progress.petshop');
    Route::get('/progress/{paketuser}/create', 'ProgressController@create')->name('create.progress.petshop');
    Route::post('/progress/{paketuser}/create', 'ProgressController@store')->name('store.progress.petshop');
    Route::get('/progress/{progress}/edit', 'ProgressController@edit')->name('edit.progress.petshop');
    Route::patch('/progress/{progress}/edit', 'ProgressController@update')->name('update.progress.petshop');
    Route::delete('/progress/{progress}', 'ProgressController@destroy')->name('destroy.progress.petshop');
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
    Route::get('/historyMedicine', 'ProdukController@historyPetowner')->name('history.produk.petowner');
    Route::delete('/historyMedicine/{paketuser}', 'ProdukController@historyPetownerDestroy')->name('destroy.produk.petowner');
    Route::get('/historyMedicine/{produkuser}', 'ProdukController@historyPetownerDetail')->name('historyDetail.produk.petowner');
    Route::get('/historyMedicine/{produkuser}/pembayaran', 'ProdukController@pembayaran')->name('pembayaran.produk.petowner');
    Route::patch('/historyMedicine/{produkuser}/pembayaran', 'ProdukController@storePembayaran')->name('pembayaran.produk.petowner');
    Route::get('/paket', 'PaketController@indexPetowner')->name('index.paket.petowner');
    Route::get('/paket/{paket}', 'PaketController@show')->name('show.paket.petowner');
    Route::get('/paket/{paket}/sale', 'PaketController@sale')->name('sale.paket.petowner');
    Route::post('/paket/sale', 'PaketController@purchase')->name('purchase.paket.petowner');
    Route::get('/historyPackages', 'PaketController@historyPetowner')->name('history.paket.petowner');
    Route::delete('/historyPackages/{paketuser}', 'PaketController@historyPetownerDestroy')->name('destroy.paket.petowner');
    Route::get('/historyPackages/{paketuser}', 'PaketController@historyPetownerDetail')->name('historyDetail.paket.petowner');
    Route::get('/progress/{paketuser}', 'PaketController@progressPetowner')->name('index.progress.petowner');
    Route::get('/historyPackages/{paketuser}/pembayaran', 'PaketController@pembayaran')->name('pembayaran.paket.petowner');
    Route::patch('/historyPackages/{paketuser}/pembayaran', 'PaketController@storePembayaran')->name('pembayaran.paket.petowner');
});
