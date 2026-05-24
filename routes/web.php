<?php

use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\HomepageAboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public routes
Route::get('/', function () {
    $sliders = \App\Models\HeroSlider::where('is_active', true)
        ->orderBy('order')
        ->get();

    $about = \App\Models\HomepageAbout::first();

    return Inertia::render('Home', [
        'sliders' => $sliders,
        'about'   => $about,
    ]);
})->name('home');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company Profile Management
    Route::resource('sliders', HeroSliderController::class)
        ->names('admin.sliders')
        ->except(['show']);

    // Homepage sections
    Route::get('homepage/tentang', [HomepageAboutController::class, 'edit'])->name('admin.homepage.tentang');
    Route::put('homepage/tentang', [HomepageAboutController::class, 'update'])->name('admin.homepage.tentang.update');
});

require __DIR__.'/auth.php';
