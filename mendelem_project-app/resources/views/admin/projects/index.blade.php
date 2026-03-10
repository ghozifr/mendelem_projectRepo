@extends('layouts.admin')
@section('title','Kelola Proyek')
@section('page-title','Proyek')
@section('page-subtitle','Kelola semua proyek Mendelem Project')

@section('content')
<div class="page-header">
  <div>
    <h1>Daftar Proyek</h1>
    <p>{{ $projects->count() }} proyek</p>
  </div>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Proyek
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Nama</th>
          <th>Tag</th>
          <th>Anggota</th>
          <th>Status</th>
          <th>Urutan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($projects as $p)
        <tr>
          <td>
            <div class="thumb-sm" style="background:{{ $p->color }}22">
              @if($p->thumbnail)
                <img src="{{ asset('storage/'.$p->thumbnail) }}" alt="">
              @else
                <i class="{{ $p->icon }}" style="color:{{ $p->color }}"></i>
              @endif
            </div>
          </td>
          <td>
            <div style="font-weight:700;font-size:.88rem">{{ $p->name_id }}</div>
            <div style="font-size:.75rem;color:#718096">{{ Str::limit($p->short_desc_id, 50) }}</div>
          </td>
          <td><span class="badge badge-blue">{{ $p->tag_id }}</span></td>
          <td>{{ $p->members_count }}</td>
          <td>
            @if($p->status === 'active')
              <span class="badge badge-green">Aktif</span>
            @elseif($p->status === 'planned')
              <span class="badge badge-orange">Rencana</span>
            @else
              <span class="badge badge-gray">Nonaktif</span>
            @endif
          </td>
          <td>{{ $p->order }}</td>
          <td>
            <div style="display:flex;gap:.35rem">
              <a href="{{ route('admin.projects.edit', $p) }}"
                 class="btn btn-sm btn-outline btn-icon" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST"
                    action="{{ route('admin.projects.destroy', $p) }}"
                    onsubmit="return confirm('Hapus proyek ini?')">
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
            Belum ada proyek.
            <a href="{{ route('admin.projects.create') }}">Tambah sekarang →</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
