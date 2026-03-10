@extends('layouts.admin')
@section('title', $slider ? 'Edit Slider' : 'Tambah Slider')
@section('page-title', $slider ? 'Edit Slider' : 'Tambah Slider Baru')
@section('content')
<div class="page-header">
  <div><h1>{{ $slider ? 'Edit Slider' : 'Slider Baru' }}</h1></div>
  <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<form method="POST" action="{{ $slider ? route('admin.sliders.update',$slider) : route('admin.sliders.store') }}" enctype="multipart/form-data">
  @csrf @if($slider) @method('PUT') @endif
  <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">
    <div style="display:flex;flex-direction:column;gap:1.25rem">

      <div class="card">
        <div class="card-header"><h2>Teks Slider</h2></div>
        <div class="card-body form-grid">
          <div class="form-group"><label>Tag/Label (ID)</label><input type="text" name="tag_id" id="tag_id" class="form-control" value="{{ old('tag_id',$slider->tag_id??'') }}" placeholder="Selamat Datang, Proyek Kami..."></div>
          <div class="form-group translate-group"><label>Tag/Label (EN)</label><input type="text" name="tag_en" id="tag_en" class="form-control" value="{{ old('tag_en',$slider->tag_en??'') }}" placeholder="Welcome, Our Projects..."><button type="button" class="translate-btn" onclick="autoTranslate('tag_id','tag_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
          <div class="form-group"><label>Judul (ID) <span class="required">*</span></label><input type="text" name="title_id" id="title_id" class="form-control" value="{{ old('title_id',$slider->title_id??'') }}" required placeholder="Judul utama slider..."></div>
          <div class="form-group translate-group"><label>Title (EN)</label><input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en',$slider->title_en??'') }}" placeholder="Main slide title..."><button type="button" class="translate-btn" onclick="autoTranslate('title_id','title_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
          <div class="form-group"><label>Subjudul (ID)</label><textarea name="subtitle_id" id="subtitle_id" class="form-control" rows="3" placeholder="Deskripsi pendek slider...">{{ old('subtitle_id',$slider->subtitle_id??'') }}</textarea></div>
          <div class="form-group translate-group"><label>Subtitle (EN)</label><textarea name="subtitle_en" id="subtitle_en" class="form-control" rows="3" placeholder="Short slide description...">{{ old('subtitle_en',$slider->subtitle_en??'') }}</textarea><button type="button" class="translate-btn" onclick="autoTranslate('subtitle_id','subtitle_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h2>Tombol CTA</h2></div>
        <div class="card-body form-grid">
          <div class="form-group"><label>Tombol Utama Label (ID)</label><input type="text" name="btn_primary_label_id" id="btn_pl_id" class="form-control" value="{{ old('btn_primary_label_id',$slider->btn_primary_label_id??'') }}" placeholder="Jelajahi Proyek"></div>
          <div class="form-group translate-group"><label>Primary Button Label (EN)</label><input type="text" name="btn_primary_label_en" id="btn_pl_en" class="form-control" value="{{ old('btn_primary_label_en',$slider->btn_primary_label_en??'') }}" placeholder="Explore Projects"><button type="button" class="translate-btn" onclick="autoTranslate('btn_pl_id','btn_pl_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
          <div class="form-group"><label>Tombol Utama URL</label><input type="text" name="btn_primary_url" class="form-control" value="{{ old('btn_primary_url',$slider->btn_primary_url??'') }}" placeholder="/projects"></div>
          <div class="form-group"><label>Tombol Sekunder Label (ID)</label><input type="text" name="btn_secondary_label_id" id="btn_sl_id" class="form-control" value="{{ old('btn_secondary_label_id',$slider->btn_secondary_label_id??'') }}" placeholder="Tentang Kami (opsional)"></div>
          <div class="form-group translate-group"><label>Secondary Button Label (EN)</label><input type="text" name="btn_secondary_label_en" id="btn_sl_en" class="form-control" value="{{ old('btn_secondary_label_en',$slider->btn_secondary_label_en??'') }}" placeholder="About Us (optional)"><button type="button" class="translate-btn" onclick="autoTranslate('btn_sl_id','btn_sl_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
          <div class="form-group"><label>Tombol Sekunder URL</label><input type="text" name="btn_secondary_url" class="form-control" value="{{ old('btn_secondary_url',$slider->btn_secondary_url??'') }}" placeholder="/about"></div>
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:1.25rem">
      <div class="card">
        <div class="card-header"><h2>Pengaturan</h2></div>
        <div class="card-body">
          <div class="form-group"><label>Tipe Media</label><select name="media_type" id="mediaType" class="form-control" onchange="toggleMediaType()"><option value="image" {{ old('media_type',$slider->media_type??'image')==='image'?'selected':'' }}>🖼️ Gambar</option><option value="video" {{ old('media_type',$slider->media_type??'')==='video'?'selected':'' }}>🎬 Video</option></select></div>
          <div class="form-group"><label>Urutan</label><input type="number" name="order" class="form-control" value="{{ old('order',$slider->order??0) }}" min="0"></div>
          <div class="form-check" style="margin:.5rem 0"><input type="checkbox" name="is_active" id="isActive" {{ old('is_active',$slider->is_active??true)?'checked':'' }}><label for="isActive">Slider aktif / ditampilkan</label></div>
          <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;justify-content:center"><i class="fas fa-save"></i> {{ $slider?'Perbarui':'Simpan' }} Slider</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h2>Upload Media</h2></div>
        <div class="card-body">
          @if($slider && $slider->media_path)
            @if($slider->media_type==='video')
              <video src="{{ asset('storage/'.$slider->media_path) }}" controls style="width:100%;border-radius:8px;margin-bottom:.75rem"></video>
            @else
              <img src="{{ asset('storage/'.$slider->media_path) }}" style="width:100%;border-radius:8px;margin-bottom:.75rem" alt="">
            @endif
            <div style="font-size:.75rem;color:#718096;margin-bottom:.75rem">Media saat ini. Upload baru untuk mengganti.</div>
          @endif
          <div class="upload-zone" onclick="document.getElementById('mediaFile').click()">
            <i class="fas fa-cloud-upload-alt"></i>
            <p id="uploadLabel">Klik untuk upload gambar/video</p>
            <small>JPG, PNG, WEBP, GIF, MP4, WEBM — maks. 50MB</small>
          </div>
          <input type="file" id="mediaFile" name="media_file" style="display:none" onchange="previewMedia(this)">
          <div id="mediaPreview" style="margin-top:.75rem"></div>
        </div>
      </div>
    </div>
  </div>
</form>

@push('scripts')
<script>
function toggleMediaType(){
  const t=document.getElementById('mediaType').value;
  document.getElementById('uploadLabel').textContent=t==='video'?'Klik untuk upload video':'Klik untuk upload gambar';
}
function previewMedia(input){
  const prev=document.getElementById('mediaPreview');
  prev.innerHTML='';
  if(input.files[0]){
    const url=URL.createObjectURL(input.files[0]);
    const el=input.files[0].type.startsWith('video')?document.createElement('video'):document.createElement('img');
    if(el.tagName==='VIDEO'){el.controls=true;}
    el.src=url; el.style.cssText='width:100%;border-radius:8px;border:1px solid #e2e8f0';
    prev.appendChild(el);
  }
}
</script>
@endpush
@endsection
