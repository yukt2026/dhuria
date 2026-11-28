@extends('layouts.frontend')

@section('title', 'Privacy Policy - Dhuria Ayurveda')

@section('content')

<style>
.dh-policy-wrap {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 20px 70px;
}
.dh-policy-header {
    text-align: center;
    margin-bottom: 40px;
}
.dh-policy-kicker {
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 2px;
    color: #b89326;
    text-transform: uppercase;
    display: inline-block;
    margin-bottom: 8px;
}
.dh-policy-title {
    font-family: 'Cinzel', serif;
    font-size: 2.4rem;
    font-weight: 800;
    color: #061528;
    margin: 0 0 10px 0;
}
.dh-policy-sub {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
}
.dh-policy-section {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px 28px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}
.dh-policy-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #061528;
    font-size: 0.85rem;
    font-weight: 800;
    margin-right: 10px;
}
.dh-policy-sec-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #061528;
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}
.dh-policy-text {
    font-size: 0.9rem;
    color: #475569;
    line-height: 1.7;
    margin: 0;
}
.dh-questions-box {
    background: #0d2544;
    color: #ffffff;
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    margin-top: 50px;
    box-shadow: 0 10px 30px rgba(6, 21, 40, 0.15);
}
.dh-qb-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
.dh-qb-card {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    padding: 16px;
    color: #f1f5f9;
    text-decoration: none;
    transition: all 0.2s;
}
.dh-qb-card:hover {
    background: rgba(212, 175, 55, 0.2);
    border-color: #d4af37;
    color: #ffffff;
}
</style>

<div class="dh-policy-wrap">
    <div class="dh-policy-header">
        <span class="dh-policy-kicker">✦ DATA PRIVACY &amp; SECURITY ✦</span>
        <h1 class="dh-policy-title">Privacy Policy</h1>
        <p class="dh-policy-sub">How we collect, protect, and handle your personal data and digital privacy.</p>
    </div>

    <div class="dh-policy-section">
        <div class="dh-policy-sec-title"><span class="dh-policy-num">1</span> Information We Collect</div>
        <p class="dh-policy-text">When you place an order or contact our Ayurvedic consultation desk, we collect essential details including your name, contact phone, delivery address, and payment preferences.</p>
    </div>

    <div class="dh-policy-section">
        <div class="dh-policy-sec-title"><span class="dh-policy-num">2</span> How We Use Your Data</div>
        <p class="dh-policy-text">Your information is used strictly to process orders, generate shipping waybills, communicate tracking updates, and deliver customized wellness recommendations. We never sell or rent your personal health data to third-party advertisers.</p>
    </div>

    <div class="dh-policy-section">
        <div class="dh-policy-sec-title"><span class="dh-policy-num">3</span> 256-Bit SSL Payment Encryption</div>
        <p class="dh-policy-text">All financial transactions are handled via Razorpay’s PCI-DSS compliant payment gateway with bank-grade encryption. We do not store your credit card or UPI PIN numbers on our servers.</p>
    </div>

    <!-- Still Have Questions Box -->
    <div class="dh-questions-box">
        <h3 style="font-family:'Cinzel',serif; font-size:1.8rem; font-weight:800; color:#fff; margin:0 0 8px 0;">Still have questions?</h3>
        <p style="font-size:0.9rem; color:#cbd5e1; margin-bottom:25px;">Our team is here to assist with any questions about your data privacy.</p>
        <div class="dh-qb-grid">
            <a href="mailto:dhuriaayurveda@gmail.com" class="dh-qb-card">
                <i class="bi bi-envelope" style="font-size:1.4rem; display:block; margin-bottom:6px;"></i>
                <span style="font-size:0.8rem; font-weight:700;">dhuriaayurveda@gmail.com</span>
                <span style="display:block; font-size:0.7rem; color:#cbd5e1;">Email Support</span>
            </a>
            <a href="tel:+919318445297" class="dh-qb-card">
                <i class="bi bi-telephone" style="font-size:1.4rem; display:block; margin-bottom:6px;"></i>
                <span style="font-size:0.8rem; font-weight:700;">+91 9318445297</span>
                <span style="display:block; font-size:0.7rem; color:#cbd5e1;">Mon - Sat (10am - 7pm)</span>
            </a>
            <a href="{{ route('contact') }}" class="dh-qb-card">
                <i class="bi bi-chat-dots" style="font-size:1.4rem; display:block; margin-bottom:6px;"></i>
                <span style="font-size:0.8rem; font-weight:700;">Contact Desk</span>
                <span style="display:block; font-size:0.7rem; color:#cbd5e1;">Reach Out Instantly</span>
            </a>
        </div>
    </div>
</div>

@endsection
