<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Root\HomeController;
use App\Http\Controllers\Root\PpdbController;

// HALAMAN UTAMA / FRONTEND
Route::get('/', [HomeController::class, 'index'])->name('root.home-index');
Route::get('/post/view/{slug}', [HomeController::class, 'postView'])->name('root.post-view');
Route::get('/advice', [HomeController::class, 'adviceIndex'])->name('root.home-advice');
Route::post('/advice/store', [HomeController::class, 'adviceStore'])->name('root.home-advice-store');
Route::get('/download', [HomeController::class, 'downloadIndex'])->name('root.home-download');
Route::get('/album-foto', [HomeController::class, 'galleryIndex'])->name('root.gallery-index');
Route::get('/album-foto/search', [HomeController::class, 'gallerySearch'])->name('root.gallery-search');
Route::get('/album-foto/show/{slug}', [HomeController::class, 'galleryShow'])->name('root.gallery-show');
Route::get('/admission/{slug}', [HomeController::class, 'prodiIndex'])->name('root.home-prodi');
Route::get('/program-kuliah/{code}', [HomeController::class, 'prokuIndex'])->name('root.home-proku');

// KURIKULUM ROUTE
Route::get('/kurikulum', function () {
    return view('root.pages.kurikulum-index');
})->name('root.kurikulum-index');
// TENTANG KAMI ROUTE
Route::get('/tentang-kami', function () {
    return view('root.pages.tentang-kami');
})->name('root.tentang-kami');
//KOMPETENSI ROUTE DESIGN
Route::get('/kompetensi-design', function () {
    return view('root.pages.kompetensi-design');
})->name('root.kompetensi-design');
//KOMPETENSI ROUTE PROGRAMMER
Route::get('/kompetensi-prog', function () {
    return view('root.pages.kompetensi-prog');
})->name('root.kompetensi-prog');

// FORMULIR PPDB
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('form', [PpdbController::class, 'index'])->name('form');
    Route::post('store-student', [PpdbController::class, 'store'])->name('store');
});