<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'booking_date',
        'booking_time',
        'adults',
        'children',
        'set_menu_id',
        'combo_quantity',
        'ordered_items',
        'estimated_total',
        'order_type',
        'customer_name',
        'customer_phone',
        'customer_email',
        'special_requests',
        'status',
        'confirmed_by',
        'confirmed_at',
        'admin_notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'combo_quantity' => 'integer',
        'ordered_items' => 'array',
        'estimated_total' => 'integer',
        'status' => BookingStatus::class,
        'confirmed_at' => 'datetime',
    ];

    // ── Auto-generate booking code ──

    protected static function booted(): void
    {
        static::creating(function (Booking $booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(8));
            }
        });
    }

    // ── Relationships ──

    public function setMenu(): BelongsTo
    {
        return $this->belongsTo(SetMenu::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // ── Scopes ──

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('booking_date', today());
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('booking_date', '>=', today());
    }

    public function scopeByStatus(Builder $query, BookingStatus $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', BookingStatus::Pending);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [
            BookingStatus::Pending,
            BookingStatus::Confirmed,
        ]);
    }

    // ── Accessors ──

    public function getTotalGuestsAttribute(): int
    {
        return $this->adults + $this->children;
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->booking_date->format('d/m/Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return \Carbon\Carbon::parse($this->booking_time)->format('H:i');
    }
}
