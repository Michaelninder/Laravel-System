<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Admin\PageController as AdminPageController;


Route::get('/set-locale/{locale}', function ($locale) {
    $langDirs = File::directories(resource_path('lang')); 

    if (in_array($locale, array_map('basename', $langDirs))) {
        session(['locale' => $locale]); 
        app()->setLocale($locale);
    }

    return redirect()->back(); 
});

Route::get('/', function () { return view('pages.home'); })->name('pages.home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/auth', [AuthController::class, 'showLogin'])->name('login');

Route::get('/dashboard', function () { return view('dashboard.overview'); })->name('dashboard.overview')->middleware('auth');

Route::fallback(function () { return response()->view('errors.show', ['error' => 404], 404); });

Route::get('/error/{error}', [ErrorController::class, 'show'])->name('errors.custom');
	
Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/overview', [AdminPageController::class, 'overview'])->name('overview');
});
