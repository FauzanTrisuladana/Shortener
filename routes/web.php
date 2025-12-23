<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/links', [LinkController::class, 'index'])->name('links');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
