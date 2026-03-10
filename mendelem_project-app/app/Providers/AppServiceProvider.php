<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;        // ← tambah ini
use App\Models\ContactMessage;              // ← tambah ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ← tambah kode ini di dalam boot()
        View::composer('layouts.admin', function ($view) {
            $unreadMessages = 0;
            if (auth()->check()) {
                $unreadMessages = ContactMessage::where('status', 'unread')->count();
            }
            $view->with('unreadMessages', $unreadMessages);
        });
    }
}
// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         //
//     }
// }
