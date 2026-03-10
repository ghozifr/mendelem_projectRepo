@extends('layouts.admin')
@section('title', $project ? 'Edit Proyek' : 'Tambah Proyek')
@section('page-title', $project ? 'Edit Proyek' : 'Tambah Proyek Baru')
@section('page-subtitle', $project ? 'Perbarui data proyek' : 'Buat proyek baru')

@section('content')
<div class="page-header">
  <div>
    <h1>{{ $project ? 'Edit: '.$project->name_id : 'Proyek Baru' }}</h1>
  </div>
  <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<form method="POST"
      action="{{ $project ? route('admin.projects.update',$project) : route('admin.projects.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($project) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">

    {{-- Konten Utama --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      {{-- Identitas --}}
      <div class="card">
        <div class="card-header"><h2>Identitas Proyek</h2></div>
        <div class="card-body form-grid">
          <div class="form-group">
            <label>Nama Proyek (ID) <span class="required">*</span></label>
            <input type="text" name="name_id" id="name_id" class="form-control"
                   value="{{ old('name_id', $project->name_id ?? '') }}"
                   required placeholder="Nama proyek...">
          </div>
          <div class="form-group translate-group">
            <label>Project Name (EN)</label>
            <input type="text" name="name_en" id="name_en" class="form-control"
                   value="{{ old('name_en', $project->name_en ?? '') }}"
                   placeholder="Project name...">
            <button type="button" class="translate-btn"
                    onclick="autoTranslate('name_id','name_en',this)">
              <i class="fas fa-language"></i> Terjemahkan
            </button>
          </div>
          <div class="form-group">
            <label>Tag/Kategori (ID)</label>
            <input type="text" name="tag_id" id="tag_id" class="form-control"
                   value="{{ old('tag_id', $project->tag_id ?? '') }}"
                   placeholder="Agribisnis, Peternakan...">
          </div>
          <div class="form-group translate-group">
            <label>Tag/Category (EN)</label>
            <input type="text" name="tag_en" id="tag_en" class="form-control"
                   value="{{ old('tag_en', $project->tag_en ?? '') }}"
                   placeholder="Agribusiness, Livestock...">
            <button type="button" class="translate-btn"
                    onclick="autoTranslate('tag_id','tag_en',this)">
              <i class="fas fa-language"></i> Terjemahkan
            </button>
          </div>
        </div>
      </div>

      {{-- Deskripsi --}}
      <div class="card">
        <div class="card-header"><h2>Deskripsi</h2></div>
        <div class="card-body form-grid">
          <div class="form-group">
            <label>Deskripsi Singkat (ID)</label>
            <textarea name="short_desc_id" id="sdesc_id" class="form-control" rows="3"
                      placeholder="Ringkasan singkat proyek...">{{ old('short_desc_id', $project->short_desc_id ?? '') }}</textarea>
          </div>
          <div class="form-group translate-group">
            <label>Short Description (EN)</label>
            <textarea name="short_desc_en" id="sdesc_en" class="form-control" rows="3"
                      placeholder="Short project summary...">{{ old('short_desc_en', $project->short_desc_en ?? '') }}</textarea>
            <button type="button" class="translate-btn"
                    onclick="autoTranslate('sdesc_id','sdesc_en',this)">
              <i class="fas fa-language"></i> Terjemahkan
            </button>
          </div>
          <div class="form-group">
            <label>Deskripsi Lengkap (ID)</label>
            <textarea name="description_id" id="desc_id" class="form-control" rows="8"
                      placeholder="Deskripsi lengkap proyek...">{{ old('description_id', $project->description_id ?? '') }}</textarea>
          </div>
          <div class="form-group translate-group">
            <label>Full Description (EN)</label>
            <textarea name="description_en" id="desc_en" class="form-control" rows="8"
                      placeholder="Full project description...">{{ old('description_en', $project->description_en ?? '') }}</textarea>
            <button type="button" class="translate-btn"
                    onclick="autoTranslate('desc_id','desc_en',this)">
              <i class="fas fa-language"></i> Terjemahkan
            </button>
          </div>
        </div>
      </div>

      {{-- Galeri (hanya untuk proyek yang sudah ada) --}}
      @if($project)
      <div class="card">
        <div class="card-header"><h2>Galeri Proyek</h2></div>
        <div class="card-body">
          @if($project->gallery && count($project->gallery))
          <div class="preview-grid" style="margin-bottom:1rem">
            @foreach($project->gallery as $idx => $img)
            <div class="preview-item">
              <img src="{{ asset('storage/'.$img) }}" alt="">
              <button type="button" class="preview-del"
                      onclick="deleteGalleryImg({{ $project->id }}, {{ $idx }}, this)">
                <i class="fas fa-times"></i>
              </button>
            </div>
            @endforeach
          </div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('galleryUpload').click()">
            <i class="fas fa-images"></i>
            <p>Upload foto proyek (bisa multiple)</p>
            <small>JPG, PNG, WEBP — maks. 5MB/file</small>
          </div>
          <input type="file" id="galleryUpload" accept="image/*" multiple
                 style="display:none"
                 onchange="uploadProjectGallery(this, {{ $project->id }})">
          <div id="galleryPreview" class="preview-grid" style="margin-top:.75rem"></div>
        </div>
      </div>
      @endif

    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      <div class="card">
        <div class="card-header"><h2>Pengaturan</h2></div>
        <div class="card-body">
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
              <option value="active"    {{ old('status', $project->status ?? 'active') === 'active'   ? 'selected' : '' }}>✅ Aktif</option>
              <option value="planned"   {{ old('status', $project->status ?? '') === 'planned'  ? 'selected' : '' }}>📋 Direncanakan</option>
              <option value="inactive"  {{ old('status', $project->status ?? '') === 'inactive' ? 'selected' : '' }}>⏸️ Nonaktif</option>
            </select>
          </div>
          <div class="form-group">
            <label>Icon (Font Awesome class)</label>
            <input type="text" name="icon" id="iconInput" class="form-control"
                   value="{{ old('icon', $project->icon ?? 'fas fa-folder') }}"
                   placeholder="fas fa-store">
            <div class="form-hint">
              Preview: <i id="iconPreview" class="{{ $project->icon ?? 'fas fa-folder' }}"
                          style="margin-left:.4rem;font-size:1rem"></i>
            </div>
          </div>
          <div class="form-group">
            <label>Warna Brand</label>
            <input type="color" name="color" class="form-control"
                   value="{{ old('color', $project->color ?? '#0f75bd') }}">
          </div>
          <div class="form-group">
            <label>Jumlah Anggota</label>
            <input type="number" name="members_count" class="form-control"
                   value="{{ old('members_count', $project->members_count ?? 0) }}" min="0">
          </div>
          <div class="form-group">
            <label>Tahun Mulai</label>
            <input type="number" name="year_started" class="form-control"
                   value="{{ old('year_started', $project->year_started ?? date('Y')) }}"
                   min="2000" max="{{ date('Y') + 5 }}">
          </div>
          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="order" class="form-control"
                   value="{{ old('order', $project->order ?? 0) }}" min="0">
          </div>
          <div class="form-check" style="margin:.5rem 0">
            <input type="checkbox" name="is_featured" id="is_featured"
                   {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
            <label for="is_featured">Featured (tampil di Beranda)</label>
          </div>
          <button type="submit" class="btn btn-primary"
                  style="width:100%;margin-top:1rem;justify-content:center">
            <i class="fas fa-save"></i> {{ $project ? 'Perbarui' : 'Simpan' }} Proyek
          </button>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h2>Thumbnail Utama</h2></div>
        <div class="card-body">
          @if($project && $project->thumbnail)
            <img src="{{ asset('storage/'.$project->thumbnail) }}"
                 style="width:100%;border-radius:8px;margin-bottom:.75rem;border:1px solid #e2e8f0" alt="">
            <div style="font-size:.75rem;color:#718096;margin-bottom:.75rem">
              Upload baru untuk mengganti.
            </div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('thumbProj').click()">
            <i class="fas fa-image"></i>
            <p>Upload thumbnail proyek</p>
            <small>JPG, PNG, WEBP — maks. 5MB</small>
          </div>
          <input type="file" id="thumbProj" name="thumbnail" accept="image/*"
                 style="display:none" onchange="previewProjThumb(this)">
          <div id="projThumbPrev" style="margin-top:.75rem"></div>
        </div>
      </div>

    </div>
  </div>
</form>

@push('scripts')
<script>
// Icon preview
document.getElementById('iconInput')?.addEventListener('input', function () {
  document.getElementById('iconPreview').className = this.value;
});

// Thumbnail preview
function previewProjThumb(input) {
  const p = document.getElementById('projThumbPrev');
  p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:8px;border:1px solid #e2e8f0';
    p.appendChild(img);
  }
}

// Upload gallery image via AJAX
function uploadProjectGallery(input, projectId) {
  [...input.files].forEach(file => {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', '{{ csrf_token() }}');
    fetch(`/admin/projects/${projectId}/gallery`, { method: 'POST', body: formData })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const prev = document.getElementById('galleryPreview');
          const div  = document.createElement('div');
          div.className = 'preview-item';
          div.innerHTML = `<img src="${data.path}" alt="">
            <button type="button" class="preview-del"
              onclick="deleteGalleryImg(${projectId},${data.index},this)">
              <i class="fas fa-times"></i></button>`;
          prev.appendChild(div);
        }
      });
  });
}

// Delete gallery image via AJAX
function deleteGalleryImg(projectId, index, btn) {
  if (!confirm('Hapus gambar ini?')) return;
  fetch(`/admin/projects/${projectId}/gallery/${index}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
  }).then(r => r.json()).then(data => {
    if (data.success) btn.closest('.preview-item').remove();
  });
}
</script>
@endpush
@endsection
