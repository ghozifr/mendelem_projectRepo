@extends('layouts.admin')
@section('title','Pengaturan Situs')
@section('page-title','Pengaturan Situs')
@section('page-subtitle','Kelola informasi dan tampilan website')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  <div style="display:flex;flex-direction:column;gap:1.5rem">

    @foreach($settings as $group => $items)
    <div class="card">
      <div class="card-header">
        <h2>
          @if($group==='general') <i class="fas fa-globe" style="color:#0f75bd;margin-right:.4rem"></i> Umum
          @elseif($group==='contact') <i class="fas fa-address-card" style="color:#8cc63e;margin-right:.4rem"></i> Kontak
          @elseif($group==='social') <i class="fas fa-share-alt" style="color:#e67e22;margin-right:.4rem"></i> Media Sosial
          @elseif($group==='donation') <i class="fas fa-hand-holding-heart" style="color:#e53e3e;margin-right:.4rem"></i> Donasi / Bank
          @else {{ ucfirst($group) }}
          @endif
        </h2>
      </div>
      <div class="card-body form-grid">
        @foreach($items as $s)
          @if($s->type !== 'image')
          <div class="form-group">
            <label>{{ $s->label ?? $s->key }}</label>
            @if(in_array($s->key,['site_description_id','site_description_en','contact_address_id','contact_address_en']))
              <textarea name="{{ $s->key }}" class="form-control" rows="3">{{ old($s->key, $s->value) }}</textarea>
            @else
              <input type="text" name="{{ $s->key }}" class="form-control" value="{{ old($s->key, $s->value) }}">
            @endif
          </div>
          @endif
        @endforeach
      </div>
    </div>
    @endforeach

    {{-- Logo Upload --}}
    <div class="card">
      <div class="card-header"><h2><i class="fas fa-image" style="color:#0f75bd;margin-right:.4rem"></i> Logo Situs</h2></div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.logo') }}" enctype="multipart/form-data" style="display:grid;grid-template-columns:1fr auto;gap:1rem;align-items:end">
          @csrf
          @php $logoPath = \App\Models\SiteSetting::get('site_logo'); @endphp
          @if($logoPath)
            <div style="grid-column:1/-1;margin-bottom:.5rem"><img src="{{ asset('storage/'.$logoPath) }}" style="height:60px;border-radius:8px;border:1px solid #e2e8f0" alt="Logo"></div>
          @endif
          <div class="form-group" style="margin:0"><label>Upload Logo Baru</label><input type="file" name="logo" class="form-control" accept="image/*"></div>
          <button type="submit" class="btn btn-outline"><i class="fas fa-upload"></i> Upload</button>
        </form>
      </div>
    </div>

    <div style="text-align:right">
      <button type="submit" class="btn btn-primary" style="padding:.75rem 2rem"><i class="fas fa-save"></i> Simpan Semua Pengaturan</button>
    </div>
  </div>
</form>
@endsection
