<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\Finance\{
    GenerateTagihanController,
    PembayaranController,
    BalanceController,
    ApprovalController
};

// HAK AKSES DEPARTEMENT FINANCE
Route::group([
    'prefix' => 'finance',
    'middleware' => ['user-access:Departement Finance'],
    'as' => 'finance.'
], function () {

    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';

    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {

        // MENU KHUSUS FINANCE DEPARTEMENT => DATA TAGIHAN
        Route::prefix('data-tagihan')->group(function () {
            Route::get('/', [GenerateTagihanController::class, 'index'])->name('finance.tagihan-index');
            Route::get('/create', [GenerateTagihanController::class, 'create'])->name('finance.tagihan-create');
            Route::post('/store', [GenerateTagihanController::class, 'store'])->name('finance.tagihan-store');
            Route::patch('/{code}/update', [GenerateTagihanController::class, 'update'])->name('finance.tagihan-update');
            Route::delete('/{code}/destroy', [GenerateTagihanController::class, 'destroy'])->name('finance.tagihan-destroy');
        });

        // MENU KHUSUS FINANCE DEPARTEMENT => DATA PEMBAYARAN
        Route::prefix('data-pembayaran')->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('finance.pembayaran-index');
            Route::get('/create', [PembayaranController::class, 'create'])->name('finance.pembayaran-create');
            Route::post('/store', [PembayaranController::class, 'store'])->name('finance.pembayaran-store');
            Route::patch('/{code}/update', [PembayaranController::class, 'update'])->name('finance.pembayaran-update');
            Route::delete('/{code}/destroy', [PembayaranController::class, 'destroy'])->name('finance.pembayaran-destroy');
            Route::get('/unpaid-mahasantri', [PembayaranController::class, 'unpaidMahasantri'])->name('finance.unpaid-mahasantri');
        });

        // MENU KHUSUS FINANCE DEPARTEMENT => DATA KEUANGAN
        Route::prefix('data-keuangan')->group(function () {
            Route::get('/', [BalanceController::class, 'index'])->name('finance.keuangan-index');
            Route::post('/store', [BalanceController::class, 'store'])->name('finance.keuangan-store');
            Route::patch('/{code}/update', [BalanceController::class, 'update'])->name('finance.keuangan-update');
            Route::delete('/{code}/destroy', [BalanceController::class, 'destroy'])->name('finance.keuangan-destroy');
        });

        // MENU KHUSUS FINANCE DEPARTEMENT => DATA APPROVAL ABSENSI KARYAWAN
        Route::prefix('approval-absen')->group(function () {
            Route::get('/', [ApprovalController::class, 'indexAbsen'])->name('approval.absen-index');
            Route::get('/approved', [ApprovalController::class, 'indexAbsenApproved'])->name('approval.absen-index-approved');
            Route::get('/rejected', [ApprovalController::class, 'indexAbsenRejected'])->name('approval.absen-index-rejected');
            Route::patch('/{code}/update/accept', [ApprovalController::class, 'updateAbsenAccept'])->name('approval.absen-update-accept');
            Route::patch('/{code}/update/reject', [ApprovalController::class, 'updateAbsenReject'])->name('approval.absen-update-reject');
        });
    });
});
