@extends('layouts.admin')
@section('title','Detail Pesan')
@section('page-title','Detail Pesan')

@section('content')
<div class="page-header">
  <div><h1>Pesan dari {{ $message->name }}</h1></div>
  <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:1.5rem;align-items:start">
  <div class="card">
    <div class="card-header"><h2>Isi Pesan</h2></div>
    <div class="card-body">
      <p style="line-height:1.8;color:#1a2332;font-size:.95rem">{{ $message->message }}</p>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><h2>Info Pengirim</h2></div>
    <div class="card-body" style="display:flex;flex-direction:column;gap:.75rem">
      <div><div style="font-size:.75rem;color:#718096;margin-bottom:.2rem">Nama</div>
        <div style="font-weight:600">{{ $message->name }}</div></div>
      <div><div style="font-size:.75rem;color:#718096;margin-bottom:.2rem">Email</div>
        <div><a href="mailto:{{ $message->email }}" style="color:#0f75bd">{{ $message->email }}</a></div></div>
      <div><div style="font-size:.75rem;color:#718096;margin-bottom:.2rem">Tujuan</div>
        <span class="badge badge-blue">{{ $message->purpose ?? 'Umum' }}</span></div>
      <div><div style="font-size:.75rem;color:#718096;margin-bottom:.2rem">Waktu</div>
        <div style="font-size:.85rem">{{ $message->created_at->format('d M Y, H:i') }}</div></div>
      <div style="margin-top:.5rem">
        <a href="mailto:{{ $message->email }}" class="btn btn-primary" style="width:100%;justify-content:center">
          <i class="fas fa-reply"></i> Balas via Email
        </a>
      </div>
      <form method="POST" action="{{ route('admin.messages.destroy',$message) }}"
            onsubmit="return confirm('Hapus pesan ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
          <i class="fas fa-trash"></i> Hapus Pesan
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
