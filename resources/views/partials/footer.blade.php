<footer class="bg-bg-dark text-text-light pt-16 pb-8 border-t-2 border-secondary/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Column 1: Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img 
                        src="{{ asset('images/logo.jpg') }}" 
                        alt="Logo Cơm Cổ Hoa Lư" 
                        class="w-12 h-12 object-contain rounded-full border border-secondary/30"
                    >
                    <h3 class="text-2xl font-bold font-serif text-white tracking-wide">
                        Cơm Cổ <span class="text-secondary">Hoa Lư</span>
                    </h3>
                </div>
                <p class="text-text-light/70 text-sm italic font-accent text-lg">
                    "{{ $siteSettings['site_slogan'] ?? 'Hương vị cổ truyền Hoa Lư' }}"
                </p>
                <div class="pt-4 space-y-3 text-sm text-text-light/85">
                    <p class="flex items-start">
                        <i class="fas fa-map-marker-alt text-secondary mt-1 mr-3 w-4"></i>
                        <span>Địa chỉ: {{ $siteSettings['site_address'] ?? 'Tràng An, Trường Yên, Hoa Lư, Ninh Bình' }}</span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-phone-alt text-secondary mr-3 w-4"></i>
                        <span>Hotline: <a href="tel:{{ str_replace('.', '', $siteSettings['site_hotline'] ?? '0866000000') }}" class="hover:text-secondary transition-colors">{{ $siteSettings['site_hotline'] ?? '0866.000.000' }}</a></span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-envelope text-secondary mr-3 w-4"></i>
                        <span>Email: <a href="mailto:{{ $siteSettings['site_email'] ?? 'contact@comcohoalu.vn' }}" class="hover:text-secondary transition-colors">{{ $siteSettings['site_email'] ?? 'contact@comcohoalu.vn' }}</a></span>
                    </p>
                </div>
                <!-- Social links -->
                <div class="pt-4 flex space-x-4">
                    @if(!empty($siteSettings['site_facebook']))
                        <a href="{{ $siteSettings['site_facebook'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-secondary text-white hover:text-bg-dark flex items-center justify-center transition-all duration-300" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @else
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-secondary text-white hover:text-bg-dark flex items-center justify-center transition-all duration-300" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if(!empty($siteSettings['site_tiktok']))
                        <a href="{{ $siteSettings['site_tiktok'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-secondary text-white hover:text-bg-dark flex items-center justify-center transition-all duration-300" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @else
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-secondary text-white hover:text-bg-dark flex items-center justify-center transition-all duration-300" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif

                    @if(!empty($siteSettings['site_zalo']))
                        <a href="{{ $siteSettings['site_zalo'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-secondary text-white hover:text-bg-dark flex items-center justify-center transition-all duration-300 font-bold text-[10px]" title="Zalo">
                            ZALO
                        </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="space-y-4 sm:pl-4 lg:pl-8">
                <h4 class="text-lg font-bold font-serif text-white relative pb-2 border-b border-white/10">
                    Liên kết nhanh
                </h4>
                <ul class="space-y-2 text-sm text-text-light/80">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Giới thiệu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menu') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Thực đơn ngon
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menu.board') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Menu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.category', 'tin-tuc') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Tin tức ẩm thực
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-secondary flex items-center transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2 text-secondary/70"></i>Liên hệ & bản đồ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Maps -->
            <div class="space-y-4">
                <h4 class="text-lg font-bold font-serif text-white relative pb-2 border-b border-white/10">
                    Bản đồ chỉ đường
                </h4>
                <div class="w-full h-[350px] rounded-lg overflow-hidden border border-white/10">
                    @if(!empty($siteSettings['google_maps_embed']))
                        {!! $siteSettings['google_maps_embed'] !!}
                    @else
                        <!-- Default beautiful Ninh Binh (Hoa Lu) map placeholder -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.0620862024565!2d105.96190467576482!3d20.262424080309117!2m3!1f0!2f0!3f0!3m2!1i1024!2i1024!2f13.1!3m3!1m2!1s0x313679e55bfe3d8d%3A0x54ce2dd47cc3976f!2zQ8ahbSBD4buVIEhvYSBMxrA!5e0!3m2!1svi!2s!4v1718812345678!5m2!1svi!2s" 
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

            <!-- Column 4: Facebook Page Widget -->
            <div class="space-y-4">
                <h4 class="text-lg font-bold font-serif text-white relative pb-2 border-b border-white/10">
                    Các kênh truyền thông
                </h4>
                <div class="w-full h-[350px] rounded-lg overflow-hidden border border-white/10 bg-white">
                    @php
                        $fbUrl = !empty($siteSettings['site_facebook']) ? $siteSettings['site_facebook'] : 'https://www.facebook.com/facebook';
                    @endphp
                    <div class="fb-page" 
                         data-href="{{ $fbUrl }}" 
                         data-tabs="timeline" 
                         data-width="500" 
                         data-height="350" 
                         data-small-header="false" 
                         data-adapt-container-width="true" 
                         data-hide-cover="false" 
                         data-show-facepile="true">
                        <blockquote cite="{{ $fbUrl }}" class="fb-xfbml-parse-ignore">
                            <a href="{{ $fbUrl }}">Facebook</a>
                        </blockquote>
                    </div>
                </div>
            </div>

        </div>

        <!-- Divider -->
        <div class="mt-12 pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between text-xs text-text-light/60">
            <p>&copy; {{ date('Y') }} Cơm Cổ Hoa Lư. Tất cả quyền được bảo lưu.</p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <span>Thiết kế đậm chất di sản Hoa Lư</span>
                @guest
                    <a href="{{ route('login') }}" class="hover:text-secondary transition-colors"><i class="fas fa-lock mr-1"></i>Đăng nhập quản trị</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-secondary transition-colors"><i class="fas fa-tachometer-alt mr-1"></i>Bảng điều khiển</a>
                @endguest
            </div>
        </div>
    </div>
</footer>
