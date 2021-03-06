<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/editProfile', 'AdminController@editProfile')->name('edit.profile.admin');
    Route::patch('/editProfile', 'AdminController@updateProfile')->name('edit.profile.admin');
    Route::get('/editPassword', 'AdminController@editPassword')->name('edit.password.admin');
    Route::patch('/editPassword', 'AdminController@updatePassword')->name('edit.password.admin');
    Route::get('users-management', 'AdminController@showUsersManagement')->name('show.users-management');
    Route::post('users-management', 'AdminController@storeDataPetshop')->name('store.petshop');
    Route::get('users-management/{user}/detail', 'AdminController@detailPetowner')->name('detail.users-management');
    Route::get('users-management/{user}/edit', 'AdminController@editUsersManagement')->name('edit.users-management');
    Route::patch('users-management/{user}', 'AdminController@updateUsersManagement')->name('update.users-management');
    Route::delete('users-management/{user}', 'AdminController@destroyUsersManagement')->name('destroy.users-management');
    Route::get('/produk', 'ProdukController@indexAdmin')->name('index.produk.admin');
    Route::get('/produk/{dataProduk}', 'ProdukController@detailAdmin')->name('show.produk.admin');
    Route::get('/paket', 'PaketController@indexAdmin')->name('index.paket.admin');
    Route::get('/paket/{paket}', 'PaketController@detailAdmin')->name('show.paket.admin');
    Route::get('/historyPackages', 'PaketController@historyAdmin')->name('history.paket.admin');
    Route::get('/historyPackages/{paketuser}', 'PaketController@historyAdminDetail')->name('historyDetail.paket.admin');
    Route::delete('/historyPackages/{paketuser}', 'PaketController@historyAdminDestroy')->name('destroy.paket.admin');
    Route::patch('/historyPackages/{paketuser}', 'PaketController@verifikasiPembayaran')->name('verifikasi.pembayaranPaket.admin');
    Route::get('/historyMedicine', 'ProdukController@historyAdmin')->name('history.produk.admin');
    Route::get('/historyMedicine/{produkuser}', 'ProdukController@historyAdminDetail')->name('historyDetail.produk.admin');
    Route::delete('/historyMedicine/{paketuser}', 'ProdukController@historyAdminDestroy')->name('destroy.produk.admin');
    Route::patch('/historyMedicine/{produkuser}', 'ProdukController@verifikasiPembayaran')->name('verifikasi.pembayaran.admin');
    Route::get('/article', 'ArticleController@indexAdmin')->name('index.article.admin');
    Route::get('/article/create', 'ArticleController@create')->name('create.article.admin');
    Route::post('/article/create', 'ArticleController@store')->name('store.article.admin');
    Route::get('/article/{article:slug}', 'ArticleController@showAdmin')->name('show.article.admin');
    Route::get('/article/{article:slug}/edit', 'ArticleController@edit')->name('edit.article.admin');
    Route::patch('/article/{article:slug}/edit', 'ArticleController@update')->name('update.article.admin');
    Route::delete('/article/{article:slug}', 'ArticleController@destroy')->name('destroy.article.admin');
    Route::get('/withdrawal', 'WithdrawalController@indexAdmin')->name('index.withdrawal.admin');
    Route::get('/withdrawal/{withdrawal}/detail', 'WithdrawalController@showAdmin')->name('show.withdrawal.admin');
    Route::patch('/withdrawal/{withdrawal}/detail', 'WithdrawalController@storeBukti')->name('bukti.withdrawal.admin');
});

Route::middleware('auth')->prefix('petshop')->group(function () {
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
    Route::get('/paket-create', 'PaketController@create')->name('create.paket.petshop');
    Route::post('/paket-create', 'PaketController@store')->name('store.paket.petshop');
    Route::get('/paket/{paket}/edit', 'PaketController@edit')->name('edit.paket.petshop');
    Route::patch('/paket/{paket}', 'PaketController@update')->name('update.paket.petshop');
    Route::get('/historyPackages', 'PaketController@historyPetshop')->name('history.paket.petshop');
    Route::get('/historyPackages/{paketuser}', 'PaketController@historyPetshopDetail')->name('historyDetail.paket.petshop');
    Route::get('/historyMedicine', 'ProdukController@historyPetshop')->name('history.produk.petshop');
    Route::get('/historyMedicine/{produkuser}', 'ProdukController@historyPetshopDetail')->name('historyDetail.produk.petshop');
    Route::patch('/historyMedicine/{produkuser}/resi', 'ProdukController@storeResi')->name('resi.pengiriman');
    Route::get('/progress/{paketuser}', 'ProgressController@index')->name('index.progress.petshop');
    Route::get('/progress/{paketuser}/create', 'ProgressController@create')->name('create.progress.petshop');
    Route::post('/progress/{paketuser}/create', 'ProgressController@store')->name('store.progress.petshop');
    Route::get('/progress/{progress}/edit', 'ProgressController@edit')->name('edit.progress.petshop');
    Route::patch('/progress/{progress}/edit', 'ProgressController@update')->name('update.progress.petshop');
    Route::delete('/progress/{progress}', 'ProgressController@destroy')->name('destroy.progress.petshop');
    Route::get('/article', 'ArticleController@indexPetshop')->name('index.article.petshop');
    Route::get('/article/{article:slug}', 'ArticleController@showPetshop')->name('show.article.petshop');
    Route::get('/consultation', 'ConsultationController@indexPetshop')->name('index.consultation.petshop');
    Route::get('/consultation/{id}', 'ChatController@indexPetshop')->name('index.chat.petshop');
    Route::post('/consultation/{id}', 'ChatController@store')->name('store.chat.petshop');
    Route::get('/withdrawal', 'WithdrawalController@index')->name('index.withdrawal.petshop');
    Route::get('/withdrawal/create', 'WithdrawalController@create')->name('create.withdrawal.petshop');
    Route::post('/withdrawal/create', 'WithdrawalController@store')->name('store.withdrawal.petshop');
    Route::get('/withdrawal/{withdrawal}/detail', 'WithdrawalController@show')->name('show.withdrawal.petshop');
});

Route::middleware('auth')->prefix('petowner')->group(function () {
    Route::get('/', 'PetownerController@index')->name('petowner.index');
    Route::get('/editProfile', 'PetownerController@editProfile')->name('edit.profile');
    Route::patch('/editProfile', 'PetownerController@updateProfile')->name('edit.profile');
    Route::get('/editPassword', 'PetownerController@editPassword')->name('edit.password');
    Route::patch('/editPassword', 'PetownerController@updatePassword')->name('edit.password');
    Route::get('showPetshop', 'PetownerController@showPetshop')->name('show.petshop');
    Route::get('showPetshop/{user}', 'PetownerController@detailPetshop')->name('detail.petshop');
    Route::get('/produk', 'ProdukController@indexPetowner')->name('index.produk.petowner');
    Route::get('/produk/{dataProduk}', 'ProdukController@show')->name('show.produk.petowner');
    Route::get('/produk/{dataProduk}/sale', 'ProdukController@sale')->name('sale.produk.petowner');
    Route::post('/produk/{dataProduk}/sale', 'ProdukController@purchase')->name('purchase.produk.petowner');
    Route::get('/historyMedicine', 'ProdukController@historyPetowner')->name('history.produk.petowner');
    Route::delete('/historyMedicine/{paketuser}', 'ProdukController@historyPetownerDestroy')->name('destroy.produk.petowner');
    Route::get('/historyMedicine/{produkuser}', 'ProdukController@historyPetownerDetail')->name('historyDetail.produk.petowner');
    Route::get('/historyMedicine/{produkuser}/diterima', 'ProdukController@verifikasiKedatangan');
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
    Route::get('/article', 'ArticleController@indexPetowner')->name('index.article.petowner');
    Route::get('/article/{article:slug}', 'ArticleController@showPetowner')->name('show.article.petowner');
    Route::get('/consultation', 'ConsultationController@indexPetowner')->name('index.consultation.petowner');
    Route::get('/consultation/create', 'ConsultationController@create')->name('create.consultation.petowner');
    Route::post('/consultation/create', 'ConsultationController@store')->name('store.consultation.petowner');
    Route::get('/consultation/{id}', 'ChatController@indexPetowner')->name('index.chat.petowner');
    Route::post('/consultation/{id}', 'ChatController@store')->name('store.chat.petowner');
});
