@extends('layouts.admin')

@section('header_title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 shadow-xs">
    
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="font-serif font-bold text-slate-800 text-lg">Edit: {{ $product->name }}</h3>
            <span class="text-xs text-slate-450 mt-1 block">Last updated: {{ $product->updated_at->format('M d, Y g:i A') }}</span>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-400 hover:text-slate-600 flex items-center space-x-1">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Products</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-xl text-rose-800 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required placeholder="e.g. Premium Sparkling Beverage 355ml"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- Category -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Category *</label>
                <select name="category_id" required class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5 bg-white">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Price -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Regular Price (&#8377;) *</label>
                <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required placeholder="e.g. 250.00"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- Sale Price -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Sale Price (&#8377;) (Optional)</label>
                <input type="number" name="sale_price" step="0.01" min="0" value="{{ old('sale_price', $product->sale_price) }}" placeholder="e.g. 199.00"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- GST Rate (%) -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">GST Rate (%)</label>
                    <div class="flex space-x-1">
                        <button type="button" onclick="document.getElementById('gst_input').value=0" class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 hover:bg-[#C49A6C] hover:text-white transition cursor-pointer font-semibold">0%</button>
                        <button type="button" onclick="document.getElementById('gst_input').value=5" class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 hover:bg-[#C49A6C] hover:text-white transition cursor-pointer font-semibold">5%</button>
                        <button type="button" onclick="document.getElementById('gst_input').value=12" class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 hover:bg-[#C49A6C] hover:text-white transition cursor-pointer font-semibold">12%</button>
                        <button type="button" onclick="document.getElementById('gst_input').value=18" class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 hover:bg-[#C49A6C] hover:text-white transition cursor-pointer font-semibold">18%</button>
                        <button type="button" onclick="document.getElementById('gst_input').value=28" class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 hover:bg-[#C49A6C] hover:text-white transition cursor-pointer font-semibold">28%</button>
                    </div>
                </div>
                <input type="number" id="gst_input" name="gst" step="0.01" min="0" max="100" value="{{ old('gst', $product->gst ?? 0) }}" placeholder="e.g. 18"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- HSN Code -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">HSN / SAC Code (Optional)</label>
                <input type="text" name="hsn_code" value="{{ old('hsn_code', $product->hsn_code) }}" placeholder="e.g. 33074100"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- SKU -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">SKU (Optional)</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="Leave blank to auto-generate"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>

            <!-- Stock Quantity -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Stock Quantity *</label>
                <input type="number" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required placeholder="e.g. 100"
                       class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
            </div>
        </div>

        <!-- Short Description -->
        <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Short Description</label>
            <textarea name="short_description" rows="2" placeholder="Brief tagline or features list..."
                      class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <!-- Long Description -->
        <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Detailed Description</label>
            <textarea name="description" rows="5" placeholder="Detailed benefits, ingredient composition, how to use..."
                      class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Checkbox Switches -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-4">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))
                       class="rounded border-slate-350 text-[#C49A6C] focus:ring-[#C49A6C] h-4.5 w-4.5">
                <span class="text-sm font-semibold text-slate-700">Featured</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="is_bestseller" value="1" @checked(old('is_bestseller', $product->is_bestseller))
                       class="rounded border-slate-350 text-[#C49A6C] focus:ring-[#C49A6C] h-4.5 w-4.5">
                <span class="text-sm font-semibold text-slate-700">Bestseller</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="deal_of_week" value="1" @checked(old('deal_of_week', $product->deal_of_week))
                       class="rounded border-slate-350 text-[#C49A6C] focus:ring-[#C49A6C] h-4.5 w-4.5">
                <span class="text-sm font-semibold text-slate-700">Deal of Week</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))
                       class="rounded border-slate-350 text-amber-500 focus:ring-amber-500 h-4.5 w-4.5">
                <span class="text-sm font-semibold text-slate-700">Publish Active</span>
            </label>
        </div>

        <!-- Pack Sizes & Bundle Discounts (Storefront "SELECT PACK SIZE") -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs space-y-4" x-data="packManager()">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-100 gap-3">
                <div class="flex items-center space-x-3">
                    <div class="h-9 w-9 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">Pack Sizes & Combo Bundles (Storefront "SELECT PACK SIZE")</h4>
                        <span class="text-[11px] text-slate-400">Configure multi-pack buttons, savings badges, and discount multipliers</span>
                    </div>
                </div>
                <label class="flex items-center space-x-2.5 cursor-pointer bg-slate-50 border border-slate-200 px-3.5 py-1.5 rounded-xl hover:bg-slate-100 transition">
                    <input type="checkbox" name="enable_pack_sizes" value="1" x-model="enabled" class="rounded border-slate-300 text-amber-500 focus:ring-amber-500 h-4 w-4">
                    <span class="text-xs font-bold text-slate-700">Enable Pack Sizes</span>
                </label>
            </div>

            <div x-show="enabled" x-cloak class="space-y-4">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-[10px] font-extrabold uppercase tracking-wider border-b border-slate-200">
                                <th class="p-2.5">Pack Name *</th>
                                <th class="p-2.5">Badge / Savings Subtitle</th>
                                <th class="p-2.5 w-20">Units (Qty) *</th>
                                <th class="p-2.5 w-24">Multiplier</th>
                                <th class="p-2.5 w-28">Custom Price (&#8377;)</th>
                                <th class="p-2.5 w-28 text-emerald-700">Selling Price</th>
                                <th class="p-2.5 w-12 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <template x-for="(pack, index) in packs" :key="index">
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="p-2">
                                        <input type="text" :name="'pack_sizes[' + index + '][name]'" x-model="pack.name" placeholder="e.g. Pack of 1" required
                                               class="w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:ring-1 focus:ring-amber-500 focus:border-amber-500 bg-white">
                                    </td>
                                    <td class="p-2">
                                        <input type="text" :name="'pack_sizes[' + index + '][badge]'" x-model="pack.badge" placeholder="e.g. Save Extra 15%"
                                               class="w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:ring-1 focus:ring-amber-500 focus:border-amber-500 bg-white">
                                    </td>
                                    <td class="p-2">
                                        <input type="number" min="1" :name="'pack_sizes[' + index + '][quantity]'" x-model="pack.quantity" required
                                               class="w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:ring-1 focus:ring-amber-500 focus:border-amber-500 bg-white text-center">
                                    </td>
                                    <td class="p-2">
                                        <input type="number" step="0.01" min="0.1" :name="'pack_sizes[' + index + '][multiplier]'" x-model="pack.multiplier" placeholder="1.0"
                                               class="w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:ring-1 focus:ring-amber-500 focus:border-amber-500 bg-white text-center">
                                    </td>
                                    <td class="p-2">
                                        <input type="number" step="0.01" min="0" :name="'pack_sizes[' + index + '][custom_price]'" x-model="pack.custom_price" placeholder="Optional"
                                               class="w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:ring-1 focus:ring-amber-500 focus:border-amber-500 bg-white">
                                    </td>
                                    <td class="p-2">
                                        <span class="inline-block bg-emerald-50 text-emerald-800 border border-emerald-200 font-extrabold text-xs px-2 py-1 rounded-md" x-text="'₹' + calculatePrice(pack).toLocaleString('en-IN')"></span>
                                    </td>
                                    <td class="p-2 text-center">
                                        <button type="button" @click="removePack(index)" class="text-rose-500 hover:text-rose-700 p-1.5 rounded-lg hover:bg-rose-50 transition cursor-pointer" title="Delete">
                                             <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-2">
                    <button type="button" @click="addPack()" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3.5 py-2 rounded-xl transition cursor-pointer">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Add Another Pack Option</span>
                    </button>
                    <span class="text-[11px] text-slate-400">Formula: Multiplier &times; Product Sale Price. If Custom Price &le; 50, it acts as % discount.</span>
                </div>

                <!-- Live Preview on Admin Screen -->
                <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-3.5 mt-2">
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block mb-2">Live Storefront Preview</span>
                    <div class="flex flex-wrap gap-2.5">
                        <template x-for="(pack, index) in packs" :key="index">
                            <div class="border rounded-xl px-4 py-2.5 text-center transition min-w-[110px]"
                                 :class="index === 0 ? 'border-amber-500 bg-amber-50/50 shadow-xs' : 'border-slate-200 bg-white'">
                                <span class="block font-bold text-slate-800 text-xs" x-text="pack.name || 'Pack Name'"></span>
                                <span class="block font-semibold text-emerald-600 text-[10px]" x-text="pack.badge || ''"></span>
                                <span class="block font-extrabold text-slate-900 text-xs mt-1" x-text="'₹' + calculatePrice(pack).toLocaleString('en-IN')"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            
            <div x-show="!enabled" x-cloak class="text-xs text-slate-400 italic py-2">
                Pack size selector is disabled for this product. Only single unit ordering will be displayed on the store.
            </div>
        </div>

        <!-- Current Images Gallery -->
        @php
            $currentImages = json_decode($product->images, true) ?? [];
        @endphp
        @if(count($currentImages) > 0)
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Current Images</label>
                    <span class="text-[11px] text-slate-400 font-medium">Click ? on any image to remove it</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($currentImages as $index => $img)
                        @php
                            if (!empty($img) && (str_starts_with($img, 'http://') || str_starts_with($img, 'https://'))) {
                                $imgSrc = $img;
                            } elseif (!empty($img) && file_exists(public_path($img))) {
                                $imgSrc = asset($img);
                            } else {
                                $imgSrc = asset('images/logo.jpeg');
                            }
                        @endphp
                        <div class="relative bg-white border border-slate-200 rounded-xl p-2.5 flex flex-col items-center justify-center shadow-xs current-img-card transition-all duration-300">
                            <!-- Hidden checkbox for form submission -->
                            <input type="checkbox" name="remove_images[]" value="{{ $img }}" id="remove-img-{{ $index }}" class="hidden">
                            
                            <!-- Delete button top-right -->
                            <button type="button" 
                                    onclick="markImageForRemoval({{ $index }}, this)" 
                                    title="Remove this image"
                                    class="absolute top-1.5 right-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-full h-5 w-5 flex items-center justify-center shadow-md transition hover:scale-110 cursor-pointer z-10 text-[10px] font-extrabold">
                                ?
                            </button>
                            
                            <img src="{{ $imgSrc }}" 
                                 alt="Product Image" 
                                 class="h-20 w-full object-contain rounded-lg cursor-zoom-in hover:scale-105 transition-transform duration-250 mb-1" 
                                 onclick="openImageReview('{{ $imgSrc }}')">
                                 
                            <span class="text-[10px] text-slate-400 truncate max-w-full font-medium">
                                {{ basename($img) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Product Image Upload -->
        <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Upload New Images</label>
            <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 hover:bg-slate-50 transition relative flex flex-col items-center justify-center text-center cursor-pointer">
                <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-300 mb-3"></i>
                <span class="text-sm font-semibold text-slate-700">Select images to upload</span>
                <span class="text-xs text-slate-400 mt-1 block">PNG, JPG, JPEG, WEBP files up to 2MB each</span>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
            </div>

            <!-- Image Preview Container -->
            <div id="image-preview-container" class="hidden mt-4 bg-slate-50 p-4 border border-slate-100 rounded-2xl animate-fade-in">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-3">New Images Preview</label>
                <div id="image-preview-grid" class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4"></div>
            </div>
        </div>

        <!-- Shipping / Dimensions for Shiprocket -->
        <div class="bg-amber-50 border border-amber-100 p-5 rounded-2xl space-y-4">
            <div class="flex items-center space-x-2 pb-1.5 border-b border-amber-100">
                <i class="fa-solid fa-truck-fast text-amber-500 text-xs"></i>
                <h4 class="font-bold text-slate-700 text-sm uppercase tracking-wider">Shipping Details (for UPS)</h4>
            </div>
            <span class="text-xs text-slate-400 block -mt-1">These values are used by UPS to calculate shipping weight and dimensions.</span>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Weight (kg) *</label>
                    <input type="number" name="weight" step="0.001" min="0.001" value="{{ old('weight', $product->weight) }}" required
                           class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
                    <span class="text-[10px] text-slate-400">Packed weight</span>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Length (cm) *</label>
                    <input type="number" name="length" min="1" value="{{ old('length', $product->length) }}" required
                           class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Width (cm) *</label>
                    <input type="number" name="width" min="1" value="{{ old('width', $product->width) }}" required
                           class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Height (cm) *</label>
                    <input type="number" name="height" min="1" value="{{ old('height', $product->height) }}" required
                           class="w-full border border-slate-200 focus:ring-1 focus:ring-[#C49A6C] focus:border-[#C49A6C] rounded-xl text-sm px-4 py-2.5">
                </div>
            </div>

            <div class="pt-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Quick Presets:</span>
                <div class="flex flex-wrap gap-2 mt-2">
                    <button type="button" onclick="setDimensions(0.380, 8, 8, 16)" class="text-xs px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-50 transition cursor-pointer font-medium">Beverage Can (355ml)</button>
                    <button type="button" onclick="setDimensions(1.050, 10, 10, 28)" class="text-xs px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-50 transition cursor-pointer font-medium">Beverage PET (1L)</button>
                    <button type="button" onclick="setDimensions(0.220, 18, 9, 3)" class="text-xs px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-50 transition cursor-pointer font-medium">Chocolate Bar (200g)</button>
                    <button type="button" onclick="setDimensions(0.160, 20, 15, 6)" class="text-xs px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-50 transition cursor-pointer font-medium">Snack/Chips Bag (150g)</button>
                    <button type="button" onclick="setDimensions(0.450, 9, 9, 12)" class="text-xs px-3 py-1.5 rounded-lg bg-white border border-amber-200 text-amber-700 hover:bg-amber-50 transition cursor-pointer font-medium">Gourmet Jar (400g)</button>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-250 text-slate-500 font-semibold text-sm hover:bg-slate-50 transition">
                Cancel
            </a>
            <button type="submit" class="bg-[#C49A6C] hover:bg-[#b0875b] text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-md shadow-[#C49A6C]/20 transition cursor-pointer">
                Update Product
            </button>
        </div>
    </form>

</div>

<!-- Image Review Modal -->
<div id="image-review-modal" class="fixed inset-0 z-[9999] hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeImageReview()">
    <div class="relative max-w-4xl max-h-[85vh] w-full flex items-center justify-center" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button onclick="closeImageReview()" class="absolute -top-12 right-0 text-white/85 hover:text-white transition-colors h-10 w-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <!-- Modal Image -->
        <img id="ir-modal-image" src="" alt="Product Review" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-white/10">
    </div>
</div>
@endsection

@push('scripts')
<script>
function setDimensions(weight, length, width, height) {
    document.querySelector('input[name="weight"]').value = weight;
    document.querySelector('input[name="length"]').value = length;
    document.querySelector('input[name="width"]').value = width;
    document.querySelector('input[name="height"]').value = height;
}

function openImageReview(src) {
    const modal = document.getElementById('image-review-modal');
    const modalImg = document.getElementById('ir-modal-image');
    if (modal && modalImg) {
        modalImg.src = src;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden'; // Lock body scroll
    }
}

function closeImageReview() {
    const modal = document.getElementById('image-review-modal');
    if (modal) {
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
        document.body.style.overflow = ''; // Restore body scroll
    }
}

function markImageForRemoval(index, btnEl) {
    const checkbox = document.getElementById('remove-img-' + index);
    if (checkbox) {
        checkbox.checked = true;
    }
    const card = btnEl.closest('.current-img-card');
    if (card) {
        card.style.transform = 'scale(0.8)';
        card.style.opacity = '0';
        setTimeout(() => {
            card.style.display = 'none';
        }, 250);
    }
}

let selectedFiles = [];

function renderImagePreviews() {
    const previewContainer = document.getElementById('image-preview-container');
    const previewGrid = document.getElementById('image-preview-grid');
    
    if (!previewGrid || !previewContainer) return;
    
    previewGrid.innerHTML = '';
    
    if (selectedFiles.length > 0) {
        previewContainer.classList.remove('hidden');
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewCard = document.createElement('div');
                previewCard.className = 'relative bg-white border border-slate-200 rounded-xl p-2.5 flex flex-col items-center justify-center shadow-xs';
                
                // Delete button (inside card)
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'absolute top-1.5 right-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-full h-5 w-5 flex items-center justify-center shadow-md transition hover:scale-110 cursor-pointer z-10 text-[10px] font-extrabold';
                deleteBtn.textContent = '?';
                deleteBtn.onclick = function() {
                    removeSelectedFile(index);
                };
                
                // Image tag
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-20 w-full object-contain rounded-lg cursor-zoom-in hover:scale-105 transition-transform duration-250';
                img.onclick = function() { openImageReview(e.target.result); };
                
                // Filename
                const name = document.createElement('span');
                name.className = 'text-[10px] text-slate-400 truncate max-w-full mt-1.5 font-medium';
                name.textContent = file.name;
                
                previewCard.appendChild(deleteBtn);
                previewCard.appendChild(img);
                previewCard.appendChild(name);
                previewGrid.appendChild(previewCard);
            };
            reader.readAsDataURL(file);
        });
    } else {
        previewContainer.classList.add('hidden');
    }
}

function removeSelectedFile(index) {
    selectedFiles.splice(index, 1);
    const imageInput = document.querySelector('input[name="images[]"]');
    if (imageInput) {
        try {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            imageInput.files = dt.files;
        } catch(e) {
            console.error('DataTransfer error', e);
        }
        if (selectedFiles.length === 0) {
            imageInput.value = '';
        }
    }
    renderImagePreviews();
}

function packManager() {
    return {
        enabled: {{ ($product->pack_sizes === null || (is_array($product->pack_sizes) && count($product->pack_sizes) > 0)) ? 'true' : 'false' }},
        packs: @json($product->formatted_pack_sizes),
        calculatePrice(pack) {
            const saleInput = parseFloat(document.querySelector('input[name="sale_price"]')?.value);
            const regInput = parseFloat(document.querySelector('input[name="price"]')?.value);
            const basePrice = (saleInput && saleInput > 0) ? saleInput : ((regInput && regInput > 0) ? regInput : 0);
            const custom = parseFloat(pack.custom_price);
            const qty = parseInt(pack.quantity) || 1;
            if (custom > 0) {
                if (custom <= 50 && basePrice >= 100) {
                    return Math.round(basePrice * qty * (1 - (custom / 100)));
                }
                return Math.round(custom);
            }
            const mult = parseFloat(pack.multiplier) || qty;
            return Math.round(basePrice * mult);
        },
        addPack() {
            const nextQty = this.packs.length + 1;
            this.packs.push({
                name: 'Pack of ' + nextQty,
                badge: 'Extra Value',
                quantity: nextQty,
                multiplier: (nextQty * 0.85).toFixed(2),
                custom_price: ''
            });
        },
        removePack(index) {
            if (this.packs.length <= 1) {
                alert('At least one pack size option is recommended.');
                return;
            }
            this.packs.splice(index, 1);
        }
    };
}

document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.querySelector('input[name="images[]"]');
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            selectedFiles = Array.from(this.files);
            renderImagePreviews();
        });
    }
});
</script>
@endpush
