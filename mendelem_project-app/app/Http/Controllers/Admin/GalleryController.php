<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class GalleryController extends Controller
{
    public function index()
    {
        $items = \App\Models\Gallery::orderBy('order')->paginate(20);
        return view('admin.gallery.index', compact('items'));
    }

    public function store(\Illuminate\Http\Request $r)
    {
        $r->validate([
            'files.*'  => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm|max:51200',
            'title_id' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);
        foreach ($r->file('files') as $file) {
            $type = in_array($file->getClientOriginalExtension(), ['mp4','webm']) ? 'video' : 'image';
            \App\Models\Gallery::create([
                'title_id'    => $r->title_id,
                'category'    => $r->category,
                'file_path'   => $file->store('gallery', 'public'),
                'file_type'   => $type,
                'is_active'   => true,
            ]);
        }
        return back()->with('success', count($r->file('files')) . ' file berhasil diupload!');
    }

    public function destroy(\App\Models\Gallery $gallery)
    {
        \Storage::disk('public')->delete($gallery->file_path);
        $gallery->delete();
        return back()->with('success', 'File dihapus.');
    }

    public function reorder(\Illuminate\Http\Request $r)
    {
        foreach ($r->input('order', []) as $id => $ord) {
            \App\Models\Gallery::where('id', $id)->update(['order' => $ord]);
        }
        return response()->json(['success' => true]);
    }
}
