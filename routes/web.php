<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Page
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Packages Page
Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
Route::get('/packages/{slug}', [HomeController::class, 'packageDetail'])->name('packages.show');

// Properties Page
Route::get('/properties', [HomeController::class, 'properties'])->name('properties');
Route::get('/properties/{slug}', [HomeController::class, 'propertyDetail'])->name('properties.show');

// Careers Page
Route::get('/careers', [HomeController::class, 'careers'])->name('careers');

// Blogs Page
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');

// Blog Detail Page
Route::get('/blog/{slug}', [HomeController::class, 'blogDetail'])->name('blog.detail');

// Gallery Page
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

// Services Page
Route::get('/services', [HomeController::class, 'services'])->name('services');

// Cost Estimation Page
Route::get('/cost-estimation', [HomeController::class, 'costEstimation'])->name('cost-estimation');

// Contact Page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Contact Form Submission
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Careers Form Submission
Route::post('/careers', [HomeController::class, 'submitCareer'])->name('careers.submit');
