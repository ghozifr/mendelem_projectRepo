<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="description" content="Mendelem Project — Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang, Jawa Tengah.">
<meta name="robots" content="index,follow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@if(isset($activeProduct)){{ $activeProduct->name_id }} — @elseif(isset($activeArticle)){{ $activeArticle->title_id }} — @endif Mendelem Project</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{--blue:#0f75bd;--blue-dark:#0a5a91;--blue-light:#3b9dd4;--green:#8cc63e;--green-dark:#6fa02e;--white:#fff;--bg:#f8fafc;--bg2:#eef3f8;--card:#fff;--text:#1a2332;--text2:#4a5568;--text3:#718096;--border:#e2e8f0;--shadow:0 4px 24px rgba(15,117,189,.08);--shadow-lg:0 12px 48px rgba(15,117,189,.16);--radius:16px;--nav-h:88px;--transition:.3s cubic-bezier(.4,0,.2,1)}
[data-theme="dark"]{--bg:#0d1117;--bg2:#161b22;--card:#1c2431;--text:#e6edf3;--text2:#b3bcc8;--text3:#7d8fa4;--border:#30363d;--shadow:0 4px 24px rgba(0,0,0,.4);--shadow-lg:0 12px 48px rgba(0,0,0,.5)}
*{margin:0;padding:0;box-sizing:border-box}html{scroll-behavior:smooth}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);transition:background var(--transition),color var(--transition);min-height:100vh}
nav{position:fixed;top:0;left:0;right:0;height:var(--nav-h);background:var(--card);border-bottom:1px solid var(--border);z-index:1000;display:flex;align-items:center;padding:0 2.5rem;gap:2rem;backdrop-filter:blur(12px);transition:all var(--transition)}
nav.scrolled{box-shadow:var(--shadow)}
.nav-logo{display:flex;align-items:center;gap:.75rem;text-decoration:none;flex-shrink:0}
.nav-logo-icon{width:52px;height:52px;background:linear-gradient(135deg,var(--blue),var(--green));border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:1.3rem;font-family:'Playfair Display',serif}
.nav-logo-text{font-family:'Playfair Display',serif;font-weight:700;font-size:1.3rem;color:var(--text);line-height:1.1}
.nav-logo-text span{display:block;font-size:.65rem;font-family:'Plus Jakarta Sans',sans-serif;font-weight:400;color:var(--text3);letter-spacing:.08em;text-transform:uppercase}
.nav-links{display:flex;align-items:center;gap:.25rem;margin-left:1rem;flex:1}
.nav-links a{text-decoration:none;padding:.65rem 1.1rem;border-radius:8px;font-size:.93rem;font-weight:500;color:var(--text2);transition:all var(--transition);white-space:nowrap}
.nav-links a:hover,.nav-links a.active{color:var(--blue);background:rgba(15,117,189,.08)}
.nav-actions{display:flex;align-items:center;gap:.75rem;margin-left:auto}
.lang-toggle{display:flex;align-items:center;gap:.25rem;background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:.3rem .6rem;cursor:pointer;font-size:.8rem;font-weight:600;color:var(--text2);transition:all var(--transition)}
.lang-toggle:hover{border-color:var(--blue);color:var(--blue)}
.theme-btn{width:38px;height:38px;border-radius:8px;border:1px solid var(--border);background:var(--bg2);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--text2);font-size:.95rem;transition:all var(--transition)}
.theme-btn:hover{border-color:var(--blue);color:var(--blue)}
.nav-cta{background:var(--blue);color:#fff;padding:.65rem 1.4rem;font-size:.93rem;border-radius:8px;font-weight:600;text-decoration:none;transition:all var(--transition);white-space:nowrap}
.nav-cta:hover{background:var(--blue-dark);transform:translateY(-1px)}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.5rem;border-radius:8px;background:var(--bg2);border:1px solid var(--border)}
.hamburger span{width:20px;height:2px;background:var(--text);border-radius:2px;transition:all var(--transition)}
.mobile-menu{display:none;position:fixed;top:var(--nav-h);left:0;right:0;background:var(--card);border-bottom:1px solid var(--border);padding:1rem;flex-direction:column;gap:.25rem;z-index:999;max-height:calc(100vh - var(--nav-h));overflow-y:auto}
.mobile-menu.open{display:flex}
.mobile-menu a{text-decoration:none;padding:.75rem 1rem;border-radius:8px;font-size:.9rem;font-weight:500;color:var(--text2);transition:all var(--transition)}
.mobile-menu a:hover,.mobile-menu a.active{color:var(--blue);background:rgba(15,117,189,.08)}
.page{display:none;min-height:100vh;padding-top:var(--nav-h)}
.page.active{display:block}
/* HERO SLIDER */
.hero-slider{position:relative;height:calc(100vh - var(--nav-h));overflow:hidden;background:#0d1b2a}
.slide{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .8s ease;background:linear-gradient(135deg,#0d1b2a,#0a3254 50%,#0f75bd)}
.slide.active{opacity:1;z-index:1}
.slide-video-placeholder{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem;color:rgba(255,255,255,.3);font-size:.85rem}
.slide-video-placeholder i{font-size:4rem;opacity:.4}
.slide-content{position:relative;z-index:2;text-align:center;color:#fff;padding:2rem;max-width:700px}
.slide-tag{display:inline-block;background:var(--green);color:#fff;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem .9rem;border-radius:99px;margin-bottom:1.5rem}
.slide-content h1{font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:900;line-height:1.15;margin-bottom:1rem;text-shadow:0 2px 20px rgba(0,0,0,.4)}
.slide-content p{font-size:1.05rem;color:rgba(255,255,255,.8);max-width:520px;margin:0 auto 2rem}
.slide-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.btn-primary{background:var(--blue);color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem;border:none;cursor:pointer;font-family:inherit}
.btn-primary:hover{background:var(--blue-dark);transform:translateY(-2px);box-shadow:0 8px 24px rgba(15,117,189,.4)}
.btn-outline{background:transparent;color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;border:2px solid rgba(255,255,255,.4);transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-outline:hover{background:rgba(255,255,255,.1);border-color:#fff}
.btn-green{background:var(--green-dark);color:#fff;padding:.75rem 1.75rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem;border:none;cursor:pointer;font-family:inherit}
.btn-green:hover{background:#5d8a24;transform:translateY(-2px)}
.slider-nav{position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;gap:.5rem;z-index:10}
.slider-dot{width:8px;height:8px;border-radius:99px;background:rgba(255,255,255,.4);cursor:pointer;transition:all var(--transition)}
.slider-dot.active{background:#fff;width:24px}
.slider-arrows{position:absolute;top:50%;left:0;right:0;display:flex;justify-content:space-between;padding:0 1.5rem;transform:translateY(-50%);z-index:10}
.slider-arrow{width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);transition:all var(--transition)}
.slider-arrow:hover{background:rgba(255,255,255,.25)}
section{padding:5rem 2rem}
.container{max-width:1200px;margin:0 auto}
.section-tag{display:inline-block;background:rgba(15,117,189,.1);color:var(--blue);font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem .9rem;border-radius:99px;margin-bottom:1rem}
.section-title{font-family:'Playfair Display',serif;font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:800;line-height:1.2;margin-bottom:1rem;color:var(--text)}
.section-subtitle{color:var(--text2);font-size:1rem;max-width:560px;line-height:1.7}
.section-header{margin-bottom:3.5rem}.section-header.center{text-align:center}.section-header.center .section-subtitle{margin:0 auto}
.stats-bar{background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;padding:3rem 2rem}
.stats-bar .container{display:grid;grid-template-columns:repeat(4,1fr);gap:2rem}
.stat-item{text-align:center}.stat-num{font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:900;line-height:1;margin-bottom:.4rem}.stat-label{font-size:.82rem;opacity:.8;letter-spacing:.05em;text-transform:uppercase}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem}.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}
.card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition)}.card.clickable{cursor:pointer}.card.clickable:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.card-img{height:180px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.8rem;overflow:hidden}
.card-img i{font-size:2rem;color:var(--blue);opacity:.5}
.card-body{padding:1.5rem}.card-tag{display:inline-block;background:rgba(140,198,62,.15);color:var(--green-dark);font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.25rem .7rem;border-radius:99px;margin-bottom:.75rem}
.card-title{font-family:'Playfair Display',serif;font-weight:700;font-size:1.1rem;margin-bottom:.5rem;color:var(--text)}.card-desc{font-size:.85rem;color:var(--text2);line-height:1.6}.card-link{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;font-size:.83rem;font-weight:600;color:var(--blue);text-decoration:none}.card-link:hover{gap:.65rem}
/* PRODUCTS */
.product-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition);cursor:pointer}
.product-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-lg);border-color:var(--green)}
.product-img{height:180px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;flex-direction:column;gap:.5rem;color:var(--text3);font-size:.78rem;overflow:hidden;position:relative}
.product-img i{font-size:2.5rem;color:var(--green);opacity:.6}
.product-img .product-hover-overlay{position:absolute;inset:0;background:rgba(15,117,189,.85);display:flex;align-items:center;justify-content:center;gap:.5rem;color:#fff;font-size:.88rem;font-weight:600;opacity:0;transition:opacity var(--transition)}
.product-card:hover .product-hover-overlay{opacity:1}
.product-body{padding:1.25rem}.product-name{font-weight:700;font-size:1rem;margin-bottom:.3rem;color:var(--text)}.product-cat{font-size:.75rem;color:var(--text3);margin-bottom:.5rem}.product-desc{font-size:.83rem;color:var(--text2);line-height:1.55}.product-price{font-size:.88rem;font-weight:700;color:var(--blue);margin-top:.5rem}.product-badge{display:inline-block;background:rgba(140,198,62,.12);color:var(--green-dark);font-size:.7rem;font-weight:700;padding:.2rem .6rem;border-radius:99px;margin-top:.5rem}
.product-badge.out{background:rgba(229,62,62,.1);color:#e53e3e}.product-badge.seasonal{background:rgba(237,137,54,.1);color:#dd6b20}
/* PRODUCT DETAIL PAGE */
.product-detail-hero{background:linear-gradient(135deg,var(--blue-dark),var(--blue));padding:3rem 2rem;color:#fff}
.product-detail-hero .container{display:grid;grid-template-columns:400px 1fr;gap:3rem;align-items:center}
.product-detail-img{border-radius:var(--radius);overflow:hidden;height:340px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;flex-direction:column;color:rgba(255,255,255,.5);font-size:.85rem;flex-shrink:0}
.product-detail-img img{width:100%;height:100%;object-fit:cover}
.product-detail-img i{font-size:5rem;margin-bottom:1rem;opacity:.5}
.product-detail-info{color:#fff}
.product-detail-info .badge-hero{display:inline-block;background:rgba(255,255,255,.2);color:#fff;font-size:.75rem;font-weight:700;padding:.3rem .8rem;border-radius:99px;margin-bottom:1rem}
.product-detail-info h1{font-family:'Playfair Display',serif;font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:900;margin-bottom:.75rem}
.product-detail-info .price{font-size:1.4rem;font-weight:800;margin-bottom:.75rem}
.product-detail-info p{font-size:.95rem;opacity:.9;line-height:1.7;margin-bottom:1.5rem}
.inquiry-btn-group{display:flex;gap:1rem;flex-wrap:wrap}
.btn-wa{background:#25d366;color:#fff;padding:.75rem 1.5rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-wa:hover{background:#1ebe5d;transform:translateY(-2px)}
/* ORDER FORM */
.order-form-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem;margin-top:2rem}
.order-form-card h3{font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:700;margin-bottom:1.25rem;color:var(--text)}
/* GALLERY */
.gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:200px;gap:1rem}
.gallery-item{background:linear-gradient(135deg,var(--bg2),var(--border));border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.78rem;overflow:hidden;transition:all var(--transition);cursor:pointer;border:1px solid var(--border)}
.gallery-item:hover{transform:scale(1.02);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.gallery-item.large{grid-column:span 2;grid-row:span 2}
.gallery-item i{font-size:2rem;color:var(--blue);opacity:.5}
/* ARTICLES */
.article-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;transition:all var(--transition);cursor:pointer}
.article-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--blue)}
.article-img{height:200px;background:linear-gradient(135deg,var(--bg2),var(--border));display:flex;align-items:center;justify-content:center;color:var(--text3);flex-direction:column;gap:.5rem;font-size:.78rem;overflow:hidden}
.article-img i{font-size:2.5rem;color:var(--blue);opacity:.4}
.article-body{padding:1.5rem}.article-meta{display:flex;gap:1rem;font-size:.78rem;color:var(--text3);margin-bottom:.75rem;flex-wrap:wrap}.article-meta span{display:flex;align-items:center;gap:.3rem}
.article-title{font-family:'Playfair Display',serif;font-weight:700;font-size:1.15rem;margin-bottom:.5rem;color:var(--text);line-height:1.35}
.article-excerpt{font-size:.85rem;color:var(--text2);line-height:1.65}
/* ABOUT */
.timeline{position:relative;padding-left:2rem}.timeline::before{content:'';position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--blue),var(--green))}
.timeline-item{position:relative;margin-bottom:2.5rem;padding-left:1.5rem}.timeline-item::before{content:'';position:absolute;left:-2.45rem;top:.35rem;width:14px;height:14px;border-radius:50%;background:var(--blue);border:3px solid var(--card)}
.timeline-year{font-size:.78rem;font-weight:700;color:var(--blue);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.4rem}.timeline-title{font-weight:700;margin-bottom:.35rem;color:var(--text)}.timeline-desc{font-size:.88rem;color:var(--text2);line-height:1.6}
.team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem}
.team-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;text-align:center;transition:all var(--transition)}.team-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:var(--green)}
.team-avatar{width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--green));margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;overflow:hidden}
.team-name{font-weight:700;margin-bottom:.25rem;color:var(--text)}.team-role{font-size:.8rem;color:var(--text3)}
.chart-container{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem}
.chart-title{font-weight:700;margin-bottom:1.5rem;color:var(--text)}.bar-chart{display:flex;flex-direction:column;gap:.85rem}.bar-row{display:grid;grid-template-columns:160px 1fr 80px;align-items:center;gap:1rem}.bar-label{font-size:.83rem;color:var(--text2);font-weight:500}.bar-track{height:10px;background:var(--bg2);border-radius:99px;overflow:hidden}.bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--blue),var(--green));transition:width 1s cubic-bezier(.4,0,.2,1)}.bar-val{font-size:.83rem;font-weight:700;color:var(--blue);text-align:right}
.donut-wrapper{display:flex;align-items:center;gap:3rem;flex-wrap:wrap}.donut-legend{display:flex;flex-direction:column;gap:.75rem}.legend-item{display:flex;align-items:center;gap:.6rem;font-size:.85rem;color:var(--text2)}.legend-dot{width:12px;height:12px;border-radius:3px;flex-shrink:0}
.vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}.vm-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem;border-left:4px solid var(--blue)}.vm-card.mission{border-left-color:var(--green)}.vm-card h3{font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1rem;color:var(--text)}.vm-card p,.vm-card li{font-size:.9rem;color:var(--text2);line-height:1.7}.vm-card ul{padding-left:1.2rem}.vm-card ul li{margin-bottom:.4rem}
/* MAP */
.map-embed{border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);height:480px}.map-embed iframe{width:100%;height:100%;border:0}
/* SUPPORT */
.support-grid{display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start}
.support-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem}
.support-card h3{font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:700;margin-bottom:.75rem;color:var(--text)}.support-card p{font-size:.9rem;color:var(--text2);line-height:1.7;margin-bottom:1rem}
.bank-info{background:var(--bg2);border-radius:10px;padding:1.25rem;margin:.75rem 0;font-size:.88rem}.bank-info strong{display:block;color:var(--text);margin-bottom:.25rem}.bank-info span{color:var(--text2)}
/* FORMS */
.form-group{margin-bottom:1.25rem}.form-group label{display:block;font-size:.85rem;font-weight:600;margin-bottom:.5rem;color:var(--text2)}
.form-control{width:100%;padding:.75rem 1rem;border-radius:10px;border:1px solid var(--border);background:var(--bg2);color:var(--text);font-size:.9rem;font-family:inherit;transition:all var(--transition);outline:none}
.form-control:focus{border-color:var(--blue);background:var(--card);box-shadow:0 0 0 3px rgba(15,117,189,.12)}
textarea.form-control{resize:vertical;min-height:120px}
.btn-submit{background:var(--blue);color:#fff;padding:.8rem 2rem;border-radius:10px;border:none;font-size:.9rem;font-weight:600;font-family:inherit;cursor:pointer;transition:all var(--transition);display:inline-flex;align-items:center;gap:.5rem}
.btn-submit:hover{background:var(--blue-dark);transform:translateY(-2px)}
.form-success{display:none;background:rgba(140,198,62,.12);border:1px solid var(--green);border-radius:10px;padding:1rem 1.25rem;color:var(--green-dark);font-size:.88rem;margin-top:1rem;align-items:center;gap:.5rem}
.form-success.show{display:flex}
.alert-error{background:rgba(229,62,62,.1);border:1px solid rgba(229,62,62,.3);border-radius:10px;padding:1rem;color:#e53e3e;font-size:.88rem;margin-bottom:1rem}
/* LIGHTBOX */
#lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;align-items:center;justify-content:center;padding:1rem}
#lightbox img,#lightbox video{max-width:90vw;max-height:90vh;border-radius:12px;object-fit:contain}
#lightbox-close{position:fixed;top:1rem;right:1rem;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.1rem;transition:all var(--transition);z-index:10000}
#lightbox-close:hover{background:rgba(255,255,255,.25)}
/* FOOTER */
footer{background:var(--text);color:rgba(255,255,255,.9);padding:4rem 2rem 2rem}
[data-theme="dark"] footer{background:#060b11}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;margin-bottom:3rem}
.footer-brand .nav-logo-text{color:#fff}.footer-brand .nav-logo-text span{color:rgba(255,255,255,.5)}
.footer-desc{margin:.75rem 0;font-size:.85rem;color:rgba(255,255,255,.6);line-height:1.7}
.footer-social{display:flex;gap:.5rem;margin-top:1rem}
.social-btn{width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;transition:all var(--transition)}
.social-btn:hover{background:var(--blue);color:#fff}
.footer-col h4{font-size:.82rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:1rem;color:rgba(255,255,255,.5)}
.footer-col a{display:block;color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;margin-bottom:.5rem;transition:color var(--transition)}.footer-col a:hover{color:#fff}
.footer-bottom{border-top:1px solid rgba(255,255,255,.1);padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;font-size:.8rem;color:rgba(255,255,255,.4)}
/* UTILS */
.page-hero{padding:4rem 2rem;background:linear-gradient(135deg,var(--blue) 0%,var(--blue-dark) 100%);color:#fff;text-align:center}
.page-hero h1{font-family:'Playfair Display',serif;font-size:clamp(1.75rem,4vw,2.75rem);font-weight:900;margin-bottom:.75rem}
.page-hero p{font-size:1rem;opacity:.85;max-width:520px;margin:0 auto}
.features-strip{background:var(--bg2);padding:2rem;border-top:1px solid var(--border);border-bottom:1px solid var(--border)}
.features-strip .container{display:flex;gap:2rem;flex-wrap:wrap;justify-content:center}
.feature-item{display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--text2)}
.feature-item i{color:var(--blue);font-size:1.1rem}
.divider{height:1px;background:var(--border);margin:2rem 0}
.back-btn{display:inline-flex;align-items:center;gap:.5rem;font-size:.85rem;font-weight:600;color:var(--text2);cursor:pointer;margin-bottom:1.5rem;padding:.5rem .9rem;border-radius:8px;border:1px solid var(--border);background:var(--card);transition:all var(--transition);text-decoration:none}
.back-btn:hover{border-color:var(--blue);color:var(--blue)}
.breadcrumb{display:flex;align-items:center;gap:.4rem;font-size:.82rem;color:var(--text3);margin-bottom:1.5rem;flex-wrap:wrap}
.breadcrumb a{color:var(--blue);text-decoration:none;cursor:pointer}.breadcrumb i{font-size:.6rem}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.fade-up{animation:fadeUp .5s ease forwards}.delay-1{animation-delay:.1s}.delay-2{animation-delay:.2s}.delay-3{animation-delay:.3s}
/* ===== RESPONSIVE (Point 5) ===== */
@media(max-width:1024px){
  .grid-4{grid-template-columns:repeat(2,1fr)}
  .team-grid{grid-template-columns:repeat(2,1fr)}
  .footer-grid{grid-template-columns:1fr 1fr}
  .product-detail-hero .container{grid-template-columns:1fr;gap:2rem}
  .product-detail-img{height:260px;width:100%}
}
@media(max-width:768px){
  :root{--nav-h:72px}
  .nav-links,.nav-cta{display:none}
  .hamburger{display:flex}
  .grid-3,.grid-2{grid-template-columns:1fr}
  .grid-4{grid-template-columns:repeat(2,1fr)}
  .gallery-grid{grid-template-columns:repeat(2,1fr);grid-auto-rows:160px}
  .gallery-item.large{grid-column:span 1;grid-row:span 1}
  .stats-bar .container{grid-template-columns:repeat(2,1fr);gap:1.5rem}
  .support-grid{grid-template-columns:1fr}
  .vm-grid{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr;gap:2rem}
  .bar-row{grid-template-columns:1fr;gap:.3rem}
  .donut-wrapper{flex-direction:column;gap:1.5rem}
  .inquiry-btn-group{flex-direction:column}
  section{padding:3rem 1.25rem}
  .hero-slider{height:70vh}
  .map-embed{height:320px}
}
@media(max-width:480px){
  .gallery-grid{grid-template-columns:1fr}
  .team-grid{grid-template-columns:1fr 1fr}
  .grid-4{grid-template-columns:1fr}
  .stat-num{font-size:2rem}
  .slide-content h1{font-size:1.75rem}
}
/* Touch target sizes for mobile */
@media(hover:none){
  .btn-primary,.btn-submit,.btn-green,.btn-wa{min-height:48px}
  .form-control{font-size:16px}/* Prevent iOS zoom */
  .nav-links a{padding:.6rem 1rem}
}
</style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav id="navbar">
  <a class="nav-logo" href="{{ route('home') }}">
    <div class="nav-logo-icon">M</div>
    <div class="nav-logo-text">Mendelem Project<span>Pemalang, Jawa Tengah</span></div>
  </a>
  <div class="nav-links" id="navLinks">
    <a href="{{ route('home') }}" class="{{ $activePage==='home'?'active':'' }}" data-en="Home" data-id="Beranda">Beranda</a>
    <a href="{{ route('page.projects') }}" class="{{ $activePage==='projects'?'active':'' }}" data-en="Projects" data-id="Proyek">Proyek</a>
    <a href="{{ route('page.products') }}" class="{{ in_array($activePage,['products','product-detail'])?'active':'' }}" data-en="Products" data-id="Produk">Produk</a>
    <a href="{{ route('kurban.index') }}"class="{{ in_array($activePage,['kurban','kurban-detail'])?'active':'' }}"
   style="{{ in_array($activePage,['kurban','kurban-detail'])?'color:#1a6b2f;background:rgba(26,107,47,.08)':'' }}">
  🐐 Kambing Kurban
</a>
    <a href="{{ route('page.gallery') }}" class="{{ $activePage==='gallery'?'active':'' }}" data-en="Gallery" data-id="Galeri">Galeri</a>
    <a href="{{ route('page.articles') }}" class="{{ in_array($activePage,['articles','article-detail'])?'active':'' }}" data-en="Articles" data-id="Artikel">Artikel</a>
    <a href="{{ route('page.about') }}" class="{{ $activePage==='about'?'active':'' }}" data-en="About Us" data-id="Tentang Kami">Tentang Kami</a>
    <a href="{{ route('page.map') }}" class="{{ $activePage==='map'?'active':'' }}" data-en="Location" data-id="Lokasi">Lokasi</a>
    <a href="{{ route('page.support') }}" class="{{ $activePage==='support'?'active':'' }}" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
  </div>
  <div class="nav-actions">
    <div class="lang-toggle" onclick="toggleLang()" id="langToggle"><i class="fas fa-globe"></i><span id="langLabel">EN</span></div>
    <button class="theme-btn" onclick="toggleTheme()" title="Toggle tema"><i class="fas fa-moon" id="themeIcon"></i></button>
    <a href="{{ route('page.support') }}" class="nav-cta" data-en="Support Us" data-id="Dukung Kami">Dukung Kami</a>
    <div class="hamburger" onclick="toggleMobile()"><span></span><span></span><span></span></div>
  </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="{{ route('home') }}" onclick="closeMobile()" class="{{ $activePage==='home'?'active':'' }}">🏠 Beranda</a>
  <a href="{{ route('page.projects') }}" onclick="closeMobile()" class="{{ $activePage==='projects'?'active':'' }}">🌱 Proyek</a>
  <a href="{{ route('page.products') }}" onclick="closeMobile()" class="{{ in_array($activePage,['products','product-detail'])?'active':'' }}">🛒 Produk</a>
  <a href="{{ route('kurban.index') }}" onclick="closeMobile()"class="{{ in_array($activePage,['kurban','kurban-detail'])?'active':'' }}">
  🐐 Kambing Kurban
</a>
  <a href="{{ route('page.gallery') }}" onclick="closeMobile()" class="{{ $activePage==='gallery'?'active':'' }}">📸 Galeri</a>
  <a href="{{ route('page.articles') }}" onclick="closeMobile()" class="{{ $activePage==='articles'?'active':'' }}">📰 Artikel</a>
  <a href="{{ route('page.about') }}" onclick="closeMobile()" class="{{ $activePage==='about'?'active':'' }}">👥 Tentang Kami</a>
  <a href="{{ route('page.map') }}" onclick="closeMobile()" class="{{ $activePage==='map'?'active':'' }}">📍 Lokasi</a>
  <a href="{{ route('page.support') }}" onclick="closeMobile()" class="{{ $activePage==='support'?'active':'' }}" style="background:rgba(15,117,189,.08);color:var(--blue);font-weight:600">💙 Dukung Kami</a>
</div>

{{-- ==================== HOME PAGE ==================== --}}
<div id="page-home" class="page {{ $activePage==='home' ? 'active' : '' }}">

  <div class="hero-slider">
    @forelse($sliders as $i => $slide)
    <div class="slide {{ $i===0?'active':'' }}" id="slide-{{ $i }}">
      @if($slide->media_path)
        @if($slide->media_type==='video')
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
          @if($slide->btn_primary_url)<a href="{{ $slide->btn_primary_url }}" class="btn-primary" data-en="{{ $slide->btn_primary_label_en }}" data-id="{{ $slide->btn_primary_label_id }}"><i class="fas fa-arrow-right"></i><span>{{ $slide->btn_primary_label_id }}</span></a>@endif
          @if($slide->btn_secondary_url)<a href="{{ $slide->btn_secondary_url }}" class="btn-outline" data-en="{{ $slide->btn_secondary_label_en }}" data-id="{{ $slide->btn_secondary_label_id }}"><span>{{ $slide->btn_secondary_label_id }}</span></a>@endif
        </div>
      </div>
    </div>
    @empty
    <div class="slide active"><div class="slide-video-placeholder"><i class="fas fa-play-circle"></i><span>Tambahkan slider di Admin Panel</span></div>
      <div class="slide-content"><div class="slide-tag">Selamat Datang</div><h1>Mendelem Project</h1><p>Pengembangan agribisnis berbasis komunitas di Desa Mendelem, Pemalang.</p>
        <div class="slide-btns"><a href="{{ route('page.projects') }}" class="btn-primary"><i class="fas fa-arrow-right"></i><span>Jelajahi Proyek</span></a></div>
      </div>
    </div>
    @endforelse
    <div class="slider-arrows">
      <div class="slider-arrow" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></div>
      <div class="slider-arrow" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="slider-nav" id="sliderNav">
      @php $sc = max(1,$sliders->count()); @endphp
      @for($i=0;$i<$sc;$i++)<div class="slider-dot {{ $i===0?'active':'' }}" onclick="goSlide({{ $i }})"></div>@endfor
    </div>
  </div>

  <div class="stats-bar"><div class="container">
    @forelse($statsBar as $stat)
    <div class="stat-item"><div class="stat-num">{{ $stat->value }}{{ $stat->unit }}</div><div class="stat-label" data-en="{{ $stat->label_en }}" data-id="{{ $stat->label_id }}">{{ $stat->label_id }}</div></div>
    @empty
    <div class="stat-item"><div class="stat-num">5+</div><div class="stat-label">Proyek Aktif</div></div>
    <div class="stat-item"><div class="stat-num">20+</div><div class="stat-label">Anggota</div></div>
    <div class="stat-item"><div class="stat-num">180</div><div class="stat-label">Jenis Produk</div></div>
    <div class="stat-item"><div class="stat-num">2016</div><div class="stat-label">Berdiri Sejak</div></div>
    @endforelse
  </div></div>

  <div class="features-strip"><div class="container">
    <div class="feature-item"><i class="fas fa-leaf"></i><span>Agribisnis Berkelanjutan</span></div>
    <div class="feature-item"><i class="fas fa-users"></i><span>Berbasis Komunitas</span></div>
    <div class="feature-item"><i class="fas fa-chart-line"></i><span>Pemberdayaan Ekonomi</span></div>
    <div class="feature-item"><i class="fas fa-handshake"></i><span>Kolaborasi Terbuka</span></div>
    <div class="feature-item"><i class="fas fa-shield-alt"></i><span>Terpercaya & Transparan</span></div>
  </div></div>

  <section><div class="container">
    <div class="section-header"><div class="section-tag">Proyek Kami</div><h2 class="section-title">Apa yang Kami Bangun Bersama</h2></div>
    <div class="grid-3">
      @forelse($projects as $project)
      <a href="{{ route('page.projects') }}" class="card clickable" style="text-decoration:none">
        <div class="card-img" style="background:linear-gradient(135deg,{{ $project->color ?? '#0f75bd' }}22,{{ $project->color ?? '#0f75bd' }}11)">
          @if($project->thumbnail)<img src="{{ asset('storage/'.$project->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
          @else<i class="{{ $project->icon ?? 'fas fa-folder' }}" style="color:{{ $project->color ?? '#0f75bd' }}"></i><span>{{ $project->name_id }}</span>@endif
        </div>
        <div class="card-body">
          <div class="card-tag">{{ $project->tag_id }}</div>
          <div class="card-title">{{ $project->name_id }}</div>
          <div class="card-desc">{{ Str::limit($project->short_desc_id,100) }}</div>
          <span class="card-link">Selengkapnya <i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      @empty<div class="card" style="grid-column:1/-1"><div class="card-body" style="padding:3rem;text-align:center;color:#718096">Belum ada proyek.</div></div>@endforelse
    </div>
  </div></section>

  <section style="background:var(--bg2);padding:5rem 2rem"><div class="container">
    <div class="section-header center"><div class="section-tag">Produk Kami</div><h2 class="section-title">Segar dari Desa Mendelem</h2></div>
    <div class="grid-4">
      @forelse($products as $product)
      <a href="{{ route('product.detail',$product) }}" class="product-card" style="text-decoration:none">
        <div class="product-img">
          @if($product->thumbnail)<img src="{{ asset('storage/'.$product->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
          @else<i class="{{ $product->icon ?? 'fas fa-box' }}"></i><span>{{ $product->name_id }}</span>@endif
          <div class="product-hover-overlay"><i class="fas fa-eye"></i> Lihat Detail</div>
        </div>
        <div class="product-body">
          <div class="product-name">{{ $product->name_id }}</div>
          <div class="product-cat">{{ $product->category_id }}</div>
          <div class="product-desc">{{ Str::limit($product->description_id,80) }}</div>
          <span class="product-badge {{ $product->availability==='out_of_stock'?'out':($product->availability==='seasonal'?'seasonal':'') }}">
            {{ $product->availability==='available'?'✅ Tersedia':($product->availability==='seasonal'?'🌿 Musiman':'❌ Habis') }}
          </span>
        </div>
      </a>
      @empty<div class="product-card" style="grid-column:1/-1"><div class="product-body" style="padding:2rem;text-align:center;color:#718096">Belum ada produk.</div></div>@endforelse
    </div>
    <div style="text-align:center;margin-top:2.5rem"><a href="{{ route('page.products') }}" class="btn-primary"><i class="fas fa-store"></i><span>Lihat Semua Produk</span></a></div>
  </div></section>

  <section><div class="container">
    <div class="section-header" style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem">
      <div><div class="section-tag">Artikel Terbaru</div><h2 class="section-title">Berita & Kabar Terbaru</h2></div>
      <a href="{{ route('page.articles') }}" class="btn-primary">Semua Artikel</a>
    </div>
    <div class="grid-3">
      @forelse($articles as $article)
      <a href="{{ route('article.detail',$article->slug) }}" class="article-card" style="text-decoration:none">
        <div class="article-img">@if($article->thumbnail)<img src="{{ asset('storage/'.$article->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">@else<i class="fas fa-newspaper"></i><span>Foto Artikel</span>@endif</div>
        <div class="article-body">
          <div class="article-meta"><span><i class="fas fa-calendar"></i> {{ ($article->published_at ?? $article->created_at)->format('d M Y') }}</span><span><i class="fas fa-tag"></i> {{ $article->category_id }}</span></div>
          <div class="article-title">{{ $article->title_id }}</div>
          <div class="article-excerpt">{{ Str::limit($article->excerpt_id,120) }}</div>
        </div>
      </a>
      @empty<div class="article-card" style="grid-column:1/-1"><div class="article-body" style="padding:3rem;text-align:center;color:#718096">Belum ada artikel.</div></div>@endforelse
    </div>
  </div></section>

</div>{{-- /page-home --}}

{{-- ==================== PROJECTS PAGE ==================== --}}
<div id="page-projects" class="page {{ $activePage==='projects' ? 'active' : '' }}">
  <div class="page-hero">
    <h1>Proyek Kami</h1><p>Program agribisnis komunitas untuk pemberdayaan ekonomi desa Mendelem.</p>
  </div>
  <section><div class="container">
    <div class="grid-3">
      @forelse($allProjects as $project)
      <div class="card">
        <div class="card-img" style="background:linear-gradient(135deg,{{ $project->color ?? '#0f75bd' }}22,{{ $project->color ?? '#0f75bd' }}11)">
          @if($project->thumbnail)<img src="{{ asset('storage/'.$project->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
          @else<i class="{{ $project->icon ?? 'fas fa-folder' }}" style="font-size:3rem;color:{{ $project->color ?? '#0f75bd' }};opacity:.7"></i>@endif
        </div>
        <div class="card-body">
          <div class="card-tag">{{ $project->tag_id }}</div>
          <div class="card-title">{{ $project->name_id }}</div>
          <div class="card-desc">{{ $project->short_desc_id }}</div>
          @if($project->long_desc_id)<div style="font-size:.83rem;color:var(--text2);line-height:1.6;margin-top:.75rem">{{ Str::limit($project->long_desc_id,200) }}</div>@endif
        </div>
      </div>
      @empty<div class="card" style="grid-column:1/-1"><div class="card-body" style="padding:3rem;text-align:center;color:#718096">Belum ada proyek. Tambahkan di Admin Panel.</div></div>@endforelse
    </div>
  </div></section>
</div>

{{-- ==================== PRODUCTS PAGE ==================== --}}
<div id="page-products" class="page {{ $activePage==='products' ? 'active' : '' }}">
  <div class="page-hero"><h1>Produk Kami</h1><p>Produk berkualitas langsung dari komunitas desa Mendelem.</p></div>
  <section><div class="container">
    <div class="grid-4">
      @forelse($allProducts as $product)
      <a href="{{ route('product.detail',$product) }}" class="product-card" style="text-decoration:none">
        <div class="product-img">
          @if($product->thumbnail)<img src="{{ asset('storage/'.$product->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">
          @else<i class="{{ $product->icon ?? 'fas fa-box' }}"></i><span>{{ $product->name_id }}</span>@endif
          <div class="product-hover-overlay"><i class="fas fa-eye"></i> Lihat & Pesan</div>
        </div>
        <div class="product-body">
          <div class="product-name">{{ $product->name_id }}</div>
          <div class="product-cat">{{ $product->category_id }}</div>
          <div class="product-desc">{{ Str::limit($product->description_id,100) }}</div>
          @if($product->price_min)<div class="product-price">Rp {{ number_format($product->price_min,0,',','.') }}@if($product->price_max) – {{ number_format($product->price_max,0,',','.') }}@endif{{ $product->unit ? ' / '.$product->unit : '' }}</div>@endif
          <span class="product-badge {{ $product->availability==='out_of_stock'?'out':($product->availability==='seasonal'?'seasonal':'') }}">
            {{ $product->availability==='available'?'✅ Tersedia':($product->availability==='seasonal'?'🌿 Musiman':'❌ Habis') }}
          </span>
        </div>
      </a>
      @empty<div class="product-card" style="grid-column:1/-1"><div class="product-body" style="padding:2rem;text-align:center;color:#718096">Belum ada produk.</div></div>@endforelse
    </div>
    <div style="grid-column:1/-1;background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:2px solid #86efac;border-radius:var(--radius);padding:1.75rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;margin-bottom:1rem">
  <div>
    <div style="font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#15803d;margin-bottom:.4rem">🐐 TERNAK SALAM</div>
    <div style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:800;color:#14532d">Kambing & Domba Kurban</div>
    <div style="font-size:.85rem;color:#166534;margin-top:.25rem">Hewan kurban pilihan dari peternakan komunitas Mendelem</div>
  </div>
  <a href="{{ route('kurban.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;background:#1a6b2f;color:#fff;padding:.7rem 1.5rem;border-radius:10px;font-weight:700;text-decoration:none;white-space:nowrap;font-size:.9rem">
    Lihat Semua <i class="fas fa-arrow-right"></i>
  </a>
</div>
  </div></section>
</div>

{{-- ==================== PRODUCT DETAIL PAGE (Point 2) ==================== --}}
@if($activePage==='product-detail' && isset($activeProduct))
<div id="page-product-detail" class="page active">
  <div class="product-detail-hero">
    <div class="container">
      <div style="margin-bottom:1.5rem">
        <a href="{{ route('page.products') }}" class="back-btn" style="color:rgba(255,255,255,.7);border-color:rgba(255,255,255,.3);background:rgba(255,255,255,.1)"><i class="fas fa-arrow-left"></i> Kembali ke Produk</a>
      </div>
      <div style="display:grid;grid-template-columns:380px 1fr;gap:3rem;align-items:center">
        <div class="product-detail-img">
          @if($activeProduct->thumbnail)<img src="{{ asset('storage/'.$activeProduct->thumbnail) }}" alt="{{ $activeProduct->name_id }}">
          @else<i class="{{ $activeProduct->icon ?? 'fas fa-box' }}"></i><span style="font-size:.85rem">{{ $activeProduct->name_id }}</span>@endif
        </div>
        <div class="product-detail-info">
          <div class="badge-hero">{{ $activeProduct->category_id }}</div>
          <h1>{{ $activeProduct->name_id }}</h1>
          @if($activeProduct->price_min)<div class="price">Rp {{ number_format($activeProduct->price_min,0,',','.') }}@if($activeProduct->price_max) – {{ number_format($activeProduct->price_max,0,',','.') }}@endif{{ $activeProduct->unit ? ' / '.$activeProduct->unit : '' }}</div>@endif
          <p>{{ $activeProduct->description_id }}</p>
          <div style="margin-bottom:1.5rem">
            <span style="display:inline-flex;align-items:center;gap:.4rem;padding:.4rem .9rem;border-radius:99px;font-size:.8rem;font-weight:700;background:{{ $activeProduct->availability==='available'?'rgba(140,198,62,.2)':($activeProduct->availability==='seasonal'?'rgba(237,137,54,.2)':'rgba(229,62,62,.2)') }};color:{{ $activeProduct->availability==='available'?'#6fa02e':($activeProduct->availability==='seasonal'?'#dd6b20':'#e53e3e') }}">
              {{ $activeProduct->availability==='available'?'✅ Tersedia Sekarang':($activeProduct->availability==='seasonal'?'🌿 Musiman':'❌ Stok Habis') }}
            </span>
          </div>
          <div class="inquiry-btn-group">
            <a href="#order-form" class="btn-primary" onclick="document.getElementById('order-form').scrollIntoView({behavior:'smooth'})"><i class="fas fa-envelope"></i> Kirim Pesan / Pesan Sekarang</a>
            @php $waMsg = urlencode("Halo, saya tertarik dengan produk *{$activeProduct->name_id}* dari Mendelem Project. Mohon informasi lebih lanjut."); @endphp
            <a href="https://wa.me/6285811653332?text={{ $waMsg }}" class="btn-wa" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i> Chat WhatsApp</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Gallery Section --}}
  @if($activeProduct->gallery && count($activeProduct->gallery) > 0)
  <section style="background:var(--bg2);padding:3rem 2rem"><div class="container">
    <h2 class="section-title" style="margin-bottom:1.5rem">Foto Produk</h2>
    <div class="gallery-grid">
      @foreach($activeProduct->gallery as $i => $img)
      <div class="gallery-item {{ $i===0?'large':'' }}" onclick="openLightbox('{{ asset('storage/'.$img) }}','image')">
        <img src="{{ asset('storage/'.$img) }}" style="width:100%;height:100%;object-fit:cover" alt="">
      </div>
      @endforeach
    </div>
  </div></section>
  @endif

  {{-- Order / Inquiry Form --}}
  <section id="order-form"><div class="container">
    <div class="grid-2" style="align-items:start">
      <div>
        <h2 class="section-title">Pesan Sekarang</h2>
        <p style="color:var(--text2);font-size:.92rem;margin-bottom:2rem;line-height:1.7">Isi formulir di bawah untuk memesan atau bertanya tentang <strong>{{ $activeProduct->name_id }}</strong>. Tim kami akan merespons secepatnya.</p>

        @if(session('inquiry_success'))
        <div class="form-success show"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>
        @endif

        @if($errors->any())
        <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('product.inquiry',$activeProduct) }}">
          @csrf
          <div class="form-group"><label>Nama Lengkap *</label><input type="text" name="name" class="form-control" required placeholder="Nama lengkap Anda" value="{{ old('name') }}"></div>
          <div class="form-group"><label>Email *</label><input type="email" name="email" class="form-control" required placeholder="email@example.com" value="{{ old('email') }}"></div>
          <div class="form-group"><label>No. WhatsApp</label><input type="tel" name="phone" class="form-control" placeholder="+6285811653332" value="{{ old('phone') }}"></div>
          <div class="form-group"><label>Jumlah yang Diinginkan</label><input type="text" name="quantity" class="form-control" placeholder="Contoh: 5 kg, 2 ekor, 10 buah" value="{{ old('quantity') }}"></div>
          <div class="form-group"><label>Pesan / Pertanyaan *</label><textarea name="message" class="form-control" required rows="5" placeholder="Tulis pesan atau pertanyaan Anda di sini...">{{ old('message') }}</textarea></div>
          <div style="display:flex;gap:1rem;flex-wrap:wrap">
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
            @php $waFull = urlencode("Halo, saya {old('name','')} ingin memesan *{$activeProduct->name_id}* dari Mendelem Project."); @endphp
            <a href="https://wa.me/6285811653332?text={{ urlencode('Halo, saya ingin memesan '.$activeProduct->name_id.' dari Mendelem Project.') }}" class="btn-wa" target="_blank"><i class="fab fa-whatsapp"></i> Chat WhatsApp</a>
          </div>
        </form>
      </div>
      <div>
        <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem">
          <h3 style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1.25rem">Informasi Produk</h3>
          <div style="display:flex;flex-direction:column;gap:.75rem">
            <div style="display:flex;justify-content:space-between;padding:.75rem;background:var(--bg2);border-radius:8px"><span style="font-size:.85rem;color:var(--text2)">Kategori</span><span style="font-size:.85rem;font-weight:600">{{ $activeProduct->category_id ?? '-' }}</span></div>
            <div style="display:flex;justify-content:space-between;padding:.75rem;background:var(--bg2);border-radius:8px"><span style="font-size:.85rem;color:var(--text2)">Ketersediaan</span><span style="font-size:.85rem;font-weight:600">{{ $activeProduct->availability==='available'?'Tersedia':($activeProduct->availability==='seasonal'?'Musiman':'Habis') }}</span></div>
            @if($activeProduct->price_min)<div style="display:flex;justify-content:space-between;padding:.75rem;background:var(--bg2);border-radius:8px"><span style="font-size:.85rem;color:var(--text2)">Harga</span><span style="font-size:.85rem;font-weight:600;color:var(--blue)">Rp {{ number_format($activeProduct->price_min,0,',','.') }}{{ $activeProduct->price_max ? ' – '.number_format($activeProduct->price_max,0,',','.') : '' }}</span></div>@endif
            @if($activeProduct->unit)<div style="display:flex;justify-content:space-between;padding:.75rem;background:var(--bg2);border-radius:8px"><span style="font-size:.85rem;color:var(--text2)">Satuan</span><span style="font-size:.85rem;font-weight:600">{{ $activeProduct->unit }}</span></div>@endif
          </div>
          <div class="divider"></div>
          <p style="font-size:.83rem;color:var(--text3);line-height:1.6"><i class="fas fa-info-circle" style="color:var(--blue)"></i> Harga dapat berubah sewaktu-waktu. Hubungi kami untuk konfirmasi harga terkini.</p>
        </div>

        @if(isset($relatedProducts) && $relatedProducts->count())
        <div style="margin-top:1.5rem">
          <h3 style="font-weight:700;margin-bottom:1rem;font-size:1rem">Produk Lainnya</h3>
          <div style="display:flex;flex-direction:column;gap:.75rem">
            @foreach($relatedProducts as $rel)
            <a href="{{ route('product.detail',$rel) }}" style="text-decoration:none;display:flex;gap:.75rem;align-items:center;background:var(--card);border:1px solid var(--border);border-radius:10px;padding:.75rem;transition:all var(--transition)" onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--border)'">
              <div style="width:52px;height:52px;border-radius:8px;background:var(--bg2);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0">
                @if($rel->thumbnail)<img src="{{ asset('storage/'.$rel->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">@else<i class="{{ $rel->icon ?? 'fas fa-box' }}" style="color:var(--green);font-size:1.1rem"></i>@endif
              </div>
              <div>
                <div style="font-size:.88rem;font-weight:600;color:var(--text)">{{ $rel->name_id }}</div>
                <div style="font-size:.78rem;color:var(--text3)">{{ $rel->category_id }}</div>
              </div>
              <i class="fas fa-chevron-right" style="margin-left:auto;color:var(--text3);font-size:.75rem"></i>
            </a>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div></section>
</div>
@endif

{{-- ==================== GALLERY PAGE ==================== --}}
<div id="page-gallery" class="page {{ $activePage==='gallery' ? 'active' : '' }}">
  <div class="page-hero"><h1>Galeri</h1><p>Dokumentasi visual kegiatan dan proyek komunitas Mendelem.</p></div>
  <section><div class="container">
    @if($gallery->count())
    <div class="gallery-grid">
      @foreach($gallery as $i => $item)
      <div class="gallery-item {{ $i===0||$i===5?'large':'' }}" onclick="openLightbox('{{ asset('storage/'.$item->file_path) }}','{{ $item->file_type }}')">
        @if($item->file_type==='video')
          <video src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover" preload="metadata"></video>
          <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:40px;height:40px;background:rgba(0,0,0,.5);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;pointer-events:none"><i class="fas fa-play" style="font-size:.75rem;margin-left:2px"></i></div>
        @else
          <img src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover" alt="{{ $item->title_id }}" loading="lazy">
        @endif
        <div style="position:absolute;bottom:0;left:0;right:0;padding:.5rem;background:linear-gradient(transparent,rgba(0,0,0,.6));color:#fff;font-size:.72rem;display:none" class="gallery-caption">{{ $item->title_id }}</div>
      </div>
      @endforeach
    </div>
    @else
    <div style="text-align:center;padding:4rem;color:var(--text3)"><i class="fas fa-images" style="font-size:3.5rem;opacity:.3;display:block;margin-bottom:1rem"></i><p>Belum ada foto atau video. Upload di Admin Panel.</p></div>
    @endif
  </div></section>
</div>

{{-- ==================== ABOUT PAGE ==================== --}}
<div id="page-about" class="page {{ $activePage==='about' ? 'active' : '' }}">
  <div class="page-hero"><h1>Tentang Mendelem Project</h1><p>Sejarah, visi, tim, dan statistik pembiayaan kami.</p></div>
  <section><div class="container">
    <div class="grid-2" style="align-items:start">
      <div>
        <div class="section-tag">Sejarah Kami</div><h2 class="section-title">Kisah Mendelem</h2>
        <div class="timeline" style="margin-top:2rem">
            <div class="timeline-item"><div class="timeline-year">2016</div><div class="timeline-title">Penulisan Project</div><div class="timeline-desc">Ide awal pembuatan Mendelem Project dalam penulisan tesis MENDELEM PROJECT A SOCIAL BUSINESS VENTURE PROJECT.</div></div>
          <div class="timeline-item"><div class="timeline-year">2019</div><div class="timeline-title">Pendirian</div><div class="timeline-desc">Mendelem Project didirikan oleh tokoh komunitas di desa Mendelem, Pemalang, dengan visi memberdayakan ekonomi lokal.</div></div>
          <div class="timeline-item"><div class="timeline-year">2020</div><div class="timeline-title">SAGUM & Ternak Salam</div><div class="timeline-desc">Meluncurkan dua proyek inti pertama — unit agribisnis SAGUM dan program peternakan Ternak Salam.</div></div>
          <div class="timeline-item"><div class="timeline-year">2021</div><div class="timeline-title">Warung Sate Dibuka</div><div class="timeline-desc">Warung Sate diluncurkan sebagai unit kuliner pertama, memanfaatkan ternak dari Ternak Salam.</div></div>
          <div class="timeline-item"><div class="timeline-year">2022</div><div class="timeline-title">Budidaya Melon Dimulai</div><div class="timeline-desc">Greenhouse komunitas pertama untuk budidaya melon premium dengan teknologi modern.</div></div>
          <div class="timeline-item"><div class="timeline-year">2023</div><div class="timeline-title">CIS Digitex Diluncurkan</div><div class="timeline-desc">Platform digital CIS Digitex untuk memodernisasi manajemen komunitas.</div></div>
          <div class="timeline-item"><div class="timeline-year">2025</div><div class="timeline-title">Ekspansi & Pertumbuhan</div><div class="timeline-desc">Semua proyek berjalan penuh dengan komunitas yang terus berkembang.</div></div>
        </div>
      </div>
      <div>
        <div class="section-tag">Visi & Misi</div><h2 class="section-title">Apa yang Mendorong Kami</h2>
        <div class="vm-grid" style="margin-top:2rem">
          <div class="vm-card"><h3>Visi Kami</h3><p>Menjadi model agribisnis berbasis komunitas yang memberdayakan mata pencaharian pedesaan dan kemandirian ekonomi berkelanjutan di Mendelem dan sekitarnya.</p></div>
          <div class="vm-card mission"><h3>Misi Kami</h3><ul><li>Mengembangkan proyek agribisnis berkelanjutan.</li><li>Memberikan pelatihan keterampilan bagi anggota.</li><li>Sistem keuangan transparan & akuntabel.</li><li>Membangun kemitraan luas.</li><li>Memanfaatkan teknologi modern.</li></ul></div>
        </div>
      </div>
    </div>
    <div class="divider"></div>
    <div class="section-tag">Tim Kami</div><h2 class="section-title">Kenali Orang-orang di Balik Proyek</h2>
    <div class="team-grid" style="margin-top:2rem">
      @forelse($team as $member)
      <div class="team-card">
        <div class="team-avatar">@if($member->photo)<img src="{{ asset('storage/'.$member->photo) }}" style="width:72px;height:72px;border-radius:50%;object-fit:cover" alt="">@else{{ strtoupper(substr($member->name,0,1)) }}@endif</div>
        <div class="team-name">{{ $member->name }}</div>
        <div class="team-role">{{ $member->role_id }}</div>
      </div>
      @empty<div style="grid-column:1/-1;text-align:center;padding:2rem;color:#718096">Belum ada anggota tim.</div>@endforelse
    </div>
    <div class="divider"></div>
    <div class="section-tag">Statistik Pembiayaan</div><h2 class="section-title">Transparansi Keuangan</h2>
    <div class="grid-2" style="margin-top:2rem;align-items:start">
      <div class="chart-container"><div class="chart-title">Alokasi Pembiayaan Proyek</div>
        <div class="bar-chart">
          @forelse($financing as $f)
          <div class="bar-row"><div class="bar-label">{{ $f->label_id }}</div><div class="bar-track"><div class="bar-fill" style="width:{{ min(100,(float)$f->value) }}%"></div></div><div class="bar-val">{{ $f->value }}{{ $f->unit }}</div></div>
          @empty<p style="color:#718096;font-size:.85rem">Belum ada data pembiayaan.</p>@endforelse
        </div>
      </div>
      <div class="chart-container"><div class="chart-title">Sumber Dana</div>
        @php $totalFund=$fundSrc->sum(fn($s)=>(float)$s->value);$circ=2*pi()*60;$off=0; @endphp
        @if($fundSrc->count())
        <div class="donut-wrapper">
          <svg width="160" height="160" viewBox="0 0 160 160">
            <circle cx="80" cy="80" r="60" fill="none" stroke="var(--bg2)" stroke-width="24"/>
            @foreach($fundSrc as $s)@php $pct=$totalFund>0?((float)$s->value/$totalFund):0;$dash=$pct*$circ;$gap=$circ-$dash;@endphp
            <circle cx="80" cy="80" r="60" fill="none" stroke="{{ $s->color ?? '#0f75bd' }}" stroke-width="24" stroke-dasharray="{{ round($dash,1) }} {{ round($gap,1) }}" stroke-dashoffset="{{ -round($off,1) }}" transform="rotate(-90 80 80)"/>@php $off+=$dash;@endphp
            @endforeach
            <text x="80" y="80" text-anchor="middle" dominant-baseline="middle" font-size="13" font-weight="700" fill="var(--text)" font-family="Playfair Display">{{ $fundSrc->first()?->value ?? '0' }}%</text>
          </svg>
          <div class="donut-legend">@foreach($fundSrc as $s)<div class="legend-item"><div class="legend-dot" style="background:{{ $s->color ?? '#0f75bd' }}"></div><span>{{ $s->label_id }} ({{ $s->value }}%)</span></div>@endforeach</div>
        </div>
        @else<p style="color:#718096;font-size:.85rem">Belum ada data sumber dana.</p>@endif
      </div>
    </div>
  </div></section>
</div>

{{-- ==================== ARTICLES PAGE ==================== --}}
<div id="page-articles" class="page {{ $activePage==='articles' ? 'active' : '' }}">
  <div class="page-hero"><h1>Artikel & Berita</h1><p>Berita terbaru, laporan kegiatan, dan informasi dari komunitas Mendelem.</p></div>
  <section><div class="container">
    <div class="grid-3">
      @forelse($allArticles as $article)
      <a href="{{ route('article.detail',$article->slug) }}" class="article-card" style="text-decoration:none">
        <div class="article-img">@if($article->thumbnail)<img src="{{ asset('storage/'.$article->thumbnail) }}" style="width:100%;height:100%;object-fit:cover" alt="">@else<i class="fas fa-newspaper"></i>@endif</div>
        <div class="article-body">
          <div class="article-meta"><span><i class="fas fa-calendar"></i> {{ ($article->published_at ?? $article->created_at)->format('d M Y') }}</span><span><i class="fas fa-eye"></i> {{ $article->views }}</span></div>
          <div class="article-title">{{ $article->title_id }}</div>
          <div class="article-excerpt">{{ Str::limit($article->excerpt_id,150) }}</div>
          <span class="card-link" style="display:inline-flex;margin-top:.75rem">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
        </div>
      </a>
      @empty<div class="article-card" style="grid-column:1/-1"><div class="article-body" style="padding:3rem;text-align:center;color:#718096">Belum ada artikel.</div></div>@endforelse
    </div>
  </div></section>
</div>

{{-- ==================== ARTICLE DETAIL ==================== --}}
@if($activePage==='article-detail' && isset($activeArticle))
<div id="page-article-detail" class="page active">
  <div class="page-hero">
    @if($activeArticle->category_id)<div style="display:inline-block;background:rgba(255,255,255,.2);padding:.3rem .9rem;border-radius:99px;font-size:.75rem;font-weight:700;margin-bottom:1rem">{{ $activeArticle->category_id }}</div>@endif
    <h1 style="max-width:800px;margin:0 auto">{{ $activeArticle->title_id }}</h1>
    <div style="display:flex;justify-content:center;gap:1.5rem;margin-top:1rem;font-size:.82rem;opacity:.8;flex-wrap:wrap">
      <span><i class="fas fa-calendar"></i> {{ ($activeArticle->published_at ?? $activeArticle->created_at)->format('d M Y') }}</span>
      <span><i class="fas fa-eye"></i> {{ $activeArticle->views }} kali dibaca</span>
    </div>
  </div>
  <section><div class="container" style="max-width:800px">
    <a href="{{ route('page.articles') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Semua Artikel</a>
    @if($activeArticle->thumbnail)<img src="{{ asset('storage/'.$activeArticle->thumbnail) }}" style="width:100%;border-radius:var(--radius);margin-bottom:2rem;max-height:400px;object-fit:cover" alt="">@endif
    @if($activeArticle->excerpt_id)<p style="font-size:1.1rem;color:var(--text2);line-height:1.7;margin-bottom:2rem;border-left:4px solid var(--blue);padding-left:1.25rem">{{ $activeArticle->excerpt_id }}</p>@endif
    <div style="font-size:.95rem;color:var(--text2);line-height:1.8">{!! nl2br(e($activeArticle->body_id)) !!}</div>
  </div></section>
</div>
@endif

{{-- ==================== MAP / LOCATION PAGE ==================== --}}
<div id="page-map" class="page {{ $activePage==='map' ? 'active' : '' }}">
  <div class="page-hero"><h1>Lokasi Kami</h1><p>Temukan kami di Jl. Belik - Mendelem KM 3, Pemalang.</p></div>
  <section><div class="container">
    <div class="grid-2" style="align-items:start">
      <div>
        <div class="section-tag">Alamat</div><h2 class="section-title">Kunjungi Kami</h2>
        <div style="margin-top:1.5rem;display:flex;flex-direction:column;gap:1rem">
          <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-map-marker-alt" style="color:var(--blue)"></i></div>
            <div><div style="font-weight:700;margin-bottom:.25rem">Alamat</div><div style="font-size:.88rem;color:var(--text2)">Jl. Belik - Mendelem No. KM 3, Mendelem, Belik, Pemalang, Jawa Tengah 52356</div></div>
          </div>
          <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(140,198,62,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-envelope" style="color:var(--green-dark)"></i></div>
            <div><div style="font-weight:700;margin-bottom:.25rem">Email</div><div style="font-size:.88rem;color:var(--text2)"><a href="mailto:mendelemproject@gmail.com" style="color:var(--blue)">mendelemproject@gmail.com</a></div></div>
          </div>
          <div style="display:flex;gap:1rem;align-items:flex-start;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.25rem">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-clock" style="color:var(--blue)"></i></div>
            <div><div style="font-weight:700;margin-bottom:.25rem">Jam Operasional</div><div style="font-size:.88rem;color:var(--text2)">Senin – Sabtu: 08.00 – 17.00 WIB</div></div>
          </div>
        </div>
        <div style="margin-top:2rem;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem">
          <h3 style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.2rem;margin-bottom:1.25rem">Kirim Pesan ke Kami</h3>
          @if(session('contact_success'))<div class="form-success show"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>@endif
          @if($errors->any())<div class="alert-error">{{ $errors->first() }}</div>@endif
          <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <input type="hidden" name="redirect_page" value="lokasi">
            <div class="form-group"><label>Nama</label><input type="text" class="form-control" name="name" required placeholder="Nama Anda" value="{{ old('name') }}"></div>
            <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" required placeholder="email@example.com" value="{{ old('email') }}"></div>
            <div class="form-group"><label>Pesan</label><textarea class="form-control" name="message" required rows="4" placeholder="Tulis pesan...">{{ old('message') }}</textarea></div>
            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
          </form>
        </div>
      </div>
      <div><div class="map-embed"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5!2d109.3!3d-7.15!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb00000000001%3A0x1!2sJl.+Belik+-+Mendelem+KM+3%2C+Pemalang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" allowfullscreen loading="lazy"></iframe></div></div>
    </div>
  </div></section>
</div>

{{-- ==================== SUPPORT PAGE ==================== --}}
<div id="page-support" class="page {{ $activePage==='support' ? 'active' : '' }}">
  <div class="page-hero"><h1>Dukung Kami</h1><p>Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.</p></div>
  <section><div class="container">
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
          <p>Donasi Anda langsung mendukung komunitas di Mendelem. Dana digunakan secara transparan untuk pengembangan proyek.</p>
          <div class="bank-info"><strong>Bank BSI</strong><span>7261453217</span><br><span>a.n. SMP ALAM GUNUNG MENDELEM</span></div>
          <!--<div class="bank-info"><strong>Bank Syariah Indonesia (BSI)</strong><span>7890-1234-567</span><br><span>a.n. Mendelem Project</span></div>-->
          <div class="bank-info"><strong>Konfirmasi Transfer</strong><span>Kirim bukti ke: mendelemproject@gmail.com</span></div>
        </div>
      </div>
      <div class="support-card">
        <div style="width:48px;height:48px;border-radius:12px;background:rgba(15,117,189,.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem"><i class="fas fa-paper-plane" style="color:var(--blue);font-size:1.3rem"></i></div>
        <h3>Hubungi Kami</h3>
        <p style="margin-bottom:1.5rem">Isi formulir di bawah dan kami akan merespons sesegera mungkin.</p>
        @if(session('contact_success'))<div class="form-success show"><i class="fas fa-check-circle"></i><span>Pesan terkirim! Kami akan segera menghubungi Anda.</span></div>@endif
        @if($errors->any())<div class="alert-error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('contact.send') }}">
          @csrf
          <input type="hidden" name="redirect_page" value="dukungan">
          <div class="form-group"><label>Nama Lengkap *</label><input type="text" class="form-control" name="name" required placeholder="Nama lengkap Anda" value="{{ old('name') }}"></div>
          <div class="form-group"><label>Email *</label><input type="email" class="form-control" name="email" required placeholder="email@example.com" value="{{ old('email') }}"></div>
          <div class="form-group"><label>No. WhatsApp</label><input type="tel" class="form-control" name="phone" placeholder="+62..." value="{{ old('phone') }}"></div>
          <div class="form-group"><label>Tujuan</label><select class="form-control" name="purpose"><option value="">Pilih tujuan</option><option>Kolaborasi</option><option>Donasi</option><option>Pembelian Produk</option><option>Pertanyaan Umum</option></select></div>
          <div class="form-group"><label>Pesan *</label><textarea class="form-control" name="message" required rows="5" placeholder="Jelaskan maksud Anda...">{{ old('message') }}</textarea></div>
          <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
        </form>
      </div>
    </div>
  </div></section>
</div>

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

{{-- ==================== FOOTER ==================== --}}
<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="nav-logo" style="margin-bottom:.75rem">
          <div class="nav-logo-icon">M</div>
          <div class="nav-logo-text" style="margin-left:.75rem">Mendelem Project<span>Pemalang, Jawa Tengah</span></div>
        </div>
        <p class="footer-desc">Pengembangan agribisnis berbasis komunitas di desa Mendelem, Pemalang, Jawa Tengah. Membangun mata pencaharian pedesaan berkelanjutan sejak 2019.</p>
        <div class="footer-social">
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
          <a href="https://wa.me/6285811653332" class="social-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Navigasi</h4>
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('page.projects') }}">Proyek</a>
        <a href="{{ route('page.products') }}">Produk</a>
        <a href="{{ route('kurban.index') }}">🐐 Kambing Kurban</a>
        <a href="{{ route('page.gallery') }}">Galeri</a>
        <a href="{{ route('page.articles') }}">Artikel</a>
        <a href="{{ route('page.about') }}">Tentang Kami</a>
        <a href="{{ route('page.map') }}">Lokasi</a>
        <a href="{{ route('page.support') }}">Dukung Kami</a>
      </div>
      <div class="footer-col">
        <h4>Produk Kami</h4>
        @foreach($allProducts->take(5) as $p)
        <a href="{{ route('product.detail',$p) }}">{{ $p->name_id }}</a>
        @endforeach
      </div>
      <div class="footer-col">
        <h4>Kontak</h4>
        <a href="#">Jl. Belik - Mendelem KM 3</a>
        <a href="#">Pemalang, Jawa Tengah</a>
        <a href="mailto:mendelemproject@gmail.com">mendelemproject@gmail.com</a>
        <a href="{{ route('admin.login') }}" style="opacity:.4;font-size:.76rem;margin-top:.5rem"><i class="fas fa-lock"></i> Admin Panel</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Mendelem Project. Hak cipta dilindungi.</span>
      <span>Made with ❤️ untuk komunitas Mendelem</span>
    </div>
  </div>
</footer>

{{-- LIGHTBOX --}}
<div id="lightbox" onclick="if(event.target===this)closeLightbox()">
  <button id="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
  <img id="lightbox-img" src="" alt="" style="display:none">
  <video id="lightbox-vid" src="" controls style="display:none;max-width:90vw;max-height:85vh;border-radius:12px"></video>
</div>

<script>
let currentLang = 'id';
let currentTheme = 'light';
let currentSlide = 0;
let totalSlides = {{ max(1,$sliders->count()) }};
let slideInterval;

// LANGUAGE
// function toggleLang() {
//   currentLang = currentLang === 'id' ? 'en' : 'id';
//   document.getElementById('langLabel').textContent = currentLang === 'id' ? 'EN' : 'ID';
//   document.querySelectorAll('[data-en][data-id]').forEach(el => {
//     const val = currentLang === 'en' ? el.getAttribute('data-en') : el.getAttribute('data-id');
//     if (val) el.textContent = val;
//   });
// }
/**
 * SOLUSI CEPAT: Tambahkan ini ke <script> di mendelem_Home.blade.php
 * GANTI fungsi toggleLang() yang lama dengan versi ini.
 *
 * Strategi: Dictionary-based translation untuk semua teks yang tidak
 * punya data-en/data-id attribute.
 */

const translations = {
  // PAGE HEROES
  'Proyek Kami': 'Our Projects',
  'Program agribisnis komunitas untuk pemberdayaan ekonomi desa Mendelem.': 'Community agribusiness programs for economic empowerment of Mendelem village.',
  'Produk Kami': 'Our Products',
  'Produk berkualitas langsung dari komunitas desa Mendelem.': 'Quality products directly from the Mendelem village community.',
  'Galeri': 'Gallery',
  'Dokumentasi visual kegiatan dan proyek komunitas Mendelem.': 'Visual documentation of Mendelem community activities and projects.',
  'Tentang Mendelem Project': 'About Mendelem Project',
  'Sejarah, visi, tim, dan statistik pembiayaan kami.': 'Our history, vision, team, and financing statistics.',
  'Artikel & Berita': 'Articles & News',
  'Berita terbaru, laporan kegiatan, dan informasi dari komunitas Mendelem.': 'Latest news, activity reports, and information from the Mendelem community.',
  'Lokasi Kami': 'Our Location',
  'Temukan kami di Jl. Belik - Mendelem KM 3, Pemalang.': 'Find us at Jl. Belik - Mendelem KM 3, Pemalang.',
  'Dukung Kami': 'Support Us',
  'Bantu kami mengembangkan Mendelem Project melalui kolaborasi atau donasi.': 'Help us grow Mendelem Project through collaboration or donation.',
  'Kambing Kurban': 'Qurban Animals',
  'Hewan kurban pilihan dari peternakan komunitas Mendelem — sehat, terpercaya, siap kurban.': 'Choice sacrificial animals from Mendelem community farm — healthy, trusted, ready for qurban.',

  // SECTION HEADERS & TITLES
  'Apa yang Kami Bangun Bersama': 'What We Build Together',
  'Segar dari Desa Mendelem': 'Fresh from Mendelem Village',
  'Berita & Kabar Terbaru': 'Latest News & Updates',
  'Sejarah Kami': 'Our History',
  'Kisah Mendelem': 'The Mendelem Story',
  'Visi & Misi': 'Vision & Mission',
  'Apa yang Mendorong Kami': 'What Drives Us',
  'Tim Kami': 'Our Team',
  'Kenali Orang-orang di Balik Proyek': 'Meet the People Behind the Project',
  'Statistik Pembiayaan': 'Financing Statistics',
  'Transparansi Keuangan': 'Financial Transparency',
  'Alokasi Pembiayaan Proyek': 'Project Financing Allocation',
  'Sumber Dana': 'Funding Sources',

  // ABOUT / TIMELINE
  'Penulisan Project': 'Project Writing',
  'Pendirian': 'Founding',
  'Ekspansi & Pertumbuhan': 'Expansion & Growth',
  'Semua proyek berjalan penuh dengan komunitas yang terus berkembang.': 'All projects running at full capacity with a growing community.',

  // VISION MISSION
  'Visi Kami': 'Our Vision',
  'Misi Kami': 'Our Mission',
  'Menjadi model agribisnis berbasis komunitas yang memberdayakan mata pencaharian pedesaan dan kemandirian ekonomi berkelanjutan di Mendelem dan sekitarnya.': 'To become a community-based agribusiness model that empowers rural livelihoods and sustainable economic independence in Mendelem and surrounding areas.',

  // LOCATION PAGE
  'Alamat': 'Address',
  'Kunjungi Kami': 'Visit Us',
  'Jam Operasional': 'Operating Hours',
  'Senin – Sabtu: 08.00 – 17.00 WIB': 'Monday – Saturday: 08:00 – 17:00 WIB',
  'Kirim Pesan ke Kami': 'Send Us a Message',

  // SUPPORT PAGE
  'Kolaborasi': 'Collaboration',
  'Kami terbuka untuk berkolaborasi dengan LSM, pemerintah, perusahaan, dan individu yang berbagi visi pemberdayaan pedesaan kami.': 'We are open to collaborating with NGOs, governments, companies, and individuals who share our vision of rural empowerment.',
  'Donasi': 'Donation',
  'Donasi Anda langsung mendukung komunitas di Mendelem. Dana digunakan secara transparan untuk pengembangan proyek.': 'Your donation directly supports the Mendelem community. Funds are used transparently for project development.',
  'Konfirmasi Transfer': 'Transfer Confirmation',
  'Hubungi Kami': 'Contact Us',
  'Isi formulir di bawah dan kami akan merespons sesegera mungkin.': 'Fill in the form below and we will respond as soon as possible.',

  // FORM LABELS
  'Nama Lengkap': 'Full Name',
  'Nama Lengkap *': 'Full Name *',
  'Nama': 'Name',
  'Email *': 'Email *',
  'No. WhatsApp': 'WhatsApp Number',
  'Tujuan': 'Purpose',
  'Pilih tujuan': 'Select purpose',
  'Pembelian Produk': 'Product Purchase',
  'Pertanyaan Umum': 'General Inquiry',
  'Pesan *': 'Message *',
  'Jelaskan maksud Anda...': 'Explain your intention...',
  'Kirim Pesan': 'Send Message',

  // BUTTONS & LINKS
  'Semua Artikel': 'All Articles',
  'Selengkapnya': 'Read More',
  'Lihat Semua Produk': 'View All Products',
  'Lihat Detail': 'View Detail',
  'Lihat & Pesan': 'View & Order',
  'Baca Selengkapnya': 'Read More',
  'Kembali ke Produk': 'Back to Products',
  'Pesan Sekarang': 'Order Now',
  'Kirim Pesan / Pesan Sekarang': 'Send Message / Order Now',
  'Chat WhatsApp': 'WhatsApp Chat',
  'Kirim Pesan / Pemesanan': 'Send Message / Order',
  'Hubungi untuk Kolaborasi': 'Contact for Collaboration',

  // PRODUCT DETAIL
  'Informasi Produk': 'Product Information',
  'Kategori': 'Category',
  'Ketersediaan': 'Availability',
  'Harga': 'Price',
  'Satuan': 'Unit',
  'Harga dapat berubah sewaktu-waktu. Hubungi kami untuk konfirmasi harga terkini.': 'Prices may change at any time. Contact us to confirm the latest price.',
  'Produk Lainnya': 'Other Products',
  'Jumlah yang Diinginkan': 'Desired Quantity',
  'Pesan / Pertanyaan *': 'Message / Question *',
  'Tulis pesan atau pertanyaan Anda di sini...': 'Write your message or question here...',
  'Tersedia Sekarang': 'Available Now',

  // FOOTER
  'Navigasi': 'Navigation',
  'Proyek': 'Projects',
  'Produk': 'Products',
  'Tentang Kami': 'About Us',
  'Kontak': 'Contact',
  'Hak cipta dilindungi.': 'All rights reserved.',

  // EMPTY STATES
  'Belum ada proyek.': 'No projects yet.',
  'Belum ada proyek. Tambahkan di Admin Panel.': 'No projects yet. Add in Admin Panel.',
  'Belum ada produk.': 'No products yet.',
  'Belum ada artikel.': 'No articles yet.',
  'Belum ada foto atau video. Upload di Admin Panel.': 'No photos or videos yet. Upload in Admin Panel.',
  'Belum ada anggota tim.': 'No team members yet.',
  'Belum ada data pembiayaan.': 'No financing data yet.',
  'Belum ada data sumber dana.': 'No funding source data yet.',

  // KURBAN
  'Segera Hadir': 'Coming Soon',
  'Daftar hewan kurban akan segera tersedia. Hubungi kami untuk informasi lebih lanjut.': 'The list of qurban animals will be available soon. Contact us for more information.',
  'Ingin Memesan atau Ada Pertanyaan?': 'Want to Order or Have Questions?',
  'Tim kami siap membantu Anda memilih hewan kurban terbaik.': 'Our team is ready to help you choose the best qurban animal.',
  'Chat WhatsApp Sekarang': 'Chat WhatsApp Now',
  'Spesifikasi': 'Specifications',
  'Jenis Hewan': 'Animal Type',
  'Kelamin': 'Gender',
  'Ras / Jenis': 'Breed / Type',
  'Berat': 'Weight',
  'Umur': 'Age',
  'Catatan': 'Notes',
  'Hubungi via WhatsApp': 'Contact via WhatsApp',
  'Sedang Dipesan': 'Currently Reserved',
  'Sudah Terjual': 'Already Sold',
  'Lainnya': 'Others',
  'Lihat Semua Hewan Kurban': 'View All Qurban Animals',
  'Pemesanan': 'Order',
  'Formulir Pemesanan': 'Order Form',
  'Isi formulir di bawah, kami akan menghubungi Anda segera untuk konfirmasi.': 'Fill in the form below, we will contact you soon for confirmation.',
  'Pesan terkirim! Kami akan segera menghubungi Anda via WhatsApp atau Email.': 'Message sent! We will contact you soon via WhatsApp or Email.',
  'Pesan terkirim! Kami akan segera menghubungi Anda.': 'Message sent! We will contact you soon.',
};

// Reverse map for EN->ID
const translationsReverse = Object.fromEntries(
  Object.entries(translations).map(([id, en]) => [en, id])
);

function toggleLang() {
  currentLang = currentLang === 'id' ? 'en' : 'id';
  document.getElementById('langLabel').textContent = currentLang === 'id' ? 'EN' : 'ID';

  // 1. Handle elements with data-en / data-id attributes
  document.querySelectorAll('[data-en][data-id]').forEach(el => {
    const val = currentLang === 'en' ? el.getAttribute('data-en') : el.getAttribute('data-id');
    if (val) el.textContent = val;
  });

  // 2. Handle all other text nodes via dictionary
  const dict = currentLang === 'en' ? translations : translationsReverse;
  translateTextNodes(document.body, dict);
}

function translateTextNodes(root, dict) {
  // Walk all text nodes and translate via dictionary
  const walker = document.createTreeWalker(
    root,
    NodeFilter.SHOW_TEXT,
    {
      acceptNode(node) {
        // Skip script, style, input values
        const parent = node.parentElement;
        if (!parent) return NodeFilter.FILTER_REJECT;
        const tag = parent.tagName.toLowerCase();
        if (['script','style','input','textarea','select'].includes(tag)) return NodeFilter.FILTER_REJECT;
        // Skip nodes inside elements that already have data-en/data-id (handled above)
        if (parent.hasAttribute('data-en') || parent.hasAttribute('data-id')) return NodeFilter.FILTER_REJECT;
        return NodeFilter.FILTER_ACCEPT;
      }
    }
  );

  const nodesToTranslate = [];
  while (walker.nextNode()) {
    nodesToTranslate.push(walker.currentNode);
  }

  nodesToTranslate.forEach(node => {
    const trimmed = node.textContent.trim();
    if (trimmed && dict[trimmed]) {
      node.textContent = node.textContent.replace(trimmed, dict[trimmed]);
    }
  });
}

// THEME
function toggleTheme() {
  currentTheme = currentTheme === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme);
  document.getElementById('themeIcon').className = currentTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
  localStorage.setItem('theme', currentTheme);
}
(function() {
  const t = localStorage.getItem('theme');
  if (t) { currentTheme = t; document.documentElement.setAttribute('data-theme', t); if (t === 'dark') { const i = document.getElementById('themeIcon'); if (i) i.className = 'fas fa-sun'; } }
})();

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
function startSlider() { clearInterval(slideInterval); slideInterval = setInterval(nextSlide, 5500); }
startSlider();

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
  document.body.style.overflow = 'hidden';
  if (type === 'video') {
    vid.src = src; vid.style.display = 'block'; img.style.display = 'none';
  } else {
    img.src = src; img.style.display = 'block'; vid.style.display = 'none';
    if (vid.pause) { vid.pause(); vid.src = ''; }
  }
}
function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
  document.body.style.overflow = '';
  const vid = document.getElementById('lightbox-vid');
  if (vid && vid.pause) { vid.pause(); vid.src = ''; }
}
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeLightbox();
  if (e.key === 'ArrowRight') nextSlide();
  if (e.key === 'ArrowLeft') prevSlide();
});

// TOUCH SWIPE on slider
let touchStartX = 0;
document.querySelector('.hero-slider')?.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; });
document.querySelector('.hero-slider')?.addEventListener('touchend', e => {
  const diff = touchStartX - e.changedTouches[0].clientX;
  if (Math.abs(diff) > 50) diff > 0 ? nextSlide() : prevSlide();
});
</script>
</body>
</html>
