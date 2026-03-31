{{-- ================================================================
     FILE INI BERISI 2 SECTION YANG DITAMBAHKAN KE mendelem_Home.blade.php
     
     1. PAGE KAMBING KURBAN (daftar semua hewan)
     2. PAGE DETAIL HEWAN KURBAN (1 hewan)
     
     CARA MENAMBAHKAN:
     - Tempelkan kedua section ini di mendelem_Home.blade.php
     - Letakkan sebelum blok footer
     - Pastikan HomeController / KurbanPublicController mengirim variabel:
       $activePage, $animals (untuk list), $animal + $related (untuk detail)
================================================================ --}}

{{-- ==================== HALAMAN KAMBING KURBAN ==================== --}}
<div id="page-kurban" class="page {{ $activePage==='kurban' ? 'active' : '' }}">

  {{-- Hero --}}
  <div class="page-hero" style="background:linear-gradient(135deg,#1a6b2f 0%,#2d9b4e 60%,#5ab87a 100%)">
    <div style="display:inline-block;background:rgba(255,255,255,.2);padding:.3rem 1rem;border-radius:99px;font-size:.78rem;font-weight:700;letter-spacing:.08em;margin-bottom:.75rem">🐐 TERNAK SALAM</div>
    <h1>Kambing Kurban</h1>
    <p>Hewan kurban pilihan dari peternakan komunitas Mendelem — sehat, terpercaya, siap kurban.</p>

    {{-- Filter pills --}}
    @if(isset($animals) && $animals->count())
    <div style="display:flex;gap:.5rem;justify-content:center;margin-top:1.5rem;flex-wrap:wrap">
      <button onclick="filterKurban('semua')" id="filter-semua"
              style="padding:.4rem 1.1rem;border-radius:99px;border:2px solid rgba(255,255,255,.8);background:rgba(255,255,255,.25);color:#fff;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s">
        Semua ({{ $animals->count() }})
      </button>
      @if($totalKambing ?? 0)
      <button onclick="filterKurban('kambing')" id="filter-kambing"
              style="padding:.4rem 1.1rem;border-radius:99px;border:2px solid rgba(255,255,255,.5);background:transparent;color:rgba(255,255,255,.85);font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s">
        🐐 Kambing ({{ $totalKambing ?? 0 }})
      </button>
      @endif
      @if($totalDomba ?? 0)
      <button onclick="filterKurban('domba')" id="filter-domba"
              style="padding:.4rem 1.1rem;border-radius:99px;border:2px solid rgba(255,255,255,.5);background:transparent;color:rgba(255,255,255,.85);font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s">
        🐑 Domba ({{ $totalDomba ?? 0 }})
      </button>
      @endif
    </div>
    @endif
  </div>

  {{-- Grid Hewan --}}
  <section><div class="container">

    @if(isset($animals) && $animals->count())
    <div id="kurbanGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.5rem">
      @foreach($animals as $hewan)
      <a href="{{ route('kurban.show', $hewan) }}"
         class="kurban-card"
         data-jenis="{{ $hewan->jenis_hewan }}"
         style="text-decoration:none;display:block;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition);position:relative">

        {{-- Status badge --}}
        <div style="position:absolute;top:.75rem;left:.75rem;z-index:2;padding:.25rem .7rem;border-radius:99px;font-size:.72rem;font-weight:700;background:{{ $hewan->status==='tersedia'?'#dcfce7':($hewan->status==='dipesan'?'#fef9c3':'#fee2e2') }};color:{{ $hewan->status==='tersedia'?'#15803d':($hewan->status==='dipesan'?'#92400e':'#b91c1c') }}">
          {{ $hewan->status_label }}
        </div>

        {{-- Jenis Hewan badge --}}
        <div style="position:absolute;top:.75rem;right:.75rem;z-index:2;padding:.25rem .65rem;border-radius:99px;font-size:.72rem;font-weight:700;background:{{ $hewan->jenis_hewan==='kambing'?'#dcfce7':'#ede9fe' }};color:{{ $hewan->jenis_hewan==='kambing'?'#15803d':'#6d28d9' }}">
          {{ $hewan->jenis_hewan==='kambing'?'🐐 Kambing':'🐑 Domba' }}
        </div>

        {{-- Foto --}}
        <div style="height:210px;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative">
          @if($hewan->thumbnail)
            <img src="{{ asset('storage/'.$hewan->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="{{ $hewan->name }}">
          @else
            <div style="text-align:center;color:#86efac">
              <div style="font-size:4rem">{{ $hewan->jenis_hewan==='kambing'?'🐐':'🐑' }}</div>
              <div style="font-size:.78rem;margin-top:.25rem">Foto belum tersedia</div>
            </div>
          @endif
          {{-- Overlay hover --}}
          <div class="kurban-overlay" style="position:absolute;inset:0;background:rgba(15,107,47,.8);display:flex;align-items:center;justify-content:center;gap:.5rem;color:#fff;font-size:.9rem;font-weight:700;opacity:0;transition:opacity .25s">
            <i class="fas fa-eye"></i> Lihat Detail
          </div>
        </div>

        {{-- Info --}}
        <div style="padding:1.25rem">
          <div style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.05rem;color:var(--text);margin-bottom:.4rem">
            {{ $hewan->name ?? (ucfirst($hewan->jenis_hewan).' #'.$hewan->id) }}
          </div>

          <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.75rem">
            <span style="font-size:.75rem;padding:.15rem .55rem;border-radius:99px;background:#eff6ff;color:#1d4ed8;font-weight:600">
              {{ $hewan->kelamin==='jantan'?'♂ Jantan':'♀ Betina' }}
            </span>
            @if($hewan->jenis_ras)
            <span style="font-size:.75rem;padding:.15rem .55rem;border-radius:99px;background:#f1f5f9;color:#475569;font-weight:600">
              {{ $hewan->jenis_ras }}
            </span>
            @endif
          </div>

          <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.5rem">
            <div>
              @if($hewan->berat_kg)
              <div style="font-size:.82rem;color:var(--text2)"><i class="fas fa-weight-hanging" style="color:#6b7280;font-size:.75rem"></i> {{ $hewan->berat_kg }} kg</div>
              @endif
              @if($hewan->umur)
              <div style="font-size:.82rem;color:var(--text2)"><i class="fas fa-calendar-alt" style="color:#6b7280;font-size:.75rem"></i> {{ $hewan->umur }}</div>
              @endif
            </div>
            <div style="font-size:1.1rem;font-weight:800;color:#1a6b2f">{{ $hewan->harga_format }}</div>
          </div>

          @if($hewan->status === 'tersedia')
          <div style="margin-top:1rem;padding:.6rem 1rem;background:#f0fdf4;border-radius:8px;text-align:center;font-size:.82rem;font-weight:600;color:#15803d;border:1px solid #bbf7d0">
            <i class="fas fa-comments"></i> Hubungi Kami untuk Pemesanan
          </div>
          @elseif($hewan->status === 'dipesan')
          <div style="margin-top:1rem;padding:.6rem 1rem;background:#fef9c3;border-radius:8px;text-align:center;font-size:.82rem;font-weight:600;color:#92400e;border:1px solid #fde68a">
            Sedang Dipesan
          </div>
          @else
          <div style="margin-top:1rem;padding:.6rem 1rem;background:#fee2e2;border-radius:8px;text-align:center;font-size:.82rem;font-weight:600;color:#b91c1c;border:1px solid #fecaca">
            Sudah Terjual
          </div>
          @endif
        </div>
      </a>
      @endforeach
    </div>

    {{-- Tidak ada hewan --}}
    @else
    <div style="text-align:center;padding:5rem 2rem;color:var(--text3)">
      <div style="font-size:5rem;margin-bottom:1rem">🐐</div>
      <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;margin-bottom:.5rem">Segera Hadir</h3>
      <p>Daftar hewan kurban akan segera tersedia. Hubungi kami untuk informasi lebih lanjut.</p>
      <a href="https://wa.me/6281234567890" class="btn-wa" target="_blank" style="display:inline-flex;align-items:center;gap:.5rem;margin-top:1.5rem;background:#25d366;color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;text-decoration:none">
        <i class="fab fa-whatsapp"></i> Tanya via WhatsApp
      </a>
    </div>
    @endif

  </div></section>

  {{-- Call to action bawah --}}
  @if(isset($animals) && $animals->count())
  <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);padding:3rem 2rem;border-top:1px solid #bbf7d0">
    <div class="container" style="text-align:center">
      <div style="font-size:2rem;margin-bottom:.5rem">🤝</div>
      <h3 style="font-family:'Playfair Display',serif;font-size:1.4rem;margin-bottom:.5rem;color:#14532d">Ingin Memesan atau Ada Pertanyaan?</h3>
      <p style="color:#166534;font-size:.9rem;margin-bottom:1.25rem">Tim kami siap membantu Anda memilih hewan kurban terbaik.</p>
      <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamualaikum, saya ingin menanyakan tentang hewan kurban dari Mendelem Project (Ternak Salam).') }}"
         target="_blank"
         style="display:inline-flex;align-items:center;gap:.6rem;background:#25d366;color:#fff;padding:.8rem 2rem;border-radius:10px;font-weight:700;text-decoration:none;font-size:.95rem">
        <i class="fab fa-whatsapp" style="font-size:1.1rem"></i> Chat WhatsApp Sekarang
      </a>
    </div>
  </div>
  @endif

</div>{{-- /page-kurban --}}


{{-- ==================== HALAMAN DETAIL HEWAN KURBAN ==================== --}}
@if($activePage==='kurban-detail' && isset($animal))
<div id="page-kurban-detail" class="page active">

  {{-- Back + Breadcrumb --}}
  <div style="background:var(--bg2);border-bottom:1px solid var(--border);padding:.75rem 2rem">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('page.products') }}">Produk</a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('kurban.index') }}">Kambing Kurban</a>
        <i class="fas fa-chevron-right"></i>
        <span>{{ $animal->name ?? ucfirst($animal->jenis_hewan).' #'.$animal->id }}</span>
      </div>
    </div>
  </div>

  {{-- Hero Section --}}
  <section style="padding:2.5rem 2rem"><div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start">

      {{-- KIRI: Foto Utama + Galeri --}}
      <div>
        {{-- Foto/Video Utama --}}
        <div id="mainMedia" style="border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);background:linear-gradient(135deg,#f0fdf4,#dcfce7);aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;cursor:pointer" onclick="openLightbox(currentMediaSrc, currentMediaType)">
          @if($animal->thumbnail)
            <img id="mainImg" src="{{ asset('storage/'.$animal->thumbnail) }}"
                 style="width:100%;height:100%;object-fit:cover" alt="{{ $animal->name }}"
                 onclick="openLightbox('{{ asset('storage/'.$animal->thumbnail) }}','image')">
          @else
            <div style="text-align:center;color:#86efac">
              <div style="font-size:6rem">{{ $animal->jenis_hewan==='kambing'?'🐐':'🐑' }}</div>
              <p style="font-size:.85rem;margin-top:.5rem">Foto belum tersedia</p>
            </div>
          @endif
        </div>

        {{-- Thumbnail Galeri --}}
        @php
          $allMedia = collect();
          if ($animal->thumbnail) $allMedia->push(['src' => asset('storage/'.$animal->thumbnail), 'type' => 'image']);
          foreach ($animal->media ?? [] as $m) {
            $allMedia->push(['src' => asset('storage/'.$m['path']), 'type' => $m['type']]);
          }
        @endphp
        @if($allMedia->count() > 1)
        <div style="display:flex;gap:.5rem;margin-top:.75rem;flex-wrap:wrap">
          @foreach($allMedia as $i => $m)
          <div onclick="switchMedia('{{ $m['src'] }}','{{ $m['type'] }}')"
               style="width:70px;height:70px;border-radius:8px;overflow:hidden;border:2px solid {{ $i===0?'#1a6b2f':'var(--border)' }};cursor:pointer;flex-shrink:0;transition:border-color .2s;background:#f0fdf4;position:relative"
               class="thumb-item" id="thumb-{{ $i }}">
            @if($m['type']==='video')
              <video src="{{ $m['src'] }}" style="width:100%;height:100%;object-fit:cover" preload="metadata"></video>
              <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.3);color:#fff;font-size:.8rem"><i class="fas fa-play"></i></div>
            @else
              <img src="{{ $m['src'] }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @endif
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- KANAN: Info & Order --}}
      <div>
        {{-- Status badge --}}
        <div style="margin-bottom:1rem">
          <span style="display:inline-block;padding:.3rem .85rem;border-radius:99px;font-size:.8rem;font-weight:700;background:{{ $animal->status==='tersedia'?'#dcfce7':($animal->status==='dipesan'?'#fef9c3':'#fee2e2') }};color:{{ $animal->status==='tersedia'?'#15803d':($animal->status==='dipesan'?'#92400e':'#b91c1c') }}">
            {{ $animal->status_label }}
          </span>
          <span style="display:inline-block;margin-left:.4rem;padding:.3rem .85rem;border-radius:99px;font-size:.8rem;font-weight:700;background:{{ $animal->jenis_hewan==='kambing'?'#dcfce7':'#ede9fe' }};color:{{ $animal->jenis_hewan==='kambing'?'#15803d':'#6d28d9' }}">
            {{ $animal->jenis_hewan==='kambing'?'🐐 Kambing':'🐑 Domba' }}
          </span>
        </div>

        {{-- Nama --}}
        <h1 style="font-family:'Playfair Display',serif;font-size:clamp(1.6rem,3vw,2.2rem);font-weight:900;color:var(--text);margin-bottom:.5rem;line-height:1.2">
          {{ $animal->name ?? (ucfirst($animal->jenis_hewan).' #'.$animal->id) }}
        </h1>

        {{-- Harga --}}
        <div style="font-size:2rem;font-weight:900;color:#1a6b2f;margin-bottom:1.5rem">
          {{ $animal->harga_format }}
        </div>

        {{-- Spesifikasi Grid --}}
        <div style="background:var(--bg2);border-radius:12px;padding:1.25rem;margin-bottom:1.5rem">
          <h3 style="font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text2);margin-bottom:1rem">Spesifikasi</h3>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.6rem">

            <div style="background:var(--card);border-radius:8px;padding:.75rem;border:1px solid var(--border)">
              <div style="font-size:.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.2rem">Jenis Hewan</div>
              <div style="font-weight:700;font-size:.9rem">{{ $animal->jenis_hewan==='kambing'?'🐐 Kambing':'🐑 Domba' }}</div>
            </div>

            <div style="background:var(--card);border-radius:8px;padding:.75rem;border:1px solid var(--border)">
              <div style="font-size:.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.2rem">Kelamin</div>
              <div style="font-weight:700;font-size:.9rem;color:{{ $animal->kelamin==='jantan'?'#2563eb':'#db2777' }}">
                {{ $animal->kelamin==='jantan'?'♂ Jantan':'♀ Betina' }}
              </div>
            </div>

            @if($animal->jenis_ras)
            <div style="background:var(--card);border-radius:8px;padding:.75rem;border:1px solid var(--border)">
              <div style="font-size:.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.2rem">Ras / Jenis</div>
              <div style="font-weight:700;font-size:.9rem">{{ $animal->jenis_ras }}</div>
            </div>
            @endif

            @if($animal->berat_kg)
            <div style="background:var(--card);border-radius:8px;padding:.75rem;border:1px solid var(--border)">
              <div style="font-size:.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.2rem">Berat</div>
              <div style="font-weight:700;font-size:.9rem">{{ $animal->berat_kg }} kg</div>
            </div>
            @endif

            @if($animal->umur)
            <div style="background:var(--card);border-radius:8px;padding:.75rem;border:1px solid var(--border)">
              <div style="font-size:.72rem;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.2rem">Umur</div>
              <div style="font-weight:700;font-size:.9rem">{{ $animal->umur }}</div>
            </div>
            @endif

          </div>
        </div>

        {{-- Catatan --}}
        @if($animal->catatan)
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:1rem;margin-bottom:1.5rem">
          <div style="font-size:.78rem;font-weight:700;color:#15803d;margin-bottom:.4rem;text-transform:uppercase;letter-spacing:.06em"><i class="fas fa-clipboard-list"></i> Catatan</div>
          <p style="font-size:.88rem;color:#166534;line-height:1.65;margin:0">{{ $animal->catatan }}</p>
        </div>
        @endif

        {{-- Tombol WA & Pesan --}}
        @php
          $waNum = $animal->whatsapp_number ?: '6281234567890';
          $animalName = $animal->name ?? (ucfirst($animal->jenis_hewan).' #'.$animal->id);
          $waMsg = urlencode("Assalamualaikum, saya tertarik untuk membeli hewan kurban:\n\n*{$animalName}*\nJenis: ".ucfirst($animal->jenis_hewan)."\nKelamin: ".ucfirst($animal->kelamin)."\nHarga: {$animal->harga_format}\n\nMohon informasi lebih lanjut. Terima kasih.");
        @endphp

        @if($animal->status === 'tersedia')
        <div style="display:flex;flex-direction:column;gap:.75rem">
          <a href="https://wa.me/{{ $waNum }}?text={{ $waMsg }}"
             target="_blank" rel="noopener noreferrer"
             style="display:flex;align-items:center;justify-content:center;gap:.6rem;background:#25d366;color:#fff;padding:.95rem 1.5rem;border-radius:12px;font-weight:700;font-size:1rem;text-decoration:none;transition:all .2s;box-shadow:0 4px 16px rgba(37,211,102,.3)"
             onmouseover="this.style.background='#1ebe5d';this.style.transform='translateY(-2px)'"
             onmouseout="this.style.background='#25d366';this.style.transform=''">
            <i class="fab fa-whatsapp" style="font-size:1.25rem"></i>
            Hubungi via WhatsApp
          </a>
          <button onclick="document.getElementById('orderFormSection').scrollIntoView({behavior:'smooth'})"
                  style="display:flex;align-items:center;justify-content:center;gap:.5rem;background:#0f75bd;color:#fff;padding:.85rem 1.5rem;border-radius:12px;font-weight:700;font-size:.95rem;border:none;cursor:pointer;transition:all .2s"
                  onmouseover="this.style.background='#0a5a91'" onmouseout="this.style.background='#0f75bd'">
            <i class="fas fa-envelope"></i>
            Kirim Pesan / Pemesanan
          </button>
        </div>
        @elseif($animal->status === 'dipesan')
        <div style="background:#fef9c3;border:1px solid #fde68a;border-radius:12px;padding:1.25rem;text-align:center">
          <div style="font-size:1.5rem;margin-bottom:.25rem">⏳</div>
          <div style="font-weight:700;color:#92400e">Sedang Dipesan</div>
          <div style="font-size:.85rem;color:#78350f;margin-top:.25rem">Hewan ini sedang dalam proses pemesanan oleh pembeli lain.</div>
          <a href="{{ route('kurban.index') }}" style="display:inline-block;margin-top:.75rem;color:#0f75bd;font-size:.85rem;font-weight:600">← Lihat hewan lain yang tersedia</a>
        </div>
        @else
        <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:12px;padding:1.25rem;text-align:center">
          <div style="font-size:1.5rem;margin-bottom:.25rem">❌</div>
          <div style="font-weight:700;color:#b91c1c">Sudah Terjual</div>
          <div style="font-size:.85rem;color:#991b1b;margin-top:.25rem">Maaf, hewan ini sudah terjual.</div>
          <a href="{{ route('kurban.index') }}" style="display:inline-block;margin-top:.75rem;color:#0f75bd;font-size:.85rem;font-weight:600">← Lihat hewan lain yang tersedia</a>
        </div>
        @endif

      </div>
    </div>
  </div></section>

  {{-- Form Pesan --}}
  @if($animal->status === 'tersedia')
  <section id="orderFormSection" style="background:var(--bg2);padding:3.5rem 2rem"><div class="container">
    <div style="max-width:640px;margin:0 auto">
      <div style="text-align:center;margin-bottom:2rem">
        <div class="section-tag">Pemesanan</div>
        <h2 class="section-title">Formulir Pemesanan</h2>
        <p style="color:var(--text2);font-size:.92rem">Isi formulir di bawah, kami akan menghubungi Anda segera untuk konfirmasi.</p>
      </div>

      @if(session('inquiry_success'))
      <div class="form-success show" style="margin-bottom:1.5rem"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda via WhatsApp atau Email.</span></div>
      @endif

      @if($errors->any())
      <div class="alert-error" style="margin-bottom:1rem">{{ $errors->first() }}</div>
      @endif

      <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem">
        {{-- Info hewan yang dipesan --}}
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:1rem;margin-bottom:1.5rem;display:flex;gap:1rem;align-items:center">
          @if($animal->thumbnail)
          <img src="{{ asset('storage/'.$animal->thumbnail) }}" style="width:56px;height:56px;border-radius:8px;object-fit:cover;flex-shrink:0" alt="">
          @else
          <div style="width:56px;height:56px;border-radius:8px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:2rem;flex-shrink:0">{{ $animal->jenis_hewan==='kambing'?'🐐':'🐑' }}</div>
          @endif
          <div>
            <div style="font-weight:700;font-size:.92rem;color:var(--text)">{{ $animalName }}</div>
            <div style="font-size:.82rem;color:#15803d;font-weight:700;margin-top:.1rem">{{ $animal->harga_format }}</div>
          </div>
        </div>

        <form method="POST" action="{{ route('product.inquiry', $animal->id) }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $animal->id }}">
          <input type="hidden" name="product_name" value="{{ $animalName }}">
          <div class="form-group"><label>Nama Lengkap *</label><input type="text" name="name" class="form-control" required placeholder="Nama Anda" value="{{ old('name') }}"></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="form-group"><label>Email *</label><input type="email" name="email" class="form-control" required placeholder="email@example.com" value="{{ old('email') }}"></div>
            <div class="form-group"><label>No. WhatsApp</label><input type="tel" name="phone" class="form-control" placeholder="+62 812..." value="{{ old('phone') }}"></div>
          </div>
          <div class="form-group"><label>Pesan / Pertanyaan *</label><textarea name="message" class="form-control" required rows="4" placeholder="Contoh: Saya ingin memesan hewan ini untuk kurban idul adha. Apakah bisa diantarkan ke...">{{ old('message') }}</textarea></div>
          <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-top:.5rem">
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
            <a href="https://wa.me/{{ $waNum }}?text={{ $waMsg }}" target="_blank"
               style="display:inline-flex;align-items:center;gap:.5rem;background:#25d366;color:#fff;padding:.8rem 1.5rem;border-radius:10px;font-weight:600;text-decoration:none;font-size:.9rem">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
          </div>
        </form>
      </div>
    </div>
  </div></section>
  @endif

  {{-- Hewan Lainnya --}}
  @if(isset($related) && $related->count())
  <section style="padding:3rem 2rem"><div class="container">
    <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:800;margin-bottom:1.5rem">
      {{ ucfirst($animal->jenis_hewan) }} Lainnya
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem">
      @foreach($related as $rel)
      <a href="{{ route('kurban.show', $rel) }}" style="text-decoration:none;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all .25s;display:block" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,.12)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="height:140px;background:#f0fdf4;overflow:hidden">
          @if($rel->thumbnail)<img src="{{ asset('storage/'.$rel->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
          @else<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem">{{ $rel->jenis_hewan==='kambing'?'🐐':'🐑' }}</div>@endif
        </div>
        <div style="padding:1rem">
          <div style="font-weight:700;font-size:.9rem;color:var(--text)">{{ $rel->name ?? ucfirst($rel->jenis_hewan).' #'.$rel->id }}</div>
          <div style="font-size:.82rem;color:var(--text2);margin-top:.2rem">{{ $rel->jenis_ras ?? ($rel->kelamin==='jantan'?'Jantan':'Betina') }}</div>
          <div style="font-weight:800;color:#1a6b2f;font-size:.95rem;margin-top:.5rem">{{ $rel->harga_format }}</div>
        </div>
      </a>
      @endforeach
    </div>
    <div style="text-align:center;margin-top:2rem">
      <a href="{{ route('kurban.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:#1a6b2f;font-weight:600;text-decoration:none;font-size:.9rem">
        Lihat Semua Hewan Kurban <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div></section>
  @endif

</div>
@endif
{{-- /page-kurban-detail --}}

{{-- ====================================================================
     CSS TAMBAHAN (tambahkan ke <style> di mendelem_Home.blade.php)
==================================================================== --}}
<style>
.kurban-card:hover { transform: translateY(-6px); box-shadow: 0 12px 40px rgba(26,107,47,.15); border-color: #2d9b4e; }
.kurban-card:hover .kurban-overlay { opacity: 1; }
.thumb-item:hover { border-color: #2d9b4e !important; }
@media(max-width:768px) {
  #page-kurban-detail section > .container > div { grid-template-columns:1fr !important; }
  .kurban-detail-form-grid { grid-template-columns:1fr !important; }
}
</style>

{{-- ====================================================================
     JAVASCRIPT TAMBAHAN (tambahkan di <script> di mendelem_Home.blade.php)
==================================================================== --}}
<script>
// Ganti foto utama di detail hewan
let currentMediaSrc = '{{ isset($animal) && $animal->thumbnail ? asset("storage/".$animal->thumbnail) : "" }}';
let currentMediaType = 'image';

function switchMedia(src, type) {
  currentMediaSrc = src; currentMediaType = type;
  const main = document.getElementById('mainMedia');
  if (!main) return;

  if (type === 'video') {
    const vid = document.createElement('video');
    vid.src = src; vid.controls = true; vid.autoplay = false;
    vid.style.cssText = 'width:100%;height:100%;object-fit:contain;background:#000';
    main.innerHTML = ''; main.appendChild(vid);
  } else {
    const img = document.createElement('img');
    img.src = src; img.id = 'mainImg';
    img.style.cssText = 'width:100%;height:100%;object-fit:cover';
    img.onclick = () => openLightbox(src, 'image');
    main.innerHTML = ''; main.appendChild(img);
  }

  // Update border thumbnail aktif
  document.querySelectorAll('.thumb-item').forEach(t => t.style.borderColor = 'var(--border)');
  event?.currentTarget?.style && (event.currentTarget.style.borderColor = '#1a6b2f');
}

// Filter kambing/domba di halaman daftar
function filterKurban(jenis) {
  document.querySelectorAll('.kurban-card').forEach(card => {
    if (jenis === 'semua' || card.dataset.jenis === jenis) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
  // Update button styles
  ['semua','kambing','domba'].forEach(f => {
    const btn = document.getElementById('filter-' + f);
    if (!btn) return;
    if (f === jenis) {
      btn.style.background = 'rgba(255,255,255,.9)'; btn.style.color = '#1a6b2f';
      btn.style.borderColor = 'rgba(255,255,255,.9)';
    } else {
      btn.style.background = 'transparent'; btn.style.color = 'rgba(255,255,255,.85)';
      btn.style.borderColor = 'rgba(255,255,255,.5)';
    }
  });
}
</script>
