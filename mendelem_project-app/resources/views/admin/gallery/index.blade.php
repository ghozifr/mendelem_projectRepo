@extends('layouts.admin')
@section('title','Kelola Galeri')
@section('page-title','Galeri Foto & Video')
@section('page-subtitle','Upload dan kelola media galeri website')

@section('content')
<div class="page-header">
  <div><h1>Galeri Media</h1><p>{{ $items->total() }} item</p></div>
</div>

<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">
  {{-- Gallery Grid --}}
  <div class="card">
    <div class="card-header"><h2>Media Tersimpan</h2></div>
    <div class="card-body">
      @if($items->count())
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:.75rem">
        @foreach($items as $item)
        <div style="position:relative;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;aspect-ratio:1;background:#f0f4f8">
          @if($item->file_type==='video')
            <video src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover"></video>
            <div style="position:absolute;top:.3rem;left:.3rem;background:rgba(0,0,0,.6);color:#fff;font-size:.65rem;padding:.15rem .4rem;border-radius:4px"><i class="fas fa-video"></i></div>
          @else
            <img src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover" alt="{{ $item->title_id }}">
          @endif
          <div style="position:absolute;inset:0;background:rgba(0,0,0,0);transition:.2s" onmouseover="this.style.background='rgba(0,0,0,.4)'" onmouseout="this.style.background='rgba(0,0,0,0)'">
            <form method="POST" action="{{ route('admin.gallery.destroy',$item) }}" style="position:absolute;top:.3rem;right:.3rem" onsubmit="return confirm('Hapus file ini?')">
              @csrf @method('DELETE')
              <button type="submit" style="width:26px;height:26px;border-radius:50%;background:rgba(229,62,62,.9);color:#fff;border:none;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
          @if($item->title_id)
          <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.5);color:#fff;font-size:.7rem;padding:.25rem .4rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $item->title_id }}</div>
          @endif
        </div>
        @endforeach
      </div>
      <div style="margin-top:1rem">{{ $items->links() }}</div>
      @else
      <div style="text-align:center;padding:3rem;color:#718096">
        <i class="fas fa-images" style="font-size:3rem;opacity:.3;margin-bottom:1rem;display:block"></i>
        Belum ada media. Upload sekarang!
      </div>
      @endif
    </div>
  </div>

  {{-- Upload Form --}}
  <div class="card">
    <div class="card-header"><h2>Upload Media Baru</h2></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Keterangan / Judul</label>
          <input type="text" name="title_id" class="form-control" placeholder="Keterangan foto/video (opsional)">
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <input type="text" name="category" class="form-control" list="cat-gallery" placeholder="sagum, ternak-salam, general...">
          <datalist id="cat-gallery"><option>general</option><option>sagum</option><option>ternak-salam</option><option>warung-sate</option><option>budidaya-melon</option><option>cis-digitex</option></datalist>
        </div>
        <div class="upload-zone" id="galleryZone" onclick="document.getElementById('galleryFiles').click()">
          <i class="fas fa-cloud-upload-alt"></i>
          <p>Klik atau seret file ke sini</p>
          <small>JPG, PNG, WEBP, GIF, MP4, WEBM<br>Bisa pilih multiple — maks. 50MB/file</small>
        </div>
        <input type="file" id="galleryFiles" name="files[]" multiple accept="image/*,video/*" style="display:none">
        <div id="galleryPreview" class="preview-grid"></div>
        <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1rem;justify-content:center"><i class="fas fa-upload"></i> Upload Sekarang</button>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
setupUploadZone('galleryZone','galleryFiles','galleryPreview');
</script>
@endpush
@endsection
