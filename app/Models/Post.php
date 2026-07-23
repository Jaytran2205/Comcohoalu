<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home.latest_posts');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home.latest_posts');
        });
    }

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'meta_title',
        'meta_description',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'status' => PostStatus::class,
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    // ── Relationships ──

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // ── Scopes ──

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PostStatus::Published)
                     ->where('published_at', '<=', now());
    }

    public function scopeByCategory(Builder $query, string $slug): Builder
    {
        return $query->whereHas('category', fn (Builder $q) => $q->where('slug', $slug));
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->published()->orderByDesc('published_at');
    }

    // ── Methods ──

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
