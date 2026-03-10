<?php
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;

View::composer('layouts.admin', function ($view) {
    $unreadMessages = 0;
    if (auth()->check()) {
        $unreadMessages = ContactMessage::where('status', 'unread')->count();
    }
    $view->with('unreadMessages', $unreadMessages);
});
