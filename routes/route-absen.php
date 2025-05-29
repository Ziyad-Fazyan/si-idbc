<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaceRecognitionController;
use App\Http\Controllers\Mahasiswa\HomeController;

// HAK AKSES DEPARTEMENT ABSEN
Route::group([
    'prefix' => 'absen',
    'middleware' => ['user-access:Departement Absen',],
    'as' => 'absen.'
], function () {

    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';

    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {

        // FACE RECOGNITION ROUTES
        Route::controller(FaceRecognitionController::class)->group(function () {
            Route::get('/daftar-wajah', 'daftar')->name('daftar-wajah-index');
            Route::prefix('absen-wajah')->group(function () {
                Route::get('/', 'index')->name('absen-wajah-index');
                Route::post('/', 'uploadFoto')->name('absen-wajah');
                Route::post('/cek', 'cekWajah')->name('absen-wajah-cek');
            });
            Route::get('/hasil-absen', 'hasilAbsen')->name('face-results');
        });

        // ATTENDANCE SCHEDULE ROUTE
        Route::post(
            '/jadwal-kuliah/store/absen',
            [HomeController::class, 'jadkulAbsenStore']
        )
            ->name('home-jadkul-absen-store');
    });
});
