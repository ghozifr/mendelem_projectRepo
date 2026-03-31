@extends('layouts.admin')
@section('title','Kelola Kambing Kurban')
@section('page-title','Kambing Kurban')
@section('page-subtitle','Kelola daftar hewan kurban yang dijual')

@section('content')
<div class="page-header">
  <div>
    <h1>Hewan Kurban</h1>
    <p>{{ $animals->total() }} hewan terdaftar</p>
  </div>
  <a href="{{ route('admin.kurban.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Hewan
  </a>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

{{-- Filter Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem">
  @php
    $total     = $animals->total();
    $tersedia  = $animals->getCollection()->where('status','tersedia')->count();
    $dipesan   = $animals->getCollection()->where('status','dipesan')->count();
    $terjual   = $animals->getCollection()->where('status','terjual')->count();
  @endphp
  <div style="background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem;text-align:center">
    <div style="font-size:1.75rem;font-weight:800;color:var(--primary)">{{ $total }}</div>
    <div style="font-size:.8rem;color:var(--text-muted)">Total Hewan</div>
  </div>
  <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:1.25rem;text-align:center">
    <div style="font-size:1.75rem;font-weight:800;color:#16a34a">{{ $tersedia }}</div>
    <div style="font-size:.8rem;color:#15803d">Tersedia</div>
  </div>
  <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:1.25rem;text-align:center">
    <div style="font-size:1.75rem;font-weight:800;color:#d97706">{{ $dipesan }}</div>
    <div style="font-size:.8rem;color:#b45309">Dipesan</div>
  </div>
  <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:1.25rem;text-align:center">
    <div style="font-size:1.75rem;font-weight:800;color:#dc2626">{{ $terjual }}</div>
    <div style="font-size:.8rem;color:#b91c1c">Terjual</div>
  </div>
</div>

<div class="card">
  <div class="card-body" style="padding:0">
    @if($animals->count())
    <div style="overflow-x:auto">
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="border-bottom:2px solid var(--border);background:var(--bg)">
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Foto</th>
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Nama / Identitas</th>
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Spesifikasi</th>
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Harga</th>
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Status</th>
            <th style="padding:.9rem 1.25rem;text-align:left;font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($animals as $animal)
          <tr style="border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background=''">
            {{-- Foto --}}
            <td style="padding:.75rem 1.25rem">
              <div style="width:60px;height:60px;border-radius:10px;overflow:hidden;background:var(--bg);border:1px solid var(--border);flex-shrink:0">
                @if($animal->thumbnail)
                  <img src="{{ asset('storage/'.$animal->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
                @else
                  <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#ccc;font-size:1.5rem">🐐</div>
                @endif
              </div>
            </td>

            {{-- Nama / Identitas --}}
            <td style="padding:.75rem 1.25rem">
              <div style="font-weight:700;font-size:.95rem;color:var(--text)">{{ $animal->name ?? 'Tanpa Nama' }}</div>
              <div style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">
                <span style="background:{{ $animal->jenis_hewan==='kambing'?'#dcfce7':'#ede9fe' }};color:{{ $animal->jenis_hewan==='kambing'?'#16a34a':'#7c3aed' }};padding:.1rem .45rem;border-radius:4px;font-weight:600">{{ ucfirst($animal->jenis_hewan) }}</span>
                <span style="margin-left:.35rem;color:{{ $animal->kelamin==='jantan'?'#2563eb':'#db2777' }}">{{ $animal->kelamin==='jantan'?'♂ Jantan':'♀ Betina' }}</span>
              </div>
            </td>

            {{-- Spesifikasi --}}
            <td style="padding:.75rem 1.25rem">
              <div style="font-size:.85rem;color:var(--text)">{{ $animal->jenis_ras ?? '—' }}</div>
              <div style="font-size:.78rem;color:var(--text-muted)">
                @if($animal->berat_kg) {{ $animal->berat_kg }} kg @endif
                @if($animal->umur) · {{ $animal->umur }} @endif
              </div>
            </td>

            {{-- Harga --}}
            <td style="padding:.75rem 1.25rem">
              <div style="font-weight:700;font-size:.95rem;color:#0f75bd">{{ $animal->harga_format }}</div>
            </td>

            {{-- Status --}}
            <td style="padding:.75rem 1.25rem">
              <span style="display:inline-block;padding:.25rem .7rem;border-radius:99px;font-size:.75rem;font-weight:700;background:{{ $animal->status==='tersedia'?'#dcfce7':($animal->status==='dipesan'?'#fef9c3':'#fee2e2') }};color:{{ $animal->status==='tersedia'?'#15803d':($animal->status==='dipesan'?'#92400e':'#b91c1c') }}">
                {{ $animal->status_label }}
              </span>
              @if(!$animal->is_active)
              <span style="display:inline-block;margin-top:.25rem;padding:.2rem .5rem;border-radius:99px;font-size:.7rem;background:#f1f5f9;color:#64748b">Non-aktif</span>
              @endif
            </td>

            {{-- Aksi --}}
            <td style="padding:.75rem 1.25rem">
              <div style="display:flex;gap:.4rem">
                <a href="{{ route('kurban.show', $animal) }}" target="_blank"
                   title="Lihat di website"
                   style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.8rem;transition:all .2s"
                   onmouseover="this.style.borderColor='#0f75bd';this.style.color='#0f75bd'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.kurban.edit', $animal) }}"
                   title="Edit"
                   style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.8rem;transition:all .2s"
                   onmouseover="this.style.borderColor='#0f75bd';this.style.color='#0f75bd'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                  <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="{{ route('admin.kurban.destroy', $animal) }}"
                      onsubmit="return confirm('Hapus {{ $animal->name ?? 'hewan ini' }}? Semua foto/video akan ikut terhapus.')">
                  @csrf @method('DELETE')
                  <button type="submit" title="Hapus"
                          style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);cursor:pointer;font-size:.8rem;transition:all .2s"
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
    <div style="padding:1rem 1.25rem">{{ $animals->links() }}</div>
    @else
    <div style="text-align:center;padding:4rem;color:var(--text-muted)">
      <div style="font-size:4rem;margin-bottom:1rem">🐐</div>
      <p style="font-size:1rem;font-weight:600;margin-bottom:.5rem">Belum ada hewan kurban</p>
      <p style="font-size:.88rem;margin-bottom:1.5rem">Tambahkan hewan kurban pertama untuk ditampilkan di website.</p>
      <a href="{{ route('admin.kurban.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Sekarang</a>
    </div>
    @endif
  </div>
</div>

{{-- Link ke halaman publik --}}
<div style="margin-top:1rem;text-align:center">
  <a href="{{ route('kurban.index') }}" target="_blank" style="font-size:.83rem;color:var(--text-muted);text-decoration:none">
    <i class="fas fa-external-link-alt"></i> Lihat halaman kurban di website →
  </a>
</div>
@endsection
