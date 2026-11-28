@extends('layouts.frontend')

@section('title', $product->name . ' - Dhuria Ayurveda')

@section('content')

<style>
:root {
    --dh-navy: #081a30;
    --dh-navy-dark: #051221;
    --dh-gold: #c8923a;
    --dh-gold-hover: #b07d2c;
    --dh-amber: #f59e0b;
    --dh-green: #10b981;
}

.dh-product-page-wrap {
    max-width: 1350px;
    margin: 0 auto;
    padding: 25px 20px 80px;
    font-family: 'Outfit', sans-serif;
}

/* Breadcrumb */
.dh-breadcrumb {
    font-size: 0.82rem;
    color: #64748b;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.dh-breadcrumb a {
    color: #475569;
    text-decoration: none;
    font-weight: 600;
}
.dh-breadcrumb a:hover {
    color: var(--dh-navy);
}

/* Main Product Showcase Grid */
.dh-product-grid {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 45px;
    align-items: start;
    margin-bottom: 60px;
}

/* Left Image Box Matching Reference */
.dh-p-main-img-wrap {
    width: 100%;
    aspect-ratio: 1 / 1;
    background: #fbfbfd;
    border-radius: 24px;
    border: 1px solid rgba(226, 232, 240, 0.9);
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(8, 26, 48, 0.05);
    position: relative;
    overflow: hidden;
}
.dh-p-main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.3s ease, opacity 0.2s ease;
}
.dh-p-main-img-wrap:hover .dh-p-main-img {
    transform: scale(1.03);
}
.dh-p-wishlist-btn {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: #94a3b8;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    transition: all 0.2s;
    z-index: 10;
}
.dh-p-wishlist-btn:hover {
    color: #ef4444;
    transform: scale(1.1);
}
.dh-p-arrow-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #e2e8f0;
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
.dh-p-arrow-btn:hover {
    background: #ffffff;
    color: var(--dh-navy);
    transform: translateY(-50%) scale(1.08);
}
.dh-p-arrow-left { left: 14px; }
.dh-p-arrow-right { right: 14px; }

.dh-p-thumbs-row {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    justify-content: center;
}
.dh-p-thumb {
    width: 68px;
    height: 68px;
    border-radius: 14px;
    background: #ffffff;
    border: 2px solid #e2e8f0;
    padding: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    overflow: hidden;
}
.dh-p-thumb.active {
    border-color: #d97706;
    box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.25);
}
.dh-p-thumb:hover {
    border-color: #d97706;
}
.dh-p-thumb img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Right Details */
.dh-p-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ecfdf5;
    color: #047857;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 4px 14px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    margin-bottom: 12px;
    border: 1px solid #a7f3d0;
}
.dh-p-title {
    font-size: 2.1rem;
    font-weight: 900;
    color: var(--dh-navy);
    line-height: 1.25;
    margin: 0 0 10px 0;
    letter-spacing: -0.01em;
}
.dh-p-ratings-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}
.dh-p-stars {
    color: #f59e0b;
    font-size: 0.95rem;
    letter-spacing: 1px;
}
.dh-p-rating-text {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 600;
}

/* 6 Feature Badges (3x2 Grid) */
.dh-p-features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 22px;
}
.dh-p-feat-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 8px;
    text-align: center;
    transition: all 0.2s;
}
.dh-p-feat-card:hover {
    background: #ffffff;
    border-color: #cbd5e1;
}
.dh-p-feat-card i {
    font-size: 1.15rem;
    color: var(--dh-gold);
    display: block;
    margin-bottom: 4px;
}
.dh-p-feat-card span {
    font-size: 0.72rem;
    font-weight: 700;
    color: #334155;
    display: block;
    line-height: 1.25;
}

/* Pricing Row */
.dh-p-price-row {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 8px;
}
.dh-p-price-current {
    font-size: 2.3rem;
    font-weight: 900;
    color: var(--dh-navy);
}
.dh-p-price-old {
    font-size: 1.15rem;
    color: #94a3b8;
    text-decoration: line-through;
}
.dh-p-price-save {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 6px;
    text-transform: uppercase;
}
.dh-p-price-sub {
    font-size: 0.76rem;
    color: #64748b;
    margin-bottom: 20px;
}

/* Pack Selector */
.dh-p-packs-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 22px;
}
.dh-p-pack-btn {
    border: 2px solid #e2e8f0;
    background: #ffffff;
    border-radius: 12px;
    padding: 10px 8px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.dh-p-pack-btn.active {
    border-color: var(--dh-navy);
    background: #f1f5f9;
}
.dh-p-pack-name {
    font-size: 0.85rem;
    font-weight: 800;
    color: var(--dh-navy);
    display: block;
}
.dh-p-pack-save {
    font-size: 0.7rem;
    color: #10b981;
    font-weight: 700;
}

/* Actions Row */
.dh-p-actions-row {
    display: flex;
    gap: 12px;
    margin-bottom: 28px;
    flex-wrap: wrap;
}
.dh-qty-stepper {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    overflow: hidden;
    height: 48px;
    background: #ffffff;
}
.dh-qty-btn {
    width: 40px;
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
.dh-qty-btn:hover {
    background: #e2e8f0;
}
.dh-qty-input {
    width: 42px;
    height: 100%;
    text-align: center;
    border: none;
    font-size: 1rem;
    font-weight: 800;
    color: var(--dh-navy);
    outline: none;
}
.dh-btn-add-cart {
    flex: 1;
    min-width: 150px;
    background: var(--dh-navy);
    color: #ffffff;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(8, 26, 48, 0.2);
    transition: all 0.2s;
}
.dh-btn-add-cart:hover {
    background: var(--dh-navy-dark);
    transform: translateY(-1px);
}
.dh-btn-buy-cash {
    flex: 1;
    min-width: 150px;
    background: var(--dh-gold);
    color: #ffffff !important;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(200, 146, 58, 0.3);
    transition: all 0.2s;
    text-decoration: none !important;
}
.dh-btn-buy-cash:hover {
    background: var(--dh-gold-hover);
    transform: translateY(-1px);
}

/* Accordion */
.dh-accordion {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 25px;
}
.dh-acc-item {
    border-bottom: 1px solid #e2e8f0;
}
.dh-acc-item:last-child {
    border-bottom: none;
}
.dh-acc-btn {
    width: 100%;
    padding: 14px 18px;
    background: #f8fafc;
    border: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--dh-navy);
    cursor: pointer;
    text-align: left;
    transition: background 0.2s;
}
.dh-acc-btn:hover {
    background: #f1f5f9;
}
.dh-acc-content {
    display: none;
    padding: 18px 20px;
    background: #ffffff;
    font-size: 0.86rem;
    line-height: 1.65;
    color: #475569;
}
.dh-acc-content.active {
    display: block;
}
.dh-acc-callout {
    background: #f0f7ff;
    border-left: 3px solid #0284c7;
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 0.78rem;
    font-weight: 800;
    color: #0369a1;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 12px;
}

/* Certified Natural Goodness Badges (Matching Reference Brown Stamps) */
.dh-cert-goodness-wrap {
    text-align: center;
    margin: 60px 0;
    padding: 40px 20px;
    background: #ffffff;
}
.dh-cert-heading {
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--dh-navy);
    margin-bottom: 30px;
}
.dh-cert-badges-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 35px;
}
.dh-cert-stamp {
    width: 95px;
    height: 95px;
    border-radius: 50%;
    border: 3px solid #5a3825;
    position: relative;
    padding: 6px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #fffdfa;
    box-shadow: 0 4px 15px rgba(90, 56, 37, 0.1);
    transition: transform 0.2s;
}
.dh-cert-stamp::after {
    content: '';
    position: absolute;
    inset: 3px;
    border-radius: 50%;
    border: 1px dashed #5a3825;
    pointer-events: none;
}
.dh-cert-stamp:hover {
    transform: scale(1.08);
}
.dh-cert-stamp i {
    font-size: 1.5rem;
    color: #5a3825;
    margin-bottom: 2px;
}
.dh-cert-stamp span {
    font-size: 0.6rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #5a3825;
    letter-spacing: 0.3px;
    text-align: center;
    line-height: 1.15;
}

/* Frequently Bought Together (3 CARDS MATCHING REFERENCE IMAGE 2) */
.dh-fbt-wrap {
    margin: 60px 0;
}
.dh-fbt-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--dh-navy);
    text-align: center;
    margin-bottom: 6px;
}
.dh-fbt-sub {
    text-align: center;
    color: #64748b;
    font-size: 0.88rem;
    margin-bottom: 32px;
}
.dh-fbt-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    max-width: 1080px;
    margin: 0 auto;
}
@media (max-width: 860px) {
    .dh-fbt-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 12px !important; max-width: 100% !important; }
    .dh-fbt-img-wrap { height: 160px !important; }
}
@media (max-width: 480px) {
    .dh-fbt-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 10px !important; }
    .dh-fbt-img-wrap { height: 140px !important; }
    .dh-fbt-body { padding: 10px 8px 12px !important; }
    .dh-fbt-name { font-size: 0.8rem !important; }
    .dh-fbt-price-cur { font-size: 0.88rem !important; }
    .dh-fbt-btn-add { font-size: 0.7rem !important; padding: 7px 6px !important; }
}
.dh-fbt-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
    transition: all 0.25s ease;
}
.dh-fbt-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(8, 26, 48, 0.08);
}
.dh-fbt-card-top-0 { background: #eaf4ee; }
.dh-fbt-card-top-1 { background: #eaf0f7; }
.dh-fbt-card-top-2 { background: #e6f4f9; }

.dh-fbt-img-wrap {
    width: 100%;
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin: 0;
    overflow: hidden;
    position: relative;
}
.dh-fbt-img-wrap img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.3s;
}
.dh-fbt-card:hover .dh-fbt-img-wrap img {
    transform: scale(1.06);
}
.dh-fbt-badge-tag {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--dh-navy);
    color: #ffffff;
    font-size: 9px;
    font-weight: 800;
    padding: 2px 7px;
    border-radius: 5px;
    text-transform: uppercase;
}
.dh-fbt-heart-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: none;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}
.dh-fbt-body {
    padding: 16px 14px;
    text-align: center;
    display: flex;
    flex-direction: column;
    flex: 1;
    justify-content: space-between;
    background: #ffffff;
}
.dh-fbt-name {
    font-size: 0.88rem;
    font-weight: 700;
    color: #0f172a;
    text-decoration: none;
    line-height: 1.35;
    margin-bottom: 6px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.dh-fbt-name:hover {
    color: var(--dh-gold);
}
.dh-fbt-stars {
    color: #f59e0b;
    font-size: 0.72rem;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 3px;
}
.dh-fbt-prices {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 6px;
    margin-bottom: 12px;
}
.dh-fbt-price-cur {
    font-size: 1rem;
    font-weight: 800;
    color: var(--dh-navy);
}
.dh-fbt-price-old {
    font-size: 0.8rem;
    color: #94a3b8;
    text-decoration: line-through;
}
.dh-fbt-btn-add {
    background: var(--dh-gold);
    color: #ffffff;
    border: none;
    border-radius: 9px;
    padding: 9px 12px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    width: 100%;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 6px rgba(200, 146, 58, 0.25);
}
.dh-fbt-btn-add:hover {
    background: var(--dh-gold-hover);
}

/* FAQ Accordion Section */
.dh-faq-wrap {
    margin: 60px auto;
    max-width: 820px;
    padding: 0 10px;
}
.dh-faq-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f1f5f9;
    color: #475569;
    font-size: 0.7rem;
    font-weight: 800;
    padding: 4px 14px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 8px;
}
.dh-faq-title {
    font-size: 1.65rem;
    font-weight: 800;
    color: var(--dh-navy);
    margin-bottom: 24px;
    text-align: center;
}
.dh-faq-item {
    border: 1px solid #e2e8f0;
    background: #ffffff;
    border-radius: 14px;
    margin-bottom: 10px;
    overflow: hidden;
    transition: all 0.2s;
}
.dh-faq-item:hover {
    border-color: #cbd5e1;
}
.dh-faq-btn {
    width: 100%;
    padding: 15px 18px;
    background: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--dh-navy);
    cursor: pointer;
    text-align: left;
}
.dh-faq-ans {
    display: none;
    padding: 0 18px 16px;
    font-size: 0.85rem;
    line-height: 1.6;
    color: #64748b;
}
.dh-faq-ans.active {
    display: block;
}

/* Customer Reviews */
.dh-reviews-wrap {
    margin: 60px auto 20px;
    max-width: 980px;
}
.dh-reviews-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--dh-navy);
    margin-bottom: 22px;
}
.dh-rev-summary-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 24px 30px;
    display: flex;
    align-items: center;
    gap: 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.dh-rev-score-col {
    text-align: center;
    min-width: 120px;
}
.dh-rev-score {
    font-size: 2.8rem;
    font-weight: 900;
    color: var(--dh-navy);
    line-height: 1;
}
.dh-rev-score-sub {
    font-size: 0.75rem;
    color: #64748b;
    margin-top: 4px;
}
.dh-rev-bars-col {
    flex: 1;
    min-width: 240px;
}
.dh-rev-bar-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.74rem;
    color: #64748b;
    margin-bottom: 4px;
}
.dh-rev-bar-bg {
    flex: 1;
    height: 6px;
    background: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}
.dh-rev-bar-fill {
    height: 100%;
    background: var(--dh-navy);
    border-radius: 10px;
}
.dh-btn-write-rev {
    background: var(--dh-navy);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.2s;
}
.dh-btn-write-rev:hover {
    background: var(--dh-navy-dark);
}

.dh-rev-card {
    background: #ffffff;
    border: 1px solid #f1f5f9;
    border-radius: 14px;
    padding: 18px 20px;
    margin-bottom: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

@media (max-width: 992px) {
    .dh-product-grid { 
        grid-template-columns: 1fr; 
        gap: 30px;
    }
    .dh-p-main-img-wrap {
        max-width: 520px;
        margin: 0 auto;
    }
}
@media (max-width: 768px) {
    .dh-product-page-wrap {
        padding: 20px 15px 50px;
    }
    .dh-p-title {
        font-size: 1.7rem;
    }
    .dh-p-price-current {
        font-size: 2rem;
    }
    .dh-p-actions-row {
        gap: 10px;
    }
    .dh-qty-stepper {
        width: 100%;
        justify-content: space-between;
    }
    .dh-qty-btn {
        width: 48px;
    }
    .dh-qty-input {
        flex: 1;
    }
    .dh-btn-add-cart, .dh-btn-buy-cash {
        width: 100%;
        flex: 1 1 100%;
        padding: 14px 20px;
    }
    .dh-cert-badges-grid {
        gap: 20px;
    }
    .dh-cert-stamp {
        width: 82px;
        height: 82px;
    }
    .dh-cert-stamp i {
        font-size: 1.25rem;
    }
    .dh-rev-summary {
        flex-direction: column;
        align-items: stretch;
        gap: 18px;
        padding: 20px;
    }
    .dh-rev-score-col {
        text-align: center;
    }
    .dh-btn-write-rev {
        width: 100%;
        text-align: center;
    }
}
@media (max-width: 480px) {
    .dh-p-features-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
    .dh-p-packs-row {
        grid-template-columns: 1fr;
        gap: 8px;
    }
    .dh-p-thumb {
        width: 54px;
        height: 54px;
        border-radius: 10px;
    }
    .dh-fbt-grid {
        max-width: 100%;
    }
}
</style>

<div class="dh-product-page-wrap">
    <!-- Breadcrumb -->
    <div class="dh-breadcrumb">
        <a href="/">Home</a>
        <span>&rsaquo;</span>
        <a href="{{ route('shop') }}">Products</a>
        <span>&rsaquo;</span>
        @if($product->category)
            <a href="{{ route('shop', ['cat' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            <span>&rsaquo;</span>
        @endif
        <span style="color:var(--dh-navy); font-weight:700;">{{ $product->name }}</span>
    </div>

    <!-- Main Product Grid -->
    <div class="dh-product-grid">
        <!-- Left: Image Gallery Matching Reference Image -->
        <div>
            @php $allImgs = $product->all_image_urls; @endphp
            <div class="dh-p-main-img-wrap" id="mainImgContainer">
                <!-- Left / Right Carousel Slider Arrows -->
                <button type="button" class="dh-p-arrow-btn dh-p-arrow-left" onclick="slideImage(-1)" title="Previous Image">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="dh-p-arrow-btn dh-p-arrow-right" onclick="slideImage(1)" title="Next Image">
                    <i class="bi bi-chevron-right"></i>
                </button>

                <!-- Wishlist Heart Button -->
                <button type="button" class="dh-p-wishlist-btn" onclick="Ebigcart.toggleWishlist('{{ $product->id }}', this, event)" title="Wishlist">
                    <i class="bi bi-heart"></i>
                </button>

                <img id="mainProductImg" src="{{ $allImgs[0] ?? $product->primary_image_url }}" alt="{{ $product->name }}" class="dh-p-main-img">
            </div>

            <!-- Row of 4 Thumbnails -->
            <div class="dh-p-thumbs-row">
                @foreach($allImgs as $idx => $tImg)
                    <div class="dh-p-thumb {{ $idx == 0 ? 'active' : '' }}" onclick="switchProductImage('{{ $tImg }}', {{ $idx }}, this)">
                        <img src="{{ $tImg }}" alt="{{ $product->name }} view {{ $idx + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Product Info & Actions -->
        <div>
            <span class="dh-p-badge"><i class="bi bi-patch-check-fill"></i> IN STOCK &bull; 100% ORGANIC &amp; SAFE AYURVEDIC FORMULATION</span>
            <h1 class="dh-p-title">{{ $product->name }}</h1>

            <div class="dh-p-ratings-row">
                <div class="dh-p-stars">★★★★★</div>
                <span class="dh-p-rating-text">4.9 (148 reviews)</span>
            </div>

            <!-- 6 Feature Badges (3x2 Grid) -->
            <div class="dh-p-features-grid">
                <div class="dh-p-feat-card">
                    <i class="bi bi-flower1"></i>
                    <span>Classical Pure Herbs</span>
                </div>
                <div class="dh-p-feat-card">
                    <i class="bi bi-person-badge"></i>
                    <span>Doctor Formulated</span>
                </div>
                <div class="dh-p-feat-card">
                    <i class="bi bi-shield-check"></i>
                    <span>100% Herbal &amp; Safe</span>
                </div>
                <div class="dh-p-feat-card">
                    <i class="bi bi-x-octagon"></i>
                    <span>Zero Chemical Fillers</span>
                </div>
                <div class="dh-p-feat-card">
                    <i class="bi bi-lightning-charge"></i>
                    <span>Fast Absorption</span>
                </div>
                <div class="dh-p-feat-card">
                    <i class="bi bi-award"></i>
                    <span>AYUSH Certified</span>
                </div>
            </div>

            <!-- Price Row -->
            <div class="dh-p-price-row">
                <span class="dh-p-price-current" id="dynPriceCurrent">&#8377;{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                @if($product->sale_price)
                    <span class="dh-p-price-old" id="dynPriceOld">&#8377;{{ number_format($product->price, 0) }}</span>
                    @php $savings = $product->price - $product->sale_price; @endphp
                    <span class="dh-p-price-save" id="dynPriceSave">SAVE &#8377;{{ number_format($savings, 0) }}</span>
                @endif
            </div>
            <div class="dh-p-price-sub">Inclusive of all taxes. Free express shipping pan-India.</div>

            <!-- Pack Selector (Dynamic Admin Controlled) -->
            @php
                $packOptions = $product->formatted_pack_sizes;
            @endphp
            @if(!empty($packOptions) && is_array($packOptions) && count($packOptions) > 0)
                <div style="font-size:0.75rem; font-weight:800; color:#475569; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">SELECT PACK SIZE:</div>
                <div class="dh-p-packs-row">
                    @foreach($packOptions as $idx => $pack)
                        @php
                            $pQty = (int)($pack['quantity'] ?? $pack['qty'] ?? 1);
                            $pName = !empty($pack['name']) ? $pack['name'] : ('Pack of ' . $pQty);
                            $pBadge = $pack['badge'] ?? '';
                            $pMult = (float)($pack['multiplier'] ?? 1.0);
                            $pCustom = (!empty($pack['custom_price']) && (float)$pack['custom_price'] > 0) ? (float)$pack['custom_price'] : 0;
                        @endphp
                        <div class="dh-p-pack-btn {{ $idx === 0 ? 'active' : '' }}" 
                             onclick="selectPack({{ $pQty }}, {{ $pMult }}, this, {{ $pCustom }}, {{ $idx }})">
                            <span class="dh-p-pack-name">{{ $pName }}</span>
                            @if(!empty($pBadge))
                                <span class="dh-p-pack-save">{{ $pBadge }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Actions Row -->
            <div class="dh-p-actions-row">
                <div class="dh-qty-stepper">
                    <button type="button" class="dh-qty-btn" onclick="updateQty(-1)">-</button>
                    <input type="number" id="productQty" value="{{ !empty($packOptions) ? ($packOptions[0]['quantity'] ?? $packOptions[0]['qty'] ?? 1) : 1 }}" min="1" readonly class="dh-qty-input">
                    <button type="button" class="dh-qty-btn" onclick="updateQty(1)">+</button>
                </div>

                <button type="button" class="dh-btn-add-cart" onclick="Ebigcart.addToCart('{{ $product->id }}', parseInt(document.getElementById('productQty').value), event, selectedPackIndex)">
                    <i class="bi bi-bag"></i> ADD TO CART
                </button>

                <button type="button" class="dh-btn-buy-cash" onclick="Ebigcart.buyNow('{{ $product->id }}', parseInt(document.getElementById('productQty').value), event, selectedPackIndex)">
                    <i class="bi bi-lightning-fill"></i> BUY WITH CASH / UPI
                </button>
            </div>

            <!-- Accordion Details (Matching Reference) -->
            <div class="dh-accordion">
                <!-- Description Tab (Default Open) -->
                <div class="dh-acc-item">
                    <button type="button" class="dh-acc-btn" onclick="toggleAcc(this)">
                        <span>Description &amp; Key Botanical Benefits</span>
                        <i class="bi bi-chevron-up"></i>
                    </button>
                    <div class="dh-acc-content active">
                        <div class="dh-acc-callout">
                            AUTHENTIC CLASSICAL AYURVEDIC FORMULATION FOR SUSTAINED METABOLIC SUPPORT
                        </div>
                        <p style="margin-bottom: 12px;">{!! nl2br(e($product->description ?? $product->short_description)) !!}</p>
                        
                        <div style="font-weight:700; color:var(--dh-navy); margin-bottom:6px; font-size:0.84rem;">KEY CLINICAL HIGHLIGHTS:</div>
                        <ul style="padding-left:18px; margin:0; line-height:1.7; font-size:0.83rem;">
                            <li><strong>Zero Synthetic Chemicals:</strong> Free from artificial preservatives, steroids, and chemical binders.</li>
                            <li><strong>Standardized Herb Potency:</strong> Rich in active botanical bitters and adaptogens for deep endocrine rejuvenation.</li>
                            <li><strong>Cellular Absorption:</strong> Prepared using traditional classical Bhavana extraction for enhanced bioavailability.</li>
                            <li><strong>Sustained Vitality:</strong> Helps support normal glycemic levels, liver energy, and daily gut vitality.</li>
                        </ul>
                    </div>
                </div>

                <!-- Dosage Tab -->
                <div class="dh-acc-item">
                    <button type="button" class="dh-acc-btn" onclick="toggleAcc(this)">
                        <span>How To Use &amp; Recommended Dosage</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dh-acc-content">
                        <p><strong>Daily Dosage:</strong> Take 1 to 2 capsules or 1 level measuring spoon of powder twice daily, approximately 30 minutes before meals with lukewarm water or as advised by your Ayurvedic healthcare practitioner.</p>
                        <p style="margin-top:8px;"><strong>Duration:</strong> For holistic balance and cellular tissue stabilization, continuous usage for 60 to 90 days is advised.</p>
                    </div>
                </div>

                <!-- Testing & Safety Tab -->
                <div class="dh-acc-item">
                    <button type="button" class="dh-acc-btn" onclick="toggleAcc(this)">
                        <span>Clinical Testing &amp; Safety Assurance</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dh-acc-content">
                        <p>Dhuria formulations are produced in ISO &amp; GMP certified clean-room laboratories. Every batch is rigorously tested in NABL-accredited facilities to ensure 0.00% heavy metals (Lead, Arsenic, Mercury), zero pesticide residue, and 100% active herbal purity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Certified Natural Goodness For You (4 Rich Brown Stamps) -->
    <div class="dh-cert-goodness-wrap">
        <h3 class="dh-cert-heading">Certified Natural Goodness For You</h3>
        <div class="dh-cert-badges-grid">
            <div class="dh-cert-stamp">
                <i class="bi bi-shield-check"></i>
                <span>Cruelty Free</span>
            </div>
            <div class="dh-cert-stamp">
                <i class="bi bi-tree"></i>
                <span>100% Plant Based</span>
            </div>
            <div class="dh-cert-stamp">
                <i class="bi bi-droplet-half"></i>
                <span>Clinically Tested</span>
            </div>
            <div class="dh-cert-stamp">
                <i class="bi bi-stars"></i>
                <span>No Artificial Colors</span>
            </div>
        </div>
    </div>

    <!-- Section: Frequently Bought Together (Exactly 3 Cards Grid) -->
    <div class="dh-fbt-wrap">
        <h3 class="dh-fbt-title">Frequently Bought Together</h3>
        <p class="dh-fbt-sub">Pair this formulation for targeted internal cleansing and metabolic balance.</p>

        <div class="dh-fbt-grid">
            @foreach($relatedProducts->take(3) as $k => $rProd)
                <div class="dh-fbt-card">
                    <div class="dh-fbt-img-wrap dh-fbt-card-top-{{ $k % 3 }}">
                        @if(str_contains(strtolower($rProd->name), 'kit'))
                            <span class="dh-fbt-badge-tag">Kit</span>
                        @endif

                        <button type="button" class="dh-fbt-heart-btn" onclick="Ebigcart.toggleWishlist('{{ $rProd->id }}', this, event)" title="Wishlist">
                            <i class="bi bi-heart"></i>
                        </button>

                        <a href="{{ route('product.show', $rProd->slug) }}" style="display:flex; align-items:center; justify-content:center; width:100%; height:100%;">
                            <img src="{{ $rProd->primary_image_url }}" alt="{{ $rProd->name }}" loading="lazy">
                        </a>
                    </div>

                    <div class="dh-fbt-body">
                        <div>
                            <a href="{{ route('product.show', $rProd->slug) }}" class="dh-fbt-name">{{ $rProd->name }}</a>

                            <div class="dh-fbt-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span style="color:#0f172a; font-weight:800; font-size:10px; margin-left:3px;">5.0 (1)</span>
                            </div>
                        </div>

                        <div>
                            <div class="dh-fbt-prices">
                                <span class="dh-fbt-price-cur">&#8377;{{ number_format($rProd->sale_price ?? $rProd->price, 0) }}</span>
                                @if($rProd->sale_price)
                                    <span class="dh-fbt-price-old">&#8377;{{ number_format($rProd->price, 0) }}</span>
                                @endif
                            </div>

                            <button type="button" class="dh-fbt-btn-add" onclick="Ebigcart.addToCart('{{ $rProd->id }}', 1, event)">
                                ADD TO BAG
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section: Frequently Asked Questions (Matching Reference FAQ) -->
    <div class="dh-faq-wrap">
        <div style="text-align: center;">
            <div class="dh-faq-pill"><i class="bi bi-stars" style="color: #f59e0b;"></i> NEED HELP?</div>
            <h3 class="dh-faq-title">Frequently Asked Questions</h3>
        </div>

        <div class="dh-faq-item">
            <button type="button" class="dh-faq-btn" onclick="toggleFaq(this)">
                <span>How soon can I expect results?</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dh-faq-ans">
                Most customers report noticeable improvements in digestive vitality and energy levels within 2 to 3 weeks of consistent daily usage. For deeper cellular and metabolic stabilization, a complete 60 to 90-day course is recommended.
            </div>
        </div>

        <div class="dh-faq-item">
            <button type="button" class="dh-faq-btn" onclick="toggleFaq(this)">
                <span>Is it safe to consume alongside regular medications?</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dh-faq-ans">
                Yes. Dhuria formulations are 100% plant-based and classical. We recommend maintaining an interval of 45 minutes between your regular prescriptions and Ayurvedic remedies.
            </div>
        </div>

        <div class="dh-faq-item">
            <button type="button" class="dh-faq-btn" onclick="toggleFaq(this)">
                <span>Are there any known side effects?</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dh-faq-ans">
                None. Our products contain zero artificial chemicals, heavy metals, synthetic colors, or chemical preservatives. Every batch is certified non-toxic and laboratory tested.
            </div>
        </div>

        <div class="dh-faq-item">
            <button type="button" class="dh-faq-btn" onclick="toggleFaq(this)">
                <span>How long should I continue taking this formulation?</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dh-faq-ans">
                Ayurveda works holistically on root causes rather than temporary symptom suppression. Continuing for 3 consecutive months helps establish lasting metabolic balance.
            </div>
        </div>

        <div class="dh-faq-item">
            <button type="button" class="dh-faq-btn" onclick="toggleFaq(this)">
                <span>Does this product contain added sugar or gluten?</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dh-faq-ans">
                No. All our classical herbal remedies are 100% sugar-free, gluten-free, and safe for diabetic individuals.
            </div>
        </div>
    </div>

    <!-- Section: Customer Reviews -->
    <div class="dh-reviews-wrap">
        <h3 class="dh-reviews-title">Customer Reviews</h3>

        <div class="dh-rev-summary-card">
            <div class="dh-rev-score-col">
                <div class="dh-rev-score">4.5</div>
                <div style="color:#f59e0b; font-size:1rem; margin:4px 0;">★★★★★</div>
                <div class="dh-rev-score-sub">Based on 148 reviews</div>
            </div>

            <div class="dh-rev-bars-col">
                <div class="dh-rev-bar-row">
                    <span style="width:40px;">5 Star</span>
                    <div class="dh-rev-bar-bg"><div class="dh-rev-bar-fill" style="width:88%;"></div></div>
                    <span style="width:30px; text-align:right;">88%</span>
                </div>
                <div class="dh-rev-bar-row">
                    <span style="width:40px;">4 Star</span>
                    <div class="dh-rev-bar-bg"><div class="dh-rev-bar-fill" style="width:9%;"></div></div>
                    <span style="width:30px; text-align:right;">9%</span>
                </div>
                <div class="dh-rev-bar-row">
                    <span style="width:40px;">3 Star</span>
                    <div class="dh-rev-bar-bg"><div class="dh-rev-bar-fill" style="width:2%;"></div></div>
                    <span style="width:30px; text-align:right;">2%</span>
                </div>
                <div class="dh-rev-bar-row">
                    <span style="width:40px;">2 Star</span>
                    <div class="dh-rev-bar-bg"><div class="dh-rev-bar-fill" style="width:1%;"></div></div>
                    <span style="width:30px; text-align:right;">1%</span>
                </div>
                <div class="dh-rev-bar-row">
                    <span style="width:40px;">1 Star</span>
                    <div class="dh-rev-bar-bg"><div class="dh-rev-bar-fill" style="width:0%;"></div></div>
                    <span style="width:30px; text-align:right;">0%</span>
                </div>
            </div>

            <div>
                <button type="button" class="dh-btn-write-rev" onclick="alert('Thank you! Review form is open for verified purchasers.')">
                    WRITE A REVIEW
                </button>
            </div>
        </div>

        <!-- Verified Reviews List -->
        <div>
            <div class="dh-rev-card">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                    <div style="color:#f59e0b; font-size:0.85rem;">★★★★★</div>
                    <span style="font-size:0.75rem; color:#94a3b8;">3 days ago</span>
                </div>
                <div style="font-weight:700; font-size:0.88rem; color:var(--dh-navy);">
                    Rajeshwar S. &bull; <span style="color:#10b981; font-size:0.75rem; font-weight:700;"><i class="bi bi-check-circle-fill"></i> Verified Buyer</span>
                </div>
                <p style="font-size:0.85rem; color:#475569; margin-top:6px; line-height:1.5;">
                    "Remarkable difference within 2 weeks of usage. Sugar readings are well controlled and daytime energy is high. Genuine classical Ayurveda."
                </p>
            </div>

            <div class="dh-rev-card">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                    <div style="color:#f59e0b; font-size:0.85rem;">★★★★★</div>
                    <span style="font-size:0.75rem; color:#94a3b8;">1 week ago</span>
                </div>
                <div style="font-weight:700; font-size:0.88rem; color:var(--dh-navy);">
                    Dr. Sunita K. &bull; <span style="color:#10b981; font-size:0.75rem; font-weight:700;"><i class="bi bi-check-circle-fill"></i> Verified Buyer</span>
                </div>
                <p style="font-size:0.85rem; color:#475569; margin-top:6px; line-height:1.5;">
                    "Potency and herb quality is superior to market commercial alternatives. Zero bitterness or chemical aftertaste. Highly recommended."
                </p>
            </div>
        </div>
    </div>
</div>

<script>
const galleryImgs = @json($allImgs);
let currentImgIdx = 0;

function switchProductImage(src, idx, el) {
    currentImgIdx = idx;
    const mainImg = document.getElementById('mainProductImg');
    if (mainImg) {
        mainImg.style.opacity = '0.3';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 120);
    }
    document.querySelectorAll('.dh-p-thumb').forEach(t => t.classList.remove('active'));
    if (el) el.classList.add('active');
}

function slideImage(direction) {
    if (!galleryImgs || galleryImgs.length <= 1) return;
    currentImgIdx = (currentImgIdx + direction + galleryImgs.length) % galleryImgs.length;
    const thumbs = document.querySelectorAll('.dh-p-thumb');
    switchProductImage(galleryImgs[currentImgIdx], currentImgIdx, thumbs[currentImgIdx]);
}

const baseSalePrice = {{ $product->sale_price ?? $product->price }};
const baseRegPrice = {{ $product->price }};
let selectedPackIndex = 0;

function selectPack(packQty, multiplier, el, customPrice, packIdx) {
    document.querySelectorAll('.dh-p-pack-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('productQty').value = packQty;
    selectedPackIndex = (typeof packIdx !== 'undefined') ? packIdx : 0;

    let newSale = 0;
    // Defensive check: if customPrice is <= 50 and baseSalePrice >= 100, it's a discount percentage
    if (customPrice && customPrice > 0) {
        if (customPrice <= 50 && baseSalePrice >= 100) {
            newSale = Math.round(baseSalePrice * packQty * (1 - (customPrice / 100)));
        } else {
            newSale = Math.round(customPrice);
        }
    } else {
        newSale = Math.round(baseSalePrice * multiplier);
    }

    const newReg = Math.round(baseRegPrice * packQty);
    const newSave = Math.max(0, newReg - newSale);

    const curEl = document.getElementById('dynPriceCurrent');
    const oldEl = document.getElementById('dynPriceOld');
    const saveEl = document.getElementById('dynPriceSave');

    if (curEl) curEl.innerText = '₹' + newSale.toLocaleString('en-IN');
    if (oldEl) oldEl.innerText = '₹' + newReg.toLocaleString('en-IN');
    if (saveEl) {
        if (newSave > 0) {
            saveEl.style.display = 'inline-block';
            saveEl.innerText = 'SAVE ₹' + newSave.toLocaleString('en-IN');
        } else {
            saveEl.style.display = 'none';
        }
    }
}

function updateQty(delta) {
    const qInput = document.getElementById('productQty');
    let q = Math.max(1, parseInt(qInput.value) + delta);
    qInput.value = q;
}

function toggleAcc(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('i');
    content.classList.toggle('active');
    if (icon) {
        icon.className = content.classList.contains('active') ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
    }
}

function toggleFaq(btn) {
    const ans = btn.nextElementSibling;
    const icon = btn.querySelector('i');
    ans.classList.toggle('active');
    if (icon) {
        icon.className = ans.classList.contains('active') ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
    }
}
</script>

@endsection
