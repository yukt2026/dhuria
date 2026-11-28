@extends('layouts.frontend')

@section('title', 'Checkout - Dhuria')

@section('content')
    @php
        $address1 = '';
        $address2 = '';
        if (auth()->check() && auth()->user()->address) {
            $parts = explode("\n", auth()->user()->address, 2);
            $address1 = $parts[0] ?? '';
            $address2 = $parts[1] ?? '';
            
            if (empty($address2) && str_contains($address1, ',')) {
                $parts = explode(',', $address1, 2);
                $address1 = trim($parts[0]);
                $address2 = trim($parts[1]);
            }
        }
    @endphp

    <div class="bg-slate-50 py-8 md:py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs / Kicker -->
            <div class="mb-6">
                <span class="text-[11px] font-extrabold tracking-widest uppercase text-slate-400 block mb-1">FINAL STEP</span>
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#081a30] tracking-tight">Checkout</h1>
                    <nav class="flex items-center space-x-2 text-xs text-slate-400">
                        <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Home</a>
                        <span>/</span>
                        <a href="{{ route('cart.index') }}" class="hover:text-primary transition-colors">Cart</a>
                        <span>/</span>
                        <span class="text-slate-800 font-bold">Checkout</span>
                    </nav>
                </div>
            </div>

            <!-- Flash Alerts -->
            @if(session('warning'))
                <div class="mb-6 flex items-center gap-3 bg-amber-50 border border-amber-200 text-amber-900 rounded-xl px-4 py-3 text-xs font-medium shadow-xs">
                    <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-900 rounded-xl px-4 py-3 text-xs font-medium shadow-xs">
                    <i class="fa-solid fa-circle-xmark text-rose-600"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if (isset($errors) && $errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-6 shadow-xs text-xs">
                    <div class="flex items-center gap-2 font-bold mb-1">
                        <i class="fa-solid fa-triangle-exclamation"></i> Please fix the following errors:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $defaultAddress = auth()->check() ? auth()->user()->addresses()->where('is_default', true)->first() : null;
                $defaultAddressId = $defaultAddress ? $defaultAddress->id : 'new';
            @endphp

            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form"
                  x-data="{ selectedAddressId: '{{ $defaultAddressId }}', paymentMethod: 'razorpay', agreeTerms: true }">
                @csrf
                <input type="hidden" name="delivery_type" value="online_delivery">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Column: Delivery Address & Payment Method -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- 1. Delivery Address Card -->
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 md:p-8 shadow-xs">
                            <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 flex-wrap gap-2">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900">Delivery Address</h2>
                                    <p class="text-xs text-slate-400 mt-0.5">Where should we deliver your order?</p>
                                </div>
                                <button type="button" id="detect-location-btn" onclick="detectUserLocation(this)" 
                                        class="text-xs text-[#081a30] bg-slate-100 hover:bg-slate-200 border border-slate-300 rounded-lg px-3 py-1.5 font-bold flex items-center gap-1.5 transition">
                                    <i class="fa-solid fa-location-crosshairs text-[11px]"></i> Auto-Detect Location
                                </button>
                            </div>

                            @auth
                                @php
                                    $userAddresses = auth()->user()->addresses;
                                @endphp
                                @if($userAddresses->isNotEmpty())
                                    <div class="mb-6 space-y-3">
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Saved Addresses</label>
                                        <div class="grid grid-cols-1 gap-2.5 max-h-56 overflow-y-auto pr-1">
                                            @foreach($userAddresses as $addr)
                                                <label class="relative flex items-start p-3.5 border-2 rounded-xl cursor-pointer transition-all bg-white"
                                                       :class="selectedAddressId == '{{ $addr->id }}' ? 'border-[#081a30] bg-slate-50/50' : 'border-slate-200'">
                                                    <input type="radio" name="selected_address_id" value="{{ $addr->id }}" {{ $addr->is_default ? 'checked' : '' }}
                                                           @click="selectedAddressId = '{{ $addr->id }}';"
                                                           class="mt-1 h-4 w-4 text-[#081a30] border-slate-300 focus:ring-[#081a30]">
                                                    <div class="ml-3 flex-1 text-xs">
                                                        <div class="flex items-center gap-2">
                                                            <strong class="text-slate-900">{{ $addr->address }}@if($addr->address2), {{ $addr->address2 }}@endif</strong>
                                                            @if($addr->is_default)
                                                                <span class="text-[9px] bg-emerald-500 text-white font-extrabold px-1.5 py-0.5 rounded uppercase">Default</span>
                                                            @endif
                                                        </div>
                                                        <p class="text-slate-600 mt-0.5">{{ $addr->city }}, {{ $addr->state }} - {{ $addr->zip }}</p>
                                                        <p class="text-slate-400 text-[11px] mt-0.5">Phone: {{ $addr->phone }}</p>
                                                    </div>
                                                </label>
                                            @endforeach

                                            <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all bg-slate-50"
                                                   :class="selectedAddressId == 'new' ? 'border-[#081a30] bg-slate-50/50' : 'border-slate-200'">
                                                <input type="radio" name="selected_address_id" value="new" {{ !$defaultAddress ? 'checked' : '' }}
                                                       @click="selectedAddressId = 'new';"
                                                       class="h-4 w-4 text-[#081a30] border-slate-300 focus:ring-[#081a30]">
                                                <span class="ml-3 text-xs font-bold text-slate-900 flex items-center gap-2">
                                                    <i class="fa-solid fa-plus text-[#081a30]"></i> Add New Address
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endauth

                            <div x-show="selectedAddressId === 'new'" class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name <span class="text-rose-500">*</span></label>
                                    <input type="text" name="shipping_name" value="{{ old('shipping_name', auth()->check() ? auth()->user()->name : '') }}" required 
                                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="Enter your full name">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Phone Number <span class="text-rose-500">*</span></label>
                                        <input type="text" name="shipping_phone" value="{{ old('shipping_phone', auth()->check() ? auth()->user()->phone : '') }}" required 
                                               class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="10-digit Mobile Number">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address <span class="text-rose-500">*</span></label>
                                        <input type="email" name="shipping_email" value="{{ old('shipping_email', auth()->check() ? auth()->user()->email : '') }}" required 
                                               class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="name@example.com">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Complete Address <span class="text-rose-500">*</span></label>
                                    <input type="text" name="shipping_address" value="{{ old('shipping_address', $address1) }}" :required="selectedAddressId === 'new'" 
                                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition mb-2" placeholder="House/Flat No., Building name, Street">
                                    <input type="text" name="shipping_address2" value="{{ old('shipping_address2', $address2) }}" 
                                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="Colony, Landmark, Area (Optional)">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">City <span class="text-rose-500">*</span></label>
                                        <input type="text" name="shipping_city" value="{{ old('shipping_city', auth()->check() ? auth()->user()->city : '') }}" :required="selectedAddressId === 'new'" 
                                               class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="City">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">State <span class="text-rose-500">*</span></label>
                                        <input type="text" name="shipping_state" value="{{ old('shipping_state', auth()->check() ? auth()->user()->state : '') }}" :required="selectedAddressId === 'new'" 
                                               class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="State">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Pincode <span class="text-rose-500">*</span></label>
                                        <input type="text" name="shipping_zip" value="{{ old('shipping_zip', auth()->check() ? auth()->user()->zip : '') }}" :required="selectedAddressId === 'new'" 
                                               class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="6-digit Pincode">
                                    </div>
                                </div>

                                @auth
                                    <div class="flex items-center gap-2 pt-2">
                                        <input type="checkbox" name="is_default" id="is_default" value="1" class="rounded border-slate-300 text-[#081a30] focus:ring-[#081a30] h-4 w-4">
                                        <label for="is_default" class="text-xs text-slate-700 select-none cursor-pointer">Save this address for future orders</label>
                                    </div>
                                @endauth
                            </div>

                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Order Notes (Optional)</label>
                                <textarea name="notes" rows="2" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-xs text-slate-900 font-medium focus:outline-none focus:border-[#081a30] focus:ring-1 focus:ring-[#081a30] transition" placeholder="Special delivery instructions or landmark details.">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- 2. Payment Method Card -->
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 md:p-8 shadow-xs">
                            <div class="pb-4 mb-6 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-slate-900">Payment Method</h2>
                                <p class="text-xs text-slate-400 mt-0.5">Select how you want to pay</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Online Payment (Razorpay) -->
                                <label class="relative flex items-start p-4 border-2 rounded-xl cursor-pointer transition-all bg-white"
                                       :class="paymentMethod === 'razorpay' ? 'border-[#081a30] bg-slate-50/60 ring-1 ring-[#081a30]' : 'border-slate-200 hover:border-slate-300'">
                                    <input type="radio" name="payment_method" value="razorpay" @click="paymentMethod = 'razorpay'" checked
                                           class="mt-1 h-4 w-4 text-[#081a30] focus:ring-[#081a30] border-slate-300">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-slate-900 text-xs">Online Payment</span>
                                            <span class="text-[9px] bg-blue-600 text-white font-extrabold px-1.5 py-0.5 rounded">Fast</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 leading-relaxed">Credit / Debit Card, NetBanking, UPI (PhonePe, GPay, Paytm) & Wallets</p>
                                    </div>
                                </label>

                                <!-- Cash on Delivery (COD) -->
                                <label class="relative flex items-start p-4 border-2 rounded-xl cursor-pointer transition-all bg-white"
                                       :class="paymentMethod === 'cod' ? 'border-[#081a30] bg-slate-50/60 ring-1 ring-[#081a30]' : 'border-slate-200 hover:border-slate-300'">
                                    <input type="radio" name="payment_method" value="cod" @click="paymentMethod = 'cod'"
                                           class="mt-1 h-4 w-4 text-[#081a30] focus:ring-[#081a30] border-slate-300">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-slate-900 text-xs">Cash on Delivery</span>
                                            <span class="text-[9px] bg-emerald-600 text-white font-extrabold px-1.5 py-0.5 rounded">Standard</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 leading-relaxed">Pay with cash upon arrival at your doorstep</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Order Summary (Midnight Navy Card matching Image 9) -->
                    <div class="lg:col-span-5">
                        <div class="bg-[#0c1e34] border border-slate-800 rounded-2xl p-6 sm:p-7 text-white sticky top-28 shadow-xl shadow-slate-950/20">
                            
                            <!-- Header -->
                            <div class="flex items-center justify-between pb-4 mb-4 border-b border-white/10">
                                <h3 class="text-base font-extrabold text-white tracking-tight">Order Summary</h3>
                                <span class="bg-white/10 text-slate-300 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                    {{ count($cart) }} {{ count($cart) === 1 ? 'Item' : 'Items' }}
                                </span>
                            </div>

                            <!-- Products List -->
                            <div class="divide-y divide-white/10 max-h-72 overflow-y-auto pr-1 mb-5 custom-dark-scroll">
                                @foreach($cart as $id => $item)
                                    @php
                                        $liveProduct = \App\Models\Product::find($id);
                                        $itemName = $liveProduct ? $liveProduct->name : $item['name'];
                                        $itemPrice = $liveProduct ? ($liveProduct->sale_price ?? $liveProduct->price) : $item['price'];
                                        $itemImage = $liveProduct ? $liveProduct->primary_image_url : $item['image'];
                                    @endphp
                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center space-x-3 min-w-0">
                                            <div class="w-12 h-12 flex-shrink-0 bg-white/5 border border-white/10 rounded-xl p-1 flex items-center justify-center">
                                                <img src="{{ $itemImage }}" alt="{{ $itemName }}" class="max-w-full max-h-full object-contain">
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h4 class="font-bold text-white text-xs leading-snug truncate" title="{{ $itemName }}">{{ $itemName }}</h4>
                                                <div class="flex items-center gap-1.5 text-[11px] text-slate-400 mt-0.5">
                                                    <span>Qty: {{ $item['quantity'] }}</span>
                                                    <span>×</span>
                                                    <span>&#8377;{{ number_format($itemPrice, 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="font-black text-amber-400 text-xs pl-2 flex-shrink-0">
                                            &#8377;{{ number_format($itemPrice * $item['quantity'], 0) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Coupon Code Form -->
                            @if(session('coupon'))
                                <div class="mb-5 pb-5 border-b border-white/10">
                                    <div class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/25 rounded-xl px-3.5 py-2.5">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-ticket text-amber-400 text-sm"></i>
                                            <div>
                                                <div class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">Coupon Applied</div>
                                                <div class="text-xs font-black text-white">{{ session('coupon.code') }}</div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="removeCoupon()" class="text-xs text-rose-400 hover:text-rose-300 font-bold hover:underline transition">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="mb-5 pb-5 border-b border-white/10">
                                    <div class="flex gap-2">
                                        <input type="text" id="coupon_code" placeholder="Enter coupon code" 
                                               class="flex-1 bg-white/10 border border-white/15 rounded-xl px-3.5 py-2.5 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-amber-400">
                                        <button type="button" onclick="applyCoupon()" 
                                                class="bg-[#d4af37] hover:bg-[#e5c04b] text-slate-950 font-extrabold text-xs px-4 py-2.5 rounded-xl transition">
                                            Apply
                                        </button>
                                    </div>
                                    <div id="coupon-msg" class="text-[11px] mt-1.5 hidden"></div>
                                </div>
                            @endif

                            <!-- Cost Breakdown -->
                            <div class="space-y-2.5 mb-5 text-xs">
                                <div class="flex justify-between text-slate-300">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-white">&#8377;{{ number_format($subtotal, 2) }}</span>
                                </div>

                                @if(isset($discountAmount) && $discountAmount > 0)
                                    <div class="flex justify-between text-emerald-400 font-bold">
                                        <span>Coupon Discount</span>
                                        <span>-&#8377;{{ number_format($discountAmount, 2) }}</span>
                                    </div>
                                @endif

                                <div class="flex justify-between text-slate-300 items-center">
                                    <span>Shipping</span>
                                    <span class="text-emerald-400 font-black bg-emerald-500/20 px-2 py-0.5 rounded text-[10px] uppercase tracking-wider">FREE</span>
                                </div>

                                <div class="pt-3 border-t border-white/10 flex justify-between items-baseline">
                                    <div>
                                        <span class="text-sm font-bold text-white block">Total</span>
                                        <span class="text-[10px] text-slate-400">Inclusive of all taxes</span>
                                    </div>
                                    <span class="text-2xl font-black text-amber-400 tracking-tight">
                                        &#8377;{{ number_format(isset($total) ? $total : $subtotal, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Terms & Conditions Agreement -->
                            <div class="mb-5 pt-3 border-t border-white/10">
                                <label class="flex items-start gap-2.5 cursor-pointer text-xs text-slate-300">
                                    <input type="checkbox" x-model="agreeTerms" required class="rounded border-slate-600 bg-white/10 text-amber-400 focus:ring-amber-400 h-4 w-4 mt-0.5">
                                    <span class="text-[11px] leading-tight">
                                        I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-amber-400 underline hover:text-amber-300">Terms & Conditions</a> and <a href="{{ route('privacy') }}" target="_blank" class="text-amber-400 underline hover:text-amber-300">Privacy Policy</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" :disabled="!agreeTerms"
                                    class="w-full bg-[#d4af37] hover:bg-[#e5c04b] text-slate-950 font-black py-4 px-4 rounded-xl text-xs uppercase tracking-wider transition-all duration-200 shadow-lg shadow-amber-500/20 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2">
                                <span x-show="paymentMethod === 'razorpay'">PAY WITH RAZORPAY</span>
                                <span x-show="paymentMethod === 'cod'">PLACE CASH ON DELIVERY ORDER</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </button>

                            <!-- Trust Badges & Support -->
                            <div class="mt-5 pt-4 border-t border-white/10 space-y-2 text-center">
                                <p class="text-[11px] text-slate-400 flex items-center justify-center gap-1.5 font-medium">
                                    <i class="fa-solid fa-lock text-emerald-400"></i>
                                    <span>Secure Checkout: 256-Bit SSL Encrypted Payment</span>
                                </p>
                                <p class="text-[11px] text-slate-400">
                                    NEED HELP? Contact Support at <a href="tel:{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}" class="text-amber-400 font-bold hover:underline">{{ \App\Models\Setting::get('site_phone', '+91 9318445297') }}</a>
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function applyCoupon() {
        const code = document.getElementById('coupon_code').value.trim();
        const msg = document.getElementById('coupon-msg');
        if (!code) {
            msg.className = 'text-[11px] mt-1.5 text-amber-400 block';
            msg.innerText = 'Please enter a coupon code.';
            return;
        }

        fetch('{{ route('cart.applyCoupon') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ coupon_code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                msg.className = 'text-[11px] mt-1.5 text-emerald-400 block';
                msg.innerText = data.message || 'Coupon applied successfully!';
                setTimeout(() => window.location.reload(), 800);
            } else {
                msg.className = 'text-[11px] mt-1.5 text-rose-400 block';
                msg.innerText = data.message || 'Invalid coupon code.';
            }
        })
        .catch(err => {
            msg.className = 'text-[11px] mt-1.5 text-rose-400 block';
            msg.innerText = 'Error applying coupon. Please try again.';
        });
    }

    function removeCoupon() {
        fetch('{{ route('cart.removeCoupon') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            window.location.reload();
        })
        .catch(err => {
            window.location.reload();
        });
    }

    window.detectUserLocation = function(buttonElem) {
        const btn = buttonElem || document.getElementById('detect-location-btn');
        if (!btn) return;
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Detecting...';

        const newAddrRadio = document.querySelector('input[name="selected_address_id"][value="new"]');
        if (newAddrRadio && !newAddrRadio.checked) {
            newAddrRadio.click();
        }

        function populate(data) {
            btn.disabled = false;
            btn.innerHTML = originalText;
            if (data && data.success) {
                const addrInput  = document.querySelector('input[name="shipping_address"]');
                const addr2Input = document.querySelector('input[name="shipping_address2"]');
                const cityInput  = document.querySelector('input[name="shipping_city"]');
                const stateInput = document.querySelector('input[name="shipping_state"]');
                const zipInput   = document.querySelector('input[name="shipping_zip"]');

                if (addrInput)  addrInput.value  = data.address  || '';
                if (addr2Input) addr2Input.value = data.address2 || '';
                if (cityInput)  cityInput.value  = data.city     || '';
                if (stateInput) stateInput.value = data.state    || '';
                if (zipInput)   zipInput.value   = data.zip      || '';

                alert('Location detected successfully!');
            } else {
                alert('Could not auto-detect location. Please enter manually.');
            }
        }

        function fetchLocation(url) {
            fetch(url)
                .then(res => res.json())
                .then(data => populate(data))
                .catch(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    alert('Could not auto-detect location. Please enter manually.');
                });
        }

        if (!navigator.geolocation) {
            fetchLocation('/api/reverse-geocode');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function(position) {
                fetchLocation(`/api/reverse-geocode?lat=${position.coords.latitude}&lon=${position.coords.longitude}`);
            },
            function(error) {
                fetchLocation('/api/reverse-geocode');
            },
            { enableHighAccuracy: true, timeout: 8000 }
        );
    };
</script>
@endpush
