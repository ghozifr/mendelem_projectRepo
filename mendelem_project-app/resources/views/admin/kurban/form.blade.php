@extends('layouts.admin')
@section('title', $animal ? 'Edit Hewan Kurban' : 'Tambah Hewan Kurban')
@section('page-title', $animal ? 'Edit Hewan Kurban' : 'Tambah Hewan Kurban')
@section('page-subtitle', $animal ? 'Perbarui data hewan kurban' : 'Isi data hewan kurban baru')

@section('content')
<div class="page-header">
  <div><h1>{{ $animal ? 'Edit: '.($animal->name ?? 'Hewan #'.$animal->id) : 'Hewan Baru' }}</h1></div>
  <a href="{{ route('admin.kurban.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

@if($errors->any())
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
@endif

@php
$gradeData = [
  'A' => ['berat'=>'45–50 kg','harga'=>'Rp5.250.000','color'=>'#c0392b'],
  'B' => ['berat'=>'41–45 kg','harga'=>'Rp4.750.000','color'=>'#e67e22'],
  'C' => ['berat'=>'36–40 kg','harga'=>'Rp4.250.000','color'=>'#f39c12'],
  'D' => ['berat'=>'31–35 kg','harga'=>'Rp3.750.000','color'=>'#27ae60'],
  'E' => ['berat'=>'26–30 kg','harga'=>'Rp3.250.000','color'=>'#2980b9'],
  'F' => ['berat'=>'24–25 kg','harga'=>'Rp2.750.000','color'=>'#8e44ad'],
  'G' => ['berat'=>'20–23 kg','harga'=>'Rp2.550.000','color'=>'#7f8c8d'],
  'H' => ['berat'=>'18–20 kg','harga'=>2250000,'color'=>'#95a5a6'],
];
@endphp

<form method="POST"
      action="{{ $animal ? route('admin.kurban.update', $animal) : route('admin.kurban.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($animal) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

    {{-- ===== KOLOM KIRI ===== --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      {{-- IDENTITAS --}}
      <div class="card">
        <div class="card-header"><h2>Identitas Hewan</h2></div>
        <div class="card-body form-grid">

          {{-- Kode & Nama --}}
          <div class="form-group">
            <label>Kode Hewan <span style="font-size:.75rem;color:var(--text-muted)">(ID unik)</span></label>
            <input type="text" name="kode" class="form-control"
                   value="{{ old('kode', $animal->kode ?? '') }}"
                   placeholder="Contoh: K001, D005"
                   style="font-family:monospace;font-weight:700;letter-spacing:.05em">
            <small style="color:var(--text-muted);font-size:.78rem">Kode unik untuk identifikasi — tampil di kartu hewan</small>
          </div>

          <div class="form-group">
            <label>Nama Hewan <span style="font-size:.75rem;color:var(--text-muted)">(opsional)</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $animal->name ?? '') }}"
                   placeholder="Contoh: Kambing Jantan Besar">
          </div>

          {{-- Grade --}}
          <div class="form-group" style="grid-column:1/-1">
            <label>Grade <span class="required">*</span></label>
            <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:.5rem;margin-top:.25rem">
              @foreach($gradeData as $g => $info)
              @php $selected = old('grade', $animal->grade ?? '') === $g; @endphp
              <label style="display:flex;flex-direction:column;align-items:center;gap:.3rem;padding:.6rem .3rem;border:2px solid {{ $selected ? $info['color'] : 'var(--border)' }};border-radius:10px;cursor:pointer;background:{{ $selected ? $info['color'].'18' : 'var(--card)' }};transition:all .2s;text-align:center"
                     id="grade-label-{{ $g }}" onmouseover="this.style.borderColor='{{ $info['color'] }}'" onmouseout="resetGradeHover('{{ $g }}')">
                <input type="radio" name="grade" value="{{ $g }}" {{ $selected ? 'checked' : '' }}
                       onchange="updateGradeStyle()" style="display:none">
                <span style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:900;color:{{ $selected ? $info['color'] : 'var(--text)' }}" id="grade-letter-{{ $g }}">{{ $g }}</span>
                <span style="font-size:.62rem;font-weight:700;color:{{ $selected ? $info['color'] : 'var(--text-muted)' }}" id="grade-berat-{{ $g }}">{{ $info['berat'] }}</span>
                <span style="font-size:.62rem;color:{{ $selected ? $info['color'] : 'var(--text-muted)' }}" id="grade-harga-{{ $g }}">{{ $info['harga'] }}</span>
              </label>
              @endforeach
            </div>
            {{-- Info grade terpilih --}}
            <div id="gradeInfo" style="margin-top:.6rem;padding:.65rem 1rem;border-radius:8px;font-size:.83rem;display:{{ old('grade',$animal->grade??'') ? 'flex' : 'none' }};align-items:center;gap:.5rem;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d">
              <i class="fas fa-info-circle"></i>
              <span id="gradeInfoText">{{ old('grade',$animal->grade??'') ? 'Grade '.old('grade',$animal->grade??'').' — '.(old('grade',$animal->grade??'') ? ($gradeData[old('grade',$animal->grade??'')]['berat'].' · '.$gradeData[old('grade',$animal->grade??'')]['harga']) : '') : '' }}</span>
            </div>
          </div>

          {{-- Jenis & Kelamin --}}
          <div class="form-group">
            <label>Jenis Hewan <span class="required">*</span></label>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.25rem">
              <label style="display:flex;align-items:center;gap:.5rem;padding:.75rem;border:2px solid {{ old('jenis_hewan',$animal->jenis_hewan??'kambing')==='kambing'?'#16a34a':'var(--border)' }};border-radius:10px;cursor:pointer;background:{{ old('jenis_hewan',$animal->jenis_hewan??'kambing')==='kambing'?'#f0fdf4':'var(--card)' }};transition:all .2s" id="label-kambing">
                <input type="radio" name="jenis_hewan" value="kambing" {{ old('jenis_hewan',$animal->jenis_hewan??'kambing')==='kambing'?'checked':'' }} onchange="updateJenisStyle()">
                <span style="font-size:1.3rem">🐐</span><span style="font-weight:600;font-size:.88rem">Kambing</span>
              </label>
              <label style="display:flex;align-items:center;gap:.5rem;padding:.75rem;border:2px solid {{ old('jenis_hewan',$animal->jenis_hewan??'')==='domba'?'#7c3aed':'var(--border)' }};border-radius:10px;cursor:pointer;background:{{ old('jenis_hewan',$animal->jenis_hewan??'')==='domba'?'#f5f3ff':'var(--card)' }};transition:all .2s" id="label-domba">
                <input type="radio" name="jenis_hewan" value="domba" {{ old('jenis_hewan',$animal->jenis_hewan??'')==='domba'?'checked':'' }} onchange="updateJenisStyle()">
                <span style="font-size:1.3rem">🐑</span><span style="font-weight:600;font-size:.88rem">Domba</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label>Kelamin <span class="required">*</span></label>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-top:.25rem">
              <label style="display:flex;align-items:center;gap:.5rem;padding:.75rem;border:2px solid {{ old('kelamin',$animal->kelamin??'jantan')==='jantan'?'#2563eb':'var(--border)' }};border-radius:10px;cursor:pointer;background:{{ old('kelamin',$animal->kelamin??'jantan')==='jantan'?'#eff6ff':'var(--card)' }};transition:all .2s" id="label-jantan">
                <input type="radio" name="kelamin" value="jantan" {{ old('kelamin',$animal->kelamin??'jantan')==='jantan'?'checked':'' }} onchange="updateKelaminStyle()">
                <span style="font-size:1.2rem">♂</span><span style="font-weight:600;font-size:.88rem;color:#2563eb">Jantan</span>
              </label>
              <label style="display:flex;align-items:center;gap:.5rem;padding:.75rem;border:2px solid {{ old('kelamin',$animal->kelamin??'')==='betina'?'#db2777':'var(--border)' }};border-radius:10px;cursor:pointer;background:{{ old('kelamin',$animal->kelamin??'')==='betina'?'#fdf2f8':'var(--card)' }};transition:all .2s" id="label-betina">
                <input type="radio" name="kelamin" value="betina" {{ old('kelamin',$animal->kelamin??'')==='betina'?'checked':'' }} onchange="updateKelaminStyle()">
                <span style="font-size:1.2rem">♀</span><span style="font-weight:600;font-size:.88rem;color:#db2777">Betina</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label>Jenis / Ras</label>
            <input type="text" name="jenis_ras" class="form-control" list="ras-list"
                   value="{{ old('jenis_ras',$animal->jenis_ras??'') }}"
                   placeholder="Jawa, PE, Boer, Garut...">
            <datalist id="ras-list">
              <option>Kambing Jawa</option><option>Kambing PE (Peranakan Etawah)</option>
              <option>Kambing Boer</option><option>Kambing Kacang</option>
              <option>Domba Garut</option><option>Domba Merino</option>
              <option>Domba Ekor Gemuk</option><option>Domba Priangan</option>
            </datalist>
          </div>

          <div class="form-group">
            <label>Berat Estimasi (kg)</label>
            <input type="number" name="berat_kg" class="form-control" step="0.1" min="0"
                   value="{{ old('berat_kg',$animal->berat_kg??'') }}" placeholder="Contoh: 35.5">
          </div>

          <div class="form-group">
            <label>Umur</label>
            <input type="text" name="umur" class="form-control"
                   value="{{ old('umur',$animal->umur??'') }}" placeholder="Contoh: 1.5 tahun">
          </div>

          <div class="form-group">
            <label>Harga (Rp) <span class="required">*</span></label>
            <input type="number" name="harga" id="hargaInput" class="form-control" min="0" required
                   value="{{ old('harga',$animal->harga??'') }}" placeholder="Contoh: 2550000">
            <small id="hargaHint" style="color:var(--primary);font-size:.82rem;display:{{ old('harga',$animal->harga??null)?'block':'none' }}">
              = Rp {{ number_format(old('harga',$animal->harga??0),0,',','.') }}
            </small>
          </div>

          <div class="form-group" style="grid-column:1/-1">
            <label>Catatan / Deskripsi</label>
            <textarea name="catatan" class="form-control" rows="3"
                      placeholder="Kondisi hewan, keunggulan, info tambahan...">{{ old('catatan',$animal->catatan??'') }}</textarea>
          </div>

          <div class="form-group">
            <label>No. WhatsApp Kontak</label>
            <input type="text" name="whatsapp_number" class="form-control"
                   value="{{ old('whatsapp_number',$animal->whatsapp_number??'') }}"
                   placeholder="628123456789">
            <small style="color:var(--text-muted);font-size:.78rem">Format internasional tanpa + atau spasi</small>
          </div>

        </div>
      </div>

      {{-- GALERI (hanya saat edit) --}}
      @if($animal)
      <div class="card">
        <div class="card-header">
          <h2>Galeri Foto & Video</h2>
          <small style="color:var(--text-muted);font-size:.8rem">Foto & video tambahan halaman detail</small>
        </div>
        <div class="card-body">
          @if($animal->media && count($animal->media) > 0)
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:.75rem;margin-bottom:1rem" id="mediaGrid">
            @foreach($animal->media as $i => $m)
            <div style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:1;background:#f0f4f8;border:1px solid var(--border)" id="media-item-{{ $i }}">
              @if($m['type']==='video')
                <video src="{{ asset('storage/'.$m['path']) }}" style="width:100%;height:100%;object-fit:cover" preload="metadata"></video>
                <div style="position:absolute;top:.3rem;left:.3rem;background:rgba(0,0,0,.65);color:#fff;font-size:.65rem;padding:.15rem .4rem;border-radius:4px"><i class="fas fa-video"></i></div>
              @else
                <img src="{{ asset('storage/'.$m['path']) }}" style="width:100%;height:100%;object-fit:cover" alt="">
              @endif
              <button type="button" onclick="deleteMedia({{ $i }}, this)"
                      style="position:absolute;top:.3rem;right:.3rem;width:26px;height:26px;border-radius:50%;background:rgba(220,38,38,.9);color:#fff;border:none;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-times"></i>
              </button>
            </div>
            @endforeach
          </div>
          @else
          <p style="font-size:.83rem;color:var(--text-muted);text-align:center;padding:.75rem">Belum ada media tambahan.</p>
          @endif

          <div class="upload-zone" id="mediaZone" onclick="document.getElementById('mediaFile').click()" style="padding:1rem">
            <i class="fas fa-cloud-upload-alt" style="font-size:1.5rem;color:var(--primary);display:block;margin-bottom:.35rem"></i>
            <p style="font-size:.83rem;font-weight:600">Upload Foto / Video</p>
            <small style="color:var(--text-muted)">JPG, PNG, WEBP, MP4 — maks. 100MB</small>
          </div>
          <input type="file" id="mediaFile" accept="image/*,video/mp4,video/webm,video/quicktime" style="display:none" onchange="uploadMedia(this)">
          <div id="uploadStatus" style="display:none;margin-top:.75rem">
            <div style="height:6px;background:#e2e8f0;border-radius:3px;overflow:hidden">
              <div id="uploadBar" style="height:100%;background:var(--primary);width:0%;transition:width .3s;border-radius:3px"></div>
            </div>
            <p id="uploadText" style="font-size:.78rem;color:var(--text-muted);margin-top:.35rem">Mengupload...</p>
          </div>
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
            <label>Status <span class="required">*</span></label>
            <select name="status" class="form-control">
              <option value="tersedia" {{ old('status',$animal->status??'tersedia')==='tersedia'?'selected':'' }}>✅ Tersedia</option>
              <option value="dipesan" {{ old('status',$animal->status??'')==='dipesan'?'selected':'' }}>⏳ Sedang Dipesan</option>
              <option value="terjual" {{ old('status',$animal->status??'')==='terjual'?'selected':'' }}>❌ Sudah Terjual</option>
            </select>
          </div>
          <div class="form-check" style="margin:.75rem 0">
            <input type="checkbox" name="is_active" id="isActive"
                   {{ old('is_active',$animal->is_active??true)?'checked':'' }}>
            <label for="isActive">Tampilkan di Website</label>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem">
            <i class="fas fa-save"></i> {{ $animal ? 'Perbarui' : 'Simpan' }} Hewan
          </button>
          @if($animal)
          <a href="{{ route('kurban.show',$animal) }}" target="_blank"
             class="btn btn-outline" style="width:100%;justify-content:center;margin-top:.5rem;text-decoration:none">
            <i class="fas fa-external-link-alt"></i> Lihat di Website
          </a>
          @endif
        </div>
      </div>

      {{-- Foto Utama --}}
      <div class="card">
        <div class="card-header"><h2>Foto Utama</h2></div>
        <div class="card-body">
          @if($animal && $animal->thumbnail)
          <div style="position:relative;margin-bottom:.75rem">
            <img src="{{ asset('storage/'.$animal->thumbnail) }}"
                 style="width:100%;border-radius:10px;border:1px solid var(--border)" alt="">
            <form method="POST" action="{{ route('admin.kurban.thumbnail.delete',$animal) }}"
                  style="position:absolute;top:.4rem;right:.4rem"
                  onsubmit="return confirm('Hapus foto utama?')">
              @csrf @method('DELETE')
              <button type="submit"
                      style="background:rgba(220,38,38,.9);color:#fff;border:none;border-radius:7px;padding:.3rem .65rem;cursor:pointer;font-size:.75rem;font-weight:600">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </form>
          </div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('thumbFile').click()">
            <i class="fas fa-camera"></i>
            <p>{{ ($animal && $animal->thumbnail) ? 'Ganti foto utama' : 'Upload foto utama' }}</p>
            <small>JPG, PNG, WEBP — maks. 5MB</small>
          </div>
          <input type="file" id="thumbFile" name="thumbnail" accept="image/*"
                 style="display:none" onchange="previewThumb(this)">
          <div id="thumbPreview" style="margin-top:.75rem"></div>
        </div>
      </div>

      {{-- Tabel referensi grade --}}
      <div class="card">
        <div class="card-header"><h2>Referensi Grade</h2></div>
        <div class="card-body" style="padding:.75rem">
          @foreach($gradeData as $g => $info)
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.45rem .6rem;border-radius:7px;margin-bottom:.25rem;background:var(--bg2)">
            <span style="font-weight:800;font-size:.85rem;color:{{ $info['color'] }};width:22px">{{ $g }}</span>
            <span style="font-size:.77rem;color:var(--text2);flex:1;padding:0 .5rem">{{ $info['berat'] }}</span>
            <span style="font-size:.77rem;font-weight:700;color:var(--text)">{{ $info['harga'] }}</span>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</form>

@push('scripts')
<script>
const gradeData = @json($gradeData);

function updateGradeStyle() {
  const selected = document.querySelector('input[name="grade"]:checked')?.value;
  Object.keys(gradeData).forEach(g => {
    const lbl = document.getElementById('grade-label-' + g);
    const info = gradeData[g];
    const isSelected = g === selected;
    lbl.style.borderColor  = isSelected ? info.color : 'var(--border)';
    lbl.style.background   = isSelected ? info.color + '18' : 'var(--card)';
    document.getElementById('grade-letter-' + g).style.color = isSelected ? info.color : 'var(--text)';
    document.getElementById('grade-berat-' + g).style.color  = isSelected ? info.color : 'var(--text-muted)';
    document.getElementById('grade-harga-' + g).style.color  = isSelected ? info.color : 'var(--text-muted)';
  });
  const infoBox  = document.getElementById('gradeInfo');
  const infoText = document.getElementById('gradeInfoText');
  if (selected && gradeData[selected]) {
    infoBox.style.display = 'flex';
    infoBox.style.borderColor = gradeData[selected].color + '66';
    infoBox.style.color = gradeData[selected].color;
    infoBox.style.background = gradeData[selected].color + '12';
    infoText.textContent = 'Grade ' + selected + ' — ' + gradeData[selected].berat + ' · ' + gradeData[selected].harga;
    // Auto-fill harga jika belum diisi
    const hargaInput = document.getElementById('hargaInput');
    if (!hargaInput.value || hargaInput.value === '0') {
      const hargaNum = gradeData[selected].harga;
      hargaInput.value = hargaNum;
      document.getElementById('hargaHint').textContent = '= Rp ' + hargaNum.toLocaleString('id-ID');
      document.getElementById('hargaHint').style.display = 'block';
    }
  } else {
    infoBox.style.display = 'none';
  }
}

function resetGradeHover(g) {
  const selected = document.querySelector('input[name="grade"]:checked')?.value;
  const lbl = document.getElementById('grade-label-' + g);
  if (g !== selected) {
    lbl.style.borderColor = 'var(--border)';
  }
}

function previewThumb(input) {
  const p = document.getElementById('thumbPreview'); p.innerHTML = '';
  if (input.files[0]) {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(input.files[0]);
    img.style.cssText = 'width:100%;border-radius:10px;border:1px solid #e2e8f0';
    p.appendChild(img);
  }
}

function updateJenisStyle() {
  const isK = document.querySelector('input[name="jenis_hewan"]:checked')?.value === 'kambing';
  const lk = document.getElementById('label-kambing'), ld = document.getElementById('label-domba');
  lk.style.borderColor = isK ? '#16a34a' : 'var(--border)'; lk.style.background = isK ? '#f0fdf4' : 'var(--card)';
  ld.style.borderColor = !isK ? '#7c3aed' : 'var(--border)'; ld.style.background = !isK ? '#f5f3ff' : 'var(--card)';
}

function updateKelaminStyle() {
  const isJ = document.querySelector('input[name="kelamin"]:checked')?.value === 'jantan';
  const lj = document.getElementById('label-jantan'), lb = document.getElementById('label-betina');
  lj.style.borderColor = isJ ? '#2563eb' : 'var(--border)'; lj.style.background = isJ ? '#eff6ff' : 'var(--card)';
  lb.style.borderColor = !isJ ? '#db2777' : 'var(--border)'; lb.style.background = !isJ ? '#fdf2f8' : 'var(--card)';
}

document.getElementById('hargaInput')?.addEventListener('input', function() {
  const val = parseInt(this.value);
  const hint = document.getElementById('hargaHint');
  if (!isNaN(val) && val > 0) {
    hint.textContent = '= Rp ' + val.toLocaleString('id-ID');
    hint.style.display = 'block';
  } else hint.style.display = 'none';
});

@if($animal)
function uploadMedia(input) {
  if (!input.files[0]) return;
  const fd = new FormData();
  fd.append('file', input.files[0]);
  fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);
  document.getElementById('uploadStatus').style.display = 'block';
  document.getElementById('uploadBar').style.width = '30%';
  document.getElementById('uploadText').textContent = 'Mengupload ' + input.files[0].name + '...';
  fetch('{{ route("admin.kurban.media.upload",$animal) }}', { method:'POST', body:fd })
    .then(r => r.json())
    .then(data => {
      document.getElementById('uploadBar').style.width = '100%';
      if (data.success) { document.getElementById('uploadText').textContent = 'Berhasil!'; setTimeout(() => location.reload(), 500); }
      else { document.getElementById('uploadText').textContent = 'Upload gagal.'; }
    }).catch(() => { document.getElementById('uploadStatus').style.display = 'none'; alert('Upload gagal.'); });
  input.value = '';
}

function deleteMedia(index) {
  if (!confirm('Hapus media ini?')) return;
  fetch('{{ url("admin/kurban/".$animal->id."/media") }}/' + index, {
    method:'DELETE',
    headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Accept':'application/json'}
  }).then(r=>r.json()).then(d => {
    if (d.success) { const el = document.getElementById('media-item-'+index); if(el){el.style.opacity='0';el.style.transition='.3s';setTimeout(()=>location.reload(),400);} }
    else alert('Gagal menghapus.');
  });
}
const zone = document.getElementById('mediaZone');
if (zone) {
  zone.addEventListener('dragover', e=>{e.preventDefault();zone.style.borderColor='var(--primary)';});
  zone.addEventListener('dragleave', ()=>{zone.style.borderColor='';});
  zone.addEventListener('drop', e=>{e.preventDefault();zone.style.borderColor='';const dt=new DataTransfer();Array.from(e.dataTransfer.files).forEach(f=>dt.items.add(f));const inp=document.getElementById('mediaFile');inp.files=dt.files;uploadMedia(inp);});
}
@endif
</script>
@endpush
@endsection
