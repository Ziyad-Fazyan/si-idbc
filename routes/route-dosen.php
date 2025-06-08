<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\AuthController;
use App\Http\Controllers\Dosen\HomeController;
use App\Http\Controllers\Dosen\Akademik\JadwalAjarController;
use App\Http\Controllers\Dosen\Akademik\StudentTaskController;
use App\Http\Controllers\Services\Ajax\GraphicController;
use App\Http\Controllers\Dosen\Akademik\NilaiMahasiswaController;

// =======================
// HAK AKSES UNTUK DOSEN
// =======================
Route::group([
    'prefix' => 'dosen',
    'middleware' => ['dsn-access:Dosen Aktif'],
    'as' => 'dosen.'
], function () {

    // ===============
    // GLOBAL AUTH MENU
    // ===============
    Route::get('/signout', [AuthController::class, 'AuthSignOutPost'])->name('auth-signout-post');

    // ==========
    // DASHBOARD
    // ==========
    Route::get('/home', [HomeController::class, 'index'])->name('home-index');
    Route::get('/profile', [HomeController::class, 'profile'])->name('home-profile');

    // ============
    // PROFILE EDIT
    // ============
    Route::patch('/profile/update-image', [HomeController::class, 'saveImageProfile'])->name('home-profile-save-image');
    Route::patch('/profile/update-data', [HomeController::class, 'saveDataProfile'])->name('home-profile-save-data');
    Route::patch('/profile/update-kontak', [HomeController::class, 'saveDataKontak'])->name('home-profile-save-kontak');
    Route::patch('/profile/update-password', [HomeController::class, 'saveDataPassword'])->name('home-profile-save-password');

    // ============================
    // DATA AKADEMIK - JADWAL MENGAJAR
    // ============================
    Route::get('/data-akademik/jadwal', [JadwalAjarController::class, 'index'])->name('akademik.jadwal-index');
    Route::get('/data-akademik/jadwal/{code}/absen', [JadwalAjarController::class, 'viewAbsen'])->name('akademik.jadwal-view-absen');
    Route::get('/data-akademik/jadwal/{code}/feedback', [JadwalAjarController::class, 'viewFeedBack'])->name('akademik.jadwal-view-feedback');
    Route::patch('/data-akademik/jadwal/absen/{code}/update', [JadwalAjarController::class, 'updateAbsen'])->name('akademik.jadwal-absen-update');

    // ============================
    // DATA AKADEMIK - KELOLA TUGAS
    // ============================
    Route::prefix('/data-akademik/kelola-tugas')->name('akademik.stask-')->group(function () {
        Route::get('/', [StudentTaskController::class, 'index'])->name('index');
        Route::get('/tambah', [StudentTaskController::class, 'create'])->name('create');
        Route::get('/view/{code}', [StudentTaskController::class, 'view'])->name('view');
        Route::get('/view/detail/{code}', [StudentTaskController::class, 'viewDetail'])->name('view-detail');
        Route::get('/edit/{code}', [StudentTaskController::class, 'edit'])->name('edit');
        Route::get('/edit/{code}/score', [StudentTaskController::class, 'editScore'])->name('edit-score');
        Route::post('/store', [StudentTaskController::class, 'store'])->name('store');
        Route::patch('/update/{code}', [StudentTaskController::class, 'update'])->name('update');
        Route::patch('/update/{code}/score', [StudentTaskController::class, 'updateScore'])->name('update-score');
        Route::delete('/delete/{code}', [StudentTaskController::class, 'destroy'])->name('destroy');
    });

    // =====================
    // AJAX: GRAPHIC SERVICE
    // =====================
    Route::prefix('/services/ajax/graphic')->name('services.ajax.graphic.')->group(function () {
        Route::get('/{code}/kepuasan-mengajar', [GraphicController::class, 'getKepuasanMengajar'])->name('kepuasan-mengajar');
        Route::get('/kepuasan-mengajar/dosen', [GraphicController::class, 'getKepuasanMengajarDosen'])->name('kepuasan-mengajar-dosen');
    });

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
