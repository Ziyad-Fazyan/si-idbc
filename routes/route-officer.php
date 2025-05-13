<?php

use Illuminate\Support\Facades\Route;

// HAK AKSES DEPARTEMENT OFFICER
Route::group(['prefix' => 'officer', 'middleware' => ['user-access:Departement Officer'], 'as' => 'officer.'], function () {
    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';
    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {
        // PRIVATE FUNCTION => ABSEN WAJAH
        Route::get('/daftar-wajah', [App\Http\Controllers\Admin\FaceRecognitionController::class, 'daftar'])->name('daftar-wajah-index');
        Route::get('/absen-wajah', [App\Http\Controllers\Admin\FaceRecognitionController::class, 'index'])->name('absen-wajah-index');
        Route::post('/absen-wajah', [App\Http\Controllers\Admin\FaceRecognitionController::class, 'uploadFoto'])->name('absen-wajah');
        Route::post('/absen-wajah/cek', [App\Http\Controllers\Admin\FaceRecognitionController::class, 'cekWajah'])->name('absen-wajah-cek');
        Route::get('/hasil-absen', [App\Http\Controllers\Admin\FaceRecognitionController::class, 'hasilAbsen'])->name('face-results');
    });
});
