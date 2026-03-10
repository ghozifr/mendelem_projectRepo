@extends('layouts.admin')
@section('title','Pesan Masuk')
@section('page-title','Pesan & Kontak')
@section('page-subtitle','Pesan yang dikirim melalui form kontak website')

@section('content')
<div class="card">
  <div class="card-header"><h2>Semua Pesan ({{ $messages->total() }})</h2></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Dari</th><th>Email</th><th>Tujuan</th><th>Pesan</th><th>Status</th><th>Waktu</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($messages as $m)
        <tr style="{{ $m->status==='unread'?'font-weight:600;background:rgba(15,117,189,.03)':'' }}">
          <td style="font-size:.85rem">{{ $m->name }}</td>
          <td style="font-size:.82rem;color:#718096">{{ $m->email }}</td>
          <td><span class="badge badge-blue">{{ $m->purpose ?? 'Umum' }}</span></td>
          <td style="font-size:.82rem;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $m->message }}</td>
          <td>
            @if($m->status==='unread')<span class="badge badge-red">Baru</span>
            @else<span class="badge badge-gray">Dibaca</span>@endif
          </td>
          <td style="font-size:.75rem;color:#718096;white-space:nowrap">{{ $m->created_at->format('d M Y H:i') }}</td>
          <td>
            <div style="display:flex;gap:.3rem">
              <a href="{{ route('admin.messages.show',$m) }}" class="btn btn-sm btn-outline btn-icon" title="Lihat"><i class="fas fa-eye"></i></a>
              <a href="mailto:{{ $m->email }}" class="btn btn-sm btn-success btn-icon" title="Balas via Email"><i class="fas fa-reply"></i></a>
              <form method="POST" action="{{ route('admin.messages.destroy',$m) }}" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger btn-icon"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:3rem;color:#718096">Belum ada pesan masuk</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($messages->hasPages())
  <div class="card-footer">{{ $messages->links() }}</div>
  @endif
</div>
@endsection
