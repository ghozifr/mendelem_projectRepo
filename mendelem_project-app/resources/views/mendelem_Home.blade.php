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

  <!-- Hero Slider -->
  <div class="hero-slider">
    <div class="slide active" id="slide-0">
      <div class="slide-video-placeholder">
        <i class="fas fa-play-circle"></i>
        <span data-en="Video Placeholder — Upload your main video here" data-id="Placeholder Video — Upload video utama di sini">Placeholder Video — Upload video utama di sini</span>
      </div>
      <div class="slide-content">
        <div class="slide-tag" data-en="Welcome to Mendelem Project" data-id="Selamat Datang di Mendelem Project">Selamat Datang di Mendelem Project</div>
        <h1 data-en="Building a Sustainable Rural Economy" data-id="Membangun Ekonomi Pedesaan yang Berkelanjutan">Membangun Ekonomi Pedesaan yang Berkelanjutan</h1>
        <p data-en="Community-based agribusiness development in the village of Mendelem, Pemalang, Central Java." data-id="Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.">Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.</p>
        <div class="slide-btns">
          <a href="#" class="btn-primary" onclick="showPage('projects')" data-en="Explore Projects" data-id="Jelajahi Proyek"><i class="fas fa-arrow-right"></i><span>Jelajahi Proyek</span></a>
          <a href="#" class="btn-outline" onclick="showPage('about')" data-en="About Us" data-id="Tentang Kami"><span>Tentang Kami</span></a>
        </div>
      </div>
    </div>
    <div class="slide" id="slide-1">
      <div class="slide-video-placeholder">
        <i class="fas fa-play-circle"></i>
        <span data-en="Video Placeholder — Project highlights" data-id="Placeholder Video — Sorotan proyek">Placeholder Video — Sorotan proyek</span>
      </div>
      <div class="slide-content">
        <div class="slide-tag" data-en="Our Main Projects" data-id="Proyek Unggulan Kami">Proyek Unggulan Kami</div>
        <h1 data-en="From Farming to Thriving Enterprises" data-id="Dari Ladang Menuju Usaha yang Berkembang">Dari Ladang Menuju Usaha yang Berkembang</h1>
        <p data-en="SAGUM, Ternak Salam, Warung Sate, Melon Cultivation and more — all powered by community spirit." data-id="SAGUM, Ternak Salam, Warung Sate, Budidaya Melon dan lainnya — semua didukung semangat komunitas.">SAGUM, Ternak Salam, Warung Sate, Budidaya Melon — didukung semangat komunitas.</p>
        <div class="slide-btns">
          <a href="#" class="btn-primary" onclick="showPage('projects')" data-en="See All Projects" data-id="Lihat Semua Proyek"><i class="fas fa-folder-open"></i><span>Lihat Semua Proyek</span></a>
        </div>
      </div>
    </div>
    <div class="slide" id="slide-2">
      <div class="slide-video-placeholder">
        <i class="fas fa-play-circle"></i>
        <span data-en="Video Placeholder — Community & products" data-id="Placeholder Video — Komunitas & produk">Placeholder Video — Komunitas & produk</span>
      </div>
      <div class="slide-content">
        <div class="slide-tag" data-en="Our Products" data-id="Produk Kami">Produk Kami</div>
        <h1 data-en="Quality Products, Direct from the Village" data-id="Produk Berkualitas, Langsung dari Desa">Produk Berkualitas, Langsung dari Desa</h1>
        <p data-en="Melon, Goat, Satay, Aren Sugar, Melinjo Skin and more — fresh local produce you can trust." data-id="Melon, Kambing, Sate, Gula Aren, Kulit Melinjo — produk lokal segar yang dapat dipercaya.">Melon, Kambing, Sate, Gula Aren, Kulit Melinjo — produk lokal segar.</p>
        <div class="slide-btns">
          <a href="#" class="btn-primary" onclick="showPage('products')" data-en="See Our Products" data-id="Lihat Produk Kami"><i class="fas fa-store"></i><span>Lihat Produk Kami</span></a>
          <a href="#" class="btn-outline" onclick="showPage('support')" data-en="Support Us" data-id="Dukung Kami"><span>Dukung Kami</span></a>
        </div>
      </div>
    </div>
    <div class="slider-arrows">
      <div class="slider-arrow" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></div>
      <div class="slider-arrow" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="slider-nav" id="sliderNav">
      <div class="slider-dot active" onclick="goSlide(0)"></div>
      <div class="slider-dot" onclick="goSlide(1)"></div>
      <div class="slider-dot" onclick="goSlide(2)"></div>
    </div>
  </div>

  <!-- Stats Bar -->
  <div class="stats-bar">
    <div class="container">
      <div class="stat-item">
        <div class="stat-num" id="stat-projects">5+</div>
        <div class="stat-label" data-en="Active Projects" data-id="Proyek Aktif">Proyek Aktif</div>
      </div>
      <div class="stat-item">
        <div class="stat-num" id="stat-members">120+</div>
        <div class="stat-label" data-en="Community Members" data-id="Anggota Komunitas">Anggota Komunitas</div>
      </div>
      <div class="stat-item">
        <div class="stat-num" id="stat-funding">Rp 500jt</div>
        <div class="stat-label" data-en="Total Financing" data-id="Total Pembiayaan">Total Pembiayaan</div>
      </div>
      <div class="stat-item">
        <div class="stat-num" id="stat-year">2019</div>
        <div class="stat-label" data-en="Founded" data-id="Berdiri Sejak">Berdiri Sejak</div>
      </div>
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

  <!-- Projects Overview -->
  <section>
    <div class="container">
      <div class="section-header">
        <div class="section-tag" data-en="Our Projects" data-id="Proyek Kami">Proyek Kami</div>
        <h2 class="section-title" data-en="What We're Building Together" data-id="Apa yang Kami Bangun Bersama">Apa yang Kami Bangun Bersama</h2>
        <p class="section-subtitle" data-en="Five active projects driving rural economic growth in Mendelem village." data-id="Lima proyek aktif yang mendorong pertumbuhan ekonomi pedesaan di desa Mendelem.">Lima proyek aktif yang mendorong pertumbuhan ekonomi pedesaan di desa Mendelem.</p>
      </div>
      <div class="grid-3">
        <div class="card" onclick="showProjectDetail('sagum')">
          <div class="card-img"><i class="fas fa-store"></i><span>SAGUM</span></div>
          <div class="card-body">
            <div class="card-tag" data-en="Agribusiness" data-id="Agribisnis">Agribisnis</div>
            <div class="card-title">SAGUM</div>
            <div class="card-desc" data-en="Agribusiness market unit for local produce distribution and sales." data-id="Unit pasar agribisnis untuk distribusi dan penjualan produk lokal.">Unit pasar agribisnis untuk distribusi dan penjualan produk lokal.</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('ternak')">
          <div class="card-img"><i class="fas fa-horse"></i><span>Ternak Salam</span></div>
          <div class="card-body">
            <div class="card-tag" data-en="Livestock" data-id="Peternakan">Peternakan</div>
            <div class="card-title">Ternak Salam</div>
            <div class="card-desc" data-en="Goat and sheep livestock program for community food security and income." data-id="Program peternakan kambing dan domba untuk ketahanan pangan dan penghasilan komunitas.">Program peternakan kambing dan domba untuk ketahanan pangan komunitas.</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('sate')">
          <div class="card-img"><i class="fas fa-utensils"></i><span>Warung Sate</span></div>
          <div class="card-body">
            <div class="card-tag" data-en="Culinary" data-id="Kuliner">Kuliner</div>
            <div class="card-title">Warung Sate</div>
            <div class="card-desc" data-en="Community satay stall using locally-raised goat meat with traditional recipes." data-id="Warung sate komunitas menggunakan daging kambing lokal dengan resep tradisional.">Warung sate komunitas dengan daging kambing lokal dan resep tradisional.</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('melon')">
          <div class="card-img"><i class="fas fa-apple-alt"></i><span>Budidaya Melon</span></div>
          <div class="card-body">
            <div class="card-tag" data-en="Horticulture" data-id="Hortikultura">Hortikultura</div>
            <div class="card-title">Budidaya Melon</div>
            <div class="card-desc" data-en="Premium melon cultivation using modern agro-technology in community greenhouses." data-id="Budidaya melon premium menggunakan teknologi agro modern di greenhouse komunitas.">Budidaya melon premium di greenhouse komunitas dengan teknologi modern.</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('cis')">
          <div class="card-img"><i class="fas fa-laptop-code"></i><span>CIS Digitex</span></div>
          <div class="card-body">
            <div class="card-tag" data-en="Digital" data-id="Digital">Digital</div>
            <div class="card-title">CIS Digitex</div>
            <div class="card-desc" data-en="Community information system and digital platform for rural agribusiness management." data-id="Sistem informasi komunitas dan platform digital untuk manajemen agribisnis pedesaan.">Sistem informasi komunitas dan platform digital untuk agribisnis pedesaan.</div>
            <a href="#" class="card-link" data-en="Learn More" data-id="Selengkapnya">Selengkapnya <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" style="background:linear-gradient(135deg,var(--blue),var(--blue-dark));border:0;cursor:default">
          <div class="card-body" style="padding:2rem;display:flex;flex-direction:column;justify-content:center;height:100%">
            <div style="color:rgba(255,255,255,.7);font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;margin-bottom:.75rem" data-en="Ready to Collaborate?" data-id="Siap Berkolaborasi?">Siap Berkolaborasi?</div>
            <div style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:#fff;margin-bottom:.75rem" data-en="Join Our Growing Community" data-id="Bergabung dengan Komunitas Kami">Bergabung dengan Komunitas Kami</div>
            <p style="color:rgba(255,255,255,.75);font-size:.85rem;line-height:1.6;margin-bottom:1.25rem" data-en="Be part of a meaningful rural development movement." data-id="Jadilah bagian dari gerakan pembangunan pedesaan yang bermakna.">Jadilah bagian dari gerakan pembangunan pedesaan yang bermakna.</p>
            <a href="#" class="btn-outline" onclick="showPage('support')" data-en="Get Involved" data-id="Ikut Bergabung">Ikut Bergabung</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Teaser -->
  <section style="background:var(--bg2);padding:5rem 2rem">
    <div class="container">
      <div class="section-header center">
        <div class="section-tag" data-en="Our Products" data-id="Produk Kami">Produk Kami</div>
        <h2 class="section-title" data-en="Fresh from Mendelem Village" data-id="Segar dari Desa Mendelem">Segar dari Desa Mendelem</h2>
      </div>
      <div class="grid-4">
        <div class="product-card"><div class="product-img"><i class="fas fa-leaf"></i><span>Kulit Melinjo</span></div><div class="product-body"><div class="product-name">Kulit Melinjo</div><div class="product-cat" data-en="Local Snack" data-id="Camilan Lokal">Camilan Lokal</div><div class="product-badge" data-en="Available" data-id="Tersedia">Tersedia</div></div></div>
        <div class="product-card"><div class="product-img"><i class="fas fa-apple-alt"></i><span>Melon</span></div><div class="product-body"><div class="product-name">Melon</div><div class="product-cat" data-en="Fresh Fruit" data-id="Buah Segar">Buah Segar</div><div class="product-badge" data-en="Available" data-id="Tersedia">Tersedia</div></div></div>
        <div class="product-card"><div class="product-img"><i class="fas fa-cookie-bite"></i><span>Gula Aren</span></div><div class="product-body"><div class="product-name">Gula Aren</div><div class="product-cat" data-en="Natural Sweetener" data-id="Pemanis Alami">Pemanis Alami</div><div class="product-badge" data-en="Available" data-id="Tersedia">Tersedia</div></div></div>
        <div class="product-card"><div class="product-img"><i class="fas fa-drumstick-bite"></i><span>Sate</span></div><div class="product-body"><div class="product-name">Sate Kambing</div><div class="product-cat" data-en="Culinary" data-id="Kuliner">Kuliner</div><div class="product-badge" data-en="Available" data-id="Tersedia">Tersedia</div></div></div>
      </div>
      <div style="text-align:center;margin-top:2.5rem">
        <a href="#" class="btn-primary" onclick="showPage('products')" data-en="View All Products" data-id="Lihat Semua Produk"><i class="fas fa-store"></i><span>Lihat Semua Produk</span></a>
      </div>
    </div>
  </section>

  <!-- Latest Articles -->
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
        <div class="article-card">
          <div class="article-img"><i class="fas fa-newspaper"></i><span data-en="Image Placeholder" data-id="Placeholder Gambar">Placeholder Gambar</span></div>
          <div class="article-body">
            <div class="article-meta"><span><i class="fas fa-calendar"></i> 20 Feb 2025</span><span><i class="fas fa-tag"></i> <span data-en="Agribusiness" data-id="Agribisnis">Agribisnis</span></span></div>
            <div class="article-title" data-en="SAGUM Reaches New Milestone in Local Produce Sales" data-id="SAGUM Capai Tonggak Baru dalam Penjualan Produk Lokal">SAGUM Capai Tonggak Baru dalam Penjualan Produk Lokal</div>
            <div class="article-excerpt" data-en="The SAGUM agribusiness unit recorded its highest monthly turnover in February 2025, a testament to growing community support..." data-id="Unit agribisnis SAGUM mencatatkan omset bulanan tertinggi pada Februari 2025, bukti dukungan komunitas yang terus tumbuh...">Unit agribisnis SAGUM mencatatkan omset bulanan tertinggi pada Februari 2025, bukti dukungan komunitas yang terus tumbuh...</div>
          </div>
        </div>
        <div class="article-card">
          <div class="article-img"><i class="fas fa-newspaper"></i><span data-en="Image Placeholder" data-id="Placeholder Gambar">Placeholder Gambar</span></div>
          <div class="article-body">
            <div class="article-meta"><span><i class="fas fa-calendar"></i> 15 Feb 2025</span><span><i class="fas fa-tag"></i> <span data-en="Horticulture" data-id="Hortikultura">Hortikultura</span></span></div>
            <div class="article-title" data-en="New Greenhouse Expansion for Melon Cultivation Project" data-id="Ekspansi Greenhouse Baru untuk Proyek Budidaya Melon">Ekspansi Greenhouse Baru untuk Proyek Budidaya Melon</div>
            <div class="article-excerpt" data-en="The melon cultivation project has expanded with two additional greenhouse units, increasing production capacity significantly..." data-id="Proyek budidaya melon berkembang dengan dua unit greenhouse tambahan, meningkatkan kapasitas produksi secara signifikan...">Proyek budidaya melon berkembang dengan dua unit greenhouse tambahan, meningkatkan kapasitas produksi...</div>
          </div>
        </div>
        <div class="article-card">
          <div class="article-img"><i class="fas fa-newspaper"></i><span data-en="Image Placeholder" data-id="Placeholder Gambar">Placeholder Gambar</span></div>
          <div class="article-body">
            <div class="article-meta"><span><i class="fas fa-calendar"></i> 5 Feb 2025</span><span><i class="fas fa-tag"></i> <span data-en="Community" data-id="Komunitas">Komunitas</span></span></div>
            <div class="article-title" data-en="Community Training on Digital Financial Literacy" data-id="Pelatihan Komunitas tentang Literasi Keuangan Digital">Pelatihan Komunitas tentang Literasi Keuangan Digital</div>
            <div class="article-excerpt" data-en="CIS Digitex held a digital financial literacy training session for 45 community members, empowering them with modern tools..." data-id="CIS Digitex mengadakan pelatihan literasi keuangan digital untuk 45 anggota komunitas, membekali mereka dengan alat modern...">CIS Digitex mengadakan pelatihan literasi keuangan digital untuk 45 anggota komunitas...</div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- end home -->

<!-- ========================================
     PROJECTS PAGE
======================================== -->
<div id="page-projects" class="page">
  <div class="page-hero">
    <h1 data-en="Our Projects" data-id="Proyek Kami">Proyek Kami</h1>
    <p data-en="Five active initiatives building sustainable rural livelihoods in Mendelem." data-id="Lima inisiatif aktif membangun mata pencaharian pedesaan yang berkelanjutan di Mendelem.">Lima inisiatif aktif membangun mata pencaharian pedesaan yang berkelanjutan di Mendelem.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-2">
        <div class="card" onclick="showProjectDetail('sagum')" style="display:flex;flex-direction:row;overflow:hidden">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,var(--blue),var(--blue-dark));display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem"><i class="fas fa-store"></i></div>
          <div class="card-body" style="flex:1">
            <div class="card-tag" data-en="Agribusiness" data-id="Agribisnis">Agribisnis</div>
            <div class="card-title">SAGUM</div>
            <div class="card-desc" data-en="Sarana Agribisnis Guna Umat — the main agribusiness market unit connecting local farmers to consumers." data-id="Sarana Agribisnis Guna Umat — unit pasar agribisnis utama yang menghubungkan petani lokal ke konsumen.">Sarana Agribisnis Guna Umat — unit pasar agribisnis yang menghubungkan petani lokal ke konsumen.</div>
            <a href="#" class="card-link" onclick="showProjectDetail('sagum')">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('ternak')" style="display:flex;flex-direction:row;overflow:hidden">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,var(--green),var(--green-dark));display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem"><i class="fas fa-horse"></i></div>
          <div class="card-body" style="flex:1">
            <div class="card-tag" data-en="Livestock" data-id="Peternakan">Peternakan</div>
            <div class="card-title">Ternak Salam</div>
            <div class="card-desc" data-en="Community goat and sheep livestock program supporting food security and community income." data-id="Program peternakan kambing dan domba komunitas mendukung ketahanan pangan dan penghasilan komunitas.">Program peternakan kambing dan domba komunitas untuk ketahanan pangan.</div>
            <a href="#" class="card-link" onclick="showProjectDetail('ternak')">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('sate')" style="display:flex;flex-direction:row;overflow:hidden">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,#e67e22,#d35400);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem"><i class="fas fa-utensils"></i></div>
          <div class="card-body" style="flex:1">
            <div class="card-tag" data-en="Culinary" data-id="Kuliner">Kuliner</div>
            <div class="card-title">Warung Sate</div>
            <div class="card-desc" data-en="Community satay stall serving premium goat satay using livestock from Ternak Salam project." data-id="Warung sate komunitas menyajikan sate kambing premium menggunakan ternak dari proyek Ternak Salam.">Warung sate komunitas menyajikan sate kambing premium dari Ternak Salam.</div>
            <a href="#" class="card-link" onclick="showProjectDetail('sate')">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('melon')" style="display:flex;flex-direction:row;overflow:hidden">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,#27ae60,#1e8449);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem"><i class="fas fa-apple-alt"></i></div>
          <div class="card-body" style="flex:1">
            <div class="card-tag" data-en="Horticulture" data-id="Hortikultura">Hortikultura</div>
            <div class="card-title">Budidaya Melon</div>
            <div class="card-desc" data-en="Modern melon cultivation in community greenhouses using hydroponic and conventional methods." data-id="Budidaya melon modern di greenhouse komunitas menggunakan metode hidroponik dan konvensional.">Budidaya melon modern di greenhouse komunitas menggunakan metode hidroponik.</div>
            <a href="#" class="card-link" onclick="showProjectDetail('melon')">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
        <div class="card" onclick="showProjectDetail('cis')" style="display:flex;flex-direction:row;overflow:hidden;grid-column:span 2">
          <div style="width:120px;flex-shrink:0;background:linear-gradient(135deg,#8e44ad,#6c3483);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem"><i class="fas fa-laptop-code"></i></div>
          <div class="card-body" style="flex:1">
            <div class="card-tag">Digital</div>
            <div class="card-title">CIS Digitex</div>
            <div class="card-desc" data-en="Community Information System Digitex — the digital backbone of Mendelem Project managing data, transactions, and communications." data-id="Community Information System Digitex — tulang punggung digital Mendelem Project yang mengelola data, transaksi, dan komunikasi.">Community Information System Digitex — tulang punggung digital yang mengelola data, transaksi, dan komunikasi.</div>
            <a href="#" class="card-link" onclick="showProjectDetail('cis')">Detail <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- ========================================
     PROJECT DETAIL PAGE
======================================== -->
<div id="page-project-detail" class="page">
  <div id="project-detail-content"></div>
</div>

<!-- ========================================
     PRODUCTS PAGE
======================================== -->
<div id="page-products" class="page">
  <div class="page-hero">
    <h1 data-en="Our Products" data-id="Produk Kami">Produk Kami</h1>
    <p data-en="Locally-sourced quality products straight from Mendelem village." data-id="Produk berkualitas bersumber lokal langsung dari desa Mendelem.">Produk berkualitas bersumber lokal langsung dari desa Mendelem.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-4" id="products-grid">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>
</div>

<!-- ========================================
     GALLERY PAGE
======================================== -->
<div id="page-gallery" class="page">
  <div class="page-hero">
    <h1 data-en="Gallery" data-id="Galeri">Galeri</h1>
    <p data-en="Visual documentation of our activities and projects." data-id="Dokumentasi visual kegiatan dan proyek kami.">Dokumentasi visual kegiatan dan proyek kami.</p>
  </div>
  <section>
    <div class="container">
      <div class="gallery-grid">
        <div class="gallery-item large"><i class="fas fa-image"></i><span data-en="Featured Photo" data-id="Foto Unggulan">Foto Unggulan</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span>SAGUM</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Ternak Salam" data-id="Ternak Salam">Ternak Salam</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span>Warung Sate</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Melon Garden" data-id="Kebun Melon">Kebun Melon</span></div>
        <div class="gallery-item large"><i class="fas fa-image"></i><span>CIS Digitex</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Community Event" data-id="Acara Komunitas">Acara Komunitas</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Products" data-id="Produk">Produk</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Training" data-id="Pelatihan">Pelatihan</span></div>
        <div class="gallery-item"><i class="fas fa-image"></i><span data-en="Harvest" data-id="Panen">Panen</span></div>
      </div>
      <p style="text-align:center;color:var(--text3);font-size:.85rem;margin-top:2rem" data-en="Gallery images will be available soon. Upload via admin panel." data-id="Foto galeri segera tersedia. Upload melalui panel admin.">Foto galeri segera tersedia. Upload melalui panel admin.</p>
    </div>
  </section>
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
        <!-- History -->
        <div>
          <div class="section-tag" data-en="Our History" data-id="Sejarah Kami">Sejarah Kami</div>
          <h2 class="section-title" data-en="The Mendelem Story" data-id="Kisah Mendelem">Kisah Mendelem</h2>
          <div class="timeline" style="margin-top:2rem">
            <div class="timeline-item">
              <div class="timeline-year">2019</div>
              <div class="timeline-title" data-en="Foundation" data-id="Pendirian">Pendirian</div>
              <div class="timeline-desc" data-en="Mendelem Project was founded by a group of community leaders in Mendelem village, Pemalang, with a vision to empower the local economy." data-id="Mendelem Project didirikan oleh sekelompok tokoh komunitas di desa Mendelem, Pemalang, dengan visi memberdayakan ekonomi lokal.">Mendelem Project didirikan oleh sekelompok tokoh komunitas di desa Mendelem, Pemalang, dengan visi memberdayakan ekonomi lokal.</div>
            </div>
            <div class="timeline-item">
              <div class="timeline-year">2020</div>
              <div class="timeline-title" data-en="First Projects: SAGUM & Ternak Salam" data-id="Proyek Pertama: SAGUM & Ternak Salam">Proyek Pertama: SAGUM & Ternak Salam</div>
              <div class="timeline-desc" data-en="Launched the first two core projects — SAGUM agribusiness unit and Ternak Salam livestock program." data-id="Meluncurkan dua proyek inti pertama — unit agribisnis SAGUM dan program peternakan Ternak Salam.">Meluncurkan dua proyek inti pertama — unit agribisnis SAGUM dan program peternakan Ternak Salam.</div>
            </div>
            <div class="timeline-item">
              <div class="timeline-year">2021</div>
              <div class="timeline-title" data-en="Warung Sate Opens" data-id="Warung Sate Dibuka">Warung Sate Dibuka</div>
              <div class="timeline-desc" data-en="Warung Sate launched as the first culinary business unit, directly utilizing livestock from the Ternak Salam project." data-id="Warung Sate diluncurkan sebagai unit bisnis kuliner pertama, langsung memanfaatkan ternak dari proyek Ternak Salam.">Warung Sate diluncurkan sebagai unit bisnis kuliner pertama, memanfaatkan ternak dari Ternak Salam.</div>
            </div>
            <div class="timeline-item">
              <div class="timeline-year">2022</div>
              <div class="timeline-title" data-en="Melon Cultivation Begins" data-id="Budidaya Melon Dimulai">Budidaya Melon Dimulai</div>
              <div class="timeline-desc" data-en="Established the first community greenhouse for premium melon cultivation, introducing modern agro-technology." data-id="Mendirikan greenhouse komunitas pertama untuk budidaya melon premium, memperkenalkan teknologi agro modern.">Mendirikan greenhouse komunitas pertama untuk budidaya melon premium dengan teknologi modern.</div>
            </div>
            <div class="timeline-item">
              <div class="timeline-year">2023</div>
              <div class="timeline-title" data-en="CIS Digitex Launched" data-id="CIS Digitex Diluncurkan">CIS Digitex Diluncurkan</div>
              <div class="timeline-desc" data-en="CIS Digitex digital platform launched to modernize community management and project oversight." data-id="Platform digital CIS Digitex diluncurkan untuk memodernisasi manajemen komunitas dan pengawasan proyek.">Platform digital CIS Digitex diluncurkan untuk memodernisasi manajemen komunitas.</div>
            </div>
            <div class="timeline-item">
              <div class="timeline-year">2025</div>
              <div class="timeline-title" data-en="Expansion & Growth" data-id="Ekspansi & Pertumbuhan">Ekspansi & Pertumbuhan</div>
              <div class="timeline-desc" data-en="All five projects running at full capacity with 120+ community members and expanded financing." data-id="Semua lima proyek berjalan penuh dengan 120+ anggota komunitas dan pembiayaan yang diperluas.">Semua lima proyek berjalan penuh dengan 120+ anggota komunitas dan pembiayaan yang diperluas.</div>
            </div>
          </div>
        </div>
        <!-- Vision Mission -->
        <div>
          <div class="section-tag" data-en="Vision & Mission" data-id="Visi & Misi">Visi & Misi</div>
          <h2 class="section-title" data-en="What Drives Us" data-id="Apa yang Mendorong Kami">Apa yang Mendorong Kami</h2>
          <div class="vm-grid" style="margin-top:2rem">
            <div class="vm-card">
              <h3 data-en="Our Vision" data-id="Visi Kami">Visi Kami</h3>
              <p data-en="To become a pioneering community-based agribusiness model that empowers rural livelihoods and fosters sustainable economic independence in Mendelem and beyond." data-id="Menjadi model agribisnis berbasis komunitas yang pelopor yang memberdayakan mata pencaharian pedesaan dan menumbuhkan kemandirian ekonomi berkelanjutan di Mendelem dan sekitarnya.">Menjadi model agribisnis berbasis komunitas yang memberdayakan mata pencaharian pedesaan dan menumbuhkan kemandirian ekonomi berkelanjutan di Mendelem dan sekitarnya.</p>
            </div>
            <div class="vm-card mission">
              <h3 data-en="Our Mission" data-id="Misi Kami">Misi Kami</h3>
              <ul>
                <li data-en="Develop sustainable agribusiness projects that benefit the whole community." data-id="Mengembangkan proyek agribisnis berkelanjutan yang menguntungkan seluruh komunitas.">Mengembangkan proyek agribisnis berkelanjutan yang menguntungkan seluruh komunitas.</li>
                <li data-en="Provide skill training and capacity building for community members." data-id="Memberikan pelatihan keterampilan dan peningkatan kapasitas bagi anggota komunitas.">Memberikan pelatihan keterampilan dan peningkatan kapasitas bagi anggota komunitas.</li>
                <li data-en="Create transparent and accountable financial management systems." data-id="Menciptakan sistem manajemen keuangan yang transparan dan akuntabel.">Menciptakan sistem manajemen keuangan yang transparan dan akuntabel.</li>
                <li data-en="Foster partnerships with government, NGOs, and private sector." data-id="Membangun kemitraan dengan pemerintah, LSM, dan sektor swasta.">Membangun kemitraan dengan pemerintah, LSM, dan sektor swasta.</li>
                <li data-en="Utilize technology to modernize rural agribusiness." data-id="Memanfaatkan teknologi untuk memodernisasi agribisnis pedesaan.">Memanfaatkan teknologi untuk memodernisasi agribisnis pedesaan.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="divider"></div>

      <!-- Team -->
      <div class="section-tag" data-en="Our Team" data-id="Tim Kami">Tim Kami</div>
      <h2 class="section-title" data-en="Meet the People Behind the Project" data-id="Kenali Orang-orang di Balik Proyek">Kenali Orang-orang di Balik Proyek</h2>
      <div class="team-grid" style="margin-top:2rem">
        <div class="team-card"><div class="team-avatar">A</div><div class="team-name">Ahmad Fauzi</div><div class="team-role" data-en="Founder & Director" data-id="Pendiri & Direktur">Pendiri & Direktur</div></div>
        <div class="team-card"><div class="team-avatar">S</div><div class="team-name">Siti Aminah</div><div class="team-role" data-en="Operations Manager" data-id="Manajer Operasi">Manajer Operasi</div></div>
        <div class="team-card"><div class="team-avatar">R</div><div class="team-name">Rizky Pratama</div><div class="team-role" data-en="Agribusiness Lead" data-id="Pemimpin Agribisnis">Pemimpin Agribisnis</div></div>
        <div class="team-card"><div class="team-avatar">N</div><div class="team-name">Nurul Hidayah</div><div class="team-role" data-en="Finance & Admin" data-id="Keuangan & Admin">Keuangan & Admin</div></div>
        <div class="team-card"><div class="team-avatar">H</div><div class="team-name">Hendra Kusuma</div><div class="team-role" data-en="Tech & Digital" data-id="Teknologi & Digital">Teknologi & Digital</div></div>
        <div class="team-card"><div class="team-avatar">D</div><div class="team-name">Dwi Rahayu</div><div class="team-role" data-en="Community Coordinator" data-id="Koordinator Komunitas">Koordinator Komunitas</div></div>
        <div class="team-card"><div class="team-avatar">B</div><div class="team-name">Budi Santoso</div><div class="team-role" data-en="Livestock Manager" data-id="Manajer Peternakan">Manajer Peternakan</div></div>
        <div class="team-card"><div class="team-avatar">Y</div><div class="team-name">Yuni Astuti</div><div class="team-role" data-en="Marketing & Sales" data-id="Pemasaran & Penjualan">Pemasaran & Penjualan</div></div>
      </div>

      <div class="divider"></div>

      <!-- Statistics Chart -->
      <div class="section-tag" data-en="Financing Statistics" data-id="Statistik Pembiayaan">Statistik Pembiayaan</div>
      <h2 class="section-title" data-en="Financial Transparency" data-id="Transparansi Keuangan">Transparansi Keuangan</h2>
      <div class="grid-2" style="margin-top:2rem;align-items:start">
        <div class="chart-container">
          <div class="chart-title" data-en="Project Financing Allocation (2024)" data-id="Alokasi Pembiayaan Proyek (2024)">Alokasi Pembiayaan Proyek (2024)</div>
          <div class="bar-chart" id="barChart">
            <!-- Rendered by JS -->
          </div>
        </div>
        <div class="chart-container">
          <div class="chart-title" data-en="Funding Sources" data-id="Sumber Dana">Sumber Dana</div>
          <div class="donut-wrapper">
            <svg class="donut-svg" width="160" height="160" viewBox="0 0 160 160">
              <circle cx="80" cy="80" r="60" fill="none" stroke="var(--bg2)" stroke-width="24"/>
              <circle cx="80" cy="80" r="60" fill="none" stroke="#0f75bd" stroke-width="24" stroke-dasharray="226 151" stroke-dashoffset="-37" transform="rotate(-90 80 80)"/>
              <circle cx="80" cy="80" r="60" fill="none" stroke="#8cc63e" stroke-width="24" stroke-dasharray="113 264" stroke-dashoffset="-263" transform="rotate(-90 80 80)"/>
              <circle cx="80" cy="80" r="60" fill="none" stroke="#e67e22" stroke-width="24" stroke-dasharray="38 339" stroke-dashoffset="-376" transform="rotate(-90 80 80)"/>
              <text x="80" y="75" text-anchor="middle" font-size="14" font-weight="700" fill="var(--text)" font-family="Playfair Display">60%</text>
              <text x="80" y="92" text-anchor="middle" font-size="10" fill="var(--text3)" font-family="Plus Jakarta Sans">Community</text>
            </svg>
            <div class="donut-legend">
              <div class="legend-item"><div class="legend-dot" style="background:#0f75bd"></div><span data-en="Community Members (60%)" data-id="Anggota Komunitas (60%)">Anggota Komunitas (60%)</span></div>
              <div class="legend-item"><div class="legend-dot" style="background:#8cc63e"></div><span data-en="NGO & Partners (30%)" data-id="LSM & Mitra (30%)">LSM & Mitra (30%)</span></div>
              <div class="legend-item"><div class="legend-dot" style="background:#e67e22"></div><span data-en="Government (10%)" data-id="Pemerintah (10%)">Pemerintah (10%)</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

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
      <div class="grid-3" id="articles-grid">
        <!-- Rendered by JS -->
      </div>
    </div>
  </section>
</div>

<!-- ========================================
     MAP PAGE
======================================== -->
<div id="page-map" class="page">
  <div class="page-hero">
    <h1 data-en="Our Location" data-id="Lokasi Kami">Lokasi Kami</h1>
    <p data-en="Find us at Jl. Belik - Mendelem No. KM 3, Pemalang, Central Java." data-id="Temukan kami di Jl. Belik - Mendelem No. KM 3, Pemalang, Jawa Tengah.">Temukan kami di Jl. Belik - Mendelem No. KM 3, Pemalang, Jawa Tengah.</p>
  </div>
  <section>
    <div class="container">
      <div class="grid-2" style="align-items:start">
        <div>
          <div class="section-tag" data-en="Address" data-id="Alamat">Alamat</div>
          <h2 class="section-title" data-en="Visit Us" data-id="Kunjungi Kami">Kunjungi Kami</h2>
          <div style="margin-top:1.5rem;display:flex;flex-direction:column;gap:1rem">
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-map-marker-alt" style="color:var(--blue)"></i></div>
              <div>
                <div style="font-weight:700;margin-bottom:.25rem" data-en="Address" data-id="Alamat">Alamat</div>
                <div style="font-size:.88rem;color:var(--text2);line-height:1.6">Jl. Belik - Mendelem No. KM 3, Mendelem, Belik, Pemalang, Jawa Tengah 52356</div>
              </div>
            </div>
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(140,198,62,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-envelope" style="color:var(--green-dark)"></i></div>
              <div>
                <div style="font-weight:700;margin-bottom:.25rem">Email</div>
                <div style="font-size:.88rem;color:var(--text2)">mendelemproject@gmail.com</div>
              </div>
            </div>
            <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
              <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-clock" style="color:var(--blue)"></i></div>
              <div>
                <div style="font-weight:700;margin-bottom:.25rem" data-en="Operating Hours" data-id="Jam Operasional">Jam Operasional</div>
                <div style="font-size:.88rem;color:var(--text2)" data-en="Monday – Saturday: 08:00 – 17:00 WIB" data-id="Senin – Sabtu: 08.00 – 17.00 WIB">Senin – Sabtu: 08.00 – 17.00 WIB</div>
              </div>
            </div>
          </div>
          <!-- Contact Form -->
          <div style="margin-top:2rem;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1.25rem" data-en="Send Us a Message" data-id="Kirim Pesan ke Kami">Kirim Pesan ke Kami</h3>
            <div class="form-group">
              <label data-en="Your Name" data-id="Nama Anda">Nama Anda</label>
              <input type="text" class="form-control" id="contactName" data-en-placeholder="Enter your name" data-id-placeholder="Masukkan nama Anda" placeholder="Masukkan nama Anda">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" id="contactEmail" placeholder="email@example.com">
            </div>
            <div class="form-group">
              <label data-en="Message" data-id="Pesan">Pesan</label>
              <textarea class="form-control" id="contactMessage" data-en-placeholder="Write your message..." data-id-placeholder="Tulis pesan Anda...">Tulis pesan Anda...</textarea>
            </div>
            <button class="btn-submit" onclick="submitContact()"><i class="fas fa-paper-plane"></i><span data-en="Send Message" data-id="Kirim Pesan">Kirim Pesan</span></button>
            <div class="form-success" id="contactSuccess"><i class="fas fa-check-circle"></i><span data-en="Message sent! We'll get back to you soon." data-id="Pesan terkirim! Kami akan segera menghubungi Anda.">Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>
          </div>
        </div>
        <div>
          <div class="map-embed">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5!2d109.3!3d-7.15!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb00000000001%3A0x1!2sJl.+Belik+-+Mendelem+KM+3%2C+Pemalang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <p style="text-align:center;color:var(--text3);font-size:.82rem;margin-top:.75rem" data-en="Jl. Belik - Mendelem KM 3, Pemalang, Central Java" data-id="Jl. Belik - Mendelem KM 3, Pemalang, Jawa Tengah">Jl. Belik - Mendelem KM 3, Pemalang, Jawa Tengah</p>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- ========================================
     SUPPORT PAGE
======================================== -->
<div id="page-support" class="page">
  <div class="page-hero">
    <h1 data-en="Support Us" data-id="Dukung Kami">Dukung Kami</h1>
    <p data-en="Help us grow the Mendelem Project through collaboration or donation." data-id="Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.">Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.</p>
  </div>
  <section>
    <div class="container">
      <div class="support-grid">
        <!-- Collaboration -->
        <div>
          <div class="support-card">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-handshake" style="color:var(--blue);font-size:1.3rem"></i></div>
            <h3 data-en="Collaboration" data-id="Kolaborasi">Kolaborasi</h3>
            <p data-en="We are open to collaboration with NGOs, government agencies, private companies, and individuals who share our vision of rural empowerment. Areas of collaboration include:" data-id="Kami terbuka untuk berkolaborasi dengan LSM, instansi pemerintah, perusahaan swasta, dan individu yang berbagi visi pemberdayaan pedesaan kami. Area kolaborasi meliputi:">Kami terbuka untuk berkolaborasi dengan LSM, instansi pemerintah, perusahaan swasta, dan individu. Area kolaborasi meliputi:</p>
            <ul style="font-size:.88rem;color:var(--text2);padding-left:1.2rem;line-height:2">
              <li data-en="Technical assistance & training" data-id="Bantuan teknis & pelatihan">Bantuan teknis & pelatihan</li>
              <li data-en="Agricultural technology provision" data-id="Penyediaan teknologi pertanian">Penyediaan teknologi pertanian</li>
              <li data-en="Market access & distribution" data-id="Akses pasar & distribusi">Akses pasar & distribusi</li>
              <li data-en="Research & development partnership" data-id="Kemitraan penelitian & pengembangan">Kemitraan penelitian & pengembangan</li>
              <li data-en="CSR programs" data-id="Program CSR">Program CSR</li>
            </ul>
            <div style="margin-top:1.25rem">
              <a href="mailto:mendelemproject@gmail.com" class="btn-primary"><i class="fas fa-envelope"></i><span data-en="Contact for Collaboration" data-id="Hubungi untuk Kolaborasi">Hubungi untuk Kolaborasi</span></a>
            </div>
          </div>
          <div class="support-card" style="margin-top:1.5rem">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(140,198,62,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-heart" style="color:var(--green-dark);font-size:1.3rem"></i></div>
            <h3 data-en="Donation" data-id="Donasi">Donasi</h3>
            <p data-en="Your donation, however small, will directly support community livelihoods in Mendelem. Funds will be used transparently for project development." data-id="Donasi Anda, sekecil apapun, akan langsung mendukung mata pencaharian komunitas di Mendelem. Dana akan digunakan secara transparan untuk pengembangan proyek.">Donasi Anda, sekecil apapun, akan langsung mendukung komunitas di Mendelem. Dana digunakan secara transparan untuk pengembangan proyek.</p>
            <div class="bank-info">
              <strong data-en="Bank Transfer" data-id="Transfer Bank">Transfer Bank</strong>
              <span>Bank BRI — <strong>1234-5678-9012-345</strong></span><br>
              <span>a.n. <strong>Mendelem Project</strong></span>
            </div>
            <div class="bank-info">
              <strong>Bank Syariah Indonesia (BSI)</strong>
              <span>No. Rekening: <strong>7890-1234-567</strong></span><br>
              <span>a.n. <strong>Mendelem Project</strong></span>
            </div>
            <div class="bank-info">
              <strong data-en="Confirmation" data-id="Konfirmasi">Konfirmasi</strong>
              <span data-en="Please send proof of transfer to: mendelemproject@gmail.com" data-id="Harap kirim bukti transfer ke: mendelemproject@gmail.com">Harap kirim bukti transfer ke: mendelemproject@gmail.com</span>
            </div>
            <p style="font-size:.8rem;color:var(--text3);margin-top:.75rem" data-en="* Payment gateway will be available soon for easier donation." data-id="* Payment gateway segera tersedia untuk kemudahan donasi.">* Payment gateway segera tersedia untuk kemudahan donasi.</p>
          </div>
        </div>
        <!-- Contact Form -->
        <div class="support-card">
          <div style="width:48px;height:48px;border-radius:12px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-paper-plane" style="color:var(--blue);font-size:1.3rem"></i></div>
          <h3 data-en="Get In Touch" data-id="Hubungi Kami">Hubungi Kami</h3>
          <p style="margin-bottom:1.5rem" data-en="Fill in the form below and we'll respond as soon as possible." data-id="Isi formulir di bawah dan kami akan merespons sesegera mungkin.">Isi formulir di bawah dan kami akan merespons sesegera mungkin.</p>
          <div class="form-group">
            <label data-en="Full Name" data-id="Nama Lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" id="supportName" data-en-placeholder="Your full name" data-id-placeholder="Nama lengkap Anda" placeholder="Nama lengkap Anda">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="supportEmail" placeholder="email@example.com">
          </div>
          <div class="form-group">
            <label data-en="Purpose" data-id="Tujuan">Tujuan</label>
            <select class="form-control" id="supportPurpose">
              <option data-en="Select purpose" data-id="Pilih tujuan">Pilih tujuan</option>
              <option data-en="Collaboration" data-id="Kolaborasi">Kolaborasi</option>
              <option data-en="Donation" data-id="Donasi">Donasi</option>
              <option data-en="Product Purchase" data-id="Pembelian Produk">Pembelian Produk</option>
              <option data-en="General Inquiry" data-id="Pertanyaan Umum">Pertanyaan Umum</option>
            </select>
          </div>
          <div class="form-group">
            <label data-en="Message" data-id="Pesan">Pesan</label>
            <textarea class="form-control" id="supportMessage" rows="5" data-en-placeholder="Describe your intention..." data-id-placeholder="Jelaskan maksud Anda...">Jelaskan maksud Anda...</textarea>
          </div>
          <button class="btn-submit" onclick="submitSupport()"><i class="fas fa-paper-plane"></i><span data-en="Send Message" data-id="Kirim Pesan">Kirim Pesan</span></button>
          <div class="form-success" id="supportSuccess"><i class="fas fa-check-circle"></i><span data-en="Message sent to mendelemproject@gmail.com!" data-id="Pesan terkirim ke mendelemproject@gmail.com!">Pesan terkirim ke mendelemproject@gmail.com!</span></div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- ========================================
     FOOTER
======================================== -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="nav-logo" style="margin-bottom:.75rem;display:flex">
          <div class="nav-logo-icon" style="background:linear-gradient(135deg,var(--blue),var(--green))">M</div>
          <div class="nav-logo-text" style="margin-left:.75rem">Mendelem Project<span>Pemalang, Jawa Tengah</span></div>
        </div>
        <p class="footer-desc" data-en="Community-based agribusiness development in Mendelem village, Pemalang, Central Java. Building sustainable rural livelihoods since 2019." data-id="Pengembangan agribisnis berbasis komunitas di desa Mendelem, Pemalang, Jawa Tengah. Membangun mata pencaharian pedesaan berkelanjutan sejak 2019.">Pengembangan agribisnis berbasis komunitas di desa Mendelem, Pemalang, Jawa Tengah. Membangun mata pencaharian pedesaan berkelanjutan sejak 2019.</p>
        <div class="footer-social">
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4 data-en="Navigation" data-id="Navigasi">Navigasi</h4>
        <a href="#" onclick="showPage('home')" data-en="Home" data-id="Beranda">Beranda</a>
        <a href="#" onclick="showPage('projects')" data-en="Projects" data-id="Proyek">Proyek</a>
        <a href="#" onclick="showPage('products')" data-en="Products" data-id="Produk">Produk</a>
        <a href="#" onclick="showPage('gallery')" data-en="Gallery" data-id="Galeri">Galeri</a>
        <a href="#" onclick="showPage('about')" data-en="About Us" data-id="Tentang Kami">Tentang Kami</a>
      </div>
      <div class="footer-col">
        <h4 data-en="Projects" data-id="Proyek">Proyek</h4>
        <a href="#" onclick="showProjectDetail('sagum')">SAGUM</a>
        <a href="#" onclick="showProjectDetail('ternak')">Ternak Salam</a>
        <a href="#" onclick="showProjectDetail('sate')">Warung Sate</a>
        <a href="#" onclick="showProjectDetail('melon')">Budidaya Melon</a>
        <a href="#" onclick="showProjectDetail('cis')">CIS Digitex</a>
      </div>
      <div class="footer-col">
        <h4 data-en="Contact" data-id="Kontak">Kontak</h4>
        <a href="#">Jl. Belik - Mendelem KM 3</a>
        <a href="#">Pemalang, Jawa Tengah</a>
        <a href="mailto:mendelemproject@gmail.com">mendelemproject@gmail.com</a>
        <a href="#" onclick="showPage('support')" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2025 Mendelem Project. <span data-en="All rights reserved." data-id="Hak cipta dilindungi.">Hak cipta dilindungi.</span></span>
      <span class="admin-btn" onclick="openAdmin()"><i class="fas fa-lock"></i> Admin Panel</span>
    </div>
  </div>
</footer>

<!-- ========================================
     ADMIN PANEL
======================================== -->
<div class="admin-overlay" id="adminOverlay">
  <div class="admin-modal">
    <div class="admin-header">
      <h2><i class="fas fa-cog" style="color:var(--blue);margin-right:.5rem"></i> Admin Panel — Mendelem Project</h2>
      <button class="admin-close" onclick="closeAdmin()"><i class="fas fa-times"></i></button>
    </div>
    <!-- Login -->
    <div id="adminLogin" class="admin-login">
      <i class="fas fa-lock" style="font-size:3rem;color:var(--blue);opacity:.5"></i>
      <h3>Admin Login</h3>
      <p data-en="Enter your admin password to continue." data-id="Masukkan password admin untuk melanjutkan.">Masukkan password admin untuk melanjutkan.</p>
      <input type="password" id="adminPwd" placeholder="Password" onkeydown="if(event.key==='Enter')adminLogin()">
      <button onclick="adminLogin()">Login</button>
      <span class="err" id="adminErr"></span>
    </div>
    <!-- Admin Content -->
    <div id="adminContent" style="display:none">
      <div class="admin-tabs">
        <button class="admin-tab active" onclick="adminTab('stats')">📊 <span data-en="Statistics" data-id="Statistik">Statistik</span></button>
        <button class="admin-tab" onclick="adminTab('articles')">📰 <span data-en="Articles" data-id="Artikel">Artikel</span></button>
        <button class="admin-tab" onclick="adminTab('products')">🛒 <span data-en="Products" data-id="Produk">Produk</span></button>
        <button class="admin-tab" onclick="adminTab('projects')">📁 <span data-en="Projects" data-id="Proyek">Proyek</span></button>
        <button class="admin-tab" onclick="adminTab('gallery')">🖼️ <span data-en="Gallery" data-id="Galeri">Galeri</span></button>
      </div>
      <div class="admin-body">
        <!-- Stats Tab -->
        <div class="admin-section active" id="adminStats">
          <h3 style="margin-bottom:1.25rem;font-family:'Playfair Display',serif" data-en="Update Statistics" data-id="Update Statistik">Update Statistik</h3>
          <div class="admin-grid">
            <div class="input-group"><label data-en="Active Projects" data-id="Proyek Aktif">Proyek Aktif</label><input type="text" id="as-projects" value="5+"></div>
            <div class="input-group"><label data-en="Community Members" data-id="Anggota Komunitas">Anggota Komunitas</label><input type="text" id="as-members" value="120+"></div>
            <div class="input-group"><label data-en="Total Financing" data-id="Total Pembiayaan">Total Pembiayaan</label><input type="text" id="as-funding" value="Rp 500jt"></div>
            <div class="input-group"><label data-en="Year Founded" data-id="Tahun Berdiri">Tahun Berdiri</label><input type="text" id="as-year" value="2019"></div>
          </div>
          <h4 style="margin:1rem 0 .75rem;font-size:.9rem" data-en="Project Financing (%)" data-id="Pembiayaan Proyek (%)">Pembiayaan Proyek (%)</h4>
          <div class="admin-grid">
            <div class="input-group"><label>SAGUM (%)</label><input type="number" id="af-sagum" value="35"></div>
            <div class="input-group"><label>Ternak Salam (%)</label><input type="number" id="af-ternak" value="25"></div>
            <div class="input-group"><label>Warung Sate (%)</label><input type="number" id="af-sate" value="15"></div>
            <div class="input-group"><label>Budidaya Melon (%)</label><input type="number" id="af-melon" value="18"></div>
            <div class="input-group"><label>CIS Digitex (%)</label><input type="number" id="af-cis" value="7"></div>
          </div>
          <button class="admin-save" onclick="saveStats()"><i class="fas fa-save"></i> <span data-en="Save Statistics" data-id="Simpan Statistik">Simpan Statistik</span></button>
        </div>
        <!-- Articles Tab -->
        <div class="admin-section" id="adminArticles">
          <h3 style="margin-bottom:1.25rem;font-family:'Playfair Display',serif" data-en="Manage Articles" data-id="Kelola Artikel">Kelola Artikel</h3>
          <div style="background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem">
            <h4 style="margin-bottom:1rem;font-size:.9rem" data-en="Add New Article" data-id="Tambah Artikel Baru">Tambah Artikel Baru</h4>
            <div class="input-group"><label data-en="Title (ID)" data-id="Judul (ID)">Judul (ID)</label><input type="text" id="aa-title-id" placeholder="Judul artikel..."></div>
            <div class="input-group"><label data-en="Title (EN)" data-id="Judul (EN)">Judul (EN)</label><input type="text" id="aa-title-en" placeholder="Article title..."></div>
            <div class="admin-grid">
              <div class="input-group"><label data-en="Date" data-id="Tanggal">Tanggal</label><input type="date" id="aa-date"></div>
              <div class="input-group"><label data-en="Category" data-id="Kategori">Kategori</label><input type="text" id="aa-cat" placeholder="Agribisnis, Komunitas..."></div>
            </div>
            <div class="input-group"><label data-en="Excerpt (ID)" data-id="Ringkasan (ID)">Ringkasan (ID)</label><textarea id="aa-excerpt-id" placeholder="Ringkasan artikel..."></textarea></div>
            <div class="input-group"><label data-en="Excerpt (EN)" data-id="Ringkasan (EN)">Ringkasan (EN)</label><textarea id="aa-excerpt-en" placeholder="Article excerpt..."></textarea></div>
            <button class="admin-save" onclick="addArticle()"><i class="fas fa-plus"></i> <span data-en="Add Article" data-id="Tambah Artikel">Tambah Artikel</span></button>
          </div>
          <div class="admin-list" id="admin-articles-list"></div>
        </div>
        <!-- Products Tab -->
        <div class="admin-section" id="adminProducts">
          <h3 style="margin-bottom:1.25rem;font-family:'Playfair Display',serif" data-en="Manage Products" data-id="Kelola Produk">Kelola Produk</h3>
          <div style="background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem">
            <h4 style="margin-bottom:1rem;font-size:.9rem" data-en="Add New Product" data-id="Tambah Produk Baru">Tambah Produk Baru</h4>
            <div class="admin-grid">
              <div class="input-group"><label data-en="Name (ID)" data-id="Nama (ID)">Nama (ID)</label><input type="text" id="ap-name-id" placeholder="Nama produk..."></div>
              <div class="input-group"><label data-en="Name (EN)" data-id="Nama (EN)">Nama (EN)</label><input type="text" id="ap-name-en" placeholder="Product name..."></div>
              <div class="input-group"><label data-en="Category (ID)" data-id="Kategori (ID)">Kategori (ID)</label><input type="text" id="ap-cat-id" placeholder="Kategori..."></div>
              <div class="input-group"><label data-en="Category (EN)" data-id="Kategori (EN)">Kategori (EN)</label><input type="text" id="ap-cat-en" placeholder="Category..."></div>
            </div>
            <div class="input-group"><label data-en="Description (ID)" data-id="Deskripsi (ID)">Deskripsi (ID)</label><textarea id="ap-desc-id" placeholder="Deskripsi produk..."></textarea></div>
            <div class="input-group"><label>Icon (Font Awesome class)</label><input type="text" id="ap-icon" placeholder="fas fa-leaf"></div>
            <button class="admin-save" onclick="addProduct()"><i class="fas fa-plus"></i> <span data-en="Add Product" data-id="Tambah Produk">Tambah Produk</span></button>
          </div>
          <div class="admin-list" id="admin-products-list"></div>
        </div>
        <!-- Projects Tab -->
        <div class="admin-section" id="adminProjects">
          <h3 style="margin-bottom:1.25rem;font-family:'Playfair Display',serif" data-en="Manage Projects" data-id="Kelola Proyek">Kelola Proyek</h3>
          <div class="admin-list" id="admin-projects-list"></div>
        </div>
        <!-- Gallery Tab -->
        <div class="admin-section" id="adminGallery">
          <h3 style="margin-bottom:1.25rem;font-family:'Playfair Display',serif" data-en="Manage Gallery" data-id="Kelola Galeri">Kelola Galeri</h3>
          <p style="color:var(--text2);font-size:.88rem" data-en="Gallery image management will be available in the full version with file upload support." data-id="Manajemen gambar galeri akan tersedia di versi lengkap dengan dukungan upload file.">Manajemen gambar galeri akan tersedia di versi lengkap dengan dukungan upload file.</p>
          <div style="margin-top:1.5rem;background:var(--bg2);border:1px solid var(--border);border-radius:12px;padding:1.5rem">
            <div class="input-group"><label data-en="Image Caption (ID)" data-id="Keterangan Gambar (ID)">Keterangan Gambar (ID)</label><input type="text" placeholder="Keterangan gambar..."></div>
            <div class="input-group"><label data-en="Image Caption (EN)" data-id="Keterangan Gambar (EN)">Keterangan Gambar (EN)</label><input type="text" placeholder="Image caption..."></div>
            <button class="admin-save"><i class="fas fa-upload"></i> <span data-en="Upload Image (coming soon)" data-id="Upload Gambar (segera hadir)">Upload Gambar (segera hadir)</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// ============================================================
// DATA STORE
// ============================================================
let currentLang = 'id';
let currentTheme = 'light';
let currentSlide = 0;
let totalSlides = 3;
let slideInterval;
let adminLoggedIn = false;

let siteData = {
  stats: { projects: '5+', members: '120+', funding: 'Rp 500jt', year: '2019' },
  financing: { sagum: 35, ternak: 25, sate: 15, melon: 18, cis: 7 },
  articles: [
    { id: 1, titleId: 'SAGUM Capai Tonggak Baru dalam Penjualan Produk Lokal', titleEn: 'SAGUM Reaches New Milestone in Local Produce Sales', date: '20 Feb 2025', cat: 'Agribisnis', excerptId: 'Unit agribisnis SAGUM mencatatkan omset bulanan tertinggi pada Februari 2025, bukti dukungan komunitas yang terus tumbuh dan meningkatnya kepercayaan konsumen lokal.', excerptEn: 'The SAGUM agribusiness unit recorded its highest monthly turnover in February 2025, a testament to growing community support and rising local consumer trust.' },
    { id: 2, titleId: 'Ekspansi Greenhouse Baru untuk Proyek Budidaya Melon', titleEn: 'New Greenhouse Expansion for Melon Cultivation Project', date: '15 Feb 2025', cat: 'Hortikultura', excerptId: 'Proyek budidaya melon berkembang dengan dua unit greenhouse tambahan, meningkatkan kapasitas produksi secara signifikan dan membuka lapangan kerja baru bagi warga desa.', excerptEn: 'The melon cultivation project has expanded with two additional greenhouse units, significantly increasing production capacity and creating new employment opportunities.' },
    { id: 3, titleId: 'Pelatihan Komunitas tentang Literasi Keuangan Digital', titleEn: 'Community Training on Digital Financial Literacy', date: '5 Feb 2025', cat: 'Komunitas', excerptId: 'CIS Digitex mengadakan pelatihan literasi keuangan digital untuk 45 anggota komunitas, membekali mereka dengan alat dan pengetahuan untuk pengelolaan keuangan modern.', excerptEn: 'CIS Digitex held a digital financial literacy training session for 45 community members, equipping them with modern financial management tools and knowledge.' },
    { id: 4, titleId: 'Ternak Salam Raih Penghargaan Peternakan Terbaik Kabupaten', titleEn: 'Ternak Salam Wins Best Livestock Award in Regency', date: '28 Jan 2025', cat: 'Peternakan', excerptId: 'Program peternakan Ternak Salam mendapatkan penghargaan peternakan terbaik tingkat kabupaten Pemalang atas inovasi manajemen dan kualitas ternak yang unggul.', excerptEn: 'The Ternak Salam livestock program received the best livestock award at Pemalang regency level for innovative management and superior livestock quality.' },
    { id: 5, titleId: 'Mendelem Project Bermitra dengan Universitas Jenderal Soedirman', titleEn: 'Mendelem Project Partners with Jenderal Soedirman University', date: '15 Jan 2025', cat: 'Kemitraan', excerptId: 'Mendelem Project resmi bermitra dengan Universitas Jenderal Soedirman untuk penelitian dan pengembangan teknologi pertanian berkelanjutan di wilayah Pemalang.', excerptEn: 'Mendelem Project officially partnered with Jenderal Soedirman University for sustainable agricultural technology research and development in the Pemalang region.' }
  ],
  products: [
    { id: 1, nameId: 'Kulit Melinjo', nameEn: 'Melinjo Skin', catId: 'Camilan Lokal', catEn: 'Local Snack', descId: 'Kulit melinjo segar berkualitas tinggi dari pohon melinjo lokal, bisa diolah menjadi emping atau dikonsumsi langsung.', icon: 'fas fa-leaf' },
    { id: 2, nameId: 'Melon', nameEn: 'Melon', catId: 'Buah Segar', catEn: 'Fresh Fruit', descId: 'Melon premium hasil budidaya greenhouse Mendelem, manis segar dan bebas pestisida berbahaya.', icon: 'fas fa-apple-alt' },
    { id: 3, nameId: 'Gula Aren', nameEn: 'Palm Sugar', catId: 'Pemanis Alami', catEn: 'Natural Sweetener', descId: 'Gula aren murni dari pohon aren lokal, diolah secara tradisional tanpa campuran bahan kimia.', icon: 'fas fa-cookie-bite' },
    { id: 4, nameId: 'Sate Kambing', nameEn: 'Goat Satay', catId: 'Kuliner', catEn: 'Culinary', descId: 'Sate kambing premium dari Warung Sate Mendelem, menggunakan kambing segar dari Ternak Salam dengan bumbu rahasia turun-temurun.', icon: 'fas fa-drumstick-bite' },
    { id: 5, nameId: 'Daging Kambing/Domba', nameEn: 'Goat/Sheep Meat', catId: 'Daging Segar', catEn: 'Fresh Meat', descId: 'Daging kambing dan domba segar berkualitas tinggi dari peternakan Ternak Salam, halal dan bebas hormon buatan.', icon: 'fas fa-bone' },
    { id: 6, nameId: 'Kambing/Domba Hidup', nameEn: 'Live Goat/Sheep', catId: 'Ternak Hidup', catEn: 'Live Livestock', descId: 'Kambing dan domba hidup sehat dan bersertifikat, cocok untuk kebutuhan aqiqah, qurban, maupun pengembangan peternakan.', icon: 'fas fa-horse' },
    { id: 7, nameId: 'Kohe (Kotoran Hewan)', nameEn: 'Organic Fertilizer', catId: 'Pupuk Organik', catEn: 'Organic Fertilizer', descId: 'Pupuk organik dari kotoran kambing/domba, telah difermentasi dan siap pakai untuk lahan pertanian dan perkebunan.', icon: 'fas fa-seedling' }
  ],
  projects: {
    sagum: { nameId: 'SAGUM', descId: 'Sarana Agribisnis Guna Umat (SAGUM) adalah unit pasar agribisnis Mendelem Project yang berfungsi sebagai pusat distribusi dan penjualan produk-produk pertanian dan peternakan lokal. SAGUM menghubungkan petani dan peternak lokal langsung dengan konsumen, menghilangkan rantai distribusi yang panjang dan memastikan harga yang adil untuk semua pihak.', nameEn: 'SAGUM', descEn: 'Sarana Agribisnis Guna Umat (SAGUM) is the Mendelem Project agribusiness market unit functioning as a distribution and sales center for local agricultural and livestock products. SAGUM connects local farmers and livestock breeders directly with consumers, eliminating long distribution chains and ensuring fair prices for all parties.', icon: 'fas fa-store', color: '#0f75bd', tag: 'Agribisnis' },
    ternak: { nameId: 'Ternak Salam', descId: 'Ternak Salam adalah program peternakan berbasis komunitas yang berfokus pada pemeliharaan kambing dan domba. Program ini tidak hanya menyediakan sumber protein hewani bagi komunitas, tetapi juga menjadi sumber pendapatan yang signifikan melalui penjualan ternak hidup, daging, dan produk turunannya. Kotoran ternak juga dimanfaatkan sebagai pupuk organik (Kohe) yang mendukung program pertanian.', nameEn: 'Ternak Salam is a community-based livestock program focused on goat and sheep rearing. The program provides both animal protein sources for the community and significant income through sales of live livestock, meat, and derivative products. Livestock manure is also utilized as organic fertilizer (Kohe) supporting agricultural programs.', icon: 'fas fa-horse', color: '#8cc63e', tag: 'Peternakan' },
    sate: { nameId: 'Warung Sate', descId: 'Warung Sate Mendelem adalah unit bisnis kuliner komunitas yang menyajikan sate kambing premium menggunakan daging kambing segar dari proyek Ternak Salam. Warung ini menggunakan resep tradisional yang diwariskan turun-temurun, menciptakan cita rasa autentik yang menjadi daya tarik tersendiri. Warung Sate juga berfungsi sebagai sarana promosi produk-produk Mendelem Project.', nameEn: 'Warung Sate Mendelem is a community culinary business unit serving premium goat satay using fresh goat meat from the Ternak Salam project. The stall uses traditional recipes passed down through generations, creating an authentic flavor that is a distinctive attraction. Warung Sate also serves as a promotional platform for Mendelem Project products.', icon: 'fas fa-utensils', color: '#e67e22', tag: 'Kuliner' },
    melon: { nameId: 'Budidaya Melon', descId: 'Proyek Budidaya Melon Mendelem menggunakan teknologi greenhouse modern yang dikombinasikan dengan metode pertanian organik. Melon yang dihasilkan adalah melon premium berkualitas tinggi yang bebas pestisida berbahaya. Proyek ini menggunakan sistem irigasi tetes (drip irrigation) yang efisien dan ramah lingkungan, serta telah menerapkan teknologi sensor IoT untuk monitoring kondisi tanaman.', nameEn: 'The Mendelem Melon Cultivation project uses modern greenhouse technology combined with organic farming methods. The melons produced are high-quality premium melons free from harmful pesticides. The project uses efficient and eco-friendly drip irrigation and has implemented IoT sensor technology for plant condition monitoring.', icon: 'fas fa-apple-alt', color: '#27ae60', tag: 'Hortikultura' },
    cis: { nameId: 'CIS Digitex', descId: 'Community Information System Digitex (CIS Digitex) adalah platform digital yang menjadi tulang punggung teknologi informasi Mendelem Project. Sistem ini mengintegrasikan manajemen anggota, pencatatan transaksi keuangan, monitoring proyek, dan komunikasi komunitas dalam satu platform terpadu. CIS Digitex juga berfungsi sebagai sarana edukasi digital bagi anggota komunitas.', nameEn: 'Community Information System Digitex (CIS Digitex) is the digital platform serving as the IT backbone of Mendelem Project. The system integrates member management, financial transaction recording, project monitoring, and community communications in one integrated platform. CIS Digitex also serves as a digital education tool for community members.', icon: 'fas fa-laptop-code', color: '#8e44ad', tag: 'Digital' }
  }
};

// ============================================================
// NAVIGATION
// ============================================================
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-' + page).classList.add('active');
  document.querySelectorAll('.nav-links a, .mobile-menu a').forEach(a => a.classList.remove('active'));
  const links = document.querySelectorAll('.nav-links a, .mobile-menu a');
  links.forEach(a => { if(a.getAttribute('onclick') && a.getAttribute('onclick').includes("'"+page+"'")) a.classList.add('active'); });
  window.scrollTo(0,0);
  if(page === 'about') renderCharts();
  if(page === 'articles') renderArticles();
  if(page === 'products') renderProducts();
  return false;
}

function showProjectDetail(key) {
  const p = siteData.projects[key];
  const isEn = currentLang === 'en';
  const html = `
    <div style="background:linear-gradient(135deg,${p.color}dd,${p.color}99);padding:4rem 2rem;color:#fff;text-align:center">
      <div style="width:80px;height:80px;border-radius:20px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;font-size:2rem"><i class="${p.icon}"></i></div>
      <div style="display:inline-block;background:rgba(255,255,255,.2);font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.3rem .9rem;border-radius:99px;margin-bottom:.75rem">${p.tag}</div>
      <h1 style="font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:900;margin-bottom:.5rem">${isEn ? p.nameEn : p.nameId}</h1>
    </div>
    <section>
      <div class="container">
        <div class="back-btn" onclick="showPage('projects')"><i class="fas fa-arrow-left"></i> <span ${isEn?'':''}>${isEn?'Back to Projects':'Kembali ke Proyek'}</span></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start" class="resp-grid">
          <div>
            <div class="project-detail-banner"><i class="${p.icon}" style="opacity:.6;color:#fff;font-size:5rem"></i><span style="color:rgba(255,255,255,.5);font-size:.82rem">${isEn?'Project Image Placeholder':'Placeholder Gambar Proyek'}</span></div>
          </div>
          <div>
            <div class="section-tag">${isEn?'About This Project':'Tentang Proyek Ini'}</div>
            <h2 class="section-title">${isEn ? p.nameEn : p.nameId}</h2>
            <p style="color:var(--text2);line-height:1.8;margin-top:1rem;font-size:.95rem">${isEn ? p.descEn : p.descId}</p>
            <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap">
              <a href="#" class="btn-primary" onclick="showPage('support')"><i class="fas fa-handshake"></i> ${isEn?'Support This Project':'Dukung Proyek Ini'}</a>
              <a href="#" class="btn-primary" style="background:var(--card);color:var(--blue);border:1px solid var(--border)" onclick="showPage('contact')"><i class="fas fa-envelope"></i> ${isEn?'Contact Us':'Hubungi Kami'}</a>
            </div>
          </div>
        </div>
        <div class="divider"></div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-top:1.5rem">
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;text-align:center">
            <i class="fas fa-calendar" style="font-size:1.75rem;color:var(--blue);margin-bottom:.75rem"></i>
            <div style="font-weight:700;margin-bottom:.25rem">${isEn?'Since 2019':'Sejak 2019'}</div>
            <div style="font-size:.82rem;color:var(--text3)">${isEn?'Running':'Berjalan'}</div>
          </div>
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;text-align:center">
            <i class="fas fa-users" style="font-size:1.75rem;color:var(--green);margin-bottom:.75rem"></i>
            <div style="font-weight:700;margin-bottom:.25rem">25+</div>
            <div style="font-size:.82rem;color:var(--text3)">${isEn?'Members Involved':'Anggota Terlibat'}</div>
          </div>
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;text-align:center">
            <i class="fas fa-chart-line" style="font-size:1.75rem;color:var(--blue);margin-bottom:.75rem"></i>
            <div style="font-weight:700;margin-bottom:.25rem">${isEn?'Active':'Aktif'}</div>
            <div style="font-size:.82rem;color:var(--text3)">${isEn?'Status':'Status'}</div>
          </div>
        </div>
      </div>
    </section>
    ${renderFooterSection()}
  `;
  document.getElementById('project-detail-content').innerHTML = html;
  showPage('project-detail');
}

function renderFooterSection() { return ''; }

// ============================================================
// SLIDER
// ============================================================
function goSlide(n) {
  document.getElementById('slide-' + currentSlide).classList.remove('active');
  document.querySelectorAll('.slider-dot')[currentSlide].classList.remove('active');
  currentSlide = (n + totalSlides) % totalSlides;
  document.getElementById('slide-' + currentSlide).classList.add('active');
  document.querySelectorAll('.slider-dot')[currentSlide].classList.add('active');
}
function nextSlide() { goSlide(currentSlide + 1); }
function prevSlide() { goSlide(currentSlide - 1); }
function startSlider() { slideInterval = setInterval(nextSlide, 5000); }
startSlider();

// ============================================================
// THEME
// ============================================================
function toggleTheme() {
  currentTheme = currentTheme === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme);
  document.getElementById('themeIcon').className = currentTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
}

// ============================================================
// LANGUAGE
// ============================================================
function toggleLang() {
  currentLang = currentLang === 'id' ? 'en' : 'id';
  document.getElementById('langLabel').textContent = currentLang === 'id' ? 'EN' : 'ID';
  document.querySelectorAll('[data-en][data-id]').forEach(el => {
    el.textContent = currentLang === 'en' ? el.getAttribute('data-en') : el.getAttribute('data-id');
  });
  document.querySelectorAll('[data-en-placeholder]').forEach(el => {
    el.placeholder = currentLang === 'en' ? el.getAttribute('data-en-placeholder') : el.getAttribute('data-id-placeholder');
  });
  renderArticles();
  renderProducts();
  if(document.getElementById('page-about').classList.contains('active')) renderCharts();
}

// ============================================================
// NAVBAR SCROLL
// ============================================================
window.addEventListener('scroll', () => {
  document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
});

// ============================================================
// MOBILE MENU
// ============================================================
function toggleMobile() { document.getElementById('mobileMenu').classList.toggle('open'); }
function closeMobile() { document.getElementById('mobileMenu').classList.remove('open'); }

// ============================================================
// RENDER PRODUCTS
// ============================================================
function renderProducts() {
  const grid = document.getElementById('products-grid');
  const isEn = currentLang === 'en';
  if(!grid) return;
  grid.innerHTML = siteData.products.map(p => `
    <div class="product-card">
      <div class="product-img"><i class="${p.icon}"></i><span>${isEn ? p.nameEn : p.nameId}</span></div>
      <div class="product-body">
        <div class="product-name">${isEn ? p.nameEn : p.nameId}</div>
        <div class="product-cat">${isEn ? p.catEn : p.catId}</div>
        <div class="product-desc">${p.descId}</div>
        <div class="product-badge">${isEn ? 'Available' : 'Tersedia'}</div>
      </div>
    </div>
  `).join('');
}

// ============================================================
// RENDER ARTICLES
// ============================================================
function renderArticles() {
  const grid = document.getElementById('articles-grid');
  const isEn = currentLang === 'en';
  if(!grid) return;
  grid.innerHTML = siteData.articles.map(a => `
    <div class="article-card">
      <div class="article-img"><i class="fas fa-newspaper"></i><span>${isEn ? 'Image Placeholder' : 'Placeholder Gambar'}</span></div>
      <div class="article-body">
        <div class="article-meta">
          <span><i class="fas fa-calendar"></i> ${a.date}</span>
          <span><i class="fas fa-tag"></i> ${a.cat}</span>
        </div>
        <div class="article-title">${isEn ? a.titleEn : a.titleId}</div>
        <div class="article-excerpt">${isEn ? a.excerptEn : a.excerptId}</div>
      </div>
    </div>
  `).join('');
}

// ============================================================
// RENDER CHARTS
// ============================================================
function renderCharts() {
  const isEn = currentLang === 'en';
  const f = siteData.financing;
  const data = [
    { label: 'SAGUM', val: f.sagum },
    { label: 'Ternak Salam', val: f.ternak },
    { label: isEn?'Warung Sate':'Warung Sate', val: f.sate },
    { label: isEn?'Melon Farm':'Budidaya Melon', val: f.melon },
    { label: 'CIS Digitex', val: f.cis }
  ];
  const chart = document.getElementById('barChart');
  if(!chart) return;
  chart.innerHTML = data.map(d => `
    <div class="bar-row">
      <div class="bar-label">${d.label}</div>
      <div class="bar-track"><div class="bar-fill" style="width:${d.val}%"></div></div>
      <div class="bar-val">${d.val}%</div>
    </div>
  `).join('');
  // Update stats bar
  const s = siteData.stats;
  const sp = document.getElementById('stat-projects');
  const sm = document.getElementById('stat-members');
  const sf = document.getElementById('stat-funding');
  const sy = document.getElementById('stat-year');
  if(sp) sp.textContent = s.projects;
  if(sm) sm.textContent = s.members;
  if(sf) sf.textContent = s.funding;
  if(sy) sy.textContent = s.year;
}

// Init render
renderProducts();
renderArticles();

// ============================================================
// CONTACT FORMS
// ============================================================
function submitContact() {
  const name = document.getElementById('contactName').value;
  const email = document.getElementById('contactEmail').value;
  const msg = document.getElementById('contactMessage').value;
  if(!name || !email || !msg) { alert(currentLang==='en'?'Please fill in all fields.':'Harap isi semua kolom.'); return; }
  document.getElementById('contactSuccess').classList.add('show');
  document.getElementById('contactName').value='';
  document.getElementById('contactEmail').value='';
  document.getElementById('contactMessage').value='';
  setTimeout(()=>document.getElementById('contactSuccess').classList.remove('show'), 4000);
}
function submitSupport() {
  const name = document.getElementById('supportName').value;
  const email = document.getElementById('supportEmail').value;
  const msg = document.getElementById('supportMessage').value;
  if(!name || !email) { alert(currentLang==='en'?'Please fill in all fields.':'Harap isi semua kolom.'); return; }
  document.getElementById('supportSuccess').classList.add('show');
  document.getElementById('supportName').value='';
  document.getElementById('supportEmail').value='';
  document.getElementById('supportMessage').value='';
  setTimeout(()=>document.getElementById('supportSuccess').classList.remove('show'), 4000);
}

// ============================================================
// ADMIN PANEL
// ============================================================
function openAdmin() { document.getElementById('adminOverlay').classList.add('open'); }
function closeAdmin() { document.getElementById('adminOverlay').classList.remove('open'); }
document.getElementById('adminOverlay').addEventListener('click', function(e){ if(e.target===this) closeAdmin(); });

function adminLogin() {
  const pwd = document.getElementById('adminPwd').value;
  if(pwd === 'mendelem2025') {
    adminLoggedIn = true;
    document.getElementById('adminLogin').style.display = 'none';
    document.getElementById('adminContent').style.display = 'block';
    renderAdminLists();
  } else {
    document.getElementById('adminErr').textContent = currentLang==='en' ? 'Wrong password.' : 'Password salah.';
  }
}

function adminTab(tab) {
  document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.admin-section').forEach(s => s.classList.remove('active'));
  event.target.classList.add('active');
  document.getElementById('admin' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.add('active');
}

function saveStats() {
  siteData.stats = {
    projects: document.getElementById('as-projects').value,
    members: document.getElementById('as-members').value,
    funding: document.getElementById('as-funding').value,
    year: document.getElementById('as-year').value
  };
  siteData.financing = {
    sagum: parseInt(document.getElementById('af-sagum').value)||0,
    ternak: parseInt(document.getElementById('af-ternak').value)||0,
    sate: parseInt(document.getElementById('af-sate').value)||0,
    melon: parseInt(document.getElementById('af-melon').value)||0,
    cis: parseInt(document.getElementById('af-cis').value)||0
  };
  // Update stats bar
  document.getElementById('stat-projects').textContent = siteData.stats.projects;
  document.getElementById('stat-members').textContent = siteData.stats.members;
  document.getElementById('stat-funding').textContent = siteData.stats.funding;
  document.getElementById('stat-year').textContent = siteData.stats.year;
  renderCharts();
  alert(currentLang==='en'?'Statistics saved!':'Statistik tersimpan!');
}

function addArticle() {
  const a = {
    id: Date.now(),
    titleId: document.getElementById('aa-title-id').value,
    titleEn: document.getElementById('aa-title-en').value,
    date: document.getElementById('aa-date').value || new Date().toLocaleDateString('id-ID'),
    cat: document.getElementById('aa-cat').value,
    excerptId: document.getElementById('aa-excerpt-id').value,
    excerptEn: document.getElementById('aa-excerpt-en').value
  };
  if(!a.titleId) { alert('Isi judul artikel'); return; }
  siteData.articles.unshift(a);
  renderAdminLists();
  renderArticles();
  ['aa-title-id','aa-title-en','aa-date','aa-cat','aa-excerpt-id','aa-excerpt-en'].forEach(id => document.getElementById(id).value='');
  alert(currentLang==='en'?'Article added!':'Artikel ditambahkan!');
}

function addProduct() {
  const p = {
    id: Date.now(),
    nameId: document.getElementById('ap-name-id').value,
    nameEn: document.getElementById('ap-name-en').value,
    catId: document.getElementById('ap-cat-id').value,
    catEn: document.getElementById('ap-cat-en').value,
    descId: document.getElementById('ap-desc-id').value,
    icon: document.getElementById('ap-icon').value || 'fas fa-box'
  };
  if(!p.nameId) { alert('Isi nama produk'); return; }
  siteData.products.push(p);
  renderAdminLists();
  renderProducts();
  ['ap-name-id','ap-name-en','ap-cat-id','ap-cat-en','ap-desc-id','ap-icon'].forEach(id => document.getElementById(id).value='');
  alert(currentLang==='en'?'Product added!':'Produk ditambahkan!');
}

function deleteArticle(id) {
  if(!confirm(currentLang==='en'?'Delete this article?':'Hapus artikel ini?')) return;
  siteData.articles = siteData.articles.filter(a => a.id !== id);
  renderAdminLists(); renderArticles();
}
function deleteProduct(id) {
  if(!confirm(currentLang==='en'?'Delete this product?':'Hapus produk ini?')) return;
  siteData.products = siteData.products.filter(p => p.id !== id);
  renderAdminLists(); renderProducts();
}

function renderAdminLists() {
  const al = document.getElementById('admin-articles-list');
  if(al) al.innerHTML = siteData.articles.map(a => `
    <div class="admin-list-item">
      <div><strong>${a.titleId}</strong><br><small>${a.date} · ${a.cat}</small></div>
      <div class="admin-item-actions">
        <button class="btn-del" onclick="deleteArticle(${a.id})"><i class="fas fa-trash"></i></button>
      </div>
    </div>
  `).join('');
  const pl = document.getElementById('admin-products-list');
  if(pl) pl.innerHTML = siteData.products.map(p => `
    <div class="admin-list-item">
      <div><strong><i class="${p.icon}" style="margin-right:.4rem;color:var(--blue)"></i>${p.nameId}</strong><br><small>${p.catId}</small></div>
      <div class="admin-item-actions">
        <button class="btn-del" onclick="deleteProduct(${p.id})"><i class="fas fa-trash"></i></button>
      </div>
    </div>
  `).join('');
  const prjl = document.getElementById('admin-projects-list');
  if(prjl) prjl.innerHTML = Object.entries(siteData.projects).map(([key, p]) => `
    <div class="admin-list-item">
      <div><strong><i class="${p.icon}" style="margin-right:.4rem;color:${p.color}"></i>${p.nameId}</strong><br><small>${p.tag}</small></div>
      <div class="admin-item-actions">
        <button class="btn-edit" onclick="showProjectDetail('${key}')"><i class="fas fa-eye"></i> ${currentLang==='en'?'View':'Lihat'}</button>
      </div>
    </div>
  `).join('');
}
</script>
</body>
</html>
