<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public $timestamps = false;

    protected $dates = ['updated_at'];

    // ── Static Helpers ──

    /**
     * Lấy giá trị setting theo key.
     * Cache 1 giờ để giảm DB queries.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Cập nhật hoặc tạo mới setting.
     * Clear cache khi cập nhật.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): static
    {
        Cache::forget("setting.{$key}");
        Cache::forget("settings.group.{$group}");
        Cache::forget('settings.all');

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'updated_at' => now()]
        );
    }

    /**
     * Lấy tất cả settings theo group.
     */
    public static function getGroup(string $group): array
    {
        return Cache::remember("settings.group.{$group}", 3600, function () use ($group) {
            return static::where('group', $group)
                         ->pluck('value', 'key')
                         ->toArray();
        });
    }

    /**
     * Lấy tất cả settings dạng key-value.
     */
    public static function allCached(): array
    {
        return Cache::remember('settings.all', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }
}
