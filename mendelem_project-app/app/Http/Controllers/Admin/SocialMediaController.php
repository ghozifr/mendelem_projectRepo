<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    public function index()
    {
        $items = SocialMedia::orderBy('order')->orderBy('id')->get();
        return view('admin.sosmed.index', compact('items'));
    }

    public function create()
    {
        return view('admin.sosmed.form', ['item' => null]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'        => 'required|string|max:100',
            'platform'    => 'required|string|max:50',
            'url'         => 'required|url|max:500',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'nullable|string|max:500',
            'order'       => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('sosmed', 'public');
        }

        SocialMedia::create($data);
        return redirect()->route('admin.sosmed.index')
            ->with('success', 'Social media berhasil ditambahkan!');
    }

    public function edit(SocialMedia $sosmed)
    {
        return view('admin.sosmed.form', ['item' => $sosmed]);
    }

    public function update(Request $r, SocialMedia $sosmed)
    {
        $data = $r->validate([
            'name'        => 'required|string|max:100',
            'platform'    => 'required|string|max:50',
            'url'         => 'required|url|max:500',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'nullable|string|max:500',
            'order'       => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? $sosmed->order;

        if ($r->hasFile('thumbnail')) {
            if ($sosmed->thumbnail) Storage::disk('public')->delete($sosmed->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('sosmed', 'public');
        }

        $sosmed->update($data);
        return redirect()->route('admin.sosmed.index')
            ->with('success', 'Social media berhasil diperbarui!');
    }

    public function destroy(SocialMedia $sosmed)
    {
        // Hapus thumbnail cover
        if ($sosmed->thumbnail) {
            Storage::disk('public')->delete($sosmed->thumbnail);
        }

        // Hapus file preview — hanya tipe 'image' (tipe 'embed' tidak punya file)
        foreach ($sosmed->previews ?? [] as $prev) {
            if (($prev['type'] ?? 'image') === 'image' && !empty($prev['image'])) {
                Storage::disk('public')->delete($prev['image']);
            }
        }

        $sosmed->delete();
        return redirect()->route('admin.sosmed.index')
            ->with('success', 'Social media berhasil dihapus.');
    }

    // Hapus thumbnail cover saja
    public function deleteThumbnail(SocialMedia $sosmed)
    {
        if ($sosmed->thumbnail) {
            Storage::disk('public')->delete($sosmed->thumbnail);
            $sosmed->update(['thumbnail' => null]);
        }
        return back()->with('success', 'Cover berhasil dihapus.');
    }

    // Upload preview — support image upload DAN embed URL (Instagram/YouTube)
    public function uploadPreview(Request $r, SocialMedia $sosmed)
    {
        $type = $r->input('type', 'image');

        if ($type === 'embed') {
            $r->validate([
                'embed_url' => 'required|url|max:500',
                'caption'   => 'nullable|string|max:200',
            ]);

            $embedUrl  = $r->embed_url;
            $platform  = $this->detectPlatform($embedUrl);
            $embedCode = $this->buildEmbedCode($embedUrl, $platform);

            if (!$embedCode) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL tidak dikenali. Gunakan URL postingan Instagram atau YouTube.',
                ], 422);
            }

            $previews   = $sosmed->previews ?? [];
            $previews[] = [
                'type'       => 'embed',
                'platform'   => $platform,
                'embed_url'  => $embedUrl,
                'embed_code' => $embedCode,
                'caption'    => $r->caption ?? '',
            ];
            $sosmed->update(['previews' => $previews]);

            return response()->json([
                'success'    => true,
                'type'       => 'embed',
                'platform'   => $platform,
                'embed_code' => $embedCode,
                'index'      => count($previews) - 1,
            ]);

        } else {
            // Upload gambar biasa
            $r->validate([
                'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
                'link'    => 'nullable|url|max:500',
                'caption' => 'nullable|string|max:200',
            ]);

            $path       = $r->file('image')->store('sosmed/previews', 'public');
            $previews   = $sosmed->previews ?? [];
            $previews[] = [
                'type'    => 'image',
                'image'   => $path,
                'link'    => $r->link ?? $sosmed->url,
                'caption' => $r->caption ?? '',
            ];
            $sosmed->update(['previews' => $previews]);

            return response()->json([
                'success' => true,
                'type'    => 'image',
                'url'     => asset('storage/' . $path),
                'index'   => count($previews) - 1,
            ]);
        }
    }

    // Hapus satu item preview
    public function deletePreview(SocialMedia $sosmed, int $index)
    {
        $previews = $sosmed->previews ?? [];

        if (!isset($previews[$index])) {
            return response()->json(['success' => false, 'message' => 'Preview tidak ditemukan.'], 404);
        }

        $prev = $previews[$index];

        // Hapus file hanya kalau tipe image
        if (($prev['type'] ?? 'image') === 'image' && !empty($prev['image'])) {
            Storage::disk('public')->delete($prev['image']);
        }

        array_splice($previews, $index, 1);
        $sosmed->update(['previews' => array_values($previews)]);

        return response()->json(['success' => true]);
    }

    // ── PRIVATE HELPERS ──────────────────────────────────────────

    private function detectPlatform(string $url): string
    {
        if (str_contains($url, 'instagram.com')) return 'instagram';
        if (str_contains($url, 'youtu.be') || str_contains($url, 'youtube.com')) return 'youtube';
        if (str_contains($url, 'facebook.com') || str_contains($url, 'fb.com')) return 'facebook';
        if (str_contains($url, 'tiktok.com')) return 'tiktok';
        return 'unknown';
    }

    private function buildEmbedCode(string $url, string $platform): ?string
    {
        switch ($platform) {
            case 'instagram':
                // Support /p/, /reel/, /tv/
                if (preg_match('#instagram\.com/(?:p|reel|tv)/([A-Za-z0-9_-]+)#', $url, $m)) {
                    return "https://www.instagram.com/p/{$m[1]}/embed/captioned/";
                }
                return null;

            case 'youtube':
                // Support watch?v=, youtu.be/, /shorts/, /embed/
                if (preg_match('#(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([A-Za-z0-9_-]{11})#', $url, $m)) {
                    return "https://www.youtube.com/embed/{$m[1]}";
                }
                return null;

            case 'facebook':
                $encoded = urlencode($url);
                return "https://www.facebook.com/plugins/post.php?href={$encoded}&width=500&show_text=true";

            default:
                return null;
        }
    }
}
