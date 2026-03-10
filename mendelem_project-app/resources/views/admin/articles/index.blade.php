@extends('layouts.admin')
@section('title','Kelola Artikel')
@section('page-title','Artikel')
@section('page-subtitle','Tulis dan kelola semua artikel/berita')

@section('content')
<div class="page-header">
  <div>
    <h1>Artikel & Berita</h1>
    <p>{{ $articles->total() }} artikel tersimpan</p>
  </div>
  <a href="{{ route('admin.articles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tulis Artikel Baru</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Judul</th>
          <th>Kategori</th>
          <th>Penulis</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($articles as $a)
        <tr>
          <td>
            <div class="thumb-sm">
              @if($a->thumbnail)
                <img src="{{ asset('storage/'.$a->thumbnail) }}" alt="">
              @else
                <i class="fas fa-newspaper"></i>
              @endif
            </div>
          </td>
          <td>
            <div style="font-weight:600;max-width:240px;font-size:.85rem">{{ $a->title_id }}</div>
            <div style="font-size:.75rem;color:#718096;margin-top:.15rem">{{ Str::limit($a->excerpt_id, 60) }}</div>
          </td>
          <td><span class="badge badge-blue">{{ $a->category_id ?? '-' }}</span></td>
          <td style="font-size:.82rem">{{ $a->author->name ?? '-' }}</td>
          <td>
            @if($a->status==='published') <span class="badge badge-green"><i class="fas fa-circle" style="font-size:.45rem"></i> Terbit</span>
            @elseif($a->status==='draft') <span class="badge badge-gray"><i class="fas fa-circle" style="font-size:.45rem"></i> Draft</span>
            @else <span class="badge badge-orange">Arsip</span>
            @endif
          </td>
          <td style="font-size:.78rem;color:#718096;white-space:nowrap">
            {{ $a->published_at ? $a->published_at->format('d M Y') : $a->created_at->format('d M Y') }}
          </td>
          <td>
            <div style="display:flex;gap:.35rem">
              <a href="{{ route('admin.articles.edit', $a) }}" class="btn btn-sm btn-outline btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
              @if($a->status !== 'published')
              <form method="POST" action="{{ route('admin.articles.publish', $a) }}" style="display:inline">
                @csrf <button type="submit" class="btn btn-sm btn-success btn-icon" title="Publikasi"><i class="fas fa-check"></i></button>
              </form>
              @else
              <form method="POST" action="{{ route('admin.articles.draft', $a) }}" style="display:inline">
                @csrf <button type="submit" class="btn btn-sm btn-outline btn-icon" title="Jadikan Draft"><i class="fas fa-archive"></i></button>
              </form>
              @endif
              <form method="POST" action="{{ route('admin.articles.destroy', $a) }}" style="display:inline" onsubmit="return confirm('Hapus artikel ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger btn-icon"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:3rem;color:#718096">Belum ada artikel. <a href="{{ route('admin.articles.create') }}">Tulis sekarang →</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($articles->hasPages())
  <div class="card-footer">{{ $articles->links() }}</div>
  @endif
</div>
@endsection
