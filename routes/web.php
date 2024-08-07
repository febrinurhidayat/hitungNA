<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiController;



// Auth Routes
Auth::routes(['verify' => true]);

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

// Home Route
Route::get('/home', [AuthController::class, 'home'])->name('home')->middleware(['auth', 'verified']);
Route::get('/settings', [AuthController::class, 'showSettingsForm'])->name('settings');
Route::post('/settings', [AuthController::class, 'updateSettings'])->name('update-settings');

// Nilai Routes
Route::middleware('auth')->group(function () {
    // Hitung NA
    Route::get('/hitung_na', [NilaiController::class, 'showHitungNaForm'])->name('hitung_na');
    Route::post('/hitung_na', [NilaiController::class, 'hitungNa'])->name('hitung_na.submit');

    // Search
    Route::get('/search', [NilaiController::class, 'search'])->name('search');

    // Result
    Route::get('/result', [NilaiController::class, 'showResult'])->name('result');

    // Edit Data
    Route::get('nilai/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');

    // Delete Data
    Route::delete('/hapus/{nilai_id}', [NilaiController::class, 'hapus'])->name('hapus');

    //delete akun
    Route::get('/delete-account', [AuthController::class, 'showDeleteAccountForm'])->name('delete-account-form');
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount'])->name('delete-account');
});
