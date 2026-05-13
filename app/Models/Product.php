<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    protected $casts = [
        'variations' => 'array',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'variations',
        'price',
        'image',
        'is_active',
        'on_sale',
        'is_featured'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the formatted variations.
     * Ensures we always return an array of objects even if old data exists.
     */
    public function getFormattedVariationsAttribute()
    {
        if (!$this->variations || !is_array($this->variations)) {
            return [];
        }

        return collect($this->variations)->map(function ($item) {
            // If it's a string (old format), convert to object with base price
            if (is_string($item)) {
                return [
                    'weight' => $item,
                    'price' => $this->price
                ];
            }
            return $item;
        })->toArray();
    }

    /**
     * Get the display price (price of the first variation or base price).
     */
    public function getDisplayPriceAttribute()
    {
        $variations = $this->formatted_variations;
        if (!empty($variations)) {
            return $variations[0]['price'];
        }
        return $this->price;
    }
}
