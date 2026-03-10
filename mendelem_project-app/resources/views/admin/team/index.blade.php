@extends('layouts.admin')
@section('title','Kelola Tim')
@section('page-title','Tim')
@section('page-subtitle','Kelola anggota tim Mendelem Project')

@section('content')
<div class="page-header">
  <div><h1>Anggota Tim</h1><p>{{ $members->count() }} anggota</p></div>
  <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Anggota
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        @forelse($members as $member)
        <tr>
          <td>
            <div class="thumb-sm">
              @if($member->photo)
                <img src="{{ asset('storage/'.$member->photo) }}" alt="">
              @else
                <i class="fas fa-user"></i>
              @endif
            </div>
          </td>
          <td><div style="font-weight:600;font-size:.88rem">{{ $member->name }}</div></td>
          <td><span class="badge badge-blue">{{ $member->role_id }}</span></td>
          <td>{{ $member->order }}</td>
          <td>
            @if($member->is_active)
              <span class="badge badge-green">Aktif</span>
            @else
              <span class="badge badge-gray">Nonaktif</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:.35rem">
              <a href="{{ route('admin.team.edit', $member) }}"
                 class="btn btn-sm btn-outline btn-icon">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST"
                    action="{{ route('admin.team.destroy', $member) }}"
                    onsubmit="return confirm('Hapus anggota ini?')">
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
            Belum ada anggota tim.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
