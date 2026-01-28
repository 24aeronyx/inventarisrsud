<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CctvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomputerController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SwitchHubController;
use App\Http\Controllers\UpsController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/', [AuthController::class, 'showLoginForm']);
});

// Staff (hanya admin)
Route::middleware(['role:admin'])->prefix('dashboard')->group(function () {
    Route::resource('staff', StaffController::class);
});

// (admin dan staff)
Route::middleware(['role:admin,staff'])->prefix('dashboard')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('komputer', KomputerController::class);
    Route::resource('printer', PrinterController::class);
    Route::resource('ups', UpsController::class);
    Route::resource('cctv', CctvController::class);
    Route::resource('switch', SwitchHubController::class);
    Route::resource('perbaikan', PerbaikanController::class);

    Route::get('/laporan/komputer', [KomputerController::class, 'laporan'])->name('komputer.laporan');
    Route::get('/laporan/printer', [PrinterController::class, 'laporan'])->name('printer.laporan');
    Route::get('/laporan/ups', [UpsController::class, 'laporan'])->name('ups.laporan');
    Route::get('/laporan/cctv', [CctvController::class, 'laporan'])->name('cctv.laporan');
    Route::get('/laporan/switch', [SwitchHubController::class, 'laporan'])->name('switch.laporan');
    Route::get('/laporan/perbaikan', [PerbaikanController::class, 'laporan'])->name('perbaikan.laporan');

    Route::get('/laporan/cetak/komputer', [KomputerController::class, 'printLaporan'])->name('komputer.laporan.print');
    Route::get('/laporan/cetak/printer', [PrinterController::class, 'printLaporan'])->name('printer.laporan.print');
    Route::get('/laporan/cetak/ups', [UpsController::class, 'printLaporan'])->name('ups.laporan.print');
    Route::get('/laporan/cetak/cctv', [CctvController::class, 'printLaporan'])->name('cctv.laporan.print');
    Route::get('/laporan/cetak/switch', [SwitchHubController::class, 'printLaporan'])->name('switch.laporan.print');
    Route::get('/laporan/cetak/perbaikan', [PerbaikanController::class, 'printLaporan'])->name('perbaikan.laporan.print');

    Route::get('/akun', [AuthController::class, 'account'])->name('account');
    Route::post('/akun/ubah-password', [AuthController::class, 'changePassword'])->name('account.change-password');
    Route::post('/akun/ubah-nama', [AuthController::class, 'changeName'])->name('account.change-name');
});
