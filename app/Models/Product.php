<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'pack_sizes' => 'array',
    ];

    public function getFormattedPackSizesAttribute(): array
    {
        $packs = $this->pack_sizes;
        if (is_string($packs)) {
            $packs = json_decode($packs, true);
        }
        if (is_array($packs) && count($packs) > 0) {
            $formatted = [];
            foreach ($packs as $p) {
                $qty = max(1, (int)($p['quantity'] ?? $p['qty'] ?? 1));
                $name = !empty($p['name']) ? $p['name'] : ('Pack of ' . $qty);
                $badge = $p['badge'] ?? '';
                $customPrice = (!empty($p['custom_price']) && (float)$p['custom_price'] > 0) ? (float)$p['custom_price'] : null;
                $multiplier = isset($p['multiplier']) && (float)$p['multiplier'] > 0 ? (float)$p['multiplier'] : null;

                // Defensive fallback: If customPrice is <= 50 on a product with price >= 100, treat it as percentage discount
                if ($customPrice !== null && $customPrice <= 50 && (float)$this->price >= 100) {
                    $discountPercent = $customPrice;
                    $customPrice = null;
                    $multiplier = round($qty * (1 - ($discountPercent / 100)), 3);
                } elseif ($multiplier === null) {
                    $discountPercent = (float)($p['discount_percent'] ?? 0);
                    $multiplier = round($qty * (1 - ($discountPercent / 100)), 3);
                }

                $formatted[] = [
                    'name' => $name,
                    'badge' => $badge,
                    'quantity' => $qty,
                    'multiplier' => $multiplier,
                    'custom_price' => $customPrice,
                ];
            }
            return $formatted;
        }
        // Intelligent standard defaults
        return [
            [
                'name' => 'Pack of 1',
                'badge' => 'Regular Supply',
                'quantity' => 1,
                'multiplier' => 1.0,
                'custom_price' => null
            ],
            [
                'name' => 'Pack of 2',
                'badge' => 'Save Extra 15%',
                'quantity' => 2,
                'multiplier' => 1.70,
                'custom_price' => null
            ],
            [
                'name' => 'Pack of 3',
                'badge' => 'Best Value Combo',
                'quantity' => 3,
                'multiplier' => 2.25,
                'custom_price' => null
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $images = json_decode($this->images, true);
        if (!is_array($images)) {
            $images = !empty($this->images) ? [$this->images] : [];
        }
        $firstImg = count($images) > 0 ? $images[0] : null;
        if ($firstImg && (str_starts_with($firstImg, 'http://') || str_starts_with($firstImg, 'https://'))) {
            return $firstImg;
        }
        if ($firstImg && file_exists(public_path($firstImg))) {
            return asset($firstImg);
        }
        return asset('images/logo.jpeg');
    }

    public function getAllImageUrlsAttribute(): array
    {
        $images = json_decode($this->images, true);
        if (!is_array($images)) {
            $images = !empty($this->images) ? [$this->images] : [];
        }
        $urls = [];
        foreach ($images as $img) {
            if (empty($img)) continue;
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                $urls[] = $img;
            } elseif (file_exists(public_path($img))) {
                $urls[] = asset($img);
            }
        }
        if (empty($urls)) {
            $urls = [$this->primary_image_url];
        }
        $supplements = [
            asset('images/card_diabetes_pro_hd.jpg'),
            asset('images/card_liver_detox_hd.jpg'),
            asset('images/card_pilecurex_hd.jpg'),
            asset('images/card_paachan_sathi_hd.jpg'),
            asset('images/card_triphala_hd.jpg')
        ];
        foreach ($supplements as $sup) {
            if (count($urls) >= 4) break;
            if (!in_array($sup, $urls)) {
                $urls[] = $sup;
            }
        }
        return $urls;
    }
}
