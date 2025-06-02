<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\Inventory\{
    CommodityAcquisitionController,
    CommodityLocationController,
    GedungController,
    RuangController
};

// SUPPORT DEPARTMENT ROUTES
Route::group([
    'prefix' => 'support',
    'middleware' => ['user-access:Departement Support'],
    'as' => 'support.'
], function () {
    // GLOBAL ROUTES
    require __DIR__ . '/route-global.php';

    // ACTIVE USER ROUTES
    Route::middleware(['is-active:1'])->group(function () {

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

            // Location
            Route::prefix('data-lokasi')->name('lokasi-')->group(function () {
                Route::get('/', [CommodityLocationController::class, 'index'])->name('index');
                Route::post('/store', [CommodityLocationController::class, 'store'])->name('store');
                Route::get('/{id}/show', [CommodityLocationController::class, 'show'])->name('show');
                Route::patch('/{code}/update', [CommodityLocationController::class, 'update'])->name('update');
                Route::delete('/{code}/destroy', [CommodityLocationController::class, 'destroy'])->name('destroy');

                Route::post('/import', [CommodityLocationController::class, 'import'])->name('import');
                Route::post('/export', [CommodityLocationController::class, 'export'])->name('export');
            });
        });
    });
});
