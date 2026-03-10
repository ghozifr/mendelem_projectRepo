<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Slider, Project, Product, Article, Gallery, TeamMember, Statistic, SiteSetting, ContactMessage};

class HomeController extends Controller
{
    public function index()
    {
        $sliders  = Slider::active()->get();
        $projects = Project::active()->featured()->limit(6)->get();
        $products = Product::active()->where('is_featured',true)->limit(4)->get();
        $articles = Article::published()->limit(3)->get();
        $statsBar = Statistic::getByGroup('general');

        return view('mendelem_Home', compact('sliders','projects','products','articles','statsBar'));
    }

    public function gallery()
    {
        $items = Gallery::where('is_active',true)->orderBy('order')->paginate(20);
        return view('gallery', compact('items'));
    }

    public function about()
    {
        $team      = TeamMember::where('is_active',true)->orderBy('order')->get();
        $financing = Statistic::getByGroup('financing');
        $fundSrc   = Statistic::getByGroup('funding_source');
        return view('about', compact('team','financing','fundSrc'));
    }

    public function map()    { return view('map'); }
    public function support(){ return view('support'); }
}
