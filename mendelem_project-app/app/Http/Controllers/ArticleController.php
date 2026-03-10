<?php
class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::published()->paginate(9);
        return view('articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = \App\Models\Article::where('slug',$slug)->where('status','published')->firstOrFail();
        $article->increment('views');
        $related = \App\Models\Article::published()->where('id','!=',$article->id)->limit(3)->get();
        return view('articles.show', compact('article','related'));
    }
}
