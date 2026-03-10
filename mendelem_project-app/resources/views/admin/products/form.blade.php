@extends('layouts.admin')
@section('title', $product ? 'Edit Produk' : 'Tambah Produk')
@section('page-title', $product ? 'Edit Produk' : 'Tambah Produk Baru')
@section('page-subtitle', $product ? 'Perbarui data produk' : 'Tambah produk baru')

@section('content')
<div class="page-header">
  <div><h1>{{ $product ? 'Edit: '.$product->name_id : 'Produk Baru' }}</h1></div>
  <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<form method="POST"
      action="{{ $product ? route('admin.products.update',$product) : route('admin.products.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($product) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

    <div class="card">
      <div class="card-header"><h2>Informasi Produk</h2></div>
      <div class="card-body form-grid">
        <div class="form-group">
          <label>Nama Produk (ID) <span class="required">*</span></label>
          <input type="text" name="name_id" id="name_id" class="form-control"
                 value="{{ old('name_id', $product->name_id ?? '') }}" required>
        </div>
        <div class="form-group translate-group">
          <label>Product Name (EN)</label>
          <input type="text" name="name_en" id="name_en" class="form-control"
                 value="{{ old('name_en', $product->name_en ?? '') }}">
          <button type="button" class="translate-btn"
                  onclick="autoTranslate('name_id','name_en',this)">
            <i class="fas fa-language"></i> Terjemahkan
          </button>
        </div>
        <div class="form-group">
          <label>Kategori (ID)</label>
          <input type="text" name="category_id" id="cat_id" class="form-control"
                 value="{{ old('category_id', $product->category_id ?? '') }}"
                 placeholder="Buah Segar, Daging, Camilan...">
        </div>
        <div class="form-group translate-group">
          <label>Category (EN)</label>
          <input type="text" name="category_en" id="cat_en" class="form-control"
                 value="{{ old('category_en', $product->category_en ?? '') }}"
                 placeholder="Fresh Fruit, Meat, Snack...">
          <button type="button" class="translate-btn"
                  onclick="autoTranslate('cat_id','cat_en',this)">
            <i class="fas fa-language"></i> Terjemahkan
          </button>
        </div>
        <div class="form-group">
          <label>Deskripsi (ID)</label>
          <textarea name="description_id" id="desc_id" class="form-control" rows="4"
                    placeholder="Deskripsi produk...">{{ old('description_id', $product->description_id ?? '') }}</textarea>
        </div>
        <div class="form-group translate-group">
          <label>Description (EN)</label>
          <textarea name="description_en" id="desc_en" class="form-control" rows="4"
                    placeholder="Product description...">{{ old('description_en', $product->description_en ?? '') }}</textarea>
          <button type="button" class="translate-btn"
                  onclick="autoTranslate('desc_id','desc_en',this)">
            <i class="fas fa-language"></i> Terjemahkan
          </button>
        </div>
        <div class="form-group">
          <label>Harga Min (Rp)</label>
          <input type="number" name="price_min" class="form-control"
                 value="{{ old('price_min', $product->price_min ?? '') }}" min="0">
        </div>
        <div class="form-group">
          <label>Harga Max (Rp)</label>
          <input type="number" name="price_max" class="form-control"
                 value="{{ old('price_max', $product->price_max ?? '') }}" min="0">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="unit" class="form-control"
                 value="{{ old('unit', $product->unit ?? '') }}"
                 placeholder="kg, ekor, buah, porsi...">
        </div>
        <div class="form-group">
          <label>Icon (Font Awesome)</label>
          <input type="text" name="icon" class="form-control"
                 value="{{ old('icon', $product->icon ?? 'fas fa-box') }}"
                 placeholder="fas fa-leaf">
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:1.25rem">
      <div class="card">
        <div class="card-header"><h2>Pengaturan</h2></div>
        <div class="card-body">
          <div class="form-group">
            <label>Ketersediaan</label>
            <select name="availability" class="form-control">
              <option value="available"     {{ old('availability', $product->availability ?? 'available') === 'available'     ? 'selected' : '' }}>✅ Tersedia</option>
              <option value="seasonal"      {{ old('availability', $product->availability ?? '') === 'seasonal'      ? 'selected' : '' }}>🌿 Musiman</option>
              <option value="out_of_stock"  {{ old('availability', $product->availability ?? '') === 'out_of_stock'  ? 'selected' : '' }}>❌ Habis</option>
            </select>
          </div>
          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="order" class="form-control"
                   value="{{ old('order', $product->order ?? 0) }}" min="0">
          </div>
          <div class="form-check" style="margin:.5rem 0">
            <input type="checkbox" name="is_featured" id="isFeat"
                   {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
            <label for="isFeat">Featured (tampil di Beranda)</label>
          </div>
          <div class="form-check" style="margin:.5rem 0">
            <input type="checkbox" name="is_active" id="isActive"
                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <label for="isActive">Produk Aktif</label>
          </div>
          <button type="submit" class="btn btn-primary"
                  style="width:100%;margin-top:1rem;justify-content:center">
            <i class="fas fa-save"></i> {{ $product ? 'Perbarui' : 'Simpan' }} Produk
          </button>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h2>Foto Produk</h2></div>
        <div class="card-body">
          @if($product && $product->thumbnail)
            <img src="{{ asset('storage/'.$product->thumbnail) }}"
                 style="width:100%;border-radius:8px;margin-bottom:.75rem;border:1px solid #e2e8f0" alt="">
          @endif
          <div class="upload-zone" onclick="document.getElementById('prodThumb').click()">
            <i class="fas fa-camera"></i>
            <p>Upload foto produk</p>
            <small>JPG, PNG, WEBP — maks. 5MB</small>
          </div>
          <input type="file" id="prodThumb" name="thumbnail" accept="image/*"
                 style="display:none" onchange="previewImg(this,'prodPrev')">
          <div id="prodPrev" style="margin-top:.75rem"></div>
        </div>
      </div>
    </div>

  </div>
</form>

@push('scripts')
<script>
function previewImg(input, prevId) {
  const p = document.getElementById(prevId);
  p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:8px;border:1px solid #e2e8f0';
    p.appendChild(img);
  }
}
</script>
@endpush
@endsection
