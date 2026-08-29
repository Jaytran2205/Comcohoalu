<?php

namespace App\Models;

use App\Enums\MenuItemBadge;
use App\Enums\MenuItemStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home.featured_items');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home.featured_items');
        });
    }

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'badge',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'badge' => MenuItemBadge::class,
        'status' => MenuItemStatus::class,
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ──

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    // ── Scopes ──

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', MenuItemStatus::Available);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, ?int $categoryId): Builder
    {
        return $query->when($categoryId, fn (Builder $q) => $q->where('category_id', $categoryId));
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeWithCustomImage(Builder $query): Builder
    {
        return $query->whereIn('image', [
            'images/dishes/khoai-tay-chien.png',
            'images/dishes/ngo-chien.png',
            'images/dishes/muc-chien.png',
            'images/dishes/ca-thu-sot-ca.png',
            'images/dishes/bo-xao-ngong-toi.png',
            'images/dishes/bo-xao-mang-truc.png',
            'images/dishes/tiet-canh-de.png',
            'images/dishes/de-xao-lan.png',
            'images/dishes/chan-de-ham.png',
            'images/dishes/ca-chuoi-kho-to.png',
            'images/dishes/tom-dong-rang.png',
            'images/dishes/chep-gion-xao-can.png',
            'images/dishes/ca-tam-rang-muoi.png',
            'images/dishes/cua-dong-rang.png',
            'images/dishes/cha-oc.png',
            'images/dishes/thit-chao-rieng.png',
            'images/dishes/thit-rang.png',
            'images/dishes/thit-mam-tep.png',
            'images/dishes/ga-rang-muoi.png',
            'images/dishes/ga-luoc.png'
        ]);
    }

    // ── Accessors ──

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', '.') . 'đ';
    }
}
