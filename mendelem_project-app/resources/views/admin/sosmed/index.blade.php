@extends('layouts.admin')
@section('title','Kelola Social Media')
@section('page-title','Social Media')
@section('page-subtitle','Kelola akun dan channel social media yang ditampilkan di website')

@section('content')
<div class="page-header">
  <div><h1>Social Media</h1><p>{{ $items->count() }} akun terdaftar</p></div>
  <a href="{{ route('admin.sosmed.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Akun</a>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-body" style="padding:0">
    @if($items->count())
    <div style="overflow-x:auto">
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="border-bottom:2px solid var(--border);background:var(--bg)">
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">Cover</th>
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">Nama / Platform</th>
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">URL</th>
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">Preview</th>
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">Status</th>
            <th style="padding:.85rem 1.25rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr style="border-bottom:1px solid var(--border)" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background=''">
            <td style="padding:.75rem 1.25rem">
              <div style="width:56px;height:56px;border-radius:10px;overflow:hidden;background:{{ $item->platform_color }}22;border:1px solid {{ $item->platform_color }}44;display:flex;align-items:center;justify-content:center">
                @if($item->thumbnail)
                  <img src="{{ asset('storage/'.$item->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
                @else
                  <i class="{{ $item->platform_icon }}" style="font-size:1.5rem;color:{{ $item->platform_color }}"></i>
                @endif
              </div>
            </td>
            <td style="padding:.75rem 1.25rem">
              <div style="font-weight:700;font-size:.95rem;color:var(--text)">{{ $item->name }}</div>
              <div style="font-size:.78rem;color:var(--text-muted);margin-top:.15rem;display:flex;align-items:center;gap:.3rem">
                <i class="{{ $item->platform_icon }}" style="color:{{ $item->platform_color }}"></i>
                {{ ucfirst($item->platform) }}
              </div>
            </td>
            <td style="padding:.75rem 1.25rem;max-width:220px">
              <a href="{{ $item->url }}" target="_blank" style="font-size:.82rem;color:var(--primary);text-decoration:none;word-break:break-all">
                {{ Str::limit($item->url, 50) }} <i class="fas fa-external-link-alt" style="font-size:.65rem"></i>
              </a>
            </td>
            <td style="padding:.75rem 1.25rem">
              <span style="font-size:.82rem;color:var(--text-muted)">{{ count($item->previews ?? []) }} gambar</span>
            </td>
            <td style="padding:.75rem 1.25rem">
              <span style="display:inline-block;padding:.2rem .6rem;border-radius:99px;font-size:.72rem;font-weight:700;background:{{ $item->is_active?'#dcfce7':'#f1f5f9' }};color:{{ $item->is_active?'#15803d':'#64748b' }}">
                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td style="padding:.75rem 1.25rem">
              <div style="display:flex;gap:.4rem">
                <a href="{{ route('admin.sosmed.edit',$item) }}" title="Edit"
                   style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.8rem"
                   onmouseover="this.style.borderColor='var(--primary)';this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                  <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="{{ route('admin.sosmed.destroy',$item) }}"
                      onsubmit="return confirm('Hapus {{ $item->name }}?')">
                  @csrf @method('DELETE')
                  <button type="submit" title="Hapus"
                          style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);cursor:pointer;color:var(--text-muted);font-size:.8rem"
                          onmouseover="this.style.borderColor='#dc2626';this.style.color='#dc2626'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div style="text-align:center;padding:4rem;color:var(--text-muted)">
      <i class="fas fa-share-alt" style="font-size:3rem;opacity:.3;display:block;margin-bottom:1rem"></i>
      <p>Belum ada social media. Tambahkan sekarang!</p>
      <a href="{{ route('admin.sosmed.create') }}" class="btn btn-primary" style="margin-top:1rem"><i class="fas fa-plus"></i> Tambah Akun</a>
    </div>
    @endif
  </div>
</div>
@endsection
