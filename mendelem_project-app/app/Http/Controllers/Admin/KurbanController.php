<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KurbanAnimal;
use Illuminate\Support\Facades\Storage;

class KurbanController extends Controller
{
    public function index()
    {
        $animals = KurbanAnimal::orderBy('order')->orderBy('id')->paginate(20);
        return view('admin.kurban.index', compact('animals'));
    }

    public function create()
    {
        return view('admin.kurban.form', ['animal' => null]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'             => 'nullable|string|max:100',
            'jenis_hewan'      => 'required|in:kambing,domba',
            'kelamin'          => 'required|in:jantan,betina',
            'jenis_ras'        => 'nullable|string|max:100',
            'berat_kg'         => 'nullable|numeric|min:0|max:999',
            'umur'             => 'nullable|string|max:50',
            'harga'            => 'required|numeric|min:0',
            'status'           => 'required|in:tersedia,dipesan,terjual',
            'order'            => 'nullable|integer|min:0',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'whatsapp_number'  => 'nullable|string|max:20',
            'catatan'          => 'nullable|string|max:2000',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('kurban', 'public');
        }

        $animal = KurbanAnimal::create($data);

        return redirect()->route('admin.kurban.index')
            ->with('success', 'Hewan kurban berhasil ditambahkan!');
    }

    public function edit(KurbanAnimal $kurban)
    {
        return view('admin.kurban.form', ['animal' => $kurban]);
    }

    public function update(Request $r, KurbanAnimal $kurban)
    {
        $data = $r->validate([
            'name'             => 'nullable|string|max:100',
            'jenis_hewan'      => 'required|in:kambing,domba',
            'kelamin'          => 'required|in:jantan,betina',
            'jenis_ras'        => 'nullable|string|max:100',
            'berat_kg'         => 'nullable|numeric|min:0|max:999',
            'umur'             => 'nullable|string|max:50',
            'harga'            => 'required|numeric|min:0',
            'status'           => 'required|in:tersedia,dipesan,terjual',
            'order'            => 'nullable|integer|min:0',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'whatsapp_number'  => 'nullable|string|max:20',
            'catatan'          => 'nullable|string|max:2000',
        ]);

        $data['is_active'] = $r->has('is_active') ? 1 : 0;
        $data['order']     = $data['order'] ?? $kurban->order;

        if ($r->hasFile('thumbnail')) {
            if ($kurban->thumbnail) Storage::disk('public')->delete($kurban->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('kurban', 'public');
        }

        $kurban->update($data);

        return redirect()->route('admin.kurban.index')
            ->with('success', 'Data hewan kurban berhasil diperbarui!');
    }

    public function destroy(KurbanAnimal $kurban)
    {
        // Hapus semua file media
        if ($kurban->thumbnail) Storage::disk('public')->delete($kurban->thumbnail);
        foreach ($kurban->media ?? [] as $m) {
            Storage::disk('public')->delete($m['path']);
        }
        $kurban->delete();

        return redirect()->route('admin.kurban.index')
            ->with('success', 'Hewan kurban berhasil dihapus.');
    }

    // Hapus thumbnail saja
    public function deleteThumbnail(KurbanAnimal $kurban)
    {
        if ($kurban->thumbnail) {
            Storage::disk('public')->delete($kurban->thumbnail);
            $kurban->update(['thumbnail' => null]);
        }
        return back()->with('success', 'Foto utama berhasil dihapus.');
    }

    // Upload media (foto/video) ke galeri
    public function uploadMedia(Request $r, KurbanAnimal $kurban)
    {
        $r->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,mov|max:2097152',
        ]);

        $file = $r->file('file');
        $ext  = strtolower($file->getClientOriginalExtension());
        $type = in_array($ext, ['mp4', 'webm', 'mov']) ? 'video' : 'image';
        $path = $file->store('kurban/media', 'public');

        $media   = $kurban->media ?? [];
        $media[] = ['path' => $path, 'type' => $type];
        $kurban->update(['media' => $media]);

        return response()->json([
            'success' => true,
            'url'     => asset('storage/' . $path),
            'type'    => $type,
            'index'   => count($media) - 1,
        ]);
    }

    // Hapus satu item media dari galeri
    public function deleteMedia(Request $r, KurbanAnimal $kurban, int $index)
    {
        $media = $kurban->media ?? [];
        if (isset($media[$index])) {
            Storage::disk('public')->delete($media[$index]['path']);
            array_splice($media, $index, 1);
            $kurban->update(['media' => array_values($media)]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Media tidak ditemukan'], 404);
    }
}
