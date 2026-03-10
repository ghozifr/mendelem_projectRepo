<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles'    => Article::count(),
            'products'    => Product::count(),
            'projects'    => Project::count(),
            'gallery'     => Gallery::count(),
            'unread_msgs' => ContactMessage::where('status','unread')->count(),
            'published'   => Article::where('status','published')->count(),
            'sliders'     => Slider::count(),
            'team'        => TeamMember::count(),
        ];
        $recentArticles  = Article::with('author')->latest()->limit(5)->get();
        $recentMessages  = ContactMessage::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats','recentArticles','recentMessages'));
    }
}
