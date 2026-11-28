<!-- ========================================================
     DHURIA LUXURY FOOTER (MATCHING USER REFERENCE DESIGN)
     ======================================================== -->

<!-- 1. Value Proposition 4-Col Bar (White/Light Section) -->
<div class="dhuria-value-bar">
    <div class="dhuria-value-inner">
        <div class="dhuria-val-col">
            <div class="dhuria-val-icon"><i class="bi bi-flower1"></i></div>
            <div>
                <h5 class="dhuria-val-title">100% Natural Products</h5>
                <p class="dhuria-val-sub">Proven Ayurvedic products</p>
            </div>
        </div>

        <div class="dhuria-val-col">
            <div class="dhuria-val-icon"><i class="bi bi-credit-card"></i></div>
            <div>
                <h5 class="dhuria-val-title">Easy Payment Methods</h5>
                <p class="dhuria-val-sub">Pay Through Net-Banking, Cards, UPI or COD</p>
            </div>
        </div>

        <div class="dhuria-val-col">
            <div class="dhuria-val-icon"><i class="bi bi-shield-lock"></i></div>
            <div>
                <h5 class="dhuria-val-title">Secure Website</h5>
                <p class="dhuria-val-sub">SSL Secured Website, Order With Confidence</p>
            </div>
        </div>

        <div class="dhuria-val-col">
            <div class="dhuria-val-icon"><i class="bi bi-headset"></i></div>
            <div>
                <h5 class="dhuria-val-title">24/7 Customer Support</h5>
                <p class="dhuria-val-sub">Got Questions? Just Email, WhatsApp or Call Us</p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Social Follow Bar -->
<div class="dhuria-social-bar">
    <div class="dhuria-social-inner">
        <div class="dhuria-social-left">
            <a href="{{ \App\Models\Setting::get('social_facebook', 'https://www.facebook.com/profile.php?id=61594745097448') }}" target="_blank" class="dhuria-s-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{ \App\Models\Setting::get('social_instagram', 'https://www.instagram.com/ayurvedadhuria/') }}" target="_blank" class="dhuria-s-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
        </div>
        <div class="dhuria-social-right">
            Follow-us on social media!
        </div>
    </div>
</div>

<!-- 3. Main Dark Navy Footer -->
<footer class="dhuria-main-footer">
    <div class="dhuria-footer-container">
        <div class="dhuria-footer-grid">
            <!-- Brand Column -->
            <div class="dhuria-footer-col dhuria-f-brand">
                <a href="/" style="display:inline-block; margin-bottom: 18px;">
                    <img src="{{ asset('images/dhuria_logo_white.png') }}" alt="dhuria" style="height: 42px; width: auto; object-fit: contain;">
                </a>
                <p class="dhuria-brand-desc">
                    Premium Ayurvedic wellness inspired by the five natural elements. Formulated with authentic botanical extracts for balanced health and vitality.
                </p>
                <div class="dhuria-brand-socials">
                    <a href="{{ \App\Models\Setting::get('social_instagram', 'https://www.instagram.com/ayurvedadhuria/') }}" target="_blank" class="dhuria-bs-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="{{ \App\Models\Setting::get('social_facebook', 'https://www.facebook.com/profile.php?id=61594745097448') }}" target="_blank" class="dhuria-bs-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919318445297') }}" target="_blank" class="dhuria-bs-icon" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="mailto:{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}" class="dhuria-bs-icon" title="Email"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <!-- Navigate Column -->
            <div class="dhuria-footer-col">
                <h4 class="dhuria-f-title">NAVIGATE</h4>
                <ul class="dhuria-f-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('shop') }}">All Products</a></li>
                    <li><a href="{{ route('about') }}">About Our Founder</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Policy Column -->
            <div class="dhuria-footer-col">
                <h4 class="dhuria-f-title">POLICY</h4>
                <ul class="dhuria-f-links">
                    <li><a href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('refund') }}">Refund Policy</a></li>
                    <li><a href="{{ route('shipping') }}">Shipping Policy</a></li>
                    <li><a href="{{ route('cancellation') }}">Cancellation Policy</a></li>
                </ul>
            </div>

            <!-- Contact Us Column -->
            <div class="dhuria-footer-col dhuria-f-contact">
                <h4 class="dhuria-f-title">CONTACT US</h4>
                <div class="dhuria-contact-item">
                    <span class="dhuria-c-label">Email</span>
                    <a href="mailto:{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}" class="dhuria-c-val">{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}</a>
                </div>
                <div class="dhuria-contact-item">
                    <span class="dhuria-c-label">Phone Helpline</span>
                    <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="dhuria-c-val">{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}</a>
                </div>
                <div class="dhuria-contact-item">
                    <span class="dhuria-c-label">Location</span>
                    <span class="dhuria-c-val">{{ \App\Models\Setting::get('site_address', 'Delhi, India') }}</span>
                </div>
                <div class="dhuria-contact-item">
                    <span class="dhuria-c-label">Timings</span>
                    <span class="dhuria-c-val">Mon - Sat: 10:00 AM - 07:00 PM</span>
                </div>
            </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div class="dhuria-copyright-row">
            <div>
                &copy; {{ date('Y') }} Dhuria Healthcare. All rights reserved.
            </div>
            <div>
                100% Certified Ayurvedic Formulations
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Action Button -->
<a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919318445297') }}?text=Hello%20Dhuria%20Healthcare,%20I%20have%20an%20inquiry%20regarding%20products" target="_blank" class="dhuria-float-whatsapp" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<style>
/* 1. Value Proposition Strip */
.dhuria-value-bar {
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    padding: 35px 20px;
}
.dhuria-value-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}
.dhuria-val-col {
    display: flex;
    align-items: center;
    gap: 16px;
}
.dhuria-val-icon {
    font-size: 2rem;
    color: #d4af37;
    flex-shrink: 0;
}
.dhuria-val-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 4px 0;
}
.dhuria-val-sub {
    font-size: 0.8rem;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
}

/* 2. Social Follow Strip */
.dhuria-social-bar {
    background: #0d2544;
    padding: 12px 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.dhuria-social-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dhuria-social-left {
    display: flex;
    align-items: center;
    gap: 12px;
}
.dhuria-s-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.82rem;
    text-decoration: none;
    transition: all 0.2s;
}
.dhuria-s-icon:hover {
    background: #d4af37;
    color: #081a30;
}
.dhuria-social-right {
    font-size: 0.82rem;
    color: #f1f5f9;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* 3. Main Dark Footer */
.dhuria-main-footer {
    background: #061528;
    color: #cbd5e1;
    padding: 60px 20px 25px;
    border-top: 1px solid rgba(212, 175, 55, 0.2);
}
.dhuria-footer-container {
    max-width: 1400px;
    margin: 0 auto;
}
.dhuria-footer-grid {
    display: grid;
    grid-template-columns: 1.4fr 0.8fr 0.8fr 1.2fr;
    gap: 40px;
    margin-bottom: 50px;
}
.dhuria-brand-desc {
    font-size: 0.88rem;
    line-height: 1.65;
    color: #94a3b8;
    max-width: 380px;
    margin-bottom: 20px;
}
.dhuria-brand-socials {
    display: flex;
    gap: 10px;
}
.dhuria-bs-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    color: #cbd5e1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.dhuria-bs-icon:hover {
    background: #d4af37;
    color: #061528;
    transform: translateY(-2px);
}
.dhuria-f-title {
    font-size: 0.85rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    color: #ffffff;
    margin-bottom: 20px;
    text-transform: uppercase;
}
.dhuria-f-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.dhuria-f-links li {
    margin-bottom: 12px;
}
.dhuria-f-links a {
    color: #94a3b8;
    text-decoration: none;
    font-size: 0.88rem;
    transition: all 0.2s;
}
.dhuria-f-links a:hover {
    color: #d4af37;
    padding-left: 4px;
}
.dhuria-contact-item {
    margin-bottom: 12px;
}
.dhuria-c-label {
    display: block;
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}
.dhuria-c-val {
    color: #cbd5e1;
    font-size: 0.88rem;
    text-decoration: none;
    transition: color 0.2s;
}
a.dhuria-c-val:hover {
    color: #d4af37;
}

/* Copyright Row */
.dhuria-copyright-row {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.8rem;
    color: #64748b;
    flex-wrap: wrap;
    gap: 15px;
}

/* Floating WhatsApp Button */
.dhuria-float-whatsapp {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #25d366;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5);
    z-index: 9999;
    text-decoration: none !important;
    transition: all 0.3s ease;
}
.dhuria-float-whatsapp:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.7);
    color: #ffffff;
}

@media (max-width: 992px) {
    .dhuria-value-inner { 
        grid-template-columns: repeat(2, 1fr); 
        gap: 24px 18px;
    }
    .dhuria-footer-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
    .dhuria-value-inner { 
        grid-template-columns: repeat(2, 1fr); 
        gap: 20px 12px;
    }
    .dhuria-val-col {
        flex-direction: column;
        text-align: center;
        align-items: center;
        gap: 8px;
    }
    .dhuria-val-icon {
        font-size: 1.75rem;
        margin-bottom: 2px;
    }
    .dhuria-val-title {
        font-size: 0.85rem;
        font-weight: 800;
        margin-bottom: 2px;
    }
    .dhuria-val-sub {
        font-size: 0.72rem;
        line-height: 1.3;
    }
    .dhuria-footer-grid { grid-template-columns: 1fr; gap: 30px; }
    .dhuria-copyright-row { flex-direction: column; text-align: center; gap: 8px; }
}
</style>
