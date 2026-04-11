<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Slider, Project, Product, Article, Gallery, TeamMember, Statistic, ContactMessage};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class HomeController extends Controller
{
    /* ─── SHARED DATA ────────────────────────────────────── */
    private function sharedData(): array
    {
        return [
            'sliders'     => Slider::where('is_active',1)->orderBy('order')->get(),
            'projects'    => Project::where('status','active')->where('is_featured',1)->orderBy('order')->limit(6)->get(),
            'allProjects' => Project::where('status','active')->orderBy('order')->get(),
            'products'    => Product::where('is_active',1)->where('is_featured',1)->orderBy('order')->limit(8)->get(),
            'allProducts' => Product::where('is_active',1)->orderBy('order')->get(),
            'articles'    => Article::where('status','published')->latest('published_at')->limit(3)->get(),
            'allArticles' => Article::where('status','published')->latest('published_at')->get(),
            'statsBar'    => Statistic::where('group','general')->orderBy('order')->get(),
            'gallery'     => Gallery::where('is_active',1)->orderBy('order')->orderBy('id','desc')->limit(24)->get(),
            'team'        => TeamMember::where('is_active',1)->orderBy('order')->get(),
            'financing'   => Statistic::where('group','financing')->orderBy('order')->get(),
            'fundSrc'     => Statistic::where('group','funding_source')->orderBy('order')->get(),
            'allKurban' => \App\Models\KurbanAnimal::active()->tersedia()->limit(4)->get(),
            'socialMedia' => \App\Models\SocialMedia::active()->get(),
        ];
    }

    /* ─── HOME ───────────────────────────────────────────── */
    public function index()
    {
        return view('mendelem_Home', array_merge($this->sharedData(), [
            'activePage'    => 'home',
            'activeProduct' => null,
            'activeArticle' => null,
        ]));
    }

    /* ─── PAGES WITH URL (Point 1) ──────────────────────── */
    public function page(Request $request, string $pageName = 'home')
    {
        $allowed = ['home','projects','products','gallery','articles','about','map','support'];
        if (!in_array($pageName, $allowed)) abort(404);

        return view('mendelem_Home', array_merge($this->sharedData(), [
            'activePage'    => $pageName,
            'activeProduct' => null,
            'activeArticle' => null,
        ]));
    }

        /* ─── PROJECT DETAIL (Point 1) ──────────────────────── */
    public function projectDetail(Project $project)
{
    if ($project->status !== 'active') abort(404);

    // Proyek lain selain yang sedang dibuka
    $otherProjects = Project::where('status', 'active')
        ->where('id', '!=', $project->id)
        ->orderBy('order')
        ->limit(3)
        ->get();

    return view('mendelem_Home', array_merge($this->sharedData(), [
        'activePage'    => 'project-detail',
        'activeProject' => $project,
        'otherProjects' => $otherProjects,
        'activeProduct' => null,
        'activeArticle' => null,
    ]));
}

    /* ─── PRODUCT DETAIL (Point 2) ──────────────────────── */
    public function productDetail(Product $product)
    {
        if (!$product->is_active) abort(404);

        $related = Product::where('is_active',1)
            ->where('id','!=',$product->id)
            ->where('category_id',$product->category_id)
            ->limit(4)->get();

        if ($related->count() < 4) {
            $moreIds = $related->pluck('id')->push($product->id);
            $extra = Product::where('is_active',1)
                ->whereNotIn('id', $moreIds)
                ->limit(4 - $related->count())->get();
            $related = $related->merge($extra);
        }

        return view('mendelem_Home', array_merge($this->sharedData(), [
            'activePage'     => 'product-detail',
            'activeProduct'  => $product,
            'relatedProducts'=> $related,
            'activeArticle'  => null,
        ]));
    }

    /* ─── ARTICLE DETAIL ────────────────────────────────── */
    public function articleDetail(Article $article)
    {
        if ($article->status !== 'published') abort(404);
        $article->increment('views');

        return view('mendelem_Home', array_merge($this->sharedData(), [
            'activePage'    => 'article-detail',
            'activeProduct' => null,
            'activeArticle' => $article,
        ]));
    }

    /* ─── CONTACT (Point 6) ─────────────────────────────── */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100|regex:/^[\pL\s\-\.]+$/u',
            'email'   => 'required|email:rfc,dns|max:150',
            'phone'   => 'nullable|string|max:20|regex:/^[\d\+\-\(\)\s]+$/',
            'purpose' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'purpose' => $validated['purpose'] ?? 'Kontak Umum',
            'message' => $validated['message'],
            'status'  => 'unread',
        ]);

        $this->sendNotification($validated);

        $redirectPage = in_array($request->redirect_page,
            ['home','proyek','produk','galeri','tentang','artikel','lokasi','dukungan'])
            ? $request->redirect_page : 'lokasi';

        return redirect('/' . $redirectPage)->with('contact_success', true);
    }

    /* ─── PRODUCT INQUIRY (Point 2) ─────────────────────── */
    public function productInquiry(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email:rfc|max:150',
            'phone'    => 'nullable|string|max:20',
            'quantity' => 'nullable|string|max:50',
            'message'  => 'required|string|min:5|max:1000',
        ]);

        $msgBody = "Produk   : {$product->name_id}\n"
                 . "Jumlah   : " . ($validated['quantity'] ?? '-') . "\n\n"
                 . $validated['message'];

        ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'purpose' => 'Pemesanan: ' . $product->name_id,
            'message' => $msgBody,
            'status'  => 'unread',
        ]);

        $this->sendNotification(array_merge($validated, [
            'purpose' => 'Pemesanan Produk: ' . $product->name_id,
            'message' => $msgBody,
        ]));

        return back()->with('inquiry_success', true);
    }

    /* ─── EMAIL HELPER ───────────────────────────────────── */
    private function sendNotification(array $data): void
    {
        try {
            $to      = config('mail.mendelem_to', env('MAIL_TO', 'mendelemproject@gmail.com'));
            $subject = '[Mendelem] ' . ($data['purpose'] ?? 'Pesan Baru');
            $body    = "=== PESAN BARU DARI WEBSITE ===\n\n"
                     . "Nama    : {$data['name']}\n"
                     . "Email   : {$data['email']}\n"
                     . "Telepon : " . ($data['phone'] ?? '-') . "\n"
                     . "Tujuan  : " . ($data['purpose'] ?? '-') . "\n\n"
                     . "Pesan:\n{$data['message']}\n\n"
                     . "---\nDikirim: " . now()->format('d M Y H:i') . " WIB";

            Mail::raw($body, function ($msg) use ($to, $subject, $data) {
                $msg->to($to)
                    ->replyTo($data['email'], $data['name'])
                    ->subject($subject);
            });
        } catch (\Exception $e) {
            Log::warning('Email failed: ' . $e->getMessage());
        }
    }
}
