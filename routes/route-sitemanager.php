<?php

use Illuminate\Support\Facades\Route;

// HAK AKSES DEPARTEMENT ACADEMIC
Route::group(['prefix' => 'sitemanager', 'middleware' => ['user-access:Departement Site Manager'], 'as' => 'sitemanager.'],function(){

    // GLOBAL ROUTE
    require __DIR__.'/route-global.php';

    // STATUS ACTIVE BOLEH AKSES INI
    Route::middleware(['is-active:1'])->group(function () {
        Route::resource('mutabaah', \App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahController::class)->name('mutabaah', 'mutabaah');
        Route::resource('mutabaah-fields', \App\Http\Controllers\Admin\Pages\Mutabaah\MutabaahFieldController::class)->name('mutabaah-fields', 'mutabaah-fields');
    });

});
