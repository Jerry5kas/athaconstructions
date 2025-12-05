<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageSectionController;
use App\Http\Controllers\Admin\PackageFeatureController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TestimonialMediaController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AmenityController;
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

        // Testimonials management
        Route::resource('testimonials', TestimonialController::class)->names('testimonials');
        Route::resource('testimonial-media', TestimonialMediaController::class)->names('testimonial-media');

        // Blogs management
        Route::resource('blogs', BlogController::class)->names('blogs');

        // Blog Categories management
        Route::resource('blog-categories', BlogCategoryController::class)->names('blog-categories');

        // Packages management
        Route::resource('packages', PackageController::class)->names('packages');

        // Package Sections management
        Route::resource('package-sections', PackageSectionController::class)->names('package-sections');
        
        // Package Features management
        Route::post('package-sections/{section}/features', [PackageFeatureController::class, 'storeOrUpdate'])->name('package-features.store-or-update');
        Route::delete('package-features/{feature}', [PackageFeatureController::class, 'destroy'])->name('package-features.destroy');

        // Contact messages (leads)
        Route::resource('contact-messages', ContactController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('contact-messages');

        // Properties management
        Route::resource('properties', PropertyController::class)->names('properties');

        // Amenities management
        Route::resource('amenities', AmenityController::class)->names('amenities');

        // ImageKit upload route
        Route::post('/upload-imagekit', [ImageKitUploadController::class, 'upload'])->name('upload-imagekit');
    });
});

