<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create() { return view('admin.products.form', ['product' => null]); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name_id'        => 'required|string|max:255',
            'name_en'        => 'nullable|string|max:255',
            'category_id'    => 'nullable|string|max:100',
            'category_en'    => 'nullable|string|max:100',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string|max:100',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'price_min'      => 'nullable|numeric|min:0',
            'price_max'      => 'nullable|numeric|min:0',
            'unit'           => 'nullable|string|max:50',
            'availability'   => 'required|in:available,seasonal,out_of_stock',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['is_featured'] = $r->has('is_featured') ? 1 : 0;
        $data['is_active']   = $r->has('is_active')   ? 1 : 0;
        $data['order']       = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product) { return view('admin.products.form', compact('product')); }

    public function update(Request $r, Product $product)
    {
        $data = $r->validate([
            'name_id'        => 'required|string|max:255',
            'name_en'        => 'nullable|string|max:255',
            'category_id'    => 'nullable|string|max:100',
            'category_en'    => 'nullable|string|max:100',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string|max:100',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'price_min'      => 'nullable|numeric|min:0',
            'price_max'      => 'nullable|numeric|min:0',
            'unit'           => 'nullable|string|max:50',
            'availability'   => 'required|in:available,seasonal,out_of_stock',
            'order'          => 'nullable|integer|min:0',
        ]);

        $data['is_featured'] = $r->has('is_featured') ? 1 : 0;
        $data['is_active']   = $r->has('is_active')   ? 1 : 0;
        $data['order']       = $data['order'] ?? 0;

        if ($r->hasFile('thumbnail')) {
            if ($product->thumbnail) \Storage::disk('public')->delete($product->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail) \Storage::disk('public')->delete($product->thumbnail);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus.');
    }

    public function uploadGallery(Request $r, Product $product)
    {
        $r->validate(['image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
        $path    = $r->file('image')->store('products/gallery', 'public');
        $gallery = $product->gallery ?? [];
        $gallery[] = $path;
        $product->update(['gallery' => $gallery]);
        return response()->json(['success' => true, 'path' => asset('storage/' . $path)]);
    }
}
