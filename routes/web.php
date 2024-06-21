<?php

use App\Http\Controllers\ShowGalleryItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturedItemsController;
use App\Http\Controllers\ShowNewsItemController;
use App\Http\Controllers\ShowVideosItemController;
use App\Models\LatestGallery;
use App\Models\LatestNews;
use App\Models\LatestVideos;

// AuthSanctum
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// home route
Route::get('/', function () {
    return view('home.home');
});

//show single-items livewire routes
Route::get('/gallery-item/{id}', function () {
    return view('show-gallery-item', ['gallery' => LatestGallery::latest()->take(1)->get()]);
});

Route::get('/news-item/{id}', function () {
    return view('show-news-item', ['news' => LatestNews::latest()->take(1)->get()]);
});

Route::get('/video-item/{id}', function () {
    return view('show-videos-item', ['videos' => LatestVideos::latest()->take(1)->get()]);
});

// toggle single-items feature or unfeatured livewire routes
Route::get('/gallery/{id}', function () {
    return view('single-blogs.single-gallery-toggle', ['gallery' => LatestGallery::latest()->take(1)->get()]);
});

Route::get('/news/{id}', function () {
    return view('single-blogs.single-news-toggle', ['news' => LatestNews::latest()->take(1)->get()]);
});

Route::get('/videos/{id}', function () {
    return view('single-blogs.single-videos-toggle', ['videos' => LatestVideos::latest()->take(1)->get()]);
});

// Route::get('/navbar-selector', function () {
//     return view('home.navbar-selector');
// });

// logic player routes
Route::get('/featured', [FeaturedItemsController::class, 'index'])->name('featured.index');
Route::get('/featured/{id}', [FeaturedItemsController::class, 'show'])->name('featured.show');
Route::get('/videos/{id}', [ShowVideosItemController::class, 'show'])->name('videos.show');
Route::get('/gallery/{id}', [ShowGalleryItemController::class, 'show'])->name('gallery.show');
Route::get('/news/{id}', [ShowNewsItemController::class, 'show'])->name('news.show');
