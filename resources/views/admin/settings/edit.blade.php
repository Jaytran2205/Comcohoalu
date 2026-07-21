@extends('admin.layouts.admin')

@section('title', 'Cấu Hình Nhà Hàng')
@section('page_title', 'Cấu hình nhà hàng')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- SECTION 1: GENERAL SETTINGS -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
            <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
                <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                    <i class="fas fa-sliders-h text-secondary mr-2"></i> CẤU HÌNH THÔNG TIN CHUNG
                </h3>
            </div>
            
            <div class="p-6 space-y-6 text-xs">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Tên nhà hàng <span class="text-error">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="site_name" 
                        id="site_name" 
                        value="{{ old('site_name', $generalSettings['site_name'] ?? '') }}" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                    >
                    @error('site_name')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Site Address -->
                <div>
                    <label for="site_address" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Địa chỉ nhà hàng <span class="text-error">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="site_address" 
                        id="site_address" 
                        value="{{ old('site_address', $generalSettings['site_address'] ?? '') }}" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                    >
                    @error('site_address')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hotline & Email Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Hotline -->
                    <div>
                        <label for="site_hotline" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Số điện thoại Hotline
                        </label>
                        <input 
                            type="text" 
                            name="site_hotline" 
                            id="site_hotline" 
                            value="{{ old('site_hotline', $generalSettings['site_hotline'] ?? '') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('site_hotline')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="site_email" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Địa chỉ Email liên hệ
                        </label>
                        <input 
                            type="email" 
                            name="site_email" 
                            id="site_email" 
                            value="{{ old('site_email', $generalSettings['site_email'] ?? '') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('site_email')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Facebook, TikTok & Zalo Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Facebook Link -->
                    <div>
                        <label for="site_facebook" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Đường dẫn trang Facebook (URL)
                        </label>
                        <input 
                            type="url" 
                            name="site_facebook" 
                            id="site_facebook" 
                            value="{{ old('site_facebook', $generalSettings['site_facebook'] ?? '') }}" 
                            placeholder="https://facebook.com/comcohoalu"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('site_facebook')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- TikTok Link -->
                    <div>
                        <label for="site_tiktok" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Đường dẫn trang TikTok (URL)
                        </label>
                        <input 
                            type="text" 
                            name="site_tiktok" 
                            id="site_tiktok" 
                            value="{{ old('site_tiktok', $generalSettings['site_tiktok'] ?? '') }}" 
                            placeholder="https://tiktok.com/@comcohoalu"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('site_tiktok')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Zalo Link -->
                    <div>
                        <label for="site_zalo" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Đường dẫn chat Zalo (URL)
                        </label>
                        <input 
                            type="url" 
                            name="site_zalo" 
                            id="site_zalo" 
                            value="{{ old('site_zalo', $generalSettings['site_zalo'] ?? '') }}" 
                            placeholder="https://zalo.me/0866000000"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('site_zalo')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Google Maps Embed Iframe -->
                <div>
                    <label for="google_maps_embed" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Mã nhúng bản đồ Google Maps (Iframe tag)
                    </label>
                    <textarea 
                        name="google_maps_embed" 
                        id="google_maps_embed" 
                        rows="3" 
                        placeholder="Nhập mã <iframe ...></iframe> từ Google Maps..."
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs font-mono"
                    >{{ old('google_maps_embed', $generalSettings['google_maps_embed'] ?? '') }}</textarea>
                    @error('google_maps_embed')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Google Analytics Code -->
                <div>
                    <label for="google_analytics_code" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Mã cấu hình Google Analytics / Tag Manager (GA4 Script)
                    </label>
                    <textarea 
                        name="google_analytics_code" 
                        id="google_analytics_code" 
                        rows="4" 
                        placeholder="Nhập đoạn mã script (ví dụ: <script async src='https://www.googletagmanager.com/gtag/js...'></script>...)"
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs font-mono"
                    >{{ old('google_analytics_code', $generalSettings['google_analytics_code'] ?? '') }}</textarea>
                    @error('google_analytics_code')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                    <p class="text-[10px] text-text-secondary/70 italic mt-1">
                        * Đoạn mã script này sẽ được nhúng tự động vào phần đầu (&lt;head&gt;) của tất cả các trang giao diện ngoài.
                    </p>
                </div>
            </div>
        </div>

        <!-- SECTION 2: BOOKING SETTINGS -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
            <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
                <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                    <i class="fas fa-calendar-alt text-secondary mr-2"></i> CẤU HÌNH QUY TRÌNH ĐẶT BÀN
                </h3>
            </div>
            
            <div class="p-6 space-y-6 text-xs">
                <!-- Limit counts grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Advance booking minutes -->
                    <div>
                        <label for="booking_min_advance_minutes" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Thời gian đặt trước tối thiểu (Phút)
                        </label>
                        <input 
                            type="number" 
                            name="booking_min_advance_minutes" 
                            id="booking_min_advance_minutes" 
                            min="0"
                            value="{{ old('booking_min_advance_minutes', $bookingSettings['booking_min_advance_minutes'] ?? '') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('booking_min_advance_minutes')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Max active bookings per phone -->
                    <div>
                        <label for="booking_max_per_phone" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Số đơn đặt tối đa/SĐT chưa hoàn thành
                        </label>
                        <input 
                            type="number" 
                            name="booking_max_per_phone" 
                            id="booking_max_per_phone" 
                            min="1"
                            value="{{ old('booking_max_per_phone', $bookingSettings['booking_max_per_phone'] ?? '') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                        @error('booking_max_per_phone')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Operating hours grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Lunch Open / Close -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="lunch_open" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Giờ đón khách trưa
                            </label>
                            <input 
                                type="text" 
                                name="lunch_open" 
                                id="lunch_open" 
                                value="{{ old('lunch_open', $bookingSettings['lunch_open'] ?? '') }}" 
                                placeholder="10:00"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                            >
                            @error('lunch_open')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="lunch_close" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Giờ đóng bếp trưa
                            </label>
                            <input 
                                type="text" 
                                name="lunch_close" 
                                id="lunch_close" 
                                value="{{ old('lunch_close', $bookingSettings['lunch_close'] ?? '') }}" 
                                placeholder="14:00"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                            >
                            @error('lunch_close')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Dinner Open / Close -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="dinner_open" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Giờ đón khách tối
                            </label>
                            <input 
                                type="text" 
                                name="dinner_open" 
                                id="dinner_open" 
                                value="{{ old('dinner_open', $bookingSettings['dinner_open'] ?? '') }}" 
                                placeholder="17:00"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                            >
                            @error('dinner_open')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="dinner_close" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Giờ đóng bếp tối
                            </label>
                            <input 
                                type="text" 
                                name="dinner_close" 
                                id="dinner_close" 
                                value="{{ old('dinner_close', $bookingSettings['dinner_close'] ?? '') }}" 
                                placeholder="22:00"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                            >
                            @error('dinner_close')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3">
            <button 
                type="submit" 
                class="py-3 px-8 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all shadow-md hover:shadow-lg"
            >
                <i class="fas fa-save mr-1.5"></i> Lưu cấu hình hệ thống
            </button>
        </div>

    </form>
</div>
@endsection
