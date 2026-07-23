<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SetMenu extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('menu.set_menus');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('menu.set_menus');
        });
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'people_count',
        'price_per_person',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'people_count' => 'integer',
        'price_per_person' => 'decimal:0',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ──

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'set_menu_items')
                     ->withPivot('quantity');
    }

    // ── Scopes ──

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    // ── Accessors ──

    public function getPriceAttribute(): float
    {
        return (float) ($this->price_per_person * $this->people_count);
    }

    public function getPaxRangeAttribute(): string
    {
        return (string) $this->people_count;
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price_per_person, 0, ',', '.') . 'đ/người';
    }
}
