<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahController;
use App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahFieldController;

// SITE MANAGER DEPARTMENT ROUTES
Route::group([
    'prefix' => 'musyrif',
    'middleware' => ['user-access:Departement Musyrif'],
    'as' => 'musyrif.'
], function () {
    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';

    // ACTIVE USER ROUTES
    Route::middleware(['is-active:1'])->group(function () {

        // MUTABA'AH
        Route::resource('mutabaah', MutabaahController::class);
        Route::delete('mutabaah/{mutabaah}', [MutabaahController::class, 'delete'])->name('mutabaah.delete');
        Route::resource('mutabaah-fields', MutabaahFieldController::class);
    });
});
