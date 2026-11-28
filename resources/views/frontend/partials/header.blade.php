@php
    $headerCategories = \Illuminate\Support\Facades\Cache::remember('site_header_categories', 3600, function() {
        return \App\Models\Category::parents()->with('children.children')->where('is_active', true)->get();
    });
    $searchFeaturedProducts = \Illuminate\Support\Facades\Cache::remember('site_search_featured_products', 3600, function() {
        return \App\Models\Product::where('is_active', true)->take(8)->get();
    });
@endphp

<!-- ========================================================
     FLORAMADE LUXURY HEADER
     ======================================================== -->
<header class="flora-header">
  <style>
    :root {
      --fl-navy-dark: #061528;
      --fl-navy-main: #081a30;
      --fl-navy-light: #0d2544;
      --fl-gold: #d4af37;
      --fl-gold-bright: #f59e0b;
      --fl-gold-light: #fef08a;
    }

    html, body, #page, .site, header, .flora-header {
      margin-top: 0 !important;
      padding-top: 0 !important;
      top: 0 !important;
    }

    .flora-header {
      background: var(--fl-navy-dark);
      color: #ffffff;
      font-family: 'Cinzel', 'Outfit', sans-serif;
      position: sticky;
      top: 0;
      z-index: 9999;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
      border-bottom: 1px solid rgba(212, 175, 55, 0.25);
    }

    /* 1. TOP UTILITY / ANNOUNCEMENT BAR */
    .flora-top-bar {
      background: #030c18;
      color: #cbd5e1;
      padding: 6px 30px;
      font-size: 0.76rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1550px;
      margin: 0 auto;
      letter-spacing: 0.3px;
    }
    .flora-top-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .flora-social-link {
      color: #94a3b8;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
      font-size: 0.72rem;
      transition: all 0.2s ease;
    }
    .flora-social-link:hover {
      background: var(--fl-gold);
      color: var(--fl-navy-dark);
      transform: translateY(-1px);
    }
    .flora-top-left-text {
      color: #cbd5e1;
      font-weight: 500;
      margin-left: 4px;
    }

    .flora-top-center {
      color: #fef08a;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-align: center;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .flora-top-right {
      display: flex;
      align-items: center;
      gap: 14px;
      color: #cbd5e1;
    }
    .flora-top-contact-link {
      color: #cbd5e1;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: color 0.2s;
    }
    .flora-top-contact-link:hover {
      color: var(--fl-gold);
    }

    /* 2. MAIN HEADER NAVIGATION BAR */
    .flora-main-nav {
      max-width: 1550px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 30px;
      position: relative;
    }

    /* Brand Logo */
    .flora-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none !important;
    }
    .flora-brand-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: 1.5px solid var(--fl-gold);
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle, #254972 0%, #0c233f 100%);
      color: var(--fl-gold);
      font-size: 1.15rem;
      box-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
    }
    .flora-brand-text {
      font-family: 'Cinzel', serif;
      font-size: 1.75rem;
      font-weight: 800;
      letter-spacing: 1.5px;
      background: linear-gradient(135deg, #ffffff 30%, #fef08a 70%, #d4af37 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin: 0;
      line-height: 1;
    }

    /* Center Nav Links */
    .flora-nav-links {
      display: flex;
      align-items: center;
      gap: 32px;
      list-style: none;
      margin: 0;
      padding: 0;
    }
    .flora-nav-item {
      position: relative;
    }
    .flora-nav-link {
      color: #f1f5f9;
      text-decoration: none !important;
      font-size: 0.92rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      padding: 8px 0;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      transition: color 0.25s ease;
    }
    .flora-nav-link i.arrow {
      font-size: 0.7rem;
      transition: transform 0.2s;
    }
    .flora-nav-link:hover, .flora-nav-link.active {
      color: var(--fl-gold);
    }
    .flora-nav-item:hover .flora-nav-link i.arrow {
      transform: rotate(180deg);
    }

    /* Dropdown Menus */
    .flora-dropdown {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%) translateY(10px);
      background: var(--fl-navy-main);
      border: 1px solid rgba(212, 175, 55, 0.35);
      border-radius: 12px;
      padding: 10px 0;
      min-width: 220px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      z-index: 1000;
      list-style: none;
      pointer-events: none;
    }
    .flora-nav-item:hover > .flora-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
      pointer-events: auto;
    }
    .flora-dropdown-item {
      padding: 0;
      margin: 0;
    }
    .flora-dropdown-link {
      display: block;
      padding: 8px 20px;
      color: #cbd5e1;
      text-decoration: none !important;
      font-size: 0.85rem;
      font-weight: 500;
      transition: all 0.2s;
    }
    .flora-dropdown-link:hover {
      background: rgba(212, 175, 55, 0.12);
      color: var(--fl-gold);
      padding-left: 24px;
    }

    /* Right Action Icons */
    .flora-actions {
      display: flex;
      align-items: center;
      gap: 22px;
    }
    .flora-action-btn {
      color: #f1f5f9;
      text-decoration: none !important;
      font-size: 1.25rem;
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
    }
    .flora-action-btn:hover {
      color: var(--fl-gold);
      transform: translateY(-2px);
    }
    .flora-count-badge {
      position: absolute;
      top: -7px;
      right: -10px;
      background: var(--fl-gold-bright);
      color: #061528;
      font-size: 0.65rem;
      font-weight: 900;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1.5px solid var(--fl-navy-dark);
    }

    /* Centered Search Popup Modal (Matching Modern E-Commerce Standard) */
    .flora-search-modal-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(3, 12, 24, 0.78);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      z-index: 100000;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 16px 20px;
      overflow-y: auto;
    }
    .flora-search-modal-backdrop.active {
      display: flex;
    }
    .flora-search-modal-box {
      width: 100%;
      max-width: 620px;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5);
      padding: 24px;
      color: #0f172a;
      font-family: 'Outfit', sans-serif;
      animation: searchModalSlideDown 0.22s cubic-bezier(0.16, 1, 0.3, 1);
      border: 1px solid rgba(226, 232, 240, 0.95);
      position: relative;
      margin-bottom: 40px;
    }
    @keyframes searchModalSlideDown {
      from {
        opacity: 0;
        transform: translateY(-20px) scale(0.96);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }
    .flora-search-input-wrap {
      position: relative;
      display: flex;
      align-items: center;
      background: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-radius: 16px;
      padding: 10px 14px;
      margin-bottom: 18px;
      transition: all 0.2s;
    }
    .flora-search-input-wrap:focus-within {
      background: #ffffff;
      border-color: #081a30;
      box-shadow: 0 0 0 3px rgba(8, 26, 48, 0.08);
    }
    .flora-search-input-field {
      width: 100%;
      background: transparent;
      border: none;
      outline: none;
      font-size: 0.95rem;
      font-weight: 500;
      color: #0f172a;
      padding: 0 10px;
    }
    .flora-search-input-field::placeholder {
      color: #94a3b8;
    }
    .flora-search-spinner {
      display: none;
      width: 18px;
      height: 18px;
      border: 2px solid #e2e8f0;
      border-top-color: #d4af37;
      border-radius: 50%;
      animation: spinSearch 0.6s linear infinite;
      margin-right: 8px;
      flex-shrink: 0;
    }
    @keyframes spinSearch {
      to { transform: rotate(360deg); }
    }
    .flora-search-close-btn {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #f1f5f9;
      border: none;
      color: #64748b;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      cursor: pointer;
      transition: all 0.2s;
      flex-shrink: 0;
    }
    .flora-search-close-btn:hover {
      background: #e2e8f0;
      color: #0f172a;
    }
    .flora-search-sec-title {
      font-size: 0.7rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #64748b;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .flora-search-pill-list {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 18px;
    }
    .flora-search-pill {
      font-size: 0.75rem;
      font-weight: 600;
      color: #334155;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 5px 14px;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.18s;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .flora-search-pill:hover {
      background: #081a30;
      border-color: #081a30;
      color: #ffffff;
      transform: translateY(-1px);
    }
    .flora-search-remedies-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .flora-search-scroll-list {
      max-height: 400px;
      overflow-y: auto;
      padding-right: 4px;
    }
    .flora-search-scroll-list::-webkit-scrollbar {
      width: 5px;
    }
    .flora-search-scroll-list::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 4px;
    }
    .flora-search-scroll-list::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }
    .flora-search-scroll-list::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    .flora-search-remedy-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 14px;
      border: 1px solid #eef2f6;
      background: #ffffff;
      text-decoration: none;
      color: inherit;
      margin-bottom: 8px;
      transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .flora-search-remedy-item:hover {
      background: #f8fafc;
      border-color: #cbd5e1;
      box-shadow: 0 4px 14px rgba(8, 26, 48, 0.06);
      transform: translateY(-1px);
    }
    .flora-search-remedy-thumb {
      width: 52px;
      height: 52px;
      border-radius: 12px;
      background: #f8fafc;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4px;
      flex-shrink: 0;
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }
    .flora-search-remedy-thumb img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .flora-search-remedy-info {
      flex: 1;
      min-width: 0;
    }
    .flora-search-remedy-name {
      font-size: 0.88rem;
      font-weight: 700;
      color: #081a30;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 4px;
    }
    .flora-search-remedy-price-row {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.82rem;
      flex-wrap: wrap;
    }
    .flora-search-badge-ayur {
      font-size: 0.65rem;
      font-weight: 700;
      background: #f1f5f9;
      color: #475569;
      padding: 2px 8px;
      border-radius: 6px;
      border: 1px solid #e2e8f0;
    }
    .flora-search-badge-discount {
      font-size: 0.65rem;
      font-weight: 800;
      background: #ecfdf5;
      color: #059669;
      padding: 2px 7px;
      border-radius: 6px;
      border: 1px solid #a7f3d0;
    }
    .flora-search-view-all-btn {
      display: block;
      width: 100%;
      text-align: center;
      background: #081a30;
      color: #ffffff !important;
      padding: 12px 16px;
      border-radius: 12px;
      font-size: 0.82rem;
      font-weight: 800;
      text-decoration: none !important;
      margin-top: 14px;
      transition: background 0.2s, transform 0.2s;
      letter-spacing: 0.5px;
    }
    .flora-search-view-all-btn:hover {
      background: #0d2544;
      transform: translateY(-1px);
    }
    .flora-search-empty-state {
      text-align: center;
      padding: 35px 15px;
      color: #64748b;
    }
    .flora-search-empty-state i {
      font-size: 2.2rem;
      color: #cbd5e1;
      display: block;
      margin-bottom: 8px;
    }
    .flora-search-quick-links {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 6px;
    }
    .flora-search-quick-link {
      font-size: 0.74rem;
      font-weight: 700;
      color: #475569;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 5px 14px;
      text-decoration: none;
      transition: all 0.18s;
    }
    .flora-search-quick-link:hover {
      background: #081a30;
      color: #ffffff;
      border-color: #081a30;
    }

    /* Mobile Hamburger Button */
    .flora-mobile-toggle {
      display: none;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(212, 175, 55, 0.35);
      color: var(--fl-gold);
      border-radius: 10px;
      padding: 7px 11px;
      font-size: 1.25rem;
      cursor: pointer;
      line-height: 1;
      transition: all 0.2s ease;
    }
    .flora-mobile-toggle:hover {
      background: rgba(212, 175, 55, 0.15);
      border-color: var(--fl-gold);
    }

    /* LUXURY SLIDING OFFCANVAS SIDEBAR (DRAWER) */
    .dh-sidebar-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(3, 12, 24, 0.7);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      z-index: 100001;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .dh-sidebar-backdrop.active {
      opacity: 1;
      visibility: visible;
    }

    .dh-sidebar-panel {
      position: fixed;
      top: 0;
      right: 0;
      width: 325px;
      max-width: 86vw;
      height: 100%;
      height: 100dvh;
      background: #081a30;
      color: #ffffff;
      z-index: 100002;
      transform: translateX(100%);
      transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
      box-shadow: -10px 0 40px rgba(0, 0, 0, 0.55);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      font-family: 'Outfit', sans-serif;
    }
    .dh-sidebar-panel.active {
      transform: translateX(0);
    }

    .dh-sidebar-head {
      padding: 14px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      background: #061528;
    }
    .dh-sidebar-brand {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 3px;
    }
    .dh-sidebar-logo {
      height: 26px;
      width: auto;
      object-fit: contain;
      display: block;
      margin: 0;
    }
    .dh-sidebar-tag {
      font-size: 8px;
      font-weight: 800;
      letter-spacing: 0.16em;
      color: #d4af37;
      text-transform: uppercase;
      margin: 0;
      line-height: 1.2;
    }
    .dh-sidebar-close-btn {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.12);
      color: #cbd5e1;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.82rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .dh-sidebar-close-btn:hover {
      background: rgba(239, 68, 68, 0.2);
      color: #ef4444;
      border-color: #ef4444;
    }

    /* User Profile Snippet in Sidebar - Compact, No Extra Gap */
    .dh-sidebar-user-card {
      padding: 8px 14px;
      background: linear-gradient(135deg, rgba(212, 175, 55, 0.12) 0%, rgba(13, 37, 68, 0.6) 100%);
      border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    }
    .dh-sb-user-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 6px;
    }
    .dh-sb-avatar {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: #d4af37;
      color: #081a30;
      font-weight: 900;
      font-size: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .dh-sb-user-name {
      font-size: 12.5px;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.2;
    }
    .dh-sb-user-badge {
      font-size: 9.5px;
      color: #cbd5e1;
      display: flex;
      align-items: center;
      gap: 4px;
      margin-top: 1px;
    }
    .dh-sb-user-actions {
      display: flex;
      gap: 6px;
    }
    .dh-sb-action-link {
      flex: 1;
      padding: 4px 8px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 6px;
      font-size: 10.5px;
      font-weight: 700;
      color: #f1f5f9;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      transition: background 0.2s;
    }
    .dh-sb-action-link:hover {
      background: rgba(212, 175, 55, 0.25);
      color: #d4af37;
    }

    .dh-sb-guest-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
    }
    .dh-sb-guest-title {
      font-size: 12px;
      font-weight: 800;
      color: #ffffff;
    }
    .dh-sb-guest-sub {
      font-size: 9.5px;
      color: #94a3b8;
      margin: 1px 0 0 0;
    }
    .dh-sb-login-btn {
      background: linear-gradient(135deg, #d4af37 0%, #b89326 100%);
      color: #061528 !important;
      font-size: 10px;
      font-weight: 900;
      padding: 5px 12px;
      border-radius: 16px;
      text-decoration: none !important;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      flex-shrink: 0;
      box-shadow: 0 2px 6px rgba(212, 175, 55, 0.25);
    }

    /* Scrollable Navigation - Tight, Zero Extra Gaps */
    .dh-sidebar-scroll {
      flex: 1;
      overflow-y: auto;
      padding: 6px 12px 16px;
    }
    .dh-sidebar-scroll::-webkit-scrollbar {
      width: 3px;
    }
    .dh-sidebar-scroll::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 3px;
    }
    .dh-sb-sec-title {
      font-size: 8.5px;
      font-weight: 800;
      letter-spacing: 0.12em;
      color: #64748b;
      text-transform: uppercase;
      margin: 8px 0 3px;
      padding-left: 4px;
    }
    .dh-sidebar-scroll > .dh-sb-sec-title:first-child {
      margin-top: 2px;
    }
    .dh-sb-nav-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 7px 10px;
      border-radius: 8px;
      color: #f1f5f9;
      text-decoration: none;
      font-size: 12.5px;
      font-weight: 700;
      margin-bottom: 1px;
      transition: all 0.18s ease;
    }
    .dh-sb-nav-item:hover, .dh-sb-nav-item.active {
      background: rgba(255, 255, 255, 0.08);
      color: #d4af37;
    }
    .dh-sb-nav-item i {
      font-size: 13px;
      width: 18px;
      color: #94a3b8;
    }
    .dh-sb-nav-item:hover i, .dh-sb-nav-item.active i {
      color: #d4af37;
    }
    .dh-sb-cat-link {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 6px 10px 6px 12px;
      border-radius: 8px;
      color: #cbd5e1;
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 1px;
      border-left: 2px solid transparent;
      transition: all 0.18s ease;
    }
    .dh-sb-cat-link:hover, .dh-sb-cat-link.active {
      background: rgba(255, 255, 255, 0.05);
      color: #ffffff;
      border-left-color: #d4af37;
    }
    .dh-sb-cat-link i {
      font-size: 10px;
      color: #d4af37;
    }

    /* Sidebar Footer Support Box */
    .dh-sb-support-box {
      margin-top: 10px;
      padding: 10px;
      background: #040e1c;
      border: 1px solid rgba(212, 175, 55, 0.2);
      border-radius: 10px;
      text-align: center;
    }
    .dh-sb-wa-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      background: #25d366;
      color: #ffffff !important;
      padding: 7px 12px;
      border-radius: 8px;
      font-size: 11.5px;
      font-weight: 800;
      text-decoration: none !important;
      margin-bottom: 5px;
      box-shadow: 0 3px 10px rgba(37, 211, 102, 0.2);
    }
    .dh-sb-phone-link {
      font-size: 10.5px;
      color: #94a3b8;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .dh-sb-phone-link:hover {
      color: #d4af37;
    }

    .flora-mobile-search-btn {
      display: none;
    }

    @media (max-width: 992px) {
      .flora-top-left, .flora-top-right { display: none; }
      .flora-top-center { width: 100%; justify-content: center; font-size: 0.72rem; }
      .flora-nav-links { display: none; }
      .flora-main-nav {
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .flora-brand {
        margin: 0 auto;
      }
      .flora-brand img {
        height: 32px !important;
      }
      .flora-mobile-search-btn {
        display: flex !important;
        align-items: center;
        justify-content: center;
        background: none;
        border: none;
        color: #ffffff;
        font-size: 1.15rem;
        cursor: pointer;
        padding: 6px;
        line-height: 1;
        transition: color 0.2s;
      }
      .flora-mobile-search-btn:hover {
        color: var(--fl-gold);
      }
      .flora-mobile-toggle { 
        display: flex !important; 
        align-items: center;
        justify-content: center;
        background: none;
        border: 1px solid rgba(212, 175, 55, 0.4);
        color: var(--fl-gold);
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 1.2rem;
      }
      .flora-actions {
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .flora-actions .flora-action-btn[id="floraSearchToggle"],
      .flora-actions .flora-action-btn[title="My Wishlist"],
      .flora-actions .flora-action-btn[title="My Account"],
      .flora-actions .flora-action-btn[title="Login / Register"] {
        display: none !important;
      }
    }
  </style>

  <!-- 1. Top Utility Notification Bar -->
  <div class="flora-top-bar">
    <div class="flora-top-left">
      <a href="{{ \App\Models\Setting::get('social_facebook', 'https://www.facebook.com/profile.php?id=61594745097448') }}" target="_blank" class="flora-social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
      <a href="{{ \App\Models\Setting::get('social_instagram', 'https://www.instagram.com/ayurvedadhuria/') }}" target="_blank" class="flora-social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
      <span class="flora-top-left-text">Follow us!</span>
    </div>

    <div class="flora-top-center">
      <span>🎉</span> Festive Offer: Save Up to 20% + Extra Combo OFF!
    </div>

    <div class="flora-top-right">
      <span>Get in touch with us</span>
      <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="flora-top-contact-link" title="Call Us">
        <i class="bi bi-telephone-fill" style="color:var(--fl-gold);"></i>
      </a>
      <a href="mailto:{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}" class="flora-top-contact-link" title="Email Us">
        <i class="bi bi-envelope-fill" style="color:var(--fl-gold);"></i>
      </a>
    </div>
  </div>

  <!-- 2. Main Navigation Bar -->
  <div class="flora-main-nav">
    <!-- Left: Mobile Search Button (Matching Mobile Reference Header) -->
    <button type="button" class="flora-mobile-search-btn" onclick="triggerSearchModal(event)" title="Search Remedies">
      <i class="bi bi-search"></i>
    </button>

    <!-- Brand Logo -->
    <a href="/" class="flora-brand">
      <img src="{{ asset('images/dhuria_logo_white.png') }}" alt="dhuria" style="height: 38px; width: auto; object-fit: contain;">
    </a>

    <!-- Center Nav Links -->
    <ul class="flora-nav-links">
      <li class="flora-nav-item">
        <a href="/" class="flora-nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
      </li>

      <!-- MadhuCurex / Shop with Dropdown -->
      <li class="flora-nav-item">
        <a href="{{ route('shop') }}" class="flora-nav-link {{ request()->is('shop') ? 'active' : '' }}">
          <span>MadhuCurex</span>
          <i class="bi bi-chevron-down arrow"></i>
        </a>
        <ul class="flora-dropdown">
          <li class="flora-dropdown-item">
            <a href="{{ route('shop') }}" class="flora-dropdown-link">All Products</a>
          </li>
          @foreach($headerCategories as $hCat)
            <li class="flora-dropdown-item">
              <a href="{{ route('shop', ['cat' => $hCat->slug]) }}" class="flora-dropdown-link">{{ $hCat->name }}</a>
            </li>
          @endforeach
        </ul>
      </li>

      <li class="flora-nav-item">
        <a href="{{ route('about') }}" class="flora-nav-link {{ request()->is('about') ? 'active' : '' }}">About Us</a>
      </li>

      <li class="flora-nav-item">
        <a href="{{ route('contact') }}" class="flora-nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact Us</a>
      </li>

      <!-- Policy Dropdown -->
      <li class="flora-nav-item">
        <a href="javascript:void(0)" class="flora-nav-link">
          <span>Policy</span>
          <i class="bi bi-chevron-down arrow"></i>
        </a>
        <ul class="flora-dropdown">
          <li class="flora-dropdown-item"><a href="{{ route('terms') }}" class="flora-dropdown-link">Terms &amp; Conditions</a></li>
          <li class="flora-dropdown-item"><a href="{{ route('privacy') }}" class="flora-dropdown-link">Privacy Policy</a></li>
          <li class="flora-dropdown-item"><a href="{{ route('refund') }}" class="flora-dropdown-link">Refund &amp; Return Policy</a></li>
          <li class="flora-dropdown-item"><a href="{{ route('shipping') }}" class="flora-dropdown-link">Shipping Policy</a></li>
          <li class="flora-dropdown-item"><a href="{{ route('cancellation') }}" class="flora-dropdown-link">Cancellation Policy</a></li>
        </ul>
      </li>
    </ul>

    <!-- Right Action Icons -->
    <div class="flora-actions">
      <!-- Profile / User Account -->
      @auth
        <a href="{{ route('dashboard') }}" class="flora-action-btn" title="My Account">
          <i class="bi bi-person"></i>
        </a>
      @else
        <a href="{{ route('login') }}" class="flora-action-btn" title="Login / Register">
          <i class="bi bi-person"></i>
        </a>
      @endauth

      <!-- Search Trigger Icon -->
      <button type="button" class="flora-action-btn" id="floraSearchToggle" title="Search Products">
        <i class="bi bi-search"></i>
      </button>

      <!-- Wishlist Heart Icon -->
      <a href="{{ route('wishlist.index') }}" class="flora-action-btn" title="My Wishlist">
        <i class="bi bi-heart"></i>
        <span class="flora-count-badge wishlist-count-badge">0</span>
      </a>

      <!-- Shopping Bag Icon -->
      <a href="{{ route('cart.index') }}" class="flora-action-btn" title="Shopping Cart">
        <i class="bi bi-bag"></i>
        <span class="flora-count-badge cart-count-badge">0</span>
      </a>

      <!-- Mobile Hamburger Toggle (Right side on mobile) -->
      <button class="flora-mobile-toggle" id="floraMobileToggle" aria-label="Toggle Menu">
        <i class="bi bi-list"></i>
      </button>
    </div>

    <!-- Centered Search Popup Modal (Matching Modern E-Commerce Standard) -->
    <div class="flora-search-modal-backdrop" id="floraSearchModalBackdrop">
      <div class="flora-search-modal-box" id="floraSearchModalBox" onclick="event.stopPropagation()">
        <!-- Search Input Form -->
        <form action="{{ route('shop') }}" method="GET" id="floraSearchForm" onsubmit="saveRecentSearch(document.getElementById('floraSearchInput').value)">
          <div class="flora-search-input-wrap">
            <i class="bi bi-search" style="color: #d4af37; font-size: 1.1rem; flex-shrink: 0;"></i>
            <input type="text" name="search" id="floraSearchInput" class="flora-search-input-field" placeholder="Search Ayurvedic remedies, kits, powders..." value="{{ request('search') }}" autocomplete="off">
            <div class="flora-search-spinner" id="floraSearchSpinner"></div>
            <button type="button" class="flora-search-close-btn" id="floraSearchCloseBtn" title="Close Search">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
        </form>

        <!-- Dynamic Live Search Results Container (Hidden initially) -->
        <div id="floraSearchLiveView" style="display: none;">
          <!-- Category Suggestions -->
          <div id="floraSearchCatWrap" style="display: none; margin-bottom: 12px;">
            <div class="flora-search-sec-title">
              <span>Matching Categories</span>
            </div>
            <div id="floraSearchCatResults" class="flora-search-pill-list"></div>
          </div>

          <!-- Live Product Results -->
          <div class="flora-search-sec-title">
            <span id="floraSearchLiveCountLabel">Live Formulations</span>
          </div>
          <div id="floraSearchProdResults" class="flora-search-scroll-list"></div>

          <!-- View All Results Button -->
          <a href="#" id="floraSearchAllLink" class="flora-search-view-all-btn">
            View all results &rarr;
          </a>

          <!-- No Results State -->
          <div id="floraSearchNoResults" class="flora-search-empty-state" style="display: none;">
            <i class="bi bi-search"></i>
            <p style="font-weight: 800; color: #081a30; font-size: 1rem; margin-bottom: 4px;">No Formulations Found</p>
            <p style="font-size: 0.82rem; margin-bottom: 16px; color: #64748b;">We couldn't find any remedies matching your search query.</p>
            <a href="{{ route('shop') }}" class="flora-search-pill" style="background:#081a30; color:#ffffff; border-color:#081a30; padding: 7px 18px;">
              <i class="bi bi-grid-fill text-amber-400"></i> Browse All Formulations
            </a>
          </div>
        </div>

        <!-- Initial Default Search View (Recent + Popular + All Dynamic Products) -->
        <div id="floraSearchInitialView">
          <!-- Recent Searches Section (Loaded via JS localStorage) -->
          <div id="floraRecentSearchesWrap" style="display: none; margin-bottom: 14px;">
            <div class="flora-search-sec-title">
              <span><i class="bi bi-clock-history"></i> Recent Searches</span>
              <button type="button" onclick="clearRecentSearches()" style="background:none; border:none; color:#ef4444; font-size:0.68rem; font-weight:700; cursor:pointer;">Clear</button>
            </div>
            <div id="floraRecentSearchesList" class="flora-search-pill-list" style="margin-bottom: 12px;"></div>
          </div>

          <!-- Popular Searches Section -->
          <div class="flora-search-sec-title">
            <span><i class="bi bi-stars" style="color: #f59e0b;"></i> Popular Searches</span>
          </div>
          <div class="flora-search-pill-list">
            <button type="button" class="flora-search-pill" onclick="quickSearch('MadhuCurex')">MadhuCurex</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Pilecurex Kit')">Pilecurex Kit</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Liver Detox')">Liver Detox</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Paachan Sathi')">Paachan Sathi</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Shilajit')">Shilajit Resin</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Triphala')">Triphala Churna</button>
            <button type="button" class="flora-search-pill" onclick="quickSearch('Joint Care')">Joint Care</button>
          </div>

          <!-- Dynamic Remedies Section -->
          <div class="flora-search-remedies-header">
            <div class="flora-search-sec-title" style="margin-bottom: 0;">
              <span><i class="bi bi-shield-check" style="color: #10b981;"></i> Ayurvedic Formulations</span>
            </div>
            <a href="{{ route('shop') }}" style="font-size: 0.72rem; font-weight: 700; color: #475569; text-decoration: none;">View all ({{ $searchFeaturedProducts->count() }}) &rarr;</a>
          </div>

          <div id="floraSearchRemediesList" class="flora-search-scroll-list">
            @foreach($searchFeaturedProducts as $sProd)
              <a href="{{ route('product.show', $sProd->slug) }}" class="flora-search-remedy-item" onclick="saveRecentSearch('{{ addslashes($sProd->name) }}')">
                <div class="flora-search-remedy-thumb">
                  <img src="{{ $sProd->primary_image_url }}" alt="{{ $sProd->name }}" loading="lazy">
                </div>
                <div class="flora-search-remedy-info">
                  <div class="flora-search-remedy-name">{{ $sProd->name }}</div>
                  <div class="flora-search-remedy-price-row">
                    @if($sProd->sale_price)
                      <strong style="color: #081a30; font-weight: 800;">&#8377;{{ number_format($sProd->sale_price, 0) }}</strong>
                      <span style="color: #94a3b8; text-decoration: line-through; font-size: 0.75rem;">&#8377;{{ number_format($sProd->price, 0) }}</span>
                      @php
                        $discPct = round((($sProd->price - $sProd->sale_price) / $sProd->price) * 100);
                      @endphp
                      @if($discPct > 0)
                        <span class="flora-search-badge-discount">{{ $discPct }}% OFF</span>
                      @endif
                    @else
                      <strong style="color: #081a30; font-weight: 800;">&#8377;{{ number_format($sProd->price, 0) }}</strong>
                    @endif
                    <span class="flora-search-badge-ayur">{{ $sProd->category->name ?? 'Pure Ayurveda' }}</span>
                  </div>
                </div>
                <i class="bi bi-chevron-right" style="color: #cbd5e1; font-size: 0.85rem; margin-left: auto;"></i>
              </a>
            @endforeach
          </div>

          <!-- Quick Category Links Section -->
          <div class="flora-search-sec-title" style="margin-top: 16px; margin-bottom: 8px;">
            <span>Browse Categories</span>
          </div>
          <div class="flora-search-quick-links">
            @foreach($headerCategories as $hCat)
              <a href="{{ route('shop', ['cat' => $hCat->slug]) }}" class="flora-search-quick-link">{{ $hCat->name }}</a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- LUXURY SLIDING OFFCANVAS SIDEBAR (MOBILE DRAWER) -->
  <div class="dh-sidebar-backdrop" id="dhSidebarBackdrop"></div>
  <aside class="dh-sidebar-panel" id="dhSidebarPanel" aria-label="Mobile Navigation">
    <!-- Sidebar Header -->
    <div class="dh-sidebar-head">
      <div class="dh-sidebar-brand">
        <img src="{{ asset('images/dhuria_logo_white.png') }}" alt="Dhuria" class="dh-sidebar-logo">
        <span class="dh-sidebar-tag">PURE AYURVEDA &bull; VEDIC CARE</span>
      </div>
      <button type="button" class="dh-sidebar-close-btn" id="dhSidebarCloseBtn" aria-label="Close Menu">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>

    <!-- User Profile / Welcome Card -->
    <div class="dh-sidebar-user-card">
      @auth
        <div class="dh-sb-user-row">
          <div class="dh-sb-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </div>
          <div class="dh-sb-user-meta">
            <div class="dh-sb-user-name">{{ Auth::user()->name }}</div>
            <div class="dh-sb-user-badge">
              <i class="bi bi-patch-check-fill text-green-400"></i> Active Customer
            </div>
          </div>
        </div>
        <div class="dh-sb-user-actions">
          <a href="{{ route('orders.index') }}" class="dh-sb-action-link">
            <i class="bi bi-box-seam"></i> My Orders
          </a>
          <a href="{{ route('dashboard') }}" class="dh-sb-action-link">
            <i class="bi bi-person-gear"></i> Dashboard
          </a>
        </div>
      @else
        <div class="dh-sb-guest-row">
          <div class="dh-sb-guest-info">
            <div class="dh-sb-guest-title">Namaste! Welcome</div>
            <p class="dh-sb-guest-sub">Sign in to track orders &amp; offers</p>
          </div>
          <a href="{{ route('login') }}" class="dh-sb-login-btn">
            <span>SIGN IN</span> <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      @endauth
    </div>

    <!-- Scrollable Navigation Menu -->
    <div class="dh-sidebar-scroll">
      <!-- Main Navigation -->
      <div class="dh-sb-sec-title">EXPLORE STORE</div>
      <a href="/" class="dh-sb-nav-item {{ request()->is('/') ? 'active' : '' }}">
        <span><i class="bi bi-house-door"></i> Home</span>
        <i class="bi bi-chevron-right text-xs opacity-40"></i>
      </a>
      <a href="{{ route('shop') }}" class="dh-sb-nav-item {{ request()->is('shop') && !request('cat') ? 'active' : '' }}">
        <span><i class="bi bi-grid-fill text-amber-400"></i> All Formulations</span>
        <span class="text-[9px] bg-amber-400/20 text-amber-300 font-extrabold px-2 py-0.5 rounded-full uppercase">SHOP ALL</span>
      </a>
      <a href="{{ route('wishlist.index') }}" class="dh-sb-nav-item {{ request()->is('wishlist') ? 'active' : '' }}">
        <span><i class="bi bi-heart"></i> My Wishlist</span>
        <span class="flora-count-badge wishlist-count-badge" style="position:static; margin-left:auto;">0</span>
      </a>
      <a href="{{ route('cart.index') }}" class="dh-sb-nav-item {{ request()->is('cart') ? 'active' : '' }}">
        <span><i class="bi bi-bag"></i> Shopping Bag</span>
        <span class="flora-count-badge cart-count-badge" style="position:static; margin-left:auto;">0</span>
      </a>

      <!-- Ayurvedic Categories Group -->
      <div class="dh-sb-sec-title">AYURVEDIC CATEGORIES</div>
      @foreach($headerCategories as $hCat)
        <a href="{{ route('shop', ['cat' => $hCat->slug]) }}" class="dh-sb-cat-link {{ request('cat') == $hCat->slug ? 'active' : '' }}">
          <i class="bi bi-flower1"></i>
          <span>{{ $hCat->name }}</span>
        </a>
      @endforeach

      <!-- Help, About & Policies -->
      <div class="dh-sb-sec-title">ABOUT &amp; SUPPORT</div>
      <a href="{{ route('about') }}" class="dh-sb-nav-item {{ request()->is('about') ? 'active' : '' }}">
        <span><i class="bi bi-info-circle"></i> About Dhuria Heritage</span>
        <i class="bi bi-chevron-right text-xs opacity-40"></i>
      </a>
      <a href="{{ route('contact') }}" class="dh-sb-nav-item {{ request()->is('contact') ? 'active' : '' }}">
        <span><i class="bi bi-headset"></i> Contact &amp; Practitioners</span>
        <i class="bi bi-chevron-right text-xs opacity-40"></i>
      </a>
      <a href="{{ route('terms') }}" class="dh-sb-nav-item {{ request()->is('terms*') ? 'active' : '' }}">
        <span><i class="bi bi-file-earmark-text"></i> Terms &amp; Conditions</span>
      </a>
      <a href="{{ route('privacy') }}" class="dh-sb-nav-item {{ request()->is('privacy*') ? 'active' : '' }}">
        <span><i class="bi bi-shield-check"></i> Privacy Policy</span>
      </a>
      <a href="{{ route('refund') }}" class="dh-sb-nav-item {{ request()->is('refund*') ? 'active' : '' }}">
        <span><i class="bi bi-arrow-return-left"></i> Refund &amp; Cancellation</span>
      </a>

      @auth
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 14px;">
          @csrf
          <button type="submit" class="dh-sb-nav-item w-full" style="background: rgba(239, 68, 68, 0.12); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.25); cursor: pointer;">
            <span><i class="bi bi-box-arrow-right text-rose-400"></i> Log Out</span>
            <i class="bi bi-chevron-right text-xs opacity-40"></i>
          </button>
        </form>
      @endauth

      <!-- Quick Support Box inside Sidebar -->
      <div class="dh-sb-support-box">
        <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919318445297') }}?text=Hello%20Dhuria%20Healthcare,%20I%20would%20like%20to%20consult%20an%20Ayurvedic%20Practitioner" target="_blank" class="dh-sb-wa-btn">
          <i class="bi bi-whatsapp"></i> Chat with Ayurvedic Doctor
        </a>
        <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="dh-sb-phone-link">
          <i class="bi bi-telephone-fill text-amber-400"></i> Helpline: {{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}
        </a>
        <div style="font-size: 9px; color: #64748b; margin-top: 8px; letter-spacing: 0.5px; text-transform: uppercase;">
          100% Ayurvedic &bull; AYUSH Standard
        </div>
      </div>
    </div>
  </aside>
</header>

<script>
function getRecentSearches() {
  try {
    return JSON.parse(localStorage.getItem('dhuria_recent_searches') || '[]');
  } catch(e) {
    return [];
  }
}

function saveRecentSearch(term) {
  if (!term || typeof term !== 'string') return;
  term = term.trim();
  if (term.length < 2) return;
  let searches = getRecentSearches();
  searches = searches.filter(s => s.toLowerCase() !== term.toLowerCase());
  searches.unshift(term);
  if (searches.length > 5) searches = searches.slice(0, 5);
  localStorage.setItem('dhuria_recent_searches', JSON.stringify(searches));
  renderRecentSearches();
}

function clearRecentSearches() {
  localStorage.removeItem('dhuria_recent_searches');
  renderRecentSearches();
}

function renderRecentSearches() {
  const wrap = document.getElementById('floraRecentSearchesWrap');
  const list = document.getElementById('floraRecentSearchesList');
  if (!wrap || !list) return;
  const searches = getRecentSearches();
  if (searches.length === 0) {
    wrap.style.display = 'none';
    list.innerHTML = '';
  } else {
    wrap.style.display = 'block';
    list.innerHTML = searches.map(s => `
      <button type="button" class="flora-search-pill" onclick="quickSearch('${s.replace(/'/g, "\\'")}')">
        <i class="bi bi-clock-history text-slate-400 text-[10px]"></i> ${s}
      </button>
    `).join('');
  }
}

window.quickSearch = function(term) {
  const input = document.getElementById('floraSearchInput');
  if (!input) return;
  input.value = term;
  input.dispatchEvent(new Event('input', { bubbles: true }));
  input.focus();
};

document.addEventListener("DOMContentLoaded", function() {
  const searchToggle = document.getElementById('floraSearchToggle');
  const searchModalBackdrop = document.getElementById('floraSearchModalBackdrop');
  const searchCloseBtn = document.getElementById('floraSearchCloseBtn');
  const searchInput = document.getElementById('floraSearchInput');
  const searchSpinner = document.getElementById('floraSearchSpinner');
  const initialView = document.getElementById('floraSearchInitialView');
  const liveView = document.getElementById('floraSearchLiveView');
  const prodResults = document.getElementById('floraSearchProdResults');
  const catWrap = document.getElementById('floraSearchCatWrap');
  const catResults = document.getElementById('floraSearchCatResults');
  const noResults = document.getElementById('floraSearchNoResults');
  const allLink = document.getElementById('floraSearchAllLink');
  const liveCountLabel = document.getElementById('floraSearchLiveCountLabel');

  window.triggerSearchModal = function(e) {
    if (e && typeof e.preventDefault === 'function') e.preventDefault();
    window.openFloraSearch();
  };

  window.openFloraSearch = function() {
    if (searchModalBackdrop) {
      searchModalBackdrop.classList.add('active');
      document.body.style.overflow = 'hidden';
      renderRecentSearches();
      setTimeout(() => {
        if (searchInput) searchInput.focus();
      }, 100);
    }
  };

  window.closeFloraSearch = function() {
    if (searchModalBackdrop) {
      searchModalBackdrop.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  if (searchToggle) {
    searchToggle.addEventListener('click', function(e) {
      e.preventDefault();
      window.openFloraSearch();
    });
  }

  if (searchCloseBtn) {
    searchCloseBtn.addEventListener('click', window.closeFloraSearch);
  }

  if (searchModalBackdrop) {
    searchModalBackdrop.addEventListener('click', function(e) {
      if (e.target === searchModalBackdrop) {
        window.closeFloraSearch();
      }
    });
  }

  // Sidebar Controls
  const mobileToggle = document.getElementById('floraMobileToggle');
  const sidebarBackdrop = document.getElementById('dhSidebarBackdrop');
  const sidebarPanel = document.getElementById('dhSidebarPanel');
  const sidebarCloseBtn = document.getElementById('dhSidebarCloseBtn');

  window.openMobileSidebar = function() {
    if (sidebarBackdrop && sidebarPanel) {
      sidebarBackdrop.classList.add('active');
      sidebarPanel.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeMobileSidebar = function() {
    if (sidebarBackdrop && sidebarPanel) {
      sidebarBackdrop.classList.remove('active');
      sidebarPanel.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  if (mobileToggle) {
    mobileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      window.openMobileSidebar();
    });
  }

  if (sidebarCloseBtn) {
    sidebarCloseBtn.addEventListener('click', window.closeMobileSidebar);
  }

  if (sidebarBackdrop) {
    sidebarBackdrop.addEventListener('click', window.closeMobileSidebar);
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      if (sidebarPanel && sidebarPanel.classList.contains('active')) {
        window.closeMobileSidebar();
      }
      if (searchModalBackdrop && searchModalBackdrop.classList.contains('active')) {
        window.closeFloraSearch();
      }
    }
  });

  // AJAX Live Search with Debounce
  let searchTimer = null;
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const q = this.value.trim();
      clearTimeout(searchTimer);

      if (q.length === 0) {
        if (searchSpinner) searchSpinner.style.display = 'none';
        if (initialView) initialView.style.display = 'block';
        if (liveView) liveView.style.display = 'none';
        renderRecentSearches();
        return;
      }

      if (searchSpinner) searchSpinner.style.display = 'block';

      searchTimer = setTimeout(() => {
        fetch(`/api/search/live?q=${encodeURIComponent(q)}`)
          .then(res => res.json())
          .then(data => {
            if (searchSpinner) searchSpinner.style.display = 'none';
            if (initialView) initialView.style.display = 'none';
            if (liveView) liveView.style.display = 'block';

            // Matching Categories
            if (data.categories && data.categories.length > 0) {
              catWrap.style.display = 'block';
              catResults.innerHTML = data.categories.map(c => `
                <a href="${c.url}" class="flora-search-pill" style="background: #f8fafc; border-color: #cbd5e1; color: #081a30; font-weight:700;">
                  <i class="bi bi-tag-fill text-amber-500 text-[10px]"></i> ${c.name}
                </a>
              `).join('');
            } else {
              catWrap.style.display = 'none';
            }

            // Products
            if (data.products && data.products.length > 0) {
              noResults.style.display = 'none';
              prodResults.style.display = 'block';
              allLink.style.display = 'block';
              allLink.href = data.all_results_url;
              allLink.innerHTML = `View all ${data.total} results for "${q}" &rarr;`;
              liveCountLabel.textContent = `Formulations (${data.total})`;

              prodResults.innerHTML = data.products.map(p => `
                <a href="${p.url}" class="flora-search-remedy-item" onclick="saveRecentSearch('${p.name.replace(/'/g, "\\'")}')">
                  <div class="flora-search-remedy-thumb">
                    <img src="${p.image}" alt="${p.name}" loading="lazy">
                  </div>
                  <div class="flora-search-remedy-info">
                    <div class="flora-search-remedy-name">${p.name}</div>
                    <div class="flora-search-remedy-price-row">
                      <strong style="color: #081a30; font-weight: 800;">&#8377;${p.price}</strong>
                      ${p.old_price ? `<span style="color: #94a3b8; text-decoration: line-through; font-size: 0.75rem;">&#8377;${p.old_price}</span>` : ''}
                      ${p.discount ? `<span class="flora-search-badge-discount">${p.discount}% OFF</span>` : ''}
                      <span class="flora-search-badge-ayur">${p.category}</span>
                    </div>
                  </div>
                  <i class="bi bi-chevron-right" style="color: #cbd5e1; font-size: 0.85rem; margin-left: auto;"></i>
                </a>
              `).join('');
            } else {
              prodResults.style.display = 'none';
              allLink.style.display = 'none';
              noResults.style.display = 'block';
              liveCountLabel.textContent = 'Results';
            }
          })
          .catch(err => {
            if (searchSpinner) searchSpinner.style.display = 'none';
            console.error('Search error:', err);
          });
      }, 200);
    });
  }
});
</script>
