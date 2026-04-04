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
use App\Http\Controllers\KurbanPublicController;
use App\Http\Controllers\Admin\KurbanController;


// PUBLIC PAGES WITH THEIR OWN URLs
Route::get('/',         [HomeController::class, 'index'])->name('home');
Route::get('/proyek',   [HomeController::class, 'page'])->defaults('pageName','projects')->name('page.projects');
Route::get('/produk',   [HomeController::class, 'page'])->defaults('pageName','products')->name('page.products');
Route::get('/galeri',   [HomeController::class, 'page'])->defaults('pageName','gallery')->name('page.gallery');
Route::get('/tentang',  [HomeController::class, 'page'])->defaults('pageName','about')->name('page.about');
Route::get('/artikel',  [HomeController::class, 'page'])->defaults('pageName','articles')->name('page.articles');
Route::get('/lokasi',   [HomeController::class, 'page'])->defaults('pageName','map')->name('page.map');
Route::get('/dukungan', [HomeController::class, 'page'])->defaults('pageName','support')->name('page.support');

// PRODUCT DETAIL
Route::get('/produk/{product}',       [HomeController::class, 'productDetail'])->name('product.detail');
Route::post('/produk/{product}/pesan',[HomeController::class, 'productInquiry'])->name('product.inquiry')->middleware('throttle:10,1');

 // PUBLIC: Halaman Kambing Kurban
Route::get('/kurban',         [KurbanPublicController::class, 'index'])->name('kurban.index');
Route::get('/kurban/{animal}',[KurbanPublicController::class, 'show'])->name('kurban.show');

// ADMIN: Kelola Kambing Kurban (di dalam group middleware auth+admin)
// Tambahkan di dalam Route::middleware(['auth','admin'])->group(...)
// Route::resource('kurban', KurbanController::class)->names([
//     'index'   => 'admin.kurban.index',
//     'create'  => 'admin.kurban.create',
//     'store'   => 'admin.kurban.store',
//     'edit'    => 'admin.kurban.edit',
//     'update'  => 'admin.kurban.update',
//     'destroy' => 'admin.kurban.destroy',
// ]);
// Route::delete('kurban/{kurban}/thumbnail',    [KurbanController::class, 'deleteThumbnail'])->name('admin.kurban.thumbnail.delete');
// Route::post('kurban/{kurban}/media',          [KurbanController::class, 'uploadMedia'])->name('admin.kurban.media.upload');
// Route::delete('kurban/{kurban}/media/{index}',[KurbanController::class, 'deleteMedia'])->name('admin.kurban.media.delete');


// ARTICLE DETAIL
Route::get('/artikel/{article:slug}', [HomeController::class, 'articleDetail'])->name('article.detail');

// CONTACT
Route::post('/kontak', [HomeController::class, 'contact'])->name('contact.send')->middleware('throttle:10,1');

// ADMIN AUTH
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('sliders', SliderController::class);
        Route::delete('sliders/{slider}/media', [SliderController::class, 'deleteMedia'])->name('sliders.media.delete');

        Route::resource('projects', AdminProjectController::class);
        Route::post('projects/{project}/gallery',           [AdminProjectController::class, 'uploadGallery'])->name('projects.gallery.upload');
        Route::delete('projects/{project}/gallery/{index}', [AdminProjectController::class, 'deleteGallery'])->name('projects.gallery.delete');
        Route::delete('projects/{project}/thumbnail',       [AdminProjectController::class, 'deleteThumbnail'])->name('projects.thumbnail.delete');

        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/gallery',           [AdminProductController::class, 'uploadGallery'])->name('products.gallery.upload');
        Route::delete('products/{product}/gallery/{index}', [AdminProductController::class, 'deleteGallery'])->name('products.gallery.delete');
        Route::delete('products/{product}/thumbnail',       [AdminProductController::class, 'deleteThumbnail'])->name('products.thumbnail.delete');

Route::resource('kurban', KurbanController::class)->names([
    'index'   => 'kurban.index',
    'create'  => 'kurban.create',
    'store'   => 'kurban.store',
    'edit'    => 'kurban.edit',
    'update'  => 'kurban.update',
    'destroy' => 'kurban.destroy',
]);
Route::delete('kurban/{kurban}/thumbnail',     [KurbanController::class, 'deleteThumbnail'])->name('kurban.thumbnail.delete');
Route::post('kurban/{kurban}/media',           [KurbanController::class, 'uploadMedia'])->name('kurban.media.upload');
Route::delete('kurban/{kurban}/media/{index}', [KurbanController::class, 'deleteMedia'])->name('kurban.media.delete');

        Route::resource('articles', AdminArticleController::class);
        Route::post('articles/{article}/publish',     [AdminArticleController::class, 'publish'])->name('articles.publish');
        Route::post('articles/{article}/draft',       [AdminArticleController::class, 'draft'])->name('articles.draft');
        Route::delete('articles/{article}/thumbnail', [AdminArticleController::class, 'deleteThumbnail'])->name('articles.thumbnail.delete');

        Route::resource('gallery', GalleryController::class)->only(['index','store','destroy']);

        Route::resource('team', TeamController::class);
        Route::delete('team/{member}/photo', [TeamController::class, 'deletePhoto'])->name('team.photo.delete');

        Route::resource('statistics', StatisticController::class)->only(['index','store','update','destroy']);

        Route::get('settings',        [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings',       [SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/logo',  [SettingController::class, 'uploadLogo'])->name('settings.logo');
        Route::delete('settings/logo', [SettingController::class, 'deleteLogo'])
     ->name('settings.logo.delete');

        Route::get('messages',                      [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}',            [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}',         [MessageController::class, 'destroy'])->name('messages.destroy');
        Route::post('messages/{message}/mark-read', [MessageController::class, 'markRead'])->name('messages.markRead');

        Route::post('translate', [TranslateController::class, 'translate'])->name('translate');
    });
});
