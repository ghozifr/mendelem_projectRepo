<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class AdminProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::orderBy('order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create() { return view('admin.products.form', ['product'=>null]); }

    public function store(\Illuminate\Http\Request $r)
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
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'order'          => 'integer|min:0',
        ]);
        $data['is_featured'] = $r->boolean('is_featured');
        $data['is_active']   = $r->boolean('is_active', true);
        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('products', 'public');
        }
        \App\Models\Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(\App\Models\Product $product) { return view('admin.products.form', compact('product')); }

    public function update(\Illuminate\Http\Request $r, \App\Models\Product $product)
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
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'order'          => 'integer|min:0',
        ]);
        if ($r->hasFile('thumbnail')) {
            if ($product->thumbnail) \Storage::disk('public')->delete($product->thumbnail);
            $data['thumbnail'] = $r->file('thumbnail')->store('products', 'public');
        }
        $data['is_featured'] = $r->boolean('is_featured');
        $data['is_active']   = $r->boolean('is_active', true);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(\App\Models\Product $product)
    {
        if ($product->thumbnail) \Storage::disk('public')->delete($product->thumbnail);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus.');
    }

    public function uploadGallery(\Illuminate\Http\Request $r, \App\Models\Product $product)
    {
        $r->validate(['image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
        $path    = $r->file('image')->store('products/gallery', 'public');
        $gallery = $product->gallery ?? [];
        $gallery[] = $path;
        $product->update(['gallery' => $gallery]);
        return response()->json(['success'=>true,'path'=>asset('storage/'.$path)]);
    }
}
