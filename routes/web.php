<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\WriterAuthController;
use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\UserCrudController;
use App\Http\Controllers\WriterCrudController;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('login');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('crud', AdminCrudController::class, [
            'parameters' => ['crud' => 'admin'],
            'names' => [
                'index' => 'admin.crud.index',
                'create' => 'admin.crud.create',
                'store' => 'admin.crud.store',
                'show' => 'admin.crud.show',
                'edit' => 'admin.crud.edit',
                'update' => 'admin.crud.update',
                'destroy' => 'admin.crud.destroy'
            ]
        ]);
    });
});

// User Routes
Route::prefix('user')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

    Route::middleware('auth:user,admin')->group(function () {
        Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
        Route::resource('crud', UserCrudController::class, [
            'parameters' => ['crud' => 'user'],
            'names' => [
                'index' => 'user.crud.index',
                'create' => 'user.crud.create',
                'store' => 'user.crud.store',
                'show' => 'user.crud.show',
                'edit' => 'user.crud.edit',
                'update' => 'user.crud.update',
                'destroy' => 'user.crud.destroy'
            ]
        ]);
    });
});

// Writer Routes
Route::prefix('writer')->group(function () {
    Route::get('/login', [WriterAuthController::class, 'showLoginForm'])->name('writer.login');
    Route::post('/login', [WriterAuthController::class, 'login']);
    Route::get('/register', [WriterAuthController::class, 'showRegisterForm'])->name('writer.register');
    Route::post('/register', [WriterAuthController::class, 'register']);
    Route::post('/logout', [WriterAuthController::class, 'logout'])->name('writer.logout');

    Route::middleware('auth:writer,admin')->group(function () {
        Route::get('/dashboard', [WriterAuthController::class, 'dashboard'])->name('writer.dashboard');
        Route::resource('crud', WriterCrudController::class, [
            'parameters' => ['crud' => 'writer'],
            'names' => [
                'index' => 'writer.crud.index',
                'create' => 'writer.crud.create',
                'store' => 'writer.crud.store',
                'show' => 'writer.crud.show',
                'edit' => 'writer.crud.edit',
                'update' => 'writer.crud.update',
                'destroy' => 'writer.crud.destroy'
            ]
        ]);
    });
});
