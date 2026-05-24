<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->prefix('admin')->group(function () {
    Route::get('masuk', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('masuk', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('konfirmasi-sandi', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('konfirmasi-sandi', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('keluar', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
