<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::with('author')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create() { return view('admin.articles.form', ['article'=>null]); }

    public function store(\Illuminate\Http\Request $r)
    {
        $data = $r->validate([
            'title_id'    => 'required|string|max:255',
            'title_en'    => 'nullable|string|max:255',
            'excerpt_id'  => 'nullable|string',
            'excerpt_en'  => 'nullable|string',
            'content_id'  => 'nullable|string',
            'content_en'  => 'nullable|string',
            'category_id' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status'      => 'required|in:draft,published,archived',
        ]);

        $data['slug']      = \Illuminate\Support\Str::slug($r->title_id) . '-' . time();
        $data['author_id'] = auth()->id();
        if ($r->status === 'published') $data['published_at'] = now();

        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('articles', 'public');
        }

        \App\Models\Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(\App\Models\Article $article) { return view('admin.articles.form', compact('article')); }

    public function update(\Illuminate\Http\Request $r, \App\Models\Article $article)
    {
        $data = $r->validate([
            'title_id'    => 'required|string|max:255',
            'title_en'    => 'nullable|string|max:255',
            'excerpt_id'  => 'nullable|string',
            'excerpt_en'  => 'nullable|string',
            'content_id'  => 'nullable|string',
            'content_en'  => 'nullable|string',
            'category_id' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status'      => 'required|in:draft,published,archived',
        ]);

        if ($r->hasFile('thumbnail')) {
            if ($article->thumbnail) \Storage::disk('public')->delete($article->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('articles', 'public');
        }
        if ($r->status === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(\App\Models\Article $article)
    {
        if ($article->thumbnail) \Storage::disk('public')->delete($article->thumbnail);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel dihapus.');
    }

    public function publish(\App\Models\Article $article)
    {
        $article->update(['status'=>'published','published_at'=>now()]);
        return back()->with('success', 'Artikel dipublikasikan!');
    }

    public function draft(\App\Models\Article $article)
    {
        $article->update(['status'=>'draft']);
        return back()->with('success', 'Artikel dijadikan draft.');
    }
}
