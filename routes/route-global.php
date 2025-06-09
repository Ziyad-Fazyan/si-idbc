<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\Pages\Publikasi\DocumentController;
use App\Http\Controllers\Admin\Pages\News\PostController;
use App\Http\Controllers\Admin\Pages\News\CategoryController;
use App\Http\Controllers\Admin\Pages\Publikasi\GalleryController;
use App\Http\Controllers\Services\Convert\ExportController;
use App\Http\Controllers\Services\Convert\ImportController;
use App\Http\Controllers\Admin\Pages\Finance\TicketSupportController;
use App\Http\Controllers\Core\NotifyController;

// ------------------------------
// AUTHENTICATION
// ------------------------------
Route::get('/signout', [AuthController::class, 'AuthSignOutPost'])
    ->name('auth-signout-post');

// ------------------------------
// GLOBAL MENU
// ------------------------------
Route::get('/home', [HomeController::class, 'index'])
    ->name('home-index');

Route::get('/home/ajax/GetMhsGender', [HomeController::class, 'getMhsGender'])
    ->name('home.ajax-mhs-gender');

Route::get('/profile', [HomeController::class, 'profile'])
    ->name('home-profile');

// ------------------------------
// PROFILE MANAGEMENT
// ------------------------------
Route::patch('/profile/update-image', [HomeController::class, 'saveImageProfile'])
    ->name('home-profile-save-image');

Route::patch('/profile/update-data', [HomeController::class, 'saveDataProfile'])
    ->name('home-profile-save-data');

Route::patch('/profile/update-kontak', [HomeController::class, 'saveDataKontak'])
    ->name('home-profile-save-kontak');

Route::patch('/profile/update-password', [HomeController::class, 'saveDataPassword'])
    ->name('home-profile-save-password');

// ------------------------------
// PRESENSI
// ------------------------------
Route::get('/absen-harian', [PresensiController::class, 'absenHarian'])
    ->name('presensi.absen-harian');

Route::get('/absen-izin-cuti', [PresensiController::class, 'absenIzinCuti'])
    ->name('presensi.absen-izin-cuti');

Route::get('/absen-harian/view/{code}', [PresensiController::class, 'absenView'])
    ->name('presensi.absen-harian-view');

Route::post('/presensi/save-absen', [HomeController::class, 'saveAbsen'])
    ->name('home-presensi-input-absen');

Route::post('/presensi/save-izin', [HomeController::class, 'saveIzinCuti'])
    ->name('home-presensi-input-izin');

Route::patch('/presensi/update-absen', [PresensiController::class, 'absenPulang'])
    ->name('home-presensi-update-absen');

// ------------------------------
// FILE DOKUMEN
// ------------------------------
Route::get('/document', [DocumentController::class, 'index'])
    ->name('document-index');

Route::get('/document/create', [DocumentController::class, 'create'])
    ->name('document-create');

Route::post('/document/create', [DocumentController::class, 'store'])
    ->name('document-store');

Route::get('/document/{code}/download', [DocumentController::class, 'download'])
    ->name('document-download');

Route::delete('/document/{code}/destroy', [DocumentController::class, 'destroy'])
    ->name('document-destroy');

// ------------------------------
// KATEGORI BERITA
// ------------------------------
Route::get('/berita', [PostController::class, 'index'])
    ->name('news.post-index');

Route::get('/berita/create', [PostController::class, 'create'])
    ->name('news.post-create');

Route::get('/berita/view/{code}', [PostController::class, 'view'])
    ->name('news.post-view');

Route::post('/berita/store', [PostController::class, 'store'])
    ->name('news.post-store');

Route::patch('/berita/{code}/update', [PostController::class, 'update'])
    ->name('news.post-update');

Route::delete('/berita/{slug}/destroy', [PostController::class, 'destroy'])
    ->name('news.post-destroy');

// ------------------------------
// KATEGORI BERITA
// ------------------------------
Route::get('/berita/kategori', [CategoryController::class, 'index'])
    ->name('news.category-index');

Route::post('/berita/kategori/store', [CategoryController::class, 'store'])
    ->name('news.category-store');

Route::patch('/berita/kategori/{code}/update', [CategoryController::class, 'update'])
    ->name('news.category-update');

Route::delete('/berita/kategori/{code}/destroy', [CategoryController::class, 'destroy'])
    ->name('news.category-destroy');

// ------------------------------
// FOTO ALBUM
// ------------------------------
Route::get('/album', [GalleryController::class, 'index'])
    ->name('publish.album-index');

Route::get('/album/search', [GalleryController::class, 'search'])
    ->name('publish.album-search');

Route::get('/album/create', [GalleryController::class, 'create'])
    ->name('publish.album-create');

Route::get('/album/edit/{slug}', [GalleryController::class, 'edit'])
    ->name('publish.album-edit');

Route::get('/album/show/{slug}', [GalleryController::class, 'show'])
    ->name('publish.album-show');

Route::post('/album/store', [GalleryController::class, 'store'])
    ->name('publish.album-store');

Route::patch('/album/{code}/update', [GalleryController::class, 'update'])
    ->name('publish.album-update');

Route::delete('/album/{code}/destroy', [GalleryController::class, 'destroy'])
    ->name('publish.album-destroy');

// ------------------------------
// EXPORT IMPORT CORE
// ------------------------------
Route::post('/services/convert/export-student', [ExportController::class, 'exportStudent'])
    ->name('services.convert.export-student');

Route::post('/services/convert/export-users', [ExportController::class, 'exportUsers'])
    ->name('services.convert.export-users');

Route::post('/services/convert/import-users', [ImportController::class, 'importUsers'])
    ->name('services.convert.import-users');

Route::post('/services/convert/import-student', [ImportController::class, 'importStudent'])
    ->name('services.convert.import-student');

// ------------------------------
// SUPPORT TICKET
// ------------------------------
Route::get('/support', [TicketSupportController::class, 'index'])
    ->name('support.ticket-index');

Route::get('/support/view/{code}', [TicketSupportController::class, 'view'])
    ->name('support.ticket-view');

Route::post('/support/create/store-reply/{code}', [TicketSupportController::class, 'storeReply'])
    ->name('support.ticket-store-reply');

// ------------------------------
// NOTIFICATION SYSTEM
// ------------------------------
Route::get('/system/notify', [NotifyController::class, 'index'])
    ->name('system.notify-index');

Route::post('/system/notify/store', [NotifyController::class, 'store'])
    ->name('system.notify-store');

Route::patch('/system/notify/{code}/update', [NotifyController::class, 'update'])
    ->name('system.notify-update');

Route::delete('/system/notify/{code}/destroy', [NotifyController::class, 'destroy'])
    ->name('system.notify-destroy');
