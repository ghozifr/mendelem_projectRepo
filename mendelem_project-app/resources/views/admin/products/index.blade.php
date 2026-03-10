@extends('layouts.admin')
@section('title','Kelola Produk')
@section('page-title','Produk')
@section('page-subtitle','Kelola semua produk Mendelem Project')

@section('content')
<div class="page-header">
  <div>
    <h1>Daftar Produk</h1>
    <p>{{ $products->count() }} produk</p>
  </div>
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Produk
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Ketersediaan</th>
          <th>Featured</th>
          <th>Aktif</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td>
            <div class="thumb-sm">
              @if($p->thumbnail)
                <img src="{{ asset('storage/'.$p->thumbnail) }}" alt="">
              @else
                <i class="{{ $p->icon }}" style="color:#8cc63e"></i>
              @endif
            </div>
          </td>
          <td>
            <div style="font-weight:700;font-size:.88rem">{{ $p->name_id }}</div>
            <div style="font-size:.75rem;color:#718096">{{ $p->name_en }}</div>
          </td>
          <td><span class="badge badge-green">{{ $p->category_id }}</span></td>
          <td>
            @if($p->availability === 'available')
              <span class="badge badge-green">Tersedia</span>
            @elseif($p->availability === 'seasonal')
              <span class="badge badge-orange">Musiman</span>
            @else
              <span class="badge badge-red">Habis</span>
            @endif
          </td>
          <td>
            @if($p->is_featured)
              <span class="badge badge-blue">⭐ Ya</span>
            @else
              <span class="badge badge-gray">Tidak</span>
            @endif
          </td>
          <td>
            @if($p->is_active)
              <span class="badge badge-green">Aktif</span>
            @else
              <span class="badge badge-gray">Nonaktif</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:.35rem">
              <a href="{{ route('admin.products.edit', $p) }}"
                 class="btn btn-sm btn-outline btn-icon" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST"
                    action="{{ route('admin.products.destroy', $p) }}"
                    onsubmit="return confirm('Hapus produk ini?')">
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
          <td colspan="7" style="text-align:center;padding:3rem;color:#718096">
            Belum ada produk.
            <a href="{{ route('admin.products.create') }}">Tambah sekarang →</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
