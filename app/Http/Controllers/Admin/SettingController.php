<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Hiển thị form cấu hình nhà hàng.
     */
    public function edit()
    {
        $generalSettings = Setting::getGroup('general');
        $bookingSettings = Setting::getGroup('booking');

        return view('admin.settings.edit', compact('generalSettings', 'bookingSettings'));
    }

    /**
     * Lưu cấu hình.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:100'],
            'site_address' => ['required', 'string', 'max:500'],
            'site_hotline' => ['nullable', 'string', 'max:20'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_facebook' => ['nullable', 'url', 'max:500'],
            'site_tiktok' => ['nullable', 'string', 'max:500'],
            'site_zalo' => ['nullable', 'url', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
            'google_analytics_code' => ['nullable', 'string'],
            'booking_min_advance_minutes' => ['nullable', 'integer', 'min:0'],
            'booking_max_per_phone' => ['nullable', 'integer', 'min:1'],
            'lunch_open' => ['nullable', 'string'],
            'lunch_close' => ['nullable', 'string'],
            'dinner_open' => ['nullable', 'string'],
            'dinner_close' => ['nullable', 'string'],
        ]);

        // Lưu general settings
        $generalKeys = ['site_name', 'site_address', 'site_hotline', 'site_email', 'site_facebook', 'site_tiktok', 'site_zalo', 'google_maps_embed', 'google_analytics_code'];
        foreach ($generalKeys as $key) {
            if (array_key_exists($key, $validated)) {
                Setting::set($key, $validated[$key], 'general');
            }
        }

        // Lưu booking settings
        $bookingKeys = ['booking_min_advance_minutes', 'booking_max_per_phone', 'lunch_open', 'lunch_close', 'dinner_open', 'dinner_close'];
        foreach ($bookingKeys as $key) {
            if (array_key_exists($key, $validated)) {
                Setting::set($key, $validated[$key], 'booking');
            }
        }

        return back()->with('success', 'Đã cập nhật cấu hình thành công.');
    }
}
