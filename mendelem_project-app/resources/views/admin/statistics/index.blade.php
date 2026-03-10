@extends('layouts.admin')
@section('title','Statistik')
@section('page-title','Statistik & Grafik')
@section('page-subtitle','Kelola angka statistik yang tampil di website')

@section('content')
<div style="display:flex;flex-direction:column;gap:1.5rem">
  @foreach($stats as $group => $items)
  <div class="card">
    <div class="card-header">
      <h2>
        @if($group==='general') 📊 Statistik Utama (Stats Bar)
        @elseif($group==='financing') 💰 Alokasi Pembiayaan Proyek
        @elseif($group==='funding_source') 🥧 Sumber Dana
        @else {{ ucfirst($group) }}
        @endif
      </h2>
      @if($group !== 'general')
      <span style="font-size:.78rem;color:#718096">Total: {{ $items->sum('value') }}%</span>
      @endif
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Label (ID)</th><th>Label (EN)</th><th>Nilai</th><th>Satuan</th>@if($group!=='general')<th>Warna</th>@endif<th>Aksi</th></tr></thead>
        <tbody>
          @foreach($items as $stat)
          <tr>
            <td style="font-weight:600;font-size:.85rem">{{ $stat->label_id }}</td>
            <td style="font-size:.85rem;color:#718096">{{ $stat->label_en }}</td>
            <td>
              <form method="POST" action="{{ route('admin.statistics.update',$stat) }}" style="display:flex;gap:.5rem;align-items:center">
                @csrf @method('PUT')
                <input type="text" name="value" value="{{ $stat->value }}" class="form-control" style="width:100px;margin:0">
                <button type="submit" class="btn btn-sm btn-primary btn-icon"><i class="fas fa-save"></i></button>
              </form>
            </td>
            <td style="font-size:.85rem">{{ $stat->unit }}</td>
            @if($group!=='general')
            <td><div style="width:20px;height:20px;border-radius:4px;background:{{ $stat->color ?? '#ccc' }};border:1px solid rgba(0,0,0,.1)"></div></td>
            @endif
            <td>
              <form method="POST" action="{{ route('admin.statistics.destroy',$stat) }}" onsubmit="return confirm('Hapus statistik ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger btn-icon"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endforeach

  {{-- Add New --}}
  <div class="card">
    <div class="card-header"><h2>Tambah Statistik Baru</h2></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.statistics.store') }}" class="form-grid">
        @csrf
        <div class="form-group"><label>Key (unik)</label><input type="text" name="key" class="form-control" placeholder="custom_stat_key"></div>
        <div class="form-group"><label>Group</label><select name="group" class="form-control"><option>general</option><option>financing</option><option>funding_source</option></select></div>
        <div class="form-group"><label>Label (ID) <span class="required">*</span></label><input type="text" name="label_id" id="new_stat_id" class="form-control" placeholder="Label Indonesia"></div>
        <div class="form-group translate-group"><label>Label (EN)</label><input type="text" name="label_en" id="new_stat_en" class="form-control" placeholder="English label"><button type="button" class="translate-btn" onclick="autoTranslate('new_stat_id','new_stat_en',this)"><i class="fas fa-language"></i> Terjemahkan</button></div>
        <div class="form-group"><label>Nilai <span class="required">*</span></label><input type="text" name="value" class="form-control" placeholder="120, Rp 500jt, 35..."></div>
        <div class="form-group"><label>Satuan</label><input type="text" name="unit" class="form-control" placeholder="+, %, Rp, orang..."></div>
        <div class="form-group"><label>Icon (Font Awesome)</label><input type="text" name="icon" class="form-control" placeholder="fas fa-chart-bar"></div>
        <div class="form-group"><label>Warna</label><input type="color" name="color" class="form-control" value="#0f75bd"></div>
        <div class="form-group"><label>Urutan</label><input type="number" name="order" class="form-control" value="0" min="0"></div>
        <div class="form-group" style="align-self:end"><button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-plus"></i> Tambah Statistik</button></div>
      </form>
    </div>
  </div>
</div>
@endsection
