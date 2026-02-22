<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompareOfferController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SavedOfferController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/offer-details', [LandingPageController::class, 'offerDetails'])->name('offer-details');

// Guest-only routes (redirect to saved-offers if already logged in)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/saved-offers', [SavedOfferController::class, 'index'])->name('saved-offers');
    Route::post('/offer-details', [\App\Http\Controllers\OfferEvaluationController::class, 'evaluate'])->name('offer.evaluate');
    Route::get('/compare-offers', [CompareOfferController::class, 'index'])->name('compare-offers');
    Route::get('/comparison/{offer?}', [ComparisonController::class, 'index'])->name('comparison');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
    Route::put('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
});
