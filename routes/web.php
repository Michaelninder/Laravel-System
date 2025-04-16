<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RulesController as AdminRulesController;
use App\Http\Controllers\Admin\SupportController as AdminSupportController;

Route::get('/set-locale/{locale}', function ($locale) {
    $langDirs = File::directories(resource_path('lang')); 
    if (in_array($locale, array_map('basename', $langDirs))) {
        session(['locale' => $locale]); 
        app()->setLocale($locale);
    }
    return redirect()->back(); 
});

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('/rules', [PageController::class, 'rules'])->name('pages.rules');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth', [AuthController::class, 'showLogin'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.overview');
})->name('dashboard.overview')->middleware('auth');

Route::fallback(function () {
    return response()->view('errors.show', ['error' => 404], 404);
});
Route::get('/error/{error}', [ErrorController::class, 'show'])->name('errors.custom');

Route::middleware('auth')->group(function () {
    Route::get('/support', [SupportController::class, 'overview'])->name('support.overview');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support/create', [SupportController::class, 'store'])->name('support.store');
	Route::get('/support/{ticket:uuid}', [SupportController::class, 'view'])->name('support.view');
	Route::post('/support/{ticket:uuid}/send', [SupportController::class, 'sendMessage'])->name('support.send');
	Route::post('/support/{ticket:uuid}/status/{status}', [SupportController::class, 'updateStatus'])->name('support.updateStatus');
});


Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/overview', [AdminPageController::class, 'overview'])->name('overview');

    Route::get('/users', [AdminUserController::class, 'listUsers'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'updateUser'])->name('users.update');

    Route::get('/rules', [AdminRulesController::class, 'listRules'])->name('rules.index');
    Route::get('/rules/create', [AdminRulesController::class, 'createRule'])->name('rules.create');
    Route::post('/rules', [AdminRulesController::class, 'storeRule'])->name('rules.store');
    Route::get('/rules/{rule}/edit', [AdminRulesController::class, 'editRule'])->name('rules.edit');
    Route::put('/rules/{rule}', [AdminRulesController::class, 'updateRule'])->name('rules.update');

    Route::get('/support', [AdminSupportController::class, 'index'])->name('support.index');
    Route::get('/support/{ticket}', [AdminSupportController::class, 'view'])->name('support.view');
    Route::post('/support/{ticket}/message', [AdminSupportController::class, 'sendMessage'])->name('support.message.send');
});
