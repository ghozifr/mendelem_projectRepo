<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderBy('order')->orderBy('id','desc')->paginate(24);
        return view('admin.gallery.index', compact('items'));
    }

    // Point 7: Support large videos (up to 2GB per-file in PHP config)
    public function store(Request $r)
    {
        $r->validate([
            'files'    => 'required',
            // max:2097152 = 2GB in KB
            'files.*'  => 'file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,mov,avi|max:2097152',
            'title_id' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $files = $r->file('files');

        if (!$files || !is_array($files)) {
            return back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $count = 0;
        foreach ($files as $file) {
            if (!$file || !$file->isValid()) continue;

            $ext  = strtolower($file->getClientOriginalExtension());
            $type = in_array($ext, ['mp4', 'webm', 'mov', 'avi']) ? 'video' : 'image';

            Gallery::create([
                'title_id'  => $r->title_id,
                'category'  => $r->category ?? 'general',
                'file_path' => $file->store('gallery', 'public'),
                'file_type' => $type,
                'is_active' => 1,
                'order'     => 0,
            ]);
            $count++;
        }

        return back()->with('success', $count . ' file berhasil diupload!');
    }

    // Point 3: Delete gallery item
    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->file_path);
        $gallery->delete();
        return back()->with('success', 'File berhasil dihapus.');
    }
}
