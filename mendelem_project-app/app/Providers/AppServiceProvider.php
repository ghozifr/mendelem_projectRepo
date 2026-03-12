<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share unread message count to all admin views
        View::composer('layouts.admin', function ($view) {
            $unreadMessages = 0;
            if (auth()->check()) {
                try {
                    $unreadMessages = \App\Models\ContactMessage::where('status', 'unread')->count();
                } catch (\Exception $e) {
                    $unreadMessages = 0;
                }
            }
            $view->with('unreadMessages', $unreadMessages);
        });
    }
}
