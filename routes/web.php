<?php

use App\Http\Controllers\Admin\AdminBookingCcontroller;
use App\Http\Controllers\Admin\AdminMejaController;
use App\Http\Controllers\Admin\AdminPaketController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Pelanggan\PelangganPaketController;
use App\Http\Controllers\Pelanggan\PelangganRiwayatController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing
Route::get('/', [LandingController::class, 'index'])->name('landing.index');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/login/logout', [LoginController::class, 'logout'])->name('login.logout');

// Registratsi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
Route::post('/registrasi/store', [RegistrasiController::class, 'store'])->name('registrasi.store');

// Dashboard
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Riwayat
    Route::get('/riwayat/index', [PelangganRiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/generatepdf/{id}', [PelangganRiwayatController::class, 'generatepdf'])->name('riwayat.generatepdf');

    // Paket
    Route::get('/paket/index/{id}', [PelangganPaketController::class, 'index'])->name('paket.index');
    Route::post('/paket/store', [PelangganPaketController::class, 'store'])->name('paket.store');

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
    Route::post('/setting/updateemail', [SettingController::class, 'updateemail'])->name('setting.updateemail');
    Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
    Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
    Route::post('/setting/hapusgambar', [SettingController::class, 'hapusgambar'])->name('setting.hapusgambar');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':1']], function () {

         // Booking
        Route::get('/data-pemesanan/index', [AdminBookingCcontroller::class, 'index'])->name('data-pemesanan.index');
        Route::get('/data-pemesanan/create', [AdminBookingCcontroller::class, 'create'])->name('data-pemesanan.create');
        Route::get('/data-pemesanan/edit/{id}', [AdminBookingCcontroller::class, 'edit'])->name('data-pemesanan.edit');
        Route::post('/data-pemesanan/store', [AdminBookingCcontroller::class, 'store'])->name('data-pemesanan.store');
        Route::post('/data-pemesanan/update/{id}', [AdminBookingCcontroller::class, 'update'])->name('data-pemesanan.update');
        Route::post('/data-pemesanan/destroy/{id}', [AdminBookingCcontroller::class, 'destroy'])->name('data-pemesanan.destroy');

        // Paket
        Route::get('/data-paket/index', [AdminPaketController::class, 'index'])->name('data-paket.index');
        Route::get('/data-paket/create', [AdminPaketController::class, 'create'])->name('data-paket.create');
        Route::get('/data-paket/edit/{id}', [AdminPaketController::class, 'edit'])->name('data-paket.edit');
        Route::post('/data-paket/store', [AdminPaketController::class, 'store'])->name('data-paket.store');
        Route::post('/data-paket/update/{id}', [AdminPaketController::class, 'update'])->name('data-paket.update');
        Route::post('/data-paket/destroy/{id}', [AdminPaketController::class, 'destroy'])->name('data-paket.destroy');

        // Paket
        Route::get('/data-paket/index', [AdminPaketController::class, 'index'])->name('data-paket.index');
        Route::get('/data-paket/create', [AdminPaketController::class, 'create'])->name('data-paket.create');
        Route::get('/data-paket/edit/{id}', [AdminPaketController::class, 'edit'])->name('data-paket.edit');
        Route::post('/data-paket/store', [AdminPaketController::class, 'store'])->name('data-paket.store');
        Route::post('/data-paket/update/{id}', [AdminPaketController::class, 'update'])->name('data-paket.update');
        Route::post('/data-paket/destroy/{id}', [AdminPaketController::class, 'destroy'])->name('data-paket.destroy');

        // Meja
        Route::get('/data-meja/index', [AdminMejaController::class, 'index'])->name('data-meja.index');
        Route::get('/data-meja/create', [AdminMejaController::class, 'create'])->name('data-meja.create');
        Route::get('/data-meja/edit/{id}', [AdminMejaController::class, 'edit'])->name('data-meja.edit');
        Route::post('/data-meja/store', [AdminMejaController::class, 'store'])->name('data-meja.store');
        Route::post('/data-meja/update/{id}', [AdminMejaController::class, 'update'])->name('data-meja.update');
        Route::post('/data-meja/destroy/{id}', [AdminMejaController::class, 'destroy'])->name('data-meja.destroy');

        // Data User Registrasi
        Route::get('/data-users/index', [AdminUserController::class, 'index'])->name('data-users.index');
        Route::get('/data-users/create', [AdminUserController::class, 'create'])->name('data-users.create');
        Route::get('/data-users/edit/{id}', [AdminUserController::class, 'edit'])->name('data-users.edit');
        Route::post('/data-users/store', [AdminUserController::class, 'store'])->name('data-users.store');
        Route::post('/data-users/update/{id}', [AdminUserController::class, 'update'])->name('data-users.update');
        Route::post('/data-users/destroy/{id}', [AdminUserController::class, 'destroy'])->name('data-users.destroy');
    });
});
