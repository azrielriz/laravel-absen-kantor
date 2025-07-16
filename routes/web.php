<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanAbsenController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengumumanController;


// Halaman awal
Route::view('/', 'welcome');

// AUTH
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// DASHBOARD & PROTECTED ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', fn() => view('profile'))->name('profile');

    // Absen
    Route::get('/laporan/absen', [AbsenController::class, 'index'])->name('laporan.absen');
    Route::get('/laporan/absen/pdf', [LaporanAbsenController::class, 'exportPdf'])->name('laporan.absen.pdf');
    Route::get('/laporan/absen/excel', [LaporanAbsenController::class, 'exportExcel'])->name('laporan.absen.excel');

    // Cuti
    Route::get('/laporan/cuti', [CutiController::class, 'index'])->name('laporan.cuti');
    Route::get('/laporan/cuti/pdf', [CutiController::class, 'exportPDF'])->name('laporan.cuti.pdf');
    Route::get('/laporan/cuti/excel', [CutiController::class, 'exportExcel'])->name('laporan.cuti.excel');

    // Pengumuman
    Route::get('/laporan/pengumuman', [PengumumanController::class, 'index'])->name('laporan.pengumuman');
    Route::get('/laporan/pengumuman/pdf', [PengumumanController::class, 'exportPDF'])->name('laporan.pengumuman.pdf');
    Route::get('/laporan/pengumuman/excel', [PengumumanController::class, 'exportExcel'])->name('laporan.pengumuman.excel');

});
