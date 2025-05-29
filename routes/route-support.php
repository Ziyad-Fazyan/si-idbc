<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\Inventory\{
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

        // INVENTORY - GEDUNG
        Route::get('/inventory/data-gedung', [GedungController::class, 'index'])->name('inventory.gedung-index');
        Route::post('/inventory/data-gedung/store', [GedungController::class, 'store'])->name('inventory.gedung-store');
        Route::patch('/inventory/data-gedung/{code}/update', [GedungController::class, 'update'])->name('inventory.gedung-update');
        Route::delete('/inventory/data-gedung/{code}/destroy', [GedungController::class, 'destroy'])->name('inventory.gedung-destroy');

        // INVENTORY - RUANG
        Route::get('/inventory/data-ruang', [RuangController::class, 'index'])->name('inventory.ruang-index');
        Route::post('/inventory/data-ruang/store', [RuangController::class, 'store'])->name('inventory.ruang-store');
        Route::patch('/inventory/data-ruang/{code}/update', [RuangController::class, 'update'])->name('inventory.ruang-update');
        Route::delete('/inventory/data-ruang/{code}/destroy', [RuangController::class, 'destroy'])->name('inventory.ruang-destroy');
    });
});
