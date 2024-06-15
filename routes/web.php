<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturedItemsController;
use App\Http\Controllers\LatestVideoController;
use App\Http\Controllers\LatestGalleryController;
use App\Http\Controllers\LatestNewsController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/', function () {
    return view('home.home');
});



Route::get('/gallery/{gallery}', function () {
    return view('single-blogs.single-gallery');
});


Route::get('/videos/{videos}', function () {
    return view('single-blogs.single-video');
});

Route::get('/news/{news}', function () {
    return view('single-blogs.single-news');
});


Route::get('/featured', [FeaturedItemsController::class, 'index'])->name('featured.index');
Route::get('/featured/{id}', [FeaturedItemsController::class, 'show'])->name('featured.show');
Route::get('/videos/{id}', [LatestVideoController::class, 'show'])->name('videos.show');
Route::get('/gallery/{id}', [LatestGalleryController::class, 'show'])->name('gallery.show');
Route::get('/news/{id}', [LatestNewsController::class, 'show'])->name('news.show');
