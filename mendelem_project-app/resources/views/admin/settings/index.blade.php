@extends('layouts.admin')
@section('title','Pengaturan Situs')
@section('page-title','Pengaturan')
@section('page-subtitle','Kelola informasi dan identitas website')

@section('content')

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if($errors->any())
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
@endif

<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

  {{-- Kolom Kiri: Informasi Situs --}}
  <div class="card">
    <div class="card-header"><h2>Informasi Situs</h2></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <div class="form-grid">
          <div class="form-group">
            <label>Nama Website</label>
            <input type="text" name="site_name" class="form-control"
                   value="{{ old('site_name', $settings['site_name'] ?? 'Mendelem Project') }}">
          </div>
          <div class="form-group">
            <label>Tagline</label>
            <input type="text" name="site_tagline" class="form-control"
                   value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Pemalang, Jawa Tengah') }}"
                   placeholder="Pemalang, Jawa Tengah">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="site_email" class="form-control"
                   value="{{ old('site_email', $settings['site_email'] ?? '') }}">
          </div>
          <div class="form-group">
            <label>Nomor WhatsApp (untuk tombol WA di produk kurban)</label>
            <input type="text" name="whatsapp_number" class="form-control"
                   value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}"
                   placeholder="6281234567890">
            <small style="color:var(--text-muted);font-size:.78rem">Format: 628xxx (tanpa + atau spasi)</small>
          </div>
          <div class="form-group" style="grid-column:1/-1">
            <label>Alamat</label>
            <input type="text" name="site_address" class="form-control"
                   value="{{ old('site_address', $settings['site_address'] ?? '') }}">
          </div>
        </div>

        <hr style="border:none;border-top:1px solid var(--border);margin:1.5rem 0">
        <h3 style="font-size:.9rem;font-weight:700;margin-bottom:1rem;color:var(--text)">Media Sosial</h3>
        <div class="form-grid">
          <div class="form-group">
            <label><i class="fab fa-facebook" style="color:#1877f2"></i> Facebook URL</label>
            <input type="text" name="facebook_url" class="form-control"
                   value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/...">
          </div>
          <div class="form-group">
            <label><i class="fab fa-instagram" style="color:#e1306c"></i> Instagram URL</label>
            <input type="text" name="instagram_url" class="form-control"
                   value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/...">
          </div>
          <div class="form-group">
            <label><i class="fab fa-youtube" style="color:#ff0000"></i> YouTube URL</label>
            <input type="text" name="youtube_url" class="form-control"
                   value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/...">
          </div>
          <div class="form-group">
            <label><i class="fab fa-whatsapp" style="color:#25d366"></i> WhatsApp URL</label>
            <input type="text" name="whatsapp_url" class="form-control"
                   value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? '') }}" placeholder="https://wa.me/628...">
          </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:.5rem">
          <i class="fas fa-save"></i> Simpan Pengaturan
        </button>
      </form>
    </div>
  </div>

  {{-- Kolom Kanan: Logo --}}
  <div style="display:flex;flex-direction:column;gap:1.25rem">
    <div class="card">
      <div class="card-header"><h2>Logo Website</h2></div>
      <div class="card-body">

        {{-- Preview Logo Saat Ini --}}
        <div style="margin-bottom:1.25rem">
          <div style="font-size:.82rem;font-weight:600;color:var(--text-muted);margin-bottom:.75rem;text-transform:uppercase;letter-spacing:.05em">
            Tampilan Saat Ini
          </div>
          {{-- Preview navbar logo --}}
          <div style="display:flex;align-items:center;gap:.75rem;background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.85rem 1.1rem">
            @php $logoPath = $settings['site_logo'] ?? null; @endphp
            <div style="width:40px;height:40px;background:linear-gradient(135deg,#0f75bd,#8cc63e);border-radius:10px;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0">
              @if($logoPath)
                <img src="{{ asset('storage/'.$logoPath) }}" style="width:100%;height:100%;object-fit:contain;padding:2px" alt="Logo">
              @else
                <span style="color:#fff;font-weight:900;font-size:1.1rem;font-family:'Playfair Display',serif">M</span>
              @endif
            </div>
            <div>
              <div style="font-weight:700;font-size:.9rem;color:var(--text)">{{ $settings['site_name'] ?? 'Mendelem Project' }}</div>
              <div style="font-size:.65rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em">{{ $settings['site_tagline'] ?? 'Pemalang, Jawa Tengah' }}</div>
            </div>
          </div>
        </div>

        {{-- Upload Logo Baru --}}
        <form method="POST" action="{{ route('admin.settings.logo') }}" enctype="multipart/form-data">
          @csrf
          <div class="upload-zone" onclick="document.getElementById('logoFile').click()" style="padding:1.25rem">
            <i class="fas fa-image" style="font-size:1.75rem;color:var(--primary);display:block;margin-bottom:.4rem"></i>
            <p style="font-weight:600;font-size:.88rem">{{ $logoPath ? 'Ganti Logo' : 'Upload Logo' }}</p>
            <small style="color:var(--text-muted)">PNG, JPG, WEBP, SVG<br>Rekomendasi: 200×200px, background transparan</small>
          </div>
          <input type="file" id="logoFile" name="logo" accept="image/*"
                 style="display:none" onchange="previewLogo(this)">
          <div id="logoPreview" style="margin:.75rem 0"></div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            <i class="fas fa-upload"></i> Upload Logo
          </button>
        </form>

        {{-- Hapus Logo --}}
        @if($logoPath)
        <form method="POST" action="{{ route('admin.settings.logo.delete') }}"
              onsubmit="return confirm('Hapus logo? Akan kembali ke inisial M.')" style="margin-top:.75rem">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-outline" style="width:100%;justify-content:center;color:#dc2626;border-color:#fecaca">
            <i class="fas fa-trash"></i> Hapus Logo (Kembali ke "M")
          </button>
        </form>
        @endif

        {{-- Tips --}}
        <div style="margin-top:1rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:.85rem;font-size:.78rem;color:#1e40af;line-height:1.6">
          <strong><i class="fas fa-lightbulb"></i> Tips Logo Terbaik:</strong><br>
          • Format PNG dengan background transparan<br>
          • Ukuran minimal 200×200 piksel<br>
          • Rasio 1:1 (kotak) untuk tampilan terbaik<br>
          • Maksimal ukuran file 2MB
        </div>
      </div>
    </div>
  </div>

</div>

@push('scripts')
<script>
function previewLogo(input) {
  const p = document.getElementById('logoPreview');
  p.innerHTML = '';
  if (input.files[0]) {
    const wrap = document.createElement('div');
    wrap.style.cssText = 'display:flex;align-items:center;gap:.75rem;background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:.75rem';
    const box = document.createElement('div');
    box.style.cssText = 'width:40px;height:40px;background:linear-gradient(135deg,#0f75bd,#8cc63e);border-radius:10px;overflow:hidden;flex-shrink:0';
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;height:100%;object-fit:contain;padding:2px';
    box.appendChild(img);
    const txt = document.createElement('span');
    txt.style.cssText = 'font-size:.82rem;color:var(--text-muted)';
    txt.textContent = 'Preview logo baru';
    wrap.appendChild(box);
    wrap.appendChild(txt);
    p.appendChild(wrap);
  }
}
</script>
@endpush
@endsection
