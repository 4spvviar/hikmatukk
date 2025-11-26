<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/',[Controller::class, 'home'])->name('layouts.home');
Route::get('/kategori',[Controller::class, 'kategori'])->name('layouts.kategori');
Route::get('/gambarProduk', [Controller::class, 'gambarProduk'])->name('layouts.gambarProduk');
Route::get('/galeri', [Controller::class, 'galeri'])->name('layouts.galeri');
Route::get('/produk',[ProdukController::class, 'index'])->name('layouts.produk');
Route::get('/tentang', [Controller::class, 'tentang'])->name('profile.tentang');
Route::get('/visimisi', [Controller::class, 'visimisi'])->name('profile.visimisi');



// Auth routes
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth',[AuthController::class, 'auth'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function (){
    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');

    //user
    Route::get('/admin/user', [AdminController::class, 'userView'])->name('admin.user.index');
    Route::get('/admin/user/create', [AdminController::class, 'userCreate'])->name('admin.user.create');
    Route::post('/admin/user', [AdminController::class, 'userStore'])->name('admin.user.store');    
    Route::get('/admin/user/edit/{id}',[AdminController::class,'editView'])->name('admin.user.edit');
    Route::put('/admin/user/edit/{id}',[AdminController::class, 'updateView'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');

    //kategori
    Route::get('/admin/kategori', [AdminController::class, 'kategoriIndex'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create', [AdminController::class, 'kategoriCreate'])->name('admin.kategori.create');
    Route::post('/admin/kategori', [AdminController::class, 'kategoriStore'])->name('admin.kategori.store');
    Route::get('/admin/kategori/edit/{id}',[AdminController::class,'kategoriEdit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/edit/{id}',[AdminController::class, 'kategoriUpdate'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('admin.kategori.destroy');
    Route::delete('/admin/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('admin.kategori.destroy');

    //toko
    Route::get('/admin/toko', [AdminController::class, 'tokoIndex'])->name('admin.toko.index');
    Route::get('/admin/toko/create', [AdminController::class, 'tokoCreate'])->name('admin.toko.create');
    Route::post('/admin/toko', [AdminController::class, 'tokoStore'])->name('admin.toko.store');
    Route::get('/admin/toko/edit/{id}',[AdminController::class,'tokoEdit'])->name('admin.toko.edit');
    Route::put('/admin/toko/edit/{id}',[AdminController::class, 'tokoUpdate'])->name('admin.toko.update');
    Route::delete('/admin/toko/{id}', [AdminController::class, 'tokoDestroy'])->name('admin.toko.destroy');
    Route::delete('/admin/toko/{id}', [AdminController::class, ' tokoDestroy'])->name('admin.toko.destroy');

    //produk
    Route::get('/admin/produk', [AdminController::class, 'produkIndex'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [AdminController::class, 'produkCreate'])->name('admin.produk.create');
    Route::post('/admin/produk', [AdminController::class, 'produkStore'])->name('admin.produk.store');
    Route::get('/admin/produk/edit/{id}',[AdminController::class,'produkEdit'])->name('admin.produk.edit');
    Route::put('/admin/produk/edit/{id}',[AdminController::class, 'produkUpdate'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}', [AdminController::class, 'produkDestroy'])->name('admin.produk.destroy');

    //galeri
    Route::get('/admin/galeri', [AdminController::class, 'galeriIndex'])->name('admin.galeri.index');
    Route::get('/admin/galeri/create', [AdminController::class, 'galeriCreate'])->name('admin.galeri.create');
    Route::post('/admin/galeri', [AdminController::class, 'galeriStore'])->name('admin.galeri.store');
    Route::get('/admin/galeri/edit/{id}',[AdminController::class,'galeriEdit'])->name('admin.galeri.edit');
    Route::put('/admin/galeri/edit/{id}',[AdminController::class, 'galeriUpdate'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{id}', [AdminController::class, 'galeriDestroy'])->name('admin.galeri.destroy');

    //profile_sekolah
    Route::get('/admin/profile_sekolah', [AdminController::class, 'profileSekolahIndex'])->name('admin.profile_sekolah.index');
    Route::get('/admin/profile_sekolah/create', [AdminController::class, 'profileSekolahCreate'])->name('admin.profile_sekolah.create');
    Route::post('/admin/profile_sekolah', [AdminController::class, 'profileSekolahStore'])->name('admin.profile_sekolah.store');
    Route::get('/admin/profile_sekolah/edit/{id}',[AdminController::class,'profileSekolahEdit'])->name('admin.profile_sekolah.edit');
    Route::put('/admin/profile_sekolah/edit/{id}',[AdminController::class, 'profileSekolahUpdate'])->name('admin.profile_sekolah.update');
    Route::delete('/admin/profile_sekolah/{id}', [AdminController::class, 'profileSekolahDestroy'])->name('admin.profile_sekolah.destroy');

    //gambarProduk
    Route::get('/admin/gambarProduk', [AdminController::class, 'gambarProdukIndex'])->name('admin.gambarProduk.index');
    Route::get('/admin/gambarProduk/create', [AdminController::class, 'gambarProdukCreate'])->name('admin.gambarProduk.create');
    Route::post('/admin/gambarProduk', [AdminController::class, 'gambarProdukStore'])->name('admin.gambarProduk.store');
    Route::get('/admin/gambarProduk/edit/{id}',[AdminController::class,'gambarProdukEdit'])->name('admin.gambarProduk.edit');
    Route::put('/admin/gambarProduk/edit/{id}',[AdminController::class, 'gambarProdukUpdate'])->name('admin.gambarProduk.update');
    Route::delete('/admin/gambarProduk/{id}', [AdminController::class, 'gambarProdukDestroy'])->name('admin.gambarProduk.destroy');
});

Route::middleware(['member'])->group(function (){
    Route::get('/member/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');

    //kategori
    Route::get('/member/kategori', [OperatorController::class, 'siswaindex'])->name('operator.kategori.index');
    Route::get('/member/kategori/create', [OperatorController::class, 'siswaCreate'])->name('operator.kategori.create');
    Route::post('/member/kategori', [OperatorController::class, 'siswaStore'])->name('operator.kategori.store');
    Route::get('/member/kategori/edit/{id}',[OperatorController::class,'siswaEdit'])->name('operator.kategori.edit');
    Route::put('/member/kategori/edit/{id}',[OperatorController::class, 'siswaUpdate'])->name('operator.kategori.update');
    Route::delete('/member/kategori/{id}', [OperatorController::class, 'siswaDestroy'])->name('operator.kategori.destroy');

    //produk
    Route::get('/member/produk', [OperatorController::class, 'ekstrakulikulerIndex'])->name('operator.produk.index');
    Route::get('/member/produk/create', [OperatorController::class, 'ekstrakulikulerCreate'])->name('operator.produk.create');
    Route::post('/member/produk', [OperatorController::class, 'ekstrakulikulerStore'])->name('operator.produk.store');
    Route::get('/member/produk/edit/{id}',[OperatorController::class,'ekstrakulikulerEdit'])->name('operator.produk.edit');
    Route::put('/member/produk/edit/{id}',[OperatorController::class, 'ekstrakulikulerUpdate'])->name('operator.produk.update');
    Route::delete('/member/produk/{id}', [OperatorController::class, 'ekstrakulikulerDestroy'])->name('operator.produk.destroy');

    //gambarProduk
    Route::get('/member/berita', [OperatorController::class, 'beritaIndex'])->name('operator.gambarProduk.index');
    Route::get('/member/berita/create', [OperatorController::class, 'beritaCreate'])->name('operator.gambarProduk.create');
    Route::post('/member/berita', [OperatorController::class, 'beritaStore'])->name('operator.gambarProduk.store');
    Route::get('/member/berita/edit/{id}',[OperatorController::class,'beritaEdit'])->name('operator.gambarProduk.edit');
    Route::put('/member/berita/edit/{id}',[OperatorController::class, 'beritaUpdate'])->name('operator.gambarProduk.update');
    Route::delete('/member/berita/{id}', [OperatorController::class, 'beritaDestroy'])->name('operator.gambarProduk.destroy');

    //galeri
    Route::get('/member/galeri', [OperatorController::class, 'galeriIndex'])->name('operator.galeri.index');
    Route::get('/member/galeri/create', [OperatorController::class, 'galeriCreate'])->name('operator.galeri.create');
    Route::post('/member/galeri', [OperatorController::class, 'galeriStore'])->name('operator.galeri.store');
    Route::get('/member/galeri/edit/{id}',[OperatorController::class,'galeriEdit'])->name('operator.galeri.edit');
    Route::put('/member/galeri/edit/{id}',[OperatorController::class, 'galeriUpdate'])->name('operator.galeri.update');
    Route::delete('/member/galeri/{id}', [OperatorController::class, 'galeriDestroy'])->name('operator.galeri.destroy');

});
