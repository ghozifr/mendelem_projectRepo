<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KurbanAnimal;

/**
 * KurbanPublicController
 * Mengelola halaman publik Kambing Kurban.
 * 
 * CATATAN: Method ini bisa juga ditambahkan langsung ke HomeController.php
 * agar tetap satu controller. Disediakan terpisah agar lebih mudah di-merge.
 */
class KurbanPublicController extends Controller
{
    // Halaman daftar semua kambing kurban: /kurban
    public function index()
    {
        $animals = KurbanAnimal::active()
            ->orderBy('status') // tersedia duluan
            ->orderBy('order')
            ->get();

        // Pisahkan berdasarkan jenis_hewan untuk tab filter
        $totalKambing = $animals->where('jenis_hewan', 'kambing')->count();
        $totalDomba   = $animals->where('jenis_hewan', 'domba')->count();

        return $this->renderPage('kurban', compact('animals', 'totalKambing', 'totalDomba'));
    }

    // Halaman detail satu hewan: /kurban/{id}
    public function show(KurbanAnimal $animal)
    {
        if (!$animal->is_active) abort(404);

        // Hewan lain yang serupa (jenis sama, tersedia)
        $related = KurbanAnimal::active()
            ->where('id', '!=', $animal->id)
            ->where('jenis_hewan', $animal->jenis_hewan)
            ->where('status', 'tersedia')
            ->limit(4)
            ->get();

        return $this->renderPage('kurban-detail', compact('animal', 'related'));
    }

    // Helper: render ke mendelem_Home.blade.php dengan shared data
    private function renderPage(string $page, array $extra = [])
    {
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
            'activeProduct'  => null,
            'activeArticle'  => null,
        ];

        return view('mendelem_Home', array_merge($sharedData, ['activePage' => $page], $extra));
    }
}
