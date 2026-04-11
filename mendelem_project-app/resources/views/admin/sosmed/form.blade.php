@extends('layouts.admin')
@section('title', $item ? 'Edit Social Media' : 'Tambah Social Media')
@section('page-title', $item ? 'Edit Social Media' : 'Tambah Social Media')
@section('page-subtitle', $item ? 'Perbarui informasi akun social media' : 'Tambahkan akun social media baru')

@section('content')
<div class="page-header">
  <div><h1>{{ $item ? 'Edit: '.$item->name : 'Social Media Baru' }}</h1></div>
  <a href="{{ route('admin.sosmed.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if($errors->any())
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
@endif

<form method="POST"
      action="{{ $item ? route('admin.sosmed.update', $item) : route('admin.sosmed.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($item) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

    {{-- ===== KOLOM KIRI ===== --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      <div class="card">
        <div class="card-header"><h2>Informasi Akun</h2></div>
        <div class="card-body form-grid">

          <div class="form-group" style="grid-column:1/-1">
            <label>Nama Akun <span class="required">*</span></label>
            <input type="text" name="name" id="namaInput" class="form-control" required
                   value="{{ old('name', $item->name ?? '') }}"
                   placeholder="Contoh: Instagram Mendelem, YouTube SAGUM...">
          </div>

          <div class="form-group">
            <label>Platform <span class="required">*</span></label>
            <select name="platform" id="platformSelect" class="form-control" onchange="onPlatformChange()">
              @foreach(['instagram','youtube','facebook','tiktok','twitter','whatsapp','telegram','linkedin','website'] as $p)
              <option value="{{ $p }}" {{ old('platform', $item->platform ?? 'instagram') === $p ? 'selected' : '' }}>
                {{ ucfirst($p) }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Warna Accent</label>
            <div style="display:flex;gap:.5rem;align-items:center">
              <input type="color" name="color" id="colorPicker"
                     value="{{ old('color', $item->color ?? '#e1306c') }}"
                     style="width:48px;height:38px;border-radius:8px;border:1px solid var(--border);cursor:pointer;padding:2px"
                     oninput="onColorChange(this.value)">
              <input type="text" id="colorText"
                     value="{{ old('color', $item->color ?? '#e1306c') }}"
                     style="flex:1;padding:.65rem 1rem;border-radius:8px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.88rem;font-family:monospace"
                     oninput="document.getElementById('colorPicker').value=this.value;onColorChange(this.value)">
            </div>
          </div>

          <div class="form-group" style="grid-column:1/-1">
            <label>URL Akun <span class="required">*</span></label>
            <input type="url" name="url" class="form-control" required
                   value="{{ old('url', $item->url ?? '') }}"
                   placeholder="https://www.instagram.com/mendelemproject">
          </div>

          <div class="form-group" style="grid-column:1/-1">
            <label>Deskripsi Singkat</label>
            <textarea name="description" class="form-control" rows="2"
                      placeholder="Deskripsi singkat akun ini...">{{ old('description', $item->description ?? '') }}</textarea>
          </div>

        </div>
      </div>

      {{-- ===== PREVIEW KONTEN (hanya saat edit) ===== --}}
      @if($item)
      <div class="card">
        <div class="card-header">
          <h2>Preview Konten</h2>
          <small style="color:var(--text-muted);font-size:.78rem">Embed Instagram/YouTube atau upload gambar manual</small>
        </div>
        <div class="card-body">

          {{-- Existing previews --}}
          @if($item->previews && count($item->previews))
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.75rem;margin-bottom:1rem">
            @foreach($item->previews as $i => $prev)
            <div style="position:relative;border-radius:10px;overflow:hidden;border:1px solid var(--border);background:var(--bg2)" id="prev-item-{{ $i }}">
              @if(($prev['type'] ?? 'image') === 'embed')
                <div style="aspect-ratio:1;background:#111;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:.35rem;padding:.5rem">
                  @if(($prev['platform'] ?? '') === 'instagram')
                    <i class="fab fa-instagram" style="font-size:1.75rem;color:#e1306c"></i>
                  @elseif(($prev['platform'] ?? '') === 'youtube')
                    <i class="fab fa-youtube" style="font-size:1.75rem;color:#ff0000"></i>
                  @else
                    <i class="fas fa-code" style="font-size:1.75rem;color:#94a3b8"></i>
                  @endif
                  <span style="font-size:.65rem;color:#94a3b8;text-align:center">{{ ucfirst($prev['platform'] ?? 'Embed') }}</span>
                  @if(!empty($prev['caption']))
                  <span style="font-size:.6rem;color:#64748b;text-align:center">{{ Str::limit($prev['caption'],25) }}</span>
                  @endif
                </div>
                <div style="position:absolute;top:.3rem;left:.3rem;background:rgba(0,0,0,.7);color:#fff;font-size:.6rem;padding:.15rem .4rem;border-radius:4px">EMBED</div>
              @else
                <div style="aspect-ratio:1;overflow:hidden">
                  <img src="{{ asset('storage/'.$prev['image']) }}" style="width:100%;height:100%;object-fit:cover" alt="">
                </div>
              @endif
              <button type="button" onclick="deletePreview({{ $i }})"
                      style="position:absolute;top:.3rem;right:.3rem;width:26px;height:26px;border-radius:50%;background:rgba(220,38,38,.9);color:#fff;border:none;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-times"></i>
              </button>
            </div>
            @endforeach
          </div>
          @else
          <p style="font-size:.82rem;color:var(--text-muted);text-align:center;padding:.5rem;margin-bottom:.75rem">Belum ada preview.</p>
          @endif

          {{-- Tab: Embed vs Upload --}}
          <div style="display:flex;gap:.25rem;background:var(--bg2);border-radius:10px;padding:.25rem;margin-bottom:1rem">
            <button type="button" onclick="switchTab('embed')" id="tab-embed"
                    style="flex:1;padding:.5rem;border-radius:8px;border:none;cursor:pointer;font-size:.82rem;font-weight:700;background:var(--primary);color:#fff;transition:.2s">
              <i class="fab fa-instagram"></i> Embed URL
            </button>
            <button type="button" onclick="switchTab('image')" id="tab-image"
                    style="flex:1;padding:.5rem;border-radius:8px;border:none;cursor:pointer;font-size:.82rem;font-weight:600;background:transparent;color:var(--text-muted);transition:.2s">
              <i class="fas fa-image"></i> Upload Gambar
            </button>
          </div>

          {{-- Panel Embed --}}
          <div id="panel-embed">
            <div style="background:#0f172a;border-radius:10px;padding:1rem;margin-bottom:.75rem">
              <div style="font-size:.75rem;color:#94a3b8;margin-bottom:.4rem;font-weight:600">📌 CARA PAKAI:</div>
              <div style="font-size:.73rem;color:#94a3b8;line-height:1.7">
                1. Buka postingan Instagram/YouTube<br>
                2. Copy URL dari browser address bar<br>
                &nbsp;&nbsp;<code style="color:#60a5fa">instagram.com/p/ABC123/</code><br>
                3. Paste di bawah → klik Tambahkan
              </div>
            </div>
            <div class="form-group">
              <label style="font-size:.82rem">URL Postingan *</label>
              <input type="url" id="embedUrl" class="form-control" style="font-size:.85rem"
                     placeholder="https://www.instagram.com/p/ABC123/">
            </div>
            <div class="form-group">
              <label style="font-size:.82rem">Keterangan (opsional)</label>
              <input type="text" id="embedCaption" class="form-control" style="font-size:.85rem"
                     placeholder="Keterangan postingan...">
            </div>
            <button type="button" onclick="addEmbed()"
                    style="width:100%;padding:.65rem;border-radius:8px;border:none;background:var(--primary);color:#fff;font-weight:700;cursor:pointer;font-size:.85rem">
              <i class="fab fa-instagram"></i> Tambahkan Embed
            </button>
            <div id="embedStatus" style="display:none;margin-top:.5rem;font-size:.78rem;text-align:center;color:var(--text-muted)">Menyimpan...</div>
          </div>

          {{-- Panel Upload Gambar --}}
          <div id="panel-image" style="display:none">
            <div class="form-group">
              <label style="font-size:.82rem">Link saat diklik</label>
              <input type="url" id="prevLink" class="form-control" style="font-size:.85rem"
                     value="{{ $item->url }}" placeholder="{{ $item->url }}">
            </div>
            <div class="form-group">
              <label style="font-size:.82rem">Keterangan (opsional)</label>
              <input type="text" id="prevCaption" class="form-control" style="font-size:.85rem"
                     placeholder="Keterangan gambar...">
            </div>
            <div class="upload-zone" onclick="document.getElementById('prevFile').click()" style="padding:1rem">
              <i class="fas fa-image" style="font-size:1.3rem;color:var(--primary);display:block;margin-bottom:.3rem"></i>
              <p style="font-size:.82rem;font-weight:600">Pilih Gambar</p>
              <small style="color:var(--text-muted)">JPG, PNG, WEBP — maks. 5MB</small>
            </div>
            <input type="file" id="prevFile" accept="image/*" style="display:none" onchange="uploadImage(this)">
            <div id="imgStatus" style="display:none;margin-top:.5rem">
              <div style="height:4px;background:#e2e8f0;border-radius:2px">
                <div id="imgBar" style="height:100%;background:var(--primary);width:0%;transition:width .3s;border-radius:2px"></div>
              </div>
              <p style="font-size:.75rem;color:var(--text-muted);margin-top:.25rem">Mengupload...</p>
            </div>
          </div>

        </div>
      </div>
      @else
      <div class="card">
        <div class="card-body" style="text-align:center;padding:1.5rem;color:var(--text-muted)">
          <i class="fas fa-images" style="font-size:1.5rem;display:block;margin-bottom:.5rem;color:var(--primary)"></i>
          <p style="font-size:.88rem">Simpan dulu, lalu tambahkan gambar/embed preview.</p>
        </div>
      </div>
      @endif

    </div>

    {{-- ===== KOLOM KANAN ===== --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      {{-- Pengaturan --}}
      <div class="card">
        <div class="card-header"><h2>Pengaturan</h2></div>
        <div class="card-body">
          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="order" class="form-control" min="0"
                   value="{{ old('order', $item->order ?? 0) }}">
            <small style="color:var(--text-muted);font-size:.78rem">Angka kecil tampil lebih awal</small>
          </div>
          <div class="form-check" style="margin:.75rem 0">
            <input type="checkbox" name="is_active" id="isActive"
                   {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
            <label for="isActive">Tampilkan di Website</label>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem">
            <i class="fas fa-save"></i> {{ $item ? 'Perbarui' : 'Simpan' }} Akun
          </button>
          @if($item)
          <a href="{{ $item->url }}" target="_blank"
             class="btn btn-outline" style="width:100%;justify-content:center;margin-top:.5rem;text-decoration:none">
            <i class="fas fa-external-link-alt"></i> Buka Akun
          </a>
          @endif
        </div>
      </div>

      {{-- Foto Cover --}}
      <div class="card">
        <div class="card-header"><h2>Foto Cover</h2></div>
        <div class="card-body">
          @if($item && $item->thumbnail)
          <div style="position:relative;margin-bottom:.75rem">
            <img src="{{ asset('storage/'.$item->thumbnail) }}"
                 style="width:100%;border-radius:10px;border:1px solid var(--border)" alt="">
            <form method="POST" action="{{ route('admin.sosmed.thumbnail.delete', $item) }}"
                  style="position:absolute;top:.4rem;right:.4rem"
                  onsubmit="return confirm('Hapus cover?')">
              @csrf @method('DELETE')
              <button type="submit"
                      style="background:rgba(220,38,38,.9);color:#fff;border:none;border-radius:7px;padding:.3rem .65rem;cursor:pointer;font-size:.75rem">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </form>
          </div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('thumbFile').click()">
            <i class="fas fa-image"></i>
            <p>{{ ($item && $item->thumbnail) ? 'Ganti Cover' : 'Upload Cover' }}</p>
            <small>JPG, PNG, WEBP — maks. 5MB</small>
          </div>
          <input type="file" id="thumbFile" name="thumbnail" accept="image/*"
                 style="display:none" onchange="previewThumb(this)">
          <div id="thumbPreview" style="margin-top:.75rem"></div>
        </div>
      </div>

      {{-- Preview Tampilan --}}
      <div class="card">
        <div class="card-header"><h2>Preview Tampilan</h2></div>
        <div class="card-body">
          @php
            $previewColor = old('color', $item->platform_color ?? '#e1306c');
            $previewIcon  = old('icon',  $item->platform_icon  ?? 'fab fa-instagram');
            $previewName  = old('name',  $item->name           ?? 'Nama Akun');
            $previewPlat  = old('platform', $item->platform    ?? 'instagram');
          @endphp
          <div id="cardPreview" style="background:var(--bg2);border-radius:12px;padding:1.25rem;display:flex;flex-direction:column;align-items:center;gap:.75rem;text-align:center;border:2px solid {{ $previewColor }}33">
            <div id="prevIconBox" style="width:56px;height:56px;border-radius:14px;background:{{ $previewColor }}22;display:flex;align-items:center;justify-content:center">
              <i id="prevIcon" class="{{ $previewIcon }}" style="font-size:1.6rem;color:{{ $previewColor }}"></i>
            </div>
            <div>
              <div id="prevName" style="font-weight:700;font-size:.9rem">{{ $previewName }}</div>
              <div id="prevPlatform" style="font-size:.75rem;color:var(--text-muted)">{{ ucfirst($previewPlat) }}</div>
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

function onPlatformChange() {
  const p = document.getElementById('platformSelect').value;
  const color = platformColors[p] || '#0f75bd';
  const icon  = platformIcons[p] || 'fas fa-globe';
  document.getElementById('prevIcon').className = icon;
  document.getElementById('prevIcon').style.color = color;
  document.getElementById('prevIconBox').style.background = color + '22';
  document.getElementById('prevPlatform').textContent = p.charAt(0).toUpperCase() + p.slice(1);
  document.getElementById('colorPicker').value = color;
  document.getElementById('colorText').value = color;
  document.getElementById('cardPreview').style.borderColor = color + '33';
}

function onColorChange(val) {
  document.getElementById('prevIcon').style.color = val;
  document.getElementById('prevIconBox').style.background = val + '22';
  document.getElementById('cardPreview').style.borderColor = val + '33';
}

document.getElementById('namaInput')?.addEventListener('input', function() {
  document.getElementById('prevName').textContent = this.value || 'Nama Akun';
});

function previewThumb(input) {
  const p = document.getElementById('thumbPreview'); p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:10px;border:1px solid #e2e8f0';
    p.appendChild(img);
  }
}

function switchTab(tab) {
  const isEmbed = tab === 'embed';
  document.getElementById('panel-embed').style.display = isEmbed ? 'block' : 'none';
  document.getElementById('panel-image').style.display = isEmbed ? 'none' : 'block';
  const te = document.getElementById('tab-embed');
  const ti = document.getElementById('tab-image');
  te.style.background = isEmbed ? 'var(--primary)' : 'transparent';
  te.style.color = isEmbed ? '#fff' : 'var(--text-muted)';
  te.style.fontWeight = isEmbed ? '700' : '600';
  ti.style.background = isEmbed ? 'transparent' : 'var(--primary)';
  ti.style.color = isEmbed ? 'var(--text-muted)' : '#fff';
  ti.style.fontWeight = isEmbed ? '600' : '700';
}

@if($item)
function addEmbed() {
  const url     = document.getElementById('embedUrl').value.trim();
  const caption = document.getElementById('embedCaption').value.trim();
  if (!url) { alert('Masukkan URL postingan terlebih dahulu.'); return; }

  const status = document.getElementById('embedStatus');
  status.style.display = 'block';
  status.style.color   = 'var(--text-muted)';
  status.textContent   = 'Menyimpan embed...';

  const fd = new FormData();
  fd.append('type', 'embed');
  fd.append('embed_url', url);
  fd.append('caption', caption);
  fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);

  fetch('{{ route("admin.sosmed.preview.upload", $item) }}', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        status.textContent = '✅ Berhasil! Memuat ulang...';
        setTimeout(() => location.reload(), 700);
      } else {
        status.style.color  = '#e53e3e';
        status.textContent  = '❌ ' + (data.message || 'URL tidak dikenali. Coba URL postingan Instagram atau YouTube.');
        setTimeout(() => { status.style.display = 'none'; }, 5000);
      }
    })
    .catch(() => {
      status.style.color = '#e53e3e';
      status.textContent = '❌ Gagal. Periksa koneksi dan coba lagi.';
      setTimeout(() => { status.style.display = 'none'; }, 4000);
    });
}

function uploadImage(input) {
  if (!input.files[0]) return;
  const fd = new FormData();
  fd.append('type', 'image');
  fd.append('image', input.files[0]);
  fd.append('link', document.getElementById('prevLink').value || '{{ $item->url }}');
  fd.append('caption', document.getElementById('prevCaption').value || '');
  fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);

  document.getElementById('imgStatus').style.display = 'block';
  document.getElementById('imgBar').style.width = '40%';

  fetch('{{ route("admin.sosmed.preview.upload", $item) }}', { method: 'POST', body: fd })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        document.getElementById('imgBar').style.width = '100%';
        setTimeout(() => location.reload(), 400);
      } else {
        alert('Upload gagal.');
        document.getElementById('imgStatus').style.display = 'none';
      }
    })
    .catch(() => {
      alert('Upload gagal. Coba lagi.');
      document.getElementById('imgStatus').style.display = 'none';
    });
  input.value = '';
}

function deletePreview(index) {
  if (!confirm('Hapus preview ini?')) return;
  fetch('{{ url("admin/sosmed/".$item->id."/preview") }}/' + index, {
    method:  'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    }
  })
  .then(r => r.json())
  .then(d => {
    if (d.success) {
      const el = document.getElementById('prev-item-' + index);
      if (el) { el.style.opacity = '0'; el.style.transition = '.3s'; }
      setTimeout(() => location.reload(), 350);
    }
  });
}
@endif
</script>
@endpush
@endsection
