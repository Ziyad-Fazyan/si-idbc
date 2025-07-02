<?php

use App\Http\Controllers\Admin\Pages\LandingPageController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\Core\NotifyController;
use App\Http\Controllers\Core\WebSettingController;
use App\Http\Controllers\Admin\Pages\WorkersController;
use App\Http\Controllers\Admin\FaceRecognitionController;
use App\Http\Controllers\Admin\Pages\Core\KelasController;
use App\Http\Controllers\Admin\Pages\Core\FakultasController;
use App\Http\Controllers\Admin\Pages\Core\KurikulumController;
use App\Http\Controllers\Admin\Pages\Core\MataKuliahController;
use App\Http\Controllers\Admin\Pages\Finance\BalanceController;
use App\Http\Controllers\Admin\Pages\Inventory\RuangController;
use App\Http\Controllers\Admin\Pages\MahasiswaHealthController;
use App\Http\Controllers\Admin\Pages\Finance\ApprovalController;
use App\Http\Controllers\Admin\Pages\Inventory\GedungController;
use App\Http\Controllers\Admin\Pages\Core\JadwalKuliahController;
use App\Http\Controllers\Admin\Pages\Core\ProgramStudiController;
use App\Http\Controllers\Admin\Pages\Core\ProgramKuliahController;
use App\Http\Controllers\Admin\Pages\Core\TahunAkademikController;
use App\Http\Controllers\Admin\Pages\Finance\PembayaranController;
use App\Http\Controllers\Admin\Pages\Inventory\CommodityController;
use App\Http\Controllers\Admin\Pages\Finance\TicketSupportController;
use App\Http\Controllers\Admin\Pages\Finance\GenerateTagihanController;
use App\Http\Controllers\Mahasiswa\HomeController as MahasiswaHomeController;
use App\Http\Controllers\Admin\Pages\Inventory\CommodityAcquisitionController;

// WEB ADMINISTRATOR ROUTES
Route::group([
    'prefix' => 'web-admin',
    'middleware' => ['user-access:Web Administrator'],
    'as' => 'web-admin.'
], function () {
    // GLOBAL ROUTES
    require __DIR__ . '/route-global.php';

    // ACTIVE USER ROUTES
    Route::middleware(['is-active:1'])->group(function () {

        // PRIVATE FUNCTION => ABSEN WAJAH
        Route::get('/daftar-wajah', [FaceRecognitionController::class, 'daftar'])->name('daftar-wajah-index');
        Route::get('/absen-wajah', [FaceRecognitionController::class, 'index'])->name('absen-wajah-index');
        Route::post('/absen-wajah', [FaceRecognitionController::class, 'uploadFoto'])->name('absen-wajah');
        Route::post('/absen-wajah/cek', [FaceRecognitionController::class, 'cekWajah'])->name('absen-wajah-cek');
        Route::get('/hasil-absen', [FaceRecognitionController::class, 'hasilAbsen'])->name('face-results');
        Route::post('/jadwal-kuliah/store/absen', [MahasiswaHomeController::class, 'jadkulAbsenStore'])->name('home-jadkul-absen-store');

        // Landing Page Content Management
        Route::prefix('landing-page')->name('landing-page.')->group(function () {
            Route::get('/', [LandingPageController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [LandingPageController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LandingPageController::class, 'update'])->name('update');
        });

        // TRASH MANAGEMENT
        Route::prefix('trash')->name('trash.')->group(function () {
            Route::get('/', [TrashController::class, 'index'])->name('index');
            Route::get('/{model}', [TrashController::class, 'show'])->name('show');
            Route::get('/{model}/restore/{id}', [TrashController::class, 'restore'])->name('restore');
            Route::get('/{model}/force-delete/{id}', [TrashController::class, 'forceDelete'])->name('force-delete');
            Route::get('/{model}/restore-all', [TrashController::class, 'restoreAll'])->name('restore-all');
            Route::get('/{model}/empty', [TrashController::class, 'emptyTrash'])->name('empty');
        });

        // WORKERS ROUTES
        Route::prefix('workers')->name('workers.')->group(function () {
            // Admin routes
            Route::prefix('data-admin')->name('admin-')->group(function () {
                Route::get('/', [WorkersController::class, 'indexAdmin'])->name('index');
                Route::get('/create', [WorkersController::class, 'createAdmin'])->name('create');
                Route::get('/{code}/edit', [WorkersController::class, 'editAdmin'])->name('edit');
                Route::post('/store', [WorkersController::class, 'storeAdmin'])->name('store');
                Route::patch('/{code}/update', [WorkersController::class, 'updateAdmin'])->name('update');
                Route::delete('/{code}/destroy', [WorkersController::class, 'destroyAdmin'])->name('destroy');
            });

            // Staff routes
            Route::prefix('data-staff')->name('staff-')->group(function () {
                Route::get('/', [WorkersController::class, 'indexWorkers'])->name('index');
                Route::get('/create', [WorkersController::class, 'createWorkers'])->name('create');
                Route::get('/{code}/edit', [WorkersController::class, 'editWorkers'])->name('edit');
                Route::post('/store', [WorkersController::class, 'storeWorkers'])->name('store');
                Route::patch('/{code}/update', [WorkersController::class, 'updateWorkers'])->name('update');
                Route::delete('/{code}/destroy', [WorkersController::class, 'destroyWorkers'])->name('destroy');
            });

            // Lecture routes
            Route::prefix('data-dosen')->name('lecture-')->group(function () {
                Route::get('/', [WorkersController::class, 'indexLecture'])->name('index');
                Route::get('/create', [WorkersController::class, 'createLecture'])->name('create');
                Route::get('/{code}/edit', [WorkersController::class, 'editLecture'])->name('edit');
                Route::post('/store', [WorkersController::class, 'storeLecture'])->name('store');
                Route::patch('/{code}/update', [WorkersController::class, 'updateLecture'])->name('update');
                Route::delete('/{code}/destroy', [WorkersController::class, 'destroyLecture'])->name('destroy');
            });

            // Student routes
            Route::prefix('data-mahasiswa')->name('student-')->group(function () {
                Route::get('/', [WorkersController::class, 'indexStudent'])->name('index');
                Route::get('/create', [WorkersController::class, 'createStudent'])->name('create');
                Route::get('/{code}/edit', [WorkersController::class, 'editStudent'])->name('edit');
                Route::post('/store', [WorkersController::class, 'storeStudent'])->name('store');
                Route::patch('/{code}/update', [WorkersController::class, 'updateStudent'])->name('update');
                Route::delete('/{code}/destroy', [WorkersController::class, 'destroyStudent'])->name('destroy');
            });
        });

        // Mahasiswa Health Routes
        Route::prefix('data-kesehatan-mahasiswa')->name('mahasiswa-health.')->group(function () {
            Route::get('/', [MahasiswaHealthController::class, 'index'])->name('index');
            Route::get('/{code}/edit', [MahasiswaHealthController::class, 'edit'])->name('edit');
            Route::patch('/{code}/update', [MahasiswaHealthController::class, 'update'])->name('update');
        });

        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::prefix('dosen')->name('dosen.')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'indexDosen'])->name('index');
                Route::get('/{id}', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'showDosen'])->name('show');
                Route::put('/{id}/update-status', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'updateStatusDosen'])->name('update-status');
                Route::delete('/{id}', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'destroyDosen'])->name('destroy');
            });

            Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'indexMahasiswa'])->name('index');
                Route::get('/{id}', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'showMahasiswa'])->name('show');
                Route::put('/{id}/update-status', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'updateStatusMahasiswa'])->name('update-status');
                Route::delete('/{id}', [App\Http\Controllers\Admin\AbsensiAdminController::class, 'destroyMahasiswa'])->name('destroy');
            });
        });

        // MASTER DATA ROUTES
        Route::prefix('master')->name('master.')->group(function () {

            // Fakultas
            Route::prefix('data-fakultas')->name('fakultas-')->group(function () {
                Route::get('/', [FakultasController::class, 'index'])->name('index');
                Route::post('/store', [FakultasController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [FakultasController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [FakultasController::class, 'destroy'])->name('destroy');
            });

            // Program Studi
            Route::prefix('data-pstudi')->name('pstudi-')->group(function () {
                Route::get('/', [ProgramStudiController::class, 'index'])->name('index');
                Route::post('/store', [ProgramStudiController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [ProgramStudiController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [ProgramStudiController::class, 'destroy'])->name('destroy');
            });

            // Tahun Akademik
            Route::prefix('data-taka')->name('taka-')->group(function () {
                Route::get('/', [TahunAkademikController::class, 'index'])->name('index');
                Route::post('/store', [TahunAkademikController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [TahunAkademikController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [TahunAkademikController::class, 'destroy'])->name('destroy');
            });

            // Program Kuliah
            Route::prefix('data-proku')->name('proku-')->group(function () {
                Route::get('/', [ProgramKuliahController::class, 'index'])->name('index');
                Route::post('/store', [ProgramKuliahController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [ProgramKuliahController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [ProgramKuliahController::class, 'destroy'])->name('destroy');
            });

            // Kelas
            Route::prefix('data-kelas')->name('kelas-')->group(function () {
                Route::get('/', [KelasController::class, 'index'])->name('index');
                Route::get('/{code}/view/mahasiswa', [KelasController::class, 'viewMahasiswa'])->name('mahasiswa-view');
                Route::post('/store', [KelasController::class, 'store'])->name('store');
                Route::post('/{code}/cetak/mahasiswa', [KelasController::class, 'cetakMahasiswa'])->name('mahasiswa-cetak');
                Route::patch('/{code}/update', [KelasController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [KelasController::class, 'destroy'])->name('destroy');

                // Kelas Management (Pivot Table)
                Route::get('/{code}/management', [App\Http\Controllers\Admin\Pages\Core\KelasManagementController::class, 'index'])->name('management');
                Route::post('/{code}/management/add', [App\Http\Controllers\Admin\Pages\Core\KelasManagementController::class, 'addMahasiswa'])->name('management-add');
                Route::delete('/{code}/management/remove', [App\Http\Controllers\Admin\Pages\Core\KelasManagementController::class, 'removeMahasiswa'])->name('management-remove');
            });

            // Kurikulum
            Route::prefix('data-kurikulum')->name('kurikulum-')->group(function () {
                Route::get('/', [KurikulumController::class, 'index'])->name('index');
                Route::get('/{code}/view', [KurikulumController::class, 'view'])->name('view');
                Route::post('/store', [KurikulumController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [KurikulumController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [KurikulumController::class, 'destroy'])->name('destroy');
            });

            // Mata Kuliah
            Route::prefix('data-matkul')->name('matkul-')->group(function () {
                Route::get('/', [MataKuliahController::class, 'index'])->name('index');
                Route::get('/create', [MataKuliahController::class, 'create'])->name('create');
                Route::post('/store', [MataKuliahController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [MataKuliahController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [MataKuliahController::class, 'destroy'])->name('destroy');
            });

            // Jadwal Kuliah
            Route::prefix('data-jadkul')->name('jadkul-')->group(function () {
                Route::get('/', [JadwalKuliahController::class, 'index'])->name('index');
                Route::get('/{code}/viewAbsen', [JadwalKuliahController::class, 'viewAbsen'])->name('absen-view');
                Route::get('/create', [JadwalKuliahController::class, 'create'])->name('create');
                Route::post('/store', [JadwalKuliahController::class, 'store'])->name('store');
                Route::post('/{code}/cetakAbsen', [JadwalKuliahController::class, 'cetakAbsen'])->name('absen-cetak');
                Route::patch('/{code}/updateAbsen', [JadwalKuliahController::class, 'updateAbsen'])->name('absen-update');
                Route::patch('/{code}/update', [JadwalKuliahController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [JadwalKuliahController::class, 'destroy'])->name('destroy');
            });
        });

        // INVENTORY ROUTES
        Route::prefix('inventory')->name('inventory.')->group(function () {
            // Gedung
            Route::prefix('data-gedung')->name('gedung-')->group(function () {
                Route::get('/', [GedungController::class, 'index'])->name('index');
                Route::post('/store', [GedungController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [GedungController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [GedungController::class, 'destroy'])->name('destroy');
            });

            // Ruang
            Route::prefix('data-ruang')->name('ruang-')->group(function () {
                Route::get('/', [RuangController::class, 'index'])->name('index');
                Route::post('/store', [RuangController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [RuangController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [RuangController::class, 'destroy'])->name('destroy');
            });

            // Aquisition
            Route::prefix('data-perolehan')->name('perolehan-')->group(function () {
                Route::get('/', [CommodityAcquisitionController::class, 'index'])->name('index');
                Route::get('/{id}/show', [CommodityAcquisitionController::class, 'show'])->name('show');
                Route::post('/store', [CommodityAcquisitionController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [CommodityAcquisitionController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [CommodityAcquisitionController::class, 'destroy'])->name('destroy');
            });

            // Barang
            Route::prefix('data-barang')->name('barang-')->group(function () {
                Route::get('/', [CommodityController::class, 'index'])->name('index');
                Route::get('/{id}/show', [CommodityController::class, 'show'])->name('show');
                Route::post('/store', [CommodityController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [CommodityController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [CommodityController::class, 'destroy'])->name('destroy');

                Route::post('/print', [CommodityController::class, 'generatePDF'])->name('print');
                Route::post('/print/{id}', [CommodityController::class, 'generatePDFIndividually'])->name('print-individual');
                Route::post('/export', [CommodityController::class, 'export'])->name('export');
                Route::post('/import', [CommodityController::class, 'import'])->name('import');
            });
        });


        // FINANCE ROUTES
        Route::prefix('finance')->name('finance.')->group(function () {
            // Tagihan
            Route::prefix('data-tagihan')->name('tagihan-')->group(function () {
                Route::get('/', [GenerateTagihanController::class, 'index'])->name('index');
                Route::get('/create', [GenerateTagihanController::class, 'create'])->name('create');
                Route::post('/store', [GenerateTagihanController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [GenerateTagihanController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [GenerateTagihanController::class, 'destroy'])->name('destroy');
            });

            // Pembayaran
            Route::prefix('data-pembayaran')->name('pembayaran-')->group(function () {
                Route::get('/', [PembayaranController::class, 'index'])->name('index');
                Route::get('/create', [PembayaranController::class, 'create'])->name('create');
                Route::post('/store', [PembayaranController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [PembayaranController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [PembayaranController::class, 'destroy'])->name('destroy');
                Route::get('/unpaid-mahasantri', [PembayaranController::class, 'unpaidMahasantri'])->name('unpaid-mahasantri');
            });

            // Keuangan
            Route::prefix('data-keuangan')->name('keuangan-')->group(function () {
                Route::get('/', [BalanceController::class, 'index'])->name('index');
                Route::post('/store', [BalanceController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [BalanceController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [BalanceController::class, 'destroy'])->name('destroy');
            });
        });

        // Approval Absensi
        Route::prefix('approval-absen')->name('approval.absen-')->group(function () {
            Route::get('/', [ApprovalController::class, 'indexAbsen'])->name('index');
            Route::get('/approved', [ApprovalController::class, 'indexAbsenApproved'])->name('index-approved');
            Route::get('/rejected', [ApprovalController::class, 'indexAbsenRejected'])->name('index-rejected');
            Route::patch('/{code}/update/accept', [ApprovalController::class, 'updateAbsenAccept'])->name('update-accept');
            Route::patch('/{code}/update/reject', [ApprovalController::class, 'updateAbsenReject'])->name('update-reject');
        });

        // SUPPORT TICKET ROUTES
        Route::prefix('support')->name('support.ticket-')->group(function () {
            Route::get('/', [TicketSupportController::class, 'index'])->name('index');
            Route::get('/view/{code}', [TicketSupportController::class, 'view'])->name('view');
            Route::post('/create/store-reply/{code}', [TicketSupportController::class, 'storeReply'])->name('store-reply');
        });

        // SYSTEM ROUTES
        Route::prefix('system')->name('system.')->group(function () {
            // Notifikasi
            Route::prefix('notify')->name('notify-')->group(function () {
                Route::get('/', [NotifyController::class, 'index'])->name('index');
                Route::post('/store', [NotifyController::class, 'store'])->name('store');
                Route::patch('/{code}/update', [NotifyController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [NotifyController::class, 'destroy'])->name('destroy');
            });

            // Web Settings
            Route::prefix('setting')->name('setting-')->group(function () {
                Route::get('/', [WebSettingController::class, 'index'])->name('index');
                Route::patch('/update', [WebSettingController::class, 'update'])->name('update');
            });

            // Database and Update
            Route::prefix('database')->name('database-')->group(function () {
                Route::get('/export', [WebSettingController::class, 'databaseExport'])->name('export');
                Route::post('/import', [WebSettingController::class, 'databaseImport'])->name('import');
            });

            Route::post('/update/check', [WebSettingController::class, 'updateCheck'])->name('website-check');
            Route::post('/update/perform', [WebSettingController::class, 'updatePerform'])->name('website-update');
        });
    });
});
