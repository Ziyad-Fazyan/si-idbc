<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\Akademik\NilaiMahasiswaController;

// =======================
// ROUTE UNTUK NILAI MAHASISWA (DOSEN)
// =======================
Route::group([
    'prefix' => 'dosen',
    'middleware' => ['dsn-access:Dosen Aktif'],
    'as' => 'dosen.'
], function () {

    // ============================
    // DATA AKADEMIK - NILAI MAHASISWA
    // ============================
    Route::prefix('/data-akademik/nilai-mahasiswa')->name('akademik.nilai-')->group(function () {
        Route::get('/', [NilaiMahasiswaController::class, 'index'])->name('index');
        Route::get('/mata-kuliah/{id}', [NilaiMahasiswaController::class, 'mataKuliahDetail'])->name('mata-kuliah-detail');
        Route::post('/simpan-nilai', [NilaiMahasiswaController::class, 'simpanNilai'])->name('simpan');
        Route::post('/kunci-nilai/{id}', [NilaiMahasiswaController::class, 'kunciNilai'])->name('kunci');
        Route::get('/rekap/{id}', [NilaiMahasiswaController::class, 'rekapNilai'])->name('rekap');
    });
});