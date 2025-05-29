<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\WorkersController;
use App\Http\Controllers\Services\Convert\ExportController;
use App\Http\Controllers\Services\Convert\ImportController;
use App\Http\Controllers\Admin\Pages\Core\{
    FakultasController,
    ProgramStudiController,
    TahunAkademikController,
    ProgramKuliahController,
    KelasController,
    KurikulumController,
    MataKuliahController,
    JadwalKuliahController
};

// HAK AKSES DEPARTEMENT ACADEMIC
Route::group([
    'prefix' => 'academic',
    'middleware' => ['user-access:Departement Academic'],
    'as' => 'academic.'
], function() {

    // GLOBAL ROUTE
    require __DIR__.'/route-global.php';

    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {

        // MENU KHUSUS DATA PENGGUNA => DATA MAHASISWA
        Route::prefix('data-mahasiswa')->group(function() {
            Route::get('/', [WorkersController::class, 'indexStudent'])->name('workers.student-index');
            Route::get('/create', [WorkersController::class, 'createStudent'])->name('workers.student-create');
            Route::get('/{code}/edit', [WorkersController::class, 'editStudent'])->name('workers.student-edit');
            Route::post('/store', [WorkersController::class, 'storeStudent'])->name('workers.student-store');
            Route::patch('/{code}/update', [WorkersController::class, 'updateStudent'])->name('workers.student-update');
            Route::delete('/{code}/destroy', [WorkersController::class, 'destroyStudent'])->name('workers.student-destroy');
        });

        // SERVICE CONVERT EXPORT - IMPORT
        Route::prefix('services/convert')->group(function() {
            Route::get('/export-student', [ExportController::class, 'exportStudent'])->name('services.convert.export-student');
            Route::get('/export-users', [ExportController::class, 'exportUsers'])->name('services.convert.export-users');
            Route::post('/import-users', [ImportController::class, 'importUsers'])->name('services.convert.import-users');
            Route::post('/import-student', [ImportController::class, 'importStudent'])->name('services.convert.import-student');
        });

        // MENU KHUSUS DATA MASTER
        Route::prefix('master')->group(function() {
            // DATA FAKULTAS
            Route::prefix('data-fakultas')->group(function() {
                Route::get('/', [FakultasController::class, 'index'])->name('master.fakultas-index');
                Route::post('/store', [FakultasController::class, 'store'])->name('master.fakultas-store');
                Route::patch('/{code}/update', [FakultasController::class, 'update'])->name('master.fakultas-update');
                Route::delete('/{code}/destroy', [FakultasController::class, 'destroy'])->name('master.fakultas-destroy');
            });

            // DATA PROGRAM STUDI
            Route::prefix('data-pstudi')->group(function() {
                Route::get('/', [ProgramStudiController::class, 'index'])->name('master.pstudi-index');
                Route::post('/store', [ProgramStudiController::class, 'store'])->name('master.pstudi-store');
                Route::patch('/{code}/update', [ProgramStudiController::class, 'update'])->name('master.pstudi-update');
                Route::delete('/{code}/destroy', [ProgramStudiController::class, 'destroy'])->name('master.pstudi-destroy');
            });

            // DATA TAHUN AKADEMIK
            Route::prefix('data-taka')->group(function() {
                Route::get('/', [TahunAkademikController::class, 'index'])->name('master.taka-index');
                Route::post('/store', [TahunAkademikController::class, 'store'])->name('master.taka-store');
                Route::patch('/{code}/update', [TahunAkademikController::class, 'update'])->name('master.taka-update');
                Route::delete('/{code}/destroy', [TahunAkademikController::class, 'destroy'])->name('master.taka-destroy');
            });

            // DATA PROGRAM KULIAH
            Route::prefix('data-proku')->group(function() {
                Route::get('/', [ProgramKuliahController::class, 'index'])->name('master.proku-index');
                Route::post('/store', [ProgramKuliahController::class, 'store'])->name('master.proku-store');
                Route::patch('/{code}/update', [ProgramKuliahController::class, 'update'])->name('master.proku-update');
                Route::delete('/{code}/destroy', [ProgramKuliahController::class, 'destroy'])->name('master.proku-destroy');
            });

            // DATA KELAS
            Route::prefix('data-kelas')->group(function() {
                Route::get('/', [KelasController::class, 'index'])->name('master.kelas-index');
                Route::get('/{code}/view/mahasiswa', [KelasController::class, 'viewMahasiswa'])->name('master.kelas-mahasiswa-view');
                Route::post('/store', [KelasController::class, 'store'])->name('master.kelas-store');
                Route::post('/{code}/cetak/mahasiswa', [KelasController::class, 'cetakMahasiswa'])->name('master.kelas-mahasiswa-cetak');
                Route::patch('/{code}/update', [KelasController::class, 'update'])->name('master.kelas-update');
                Route::delete('/{code}/destroy', [KelasController::class, 'destroy'])->name('master.kelas-destroy');
            });

            // DATA KURIKULUM
            Route::prefix('data-kurikulum')->group(function() {
                Route::get('/', [KurikulumController::class, 'index'])->name('master.kurikulum-index');
                Route::get('/{code}/view', [KurikulumController::class, 'view'])->name('master.kurikulum-view');
                Route::post('/store', [KurikulumController::class, 'store'])->name('master.kurikulum-store');
                Route::patch('/{code}/update', [KurikulumController::class, 'update'])->name('master.kurikulum-update');
                Route::delete('/{code}/destroy', [KurikulumController::class, 'destroy'])->name('master.kurikulum-destroy');
            });

            // DATA MATAKULIAH
            Route::prefix('data-matkul')->group(function() {
                Route::get('/', [MataKuliahController::class, 'index'])->name('master.matkul-index');
                Route::get('/create', [MataKuliahController::class, 'create'])->name('master.matkul-create');
                Route::post('/store', [MataKuliahController::class, 'store'])->name('master.matkul-store');
                Route::patch('/{code}/update', [MataKuliahController::class, 'update'])->name('master.matkul-update');
                Route::delete('/{code}/destroy', [MataKuliahController::class, 'destroy'])->name('master.matkul-destroy');
            });

            // DATA JADWAL KULIAH
            Route::prefix('data-jadkul')->group(function() {
                Route::get('/', [JadwalKuliahController::class, 'index'])->name('master.jadkul-index');
                Route::get('/{code}/viewAbsen', [JadwalKuliahController::class, 'viewAbsen'])->name('master.jadkul-absen-view');
                Route::get('/create', [JadwalKuliahController::class, 'create'])->name('master.jadkul-create');
                Route::post('/store', [JadwalKuliahController::class, 'store'])->name('master.jadkul-store');
                Route::post('/{code}/cetakAbsen', [JadwalKuliahController::class, 'cetakAbsen'])->name('master.jadkul-absen-cetak');
                Route::patch('/{code}/updateAbsen', [JadwalKuliahController::class, 'updateAbsen'])->name('master.jadkul-absen-update');
                Route::patch('/{code}/update', [JadwalKuliahController::class, 'update'])->name('master.jadkul-update');
                Route::delete('/{code}/destroy', [JadwalKuliahController::class, 'destroy'])->name('master.jadkul-destroy');
            });
        });
    });
});