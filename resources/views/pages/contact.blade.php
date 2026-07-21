@extends('layouts.app')

@section('title', 'Liên Hệ & Chỉ Đường - Cơm Cổ Hoa Lư')
@section('meta_description', 'Thông tin địa chỉ, hotline đặt bàn và bản đồ chỉ đường chi tiết đến nhà hàng Cơm Cổ Hoa Lư tại Tràng An, Trường Yên, Hoa Lư, Ninh Bình.')

@section('content')
<!-- Breadcrumb -->
@include('partials.breadcrumb', [
    'title' => 'Liên Hệ Với Chúng Tôi',
    'items' => [
        ['label' => 'Liên hệ', 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden">
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start mb-16">
            
            <!-- 1. Contact Information Card -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-border-custom/40 p-8 space-y-6">
                <h3 class="font-serif font-bold text-xl text-primary border-b border-border-custom/20 pb-3">
                    Thông tin liên hệ
                </h3>
                
                <div class="space-y-4 text-xs text-text-secondary leading-relaxed">
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center mr-3 mt-0.5 flex-shrink-0 text-sm">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-text-primary block text-sm">Địa chỉ duy nhất:</span>
                            <span>{{ $siteSettings['site_address'] ?? 'Tràng An, Trường Yên, Hoa Lư, Ninh Bình' }}</span>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center mr-3 mt-0.5 flex-shrink-0 text-sm">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-text-primary block text-sm">Điện thoại Hotline:</span>
                            <a href="tel:{{ str_replace('.', '', $siteSettings['site_hotline'] ?? '0866000000') }}" class="hover:text-primary transition-colors text-base font-bold font-serif text-primary-light">
                                {{ $siteSettings['site_hotline'] ?? '0866.000.000' }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center mr-3 mt-0.5 flex-shrink-0 text-sm">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-text-primary block text-sm">Email hỗ trợ:</span>
                            <a href="mailto:{{ $siteSettings['site_email'] ?? 'contact@comcohoalu.vn' }}" class="hover:text-primary transition-colors">
                                {{ $siteSettings['site_email'] ?? 'contact@comcohoalu.vn' }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center mr-3 mt-0.5 flex-shrink-0 text-sm">
                            <i class="far fa-clock"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-text-primary block text-sm">Giờ hoạt động:</span>
                            <span>Trưa: 10:00 - 14:00 <br> Tối: 17:00 - 22:00</span>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="pt-4 border-t border-border-custom/20">
                    <span class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-3">Kết nối với chúng tôi</span>
                    <div class="flex space-x-3">
                        <a href="{{ $siteSettings['site_facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-bg-secondary text-text-secondary hover:bg-primary hover:text-white flex items-center justify-center transition-colors" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ $siteSettings['site_tiktok'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-bg-secondary text-text-secondary hover:bg-primary hover:text-white flex items-center justify-center transition-colors" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        @if(!empty($siteSettings['site_zalo']))
                            <a href="{{ $siteSettings['site_zalo'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-bg-secondary text-text-secondary hover:bg-primary hover:text-white flex items-center justify-center transition-colors font-bold text-[9px]" title="Zalo">
                                ZALO
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Contact Message Form -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-border-custom/40 p-8">
                <h3 class="font-serif font-bold text-xl text-primary border-b border-border-custom/20 pb-3 mb-6">
                    Gửi tin nhắn phản hồi
                </h3>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-success/10 border-l-4 border-success text-success text-xs rounded-r-lg">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Họ tên của bạn <span class="text-error">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                required
                                placeholder="Nhập họ và tên..."
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('name')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Số điện thoại <span class="text-error">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                id="phone" 
                                value="{{ old('phone') }}" 
                                required
                                placeholder="Nhập số điện thoại..."
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('phone')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Địa chỉ Email <span class="text-text-secondary/60">(Không bắt buộc)</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}"
                            placeholder="dia-chi-email@vi-du.com"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                        >
                        @error('email')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Message Body -->
                    <div>
                        <label for="message" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Nội dung tin nhắn <span class="text-error">*</span>
                        </label>
                        <textarea 
                            name="message" 
                            id="message" 
                            rows="5" 
                            required
                            placeholder="Nhập nội dung tin nhắn hoặc ý kiến đóng góp của bạn (tối thiểu 10 ký tự)..."
                            class="w-full px-4 py-3 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="px-8 py-3.5 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02] text-xs uppercase tracking-wider"
                        >
                            <i class="fas fa-paper-plane mr-2"></i> Gửi tin nhắn liên hệ
                        </button>
                    </div>

                </form>
            </div>

        </div>

        <!-- Google Maps Iframe Section -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/40 p-4">
            <h3 class="font-serif font-bold text-lg text-primary mb-4 flex items-center">
                <i class="fas fa-map-marked-alt text-secondary mr-2"></i>Bản đồ vị trí nhà hàng
            </h3>
            <div class="w-full h-[400px] rounded-lg overflow-hidden border border-border-custom/30">
                @if(!empty($siteSettings['google_maps_embed']))
                    {!! $siteSettings['google_maps_embed'] !!}
                @else
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3741.011786524339!2d105.90159497576594!3d20.258380313803328!2m3!1f0!2f0!3f0!3m2!1i1024!2i1024!2f1025!3m2!1i1024!2i1024!3f0!3m2!1i1024!2i1024!3f0!3m2!1i1024!2i1024!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
