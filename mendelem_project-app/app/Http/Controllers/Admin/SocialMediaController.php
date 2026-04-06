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

    public function create() { return view('admin.sosmed.form', ['item' => null]); }

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
        return redirect()->route('admin.sosmed.index')->with('success', 'Social media berhasil ditambahkan!');
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
        return redirect()->route('admin.sosmed.index')->with('success', 'Social media berhasil diperbarui!');
    }

    public function destroy(SocialMedia $sosmed)
    {
        if ($sosmed->thumbnail) Storage::disk('public')->delete($sosmed->thumbnail);
        foreach ($sosmed->previews ?? [] as $p) {
            if (!empty($p['image'])) Storage::disk('public')->delete($p['image']);
        }
        $sosmed->delete();
        return redirect()->route('admin.sosmed.index')->with('success', 'Social media dihapus.');
    }

    // Hapus thumbnail
    public function deleteThumbnail(SocialMedia $sosmed)
    {
        if ($sosmed->thumbnail) {
            Storage::disk('public')->delete($sosmed->thumbnail);
            $sosmed->update(['thumbnail' => null]);
        }
        return back()->with('success', 'Cover berhasil dihapus.');
    }

    // Upload preview image
    public function uploadPreview(Request $r, SocialMedia $sosmed)
    {
        $r->validate([
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'link'    => 'nullable|url|max:500',
            'caption' => 'nullable|string|max:200',
        ]);

        $path     = $r->file('image')->store('sosmed/previews', 'public');
        $previews = $sosmed->previews ?? [];
        $previews[] = [
            'image'   => $path,
            'link'    => $r->link ?? $sosmed->url,
            'caption' => $r->caption ?? '',
        ];
        $sosmed->update(['previews' => $previews]);

        return response()->json([
            'success' => true,
            'url'     => asset('storage/' . $path),
            'index'   => count($previews) - 1,
        ]);
    }

    // Hapus satu preview
    public function deletePreview(SocialMedia $sosmed, int $index)
    {
        $previews = $sosmed->previews ?? [];
        if (isset($previews[$index])) {
            if (!empty($previews[$index]['image'])) {
                Storage::disk('public')->delete($previews[$index]['image']);
            }
            array_splice($previews, $index, 1);
            $sosmed->update(['previews' => array_values($previews)]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
