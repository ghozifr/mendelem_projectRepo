@extends('layouts.admin')
@section('title', $article ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', $article ? 'Edit Artikel' : 'Tulis Artikel Baru')
@section('page-subtitle', $article ? 'Perbarui konten artikel' : 'Buat artikel/berita baru')

@section('content')
<div class="page-header">
  <div>
    <h1>{{ $article ? 'Edit: '.$article->title_id : 'Tulis Artikel Baru' }}</h1>
  </div>
  <a href="{{ route('admin.articles.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<form method="POST" action="{{ $article ? route('admin.articles.update', $article) : route('admin.articles.store') }}" enctype="multipart/form-data">
  @csrf
  @if($article) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">

    {{-- Main Content --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      {{-- Judul --}}
      <div class="card">
        <div class="card-header"><h2>Judul Artikel</h2></div>
        <div class="card-body form-grid">
          <div class="form-group full">
            <label>Judul <span style="color:#8cc63e;font-size:.75rem;font-weight:500">(Bahasa Indonesia)</span> <span class="required">*</span></label>
            <input type="text" name="title_id" id="title_id" class="form-control" value="{{ old('title_id', $article->title_id ?? '') }}" placeholder="Tulis judul artikel dalam bahasa Indonesia..." required>
          </div>
          <div class="form-group full translate-group">
            <label>Judul <span style="color:#0f75bd;font-size:.75rem;font-weight:500">(English)</span></label>
            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $article->title_en ?? '') }}" placeholder="Article title in English (auto-fill via translate button below)">
            <button type="button" class="translate-btn" onclick="autoTranslate('title_id','title_en',this)"><i class="fas fa-language"></i> Terjemahkan</button>
          </div>
        </div>
      </div>

      {{-- Ringkasan --}}
      <div class="card">
        <div class="card-header"><h2>Ringkasan / Excerpt</h2></div>
        <div class="card-body form-grid">
          <div class="form-group">
            <label>Ringkasan <span style="color:#8cc63e;font-size:.75rem">(ID)</span></label>
            <textarea name="excerpt_id" id="excerpt_id" class="form-control" rows="3" placeholder="Ringkasan singkat artikel...">{{ old('excerpt_id', $article->excerpt_id ?? '') }}</textarea>
          </div>
          <div class="form-group translate-group">
            <label>Excerpt <span style="color:#0f75bd;font-size:.75rem">(EN)</span></label>
            <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="3" placeholder="Brief article summary...">{{ old('excerpt_en', $article->excerpt_en ?? '') }}</textarea>
            <button type="button" class="translate-btn" onclick="autoTranslate('excerpt_id','excerpt_en',this)"><i class="fas fa-language"></i> Terjemahkan</button>
          </div>
        </div>
      </div>

      {{-- Konten Utama --}}
      <div class="card">
        <div class="card-header">
          <h2>Isi Artikel</h2>
          <button type="button" class="btn btn-sm btn-outline" onclick="autoTranslate('content_id','content_en',this)">
            <i class="fas fa-language"></i> Terjemahkan Konten ID → EN
          </button>
        </div>
        <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
          <div class="form-group">
            <label>Isi Artikel <span style="color:#8cc63e;font-size:.75rem">(Bahasa Indonesia)</span></label>
            <textarea name="content_id" id="content_id" class="form-control" rows="16" placeholder="Tulis isi artikel lengkap di sini (mendukung HTML dasar)...">{{ old('content_id', $article->content_id ?? '') }}</textarea>
            <div class="form-hint">Mendukung HTML dasar: &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;h2&gt;, &lt;h3&gt;</div>
          </div>
          <div class="form-group">
            <label>Article Content <span style="color:#0f75bd;font-size:.75rem">(English)</span></label>
            <textarea name="content_en" id="content_en" class="form-control" rows="16" placeholder="Full article content in English (auto-translate available)...">{{ old('content_en', $article->content_en ?? '') }}</textarea>
          </div>
        </div>
      </div>
    </div>

    {{-- Sidebar Settings --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      {{-- Publish --}}
      <div class="card">
        <div class="card-header"><h2>Publikasi</h2></div>
        <div class="card-body">
          <div class="form-group">
            <label>Status <span class="required">*</span></label>
            <select name="status" class="form-control">
              <option value="draft" {{ old('status', $article->status ?? 'draft') === 'draft' ? 'selected' : '' }}>📝 Draft</option>
              <option value="published" {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>✅ Terbit Sekarang</option>
              <option value="archived" {{ old('status', $article->status ?? '') === 'archived' ? 'selected' : '' }}>📦 Arsip</option>
            </select>
          </div>
          @if($article && $article->published_at)
          <div style="font-size:.78rem;color:#718096;margin-top:.5rem"><i class="fas fa-calendar"></i> Terbit: {{ $article->published_at->format('d M Y, H:i') }}</div>
          @endif
          <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;justify-content:center">
            <i class="fas fa-save"></i> {{ $article ? 'Perbarui Artikel' : 'Simpan Artikel' }}
          </button>
        </div>
      </div>

      {{-- Kategori --}}
      <div class="card">
        <div class="card-header"><h2>Kategori</h2></div>
        <div class="card-body form-grid">
          <div class="form-group">
            <label>Kategori (ID)</label>
            <input type="text" name="category_id" class="form-control" value="{{ old('category_id', $article->category_id ?? '') }}" list="cat-list-id" placeholder="Agribisnis, Komunitas...">
            <datalist id="cat-list-id">
              <option>Agribisnis</option><option>Peternakan</option><option>Hortikultura</option>
              <option>Kuliner</option><option>Komunitas</option><option>Kemitraan</option><option>Digital</option>
            </datalist>
          </div>
          <div class="form-group translate-group">
            <label>Category (EN)</label>
            <input type="text" name="category_en" id="category_en" class="form-control" value="{{ old('category_en', $article->category_en ?? '') }}" placeholder="Agribusiness, Community...">
          </div>
        </div>
      </div>

      {{-- Thumbnail --}}
      <div class="card">
        <div class="card-header"><h2>Gambar Thumbnail</h2></div>
        <div class="card-body">
          @if($article && $article->thumbnail)
          <div style="margin-bottom:1rem">
            <img src="{{ asset('storage/'.$article->thumbnail) }}" style="width:100%;border-radius:8px;border:1px solid #e2e8f0" alt="">
            <div style="font-size:.75rem;color:#718096;margin-top:.3rem">Gambar saat ini (upload baru untuk mengganti)</div>
          </div>
          @endif
          <div class="upload-zone" id="thumbZone" onclick="document.getElementById('thumbInput').click()">
            <i class="fas fa-image"></i>
            <p>Klik atau seret gambar ke sini</p>
            <small>JPG, PNG, WEBP — maks. 5MB</small>
          </div>
          <input type="file" id="thumbInput" name="thumbnail" accept="image/*" style="display:none" onchange="previewThumb(this)">
          <div id="thumbPreview" style="margin-top:.75rem"></div>
        </div>
      </div>

    </div>
  </div>
</form>

@push('scripts')
<script>
function previewThumb(input) {
  const prev = document.getElementById('thumbPreview');
  prev.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:8px;border:1px solid #e2e8f0;margin-top:.5rem';
    prev.appendChild(img);
  }
}
</script>
@endpush
@endsection
