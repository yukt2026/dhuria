@extends('layouts.frontend')

@section('title', 'Contact Us - Dhuria Ayurveda')

@section('content')

<style>
.dh-contact-wrap {
    max-width: 1250px;
    margin: 0 auto;
    padding: 40px 20px 70px;
}
.dh-contact-header {
    text-align: center;
    margin-bottom: 40px;
}
.dh-contact-kicker {
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 2px;
    color: #b89326;
    text-transform: uppercase;
    display: inline-block;
    margin-bottom: 8px;
}
.dh-contact-title {
    font-family: 'Cinzel', serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: #061528;
    margin: 0 0 12px 0;
}
.dh-contact-sub {
    font-size: 0.95rem;
    color: #64748b;
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.6;
}

/* 3 Quick Cards */
.dh-quick-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 45px;
}
.dh-quick-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s;
}
.dh-quick-card:hover {
    transform: translateY(-4px);
    border-color: #d4af37;
    box-shadow: 0 8px 25px rgba(6, 21, 40, 0.08);
}
.dh-qc-icon-box {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: #061528;
    margin-bottom: 15px;
}
.dh-qc-tag {
    font-size: 0.72rem;
    font-weight: 800;
    color: #64748b;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.dh-qc-val {
    font-size: 1.15rem;
    font-weight: 800;
    color: #061528;
    margin-bottom: 6px;
    text-decoration: none;
    display: block;
}
.dh-qc-note {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 18px;
}
.dh-qc-link {
    font-size: 0.82rem;
    font-weight: 800;
    color: #061528;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
}
.dh-qc-link:hover {
    color: #d4af37;
}

/* Main Split Grid */
.dh-contact-split {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 40px;
    align-items: start;
}

/* Left Form Box */
.dh-inquiry-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.dh-form-group {
    margin-bottom: 18px;
}
.dh-form-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #334155;
    margin-bottom: 6px;
}
.dh-form-input {
    width: 100%;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.9rem;
    color: #0f172a;
    outline: none;
    transition: border-color 0.2s;
}
.dh-form-input:focus {
    border-color: #061528;
}
.dh-btn-send {
    background: #061528;
    color: #ffffff;
    border: 1px solid #d4af37;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.25s;
}
.dh-btn-send:hover {
    background: #0d2544;
    color: #d4af37;
}

/* Right Details Box */
.dh-office-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 25px;
}
.dh-counselor-card {
    background: #0d2544;
    color: #ffffff;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(6, 21, 40, 0.15);
}

@media (max-width: 992px) {
    .dh-quick-cards-grid { grid-template-columns: 1fr; }
    .dh-contact-split { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .dh-contact-wrap { padding: 20px 15px 50px; }
    .dh-contact-title { font-size: 1.8rem; }
    .dh-inquiry-box { padding: 20px; }
    .dh-form-row-2col { grid-template-columns: 1fr !important; }
}
</style>

<div class="dh-contact-wrap">
    <div class="dh-contact-header">
        <span class="dh-contact-kicker">✦ WE'RE HERE TO SUPPORT YOU ✦</span>
        <h1 class="dh-contact-title">Connect with Our Wellness Practitioners</h1>
        <p class="dh-contact-sub">
            Have questions regarding our formulations, order dispatch, or personalized Ayurvedic guidance? Our team in Delhi is always ready to assist you.
        </p>
    </div>

    <!-- 3 Quick Cards -->
    <div class="dh-quick-cards-grid">
        <div class="dh-quick-card">
            <div>
                <div class="dh-qc-icon-box"><i class="bi bi-telephone"></i></div>
                <div class="dh-qc-tag">HELPLINE PHONE</div>
                <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="dh-qc-val">{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}</a>
                <div class="dh-qc-note">Mon - Sat: 10:00 AM - 07:00 PM IST</div>
            </div>
            <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="dh-qc-link">Call Now <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="dh-quick-card">
            <div>
                <div class="dh-qc-icon-box"><i class="bi bi-whatsapp text-green-600"></i></div>
                <div class="dh-qc-tag">INSTANT CHAT</div>
                <div class="dh-qc-val">WhatsApp Support</div>
                <div class="dh-qc-note">Quick responses within 15 minutes</div>
            </div>
            <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919318445297') }}" target="_blank" class="dh-qc-link">Start WhatsApp Chat <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="dh-quick-card">
            <div>
                <div class="dh-qc-icon-box"><i class="bi bi-envelope"></i></div>
                <div class="dh-qc-tag">EMAIL INQUIRIES</div>
                <a href="mailto:{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}" class="dh-qc-val" style="font-size:0.95rem;">{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}</a>
                <div class="dh-qc-note">Response within 24 hours guaranteed</div>
            </div>
            <a href="mailto:{{ \App\Models\Setting::get('site_email', 'dhuriaayurveda@gmail.com') }}" class="dh-qc-link">Send Email <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <!-- Main Split Grid -->
    <div class="dh-contact-split">
        <!-- Left: Inquiry Form -->
        <div class="dh-inquiry-box">
            <span style="font-size:0.75rem; font-weight:800; color:#b89326; letter-spacing:1px; text-transform:uppercase;">DIRECT MESSAGE</span>
            <h2 style="font-family:'Cinzel',serif; font-size:1.6rem; font-weight:800; color:#061528; margin:4px 0 16px 0;">Send Us an Inquiry</h2>
            <p style="font-size:0.88rem; color:#64748b; margin-bottom:20px;">Fill in your details and our Ayurvedic advisors will get back to you with personalized assistance.</p>

            <form onsubmit="event.preventDefault(); alert('Thank you! Your inquiry has been submitted. Our Ayurvedic practitioners will contact you shortly.'); this.reset();">
                <div class="dh-form-row-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                    <div class="dh-form-group">
                        <label class="dh-form-label">Your Full Name *</label>
                        <input type="text" class="dh-form-input" placeholder="e.g. Ramesh Kumar" required>
                    </div>
                    <div class="dh-form-group">
                        <label class="dh-form-label">Phone / WhatsApp *</label>
                        <input type="text" class="dh-form-input" placeholder="e.g. 9876543210" required>
                    </div>
                </div>

                <div class="dh-form-row-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                    <div class="dh-form-group">
                        <label class="dh-form-label">Email Address (Optional)</label>
                        <input type="email" class="dh-form-input" placeholder="e.g. ramesh@example.com">
                    </div>
                    <div class="dh-form-group">
                        <label class="dh-form-label">Topic / Category</label>
                        <select class="dh-form-input" style="height:44px;">
                            <option>Product Inquiry (MadhuCurex / Liver Detox / Pilecurex)</option>
                            <option>Order Status / Shipping Assistance</option>
                            <option>Dosage Guidance / Ayurvedic Consultation</option>
                            <option>Bulk Order / Other Question</option>
                        </select>
                    </div>
                </div>

                <div class="dh-form-group">
                    <label class="dh-form-label">Your Message or Health Concern</label>
                    <textarea class="dh-form-input" rows="4" placeholder="Tell us about your questions or requirements..."></textarea>
                </div>

                <button type="submit" class="dh-btn-send">
                    <i class="bi bi-send-fill"></i> SEND MESSAGE
                </button>
            </form>
        </div>

        <!-- Right: Office & Counselor -->
        <div>
            <div class="dh-office-box">
                <span style="font-size:0.75rem; font-weight:800; color:#64748b; letter-spacing:1px; text-transform:uppercase;">REGISTERED OFFICE &amp; DISPATCH</span>
                <h4 style="font-size:1.15rem; font-weight:800; color:#061528; margin:6px 0 12px 0;">Dhuria Healthcare</h4>
                <div style="display:flex; align-items:center; gap:8px; font-size:0.88rem; color:#475569; margin-bottom:8px;">
                    <i class="bi bi-geo-alt-fill text-yellow-600"></i> Delhi, India
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:0.88rem; color:#475569; margin-bottom:8px;">
                    <i class="bi bi-clock-fill text-yellow-600"></i> Monday to Saturday: 10:00 AM - 07:00 PM IST
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:0.88rem; color:#475569;">
                    <i class="bi bi-patch-check-fill text-green-600"></i> Ayurvedic Formulations &amp; Dispatch Center
                </div>
            </div>

            <div class="dh-counselor-card">
                <span style="font-size:0.75rem; font-weight:800; color:#fde68a; letter-spacing:1px; text-transform:uppercase;">FREE HEALTH GUIDANCE</span>
                <h4 style="font-size:1.25rem; font-weight:800; color:#fff; margin:6px 0 10px 0;">Consult an Ayurvedic Counselor</h4>
                <p style="font-size:0.85rem; color:#cbd5e1; line-height:1.5; margin-bottom:18px;">
                    Have queries regarding diabetes management, metabolic balance, or digestive health? Connect directly with our certified practitioners.
                </p>
                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919318445297') }}?text=Hello%20Dhuria%20Healthcare,%20I%20would%20like%20to%20consult%20an%20Ayurvedic%20Counselor" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:#d4af37; color:#061528; padding:10px 22px; border-radius:30px; font-size:0.85rem; font-weight:800; text-decoration:none;">
                    <span>BOOK CONSULTATION</span> <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:16px 20px; font-size:0.82rem; color:#64748b; line-height:1.5;">
                <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px; font-weight:700; color:#061528;">
                    <i class="bi bi-shield-check text-green-600"></i> Our Commitment to You:
                </div>
                &bull; 100% confidential and secure medical privacy<br>
                &bull; Genuine, lab-tested classical Ayurvedic advice<br>
                &bull; Zero spam, zero unwanted promotional calls
            </div>
        </div>
    </div>
</div>

@endsection
