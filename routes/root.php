<?php

use Illuminate\Support\Facades\Route;

// HALAMAN UTAMA / FRONTEND
Route::get('/', [App\Http\Controllers\Root\HomeController::class, 'index'])->name('root.home-index');
Route::get('/post/view/{slug}', [App\Http\Controllers\Root\HomeController::class, 'postView'])->name('root.post-view');
Route::get('/advice', [App\Http\Controllers\Root\HomeController::class, 'adviceIndex'])->name('root.home-advice');
Route::get('/download', [App\Http\Controllers\Root\HomeController::class, 'downloadIndex'])->name('root.home-download');
Route::get('/album-foto', [App\Http\Controllers\Root\HomeController::class, 'galleryIndex'])->name('root.gallery-index');
Route::get('/album-foto/search', [App\Http\Controllers\Root\HomeController::class, 'gallerySearch'])->name('root.gallery-search');
Route::get('/album-foto/show/{slug}', [App\Http\Controllers\Root\HomeController::class, 'galleryShow'])->name('root.gallery-show');
Route::get('/admission/{slug}', [App\Http\Controllers\Root\HomeController::class, 'prodiIndex'])->name('root.home-prodi');
Route::get('/program-kuliah/{code}', [App\Http\Controllers\Root\HomeController::class, 'prokuIndex'])->name('root.home-proku');
Route::post('/advice/store', [App\Http\Controllers\Root\HomeController::class, 'adviceStore'])->name('root.home-advice-store');
