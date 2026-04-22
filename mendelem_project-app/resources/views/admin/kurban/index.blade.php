@extends('layouts.admin')
@section('title','Kelola Kambing Kurban')
@section('page-title','Kambing Kurban')
@section('page-subtitle','Kelola daftar hewan kurban yang dijual')

@section('content')
<div class="page-header">
  <div><h1>Hewan Kurban</h1><p>{{ $animals->total() }} hewan terdaftar</p></div>
  <a href="{{ route('admin.kurban.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Hewan</a>
</div>

@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem">
  @php
    $total    = $animals->total();
    $tersedia = $animals->getCollection()->where('status','tersedia')->count();
    $dipesan  = $animals->getCollection()->where('status','dipesan')->count();
    $terjual  = $animals->getCollection()->where('status','terjual')->count();
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
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Foto</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Kode / Nama</th>
            <th style="padding:.9rem 1rem;text-align:center;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Grade</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Hewan</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Spesifikasi</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Harga</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Status</th>
            <th style="padding:.9rem 1rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($animals as $animal)
          <tr style="border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background=''">

            {{-- Foto --}}
            <td style="padding:.7rem 1rem">
              <div style="width:56px;height:56px;border-radius:9px;overflow:hidden;background:var(--bg);border:1px solid var(--border);flex-shrink:0">
                @if($animal->thumbnail)
                  <img src="{{ asset('storage/'.$animal->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
                @else
                  <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:1.5rem">{{ $animal->jenis_hewan==='kambing'?'🐐':'🐑' }}</div>
                @endif
              </div>
            </td>

            {{-- Kode / Nama --}}
            <td style="padding:.7rem 1rem">
              @if($animal->kode)
              <div style="font-family:monospace;font-weight:800;font-size:.9rem;color:var(--primary);letter-spacing:.05em">{{ $animal->kode }}</div>
              @endif
              <div style="font-size:.82rem;color:var(--text-muted);margin-top:.1rem">{{ $animal->name ?? ($animal->jenis_hewan==='kambing'?'Kambing':'Domba').' #'.$animal->id }}</div>
            </td>

            {{-- Grade --}}
            <td style="padding:.7rem 1rem;text-align:center">
              @if($animal->grade)
              @php
                $gc = ['A'=>'#c0392b','B'=>'#e67e22','C'=>'#f39c12','D'=>'#27ae60','E'=>'#2980b9','F'=>'#8e44ad','G'=>'#7f8c8d'];
                $color = $gc[$animal->grade] ?? '#718096';
              @endphp
              <div style="display:inline-flex;flex-direction:column;align-items:center;justify-content:center;width:42px;height:42px;border-radius:10px;background:{{ $color }}18;border:2px solid {{ $color }}44">
                <span style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:900;color:{{ $color }};line-height:1">{{ $animal->grade }}</span>
              </div>
              @else
              <span style="color:var(--text-muted);font-size:.8rem">—</span>
              @endif
            </td>

            {{-- Jenis & Kelamin --}}
            <td style="padding:.7rem 1rem">
              <div style="font-size:.85rem;font-weight:600;color:var(--text)">
                {{ $animal->jenis_hewan==='kambing'?'🐐 Kambing':'🐑 Domba' }}
              </div>
              <div style="font-size:.78rem;color:{{ $animal->kelamin==='jantan'?'#2563eb':'#db2777' }};margin-top:.15rem">
                {{ $animal->kelamin==='jantan'?'♂ Jantan':'♀ Betina' }}
              </div>
            </td>

            {{-- Spesifikasi --}}
            <td style="padding:.7rem 1rem">
              <div style="font-size:.85rem;color:var(--text)">{{ $animal->jenis_ras ?? '—' }}</div>
              <div style="font-size:.78rem;color:var(--text-muted)">
                @if($animal->berat_kg) {{ $animal->berat_kg }} kg @endif
                @if($animal->umur) · {{ $animal->umur }} @endif
              </div>
            </td>

            {{-- Harga --}}
            <td style="padding:.7rem 1rem">
              <div style="font-weight:700;font-size:.95rem;color:#0f75bd">{{ $animal->harga_format }}</div>
            </td>

            {{-- Status --}}
            <td style="padding:.7rem 1rem">
              <span style="display:inline-block;padding:.25rem .7rem;border-radius:99px;font-size:.75rem;font-weight:700;background:{{ $animal->status==='tersedia'?'#dcfce7':($animal->status==='dipesan'?'#fef9c3':'#fee2e2') }};color:{{ $animal->status==='tersedia'?'#15803d':($animal->status==='dipesan'?'#92400e':'#b91c1c') }}">
                {{ $animal->status_label }}
              </span>
            </td>

            {{-- Aksi --}}
            <td style="padding:.7rem 1rem">
              <div style="display:flex;gap:.4rem">
                <a href="{{ route('kurban.show',$animal) }}" target="_blank" title="Lihat di website"
                   style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.8rem"
                   onmouseover="this.style.borderColor='#0f75bd';this.style.color='#0f75bd'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.kurban.edit',$animal) }}" title="Edit"
                   style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);text-decoration:none;font-size:.8rem"
                   onmouseover="this.style.borderColor='#0f75bd';this.style.color='#0f75bd'" onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                  <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="{{ route('admin.kurban.destroy',$animal) }}"
                      onsubmit="return confirm('Hapus {{ $animal->kode ?? ($animal->name ?? 'hewan ini') }}?')">
                  @csrf @method('DELETE')
                  <button type="submit" title="Hapus"
                          style="width:32px;height:32px;border-radius:7px;border:1px solid var(--border);background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--text-muted);cursor:pointer;font-size:.8rem"
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
      <a href="{{ route('admin.kurban.create') }}" class="btn btn-primary" style="margin-top:1rem"><i class="fas fa-plus"></i> Tambah Sekarang</a>
    </div>
    @endif
  </div>
</div>
<div style="margin-top:1rem;text-align:center">
  <a href="{{ route('kurban.index') }}" target="_blank" style="font-size:.83rem;color:var(--text-muted);text-decoration:none">
    <i class="fas fa-external-link-alt"></i> Lihat halaman kurban di website →
  </a>
</div>
@endsection
