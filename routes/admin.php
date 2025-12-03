<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\ImageKitUploadController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here are the admin routes for the application.
|
*/

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (accessible without authentication)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Hero Section (Home) management
        Route::resource('hero-sections', HeroSectionController::class)->names('hero-sections');

        // Categories management
        Route::resource('categories', CategoryController::class)->names('categories');

        // Services management
        Route::resource('services', ServiceController::class)->names('services');

        // Blogs management
        Route::resource('blogs', BlogController::class)->names('blogs');

        // Blog Categories management
        Route::resource('blog-categories', BlogCategoryController::class)->names('blog-categories');

        // ImageKit upload route
        Route::post('/upload-imagekit', [ImageKitUploadController::class, 'upload'])->name('upload-imagekit');
    });
});

