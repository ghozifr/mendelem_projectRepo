@extends('layouts.admin')
@section('title','Kelola Slider')
@section('page-title','Slider / Hero')
@section('page-subtitle','Kelola slide di halaman beranda')

@section('content')
<div class="page-header">
  <div>
    <h1>Daftar Slider</h1>
    <p>{{ $sliders->count() }} slider</p>
  </div>
  <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Slider
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Media</th>
          <th>Judul</th>
          <th>Tag</th>
          <th>Urutan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sliders as $slider)
        <tr>
          <td>
            <div class="thumb-sm">
              @if($slider->media_path)
                @if($slider->media_type === 'video')
                  <i class="fas fa-video" style="color:#0f75bd"></i>
                @else
                  <img src="{{ asset('storage/'.$slider->media_path) }}" alt="">
                @endif
              @else
                <i class="fas fa-image"></i>
              @endif
            </div>
          </td>
          <td>
            <div style="font-weight:600;font-size:.88rem">{{ $slider->title_id }}</div>
            <div style="font-size:.75rem;color:#718096">{{ Str::limit($slider->subtitle_id, 50) }}</div>
          </td>
          <td><span class="badge badge-blue">{{ $slider->tag_id ?? '-' }}</span></td>
          <td>{{ $slider->order }}</td>
          <td>
            @if($slider->is_active)
              <span class="badge badge-green">Aktif</span>
            @else
              <span class="badge badge-gray">Nonaktif</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:.35rem">
              <a href="{{ route('admin.sliders.edit', $slider) }}"
                 class="btn btn-sm btn-outline btn-icon">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST"
                    action="{{ route('admin.sliders.destroy', $slider) }}"
                    onsubmit="return confirm('Hapus slider ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger btn-icon">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:3rem;color:#718096">
            Belum ada slider.
            <a href="{{ route('admin.sliders.create') }}">Tambah sekarang →</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
