<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Root\ErrorController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Dosen\AuthController as DosenAuthController;
use App\Http\Controllers\Mahasiswa\AuthController as MahasiswaAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ERROR PAGES
Route::prefix('error')->name('error.')->group(function() {
    Route::get('/verify', [ErrorController::class, 'ErrorVerify'])->name('verify');
    Route::get('/access', [ErrorController::class, 'ErrorAccess'])->name('access');
    Route::get('/notfound', [ErrorController::class, 'ErrorNotFound'])->name('notfound');
});

// DEVELOPMENT ROUTE
Route::get('/dev', function () {
    return view('base.base-root-index');
});

// ROOT ROUTE
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/attendance/{kelasId}', [DashboardController::class, 'getAttendanceAjax']);

// AUTHENTICATION ROUTES
Route::middleware(['guest'])->group(function () {
    // MAHASISWA AUTH
    Route::prefix('mahasiswa')->name('mahasiswa.auth-')->group(function() {
        Route::get('auth-signin', [MahasiswaAuthController::class, 'AuthSignInPage'])->name('signin-page');
        Route::post('auth-signin/post', [MahasiswaAuthController::class, 'AuthSignInPost'])->name('signin-post');
        Route::get('auth-forgot', [MahasiswaAuthController::class, 'AuthForgotPage'])->name('forgot-page');
        Route::post('auth-forgot/verify', [MahasiswaAuthController::class, 'AuthForgotVerify'])->name('forgot-verify');
        Route::get('auth-reset/{token}', [MahasiswaAuthController::class, 'AuthResetPage'])->name('reset-page');
        Route::post('auth-reset/{token}/save', [MahasiswaAuthController::class, 'AuthResetPassword'])->name('reset-post');
    });

    // ADMIN AUTH
    Route::prefix('admin')->name('admin.auth-')->group(function() {
        Route::get('auth-signin', [AdminAuthController::class, 'AuthSignInPage'])->name('signin-page');
        Route::post('auth-signin/post', [AdminAuthController::class, 'AuthSignInPost'])->name('signin-post');
        Route::get('auth-forgot', [AdminAuthController::class, 'AuthForgotPage'])->name('forgot-page');
        Route::post('auth-forgot/verify', [AdminAuthController::class, 'AuthForgotVerify'])->name('forgot-verify');
        Route::get('auth-reset/{token}', [AdminAuthController::class, 'AuthResetPage'])->name('reset-page');
        Route::post('auth-reset/{token}/save', [AdminAuthController::class, 'AuthResetPassword'])->name('reset-post');
    });

    // DOSEN AUTH
    Route::prefix('dosen')->name('dosen.auth-')->group(function() {
        Route::get('auth-signin', [DosenAuthController::class, 'AuthSignInPage'])->name('signin-page');
        Route::post('auth-signin/post', [DosenAuthController::class, 'AuthSignInPost'])->name('signin-post');
        Route::get('auth-forgot', [DosenAuthController::class, 'AuthForgotPage'])->name('forgot-page');
        Route::post('auth-forgot/verify', [DosenAuthController::class, 'AuthForgotVerify'])->name('forgot-verify');
        Route::get('auth-reset/{token}', [DosenAuthController::class, 'AuthResetPage'])->name('reset-page');
        Route::post('auth-reset/{token}/save', [DosenAuthController::class, 'AuthResetPassword'])->name('reset-post');
    });
});

// MODULAR ROUTE FILES
$routeFiles = [
    'web-admin' => 'route-web-admin.php',
    'musyrif' => 'route-musyrif.php',
    'akademik' => 'route-akademik.php',
    'finance' => 'route-finance.php',
    'absen' => 'route-absen.php',
    'support' => 'route-support.php',
    'sitemanager' => 'route-sitemanager.php',
    'dosen' => 'route-dosen.php',
    'mahasiswa' => 'route-mahasiswa.php',
    'root' => 'root.php'
];

foreach ($routeFiles as $file) {
    require __DIR__.'/'.$file;
}

