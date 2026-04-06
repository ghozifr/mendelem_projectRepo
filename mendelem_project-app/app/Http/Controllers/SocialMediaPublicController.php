<?php
namespace App\Http\Controllers;

use App\Models\SocialMedia;

class SocialMediaPublicController extends Controller
{
    public function show(SocialMedia $sosmed)
    {
        if (!$sosmed->is_active) abort(404);

        // Shared data (sama seperti HomeController)
        $sharedData = [
            'sliders'     => \App\Models\Slider::where('is_active',1)->orderBy('order')->get(),
            'projects'    => \App\Models\Project::where('status','active')->where('is_featured',1)->orderBy('order')->limit(6)->get(),
            'allProjects' => \App\Models\Project::where('status','active')->orderBy('order')->get(),
            'products'    => \App\Models\Product::where('is_active',1)->where('is_featured',1)->orderBy('order')->limit(8)->get(),
            'allProducts' => \App\Models\Product::where('is_active',1)->orderBy('order')->get(),
            'articles'    => \App\Models\Article::where('status','published')->latest('published_at')->limit(3)->get(),
            'allArticles' => \App\Models\Article::where('status','published')->latest('published_at')->get(),
            'statsBar'    => \App\Models\Statistic::where('group','general')->orderBy('order')->get(),
            'gallery'     => \App\Models\Gallery::where('is_active',1)->orderBy('order')->orderBy('id','desc')->limit(24)->get(),
            'team'        => \App\Models\TeamMember::where('is_active',1)->orderBy('order')->get(),
            'financing'   => \App\Models\Statistic::where('group','financing')->orderBy('order')->get(),
            'fundSrc'     => \App\Models\Statistic::where('group','funding_source')->orderBy('order')->get(),
            'socialMedia' => SocialMedia::active()->get(),
            'activeProduct' => null,
            'activeArticle' => null,
        ];

        return view('mendelem_Home', array_merge($sharedData, [
            'activePage'   => 'sosmed-detail',
            'activeSosmed' => $sosmed,
        ]));
    }
}
