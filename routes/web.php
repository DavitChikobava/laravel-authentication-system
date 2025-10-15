<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPasswordChange;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('register.post');

    Route::get('forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])
        ->middleware(CheckPasswordChange::class)
        ->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('password/change', [AuthController::class, 'changePassword'])->name('password.change');

    Route::get('register/new-user', [AuthController::class, 'newUserRegister'])->name('register.new');
    Route::post('register/new-user', [AuthController::class, 'newUserRegisterPost'])->name('register.new.post');
    
    Route::get('password/force-change', [AuthController::class, 'showForcePasswordChange'])->name('password.force.change');
    Route::post('password/force-change', [AuthController::class, 'forcePasswordChange'])->name('password.force.change.post');
});