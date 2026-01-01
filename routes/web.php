<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AuthController;

/**
 * Web Routes
 *
 * Route:
 * - Home Page: GET /
 * - Shorten Link: POST /shorten
 * - Login Page: GET /login
 * - Register Page: GET /register
 * - Login Submit: POST /login
 * - Register Submit: POST /register
 * - Logout: POST /logout
 */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/shorten', [HomeController::class, 'shorten'])->name('shorten');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/** 
 * Google OAuth Routes
 *
 * Route:
 * - Redirect to Google: GET /auth/google
 * - Google Callback: GET /auth/google/callback
 */
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// Protected Routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    /**
     * Dashboard Routes
     *
     * Route:
     * - Dashboard Home: GET /dashboard
     * - Analytics Overview: GET /dashboard/analytics
     */
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    /**
     * Link Management Routes
     *
     * Route:
     * - List Links: GET /dashboard/links
     * - Create Link: GET /dashboard/links/create
     * - Store Link: POST /dashboard/links/store
     * - Edit Link: GET /dashboard/links/{id}/edit
     * - Update Link: POST /dashboard/links/{id}/update
     * - Delete Link: POST /dashboard/links/{id}/delete
     */
    Route::prefix('links')->group(function () {
        Route::get('/', [LinkController::class, 'index'])->name('links');
	    Route::get('/{id}/analytics', [LinkController::class, 'analytics'])->name('link.analytics');
        Route::get('/create', [LinkController::class, 'create'])->name('links.create');
        Route::post('/store', [LinkController::class, 'store'])->name('links.store');
        Route::get('/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
        Route::post('/{id}/update', [LinkController::class, 'update'])->name('links.update');
        Route::post('/{id}/delete', [LinkController::class, 'destroy'])->name('links.destroy');
    });

    /**
     * Profile Routes
     *
     * Route:
     * - View Profile: GET /dashboard/profile
     */
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// Redirect short links
Route::get('/{new_link}', [LinkController::class, 'redirect'])->name('redirect');
