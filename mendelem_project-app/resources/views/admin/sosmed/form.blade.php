@extends('layouts.admin')
@section('title', $item ? 'Edit Social Media' : 'Tambah Social Media')
@section('page-title', $item ? 'Edit Social Media' : 'Tambah Social Media')

@section('content')
<div class="page-header">
  <div><h1>{{ $item ? 'Edit: '.$item->name : 'Social Media Baru' }}</h1></div>
  <a href="{{ route('admin.sosmed.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if($errors->any())
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
@endif

<form method="POST"
      action="{{ $item ? route('admin.sosmed.update',$item) : route('admin.sosmed.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($item) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

    {{-- Kolom Kiri --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">
      <div class="card">
        <div class="card-header"><h2>Informasi Akun</h2></div>
        <div class="card-body form-grid">

          <div class="form-group" style="grid-column:1/-1">
            <label>Nama Akun *</label>
            <input type="text" name="name" class="form-control" required
                   value="{{ old('name', $item->name ?? '') }}"
                   placeholder="Contoh: Instagram Mendelem, YouTube SAGUM, Website Resmi...">
          </div>

          <div class="form-group">
            <label>Platform *</label>
            <select name="platform" class="form-control" id="platformSelect" onchange="updatePlatformIcon()">
              @foreach(['instagram','youtube','facebook','tiktok','twitter','whatsapp','telegram','linkedin','website'] as $p)
              <option value="{{ $p }}" {{ old('platform', $item->platform ?? '') === $p ? 'selected' : '' }}>
                {{ ucfirst($p) }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Warna Accent</label>
            <div style="display:flex;gap:.5rem;align-items:center">
              <input type="color" name="color" id="colorInput"
                     value="{{ old('color', $item->color ?? '#0f75bd') }}"
                     style="width:48px;height:38px;border-radius:8px;border:1px solid var(--border);cursor:pointer;padding:2px">
              <input type="text" id="colorText"
                     value="{{ old('color', $item->color ?? '#0f75bd') }}"
                     style="flex:1;padding:.65rem 1rem;border-radius:8px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.88rem;font-family:monospace"
                     onchange="document.getElementById('colorInput').value=this.value">
            </div>
          </div>

          <div class="form-group" style="grid-column:1/-1">
            <label>URL / Link Akun *</label>
            <input type="url" name="url" class="form-control" required
                   value="{{ old('url', $item->url ?? '') }}"
                   placeholder="https://www.instagram.com/mendelem_project">
          </div>

          <div class="form-group" style="grid-column:1/-1">
            <label>Deskripsi Singkat</label>
            <textarea name="description" class="form-control" rows="2"
                      placeholder="Deskripsi singkat akun ini...">{{ old('description', $item->description ?? '') }}</textarea>
          </div>

        </div>
      </div>

      {{-- Preview Images --}}
      @if($item)
      <div class="card">
        <div class="card-header">
          <h2>Gambar Preview</h2>
          <small style="color:var(--text-muted);font-size:.8rem">Gambar postingan/konten yang ditampilkan di halaman detail. Klik gambar → buka URL sosmed.</small>
        </div>
        <div class="card-body">
          @if($item->previews && count($item->previews))
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.75rem;margin-bottom:1rem">
            @foreach($item->previews as $i => $prev)
            <div style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:1;border:1px solid var(--border);background:var(--bg2)" id="prev-item-{{ $i }}">
              <img src="{{ asset('storage/'.$prev['image']) }}" style="width:100%;height:100%;object-fit:cover" alt="">
              @if(!empty($prev['caption']))
              <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.6);color:#fff;font-size:.65rem;padding:.25rem .4rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $prev['caption'] }}</div>
              @endif
              <button type="button" onclick="deletePreview({{ $i }}, this)"
                      style="position:absolute;top:.3rem;right:.3rem;width:26px;height:26px;border-radius:50%;background:rgba(220,38,38,.9);color:#fff;border:none;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-times"></i>
              </button>
            </div>
            @endforeach
          </div>
          @else
          <p style="font-size:.82rem;color:var(--text-muted);text-align:center;padding:.75rem">Belum ada gambar preview.</p>
          @endif

          {{-- Upload form --}}
          <div style="background:var(--bg2);border-radius:10px;padding:1rem;margin-top:.5rem">
            <div style="font-size:.82rem;font-weight:600;margin-bottom:.75rem">Tambah Gambar Preview</div>
            <div class="form-group"><label style="font-size:.78rem">Link Tujuan (saat diklik)</label>
              <input type="url" id="prevLink" class="form-control" style="font-size:.85rem"
                     placeholder="{{ $item->url }}" value="{{ $item->url }}">
            </div>
            <div class="form-group"><label style="font-size:.78rem">Keterangan (opsional)</label>
              <input type="text" id="prevCaption" class="form-control" style="font-size:.85rem" placeholder="Keterangan gambar...">
            </div>
            <div class="upload-zone" onclick="document.getElementById('prevFile').click()" style="padding:1rem">
              <i class="fas fa-plus-circle" style="font-size:1.3rem;color:var(--primary);display:block;margin-bottom:.3rem"></i>
              <p style="font-size:.82rem;font-weight:600">Pilih Gambar</p>
              <small style="color:var(--text-muted)">JPG, PNG, WEBP — maks. 5MB</small>
            </div>
            <input type="file" id="prevFile" accept="image/*" style="display:none" onchange="uploadPreview(this)">
            <div id="prevUploadStatus" style="display:none;margin-top:.5rem">
              <div style="height:4px;background:#e2e8f0;border-radius:2px;overflow:hidden">
                <div id="prevBar" style="height:100%;background:var(--primary);width:0%;transition:width .3s"></div>
              </div>
              <p style="font-size:.75rem;color:var(--text-muted);margin-top:.2rem">Mengupload...</p>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="card">
        <div class="card-body" style="text-align:center;padding:1.5rem;color:var(--text-muted)">
          <i class="fas fa-images" style="font-size:1.5rem;display:block;margin-bottom:.5rem;color:var(--primary)"></i>
          <p style="font-size:.88rem">Simpan dulu, lalu tambahkan gambar preview.</p>
        </div>
      </div>
      @endif
    </div>

    {{-- Kolom Kanan --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">
      <div class="card">
        <div class="card-header"><h2>Pengaturan</h2></div>
        <div class="card-body">
          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="order" class="form-control" min="0"
                   value="{{ old('order', $item->order ?? 0) }}">
          </div>
          <div class="form-check" style="margin:.75rem 0">
            <input type="checkbox" name="is_active" id="isActive"
                   {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
            <label for="isActive">Tampilkan di Website</label>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem">
            <i class="fas fa-save"></i> {{ $item ? 'Perbarui' : 'Simpan' }}
          </button>
          @if($item)
          <a href="{{ $item->url }}" target="_blank" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:.5rem;text-decoration:none">
            <i class="fas fa-external-link-alt"></i> Buka Akun
          </a>
          @endif
        </div>
      </div>

      {{-- Cover / Thumbnail --}}
      <div class="card">
        <div class="card-header"><h2>Foto Cover</h2></div>
        <div class="card-body">
          @if($item && $item->thumbnail)
          <div style="position:relative;margin-bottom:.75rem">
            <img src="{{ asset('storage/'.$item->thumbnail) }}" style="width:100%;border-radius:10px;border:1px solid var(--border)" alt="">
            <form method="POST" action="{{ route('admin.sosmed.thumbnail.delete',$item) }}"
                  style="position:absolute;top:.4rem;right:.4rem"
                  onsubmit="return confirm('Hapus cover?')">
              @csrf @method('DELETE')
              <button type="submit" style="background:rgba(220,38,38,.9);color:#fff;border:none;border-radius:7px;padding:.3rem .65rem;cursor:pointer;font-size:.75rem">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('thumbFile').click()">
            <i class="fas fa-image"></i>
            <p>{{ ($item && $item->thumbnail) ? 'Ganti Cover' : 'Upload Cover' }}</p>
            <small>JPG, PNG — maks. 5MB</small>
          </div>
          <input type="file" id="thumbFile" name="thumbnail" accept="image/*"
                 style="display:none" onchange="previewThumb(this)">
          <div id="thumbPreview" style="margin-top:.75rem"></div>
        </div>
      </div>

      {{-- Preview icon --}}
      <div class="card">
        <div class="card-header"><h2>Preview Tampilan</h2></div>
        <div class="card-body">
          <div id="cardPreview" style="background:var(--bg2);border-radius:12px;padding:1.25rem;display:flex;flex-direction:column;align-items:center;gap:.75rem;text-align:center;border:2px solid {{ $item->platform_color ?? '#0f75bd' }}33">
            <div id="prevIconBox" style="width:56px;height:56px;border-radius:14px;background:{{ $item->platform_color ?? '#0f75bd' }}22;display:flex;align-items:center;justify-content:center">
              <i id="prevIcon" class="{{ $item->platform_icon ?? 'fas fa-globe' }}" style="font-size:1.6rem;color:{{ $item->platform_color ?? '#0f75bd' }}"></i>
            </div>
            <div>
              <div id="prevName" style="font-weight:700;font-size:.9rem">{{ $item->name ?? 'Nama Akun' }}</div>
              <div id="prevPlatform" style="font-size:.75rem;color:var(--text-muted)">{{ ucfirst($item->platform ?? 'platform') }}</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

@push('scripts')
<script>
const platformIcons = {
  instagram:'fab fa-instagram', youtube:'fab fa-youtube', facebook:'fab fa-facebook-f',
  tiktok:'fab fa-tiktok', twitter:'fab fa-twitter', whatsapp:'fab fa-whatsapp',
  telegram:'fab fa-telegram', linkedin:'fab fa-linkedin-in', website:'fas fa-globe',
};
const platformColors = {
  instagram:'#e1306c', youtube:'#ff0000', facebook:'#1877f2',
  tiktok:'#010101', twitter:'#1da1f2', whatsapp:'#25d366',
  telegram:'#0088cc', linkedin:'#0077b5', website:'#0f75bd',
};

document.getElementById('colorInput')?.addEventListener('input', function() {
  document.getElementById('colorText').value = this.value;
  updatePreviewCard();
});

document.querySelector('input[name="name"]')?.addEventListener('input', function() {
  document.getElementById('prevName').textContent = this.value || 'Nama Akun';
});

function updatePlatformIcon() {
  const p = document.getElementById('platformSelect').value;
  const icon = platformIcons[p] || 'fas fa-globe';
  const color = platformColors[p] || '#0f75bd';
  document.getElementById('prevIcon').className = icon + ' fa-fw';
  document.getElementById('prevIcon').style.color = color;
  document.getElementById('prevIconBox').style.background = color + '22';
  document.getElementById('prevPlatform').textContent = p.charAt(0).toUpperCase() + p.slice(1);
  document.getElementById('colorInput').value = color;
  document.getElementById('colorText').value = color;
}

function updatePreviewCard() {
  const c = document.getElementById('colorInput').value;
  document.getElementById('prevIcon').style.color = c;
  document.getElementById('prevIconBox').style.background = c + '22';
}

function previewThumb(input) {
  const p = document.getElementById('thumbPreview');
  p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:10px;border:1px solid #e2e8f0';
    p.appendChild(img);
  }
}

@if($item)
function uploadPreview(input) {
  if (!input.files[0]) return;
  const fd = new FormData();
  fd.append('image', input.files[0]);
  fd.append('link', document.getElementById('prevLink').value || '{{ $item->url }}');
  fd.append('caption', document.getElementById('prevCaption').value || '');
  fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);

  document.getElementById('prevUploadStatus').style.display = 'block';
  document.getElementById('prevBar').style.width = '40%';

  fetch('{{ route("admin.sosmed.preview.upload", $item) }}', { method:'POST', body:fd })
    .then(r => r.json())
    .then(data => {
      if (data.success) { document.getElementById('prevBar').style.width = '100%'; setTimeout(() => location.reload(), 400); }
      else { alert('Upload gagal'); document.getElementById('prevUploadStatus').style.display = 'none'; }
    }).catch(() => { alert('Upload gagal'); document.getElementById('prevUploadStatus').style.display = 'none'; });
  input.value = '';
}

function deletePreview(index, btn) {
  if (!confirm('Hapus gambar ini?')) return;
  fetch('{{ url("admin/sosmed/".$item->id."/preview") }}/' + index, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
  }).then(r => r.json()).then(d => { if (d.success) location.reload(); });
}
@endif
</script>
@endpush
@endsection
