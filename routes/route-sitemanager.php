<?php

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

        
    });
});
