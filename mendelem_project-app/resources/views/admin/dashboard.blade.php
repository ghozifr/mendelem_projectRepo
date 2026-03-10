{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-subtitle','Selamat datang di panel admin Mendelem Project')

@section('content')
{{-- Stats Grid --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-folder-open"></i></div>
    <div><div class="stat-num">{{ $stats['projects'] }}</div><div class="stat-lbl">Total Proyek</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green"><i class="fas fa-store"></i></div>
    <div><div class="stat-num">{{ $stats['products'] }}</div><div class="stat-lbl">Total Produk</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-newspaper"></i></div>
    <div><div class="stat-num">{{ $stats['published'] }}</div><div class="stat-lbl">Artikel Terbit</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon red"><i class="fas fa-envelope"></i></div>
    <div><div class="stat-num">{{ $stats['unread_msgs'] }}</div><div class="stat-lbl">Pesan Belum Dibaca</div></div>
  </div>
</div>

<div class="stats-grid" style="margin-top:.75rem">
  <div class="stat-card">
    <div class="stat-icon orange"><i class="fas fa-images"></i></div>
    <div><div class="stat-num">{{ $stats['sliders'] }}</div><div class="stat-lbl">Slider Aktif</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green"><i class="fas fa-photo-video"></i></div>
    <div><div class="stat-num">{{ $stats['gallery'] }}</div><div class="stat-lbl">Item Galeri</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
    <div><div class="stat-num">{{ $stats['team'] }}</div><div class="stat-lbl">Anggota Tim</div></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon orange"><i class="fas fa-newspaper"></i></div>
    <div><div class="stat-num">{{ $stats['articles'] }}</div><div class="stat-lbl">Total Artikel</div></div>
  </div>
</div>

{{-- Quick Actions --}}
<div class="card" style="margin-top:1.5rem">
  <div class="card-header"><h2><i class="fas fa-bolt" style="color:#d97706;margin-right:.4rem"></i> Aksi Cepat</h2></div>
  <div class="card-body" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.75rem">
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-plus"></i> Tambah Slider</a>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-plus"></i> Tulis Artikel</a>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-plus"></i> Tambah Proyek</a>
    <a href="{{ route('admin.products.create') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-plus"></i> Tambah Produk</a>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-upload"></i> Upload Galeri</a>
    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline" style="justify-content:flex-start"><i class="fas fa-cog"></i> Pengaturan</a>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-top:1.5rem">
  {{-- Recent Articles --}}
  <div class="card">
    <div class="card-header">
      <h2><i class="fas fa-newspaper" style="color:#0f75bd;margin-right:.4rem"></i> Artikel Terbaru</h2>
      <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline">Lihat Semua</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Judul</th><th>Status</th><th>Tanggal</th></tr></thead>
        <tbody>
          @forelse($recentArticles as $a)
          <tr>
            <td>
              <div style="font-weight:600;font-size:.83rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px">{{ $a->title_id }}</div>
              <div style="font-size:.75rem;color:#718096">{{ $a->category_id }}</div>
            </td>
            <td>
              @if($a->status==='published') <span class="badge badge-green">Terbit</span>
              @elseif($a->status==='draft') <span class="badge badge-gray">Draft</span>
              @else <span class="badge badge-orange">Arsip</span>
              @endif
            </td>
            <td style="font-size:.78rem;color:#718096;white-space:nowrap">{{ $a->created_at->format('d M Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;color:#718096;padding:2rem">Belum ada artikel</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Recent Messages --}}
  <div class="card">
    <div class="card-header">
      <h2><i class="fas fa-envelope" style="color:#e53e3e;margin-right:.4rem"></i> Pesan Terbaru</h2>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline">Lihat Semua</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Dari</th><th>Tujuan</th><th>Status</th></tr></thead>
        <tbody>
          @forelse($recentMessages as $m)
          <tr>
            <td>
              <div style="font-weight:600;font-size:.83rem">{{ $m->name }}</div>
              <div style="font-size:.75rem;color:#718096">{{ $m->email }}</div>
            </td>
            <td style="font-size:.8rem">{{ $m->purpose ?? '-' }}</td>
            <td>
              @if($m->status==='unread') <span class="badge badge-red">Baru</span>
              @else <span class="badge badge-gray">Dibaca</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center;color:#718096;padding:2rem">Belum ada pesan</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
