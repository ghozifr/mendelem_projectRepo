<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Slider, Project, Product, Article, Gallery, TeamMember, Statistic, ContactMessage};

class HomeController extends Controller
{
    public function index()
    {
        $sliders   = Slider::where('is_active', 1)->orderBy('order')->get();
        $projects  = Project::where('status', 'active')->where('is_featured', 1)->orderBy('order')->limit(6)->get();
        $allProjects = Project::where('status', 'active')->orderBy('order')->get();
        $products  = Product::where('is_active', 1)->where('is_featured', 1)->orderBy('order')->limit(8)->get();
        $allProducts = Product::where('is_active', 1)->orderBy('order')->get();
        $articles  = Article::where('status', 'published')->latest('published_at')->limit(3)->get();
        $statsBar  = Statistic::where('group', 'general')->orderBy('order')->get();
        $gallery   = Gallery::where('is_active', 1)->orderBy('order')->orderBy('id','desc')->limit(12)->get();
        $team      = TeamMember::where('is_active', 1)->orderBy('order')->get();
        $financing = Statistic::where('group', 'financing')->orderBy('order')->get();
        $fundSrc   = Statistic::where('group', 'funding_source')->orderBy('order')->get();

        return view('mendelem_Home', compact(
            'sliders', 'projects', 'allProjects', 'products', 'allProducts',
            'articles', 'statsBar', 'gallery', 'team', 'financing', 'fundSrc'
        ));
    }

    public function contact(Request $r)
    {
        $r->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'purpose' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create([
            'name'    => $r->name,
            'email'   => $r->email,
            'purpose' => $r->purpose,
            'message' => $r->message,
            'status'  => 'unread',
        ]);

        return back()->with('contact_success', true);
    }
}
