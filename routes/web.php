<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\AuthController;

// Web Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/shorten', [HomeController::class, 'shorten'])->name('shorten');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth Routes
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// Protected Routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
	Route::get('/links', [LinkController::class, 'index'])->name('links');
	Route::get('/links/{id}/analytics', [LinkController::class, 'analytics'])->name('link.analytics');
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
