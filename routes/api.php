<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\FaceRecognitionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rute autentikasi admin
Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::get('/reset/{token}', [AuthController::class, 'resetPage']);
    Route::post('/reset/{token}', [AuthController::class, 'reset']);
    
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

use App\Http\Controllers\Admin\Pages\Finance\BalanceController;

// Rute untuk mahasiswa
Route::prefix('mahasiswa')->group(function () {
    // Rute yang memerlukan autentikasi
    Route::middleware('auth:sanctum')->group(function () {
        // Absensi wajah
        Route::post('/upload-foto', [FaceRecognitionController::class, 'uploadFoto']);
        Route::post('/cek-wajah', [FaceRecognitionController::class, 'cekWajah']);
        Route::get('/hasil-absen', [FaceRecognitionController::class, 'hasilAbsen']);
        Route::post('/jadkul-absen', [AbsensiController::class, 'jadkulAbsenStore']);
    });
});

// API route for fetching Balance data by code for edit modal
Route::get('/finance/keuangan/{code}', [BalanceController::class, 'show']);
