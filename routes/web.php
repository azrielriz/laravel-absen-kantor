<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanAbsenController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PegawaiController;

// Halaman awal
Route::view('/', 'welcome');

// AUTH
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// DASHBOARD - Bisa untuk semua role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', fn() => view('profile'))->name('profile');
});

// ADMIN + SUPERADMIN (Laporan)
Route::middleware(['auth', RoleMiddleware::class.':admin,superadmin'])->group(function () {
    Route::get('/laporan/absen', [AbsenController::class, 'index'])->name('laporan.absen');
    Route::get('/laporan/absen/pdf', [LaporanAbsenController::class, 'exportPdf'])->name('laporan.absen.pdf');
    Route::get('/laporan/absen/excel', [LaporanAbsenController::class, 'exportExcel'])->name('laporan.absen.excel');

    Route::get('/laporan/cuti', [CutiController::class, 'index'])->name('laporan.cuti');
    Route::get('/laporan/cuti/pdf', [CutiController::class, 'exportPDF'])->name('laporan.cuti.pdf');
    Route::get('/laporan/cuti/excel', [CutiController::class, 'exportExcel'])->name('laporan.cuti.excel');

    Route::get('/laporan/pengumuman', [PengumumanController::class, 'index'])->name('laporan.pengumuman');
    Route::get('/laporan/pengumuman/pdf', [PengumumanController::class, 'exportPDF'])->name('laporan.pengumuman.pdf');
    Route::get('/laporan/pengumuman/excel', [PengumumanController::class, 'exportExcel'])->name('laporan.pengumuman.excel');
});

// SUPERADMIN ONLY (Manajemen User dan Pegawai)
Route::middleware(['auth', RoleMiddleware::class.':superadmin'])->prefix('laporan/users')->group(function () {
    // CRUD ADMIN
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // CRUD PEGAWAI — FIXED: pakai {pegawai}
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
});


