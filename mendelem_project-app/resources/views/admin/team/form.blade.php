@extends('layouts.admin')
@section('title', $member ? 'Edit Anggota' : 'Tambah Anggota')
@section('page-title', $member ? 'Edit Anggota Tim' : 'Tambah Anggota Tim')

@section('content')
<div class="page-header">
  <div><h1>{{ $member ? 'Edit: '.$member->name : 'Anggota Baru' }}</h1></div>
  <a href="{{ route('admin.team.index') }}" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<form method="POST"
      action="{{ $member ? route('admin.team.update',$member) : route('admin.team.store') }}"
      enctype="multipart/form-data">
  @csrf @if($member) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start">
    <div class="card">
      <div class="card-header"><h2>Data Anggota</h2></div>
      <div class="card-body form-grid">
        <div class="form-group full">
          <label>Nama Lengkap <span class="required">*</span></label>
          <input type="text" name="name" class="form-control"
                 value="{{ old('name', $member->name ?? '') }}" required>
        </div>
        <div class="form-group">
          <label>Jabatan (ID) <span class="required">*</span></label>
          <input type="text" name="role_id" id="role_id" class="form-control"
                 value="{{ old('role_id', $member->role_id ?? '') }}" required>
        </div>
        <div class="form-group translate-group">
          <label>Role (EN)</label>
          <input type="text" name="role_en" id="role_en" class="form-control"
                 value="{{ old('role_en', $member->role_en ?? '') }}">
          <button type="button" class="translate-btn"
                  onclick="autoTranslate('role_id','role_en',this)">
            <i class="fas fa-language"></i> Terjemahkan
          </button>
        </div>
        <div class="form-group">
          <label>Bio (ID)</label>
          <textarea name="bio_id" id="bio_id" class="form-control"
                    rows="4">{{ old('bio_id', $member->bio_id ?? '') }}</textarea>
        </div>
        <div class="form-group translate-group">
          <label>Bio (EN)</label>
          <textarea name="bio_en" id="bio_en" class="form-control"
                    rows="4">{{ old('bio_en', $member->bio_en ?? '') }}</textarea>
          <button type="button" class="translate-btn"
                  onclick="autoTranslate('bio_id','bio_en',this)">
            <i class="fas fa-language"></i> Terjemahkan
          </button>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control"
                 value="{{ old('email', $member->email ?? '') }}">
        </div>
        <div class="form-group">
          <label>No. Telepon</label>
          <input type="text" name="phone" class="form-control"
                 value="{{ old('phone', $member->phone ?? '') }}">
        </div>
        <div class="form-group">
          <label>Urutan</label>
          <input type="number" name="order" class="form-control"
                 value="{{ old('order', $member->order ?? 0) }}" min="0">
        </div>
        <div class="form-group" style="align-self:end">
          <div class="form-check">
            <input type="checkbox" name="is_active" id="isActive"
                   {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
            <label for="isActive">Anggota Aktif</label>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header"><h2>Foto Profil</h2></div>
      <div class="card-body">
        @if($member && $member->photo)
          <img src="{{ asset('storage/'.$member->photo) }}"
               style="width:100%;border-radius:50%;aspect-ratio:1;object-fit:cover;margin-bottom:.75rem;border:3px solid #e2e8f0" alt="">
        @endif
        <div class="upload-zone" onclick="document.getElementById('photoInput').click()">
          <i class="fas fa-camera"></i>
          <p>Upload foto profil</p>
          <small>JPG, PNG, WEBP — maks. 2MB</small>
        </div>
        <input type="file" id="photoInput" name="photo" accept="image/*"
               style="display:none" onchange="previewPhoto(this)">
        <div id="photoPreview" style="margin-top:.75rem"></div>
        <button type="submit" class="btn btn-primary"
                style="width:100%;margin-top:1rem;justify-content:center">
          <i class="fas fa-save"></i> {{ $member ? 'Perbarui' : 'Simpan' }}
        </button>
      </div>
    </div>
  </div>
</form>

@push('scripts')
<script>
function previewPhoto(input) {
  const p = document.getElementById('photoPreview');
  p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:50%;aspect-ratio:1;object-fit:cover;border:3px solid #e2e8f0';
    p.appendChild(img);
  }
}
</script>
@endpush
@endsection
