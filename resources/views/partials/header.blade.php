<header class="fixed top-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md shadow-sm border-b border-border-custom/30 transition-all duration-300 relative">
    <!-- Watermark Phoenix Motif (Faint light gold blur) -->
    <div class="absolute inset-y-0 right-1/4 z-0 pointer-events-none select-none opacity-[0.05] text-secondary flex items-center justify-center">
        <svg class="w-16 h-16 md:w-20 md:h-20" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <!-- Stylized Chim Phượng (Vietnamese Phoenix) -->
            <path d="M50,15 C45,25 35,35 25,45 C20,50 15,60 20,70 C25,80 40,85 50,75 C60,85 75,80 80,70 C85,60 80,50 75,45 C65,35 55,25 50,15 Z"></path>
            <path d="M50,15 L50,75"></path>
            <path d="M35,35 C25,40 15,35 10,45 C5,55 10,65 20,65"></path>
            <path d="M65,35 C75,40 85,35 90,45 C95,55 90,65 80,65"></path>
            <path d="M28,52 C20,58 12,62 8,72 C4,82 12,90 22,88"></path>
            <path d="M72,52 C80,58 88,62 92,72 C96,82 88,90 78,88"></path>
            <!-- Head detail -->
            <path d="M50,15 C50,10 47,8 50,5 C53,8 50,10 50,15 Z" fill="currentColor"></path>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2.5 flex-shrink-0 group">
            <img 
                src="{{ asset('images/logo.jpg') }}" 
                alt="Logo Cơm Cổ Hoa Lư" 
                class="w-10 h-10 object-contain rounded-full border border-secondary/20 shadow-sm transition-transform duration-300 group-hover:scale-105"
            >
            <span class="text-lg md:text-xl font-bold font-serif text-primary tracking-wide whitespace-nowrap">
                Cơm Cổ <span class="text-secondary">Hoa Lư</span>
            </span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden xl:flex items-center space-x-1.5 2xl:space-x-2.5">
            @php
                $isHome = request()->routeIs('home');
                $isAbout = request()->routeIs('about');
                $isMenu = request()->routeIs('menu');
                $isMenuBoard = request()->routeIs('menu.board');
                
                $isNews = request()->is('category/tin-tuc*') || 
                          (request()->routeIs('posts.show') && isset($post) && $post->category && $post->category->slug === 'tin-tuc');
                          
                $isPromo = request()->is('category/khuyen-mai*') || 
                           (request()->routeIs('posts.show') && isset($post) && $post->category && $post->category->slug === 'khuyen-mai');
                           
                $isRecruit = request()->is('category/tuyen-dung*') || 
                             (request()->routeIs('posts.show') && isset($post) && $post->category && $post->category->slug === 'tuyen-dung');
                             
                $isContact = request()->routeIs('contact');
            @endphp

            <a href="{{ route('home') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isHome ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Trang chủ</a>
            
            <a href="{{ route('about') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isAbout ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Giới thiệu</a>
            
            <a href="{{ route('menu') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isMenu ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Thực đơn</a>
            
            <a href="{{ route('menu.board') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isMenuBoard ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Menu</a>
            
            <!-- Posts Category Direct Links -->
            <a href="{{ route('posts.category', 'tin-tuc') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isNews ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Tin tức</a>
            
            <a href="{{ route('posts.category', 'khuyen-mai') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isPromo ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Khuyến mãi</a>
            
            <a href="{{ route('posts.category', 'tuyen-dung') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isRecruit ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Tuyển dụng</a>
            
            <a href="{{ route('contact') }}" class="nav-link px-2.5 py-1 rounded-md transition-all duration-200 text-[13px] xl:text-[14px] 2xl:text-[15px] whitespace-nowrap {{ $isContact ? 'bg-secondary-light/75 text-primary-dark font-bold' : 'text-text-secondary hover:text-primary hover:bg-secondary-light/40 font-semibold' }}">Liên hệ</a>
        </nav>

        <!-- CTA & Controls -->
        <div class="hidden xl:flex items-center space-x-2.5 flex-shrink-0">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-1.5 text-xs xl:text-sm font-bold border border-primary text-primary hover:bg-primary hover:text-white rounded-md transition-all duration-200 whitespace-nowrap">
                    <i class="fas fa-cog mr-1.5"></i>Quản trị
                </a>
            @endauth
            <a href="{{ route('booking.create') }}" class="px-4.5 py-1.5 bg-primary hover:bg-secondary border border-secondary text-white hover:text-bg-dark font-bold rounded-md shadow-md transition-all duration-300 transform hover:scale-[1.01] text-xs xl:text-sm whitespace-nowrap uppercase tracking-wider">
                <i class="fas fa-calendar-alt mr-1.5"></i>Đặt Bàn
            </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <div class="flex xl:hidden items-center space-x-4 flex-shrink-0">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:text-primary-dark">
                    <i class="fas fa-cog text-xl"></i>
                </a>
            @endauth
            <button id="mobile-menu-btn" type="button" class="text-text-primary hover:text-primary p-2 focus:outline-none" aria-label="Mở menu">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

    </div>

    <!-- Mobile Menu Backdrop -->
    <div id="mobile-menu-backdrop" class="fixed inset-0 bg-black/60 z-40 hidden backdrop-blur-xs transition-opacity duration-300"></div>

    <!-- Mobile Slide-over Menu (Right side) -->
    <div id="mobile-menu" class="fixed inset-y-0 right-0 z-50 w-full max-w-[280px] sm:max-w-xs bg-bg-primary shadow-2xl border-l border-border-custom/50 transform translate-x-full hidden transition-transform duration-300 ease-in-out xl:hidden flex flex-col justify-between">
        
        <!-- Header area -->
        <div>
            <div class="h-20 px-6 border-b border-border-custom/30 flex items-center justify-between bg-white">
                <span class="text-xl font-bold font-serif text-primary">Danh mục</span>
                <button id="mobile-menu-close" type="button" class="text-text-secondary hover:text-primary p-2 focus:outline-none" aria-label="Đóng menu">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Links list -->
            <nav class="px-6 py-8 flex flex-col space-y-5 bg-bg-primary">
                <a href="{{ route('home') }}" class="nav-link block text-lg border-b pb-2 {{ $isHome ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Trang chủ</a>
                
                <a href="{{ route('about') }}" class="nav-link block text-lg border-b pb-2 {{ $isAbout ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Giới thiệu</a>
                
                <a href="{{ route('menu') }}" class="nav-link block text-lg border-b pb-2 {{ $isMenu ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Thực đơn</a>
                
                <a href="{{ route('menu.board') }}" class="nav-link block text-lg border-b pb-2 {{ $isMenuBoard ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Menu</a>
                
                <a href="{{ route('posts.category', 'tin-tuc') }}" class="nav-link block text-lg border-b pb-2 {{ $isNews ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Tin tức</a>
                
                <a href="{{ route('posts.category', 'khuyen-mai') }}" class="nav-link block text-lg border-b pb-2 {{ $isPromo ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Khuyến mãi</a>
                
                <a href="{{ route('posts.category', 'tuyen-dung') }}" class="nav-link block text-lg border-b pb-2 {{ $isRecruit ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Tuyển dụng</a>
                
                <a href="{{ route('contact') }}" class="nav-link block text-lg border-b pb-2 {{ $isContact ? 'text-primary font-bold border-primary' : 'text-text-secondary hover:text-primary font-semibold border-border-custom/20' }}">Liên hệ</a>
            </nav>
        </div>

        <!-- Footer / CTA area -->
        <div class="p-6 border-t border-border-custom/30 bg-white">
            <a href="{{ route('booking.create') }}" class="block w-full py-3 text-center bg-secondary text-bg-dark font-bold hover:bg-secondary-dark rounded-lg shadow-sm transition-all duration-200">
                <i class="fas fa-calendar-alt mr-2"></i>Đặt Bàn Ngay
            </a>
            <div class="mt-4 text-center text-xs text-text-secondary">
                <i class="fas fa-phone mr-1"></i>Hotline: {{ $siteSettings['site_hotline'] ?? '0866.000.000' }}
            </div>
        </div>

    </div>
</header>
