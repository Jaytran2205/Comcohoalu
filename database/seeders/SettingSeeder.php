<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── General ──
            ['key' => 'site_name', 'value' => 'Cơm Cổ Hoa Lư', 'group' => 'general'],
            ['key' => 'site_slogan', 'value' => 'Hương vị cổ truyền Hoa Lư', 'group' => 'general'],
            ['key' => 'site_address', 'value' => 'TP Hoa Lư, Ninh Bình', 'group' => 'general'],
            ['key' => 'site_hotline', 'value' => '0866.000.000', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'contact@comcohoalu.vn', 'group' => 'general'],
            ['key' => 'site_facebook', 'value' => 'https://www.facebook.com/61590733153698', 'group' => 'general'],
            ['key' => 'site_tiktok', 'value' => '', 'group' => 'general'],
            ['key' => 'site_zalo', 'value' => '', 'group' => 'general'],
            ['key' => 'google_maps_embed', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.0620862024565!2d105.96190467576482!3d20.262424080309117!2m3!1f0!2f0!3f0!3m2!1i1024!2i1024!2f13.1!3m3!1m2!1s0x313679e55bfe3d8d%3A0x54ce2dd47cc3976f!2zQ8ahbSBD4buVIEhvYSBMxrA!5e0!3m2!1svi!2s!4v1718812345678!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'group' => 'general'],
            ['key' => 'google_analytics_code', 'value' => '', 'group' => 'general'],

            // ── Booking ──
            ['key' => 'booking_min_advance_minutes', 'value' => '30', 'group' => 'booking'],
            ['key' => 'booking_max_per_phone', 'value' => '3', 'group' => 'booking'],
            ['key' => 'lunch_open', 'value' => '10:00', 'group' => 'booking'],
            ['key' => 'lunch_close', 'value' => '14:00', 'group' => 'booking'],
            ['key' => 'dinner_open', 'value' => '17:00', 'group' => 'booking'],
            ['key' => 'dinner_close', 'value' => '22:00', 'group' => 'booking'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
