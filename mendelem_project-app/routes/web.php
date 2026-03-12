<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TranslateController;

// ── PUBLIC ────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.send');

// ── ADMIN AUTH ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login',  [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Sliders
        Route::resource('sliders', SliderController::class);

        // Projects
        Route::resource('projects', AdminProjectController::class);
        Route::post('projects/{project}/gallery',          [AdminProjectController::class, 'uploadGallery'])->name('projects.gallery.upload');
        Route::delete('projects/{project}/gallery/{index}',[AdminProjectController::class, 'deleteGallery'])->name('projects.gallery.delete');

        // Products
        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/gallery', [AdminProductController::class, 'uploadGallery'])->name('products.gallery.upload');

        // Articles
        Route::resource('articles', AdminArticleController::class);
        Route::post('articles/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish');
        Route::post('articles/{article}/draft',   [AdminArticleController::class, 'draft'])->name('articles.draft');

        // Gallery
        Route::resource('gallery', GalleryController::class)->only(['index','store','destroy']);

        // Team
        Route::resource('team', TeamController::class);

        // Statistics
        Route::resource('statistics', StatisticController::class)->only(['index','store','update','destroy']);

        // Settings
        Route::get('settings',        [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings',       [SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/logo',  [SettingController::class, 'uploadLogo'])->name('settings.logo');

        // Messages
        Route::get('messages',                  [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}',        [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}',     [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::post('messages/{message}/mark-read', [MessageController::class, 'markRead'])->name('messages.markRead');

        // Translate
        Route::post('translate', [TranslateController::class, 'translate'])->name('translate');
    });
});
