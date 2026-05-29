<?php

use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\HomepageAboutController;
use App\Http\Controllers\Admin\ContactPageController as AdminContactPageController;
use App\Http\Controllers\Admin\InquirySettingController;
use App\Http\Controllers\Admin\NavItemController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Public\ContactPageController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public routes
Route::get('/', function () {
    $sliders = \App\Models\HeroSlider::where('is_active', true)
        ->orderBy('order')
        ->get();

    $about = \App\Models\HomepageAbout::first();

    $news = \App\Models\News::where('is_published', true)
        ->orderByDesc('published_at')
        ->limit(3)
        ->get()
        ->map(fn ($n) => [
            'slug'     => $n->slug,
            'category' => $n->category,
            'date'     => $n->formatted_date,
            'title'    => $n->title,
            'excerpt'  => $n->excerpt,
            'image'    => $n->image ? '/storage/' . $n->image : null,
        ]);

    return Inertia::render('Home', [
        'sliders' => $sliders,
        'about'   => $about,
        'news'    => $news,
    ]);
})->name('home');

Route::get('/kontak', [ContactPageController::class, 'show'])->name('contact.show');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// Static page preview (dummy data)
Route::get('/preview-halaman-statis', function () {
    return Inertia::render('Page/Show');
})->name('page.preview');

// Dynamic static pages
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('page.show');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard', [
            'stats' => [
                'pages'   => \App\Models\Page::where('is_published', true)->count(),
                'news'    => \App\Models\News::where('is_published', true)->count(),
                'sliders' => \App\Models\HeroSlider::count(),
                'navItems'=> \App\Models\NavItem::where('is_active', true)->count(),
            ],
        ]);
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

    // News CRUD
    Route::resource('news', AdminNewsController::class)
        ->names('admin.news')
        ->except(['show']);

    // Pages CRUD
    Route::resource('pages', AdminPageController::class)
        ->names('admin.pages')
        ->except(['show']);

    // Contact page (singleton)
    Route::get('contact', [AdminContactPageController::class, 'edit'])->name('admin.contact.edit');
    Route::put('contact', [AdminContactPageController::class, 'update'])->name('admin.contact.update');

    // Site settings
    Route::get('settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');

    // Inquiry section settings
    Route::get('inquiry', [InquirySettingController::class, 'edit'])->name('admin.inquiry.edit');
    Route::put('inquiry', [InquirySettingController::class, 'update'])->name('admin.inquiry.update');

    // Navigation editor (hidden — not in sidebar)
    Route::get('navigation', [NavItemController::class, 'index'])->name('admin.navigation.index');
    Route::post('navigation', [NavItemController::class, 'store'])->name('admin.navigation.store');
    Route::put('navigation/{navItem}', [NavItemController::class, 'update'])->name('admin.navigation.update');
    Route::delete('navigation/{navItem}', [NavItemController::class, 'destroy'])->name('admin.navigation.destroy');
    Route::post('navigation/{navItem}/move', [NavItemController::class, 'move'])->name('admin.navigation.move');
});

require __DIR__.'/auth.php';
