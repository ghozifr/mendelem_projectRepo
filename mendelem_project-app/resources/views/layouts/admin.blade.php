<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') — Mendelem Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{
  --blue:#0f75bd; --blue-d:#0a5a91; --blue-l:#3b9dd4;
  --green:#8cc63e; --green-d:#6fa02e;
  --bg:#f0f4f8; --card:#ffffff; --sidebar:#1a2332;
  --sidebar-l:#243040; --sidebar-txt:rgba(255,255,255,.7);
  --sidebar-active:#fff; --text:#1a2332; --text2:#4a5568;
  --text3:#718096; --border:#e2e8f0;
  --radius:12px; --shadow:0 2px 12px rgba(0,0,0,.06);
  --sidebar-w:260px; --topbar-h:64px;
  --danger:#e53e3e; --success:#38a169; --warning:#d97706;
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh}

/* ── SIDEBAR ── */
.sidebar{width:var(--sidebar-w);background:var(--sidebar);position:fixed;top:0;left:0;bottom:0;display:flex;flex-direction:column;z-index:100;transition:transform .3s}
.sidebar-brand{padding:1.5rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:.75rem;flex-shrink:0}
.brand-icon{width:40px;height:40px;background:linear-gradient(135deg,var(--blue),var(--green));border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Playfair Display',serif;font-weight:900;font-size:1.1rem;flex-shrink:0}
.brand-text{color:#fff;font-weight:700;font-size:.95rem;line-height:1.2}
.brand-text small{display:block;font-size:.68rem;font-weight:400;color:rgba(255,255,255,.45);letter-spacing:.06em;text-transform:uppercase;margin-top:.1rem}
.sidebar-nav{flex:1;overflow-y:auto;padding:1rem 0}
.nav-section{padding:.75rem 1.25rem .25rem;font-size:.65rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.3)}
.nav-item{display:flex;align-items:center;gap:.75rem;padding:.65rem 1.25rem;color:var(--sidebar-txt);text-decoration:none;font-size:.85rem;font-weight:500;border-radius:0;transition:all .2s;position:relative;margin:1px 0}
.nav-item:hover{background:rgba(255,255,255,.07);color:#fff}
.nav-item.active{background:rgba(15,117,189,.25);color:#fff}
.nav-item.active::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--blue);border-radius:0 3px 3px 0}
.nav-item i{width:18px;text-align:center;font-size:.9rem;flex-shrink:0}
.nav-badge{margin-left:auto;background:var(--danger);color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .45rem;border-radius:99px}
.sidebar-footer{padding:1rem 1.25rem;border-top:1px solid rgba(255,255,255,.08)}
.user-card{display:flex;align-items:center;gap:.75rem}
.user-avatar{width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,var(--blue),var(--green));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.9rem;flex-shrink:0}
.user-info{flex:1;min-width:0}
.user-name{color:#fff;font-size:.82rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-role{color:rgba(255,255,255,.4);font-size:.7rem;text-transform:uppercase;letter-spacing:.06em}
.logout-btn{color:rgba(255,255,255,.4);text-decoration:none;font-size:.8rem;padding:.35rem .6rem;border-radius:6px;transition:all .2s;flex-shrink:0}
.logout-btn:hover{color:#fff;background:rgba(229,62,62,.3)}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{height:var(--topbar-h);background:var(--card);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 1.5rem;gap:1rem;position:sticky;top:0;z-index:50;box-shadow:var(--shadow)}
.topbar-title{font-weight:700;font-size:1.05rem;color:var(--text)}
.topbar-subtitle{font-size:.8rem;color:var(--text3);margin-top:.1rem}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:.75rem}
.topbar-btn{width:36px;height:36px;border-radius:8px;border:1px solid var(--border);background:var(--bg);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text2);font-size:.85rem;text-decoration:none;transition:all .2s}
.topbar-btn:hover{border-color:var(--blue);color:var(--blue)}
.unread-dot{position:relative}
.unread-dot::after{content:attr(data-count);position:absolute;top:-4px;right:-4px;background:var(--danger);color:#fff;font-size:.55rem;font-weight:700;width:14px;height:14px;border-radius:50%;display:flex;align-items:center;justify-content:center}
.content{padding:1.5rem;flex:1}

/* ── CARDS ── */
.page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem}
.page-header h1{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700}
.page-header p{color:var(--text3);font-size:.85rem;margin-top:.2rem}
.card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow)}
.card-header{padding:1rem 1.25rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.card-header h2{font-size:.95rem;font-weight:700;color:var(--text)}
.card-body{padding:1.25rem}
.card-footer{padding:.75rem 1.25rem;border-top:1px solid var(--border);background:var(--bg)}

/* ── STATS GRID ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem}
.stat-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:var(--shadow)}
.stat-icon{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}
.stat-icon.blue{background:rgba(15,117,189,.12);color:var(--blue)}
.stat-icon.green{background:rgba(140,198,62,.12);color:var(--green)}
.stat-icon.red{background:rgba(229,62,62,.12);color:var(--danger)}
.stat-icon.orange{background:rgba(217,119,6,.12);color:var(--warning)}
.stat-num{font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:700;line-height:1;color:var(--text)}
.stat-lbl{font-size:.78rem;color:var(--text3);margin-top:.2rem}

/* ── TABLES ── */
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:.85rem}
thead th{padding:.65rem .9rem;text-align:left;font-size:.75rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);border-bottom:2px solid var(--border);background:var(--bg);white-space:nowrap}
tbody td{padding:.75rem .9rem;border-bottom:1px solid var(--border);vertical-align:middle}
tbody tr:hover{background:rgba(15,117,189,.03)}
tbody tr:last-child td{border-bottom:0}
.thumb-sm{width:44px;height:44px;border-radius:8px;object-fit:cover;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text3);font-size:.9rem}
.thumb-sm img{width:100%;height:100%;object-fit:cover;border-radius:8px}

/* ── BADGES ── */
.badge{display:inline-flex;align-items:center;padding:.2rem .6rem;border-radius:99px;font-size:.72rem;font-weight:700;letter-spacing:.04em}
.badge-green{background:rgba(56,161,105,.12);color:var(--success)}
.badge-blue{background:rgba(15,117,189,.12);color:var(--blue)}
.badge-red{background:rgba(229,62,62,.12);color:var(--danger)}
.badge-gray{background:rgba(113,128,150,.12);color:var(--text3)}
.badge-orange{background:rgba(217,119,6,.12);color:var(--warning)}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1rem;border-radius:8px;font-size:.83rem;font-weight:600;font-family:inherit;cursor:pointer;text-decoration:none;border:1px solid transparent;transition:all .2s;white-space:nowrap}
.btn-primary{background:var(--blue);color:#fff;border-color:var(--blue)}
.btn-primary:hover{background:var(--blue-d)}
.btn-success{background:var(--success);color:#fff;border-color:var(--success)}
.btn-danger{background:var(--danger);color:#fff;border-color:var(--danger)}
.btn-danger:hover{background:#c53030}
.btn-outline{background:transparent;color:var(--text2);border-color:var(--border)}
.btn-outline:hover{border-color:var(--blue);color:var(--blue)}
.btn-sm{padding:.35rem .75rem;font-size:.78rem}
.btn-icon{width:32px;height:32px;padding:0;justify-content:center;border-radius:7px}

/* ── FORMS ── */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
.form-group{display:flex;flex-direction:column;gap:.4rem}
.form-group.full{grid-column:1/-1}
label{font-size:.82rem;font-weight:600;color:var(--text2)}
label .required{color:var(--danger)}
.form-control{padding:.65rem .9rem;border-radius:8px;border:1px solid var(--border);background:#fff;color:var(--text);font-size:.88rem;font-family:inherit;outline:none;transition:all .2s;width:100%}
.form-control:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(15,117,189,.1)}
.form-control[readonly]{background:var(--bg);color:var(--text3)}
textarea.form-control{resize:vertical;min-height:100px}
select.form-control{cursor:pointer}
.form-hint{font-size:.76rem;color:var(--text3);margin-top:.2rem}
.form-check{display:flex;align-items:center;gap:.5rem;cursor:pointer}
.form-check input{width:16px;height:16px;cursor:pointer;accent-color:var(--blue)}
.form-check label{font-size:.85rem;color:var(--text2);cursor:pointer;margin:0}

/* ── TRANSLATE BOX ── */
.translate-group{position:relative}
.translate-btn{position:absolute;right:.6rem;bottom:.6rem;padding:.3rem .7rem;border-radius:6px;border:1px solid var(--border);background:var(--bg);font-size:.73rem;font-weight:600;color:var(--blue);cursor:pointer;display:flex;align-items:center;gap:.3rem;transition:all .2s;font-family:inherit}
.translate-btn:hover{background:var(--blue);color:#fff;border-color:var(--blue)}
.translate-btn.loading{opacity:.6;pointer-events:none}

/* ── FILE UPLOAD ── */
.upload-zone{border:2px dashed var(--border);border-radius:10px;padding:2rem;text-align:center;cursor:pointer;transition:all .2s;background:var(--bg)}
.upload-zone:hover,.upload-zone.dragover{border-color:var(--blue);background:rgba(15,117,189,.04)}
.upload-zone i{font-size:2rem;color:var(--text3);margin-bottom:.75rem}
.upload-zone p{font-size:.85rem;color:var(--text2)}
.upload-zone small{font-size:.75rem;color:var(--text3)}
.preview-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:.75rem;margin-top:1rem}
.preview-item{position:relative;border-radius:8px;overflow:hidden;aspect-ratio:1;border:1px solid var(--border)}
.preview-item img{width:100%;height:100%;object-fit:cover}
.preview-item video{width:100%;height:100%;object-fit:cover}
.preview-del{position:absolute;top:.25rem;right:.25rem;width:22px;height:22px;border-radius:50%;background:rgba(229,62,62,.9);color:#fff;border:none;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center}

/* ── ALERTS ── */
.alert{display:flex;align-items:flex-start;gap:.75rem;padding:.9rem 1.1rem;border-radius:10px;font-size:.85rem;margin-bottom:1rem}
.alert-success{background:rgba(56,161,105,.1);border:1px solid rgba(56,161,105,.3);color:var(--success)}
.alert-error{background:rgba(229,62,62,.1);border:1px solid rgba(229,62,62,.3);color:var(--danger)}
.alert-warning{background:rgba(217,119,6,.1);border:1px solid rgba(217,119,6,.3);color:var(--warning)}
.alert-info{background:rgba(15,117,189,.1);border:1px solid rgba(15,117,189,.3);color:var(--blue)}

/* ── PAGINATION ── */
.pagination{display:flex;align-items:center;gap:.35rem;flex-wrap:wrap}
.pagination a,.pagination span{padding:.4rem .75rem;border-radius:7px;font-size:.82rem;font-weight:500;text-decoration:none;border:1px solid var(--border);color:var(--text2);background:var(--card);transition:all .2s}
.pagination a:hover{border-color:var(--blue);color:var(--blue)}
.pagination .active span{background:var(--blue);border-color:var(--blue);color:#fff}
.pagination .disabled span{opacity:.5;pointer-events:none}

/* ── MOBILE ── */
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .stats-grid{grid-template-columns:repeat(2,1fr)}
  .form-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">M</div>
    <div class="brand-text">Mendelem Admin<small>Control Panel</small></div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ url('/')  }}" target="_blank" class="nav-item">
      <i class="fas fa-external-link-alt"></i> Lihat Website
    </a>

    <div class="nav-section">Konten</div>
    <a href="{{ route('admin.sliders.index') }}" class="nav-item {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
      <i class="fas fa-images"></i> Slider / Hero
    </a>
    <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
      <i class="fas fa-folder-open"></i> Proyek
    </a>
    <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
      <i class="fas fa-store"></i> Produk
    </a>
    <a href="{{ route('admin.kurban.index') }}"class="nav-item {{ request()->routeIs('admin.kurban*') ? 'active' : '' }}">
  <span class="nav-icon">🐐</span>
  <span class="nav-label">Kambing Kurban</span>
</a>
    <a href="{{ route('admin.articles.index') }}" class="nav-item {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
      <i class="fas fa-newspaper"></i> Artikel
    </a>
    <a href="{{ route('admin.gallery.index') }}" class="nav-item {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
      <i class="fas fa-photo-video"></i> Galeri
    </a>

    <div class="nav-section">Tim & Data</div>
    <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
      <i class="fas fa-users"></i> Tim
    </a>
    <a href="{{ route('admin.statistics.index') }}" class="nav-item {{ request()->routeIs('admin.statistics*') ? 'active' : '' }}">
      <i class="fas fa-chart-bar"></i> Statistik
    </a>
    <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages*') ? 'active' : '' }} {{ $unreadMessages > 0 ? 'unread-dot' : '' }}" data-count="{{ $unreadMessages > 0 ? $unreadMessages : '' }}">
      <i class="fas fa-envelope"></i> Pesan
      @if($unreadMessages > 0)
        <span class="nav-badge">{{ $unreadMessages }}</span>
      @endif
    </a>

    <div class="nav-section">Pengaturan</div>
    <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <i class="fas fa-cog"></i> Pengaturan Situs
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card">
      <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      <div class="user-info">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-role">{{ auth()->user()->role }}</div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}" style="margin:0">
        @csrf
        <button type="submit" class="logout-btn" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
      </form>
    </div>
  </div>
</aside>

{{-- MAIN --}}
<div class="main">
  {{-- TOPBAR --}}
  <div class="topbar">
    <button class="topbar-btn" id="sidebarToggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
      <i class="fas fa-bars"></i>
    </button>
    <div>
      <div class="topbar-title">@yield('page-title','Dashboard')</div>
      <div class="topbar-subtitle">@yield('page-subtitle','Mendelem Project Admin Panel')</div>
    </div>
    <div class="topbar-right">
      <a href="{{ route('admin.messages.index') }}" class="topbar-btn" title="Pesan">
        <i class="fas fa-envelope"></i>
      </a>
      <a href="{{ url('/')  }}" target="_blank" class="topbar-btn" title="Lihat Website">
        <i class="fas fa-external-link-alt"></i>
      </a>
    </div>
  </div>

  {{-- CONTENT --}}
  <div class="content">
    {{-- Flash messages --}}
    @if(session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-error">
        <i class="fas fa-exclamation-triangle"></i>
        <div><strong>Terdapat kesalahan:</strong><ul style="margin:.4rem 0 0 1rem">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
      </div>
    @endif

    @yield('content')
  </div>
</div>

<script>
// CSRF for AJAX
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content;

// ── AUTO-TRANSLATE ────────────────────────────────────────────
function autoTranslate(sourceId, targetId, btn) {
  const sourceEl = document.getElementById(sourceId);
  const targetEl = document.getElementById(targetId);
  const text = sourceEl.value.trim();
  if (!text) { alert('Tulis teks bahasa Indonesia terlebih dahulu.'); return; }

  btn.classList.add('loading');
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menerjemahkan...';

  fetch('{{ route("admin.translate") }}', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify({ text })
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      targetEl.value = data.translated;
      targetEl.style.borderColor = '#38a169';
      setTimeout(() => targetEl.style.borderColor = '', 2000);
    } else {
      alert(data.message || 'Terjemahan gagal, isi manual.');
    }
  })
  .catch(() => alert('Koneksi gagal. Isi versi Inggris secara manual.'))
  .finally(() => {
    btn.classList.remove('loading');
    btn.innerHTML = '<i class="fas fa-language"></i> Terjemahkan';
  });
}

// ── FILE PREVIEW ─────────────────────────────────────────────
function setupUploadZone(zoneId, inputId, previewId) {
  const zone  = document.getElementById(zoneId);
  const input = document.getElementById(inputId);
  const prev  = document.getElementById(previewId);
  if (!zone || !input) return;

  zone.addEventListener('click', () => input.click());
  zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('dragover'); });
  zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
  zone.addEventListener('drop', e => {
    e.preventDefault(); zone.classList.remove('dragover');
    input.files = e.dataTransfer.files;
    showPreviews(input.files, prev);
  });
  input.addEventListener('change', () => showPreviews(input.files, prev));
}

function showPreviews(files, container) {
  if (!container) return;
  container.innerHTML = '';
  [...files].forEach(file => {
    const div = document.createElement('div');
    div.className = 'preview-item';
    const url = URL.createObjectURL(file);
    if (file.type.startsWith('video')) {
      div.innerHTML = `<video src="${url}" muted></video>`;
    } else {
      div.innerHTML = `<img src="${url}" alt="">`;
    }
    container.appendChild(div);
  });
}

// Auto-dismiss alerts
setTimeout(() => {
  document.querySelectorAll('.alert').forEach(a => {
    a.style.transition = 'opacity .5s';
    a.style.opacity = '0';
    setTimeout(() => a.remove(), 500);
  });
}, 4000);
</script>

@stack('scripts')
</body>
</html>
