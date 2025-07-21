<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\Api\AuthController;


Route::post('/absen', [AbsenController::class, 'store']);
Route::post('/pengumuman', [PengumumanController::class, 'store']);
Route::post('/cuti', [CutiController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);