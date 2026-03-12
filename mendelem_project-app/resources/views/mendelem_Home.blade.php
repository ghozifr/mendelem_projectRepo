<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mendelem Project</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root {
  --blue: #0f75bd;
  --blue-dark: #0a5a91;
  --blue-light: #3b9dd4;
  --green: #8cc63e;
  --green-dark: #6fa02e;
  --white: #ffffff;
  --bg: #f8fafc;
  --bg2: #eef3f8;
  --card: #ffffff;
  --text: #1a2332;
  --text2: #4a5568;
  --text3: #718096;
  --border: #e2e8f0;
  --shadow: 0 4px 24px rgba(15,117,189,0.08);
  --shadow-lg: 0 12px 48px rgba(15,117,189,0.16);
  --radius: 16px;
  --nav-h: 72px;
  --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
}
[data-theme="dark"] {
  --bg: #0d1117;
  --bg2: #161b22;
  --card: #1c2431;
  --text: #e6edf3;
  --text2: #b3bcc8;
  --text3: #7d8fa4;
  --border: #30363d;
  --shadow: 0 4px 24px rgba(0,0,0,0.4);
  --shadow-lg: 0 12px 48px rgba(0,0,0,0.5);
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);transition:background var(--transition),color var(--transition);min-height:100vh}

/* ===== NAVBAR ===== */
nav{position:fixed;top:0;left:0;right:0;height:var(--nav-h);background:var(--card);border-bottom:1px solid var(--border);z-index:1000;display:flex;align-items:center;padding:0 2rem;gap:1.5rem;backdrop-filter:blur(12px);transition:all var(--transition)}
nav.scrolled{box-shadow:var(--shadow)}
.nav-logo{display:flex;align-items:center;gap:.75rem;text-decoration:none;flex-shrink:0}
.nav-logo-icon{width:40px;height:40px;background:linear-gradient(135deg,var(--blue),var(--green));border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:1.1rem;font-family:'Playfair Display',serif}
.nav-logo-text{font-family:'Playfair Display',serif;font-weight:700;font-size:1.1rem;color:var(--text);line-height:1.1}
.nav-logo-text span{display:block;font-size:.65rem;font-family:'Plus Jakarta Sans',sans-serif;font-weight:400;color:var(--text3);letter-spacing:.08em;text-transform:uppercase}
.nav-links{display:flex;align-items:center;gap:.25rem;margin-left:1rem;flex:1}
.nav-links a{text-decoration:none;padding:.5rem .85rem;border-radius:8px;font-size:.85rem;font-weight:500;color:var(--text2);transition:all var(--transition);white-space:nowrap}
.nav-links a:hover,.nav-links a.active{color:var(--blue);background:rgba(15,117,189,.08)}
.nav-actions{display:flex;align-items:center;gap:.75rem;margin-left:auto}
.lang-toggle{display:flex;align-items:center;gap:.25rem;background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.3rem .6rem;cursor:pointer;font-size:.8rem;font-weight:600;color:var(--text2);transition:all var(--transition)}
.lang-toggle:hover{border-color:var(--blue);color:var(--blue)}
.theme-btn{width:38px;height:38px;border-radius:8px;border:1px solid var(--border);background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text2);font-size:.95rem;transition:all var(--transition)}
.theme-btn:hover{border-color:var(--blue);color:var(--blue)}
.nav-cta{background:var(--blue);color:#fff;padding:.5rem 1.1rem;border-radius:8px;font-size:.85rem;font-weight:600;text-decoration:none;transition:all var(--transition);white-space:nowrap}
.nav-cta:hover{background:var(--blue-dark);transform:translateY(-1px)}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.5rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border)}
.hamburger span{width:20px;height:2px;background:var(--text);border-radius:2px;transition:all var(--transition)}
.mobile-menu{display:none;position:fixed;top:var(--nav-h);left:0;right:0;background:var(--card);border-bottom:1px solid var(--border);padding:1rem;flex-direction:column;gap:.25rem;z-index:999}
.mobile-menu.open{display:flex}
.mobile-menu a{text-decoration:none;padding:.75rem 1rem;border-radius:8px;font-size:.9rem;font-weight:500;color:var(--text2);transition:all var(--transition)}
.mobile-menu a:hover{color:var(--blue);background:rgba(15,117,189,.08)}

/* ===== PAGES ===== */
.page{display:none;min-height:100vh;padding-top:var(--nav-h)}
.page.active{display:block}

/* ===== HOME ===== */
.hero-slider{position:relative;height:calc(100vh - var(--nav-h));overflow:hidden;background:#0d1b2a}
.slide{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .8s ease;background:linear-gradient(135deg,#0d1b2a 0%,#0a3254 50%,#0f75bd 100%)}
.slide.active{opacity:1;z-index:1}
.slide-video-placeholder{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem;color:rgba(255,255,255,.3);font-size:.85rem}
.slide-video-placeholder i{font-size:4rem;opacity:.4}
.slide-content{position:relative;z-index:2;text-align:center;color:#fff;padding:2rem;max-width:700px}
.slide-tag{display:inline-block;background:var(--green);color:#fff;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem .9rem;border-radius:99px;margin-bottom:1.5rem}
.slide-content h1{font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:900;line-height:1.15;margin-bottom:1rem;text-shadow:0 2px 20px rgba(0,0,0,.4)}
.slide-content p{font-size:1.05rem;color:rgba(255,255,255,.8);max-width:520px;margin:0 auto 2rem}
.slide-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.btn-primary{background:var(--blue);color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-primary:hover{background:var(--blue-dark);transform:translateY(-2px);box-shadow:0 8px 24px rgba(15,117,189,.4)}
.btn-outline{background:transparent;color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;border:2px solid rgba(255,255,255,.4);transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-outline:hover{background:rgba(255,255,255,.1);border-color:#fff}
.slider-nav{position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;gap:.5rem;z-index:10}
.slider-dot{width:8px;height:8px;border-radius:99px;background:rgba(255,255,255,.4);cursor:pointer;transition:all var(--transition)}
.slider-dot.active{background:#fff;width:24px}
.slider-arrows{position:absolute;top:50%;left:0;right:0;display:flex;justify-content:space-between;padding:0 1.5rem;transform:translateY(-50%);z-index:10}
.slider-arrow{width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);transition:all var(--transition)}
.slider-arrow:hover{background:rgba(255,255,255,.25)}

/* ===== SECTIONS ===== */
section{padding:5rem 2rem}
.container{max-width:1200px;margin:0 auto}
.section-tag{display:inline-block;background:rgba(15,117,189,.1);color:var(--blue);font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem .9rem;border-radius:99px;margin-bottom:1rem}
.section-title{font-family:'Playfair Display',serif;font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:800;line-height:1.2;margin-bottom:1rem;color:var(--text)}
.section-subtitle{color:var(--text2);font-size:1rem;max-width:560px;line-height:1.7}
.section-header{margin-bottom:3.5rem}
.section-header.center{text-align:center}
.section-header.center .section-subtitle{margin:0 auto}

/* ===== STATS BAR ===== */
.stats-bar{background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;padding:3rem 2rem}
.stats-bar .container{display:grid;grid-template-columns:repeat(4,1fr);gap:2rem}
.stat-item{text-align:center}
.stat-num{font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:900;line-height:1;margin-bottom:.4rem}
.stat-label{font-size:.82rem;opacity:.8;letter-spacing:.05em;text-transform:uppercase}

/* ===== CARDS ===== */
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem}
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}
.card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition);cursor:pointer}
.card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.card-img{height:180px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.8rem}
.card-img i{font-size:2rem;color:var(--blue);opacity:.5}
.card-body{padding:1.5rem}
.card-tag{display:inline-block;background:rgba(140,198,62,.15);color:var(--green-dark);font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.25rem .7rem;border-radius:99px;margin-bottom:.75rem}
.card-title{font-family:'Playfair Display',serif;font-weight:700;font-size:1.1rem;margin-bottom:.5rem;color:var(--text)}
.card-desc{font-size:.85rem;color:var(--text2);line-height:1.6}
.card-link{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;font-size:.83rem;font-weight:600;color:var(--blue);text-decoration:none}
.card-link:hover{gap:.65rem}

/* ===== PROJECT PAGE ===== */
.projects-hero{background:linear-gradient(135deg,var(--blue) 0%,var(--blue-dark) 100%);color:#fff;padding:5rem 2rem;text-align:center}
.projects-hero h1{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3rem);font-weight:900;margin-bottom:1rem}
.projects-hero p{font-size:1rem;opacity:.85;max-width:560px;margin:0 auto}
.project-detail-banner{height:320px;background:linear-gradient(135deg,var(--blue-dark),var(--blue));display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:.85rem;flex-direction:column;gap:.75rem;font-size:.85rem}
.project-detail-banner i{font-size:4rem;opacity:.4;color:#fff}

/* ===== MAP PAGE ===== */
.map-embed{border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);height:480px}
.map-embed iframe{width:100%;height:100%;border:0}

/* ===== GALLERY ===== */
.gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:200px;gap:1rem}
.gallery-item{background:linear-gradient(135deg,var(--bg2),var(--border));border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.78rem;overflow:hidden;transition:all var(--transition);cursor:pointer;border:1px solid var(--border)}
.gallery-item:hover{transform:scale(1.02);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.gallery-item.large{grid-column:span 2;grid-row:span 2}
.gallery-item i{font-size:2rem;color:var(--blue);opacity:.5}

/* ===== ABOUT ===== */
.timeline{position:relative;padding-left:2rem}
.timeline::before{content:'';position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--blue),var(--green))}
.timeline-item{position:relative;margin-bottom:2.5rem;padding-left:1.5rem}
.timeline-item::before{content:'';position:absolute;left:-2.45rem;top:.35rem;width:14px;height:14px;border-radius:50%;background:var(--blue);border:3px solid var(--card)}
.timeline-year{font-size:.78rem;font-weight:700;color:var(--blue);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.4rem}
.timeline-title{font-weight:700;margin-bottom:.35rem;color:var(--text)}
.timeline-desc{font-size:.88rem;color:var(--text2);line-height:1.6}
.team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem}
.team-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;text-align:center;transition:all var(--transition)}
.team-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--green)}
.team-avatar{width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--green));margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700}
.team-name{font-weight:700;margin-bottom:.25rem;color:var(--text)}
.team-role{font-size:.8rem;color:var(--text3)}

/* ===== CHART ===== */
.chart-container{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem}
.chart-title{font-weight:700;margin-bottom:1.5rem;color:var(--text)}
.bar-chart{display:flex;flex-direction:column;gap:.85rem}
.bar-row{display:grid;grid-template-columns:160px 1fr 80px;align-items:center;gap:1rem}
.bar-label{font-size:.83rem;color:var(--text2);font-weight:500}
.bar-track{height:10px;background:var(--bg2);border-radius:99px;overflow:hidden}
.bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--blue),var(--green));transition:width 1s cubic-bezier(0.4,0,0.2,1)}
.bar-val{font-size:.83rem;font-weight:700;color:var(--blue);text-align:right}
.donut-wrapper{display:flex;align-items:center;gap:3rem;flex-wrap:wrap}
.donut-svg{flex-shrink:0}
.donut-legend{display:flex;flex-direction:column;gap:.75rem}
.legend-item{display:flex;align-items:center;gap:.6rem;font-size:.85rem;color:var(--text2)}
.legend-dot{width:12px;height:12px;border-radius:3px;flex-shrink:0}

/* ===== ARTICLES ===== */
.article-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition)}
.article-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.article-img{height:200px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.78rem}
.article-img i{font-size:2.5rem;color:var(--blue);opacity:.4}
.article-body{padding:1.5rem}
.article-meta{display:flex;gap:1rem;font-size:.78rem;color:var(--text3);margin-bottom:.75rem}
.article-meta span{display:flex;align-items:center;gap:.3rem}
.article-title{font-family:'Playfair Display',serif;font-weight:700;font-size:1.15rem;margin-bottom:.5rem;color:var(--text);line-height:1.35}
.article-excerpt{font-size:.85rem;color:var(--text2);line-height:1.65}

/* ===== PRODUCTS ===== */
.product-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition)}
.product-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--green)}
.product-img{height:160px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;flex-direction:column;gap:.5rem;color:var(--text3);font-size:.78rem}
.product-img i{font-size:2.5rem;color:var(--green);opacity:.6}
.product-body{padding:1.25rem}
.product-name{font-weight:700;font-size:1rem;margin-bottom:.3rem;color:var(--text)}
.product-cat{font-size:.75rem;color:var(--text3);margin-bottom:.5rem}
.product-desc{font-size:.83rem;color:var(--text2);line-height:1.55}
.product-badge{display:inline-block;background:rgba(140,198,62,.12);color:var(--green-dark);font-size:.7rem;font-weight:700;padding:.2rem .6rem;border-radius:99px;margin-top:.5rem}

/* ===== SUPPORT PAGE ===== */
.support-grid{display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start}
.support-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem}
.support-card h3{font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:700;margin-bottom:.75rem;color:var(--text)}
.support-card p{font-size:.9rem;color:var(--text2);line-height:1.7;margin-bottom:1rem}
.bank-info{background:var(--bg2);border-radius:10px;padding:1.25rem;margin:.75rem 0;font-size:.88rem}
.bank-info strong{display:block;color:var(--text);margin-bottom:.25rem}
.bank-info span{color:var(--text2)}

/* ===== CONTACT FORM ===== */
.form-group{margin-bottom:1.25rem}
.form-group label{display:block;font-size:.85rem;font-weight:600;margin-bottom:.5rem;color:var(--text2)}
.form-control{width:100%;padding:.75rem 1rem;border-radius:10px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.9rem;font-family:inherit;transition:all var(--transition);outline:none}
.form-control:focus{border-color:var(--blue);background:var(--card);box-shadow:0 0 0 3px rgba(15,117,189,.12)}
textarea.form-control{resize:vertical;min-height:120px}
.btn-submit{background:var(--blue);color:#fff;padding:.8rem 2rem;border-radius:10px;border:none;font-size:.9rem;font-weight:600;font-family:inherit;cursor:pointer;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-submit:hover{background:var(--blue-dark);transform:translateY(-2px)}
.form-success{display:none;background:rgba(140,198,62,.12);border:1px solid var(--green);border-radius:10px;padding:1rem 1.25rem;color:var(--green-dark);font-size:.88rem;margin-top:1rem;align-items:center;gap:.5rem}
.form-success.show{display:flex}

/* ===== ADMIN PANEL ===== */
.admin-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:2000;backdrop-filter:blur(4px)}
.admin-overlay.open{display:flex;align-items:center;justify-content:center;padding:1rem}
.admin-modal{background:var(--card);border:1px solid var(--border);border-radius:20px;width:100%;max-width:860px;max-height:90vh;overflow-y:auto;box-shadow:var(--shadow-lg)}
.admin-header{padding:1.5rem 2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:var(--card);z-index:1}
.admin-header h2{font-family:'Playfair Display',serif;font-weight:700;font-size:1.3rem}
.admin-close{width:36px;height:36px;border-radius:8px;border:1px solid var(--border);background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text2);font-size:.9rem;transition:all var(--transition)}
.admin-close:hover{border-color:red;color:red}
.admin-tabs{display:flex;gap:.25rem;padding:1rem 2rem;border-bottom:1px solid var(--border);overflow-x:auto}
.admin-tab{padding:.5rem 1rem;border-radius:8px;font-size:.83rem;font-weight:600;cursor:pointer;color:var(--text2);transition:all var(--transition);white-space:nowrap;border:none;background:transparent}
.admin-tab.active{background:var(--blue);color:#fff}
.admin-body{padding:2rem}
.admin-section{display:none}
.admin-section.active{display:block}
.admin-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.input-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:1rem}
.input-group label{font-size:.82rem;font-weight:600;color:var(--text2)}
.input-group input,.input-group textarea,.input-group select{padding:.65rem .9rem;border-radius:8px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.85rem;font-family:inherit;outline:none;transition:all var(--transition)}
.input-group input:focus,.input-group textarea:focus,.input-group select:focus{border-color:var(--blue);background:var(--card)}
.input-group textarea{resize:vertical;min-height:90px}
.admin-save{background:var(--blue);color:#fff;padding:.65rem 1.5rem;border-radius:8px;border:none;font-size:.85rem;font-weight:600;font-family:inherit;cursor:pointer;transition:all var(--transition)}
.admin-save:hover{background:var(--blue-dark)}
.admin-list{display:flex;flex-direction:column;gap:.75rem}
.admin-list-item{background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:1rem;display:flex;justify-content:space-between;align-items:center}
.admin-list-item strong{font-size:.88rem;color:var(--text)}
.admin-list-item small{font-size:.78rem;color:var(--text3)}
.admin-item-actions{display:flex;gap:.5rem}
.btn-edit,.btn-del{padding:.35rem .75rem;border-radius:6px;border:1px solid var(--border);font-size:.78rem;font-weight:600;cursor:pointer;transition:all var(--transition)}
.btn-edit{background:rgba(15,117,189,.1);color:var(--blue)}
.btn-edit:hover{background:var(--blue);color:#fff}
.btn-del{background:rgba(220,53,69,.1);color:#dc3545}
.btn-del:hover{background:#dc3545;color:#fff}
.admin-login{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3rem;gap:1.5rem;text-align:center}
.admin-login h3{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700}
.admin-login p{color:var(--text2);font-size:.88rem}
.admin-login input{width:100%;max-width:320px;padding:.75rem 1rem;border-radius:10px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.9rem;font-family:inherit;outline:none;transition:all var(--transition)}
.admin-login input:focus{border-color:var(--blue)}
.admin-login button{background:var(--blue);color:#fff;padding:.75rem 2rem;border-radius:10px;border:none;font-size:.9rem;font-weight:600;cursor:pointer;transition:all var(--transition)}
.admin-login button:hover{background:var(--blue-dark)}
.admin-login .err{color:#dc3545;font-size:.83rem}

/* ===== FOOTER ===== */
footer{background:var(--text);color:rgba(255,255,255,.9);padding:4rem 2rem 2rem}
[data-theme="dark"] footer{background:#060b11}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;margin-bottom:3rem}
.footer-brand .nav-logo-text{color:#fff}
.footer-brand .nav-logo-text span{color:rgba(255,255,255,.5)}
.footer-desc{margin:.75rem 0;font-size:.85rem;color:rgba(255,255,255,.6);line-height:1.7}
.footer-social{display:flex;gap:.5rem;margin-top:1rem}
.social-btn{width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;transition:all var(--transition)}
.social-btn:hover{background:var(--blue);color:#fff}
.footer-col h4{font-size:.82rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:1rem;color:rgba(255,255,255,.5)}
.footer-col a{display:block;color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;margin-bottom:.5rem;transition:color var(--transition)}
.footer-col a:hover{color:#fff}
.footer-bottom{border-top:1px solid rgba(255,255,255,.1);padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;font-size:.8rem;color:rgba(255,255,255,.4)}
.footer-bottom .admin-btn{color:rgba(255,255,255,.4);cursor:pointer;transition:color var(--transition)}
.footer-bottom .admin-btn:hover{color:rgba(255,255,255,.8)}

/* ===== VISION MISSION ===== */
.vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
.vm-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem;border-left:4px solid var(--blue)}
.vm-card.mission{border-left-color:var(--green)}
.vm-card h3{font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1rem;color:var(--text)}
.vm-card p,.vm-card li{font-size:.9rem;color:var(--text2);line-height:1.7}
.vm-card ul{padding-left:1.2rem}
.vm-card ul li{margin-bottom:.4rem}

/* ===== BREADCRUMB ===== */
.breadcrumb{display:flex;align-items:center;gap:.4rem;font-size:.82rem;color:var(--text3);margin-bottom:1.5rem}
.breadcrumb a{color:var(--blue);text-decoration:none}
.breadcrumb i{font-size:.6rem}

/* ===== BACK BTN ===== */
.back-btn{display:inline-flex;align-items:center;gap:.5rem;font-size:.85rem;font-weight:600;color:var(--text2);cursor:pointer;margin-bottom:1.5rem;padding:.5rem .9rem;border-radius:8px;border:1px solid var(--border);background:var(--card);transition:all var(--transition)}
.back-btn:hover{border-color:var(--blue);color:var(--blue)}

/* ===== RESPONSIVE ===== */
@media(max-width:1024px){
  .grid-4{grid-template-columns:repeat(2,1fr)}
  .team-grid{grid-template-columns:repeat(2,1fr)}
  .footer-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .nav-links,.nav-cta{display:none}
  .hamburger{display:flex}
  .grid-3,.grid-2{grid-template-columns:1fr}
  .gallery-grid{grid-template-columns:repeat(2,1fr)}
  .gallery-item.large{grid-column:span 1;grid-row:span 1}
  .stats-bar .container{grid-template-columns:repeat(2,1fr)}
  .support-grid{grid-template-columns:1fr}
  .vm-grid{grid-template-columns:1fr}
  .admin-grid{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr}
  .bar-row{grid-template-columns:1fr;gap:.3rem}
  .bar-label{font-size:.78rem}
  .donut-wrapper{flex-direction:column;gap:1.5rem}
}
@media(max-width:480px){
  .gallery-grid{grid-template-columns:1fr}
  .team-grid{grid-template-columns:1fr}
}

/* ===== UTILITY ===== */
.text-blue{color:var(--blue)}
.text-green{color:var(--green)}
.badge{display:inline-block;padding:.25rem .7rem;border-radius:99px;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase}
.badge-blue{background:rgba(15,117,189,.12);color:var(--blue)}
.badge-green{background:rgba(140,198,62,.12);color:var(--green-dark)}
.divider{height:1px;background:var(--border);margin:2rem 0}
.flex-center{display:flex;align-items:center;justify-content:center}
.gap-1{gap:.5rem}
.mt-2{margin-top:1rem}
.page-hero{padding:4rem 2rem;background:linear-gradient(135deg,var(--blue) 0%,var(--blue-dark) 100%);color:#fff;text-align:center}
.page-hero h1{font-family:'Playfair Display',serif;font-size:clamp(1.75rem,4vw,2.75rem);font-weight:900;margin-bottom:.75rem}
.page-hero p{font-size:1rem;opacity:.85;max-width:520px;margin:0 auto}
.features-strip{background:var(--bg2);padding:2rem;border-top:1px solid var(--border);border-bottom:1px solid var(--border)}
.features-strip .container{display:flex;gap:2rem;flex-wrap:wrap;justify-content:center}
.feature-item{display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--text2)}
.feature-item i{color:var(--blue);font-size:1.1rem}

/* Fade-in animation */
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.fade-up{animation:fadeUp .5s ease forwards}
.delay-1{animation-delay:.1s}
.delay-2{animation-delay:.2s}
.delay-3{animation-delay:.3s}
</style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav id="navbar">
  <a class="nav-logo" href="#" onclick="showPage('home')">
    <div class="nav-logo-icon">M</div>
    <div class="nav-logo-text">Mendelem Project<span>Pemalang, Jawa Tengah</span></div>
  </a>
  <div class="nav-links" id="navLinks">
    <a href="#" onclick="showPage('home')" class="active" data-en="Home" data-id="Beranda">Beranda</a>
    <a href="#" onclick="showPage('projects')" data-en="Projects" data-id="Proyek">Proyek</a>
    <a href="#" onclick="showPage('products')" data-en="Products" data-id="Produk">Produk</a>
    <a href="#" onclick="showPage('gallery')" data-en="Gallery" data-id="Galeri">Galeri</a>
    <a href="#" onclick="showPage('articles')" data-en="Articles" data-id="Artikel">Artikel</a>
    <a href="#" onclick="showPage('about')" data-en="About Us" data-id="Tentang Kami">Tentang Kami</a>
    <a href="#" onclick="showPage('map')" data-en="Location" data-id="Lokasi">Lokasi</a>
    <a href="#" onclick="showPage('support')" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
  </div>
  <div class="nav-actions">
    <div class="lang-toggle" onclick="toggleLang()" id="langToggle">
      <i class="fas fa-globe"></i><span id="langLabel">EN</span>
    </div>
    <button class="theme-btn" onclick="toggleTheme()" title="Toggle theme">
      <i class="fas fa-moon" id="themeIcon"></i>
    </button>
    <a href="#" class="nav-cta" onclick="showPage('support')" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
    <div class="hamburger" onclick="toggleMobile()">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="#" onclick="showPage('home');closeMobile()" data-en="Home" data-id="Beranda">Beranda</a>
  <a href="#" onclick="showPage('projects');closeMobile()" data-en="Projects" data-id="Proyek">Proyek</a>
  <a href="#" onclick="showPage('products');closeMobile()" data-en="Products" data-id="Produk">Produk</a>
  <a href="#" onclick="showPage('gallery');closeMobile()" data-en="Gallery" data-id="Galeri">Galeri</a>
  <a href="#" onclick="showPage('articles');closeMobile()" data-en="Articles" data-id="Artikel">Artikel</a>
  <a href="#" onclick="showPage('about');closeMobile()" data-en="About Us" data-id="Tentang Kami">Tentang Kami</a>
  <a href="#" onclick="showPage('map');closeMobile()" data-en="Location" data-id="Lokasi">Lokasi</a>
  <a href="#" onclick="showPage('support');closeMobile()" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
</div>

<!-- ========================================
     HOME PAGE
======================================== -->
<div id="page-home" class="page active">

  <!-- Hero Slider — from DB -->
  <div class="hero-slider">
    @forelse($sliders as $i => $slide)
    <div class="slide {{ $i === 0 ? 'active' : '' }}" id="slide-{{ $i }}">
      @if($slide->media_path)
        @if($slide->media_type === 'video')
          <video src="{{ asset('storage/'.$slide->media_path) }}" autoplay muted loop playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0"></video>
          <div style="position:absolute;inset:0;background:rgba(0,0,0,.45);z-index:1"></div>
        @else
          <img src="{{ asset('storage/'.$slide->media_path) }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0" alt="">
          <div style="position:absolute;inset:0;background:rgba(13,27,42,.55);z-index:1"></div>
        @endif
      @else
        <div class="slide-video-placeholder"><i class="fas fa-play-circle"></i><span>Upload media di admin panel</span></div>
      @endif
      <div class="slide-content" style="position:relative;z-index:2">
        @if($slide->tag_id)<div class="slide-tag" data-en="{{ $slide->tag_en }}" data-id="{{ $slide->tag_id }}">{{ $slide->tag_id }}</div>@endif
        <h1 data-en="{{ $slide->title_en }}" data-id="{{ $slide->title_id }}">{{ $slide->title_id }}</h1>
        @if($slide->subtitle_id)<p data-en="{{ $slide->subtitle_en }}" data-id="{{ $slide->subtitle_id }}">{{ $slide->subtitle_id }}</p>@endif
        <div class="slide-btns">
          @if($slide->btn_primary_url)
            <a href="{{ $slide->btn_primary_url }}" class="btn-primary" data-en="{{ $slide->btn_primary_label_en }}" data-id="{{ $slide->btn_primary_label_id }}"><i class="fas fa-arrow-right"></i><span>{{ $slide->btn_primary_label_id }}</span></a>
          @endif
          @if($slide->btn_secondary_url)
            <a href="{{ $slide->btn_secondary_url }}" class="btn-outline" data-en="{{ $slide->btn_secondary_label_en }}" data-id="{{ $slide->btn_secondary_label_id }}"><span>{{ $slide->btn_secondary_label_id }}</span></a>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div class="slide active" id="slide-0">
      <div class="slide-video-placeholder"><i class="fas fa-play-circle"></i><span>Belum ada slider — tambahkan di Admin Panel</span></div>
      <div class="slide-content">
        <div class="slide-tag">Selamat Datang</div>
        <h1>Mendelem Project</h1>
        <p>Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.</p>
        <div class="slide-btns"><a href="#" class="btn-primary" onclick="showPage('projects')"><i class="fas fa-arrow-right"></i><span>Jelajahi Proyek</span></a></div>
      </div>
    </div>
    @endforelse
    <div class="slider-arrows">
      <div class="slider-arrow" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></div>
      <div class="slider-arrow" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="slider-nav" id="sliderNav">
      @php $sc = max(1, $sliders->count()); @endphp
      @for($i = 0; $i < $sc; $i++)
        <div class="slider-dot {{ $i===0?'active':'' }}" onclick="goSlide({{ $i }})"></div>
      @endfor
    </div>
  </div>

  <!-- Stats Bar — from DB -->
  <div class="stats-bar">
    <div class="container">
      @forelse($statsBar as $stat)
      <div class="stat-item">
        <div class="stat-num">{{ $stat->value }}{{ $stat->unit }}</div>
        <div class="stat-label" data-en="{{ $stat->label_en }}" data-id="{{ $stat->label_id }}">{{ $stat->label_id }}</div>
      </div>
      @empty
      <div class="stat-item"><div class="stat-num">5+</div><div class="stat-label">Proyek Aktif</div></div>
      <div class="stat-item"><div class="stat-num">120+</div><div class="stat-label">Anggota Komunitas</div></div>
      <div class="stat-item"><div class="stat-num">Rp 500jt</div><div class="stat-label">Total Pembiayaan</div></div>
      <div class="stat-item"><div class="stat-num">2019</div><div class="stat-label">Berdiri Sejak</div></div>
      @endforelse
    </div>
  </div>

  <!-- Features Strip -->
  <div class="features-strip">
    <div class="container">
      <div class="feature-item"><i class="fas fa-leaf"></i><span data-en="Sustainable Agriculture" data-id="Pertanian Berkelanjutan">Pertanian Berkelanjutan</span></div>
      <div class="feature-item"><i class="fas fa-users"></i><span data-en="Community Based" data-id="Berbasis Komunitas">Berbasis Komunitas</span></div>
      <div class="feature-item"><i class="fas fa-chart-line"></i><span data-en="Economic Empowerment" data-id="Pemberdayaan Ekonomi">Pemberdayaan Ekonomi</span></div>
      <div class="feature-item"><i class="fas fa-handshake"></i><span data-en="Open Collaboration" data-id="Kolaborasi Terbuka">Kolaborasi Terbuka</span></div>
      <div class="feature-item"><i class="fas fa-shield-alt"></i><span data-en="Trusted & Transparent" data-id="Terpercaya & Transparan">Terpercaya & Transparan</span></div>
    </div>
  </div>

  <!-- Projects Section — from DB -->
  <section>
    <div class="container">
      <div class="section-header">
        <div class="section-tag" data-en="Our Projects" data-id="Proyek Kami">Proyek Kami</div>
        <h2 class="section-title" data-en="What We're Building Together" data-id="Apa yang Kami Bangun Bersama">Apa yang Kami Bangun Bersama</h2>
      </div>
      <div class="grid-3">
        @forelse($projects as $project)
        <div class="card" onclick="showPage('projects')">
          <div class="card-img" style="background:linear-gradient(135deg,{{ $project->color ?? '#0f75bd' }}22,{{ $project->color ?? '#0f75bd' }}11)">
            @if($project->thumbnail)
              <img src="{{ asset('storage/'.$project->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="{{ $project->icon ?? 'fas fa-folder' }}" style="color:{{ $project->color ?? '#0f75bd' }}"></i>
              <span>{{ $project->name_id }}</span>
            @endif
          </div>
          <div class="card-body">
            <div class="card-tag" data-en="{{ $project->tag_en }}" data-id="{{ $project->tag_id }}">{{ $project->tag_id }}</div>
            <div class="card-title" data-en="{{ $project->name_en }}" data-id="{{ $project->name_id }}">{{ $project->name_id }}</div>
            <div class="card-desc" data-en="{{ $project->short_desc_en }}" data-id="{{ $project->short_desc_id }}">{{ Str::limit($project->short_desc_id, 100) }}</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        @empty
        <div class="card" style="grid-column:1/-1"><div class="card-body" style="padding:3rem;text-align:center;color:#718096">Belum ada proyek. Tambahkan di Admin Panel.</div></div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Products — from DB -->
  <section style="background:var(--bg2);padding:5rem 2rem">
    <div class="container">
      <div class="section-header center">
        <div class="section-tag" data-en="Our Products" data-id="Produk Kami">Produk Kami</div>
        <h2 class="section-title" data-en="Fresh from Mendelem Village" data-id="Segar dari Desa Mendelem">Segar dari Desa Mendelem</h2>
      </div>
      <div class="grid-4">
        @forelse($products as $product)
        <div class="product-card">
          <div class="product-img">
            @if($product->thumbnail)
              <img src="{{ asset('storage/'.$product->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="{{ $product->icon ?? 'fas fa-box' }}"></i><span>{{ $product->name_id }}</span>
            @endif
          </div>
          <div class="product-body">
            <div class="product-name" data-en="{{ $product->name_en }}" data-id="{{ $product->name_id }}">{{ $product->name_id }}</div>
            <div class="product-cat" data-en="{{ $product->category_en }}" data-id="{{ $product->category_id }}">{{ $product->category_id }}</div>
            <div class="product-desc" data-en="{{ $product->description_en }}" data-id="{{ $product->description_id }}">{{ Str::limit($product->description_id, 80) }}</div>
            <div class="product-badge">{{ $product->availability === 'available' ? 'Tersedia' : ($product->availability === 'seasonal' ? 'Musiman' : 'Habis') }}</div>
          </div>
        </div>
        @empty
        <div class="product-card" style="grid-column:1/-1"><div class="product-body" style="padding:2rem;text-align:center;color:#718096">Belum ada produk.</div></div>
        @endforelse
      </div>
      <div style="text-align:center;margin-top:2.5rem">
        <a href="#" class="btn-primary" onclick="showPage('products')"><i class="fas fa-store"></i><span data-en="View All Products" data-id="Lihat Semua Produk">Lihat Semua Produk</span></a>
      </div>
    </div>
  </section>

  <!-- Latest Articles — from DB -->
  <section>
    <div class="container">
      <div class="section-header" style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem">
        <div>
          <div class="section-tag" data-en="Latest Articles" data-id="Artikel Terbaru">Artikel Terbaru</div>
          <h2 class="section-title" data-en="News & Updates" data-id="Berita & Kabar Terbaru">Berita & Kabar Terbaru</h2>
        </div>
        <a href="#" class="btn-primary" onclick="showPage('articles')" data-en="All Articles" data-id="Semua Artikel">Semua Artikel</a>
      </div>
      <div class="grid-3">
        @forelse($articles as $article)
        <div class="article-card">
          <div class="article-img">
            @if($article->thumbnail)
              <img src="{{ asset('storage/'.$article->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="fas fa-newspaper"></i><span>Placeholder Gambar</span>
            @endif
          </div>
          <div class="article-body">
            <div class="article-meta">
              <span><i class="fas fa-calendar"></i> {{ ($article->published_at ?? $article->created_at)->format('d M Y') }}</span>
              <span><i class="fas fa-tag"></i> {{ $article->category_id }}</span>
            </div>
            <div class="article-title" data-en="{{ $article->title_en }}" data-id="{{ $article->title_id }}">{{ $article->title_id }}</div>
            <div class="article-excerpt" data-en="{{ $article->excerpt_en }}" data-id="{{ $article->excerpt_id }}">{{ Str::limit($article->excerpt_id, 120) }}</div>
          </div>
        </div>
        @empty
        <div class="article-card" style="grid-column:1/-1"><div class="article-body" style="padding:3rem;text-align:center;color:#718096">Belum ada artikel.</div></div>
        @endforelse
      </div>
    </div>
  </section>

</div><!-- /page-home -->

<!-- ========================================
     PROJECTS PAGE
======================================== -->
<div id="page-projects" class="page">
  <div class="page-hero">
    <h1 data-en="Our Projects" data-id="Proyek Kami">Proyek Kami</h1>
    <p data-en="Active initiatives building sustainable rural livelihoods." data-id="Inisiatif aktif membangun mata pencaharian pedesaan berkelanjutan.">Inisiatif aktif membangun mata pencaharian pedesaan berkelanjutan.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-2">
        @forelse($allProjects as $project)
        <div class="card" style="display:flex;flex-direction:row;overflow:hidden">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,{{ $project->color ?? '#0f75bd' }},{{ $project->color ?? '#0a5a91' }}cc);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem">
            @if($project->thumbnail)
              <img src="{{ asset('storage/'.$project->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="{{ $project->icon ?? 'fas fa-folder' }}"></i>
            @endif
          </div>
          <div class="card-body" style="flex:1">
            <div class="card-tag" data-en="{{ $project->tag_en }}" data-id="{{ $project->tag_id }}">{{ $project->tag_id }}</div>
            <div class="card-title" data-en="{{ $project->name_en }}" data-id="{{ $project->name_id }}">{{ $project->name_id }}</div>
            <div class="card-desc" data-en="{{ $project->short_desc_en }}" data-id="{{ $project->short_desc_id }}">{{ Str::limit($project->short_desc_id, 120) }}</div>
            <a href="#" class="card-link">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        @empty
        <div class="card" style="grid-column:1/-1"><div class="card-body" style="padding:3rem;text-align:center;color:#718096">Belum ada proyek.</div></div>
        @endforelse
      </div>
    </div>
  </section>
</div><!-- /page-projects -->

<!-- ========================================
     PRODUCTS PAGE
======================================== -->
<div id="page-products" class="page">
  <div class="page-hero">
    <h1 data-en="Our Products" data-id="Produk Kami">Produk Kami</h1>
    <p data-en="Locally-sourced quality products from Mendelem village." data-id="Produk berkualitas dari desa Mendelem.">Produk berkualitas dari desa Mendelem.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-4">
        @forelse($allProducts as $product)
        <div class="product-card">
          <div class="product-img">
            @if($product->thumbnail)
              <img src="{{ asset('storage/'.$product->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="{{ $product->icon ?? 'fas fa-box' }}"></i><span>{{ $product->name_id }}</span>
            @endif
          </div>
          <div class="product-body">
            <div class="product-name" data-en="{{ $product->name_en }}" data-id="{{ $product->name_id }}">{{ $product->name_id }}</div>
            <div class="product-cat" data-en="{{ $product->category_en }}" data-id="{{ $product->category_id }}">{{ $product->category_id }}</div>
            <div class="product-desc" data-en="{{ $product->description_en }}" data-id="{{ $product->description_id }}">{{ Str::limit($product->description_id, 100) }}</div>
            @if($product->price_min)
            <div style="font-size:.82rem;font-weight:700;color:var(--blue);margin-top:.5rem">
              Rp {{ number_format($product->price_min,0,',','.') }}@if($product->price_max) – {{ number_format($product->price_max,0,',','.') }}@endif{{ $product->unit ? ' / '.$product->unit : '' }}
            </div>
            @endif
            <div class="product-badge">{{ $product->availability === 'available' ? 'Tersedia' : ($product->availability === 'seasonal' ? 'Musiman' : 'Habis') }}</div>
          </div>
        </div>
        @empty
        <div class="product-card" style="grid-column:1/-1"><div class="product-body" style="padding:2rem;text-align:center;color:#718096">Belum ada produk.</div></div>
        @endforelse
      </div>
    </div>
  </section>
</div><!-- /page-products -->

<!-- ========================================
     GALLERY PAGE
======================================== -->
<div id="page-gallery" class="page">
  <div class="page-hero">
    <h1 data-en="Gallery" data-id="Galeri">Galeri</h1>
    <p data-en="Visual documentation of our activities." data-id="Dokumentasi visual kegiatan dan proyek kami.">Dokumentasi visual kegiatan dan proyek kami.</p>
  </div>
  <section>
    <div class="container">
      @if($gallery->count() > 0)
      <div class="gallery-grid">
        @foreach($gallery as $i => $item)
        <div class="gallery-item {{ $i === 0 ? 'large' : '' }}" style="position:relative" onclick="openLightbox('{{ asset('storage/'.$item->file_path) }}','{{ $item->file_type }}')">
          @if($item->file_type === 'video')
            <video src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover"></video>
            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:44px;height:44px;border-radius:50%;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center"><i class="fas fa-play" style="color:#fff"></i></div>
          @else
            <img src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover" alt="{{ $item->title_id }}">
          @endif
          @if($item->title_id)
          <span style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.5);color:#fff;font-size:.72rem;padding:.3rem .5rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $item->title_id }}</span>
          @endif
        </div>
        @endforeach
      </div>
      @else
      <div style="text-align:center;padding:5rem;color:var(--text3)">
        <i class="fas fa-images" style="font-size:3rem;opacity:.3;display:block;margin-bottom:1rem"></i>
        <p>Belum ada foto galeri. Upload melalui Admin Panel.</p>
      </div>
      @endif
    </div>
  </section>
</div><!-- /page-gallery -->

<!-- Lightbox -->
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;align-items:center;justify-content:center" onclick="if(event.target===this)closeLightbox()">
  <button onclick="closeLightbox()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:#fff;font-size:1.75rem;cursor:pointer"><i class="fas fa-times"></i></button>
  <img id="lightbox-img" src="" style="max-width:90vw;max-height:90vh;border-radius:8px;display:none" alt="">
  <video id="lightbox-vid" src="" controls style="max-width:90vw;max-height:90vh;border-radius:8px;display:none"></video>
</div>

<!-- ========================================
     ABOUT PAGE
======================================== -->
<div id="page-about" class="page">
  <div class="page-hero">
    <h1 data-en="About Mendelem Project" data-id="Tentang Mendelem Project">Tentang Mendelem Project</h1>
    <p data-en="Our story, vision, team and financing statistics." data-id="Sejarah, visi, tim, dan statistik pembiayaan kami.">Sejarah, visi, tim, dan statistik pembiayaan kami.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-2" style="align-items:start">
        <div>
          <div class="section-tag">Sejarah Kami</div>
          <h2 class="section-title">Kisah Mendelem</h2>
          <div class="timeline" style="margin-top:2rem">
            <div class="timeline-item"><div class="timeline-year">2019</div><div class="timeline-title">Pendirian</div><div class="timeline-desc">Mendelem Project didirikan oleh tokoh komunitas di desa Mendelem, Pemalang, dengan visi memberdayakan ekonomi lokal.</div></div>
            <div class="timeline-item"><div class="timeline-year">2020</div><div class="timeline-title">SAGUM & Ternak Salam</div><div class="timeline-desc">Meluncurkan dua proyek inti pertama — unit agribisnis SAGUM dan program peternakan Ternak Salam.</div></div>
            <div class="timeline-item"><div class="timeline-year">2021</div><div class="timeline-title">Warung Sate Dibuka</div><div class="timeline-desc">Warung Sate diluncurkan sebagai unit kuliner pertama, memanfaatkan ternak dari Ternak Salam.</div></div>
            <div class="timeline-item"><div class="timeline-year">2022</div><div class="timeline-title">Budidaya Melon Dimulai</div><div class="timeline-desc">Greenhouse komunitas pertama untuk budidaya melon premium dengan teknologi modern.</div></div>
            <div class="timeline-item"><div class="timeline-year">2023</div><div class="timeline-title">CIS Digitex Diluncurkan</div><div class="timeline-desc">Platform digital CIS Digitex untuk memodernisasi manajemen komunitas.</div></div>
            <div class="timeline-item"><div class="timeline-year">2025</div><div class="timeline-title">Ekspansi & Pertumbuhan</div><div class="timeline-desc">Semua proyek berjalan penuh dengan komunitas yang terus berkembang.</div></div>
          </div>
        </div>
        <div>
          <div class="section-tag">Visi & Misi</div>
          <h2 class="section-title">Apa yang Mendorong Kami</h2>
          <div class="vm-grid" style="margin-top:2rem">
            <div class="vm-card"><h3>Visi Kami</h3><p>Menjadi model agribisnis berbasis komunitas yang memberdayakan mata pencaharian pedesaan dan kemandirian ekonomi berkelanjutan di Mendelem dan sekitarnya.</p></div>
            <div class="vm-card mission"><h3>Misi Kami</h3><ul><li>Mengembangkan proyek agribisnis berkelanjutan untuk seluruh komunitas.</li><li>Memberikan pelatihan keterampilan bagi anggota komunitas.</li><li>Menciptakan sistem keuangan yang transparan dan akuntabel.</li><li>Membangun kemitraan dengan pemerintah, LSM, dan sektor swasta.</li><li>Memanfaatkan teknologi untuk memodernisasi agribisnis pedesaan.</li></ul></div>
          </div>
        </div>
      </div>

      <div class="divider"></div>

      <!-- Team — from DB -->
      <div class="section-tag" data-en="Our Team" data-id="Tim Kami">Tim Kami</div>
      <h2 class="section-title" data-en="Meet the People Behind the Project" data-id="Kenali Orang-orang di Balik Proyek">Kenali Orang-orang di Balik Proyek</h2>
      <div class="team-grid" style="margin-top:2rem">
        @forelse($team as $member)
        <div class="team-card">
          <div class="team-avatar">
            @if($member->photo)
              <img src="{{ asset('storage/'.$member->photo) }}" style="width:72px;height:72px;border-radius:50%;object-fit:cover" alt="">
            @else
              {{ strtoupper(substr($member->name, 0, 1)) }}
            @endif
          </div>
          <div class="team-name">{{ $member->name }}</div>
          <div class="team-role" data-en="{{ $member->role_en }}" data-id="{{ $member->role_id }}">{{ $member->role_id }}</div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:2rem;color:#718096">Belum ada anggota tim.</div>
        @endforelse
      </div>

      <div class="divider"></div>

      <!-- Stats Charts — from DB -->
      <div class="section-tag">Statistik Pembiayaan</div>
      <h2 class="section-title">Transparansi Keuangan</h2>
      <div class="grid-2" style="margin-top:2rem;align-items:start">
        <div class="chart-container">
          <div class="chart-title">Alokasi Pembiayaan Proyek</div>
          <div class="bar-chart">
            @forelse($financing as $f)
            <div class="bar-row">
              <div class="bar-label" data-en="{{ $f->label_en }}" data-id="{{ $f->label_id }}">{{ $f->label_id }}</div>
              <div class="bar-track"><div class="bar-fill" style="width:{{ min(100, (float)$f->value) }}%"></div></div>
              <div class="bar-val">{{ $f->value }}{{ $f->unit }}</div>
            </div>
            @empty
            <p style="color:#718096;font-size:.85rem">Belum ada data pembiayaan.</p>
            @endforelse
          </div>
        </div>
        <div class="chart-container">
          <div class="chart-title">Sumber Dana</div>
          @php
            $totalFund = $fundSrc->sum(fn($s) => (float)$s->value);
            $circumference = 2 * pi() * 60;
            $svgOffset = 0;
          @endphp
          @if($fundSrc->count())
          <div class="donut-wrapper">
            <svg class="donut-svg" width="160" height="160" viewBox="0 0 160 160">
              <circle cx="80" cy="80" r="60" fill="none" stroke="var(--bg2)" stroke-width="24"/>
              @foreach($fundSrc as $s)
                @php
                  $pct = $totalFund > 0 ? ((float)$s->value / $totalFund) : 0;
                  $dash = $pct * $circumference;
                  $gap  = $circumference - $dash;
                @endphp
                <circle cx="80" cy="80" r="60" fill="none"
                  stroke="{{ $s->color ?? '#0f75bd' }}" stroke-width="24"
                  stroke-dasharray="{{ round($dash,1) }} {{ round($gap,1) }}"
                  stroke-dashoffset="{{ -round($svgOffset,1) }}"
                  transform="rotate(-90 80 80)"/>
                @php $svgOffset += $dash; @endphp
              @endforeach
              <text x="80" y="80" text-anchor="middle" dominant-baseline="middle" font-size="13" font-weight="700" fill="var(--text)" font-family="Playfair Display">{{ $fundSrc->first()?->value ?? '0' }}%</text>
            </svg>
            <div class="donut-legend">
              @foreach($fundSrc as $s)
              <div class="legend-item">
                <div class="legend-dot" style="background:{{ $s->color ?? '#0f75bd' }}"></div>
                <span data-en="{{ $s->label_en }} ({{ $s->value }}%)" data-id="{{ $s->label_id }} ({{ $s->value }}%)">{{ $s->label_id }} ({{ $s->value }}%)</span>
              </div>
              @endforeach
            </div>
          </div>
          @else
          <p style="color:#718096;font-size:.85rem">Belum ada data sumber dana.</p>
          @endif
        </div>
      </div>
    </div>
  </section>
</div><!-- /page-about -->

<!-- ========================================
     ARTICLES PAGE
======================================== -->
<div id="page-articles" class="page">
  <div class="page-hero">
    <h1 data-en="Articles & News" data-id="Artikel & Berita">Artikel & Berita</h1>
    <p data-en="Stay updated with the latest from Mendelem Project." data-id="Tetap update dengan kabar terbaru dari Mendelem Project.">Tetap update dengan kabar terbaru dari Mendelem Project.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-3">
        @forelse($articles as $article)
        <div class="article-card">
          <div class="article-img">
            @if($article->thumbnail)
              <img src="{{ asset('storage/'.$article->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
            @else
              <i class="fas fa-newspaper"></i>
            @endif
          </div>
          <div class="article-body">
            <div class="article-meta">
              <span><i class="fas fa-calendar"></i> {{ ($article->published_at ?? $article->created_at)->format('d M Y') }}</span>
              <span><i class="fas fa-tag"></i> {{ $article->category_id }}</span>
            </div>
            <div class="article-title" data-en="{{ $article->title_en }}" data-id="{{ $article->title_id }}">{{ $article->title_id }}</div>
            <div class="article-excerpt" data-en="{{ $article->excerpt_en }}" data-id="{{ $article->excerpt_id }}">{{ Str::limit($article->excerpt_id, 140) }}</div>
          </div>
        </div>
        @empty
        <div class="article-card" style="grid-column:1/-1"><div class="article-body" style="padding:3rem;text-align:center;color:#718096">Belum ada artikel.</div></div>
        @endforelse
      </div>
    </div>
  </section>
</div><!-- /page-articles -->

<!-- ========================================
     MAP PAGE
======================================== -->
<div id="page-map" class="page">
  <div class="page-hero">
    <h1 data-en="Our Location" data-id="Lokasi Kami">Lokasi Kami</h1>
    <p data-en="Find us at Jl. Belik - Mendelem KM 3, Pemalang." data-id="Temukan kami di Jl. Belik - Mendelem KM 3, Pemalang.">Temukan kami di Jl. Belik - Mendelem KM 3, Pemalang.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-2" style="align-items:start">
        <div>
          <div class="section-tag">Alamat</div>
          <h2 class="section-title">Kunjungi Kami</h2>
          <div style="margin-top:1.5rem;display:flex;flex-direction:column;gap:1rem">
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-map-marker-alt" style="color:var(--blue)"></i></div>
              <div><div style="font-weight:700;margin-bottom:.25rem">Alamat</div><div style="font-size:.88rem;color:var(--text2)">Jl. Belik - Mendelem No. KM 3, Mendelem, Belik, Pemalang, Jawa Tengah 52356</div></div>
            </div>
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(140,198,62,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-envelope" style="color:var(--green-dark)"></i></div>
              <div><div style="font-weight:700;margin-bottom:.25rem">Email</div><div style="font-size:.88rem;color:var(--text2)">mendelemproject@gmail.com</div></div>
            </div>
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-clock" style="color:var(--blue)"></i></div>
              <div><div style="font-weight:700;margin-bottom:.25rem">Jam Operasional</div><div style="font-size:.88rem;color:var(--text2)">Senin – Sabtu: 08.00 – 17.00 WIB</div></div>
            </div>
          </div>
          <div style="margin-top:2rem;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1.25rem">Kirim Pesan ke Kami</h3>
            @if(session('contact_success'))
            <div class="form-success show"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>
            @endif
            <form method="POST" action="{{ route('contact.send') }}">
              @csrf
              <div class="form-group"><label>Nama Anda</label><input type="text" class="form-control" name="name" required placeholder="Masukkan nama Anda" value="{{ old('name') }}"></div>
              <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" required placeholder="email@example.com" value="{{ old('email') }}"></div>
              <div class="form-group"><label>Pesan</label><textarea class="form-control" name="message" required rows="4" placeholder="Tulis pesan Anda...">{{ old('message') }}</textarea></div>
              <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i><span>Kirim Pesan</span></button>
            </form>
          </div>
        </div>
        <div>
          <div class="map-embed">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5!2d109.3!3d-7.15!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb00000000001%3A0x1!2sJl.+Belik+-+Mendelem+KM+3%2C+Pemalang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
</div><!-- /page-map -->

<!-- ========================================
     SUPPORT PAGE
======================================== -->
<div id="page-support" class="page">
  <div class="page-hero">
    <h1 data-en="Support Us" data-id="Dukung Kami">Dukung Kami</h1>
    <p data-en="Help us grow Mendelem Project through collaboration or donation." data-id="Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.">Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.</p>
  </div>
  <section>
    <div class="container">
      <div class="support-grid">
        <div>
          <div class="support-card">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-handshake" style="color:var(--blue);font-size:1.3rem"></i></div>
            <h3>Kolaborasi</h3>
            <p>Kami terbuka untuk berkolaborasi dengan LSM, pemerintah, perusahaan, dan individu yang berbagi visi pemberdayaan pedesaan kami.</p>
            <ul style="font-size:.88rem;color:var(--text2);padding-left:1.2rem;line-height:2"><li>Bantuan teknis & pelatihan</li><li>Penyediaan teknologi pertanian</li><li>Akses pasar & distribusi</li><li>Kemitraan penelitian & pengembangan</li><li>Program CSR</li></ul>
            <div style="margin-top:1.25rem"><a href="mailto:mendelemproject@gmail.com" class="btn-primary"><i class="fas fa-envelope"></i><span>Hubungi untuk Kolaborasi</span></a></div>
          </div>
          <div class="support-card" style="margin-top:1.5rem">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(140,198,62,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-heart" style="color:var(--green-dark);font-size:1.3rem"></i></div>
            <h3>Donasi</h3>
            <p>Donasi Anda, sekecil apapun, akan langsung mendukung komunitas di Mendelem. Dana digunakan secara transparan untuk pengembangan proyek.</p>
            <div class="bank-info"><strong>Bank BRI</strong><span>1234-5678-9012-345</span><br><span>a.n. Mendelem Project</span></div>
            <div class="bank-info"><strong>Bank Syariah Indonesia (BSI)</strong><span>7890-1234-567</span><br><span>a.n. Mendelem Project</span></div>
            <div class="bank-info"><strong>Konfirmasi</strong><span>Kirim bukti transfer ke: mendelemproject@gmail.com</span></div>
          </div>
        </div>
        <div class="support-card">
          <div style="width:48px;height:48px;border-radius:12px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-paper-plane" style="color:var(--blue);font-size:1.3rem"></i></div>
          <h3>Hubungi Kami</h3>
          <p style="margin-bottom:1.5rem">Isi formulir di bawah dan kami akan merespons sesegera mungkin.</p>
          @if(session('contact_success'))
          <div class="form-success show"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>
          @endif
          <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div class="form-group"><label>Nama Lengkap</label><input type="text" class="form-control" name="name" required placeholder="Nama lengkap Anda" value="{{ old('name') }}"></div>
            <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" required placeholder="email@example.com" value="{{ old('email') }}"></div>
            <div class="form-group"><label>Tujuan</label><select class="form-control" name="purpose"><option value="">Pilih tujuan</option><option>Kolaborasi</option><option>Donasi</option><option>Pembelian Produk</option><option>Pertanyaan Umum</option></select></div>
            <div class="form-group"><label>Pesan</label><textarea class="form-control" name="message" required rows="5" placeholder="Jelaskan maksud Anda..."></textarea></div>
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i><span>Kirim Pesan</span></button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div><!-- /page-support -->

<!-- ========================================
     FOOTER — tanpa admin panel
======================================== -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="nav-logo" style="margin-bottom:.75rem;display:flex">
          <div class="nav-logo-icon" style="background:linear-gradient(135deg,var(--blue),var(--green))">M</div>
          <div class="nav-logo-text" style="margin-left:.75rem">Mendelem Project<span>Pemalang, Jawa Tengah</span></div>
        </div>
        <p class="footer-desc">Pengembangan agribisnis berbasis komunitas di desa Mendelem, Pemalang, Jawa Tengah. Membangun mata pencaharian pedesaan berkelanjutan sejak 2019.</p>
        <div class="footer-social">
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Navigasi</h4>
        <a href="#" onclick="showPage('home')">Beranda</a>
        <a href="#" onclick="showPage('projects')">Proyek</a>
        <a href="#" onclick="showPage('products')">Produk</a>
        <a href="#" onclick="showPage('gallery')">Galeri</a>
        <a href="#" onclick="showPage('about')">Tentang Kami</a>
      </div>
      <div class="footer-col">
        <h4>Proyek</h4>
        @foreach($allProjects->take(5) as $p)
        <a href="#" onclick="showPage('projects')">{{ $p->name_id }}</a>
        @endforeach
      </div>
      <div class="footer-col">
        <h4>Kontak</h4>
        <a href="#">Jl. Belik - Mendelem KM 3</a>
        <a href="#">Pemalang, Jawa Tengah</a>
        <a href="mailto:mendelemproject@gmail.com">mendelemproject@gmail.com</a>
        <a href="{{ route('admin.login') }}" style="opacity:.4;font-size:.76rem"><i class="fas fa-lock"></i> Admin</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Mendelem Project. Hak cipta dilindungi.</span>
    </div>
  </div>
</footer>

<script>
let currentLang = 'id';
let currentTheme = 'light';
let currentSlide = 0;
let totalSlides = {{ max(1, $sliders->count()) }};
let slideInterval;

// NAVIGATION
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const pg = document.getElementById('page-' + page);
  if (pg) { pg.classList.add('active'); } else { return false; }
  document.querySelectorAll('.nav-links a, .mobile-menu a').forEach(a => {
    a.classList.remove('active');
    const oc = a.getAttribute('onclick') || '';
    if (oc.includes("'"+page+"'")) a.classList.add('active');
  });
  window.scrollTo(0, 0);
  return false;
}

// SLIDER
function goSlide(n) {
  const slides = document.querySelectorAll('.slide');
  const dots   = document.querySelectorAll('.slider-dot');
  if (slides[currentSlide]) slides[currentSlide].classList.remove('active');
  if (dots[currentSlide])   dots[currentSlide].classList.remove('active');
  currentSlide = ((n % totalSlides) + totalSlides) % totalSlides;
  if (slides[currentSlide]) slides[currentSlide].classList.add('active');
  if (dots[currentSlide])   dots[currentSlide].classList.add('active');
}
function nextSlide() { goSlide(currentSlide + 1); }
function prevSlide() { goSlide(currentSlide - 1); }
function startSlider() { clearInterval(slideInterval); slideInterval = setInterval(nextSlide, 5000); }
startSlider();

// THEME
function toggleTheme() {
  currentTheme = currentTheme === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme);
  document.getElementById('themeIcon').className = currentTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
}

// LANGUAGE
function toggleLang() {
  currentLang = currentLang === 'id' ? 'en' : 'id';
  document.getElementById('langLabel').textContent = currentLang === 'id' ? 'EN' : 'ID';
  document.querySelectorAll('[data-en][data-id]').forEach(el => {
    el.textContent = currentLang === 'en' ? el.getAttribute('data-en') : el.getAttribute('data-id');
  });
}

// NAVBAR SCROLL
window.addEventListener('scroll', () => {
  document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
});

// MOBILE MENU
function toggleMobile() { document.getElementById('mobileMenu').classList.toggle('open'); }
function closeMobile()  { document.getElementById('mobileMenu').classList.remove('open'); }

// LIGHTBOX
function openLightbox(src, type) {
  const lb  = document.getElementById('lightbox');
  const img = document.getElementById('lightbox-img');
  const vid = document.getElementById('lightbox-vid');
  lb.style.display = 'flex';
  if (type === 'video') {
    vid.src = src; vid.style.display = 'block'; img.style.display = 'none';
  } else {
    img.src = src; img.style.display = 'block'; vid.style.display = 'none';
    if (vid.pause) { vid.pause(); vid.src = ''; }
  }
}
function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
  const vid = document.getElementById('lightbox-vid');
  if (vid.pause) { vid.pause(); vid.src = ''; }
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
</body>
</html>
