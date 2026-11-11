<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [LapanganController::class, 'index']);
    Route::get('/indoor', [LapanganController::class, 'indoor']);
    Route::get('/outdoor', [LapanganController::class, 'outdoor']);
    Route::post('/tambah', [LapanganController::class, 'store']);
    Route::get('/edit/{id}', [LapanganController::class, 'edit']);
    Route::post('/update/{id}', [LapanganController::class, 'update']);

    // Khusus Hapus: Hanya untuk role Admin
    Route::get('/hapus/{id}', [LapanganController::class, 'destroy'])->middleware('role:admin');
});