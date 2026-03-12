{{-- resources/views/admin/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Mendelem Project</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Plus Jakarta Sans',sans-serif;min-height:100vh;display:flex;background:#0d1117}

.login-left{flex:1;background:linear-gradient(135deg,#0a3254 0%,#0f75bd 60%,#8cc63e 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:4rem;position:relative;overflow:hidden}
.login-left::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")}
.login-brand{position:relative;z-index:1;text-align:center;color:#fff}
.brand-logo{width:80px;height:80px;background:rgba(255,255,255,.15);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:900;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)}
.brand-name{font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;margin-bottom:.5rem}
.brand-desc{color:rgba(255,255,255,.7);font-size:.9rem;line-height:1.7;max-width:320px}
.login-features{position:relative;z-index:1;margin-top:3rem;display:flex;flex-direction:column;gap:1rem}
.feature{display:flex;align-items:center;gap:.75rem;color:rgba(255,255,255,.8);font-size:.88rem}
.feature i{width:32px;height:32px;background:rgba(255,255,255,.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}

.login-right{width:480px;background:#fff;display:flex;align-items:center;justify-content:center;padding:3rem}
.login-form-wrap{width:100%;max-width:380px}
.login-form-wrap h2{font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:900;color:#1a2332;margin-bottom:.4rem}
.login-form-wrap p{color:#718096;font-size:.88rem;margin-bottom:2rem}

.form-group{margin-bottom:1.1rem}
.form-group label{display:block;font-size:.82rem;font-weight:600;color:#4a5568;margin-bottom:.45rem}
.input-wrap{position:relative}
.input-wrap i{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:#a0aec0;font-size:.85rem;pointer-events:none}
.input-wrap input{width:100%;padding:.75rem .9rem .75rem 2.5rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.9rem;font-family:inherit;outline:none;transition:all .2s;color:#1a2332;background:#f8fafc}
.input-wrap input:focus{border-color:#0f75bd;background:#fff;box-shadow:0 0 0 3px rgba(15,117,189,.1)}
.toggle-pwd{position:absolute;right:.9rem;top:50%;transform:translateY(-50%);color:#a0aec0;cursor:pointer;font-size:.85rem;background:none;border:none;padding:0}

.remember-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
.check-label{display:flex;align-items:center;gap:.5rem;font-size:.83rem;color:#4a5568;cursor:pointer}
.check-label input{accent-color:#0f75bd;cursor:pointer}

.btn-login{width:100%;padding:.85rem;background:linear-gradient(135deg,#0f75bd,#0a5a91);color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;font-family:inherit;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.5rem}
.btn-login:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(15,117,189,.35)}
.btn-login:active{transform:none}

.error-box{background:rgba(229,62,62,.08);border:1px solid rgba(229,62,62,.25);border-radius:8px;padding:.75rem .9rem;margin-bottom:1rem;font-size:.83rem;color:#c53030;display:flex;align-items:center;gap:.5rem}
.login-back{margin-top:1.5rem;text-align:center;font-size:.83rem;color:#718096}
.login-back a{color:#0f75bd;font-weight:600;text-decoration:none}
.login-back a:hover{text-decoration:underline}

@media(max-width:768px){
  .login-left{display:none}
  .login-right{width:100%;padding:2rem 1.5rem}
}
</style>
</head>
<body>

<div class="login-left">
  <div class="login-brand">
    <div class="brand-logo">M</div>
    <div class="brand-name">Mendelem Project</div>
    <div class="brand-desc">Panel administrasi untuk mengelola seluruh konten, proyek, produk, dan pengaturan website Mendelem Project.</div>
  </div>
  <div class="login-features">
    <div class="feature"><i class="fas fa-edit"></i> Edit konten dengan auto-translate ID→EN</div>
    <div class="feature"><i class="fas fa-upload"></i> Upload foto & video langsung</div>
    <div class="feature"><i class="fas fa-chart-bar"></i> Kelola statistik & grafik</div>
    <div class="feature"><i class="fas fa-cog"></i> Pengaturan situs terpusat</div>
  </div>
</div>

<div class="login-right">
  <div class="login-form-wrap">
    <h2>Selamat Datang</h2>
    <p>Masuk ke panel admin Mendelem Project</p>

    @if(session('success'))
      <div class="error-box" style="background:rgba(56,161,105,.08);border-color:rgba(56,161,105,.25);color:#276749">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="error-box"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @if($errors->has('username'))
      <div class="error-box"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('username') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrap">
          <i class="fas fa-user"></i>
          <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="adminPro" autocomplete="username" autofocus>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrap">
          <i class="fas fa-lock"></i>
          <input type="password" id="password" name="password" placeholder="••••••••••••" autocomplete="current-password">
          <button type="button" class="toggle-pwd" onclick="togglePwd()"><i class="fas fa-eye" id="pwdIcon"></i></button>
        </div>
      </div>
      <div class="remember-row">
        <label class="check-label">
          <input type="checkbox" name="remember"> Ingat saya
        </label>
      </div>
      <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
      </button>
    </form>

    <div class="login-back">
      <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Kembali ke Website</a>
    </div>
  </div>
</div>

<script>
function togglePwd() {
  const inp = document.getElementById('password');
  const ico = document.getElementById('pwdIcon');
  if (inp.type === 'password') { inp.type = 'text'; ico.className = 'fas fa-eye-slash'; }
  else { inp.type = 'password'; ico.className = 'fas fa-eye'; }
}
</script>
</body>
</html>
