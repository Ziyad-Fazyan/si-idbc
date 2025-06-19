<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\HomeController;
use App\Http\Controllers\Admin\FaceRecognitionController;

// HAK AKSES DEPARTEMENT ABSEN
Route::group(['prefix' => 'absen', 'middleware' => ['user-access:Departement Absen'], 'as' => 'absen.'], function () {
    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';
    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {
        // PRIVATE FUNCTION => ABSEN WAJAH
        Route::get('/daftar-wajah', [FaceRecognitionController::class, 'daftar'])->name('daftar-wajah-index');
        Route::get('/absen-wajah', [FaceRecognitionController::class, 'index'])->name('absen-wajah-index');
        Route::post('/absen-wajah', [FaceRecognitionController::class, 'uploadFoto'])->name('absen-wajah');
        Route::post('/absen-wajah/cek', [FaceRecognitionController::class, 'cekWajah'])->name('absen-wajah-cek');
        Route::get('/hasil-absen', [FaceRecognitionController::class, 'hasilAbsen'])->name('face-results');
        Route::post('/jadwal-kuliah/store/absen',[HomeController::class, 'jadkulAbsenStore'])->name('home-jadkul-absen-store');
    });
});
