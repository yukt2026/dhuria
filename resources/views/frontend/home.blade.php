@extends('layouts.frontend')

@section('content')
@php
    $bestSellers = $bestSellers ?? \App\Models\Product::where('is_active', true)->where('is_bestseller', true)->take(8)->get();
    if ($bestSellers->isEmpty()) { $bestSellers = \App\Models\Product::where('is_active', true)->take(8)->get(); }
    $featuredProducts = $featuredProducts ?? \App\Models\Product::where('is_active', true)->where('is_featured', true)->take(8)->get();
    if ($featuredProducts->isEmpty()) { $featuredProducts = \App\Models\Product::where('is_active', true)->take(8)->get(); }
    $testimonials = $testimonials ?? \App\Models\Testimonial::where('is_active', true)->get();
    $categories = $categories ?? \App\Models\Category::where('is_active', true)->get();
@endphp

<style>
/* ===================================================
   DHURIA LUXURY AYURVEDIC THEME
   =================================================== */
:root {
    --dh-navy: #061528;
    --dh-navy-main: #081a30;
    --dh-navy-light: #0d2544;
    --dh-gold: #d4af37;
    --dh-gold-dark: #b89326;
    --dh-gold-light: #fef08a;
    --dh-amber: #f59e0b;
    --dh-orange: #ff7a00;
    --dh-orange-dark: #ea580c;
    --dh-green: #2d7a22;
    --dh-text-dark: #0f172a;
    --dh-text-muted: #64748b;
    --dh-card-border: #e2e8f0;
}

/* 1. HERO SLIDER SECTION */
.dh-hero-slider-wrap {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #081a30;
}
.dh-hero-slider .owl-stage-outer {
    overflow: hidden;
}
.dh-hero-slider .owl-nav button.owl-prev,
.dh-hero-slider .owl-nav button.owl-next {
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 44px !important;
    height: 44px !important;
    background: rgba(6, 21, 40, 0.65) !important;
    color: #ffffff !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 1px solid rgba(212, 175, 55, 0.4) !important;
    z-index: 50 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    font-size: 1.2rem !important;
}
.dh-hero-slider .owl-nav button.owl-prev { left: 20px !important; }
.dh-hero-slider .owl-nav button.owl-next { right: 20px !important; }
.dh-hero-slider .owl-nav button.owl-prev:hover,
.dh-hero-slider .owl-nav button.owl-next:hover {
    background: var(--dh-gold) !important;
    color: var(--dh-navy) !important;
    border-color: #ffffff !important;
    transform: translateY(-50%) scale(1.1) !important;
}

/* Custom Dots [ — • • • • ] exactly matching screenshot */
.dh-hero-slider .owl-dots {
    position: absolute !important;
    bottom: 22px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    z-index: 50 !important;
    margin: 0 !important;
}
.dh-hero-slider .owl-dot {
    background: none !important;
    border: none !important;
    padding: 0 !important;
    outline: none !important;
}
.dh-hero-slider .owl-dot span {
    width: 7px !important;
    height: 7px !important;
    background: rgba(255, 255, 255, 0.45) !important;
    border-radius: 50% !important;
    display: block !important;
    transition: all 0.3s ease !important;
    margin: 0 !important;
}
.dh-hero-slider .owl-dot.active span {
    width: 28px !important;
    height: 7px !important;
    border-radius: 4px !important;
    background: #ffffff !important;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.9) !important;
}

/* SLIDE 1: LIVER DETOX (EXACT MATCH TO USER REFERENCE IMAGE 2) */
.dh-slide-liver {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    min-height: 520px;
    background: radial-gradient(circle at 70% 50%, #f97316 0%, #ea580c 45%, #c2410c 100%);
    color: #ffffff;
    position: relative;
    overflow: hidden;
    padding: 50px 60px;
    align-items: center;
}
.dh-slide-liver::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('/images/enriched_nature_banner.jpg') center/cover no-repeat;
    opacity: 0.12;
    pointer-events: none;
}
.dh-slide-liver-content {
    position: relative;
    z-index: 2;
    max-width: 620px;
}
.dh-slide-brand-tag {
    font-family: 'Cinzel', serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #fef08a;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}
.dh-slide-brand-tag img {
    height: 32px !important;
    width: auto !important;
    display: inline-block !important;
}
.dh-slide-liver-title {
    font-family: 'Outfit', sans-serif;
    font-size: 3.4rem;
    font-weight: 900;
    line-height: 1.1;
    color: #ffffff;
    margin: 0 0 15px 0;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.dh-slide-liver-sub {
    font-size: 1.15rem;
    color: #ffedd5;
    line-height: 1.5;
    margin-bottom: 28px;
    max-width: 520px;
}
.dh-slide-actions {
    display: flex;
    align-items: center;
    gap: 25px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}
.dh-btn-order-now {
    background: #ffffff;
    color: #c2410c !important;
    font-size: 1.15rem;
    font-weight: 900;
    padding: 14px 42px;
    border-radius: 50px;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.dh-btn-order-now:hover {
    background: #fff7ed;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
}
.dh-slide-trust-row {
    display: flex;
    align-items: center;
    gap: 20px;
}
.dh-google-pill {
    background: rgba(255, 255, 255, 0.95);
    color: #1e293b;
    border-radius: 12px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
.dh-google-icon {
    font-weight: 900;
    font-size: 1.35rem;
    color: #ea4335;
}
.dh-google-score {
    font-size: 1.05rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
}
.dh-google-stars {
    color: #f59e0b;
    font-size: 0.82rem;
}
.dh-google-sub {
    font-size: 0.72rem;
    color: #64748b;
    display: block;
}
.dh-slide-liver-img-wrap {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: center;
    align-items: center;
}
.dh-slide-liver-img-wrap img {
    max-width: 90%;
    max-height: 440px;
    object-fit: contain;
    filter: drop-shadow(0 20px 35px rgba(0, 0, 0, 0.35));
    transition: transform 0.4s ease;
}
.dh-slide-liver:hover .dh-slide-liver-img-wrap img {
    transform: scale(1.04);
}

/* SLIDE 2: PILECUREX KIT */
.dh-slide-pilecurex {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    min-height: 520px;
    background: #e9e4d9;
    position: relative;
    overflow: hidden;
}
.dh-pilecurex-left {
    position: relative;
    background: url('/images/floramade_slider_pilecurex.jpg') left center / cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 480px;
}
.dh-pilecurex-right {
    background: linear-gradient(135deg, #2d7a22 0%, #205c18 100%);
    color: #ffffff;
    padding: 60px 50px 60px 45px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    z-index: 2;
}
.dh-pilecurex-title {
    font-family: 'Outfit', sans-serif;
    font-size: 3.4rem;
    font-weight: 900;
    line-height: 1.05;
    color: #ffffff;
    margin: 0 0 16px 0;
    text-transform: uppercase;
}
.dh-pilecurex-desc {
    font-size: 1.25rem;
    font-weight: 500;
    color: #f1f5f9;
    line-height: 1.45;
    margin-bottom: 28px;
    max-width: 480px;
}

/* SLIDE 3: DIABETES PRO MADHUCUREX */
.dh-slide-diabetes {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    min-height: 520px;
    background: radial-gradient(circle at 75% 40%, #15325b 0%, #081a30 70%, #040e1a 100%);
    color: #ffffff;
    padding: 50px 60px;
    align-items: center;
    gap: 40px;
    position: relative;
    overflow: hidden;
}

/* ========================================================
   2. CONTINUOUS ROTATING MARQUEE TICKER (MARKED IN RED)
   ======================================================== */
.dh-rotating-marquee-container {
    width: 100%;
    overflow: hidden;
    background: #061528;
    border-top: 1px solid rgba(212, 175, 55, 0.3);
    border-bottom: 1px solid rgba(212, 175, 55, 0.3);
    padding: 14px 0;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    user-select: none;
}
.dh-marquee-inner {
    display: flex;
    width: max-content;
    animation: dhRotateTicker 22s linear infinite;
    will-change: transform;
}
.dh-rotating-marquee-container:hover .dh-marquee-inner {
    animation-play-state: paused;
}
@keyframes dhRotateTicker {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.dh-marquee-set {
    display: flex;
    align-items: center;
    gap: 45px;
    padding-right: 45px;
}
.dh-marquee-item {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #f1f5f9;
    font-size: 0.88rem;
    font-weight: 700;
    letter-spacing: 0.6px;
    white-space: nowrap;
    text-transform: capitalize;
}
.dh-marquee-item i {
    color: var(--dh-gold);
    font-size: 1.15rem;
}

/* 3. SECTION HEADINGS */
.dh-section-header {
    text-align: center;
    margin-top: 55px;
    margin-bottom: 35px;
}
.dh-section-kicker {
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--dh-gold-dark);
    margin-bottom: 8px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.dh-section-kicker::before,
.dh-section-kicker::after {
    content: '';
    display: inline-block;
    width: 28px;
    height: 1.5px;
    background: var(--dh-gold);
}
.dh-section-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--dh-navy);
    font-family: 'Cinzel', serif;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.dh-section-subtitle {
    font-size: 0.95rem;
    color: var(--dh-text-muted);
    margin: 0 auto;
    max-width: 650px;
}

/* 4. PRODUCT CARDS (Exact match to Image 2 - media_1795458482219_cea0b7fa.png) */
.dh-product-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    padding: 0;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    height: 100%;
    overflow: hidden;
    cursor: pointer;
}
.dh-product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(8, 26, 48, 0.1);
    border-color: #cbd5e1;
}
.dh-card-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #0f172a;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    padding: 3px 9px;
    border-radius: 6px;
    text-transform: capitalize;
    z-index: 10;
}
.dh-card-wishlist {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    cursor: pointer;
    color: #64748b;
    z-index: 10;
    transition: transform 0.2s, color 0.2s;
}
.dh-card-wishlist:hover {
    transform: scale(1.1);
    color: #ef4444;
}
.dh-card-img-box {
    width: 100%;
    height: 220px;
    overflow: hidden;
    position: relative;
    background: #f8fafc;
    border-radius: 20px 20px 0 0;
    padding: 0;
    margin: 0;
}
.dh-card-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.35s ease;
}
.dh-product-card:hover .dh-card-img-box img {
    transform: scale(1.05);
}
.dh-card-body {
    padding: 16px 16px 20px 16px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    flex-grow: 1;
}
.dh-card-title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
    line-height: 1.35;
    text-decoration: none !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 38px;
}
.dh-card-title:hover {
    color: #d4953a;
}
.dh-card-rating {
    font-size: 12px;
    color: #f59e0b;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.dh-card-rating .dh-rating-num {
    font-weight: 800;
    color: #0f172a;
    font-size: 11px;
    margin-left: 2px;
}
.dh-card-rating .dh-reviews-cnt {
    color: #94a3b8;
    font-size: 11px;
}
.dh-card-price-row {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 8px;
    margin-bottom: 12px;
}
.dh-card-price-current {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
}
.dh-card-price-old {
    font-size: 13px;
    color: #94a3b8;
    text-decoration: line-through;
}
.dh-btn-card-add {
    width: 100%;
    background: #d4953a;
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 11px 16px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background 0.2s ease;
    margin-top: auto;
}
.dh-btn-card-add:hover {
    background: #c27d1a;
    color: #ffffff;
}

/* 5. CALLOUT BANNER */
.dh-nature-banner {
    background: #0f233a;
    position: relative;
    padding: 40px 20px;
    margin: 50px 0;
    text-align: center;
    border-top: 3px solid var(--dh-gold);
    border-bottom: 3px solid var(--dh-gold);
    overflow: hidden;
}
.dh-nature-script {
    font-family: 'Brush Script MT', 'Great Vibes', cursive, serif;
    font-size: 3.2rem;
    color: #fef08a;
    margin: 0 0 8px 0;
    letter-spacing: 1px;
}

/* 6. DOCTOR ENDORSEMENT */
.dh-doctor-section {
    max-width: 1100px;
    margin: 40px auto 50px;
    padding: 0 20px;
}
.dh-doctor-card {
    background: linear-gradient(135deg, #0a223f 0%, #051323 100%);
    border-radius: 24px;
    border: 1px solid rgba(212, 175, 55, 0.35);
    box-shadow: 0 15px 35px rgba(8, 26, 48, 0.2);
    padding: 30px 40px;
    display: grid;
    grid-template-columns: 200px 1fr;
    align-items: center;
    gap: 35px;
}
.dh-doctor-avatar-wrap {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    border: 4px solid var(--dh-gold);
    overflow: hidden;
    background: #ffffff;
}
.dh-doctor-avatar-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.dh-doctor-headline {
    font-size: 1.6rem;
    font-weight: 800;
    color: #ffffff;
    font-family: 'Cinzel', serif;
    margin: 0 0 8px 0;
}

/* 7. SPOTLIGHT DEEP DIVE BOX MATCHING IMAGE 3 */
.dh-spotlight-section {
    max-width: 1180px;
    margin: 60px auto;
    padding: 0 20px;
}
.dh-spotlight-layout {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 45px;
    align-items: center;
}
.dh-spotlight-media {
    width: 100%;
}
.dh-spotlight-main-card {
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 24px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 16px;
    border: 1px solid rgba(0, 0, 0, 0.06);
}
.dh-spotlight-card-amber {
    background: radial-gradient(circle at 50% 50%, #f7d686 0%, #d89e3a 100%);
}
.dh-spotlight-card-cyan {
    background: radial-gradient(circle at 50% 50%, #b8e2f2 0%, #6fb6d4 100%);
}
.dh-spotlight-main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.3s ease, opacity 0.2s ease;
}
.dh-spotlight-main-card:hover .dh-spotlight-main-img {
    transform: scale(1.03);
}
.dh-spotlight-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    color: #475569;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.2s;
    z-index: 10;
}
.dh-spotlight-arrow:hover {
    background: #ffffff;
    color: var(--dh-navy);
    transform: translateY(-50%) scale(1.08);
}
.dh-sp-arrow-left { left: 12px; }
.dh-sp-arrow-right { right: 12px; }

.dh-spotlight-thumbs {
    display: flex;
    gap: 12px;
    justify-content: center;
}
.dh-thumb-item {
    width: 65px;
    height: 65px;
    background: #ffffff;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 3px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.2s;
}
.dh-thumb-item.active {
    border-color: #d97706;
    box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25);
}
.dh-thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

/* Right Details */
.dh-sp-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ecfdf5;
    color: #047857;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 4px 14px;
    border-radius: 20px;
    letter-spacing: 0.6px;
    margin-bottom: 10px;
    border: 1px solid #a7f3d0;
    text-transform: uppercase;
}
.dh-sp-title {
    font-size: 1.85rem;
    font-weight: 900;
    color: var(--dh-navy);
    margin: 0 0 10px 0;
    line-height: 1.25;
}
.dh-sp-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 0.85rem;
    color: #64748b;
}
.dh-sp-stars {
    color: #f59e0b;
    letter-spacing: 1px;
}

.dh-sp-price-box {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 14px 18px;
    background: #f8fafc;
    margin-bottom: 18px;
}
.dh-sp-price-row {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 4px;
}
.dh-sp-price-cur {
    font-size: 1.9rem;
    font-weight: 900;
    color: var(--dh-navy);
}
.dh-sp-price-old {
    font-size: 1.05rem;
    color: #94a3b8;
    text-decoration: line-through;
}
.dh-sp-price-save {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 5px;
    text-transform: uppercase;
}
.dh-sp-stock {
    font-size: 0.78rem;
    color: #047857;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
}

.dh-sp-action-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.dh-sp-stepper {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    overflow: hidden;
    height: 46px;
    background: #ffffff;
}
.dh-sp-step-btn {
    width: 38px;
    height: 100%;
    background: #f8fafc;
    border: none;
    font-weight: 800;
    font-size: 1.1rem;
    cursor: pointer;
    color: #1e293b;
    display: flex;
    align-items: center;
    justify-content: center;
}
.dh-sp-step-input {
    width: 38px;
    height: 100%;
    text-align: center;
    border: none;
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--dh-navy);
    outline: none;
}
.dh-sp-btn-bag {
    flex: 1;
    background: var(--dh-navy);
    color: #ffffff;
    border: none;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 0.82rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s;
}
.dh-sp-btn-bag:hover {
    background: #0d2544;
}
.dh-sp-btn-buy {
    width: 100%;
    background: #c8923a;
    color: #ffffff !important;
    border: none;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 0.82rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s;
    margin-bottom: 18px;
    text-decoration: none !important;
}
.dh-sp-btn-buy:hover {
    background: #b07d2c;
}

.dh-sp-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.78rem;
    color: #64748b;
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
    flex-wrap: wrap;
    gap: 12px;
}
.dh-sp-socials {
    display: flex;
    align-items: center;
    gap: 8px;
}
.dh-sp-socials a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s;
}
.dh-sp-socials a:hover {
    color: var(--dh-navy);
}
.dh-sp-pincode {
    display: flex;
    align-items: center;
    gap: 6px;
}
.dh-sp-pincode input {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 5px 8px;
    font-size: 0.75rem;
    width: 110px;
    outline: none;
}
.dh-sp-pincode button {
    background: var(--dh-navy);
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 5px 10px;
    font-size: 0.72rem;
    font-weight: 700;
    cursor: pointer;
}

/* Owl Carousel Custom Controls Matching Image 3 */
.owl-carousel {
    position: relative;
}
.owl-carousel .owl-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex !important;
    justify-content: space-between !important;
    pointer-events: none;
    z-index: 25;
}
.owl-carousel .owl-nav button.owl-prev,
.owl-carousel .owl-nav button.owl-next {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    color: #0f172a !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    pointer-events: auto !important;
    transition: all 0.2s ease !important;
    font-size: 16px !important;
    line-height: 1 !important;
}
.owl-carousel .owl-nav button.owl-prev {
    margin-left: -20px !important;
}
.owl-carousel .owl-nav button.owl-next {
    margin-right: -20px !important;
}
.owl-carousel .owl-nav button:hover {
    background: #081a30 !important;
    color: #ffffff !important;
    border-color: #081a30 !important;
    transform: scale(1.08) !important;
}
.owl-carousel .owl-dots {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 6px !important;
    margin-top: 24px !important;
    margin-bottom: 10px !important;
}
.owl-carousel .owl-dots .owl-dot span {
    width: 8px !important;
    height: 8px !important;
    background: #cbd5e1 !important;
    border-radius: 50% !important;
    display: block !important;
    transition: all 0.25s ease !important;
    margin: 0 !important;
}
.owl-carousel .owl-dots .owl-dot.active span {
    width: 26px !important;
    border-radius: 6px !important;
    background: #081a30 !important;
}

/* Mobile Breakpoints */
@media (max-width: 900px) {
    .dh-spotlight-layout {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .dh-spotlight-main-card {
        max-width: 420px;
        margin-left: auto;
        margin-right: auto;
    }
    .owl-carousel .owl-nav button.owl-prev {
        margin-left: -8px !important;
    }
    .owl-carousel .owl-nav button.owl-next {
        margin-right: -8px !important;
    }
}

/* 8. WHY CHOOSE SECTION */
.dh-why-section {
    max-width: 1250px;
    margin: 40px auto 60px;
    padding: 0 20px;
}
.dh-why-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.dh-why-card {
    position: relative;
    height: 170px;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    background: #081a30;
    transition: transform 0.3s ease;
}
.dh-why-card:hover {
    transform: translateY(-4px);
}
.dh-why-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.45;
    transition: transform 0.4s ease;
}
.dh-why-card:hover img {
    transform: scale(1.08);
}
.dh-why-card-content {
    position: absolute;
    inset: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    z-index: 2;
    background: linear-gradient(to top, rgba(8, 26, 48, 0.95) 0%, rgba(8, 26, 48, 0.3) 100%);
}
.dh-why-card-num {
    font-size: 0.75rem;
    font-weight: 800;
    color: var(--dh-gold);
    letter-spacing: 1px;
    margin-bottom: 4px;
}
.dh-why-card-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 4px 0;
}
.dh-why-card-desc {
    font-size: 0.8rem;
    color: #cbd5e1;
    margin: 0;
    line-height: 1.35;
}

/* Section 3: Dual Mobile Grid & Desktop Carousel */
.dh-daily-mobile-view {
    display: none;
}
.dh-daily-desktop-view {
    display: block;
}
.dh-btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 2px solid var(--dh-navy);
    color: var(--dh-navy);
    padding: 10px 26px;
    border-radius: 30px;
    font-size: 0.78rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    text-decoration: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(8, 26, 48, 0.06);
}
.dh-btn-view-all:hover {
    background: var(--dh-navy);
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(8, 26, 48, 0.15);
}

/* Section 6: Doctor Endorsement Banner (Large & Fully Responsive) */
.dh-doctor-endorsement-section {
    max-width: 1200px;
    margin: 55px auto 45px;
    padding: 0 20px;
    width: 100%;
}
.dh-doctor-banner-wrap {
    width: 100%;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(8, 26, 48, 0.12);
    border: 1px solid rgba(8, 26, 48, 0.08);
    background: #ffffff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
}
.dh-doctor-banner-wrap:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 45px rgba(8, 26, 48, 0.16);
}
.dh-doctor-banner-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    border-radius: 24px;
}

@media (max-width: 768px) {
    .dh-doctor-endorsement-section {
        margin: 35px auto 25px;
        padding: 0 14px;
    }
    .dh-doctor-banner-wrap {
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(8, 26, 48, 0.1);
    }
    .dh-doctor-banner-img {
        border-radius: 16px;
    }
}

/* Section 7: Benefits 4-Card Grid */
.dh-benefits-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.dh-benefit-card {
    background: #f0f7ff;
    border: 1px solid #dbeafe;
    border-radius: 16px;
    padding: 24px 18px;
    text-align: center;
    transition: all 0.25s ease;
}
.dh-benefit-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(2, 132, 199, 0.08);
}
.dh-benefit-icon {
    width: 50px;
    height: 50px;
    background: #ffffff;
    border-radius: 50%;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    color: #0284c7;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
}

@media (max-width: 992px) {
    .dh-slide-liver, .dh-slide-pilecurex, .dh-slide-diabetes {
        grid-template-columns: 1fr;
        padding: 0 !important;
        text-align: center;
    }
    .dh-pilecurex-left {
        width: 100%;
        min-height: 280px;
        aspect-ratio: 4/3;
        background-position: center;
        background-size: cover;
    }
    .dh-pilecurex-right {
        padding: 30px 20px 38px;
        text-align: center;
        align-items: center;
    }
    .dh-slide-liver-img-wrap, .dh-slide-diabetes .dh-slide-liver-img-wrap {
        order: 1;
        padding: 24px 20px 0;
        min-height: 250px;
    }
    .dh-slide-liver-content, .dh-slide-diabetes .dh-slide-liver-content {
        order: 2;
        padding: 20px 20px 35px;
        text-align: center;
    }
    .dh-slide-actions { justify-content: center; }
    .dh-slide-trust-row { justify-content: center; }
    .dh-doctor-card { grid-template-columns: 1fr; text-align: center; }
    .dh-doctor-avatar-wrap { margin: 0 auto; }
    .dh-benefits-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .dh-why-grid { grid-template-columns: repeat(2, 1fr); }
    .dh-spotlight-box { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    /* Section 3: Switch to 2-Column Mobile Grid */
    .dh-daily-mobile-view {
        display: block;
    }
    .dh-daily-desktop-view {
        display: none;
    }
    .dh-daily-grid-2col {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    /* Benefits: 2x2 Grid on Mobile */
    .dh-benefits-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .dh-benefit-card {
        padding: 16px 10px;
        border-radius: 14px;
    }
    .dh-benefit-icon {
        width: 40px;
        height: 40px;
        font-size: 1.15rem;
        margin-bottom: 8px;
    }
    .dh-benefit-card h4 {
        font-size: 0.85rem !important;
        margin-bottom: 4px !important;
    }
    .dh-benefit-card p {
        font-size: 0.72rem !important;
        line-height: 1.35 !important;
    }

    .dh-spotlight-section {
        margin: 30px auto;
        padding: 0 14px;
    }
    .dh-spotlight-layout {
        grid-template-columns: 1fr;
        gap: 22px;
    }
    .dh-spotlight-main-card {
        max-width: 360px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 20px;
    }
    .dh-sp-title {
        font-size: 1.5rem;
    }
    .dh-sp-price-current {
        font-size: 1.8rem;
    }
    .dh-sp-actions-row {
        gap: 10px;
    }
    .dh-sp-meta-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .dh-sp-pincode {
        width: 100%;
    }
    .dh-sp-pincode input {
        flex: 1;
    }
    .owl-carousel .owl-nav button.owl-prev {
        margin-left: -5px !important;
    }
    .owl-carousel .owl-nav button.owl-next {
        margin-right: -5px !important;
    }
}

@media (max-width: 600px) {
    .dh-slide-liver-title, .dh-pilecurex-title { font-size: 1.95rem; }
    .dh-why-grid { grid-template-columns: 1fr; gap: 14px; }
    .dh-why-card { min-height: 145px !important; padding: 18px 20px !important; }
    .dh-btn-order-now { width: 100%; justify-content: center; }
    .dh-marquee-set { gap: 25px; }
    .dh-marquee-item { font-size: 0.76rem; }
    .dh-sp-thumb { width: 52px; height: 52px; }
    .dh-nature-banner { padding: 45px 15px; }
    .dh-nature-script { font-size: 1.8rem; }
}
</style>

<!-- ========================================================
     1. BANNER SECTION SLIDER (100% DATABASE DYNAMIC)
     ======================================================== -->
<section class="dh-hero-slider-wrap">
    <div class="owl-carousel dh-hero-slider owl-theme">
        @if(isset($banners) && $banners->where('type', 'hero')->count() > 0)
            @foreach($banners->where('type', 'hero') as $index => $banner)
                @php
                    $isPilecurex = str_contains(strtolower($banner->title), 'pilecurex');
                    $isDiabetes = str_contains(strtolower($banner->title), 'diabetes') || str_contains(strtolower($banner->title), 'madhucurex');
                @endphp
                @if($isPilecurex)
                    <!-- SLIDE: PILECUREX KIT (DYNAMIC FROM DB) -->
                    <div class="dh-slide-pilecurex">
                        <div class="dh-pilecurex-left" style="background-image: url('{{ $banner->image_url }}');"></div>
                        <div class="dh-pilecurex-right">
                            <h2 class="dh-pilecurex-title">{{ $banner->title }}</h2>
                            <p class="dh-pilecurex-desc">{{ $banner->subtitle }}</p>

                            <a href="{{ $banner->link ?: route('product.show', 'pilecurex-kit') }}" class="dh-btn-order-now" style="background:linear-gradient(135deg, #ff7a00 0%, #ea580c 100%); color:#fff !important; width:fit-content; margin-bottom:25px;">
                                <span>ORDER NOW</span>
                            </a>

                            <div class="dh-slide-trust-row">
                                <div class="dh-google-pill">
                                    <span class="dh-google-icon">G</span>
                                    <div>
                                        <div class="dh-google-score">4.9 <span class="dh-google-stars">★★★★★</span></div>
                                        <span class="dh-google-sub">21,773+ reviews &bull; Many Happy Reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($isDiabetes)
                    <!-- SLIDE: DIABETES PRO MADHUCUREX (DYNAMIC FROM DB) -->
                    <div class="dh-slide-diabetes">
                        <div class="dh-slide-liver-content">
                            <div class="dh-slide-brand-tag">
                                <span style="background:rgba(212,175,55,0.2); border:1px solid var(--dh-gold); padding:4px 14px; border-radius:20px; font-size:0.75rem; text-transform:uppercase;">आओ आयुर्वेद अपनाएं</span>
                            </div>
                            <h2 style="font-family:'Cinzel',serif; font-size:2.8rem; font-weight:900; color:#ffffff; margin:0 0 10px 0;">{{ $banner->title }}</h2>
                            <h3 style="font-size:1.6rem; color:#fde68a; margin-bottom:15px; font-weight:700;">शुगर और संपूर्ण स्वास्थ्य संतुलन बनाए रखे</h3>
                            <p class="dh-slide-liver-sub">{{ $banner->subtitle }}</p>

                            <a href="{{ $banner->link ?: route('product.show', 'diabetes-pro-madhucurex-powder') }}" class="dh-btn-order-now" style="background:linear-gradient(135deg, #d4af37 0%, #b89326 100%); color:#061528 !important; width:fit-content;">
                                <span>BUY NOW</span> <i class="bi bi-cart3"></i>
                            </a>
                        </div>

                        <div class="dh-slide-liver-img-wrap">
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                        </div>
                    </div>
                @else
                    <!-- SLIDE: GENERAL AYURVEDIC / LIVER DETOX (DYNAMIC FROM DB) -->
                    <div class="dh-slide-liver">
                        <div class="dh-slide-liver-content">
                            <div class="dh-slide-brand-tag">
                                <img src="{{ asset('images/dhuria_logo_white.png') }}" alt="dhuria">
                            </div>
                            <h1 class="dh-slide-liver-title">{{ $banner->title }}</h1>
                            <p class="dh-slide-liver-sub">{{ $banner->subtitle }}</p>

                            <div class="dh-slide-actions">
                                <a href="{{ $banner->link ?: route('shop') }}" class="dh-btn-order-now">
                                    <span>Order Now</span> <i class="bi bi-cart3"></i>
                                </a>
                            </div>

                            <div class="dh-slide-trust-row">
                                <div class="dh-google-pill">
                                    <span class="dh-google-icon">G</span>
                                    <div>
                                        <div class="dh-google-score">4.9 <span class="dh-google-stars">★★★★★</span></div>
                                        <span class="dh-google-sub">Trusted by 50,000+ Customers</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dh-slide-liver-img-wrap">
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</section>

<!-- ========================================================
     2. CONTINUOUS ROTATING MARQUEE TICKER (MARKED IN RED)
     ======================================================== -->
<div class="dh-rotating-marquee-container">
    <div class="dh-marquee-inner">
        <!-- FIRST SET -->
        <div class="dh-marquee-set">
            <div class="dh-marquee-item"><i class="bi bi-flower1"></i> 100% Ayurvedic</div>
            <div class="dh-marquee-item"><i class="bi bi-award-fill"></i> Certified &amp; Trusted</div>
            <div class="dh-marquee-item"><i class="bi bi-shield-lock-fill"></i> Safe Payment</div>
            <div class="dh-marquee-item"><i class="bi bi-headset"></i> Online Support</div>
            <div class="dh-marquee-item"><i class="bi bi-truck"></i> Free Express Shipping</div>
            <div class="dh-marquee-item"><i class="bi bi-patch-check-fill"></i> Lab Tested &amp; Pure</div>
            <div class="dh-marquee-item"><i class="bi bi-flower1"></i> 100% Ayurvedic</div>
            <div class="dh-marquee-item"><i class="bi bi-award-fill"></i> Certified &amp; Trusted</div>
        </div>

        <!-- SECOND DUPLICATE SET (SEAMLESS ROTATION) -->
        <div class="dh-marquee-set">
            <div class="dh-marquee-item"><i class="bi bi-flower1"></i> 100% Ayurvedic</div>
            <div class="dh-marquee-item"><i class="bi bi-award-fill"></i> Certified &amp; Trusted</div>
            <div class="dh-marquee-item"><i class="bi bi-shield-lock-fill"></i> Safe Payment</div>
            <div class="dh-marquee-item"><i class="bi bi-headset"></i> Online Support</div>
            <div class="dh-marquee-item"><i class="bi bi-truck"></i> Free Express Shipping</div>
            <div class="dh-marquee-item"><i class="bi bi-patch-check-fill"></i> Lab Tested &amp; Pure</div>
            <div class="dh-marquee-item"><i class="bi bi-flower1"></i> 100% Ayurvedic</div>
            <div class="dh-marquee-item"><i class="bi bi-award-fill"></i> Certified &amp; Trusted</div>
        </div>
    </div>
</div>

<!-- ========================================================
     3. FEATURED DAILY PRODUCTS (EXACT MATCH TO HEADING)
     ======================================================== -->
<section style="padding: 10px 16px 50px; max-width: 1300px; margin: 0 auto;">
    <div class="dh-section-header">
        <div class="dh-section-kicker">FEATURED BEST PRODUCTS</div>
        <h2 class="dh-section-title">Daily Ayurvedic Essentials</h2>
        <p class="dh-section-subtitle">Browse complete range of 100% organic &amp; approved products.</p>
    </div>

    <!-- Desktop View: Carousel -->
    <div class="dh-daily-desktop-view">
        <div class="owl-carousel dh-daily-carousel owl-theme">
            @foreach($bestSellers as $index => $product)
                @php
                    $inWishlist = in_array($product->id, session()->get('wishlist', []));
                @endphp
                <div class="dh-product-card" onclick="if (!event.target.closest('.dh-card-wishlist, .dh-btn-card-add')) window.location.href='{{ route('product.show', $product->slug) }}';">
                    @if(str_contains(strtolower($product->name), 'kit'))
                        <span class="dh-card-badge">Kit</span>
                    @endif

                    <button type="button" class="dh-card-wishlist" onclick="Ebigcart.toggleWishlist('{{ $product->id }}', this, event)" style="{{ $inWishlist ? 'color:#ef4444;' : '' }}" title="Wishlist">
                        <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                    </button>

                    <div class="dh-card-img-box">
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" loading="lazy">
                    </div>

                    <div class="dh-card-body">
                        <a href="{{ route('product.show', $product->slug) }}" class="dh-card-title">{{ $product->name }}</a>
                        
                        <div class="dh-card-rating">
                            <span>★★★★★</span>
                            <span class="dh-rating-num">{{ $product->id == 17 ? '4.5' : '5.0' }}</span>
                            <span class="dh-reviews-cnt">({{ $product->id == 17 ? '7' : ($product->id == 21 ? '12' : '1') }})</span>
                        </div>

                        <div class="dh-card-price-row">
                            <span class="dh-card-price-current">₹{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                            @if($product->sale_price)
                                <span class="dh-card-price-old">₹{{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>

                        <button type="button" class="dh-btn-card-add" onclick="Ebigcart.addToCart('{{ $product->id }}', 1, event)">
                            <i class="bi bi-bag"></i> ADD TO BAG
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile View: 2-Column Grid (2x2 Cards Matching Mobile Reference) -->
    <div class="dh-daily-mobile-view">
        <div class="dh-daily-grid-2col">
            @foreach($bestSellers->take(4) as $index => $product)
                @php
                    $inWishlist = in_array($product->id, session()->get('wishlist', []));
                @endphp
                <div class="dh-product-card" onclick="if (!event.target.closest('.dh-card-wishlist, .dh-btn-card-add')) window.location.href='{{ route('product.show', $product->slug) }}';">
                    @if(str_contains(strtolower($product->name), 'kit'))
                        <span class="dh-card-badge">Kit</span>
                    @endif

                    <button type="button" class="dh-card-wishlist" onclick="Ebigcart.toggleWishlist('{{ $product->id }}', this, event)" style="{{ $inWishlist ? 'color:#ef4444;' : '' }}" title="Wishlist">
                        <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                    </button>

                    <div class="dh-card-img-box">
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" loading="lazy">
                    </div>

                    <div class="dh-card-body">
                        <a href="{{ route('product.show', $product->slug) }}" class="dh-card-title">{{ $product->name }}</a>
                        
                        <div class="dh-card-rating">
                            <span>★★★★★</span>
                            <span class="dh-rating-num">{{ $product->id == 17 ? '4.5' : '5.0' }}</span>
                            <span class="dh-reviews-cnt">({{ $product->id == 17 ? '7' : ($product->id == 21 ? '12' : '1') }})</span>
                        </div>

                        <div class="dh-card-price-row">
                            <span class="dh-card-price-current">₹{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                            @if($product->sale_price)
                                <span class="dh-card-price-old">₹{{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>

                        <button type="button" class="dh-btn-card-add" onclick="Ebigcart.addToCart('{{ $product->id }}', 1, event)">
                            <i class="bi bi-bag"></i> ADD TO BAG
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Products CTA Button Matching Mobile Reference -->
        <div style="text-align: center; margin-top: 24px;">
            <a href="{{ route('shop') }}" class="dh-btn-view-all">
                VIEW ALL PRODUCTS <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- ========================================================
     4. CURSIVE CALLOUT BANNER
     ======================================================== -->
<div class="dh-nature-banner">
    <div class="container text-center">
        <h2 class="dh-nature-script">Enriched With Goodness Of Nature</h2>
        <p style="color:#e2e8f0; letter-spacing: 2px; text-transform: uppercase; font-size: 0.92rem; font-weight: 600;">Pure Ayurvedic Ingredients &bull; Ancient Vedic Recipes &bull; Holistic Healing</p>
    </div>
</div>

<!-- ========================================================
     5. BRAND PHILOSOPHY / ABOUT STORY
     ======================================================== -->
<section style="padding: 40px 20px; max-width: 950px; margin: 0 auto; text-align: center;">
    <div class="dh-section-kicker">OUR CORE PHILOSOPHY</div>
    <h2 style="font-family:'Cinzel',serif; font-size:1.85rem; font-weight:800; color:var(--dh-navy); margin-bottom:18px;">DHURIA : NURTURING WITH EXTRA NATURALLY</h2>
    <p style="font-size:1rem; line-height:1.8; color:#475569; margin-bottom:25px;">
        At Dhuria, we believe that true vitality starts with nature. Our mission is to provide authentic, time-honored Ayurvedic wellness for modern living. Every formulation is handcrafted using handpicked Himalayan herbs, pure botanical oils, and ancient Vedic decoctions—free from synthetic fillers, preservatives, and harmful chemicals.
    </p>

    <div style="display:flex; justify-content:center; flex-wrap:wrap; gap:12px; margin-bottom:25px;">
        <span style="background:#f1f5f9; color:var(--dh-navy); border:1px solid #cbd5e1; font-size:0.82rem; font-weight:700; padding:6px 18px; border-radius:50px;"><i class="bi bi-check-circle-fill text-green-600"></i> 100% Herbal Extraction</span>
        <span style="background:#f1f5f9; color:var(--dh-navy); border:1px solid #cbd5e1; font-size:0.82rem; font-weight:700; padding:6px 18px; border-radius:50px;"><i class="bi bi-check-circle-fill text-green-600"></i> AYUSH Certified</span>
        <span style="background:#f1f5f9; color:var(--dh-navy); border:1px solid #cbd5e1; font-size:0.82rem; font-weight:700; padding:6px 18px; border-radius:50px;"><i class="bi bi-check-circle-fill text-green-600"></i> Non-GMO &amp; Cruelty Free</span>
        <span style="background:#f1f5f9; color:var(--dh-navy); border:1px solid #cbd5e1; font-size:0.82rem; font-weight:700; padding:6px 18px; border-radius:50px;"><i class="bi bi-check-circle-fill text-green-600"></i> Doctor Formulated</span>
    </div>

    <a href="{{ route('about') }}" style="background:transparent; color:var(--dh-gold-dark); border:2px solid var(--dh-gold-dark); font-size:0.85rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; padding:10px 28px; border-radius:30px; text-decoration:none; display:inline-block;">READ OUR STORY</a>
</section>

<!-- ========================================================
     6. DOCTOR / HEALTHCARE EXPERT ENDORSEMENT
     ======================================================== -->
<section class="dh-doctor-endorsement-section">
    <div class="dh-doctor-banner-wrap">
        <img src="{{ asset('images/doctor_endorsement_banner_hd.jpg') }}?v={{ file_exists(public_path('images/doctor_endorsement_banner_hd.jpg')) ? filemtime(public_path('images/doctor_endorsement_banner_hd.jpg')) : 1 }}" 
             alt="Recommended By Health Professionals - We Are An Honest Ayurveda Brand" 
             class="dh-doctor-banner-img"
             loading="lazy">
    </div>
</section>

<!-- ========================================================
     7. BENEFITS (4 CLEAN CARDS)
     ======================================================== -->
<section style="max-width: 1250px; margin: 30px auto 50px; padding: 0 20px;">
    <div class="dh-section-header">
        <div class="dh-section-kicker">KEY BENEFITS</div>
        <h2 class="dh-section-title">Benefits of Pure Ayurveda</h2>
    </div>

    <div class="dh-benefits-grid">
        <div class="dh-benefit-card">
            <div class="dh-benefit-icon"><i class="bi bi-flower2"></i></div>
            <h4 style="font-size:0.95rem; font-weight:800; color:var(--dh-navy); margin-bottom:6px;">100% Herbal</h4>
            <p style="font-size:0.82rem; color:#64748b; line-height:1.45; margin:0;">Pure botanical extracts sourced directly from certified organic cultivators.</p>
        </div>

        <div class="dh-benefit-card">
            <div class="dh-benefit-icon"><i class="bi bi-book-half"></i></div>
            <h4 style="font-size:0.95rem; font-weight:800; color:var(--dh-navy); margin-bottom:6px;">Ayurvedic Heritage</h4>
            <p style="font-size:0.82rem; color:#64748b; line-height:1.45; margin:0;">Formulations guided by authentic Charaka and Sushruta Samhita principles.</p>
        </div>

        <div class="dh-benefit-card">
            <div class="dh-benefit-icon"><i class="bi bi-cup-hot"></i></div>
            <h4 style="font-size:0.95rem; font-weight:800; color:var(--dh-navy); margin-bottom:6px;">Easy Consumption</h4>
            <p style="font-size:0.82rem; color:#64748b; line-height:1.45; margin:0;">Seamlessly blends with warm water or milk for fast absorption and convenience.</p>
        </div>

        <div class="dh-benefit-card">
            <div class="dh-benefit-icon"><i class="bi bi-award"></i></div>
            <h4 style="font-size:0.95rem; font-weight:800; color:var(--dh-navy); margin-bottom:6px;">Quality Assured</h4>
            <p style="font-size:0.82rem; color:#64748b; line-height:1.45; margin:0;">Every batch tested in NABL-accredited labs for purity and zero heavy metals.</p>
        </div>
    </div>
</section>

<!-- ========================================================
     8. WHY CHOOSE DHURIA (6 PHOTO CARDS)
     ======================================================== -->
<section class="dh-why-section">
    <div class="dh-section-header">
        <div class="dh-section-kicker">PURITY YOU CAN TRUST</div>
        <h2 class="dh-section-title">Why Choose Dhuria?</h2>
        <p class="dh-section-subtitle">Our commitment to purity, ethics, and uncompromised Ayurvedic quality.</p>
    </div>

    <div class="dh-why-grid">
        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">01 / EXTRACTION</span>
                <i class="bi bi-flower1" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">Pure Herb Sourcing</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">Handpicked herbs at the peak of their seasonal potency from certified organic cultivators.</p>
            </div>
        </div>

        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">02 / HERITAGE</span>
                <i class="bi bi-book-half" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">Traditional Process</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">Prepared through authentic decoctions and sun-drying methods per classical Samhitas.</p>
            </div>
        </div>

        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">03 / FACILITY</span>
                <i class="bi bi-building-check" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">GMP Clean Facility</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">Manufactured in pharmaceutical-grade cleanroom protocols with zero chemical additives.</p>
            </div>
        </div>

        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">04 / SELECTION</span>
                <i class="bi bi-shield-check" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">Rigorous Testing</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">Screened in NABL-accredited labs for microbial purity, pesticide absence, and bio-activity.</p>
            </div>
        </div>

        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">05 / EXPERTISE</span>
                <i class="bi bi-person-badge" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">Doctor Formulated</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">Formulated under the supervision of senior Ayurvedic Vaidyas and natural medicine doctors.</p>
            </div>
        </div>

        <div class="dh-why-card" style="background: linear-gradient(135deg, #081a30 0%, #0d2544 100%); border: 1px solid rgba(255,255,255,0.08); padding: 24px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <span class="dh-why-card-num" style="color: #d4af37; font-weight: 800; font-size: 11px;">06 / TRUST</span>
                <i class="bi bi-heart-pulse" style="font-size: 20px; color: #d4af37;"></i>
            </div>
            <div>
                <h4 class="dh-why-card-title" style="color: #ffffff; font-size: 16px; font-weight: 800; margin-bottom: 6px;">1,00,000+ Customers</h4>
                <p class="dh-why-card-desc" style="color: #94a3b8; font-size: 12px; line-height: 1.45; margin: 0;">A growing community of happy families across India experiencing authentic Ayurvedic health.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     9. OUR CLASSIC PRODUCTS (SLIDER)
     ======================================================== -->
<section style="padding: 40px 20px 50px; max-width: 1300px; margin: 0 auto;">
    <div class="dh-section-header">
        <div class="dh-section-kicker">SIGNATURE RANGE</div>
        <h2 class="dh-section-title">OUR CLASSIC PRODUCTS</h2>
        <p class="dh-section-subtitle">Explore our most trusted remedies for metabolic balance, liver vitality and daily wellness.</p>
    </div>

    <div class="owl-carousel dh-classic-carousel owl-theme">
        @foreach($featuredProducts as $index => $product)
            @php
                $inWishlist = in_array($product->id, session()->get('wishlist', []));
            @endphp
            <div class="dh-product-card" onclick="if (!event.target.closest('.dh-card-wishlist, .dh-btn-card-add')) window.location.href='{{ route('product.show', $product->slug) }}';" style="cursor: pointer;">
                @if(str_contains(strtolower($product->name), 'kit'))
                    <span class="dh-card-badge">Kit</span>
                @else
                    <span class="dh-card-badge" style="background:#081a30;">CLASSIC</span>
                @endif

                <button type="button" class="dh-card-wishlist" onclick="Ebigcart.toggleWishlist('{{ $product->id }}', this, event)" style="{{ $inWishlist ? 'color:#ef4444;' : '' }}" title="Wishlist">
                    <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                </button>

                <div class="dh-card-img-box">
                    <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" loading="lazy">
                </div>

                <div class="dh-card-body">
                    <a href="{{ route('product.show', $product->slug) }}" class="dh-card-title">{{ $product->name }}</a>

                    <div class="dh-card-rating">
                        <span>★★★★★</span>
                        <span class="dh-rating-num">{{ $product->id == 17 ? '4.5' : '5.0' }}</span>
                        <span class="dh-reviews-cnt">({{ $product->id == 17 ? '7' : ($product->id == 21 ? '12' : '1') }})</span>
                    </div>

                    <div class="dh-card-price-row">
                        <span class="dh-card-price-current">₹{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                        @if($product->sale_price)
                            <span class="dh-card-price-old">₹{{ number_format($product->price, 0) }}</span>
                        @endif
                    </div>

                    <button type="button" class="dh-btn-card-add" onclick="Ebigcart.addToCart('{{ $product->id }}', 1, event)">
                        <i class="bi bi-bag"></i> ADD TO BAG
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ========================================================
     10. PRODUCT SPOTLIGHT DEEP DIVE #1 (DIABETES PRO - MATCHING IMAGE 3)
     ======================================================== -->
@if(isset($spotlightProduct1) && $spotlightProduct1)
<section class="dh-spotlight-section">
    <div class="dh-spotlight-layout">
        <div class="dh-spotlight-media">
            <div class="dh-spotlight-main-card dh-spotlight-card-amber">
                <button type="button" class="dh-spotlight-arrow dh-sp-arrow-left" onclick="slideSpotlight('spotlight1', -1)" title="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="dh-spotlight-arrow dh-sp-arrow-right" onclick="slideSpotlight('spotlight1', 1)" title="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>
                @php $allUrls1 = $spotlightProduct1->all_image_urls; @endphp
                <img src="{{ $allUrls1[0] ?? $spotlightProduct1->primary_image_url }}" alt="{{ $spotlightProduct1->name }}" class="dh-spotlight-main-img" id="spotlight1-main-img">
            </div>
            <div class="dh-spotlight-thumbs" id="spotlight1-thumbs">
                @foreach(array_slice($allUrls1, 0, 4) as $tIndex => $tUrl)
                    <div class="dh-thumb-item {{ $tIndex == 0 ? 'active' : '' }}" onclick="switchSpotlightImage('spotlight1-main-img', '{{ $tUrl }}', this, 'spotlight1', {{ $tIndex }})">
                        <img src="{{ $tUrl }}" alt="Thumbnail {{ $tIndex + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="dh-spotlight-details">
            <div class="dh-sp-tag">
                <i class="bi bi-patch-check-fill" style="color: #047857;"></i>
                <span>CLASSICAL AYURVEDIC FORMULATION</span>
            </div>
            <h3 class="dh-sp-title">{{ $spotlightProduct1->name }}</h3>
            
            <div class="dh-sp-rating">
                <span class="dh-sp-stars">★★★★★</span>
                <span>4.9 (148 reviews)</span>
            </div>

            <div class="dh-sp-price-box">
                <div class="dh-sp-price-row">
                    <span class="dh-sp-price-cur">&#8377;{{ number_format($spotlightProduct1->sale_price ?? $spotlightProduct1->price, 0) }}</span>
                    @if($spotlightProduct1->sale_price)
                        <span class="dh-sp-price-old">&#8377;{{ number_format($spotlightProduct1->price, 0) }}</span>
                        @php $savings1 = $spotlightProduct1->price - $spotlightProduct1->sale_price; @endphp
                        <span class="dh-sp-price-save">SAVE &#8377;{{ number_format($savings1, 0) }}</span>
                    @endif
                </div>
                <div class="dh-sp-stock">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>In Stock &bull; Free Express Delivery Across India</span>
                </div>
            </div>

            <div class="dh-sp-action-row">
                <div class="dh-sp-stepper">
                    <button type="button" class="dh-sp-step-btn" onclick="let q = document.getElementById('spQty1'); q.value = Math.max(1, parseInt(q.value) - 1);">-</button>
                    <input type="number" id="spQty1" value="1" min="1" readonly class="dh-sp-step-input">
                    <button type="button" class="dh-sp-step-btn" onclick="let q = document.getElementById('spQty1'); q.value = parseInt(q.value) + 1;">+</button>
                </div>
                <button type="button" class="dh-sp-btn-bag" onclick="Ebigcart.addToCart('{{ $spotlightProduct1->id }}', parseInt(document.getElementById('spQty1').value), event)">
                    <i class="bi bi-bag"></i> ADD TO BAG
                </button>
            </div>

            <button type="button" class="dh-sp-btn-buy" onclick="Ebigcart.buyNow('{{ $spotlightProduct1->id }}', parseInt(document.getElementById('spQty1').value), event)">
                <i class="bi bi-lightning-fill"></i> BUY NOW WITH 1-CLICK
            </button>

            <div class="dh-sp-meta-row">
                <div class="dh-sp-socials">
                    <span style="font-weight:700;">Share:</span>
                    <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://pinterest.com" target="_blank"><i class="bi bi-pinterest"></i></a>
                    <a href="mailto:dhuriaayurveda@gmail.com"><i class="bi bi-envelope"></i></a>
                </div>
                <div class="dh-sp-pincode">
                    <span>Delivery:</span>
                    <input type="text" placeholder="Enter Pincode" maxlength="6" id="spPincode1">
                    <button type="button" onclick="alert('Fast Delivery Available for ' + (document.getElementById('spPincode1').value || 'your area') + ' within 2-4 business days.')">Check</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ========================================================
     11. MID PROMO BANNER (CHOOSE PURE - 100% DATABASE DYNAMIC)
     ======================================================== -->
@php
    $promoBanner = isset($banners) ? $banners->where('type', 'promo')->first() : null;
@endphp
<div style="max-width:1200px; margin:45px auto; border-radius:20px; overflow:hidden; position:relative; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
    <a href="{{ $promoBanner->link ?? route('shop') }}" style="display:block; text-decoration:none;">
        <img src="{{ $promoBanner ? $promoBanner->image_url : asset('images/enriched_nature_banner.jpg') }}" alt="{{ $promoBanner->title ?? 'Choose Pure Choose Ayurveda' }}" style="width:100%; max-height:200px; object-fit:cover; display:block;">
        <div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(8, 26, 48, 0.85) 35%, rgba(8, 26, 48, 0.4) 100%); display:flex; align-items:center; justify-content:space-between; padding:25px 45px; flex-wrap:wrap; gap:20px;">
            <div>
                <h3 style="font-family:'Brush Script MT','Great Vibes',cursive,serif; font-size:2.8rem; color:#fef08a; margin:0; line-height:1.1;">{{ $promoBanner->title ?? 'Choose Pure • Choose Ayurveda' }}</h3>
                <p style="font-size:0.92rem; color:#e2e8f0; margin:6px 0 0 0; letter-spacing:0.5px;">{{ $promoBanner->subtitle ?? 'Authentic formulations crafted to bring health, balance & peace to your home.' }}</p>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <img src="{{ asset('images/dhuria_logo_white.png') }}" alt="Dhuria" style="height:38px; width:auto; object-fit:contain;">
            </div>
        </div>
    </a>
</div>

<!-- ========================================================
     12. PRODUCT SPOTLIGHT DEEP DIVE #2 (PILECUREX KIT - MATCHING IMAGE 3)
     ======================================================== -->
@if(isset($spotlightProduct2) && $spotlightProduct2)
<section class="dh-spotlight-section">
    <div class="dh-spotlight-layout">
        <div class="dh-spotlight-media">
            <div class="dh-spotlight-main-card dh-spotlight-card-cyan">
                <button type="button" class="dh-spotlight-arrow dh-sp-arrow-left" onclick="slideSpotlight('spotlight2', -1)" title="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="dh-spotlight-arrow dh-sp-arrow-right" onclick="slideSpotlight('spotlight2', 1)" title="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>
                @php $allUrls2 = $spotlightProduct2->all_image_urls; @endphp
                <img src="{{ $allUrls2[0] ?? $spotlightProduct2->primary_image_url }}" alt="{{ $spotlightProduct2->name }}" class="dh-spotlight-main-img" id="spotlight2-main-img">
            </div>
            <div class="dh-spotlight-thumbs" id="spotlight2-thumbs">
                @foreach(array_slice($allUrls2, 0, 4) as $tIndex => $tUrl)
                    <div class="dh-thumb-item {{ $tIndex == 0 ? 'active' : '' }}" onclick="switchSpotlightImage('spotlight2-main-img', '{{ $tUrl }}', this, 'spotlight2', {{ $tIndex }})">
                        <img src="{{ $tUrl }}" alt="Thumbnail {{ $tIndex + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="dh-spotlight-details">
            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:10px;">
                <div class="dh-sp-tag" style="background:#e0f2fe; color:#0369a1; border-color:#bae6fd; margin-bottom:0;">
                    <i class="bi bi-patch-check-fill" style="color: #0284c7;"></i>
                    <span>CERTIFIED CLASSICAL AYURVEDIC KIT</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; background:#fef3c7; color:#92400e; padding:3px 10px; border-radius:15px; border:1px solid #fde68a; text-transform:uppercase;">100% HERBAL &amp; NON-TOXIC</span>
            </div>

            <h3 class="dh-sp-title">{{ $spotlightProduct2->name }}</h3>
            
            <div class="dh-sp-rating">
                <span class="dh-sp-stars">★★★★★</span>
                <span>4.9 (148 reviews)</span>
            </div>

            <div class="dh-sp-price-box">
                <div class="dh-sp-price-row">
                    <span class="dh-sp-price-cur">&#8377;{{ number_format($spotlightProduct2->sale_price ?? $spotlightProduct2->price, 0) }}</span>
                    @if($spotlightProduct2->sale_price)
                        <span class="dh-sp-price-old">&#8377;{{ number_format($spotlightProduct2->price, 0) }}</span>
                        @php $savings2 = $spotlightProduct2->price - $spotlightProduct2->sale_price; @endphp
                        <span class="dh-sp-price-save">SAVE &#8377;{{ number_format($savings2, 0) }}</span>
                    @endif
                </div>
                <div class="dh-sp-stock">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>In Stock &bull; Free Express Delivery Across India</span>
                </div>
            </div>

            <div class="dh-sp-action-row">
                <div class="dh-sp-stepper">
                    <button type="button" class="dh-sp-step-btn" onclick="let q = document.getElementById('spQty2'); q.value = Math.max(1, parseInt(q.value) - 1);">-</button>
                    <input type="number" id="spQty2" value="1" min="1" readonly class="dh-sp-step-input">
                    <button type="button" class="dh-sp-step-btn" onclick="let q = document.getElementById('spQty2'); q.value = parseInt(q.value) + 1;">+</button>
                </div>
                <button type="button" class="dh-sp-btn-bag" onclick="Ebigcart.addToCart('{{ $spotlightProduct2->id }}', parseInt(document.getElementById('spQty2').value), event)">
                    <i class="bi bi-bag"></i> ADD TO BAG
                </button>
            </div>

            <button type="button" class="dh-sp-btn-buy" onclick="Ebigcart.buyNow('{{ $spotlightProduct2->id }}', parseInt(document.getElementById('spQty2').value), event)">
                <i class="bi bi-lightning-fill"></i> BUY NOW WITH 1-CLICK
            </button>

            <div class="dh-sp-meta-row">
                <div class="dh-sp-socials">
                    <span style="font-weight:700;">Share:</span>
                    <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://pinterest.com" target="_blank"><i class="bi bi-pinterest"></i></a>
                    <a href="mailto:dhuriaayurveda@gmail.com"><i class="bi bi-envelope"></i></a>
                </div>
                <div class="dh-sp-pincode">
                    <span>Delivery:</span>
                    <input type="text" placeholder="Enter Pincode" maxlength="6" id="spPincode2">
                    <button type="button" onclick="alert('Fast Delivery Available for ' + (document.getElementById('spPincode2').value || 'your area') + ' within 2-4 business days.')">Check</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ========================================================
     13. CUSTOMER STORIES & REVIEWS (CAROUSEL MATCHING IMAGE 3)
     ======================================================== -->
<section style="max-width: 1250px; margin: 40px auto 60px; padding: 0 20px;">
    <div class="dh-section-header">
        <div class="dh-section-kicker">REAL EXPERIENCES</div>
        <h2 class="dh-section-title">Wellness stories, shared.</h2>
        <p class="dh-section-subtitle">No doctor visits. No prescriptions. Real results from everyday customers.</p>
    </div>

    <div class="owl-carousel dh-reviews-carousel owl-theme">
        @foreach($testimonials as $t)
            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:18px; padding:24px; box-shadow:0 4px 15px rgba(0,0,0,0.03); display:flex; flex-direction:column; justify-content:space-between; min-height: 220px; margin: 6px;">
                <div>
                    <div style="color:#f59e0b; margin-bottom:8px; font-size:0.95rem;">★★★★★</div>
                    <p style="font-size:0.88rem; line-height:1.6; color:#475569; font-style:italic; margin-bottom:18px;">
                        "{{ $t->content }}"
                    </p>
                </div>
                <div style="display:flex; align-items:center; gap:12px; border-top:1px solid #f1f5f9; padding-top:12px;">
                    <div style="width:38px; height:38px; border-radius:50%; background:#081a30; color:#ffffff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:0.85rem;">{{ substr($t->name, 0, 1) }}</div>
                    <div>
                        <div style="font-weight:700; font-size:0.86rem; color:#061528;">{{ $t->name }}</div>
                        <div style="font-size:0.75rem; color:#10b981; font-weight:600;"><i class="bi bi-patch-check-fill"></i> Verified Buyer &bull; {{ $t->location ?? 'India' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ========================================================
     INTERACTIVE JAVASCRIPT
     ======================================================== -->
<script>
const spotlight1Images = @json($allUrls1 ?? []);
const spotlight2Images = @json($allUrls2 ?? []);
let spIdx1 = 0;
let spIdx2 = 0;

function switchSpotlightImage(targetId, newSrc, thumbElement, spKey, idx) {
    const mainImg = document.getElementById(targetId);
    if (!mainImg) return;
    if (spKey === 'spotlight1') spIdx1 = idx;
    if (spKey === 'spotlight2') spIdx2 = idx;

    mainImg.style.opacity = '0.3';
    setTimeout(() => {
        mainImg.src = newSrc;
        mainImg.style.opacity = '1';
    }, 120);

    const parent = thumbElement.closest('.dh-spotlight-thumbs');
    if (parent) {
        parent.querySelectorAll('.dh-thumb-item').forEach(el => el.classList.remove('active'));
        thumbElement.classList.add('active');
    }
}

function slideSpotlight(spKey, direction) {
    const imgs = (spKey === 'spotlight1') ? spotlight1Images : spotlight2Images;
    if (!imgs || imgs.length <= 1) return;

    if (spKey === 'spotlight1') {
        spIdx1 = (spIdx1 + direction + imgs.length) % imgs.length;
        const thumbs = document.querySelectorAll('#spotlight1-thumbs .dh-thumb-item');
        switchSpotlightImage('spotlight1-main-img', imgs[spIdx1], thumbs[spIdx1], 'spotlight1', spIdx1);
    } else {
        spIdx2 = (spIdx2 + direction + imgs.length) % imgs.length;
        const thumbs = document.querySelectorAll('#spotlight2-thumbs .dh-thumb-item');
        switchSpotlightImage('spotlight2-main-img', imgs[spIdx2], thumbs[spIdx2], 'spotlight2', spIdx2);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        if(window.jQuery && jQuery().owlCarousel) {
            var navBtns = ['<i class="bi bi-chevron-left"></i>', '<i class="bi bi-chevron-right"></i>'];

            jQuery('.dh-hero-slider').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                navText: navBtns,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5500,
                autoplayHoverPause: true,
                items: 1
            });

            jQuery('.dh-daily-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                navText: navBtns,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    520: { items: 2 },
                    768: { items: 3 },
                    1024: { items: 4 }
                }
            });

            jQuery('.dh-classic-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                navText: navBtns,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    520: { items: 2 },
                    768: { items: 3 },
                    1024: { items: 4 }
                }
            });

            jQuery('.dh-reviews-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                navText: navBtns,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    680: { items: 2 },
                    992: { items: 3 }
                }
            });
        }
    }, 250);
});
</script>

@endsection
