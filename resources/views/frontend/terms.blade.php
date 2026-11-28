@extends('layouts.frontend')

@section('title', 'Terms & Conditions - Dhuria Ayurveda')

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

/* Still Have Questions Box matching screenshot */
.dh-questions-box {
    background: #0d2544;
    color: #ffffff;
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    margin-top: 50px;
    box-shadow: 0 10px 30px rgba(6, 21, 40, 0.15);
}
.dh-qb-title {
    font-family: 'Cinzel', serif;
    font-size: 1.8rem;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 8px 0;
}
.dh-qb-sub {
    font-size: 0.9rem;
    color: #cbd5e1;
    margin-bottom: 25px;
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
        <span class="dh-policy-kicker">✦ STORE STANDARDS ✦</span>
        <h1 class="dh-policy-title">Terms &amp; Conditions</h1>
        <p class="dh-policy-sub">Please read these terms carefully before purchasing our products, as you agree to be bound by them.</p>
    </div>

    <!-- 1. Ownership -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">1</span> Ownership
        </div>
        <p class="dh-policy-text">
            This website and all its content are the intellectual property of Dhuria Healthcare. This includes all brand formulations (such as MadhuCurex, Liver Detox, Pilecurex), product logos, clinical descriptions, graphics, and proprietary text. Downloading or reproducing content without explicit consent is strictly prohibited.
        </p>
    </div>

    <!-- 2. Eligibility -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">2</span> Eligibility
        </div>
        <p class="dh-policy-text">
            By accessing or ordering from this platform, you affirm that you are at least 18 years of age and that all delivery and payment details provided are genuine, complete, and accurate.
        </p>
    </div>

    <!-- 3. Medical Disclaimer -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">3</span> Medical &amp; Health Disclaimer
        </div>
        <p class="dh-policy-text">
            Our products are 100% natural Ayurvedic food supplements and traditional botanical rasayanas. Information provided on this platform is for educational and wellness guidance only and is not intended to substitute professional medical advice, diagnosis, or clinical treatment. If pregnant, nursing, or on prescription medication, consult a certified physician prior to use.
        </p>
    </div>

    <!-- 4. Pricing & Orders -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">4</span> Pricing &amp; Orders
        </div>
        <p class="dh-policy-text">
            All prices are listed in Indian Rupees (₹) and include applicable GST taxes. We reserve the right to modify promotional discounts or decline orders in the event of stock unavailability or technical payment anomalies.
        </p>
    </div>

    <!-- 5. Payments -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">5</span> Secure Payments
        </div>
        <p class="dh-policy-text">
            We support 100% encrypted online payments powered by Razorpay, including UPI, Credit/Debit Cards, Net-Banking, and Cash on Delivery (COD) across serviceable postal pincodes in India.
        </p>
    </div>

    <!-- 6. Limitation of Liability -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">6</span> Limitation of Liability
        </div>
        <p class="dh-policy-text">
            Dhuria Healthcare shall not be held liable for personal adverse reactions resulting from undisclosed medical allergies, misuse of products, or failure to follow recommended dosage instructions.
        </p>
    </div>

    <!-- 7. Contact Information -->
    <div class="dh-policy-section">
        <div class="dh-policy-sec-title">
            <span class="dh-policy-num">7</span> Contact Information
        </div>
        <p class="dh-policy-text">
            For questions regarding these Terms &amp; Conditions, reach our legal desk at <a href="mailto:dhuriaayurveda@gmail.com" style="color:#d4af37; font-weight:700;">dhuriaayurveda@gmail.com</a> or phone helpline <a href="tel:+919318445297" style="color:#d4af37; font-weight:700;">+91 9318445297</a>.
        </p>
    </div>

    <!-- Still Have Questions Box -->
    <div class="dh-questions-box">
        <h3 class="dh-qb-title">Still have questions?</h3>
        <p class="dh-qb-sub">Our practitioners and support team are here to help you with any queries regarding our policies or rituals.</p>
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
