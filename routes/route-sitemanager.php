<?php

use App\Http\Controllers\Admin\Pages\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahController;
use App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahFieldController;

// SITE MANAGER DEPARTMENT ROUTES
Route::group([
    'prefix' => 'sitemanager',
    'middleware' => ['user-access:Departement Site Manager'],
    'as' => 'sitemanager.'
], function () {
    // GLOBAL ROUTE
    require __DIR__ . '/route-global.php';

    // ACTIVE USER ROUTES
    Route::middleware(['is-active:1'])->group(function () {
        // Landing Page Content Management
        Route::prefix('landing-page')->name('landing-page.')->group(function () {
            Route::get('/', [LandingPageController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [LandingPageController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LandingPageController::class, 'update'])->name('update');
        });
    });
});
