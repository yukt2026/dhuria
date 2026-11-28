@extends('layouts.frontend')

@section('title', 'Cancellation Policy - Dhuria Ayurveda')

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
.dh-policy-sec-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #061528;
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
        <span class="dh-policy-kicker">✦ ORDER ADJUSTMENT ✦</span>
        <h1 class="dh-policy-title">Cancellation Policy</h1>
        <p class="dh-policy-sub">Simple and transparent order cancellation process before dispatch.</p>
    </div>

    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">Cancellation Before Dispatch</div>
        <p class="dh-policy-text">You may cancel your order at any time before the consignment is dispatched from our Delhi fulfillment facility. Once a courier tracking AWB is generated, orders cannot be cancelled and must follow our standard return process.</p>
    </div>

    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">Immediate Full Refund</div>
        <p class="dh-policy-text">For cancelled prepaid orders, 100% of the transaction amount is refunded immediately via Razorpay back to your original payment method (Cards/UPI/Net-Banking) without any cancellation fee deduction.</p>
    </div>

    <!-- Still Have Questions Box -->
    <div class="dh-questions-box">
        <h3 style="font-family:'Cinzel',serif; font-size:1.8rem; font-weight:800; color:#fff; margin:0 0 8px 0;">Still have questions?</h3>
        <p style="font-size:0.9rem; color:#cbd5e1; margin-bottom:25px;">Contact our dispatch team for urgent order cancellations.</p>
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
