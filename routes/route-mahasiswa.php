<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\AuthController;
use App\Http\Controllers\Mahasiswa\HomeController;
use App\Http\Controllers\Mahasiswa\Pages\SupportController;
use App\Http\Controllers\Mahasiswa\Pages\StudentTaskController;

// ==========================
// HAK AKSES: MAHASISWA
// ==========================
Route::group([
    'prefix' => 'mahasiswa',
    'middleware' => ['mhs-access:Mahasiswa Aktif'],
    'as' => 'mahasiswa.'
], function () {

    // ========= AUTH =========
    Route::get('/signout', [AuthController::class, 'AuthSignOutPost'])->name('auth-signout-post');

    // ====== HOME & PROFILE ======
    Route::get('/home', [HomeController::class, 'index'])->name('home-index');
    Route::get('/profile', [HomeController::class, 'profile'])->name('home-profile');

    // ====== TAGIHAN ======
    Route::get('/tagihan', [HomeController::class, 'tagihanIndex'])->name('home-tagihan-index');
    Route::get('/tagihan/{code}/invoice', [HomeController::class, 'tagihanInvoice'])->name('home-tagihan-invoice');
    Route::get('/tagihan/view/{code}', [HomeController::class, 'tagihanView'])->name('home-tagihan-view');
    Route::post('/tagihan/view/{code}/payment', [HomeController::class, 'tagihanPayment'])->name('home-tagihan-payment');
    Route::get('/tagihan/view/{code}/payment/success', [HomeController::class, 'tagihanSuccess'])->name('home-tagihan-payment-success');

    // ====== JADWAL KULIAH ======
    Route::get('/jadwal-kuliah', [HomeController::class, 'jadkulIndex'])->name('home-jadkul-index');
    // Route::get('/jadwal-kuliah/{code}/absen', [HomeController::class, 'jadkulAbsen'])->name('home-jadkul-absen');
    // Route::post('/jadwal-kuliah/store/absen', [HomeController::class, 'jadkulAbsenStore'])->name('home-jadkul-absen-store');
    Route::post('/jadwal-kuliah/store/{code}/feedback', [HomeController::class, 'storeFBPerkuliahan'])->name('jadkul.feedback-store');

    // ====== PROFILE (UPDATE) ======
    Route::patch('/profile/update-image', [HomeController::class, 'saveImageProfile'])->name('home-profile-save-image');
    Route::patch('/profile/update-data', [HomeController::class, 'saveDataProfile'])->name('home-profile-save-data');
    Route::patch('/profile/update-kontak', [HomeController::class, 'saveDataKontak'])->name('home-profile-save-kontak');
    Route::patch('/profile/update-password', [HomeController::class, 'saveDataPassword'])->name('home-profile-save-password');

    // ====== SUPPORT TICKET ======
    Route::get('/support', [SupportController::class, 'index'])->name('support.ticket-index');
    Route::get('/support/open', [SupportController::class, 'open'])->name('support.ticket-open');
    Route::get('/support/view/{code}', [SupportController::class, 'view'])->name('support.ticket-view');
    Route::get('/support/create/{dept}', [SupportController::class, 'create'])->name('support.ticket-create');
    Route::post('/support/create/store', [SupportController::class, 'store'])->name('support.ticket-store');
    Route::post('/support/create/store-reply/{code}', [SupportController::class, 'storeReply'])->name('support.ticket-store-reply');

    // ====== TUGAS KULIAH ======
    Route::get('/tugas-kuliah', [StudentTaskController::class, 'index'])->name('akademik.tugas-index');
    Route::get('/tugas-kuliah/{code}/view', [StudentTaskController::class, 'view'])->name('akademik.tugas-view');
    Route::post('/tugas-kuliah/{code}/store', [StudentTaskController::class, 'store'])->name('akademik.tugas-store');

    // ====== AJAX REQUEST ======
    Route::get('/ajax/getTicketLastReply/{code}', [SupportController::class, 'AjaxLastReply'])->name('ajax.support.ticket-last-reply');
    Route::get('/ajax/getTagihan', [HomeController::class, 'tagihanIndexAjax'])->name('ajax-tagihan-index');
});
