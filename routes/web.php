<?php

use App\Http\Controllers\SitemapController;
use App\Http\Middleware\EnsureUserIsSuperAdmin;
// Public Livewire pages
use App\Livewire\About;
use App\Livewire\Admin\BlogCategories\Create as BlogCategoryCreate;
use App\Livewire\Admin\BlogCategories\Edit as BlogCategoryEdit;
use App\Livewire\Admin\BlogCategories\Index as BlogCategoryIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EventCategories\Create as EventCategoryCreate;
// Public events
use App\Livewire\Admin\EventCategories\Edit as EventCategoryEdit;
use App\Livewire\Admin\EventCategories\Index as EventCategoryIndex;
use App\Livewire\Admin\Events\Create as EventCreate;
// Public blog
use App\Livewire\Admin\Events\Edit as EventEdit;
use App\Livewire\Admin\Events\Index as EventIndex;
// Admin dashboard & resources
use App\Livewire\Admin\Posts\Create as PostCreate;
use App\Livewire\Admin\Posts\Edit as PostEdit;
use App\Livewire\Admin\Posts\Index as PostIndex;
use App\Livewire\Admin\Users\Create as UserCreate;
use App\Livewire\Admin\Users\Edit as UserEdit;
use App\Livewire\Admin\Users\Index as UserIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Blog\Index as PublicBlogIndex;
use App\Livewire\Blog\Show as PublicBlogShow;
use App\Livewire\Events\Calendar as PublicEventCalendar;
use App\Livewire\Events\Index as PublicEventIndex;
use App\Livewire\Events\Show as PublicEventShow;
use App\Livewire\Help;
use App\Livewire\Home;
use App\Livewire\PrivacyPolicy;
use App\Livewire\TermsOfService;
// Controllers & middleware
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ========== PUBLIC ROUTES ==========

// Static pages
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/help', Help::class)->name('help');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('/terms-of-service', TermsOfService::class)->name('terms-of-service');

// Events (public)
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', PublicEventIndex::class)->name('index');
    Route::get('/calendar', PublicEventCalendar::class)->name('calendar');
    Route::get('/{event:slug}', PublicEventShow::class)->name('show');
});

// Blog (public)
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', PublicBlogIndex::class)->name('index');
    Route::get('/{post:slug}', PublicBlogShow::class)->name('show');
});

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Test Error Pages (for development/testing)
Route::get('/test-403', function () {
    abort(403);
})->name('test.403');

// Auth (public side)
Route::get('/login', Login::class)->name('login');
// Fallback POST for non-JS form submissions
Route::post('/login', [App\Http\Controllers\Auth\FallbackLoginController::class, 'login'])->name('login.post');

// Home V2 - New Modern Design (for testing)
Route::get('/v2', App\Livewire\HomeV2::class)->name('home.v2');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// ========== ADMIN ROUTES ==========

Route::middleware('auth')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', Dashboard::class)->name('dashboard');

        // Test Error Pages (for development/testing - inside admin)
        Route::get('/test-403', function () {
            abort(403);
        })->name('test.403');

        // Hero Section
    Route::get('/hero', App\Livewire\Admin\Hero\Index::class)->name('hero.index');

    // Events
        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', EventIndex::class)->name('index');
            Route::get('/create', EventCreate::class)->name('create');
            Route::get('/{event}/edit', EventEdit::class)->name('edit');
        });

        // Posts
        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/', PostIndex::class)->name('index');
            Route::get('/create', PostCreate::class)->name('create');
            Route::get('/{post}/edit', PostEdit::class)->name('edit');
        });

        // Event Categories
        Route::prefix('event-categories')->name('event-categories.')->group(function () {
            Route::get('/', EventCategoryIndex::class)->name('index');
            Route::get('/create', EventCategoryCreate::class)->name('create');
            Route::get('/{category}/edit', EventCategoryEdit::class)->name('edit');
        });

        // Blog Categories
        Route::prefix('blog-categories')->name('blog-categories.')->group(function () {
            Route::get('/', BlogCategoryIndex::class)->name('index');
            Route::get('/create', BlogCategoryCreate::class)->name('create');
            Route::get('/{category}/edit', BlogCategoryEdit::class)->name('edit');
        });

        // Milestones
        Route::prefix('milestones')->name('milestones.')->group(function () {
            Route::get('/', App\Livewire\Admin\Milestones\Index::class)->name('index');
            Route::get('/create', App\Livewire\Admin\Milestones\Create::class)->name('create');
            Route::get('/{milestone}/edit', App\Livewire\Admin\Milestones\Edit::class)->name('edit');
        });

        // Testimonials
        Route::prefix('testimonials')->name('testimonials.')->group(function () {
            Route::get('/', App\Livewire\Admin\Testimonials\Index::class)->name('index');
            Route::get('/create', App\Livewire\Admin\Testimonials\Create::class)->name('create');
            Route::get('/{testimonial}/edit', App\Livewire\Admin\Testimonials\Edit::class)->name('edit');
        });

        // Users (Super Admin only)
        Route::middleware(EnsureUserIsSuperAdmin::class)->group(function () {
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', UserIndex::class)->name('index');
                Route::get('/create', UserCreate::class)->name('create');
                Route::get('/{user}/edit', UserEdit::class)->name('edit');
            });
        });
    });

// Fallback untuk semua route yang tidak terdaftar
Route::fallback(function () {
    // Kembalikan halaman 403 khusus (bukan exception),
    // supaya tampil juga saat APP_DEBUG=true
    return response()->view('errors.403', [], 403);
});
