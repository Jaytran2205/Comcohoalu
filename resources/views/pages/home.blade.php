@extends('layouts.app')

@section('title', 'Cơm Cổ Hoa Lư - Tinh Hoa Ẩm Thực Cố Đô Ninh Bình')

@section('content')
<!-- 1. Hero Section (Full-bleed Intro Video Background & Glassmorphism Frosted Content Card) -->
<section id="hero-section" class="relative min-h-[110vh] flex items-center justify-center text-white overflow-hidden pt-20 sm:pt-24 pb-20">
    
    <!-- Video Intro Background Container -->
    <div class="absolute inset-0 z-0 select-none pointer-events-none overflow-hidden">
        <video 
            id="hero-intro-video"
            autoplay 
            loop 
            muted 
            playsinline 
            poster="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1600&auto=format&fit=crop" 
            class="w-full h-full object-cover object-center scale-[1.03] transition-transform duration-1000 ease-out"
        >
            <source src="https://assets.mixkit.co/videos/preview/mixkit-chef-cooking-a-dish-in-a-restaurant-kitchen-41551-large.mp4" type="video/mp4">
        </video>

        <!-- Warm Dark Overlay Gradient -->
        <div id="hero-video-overlay" class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80 z-10 transition-opacity duration-700"></div>
        <div class="absolute inset-0 viet-pattern-bg opacity-15 z-10"></div>
    </div>

    <!-- Hero Content Container -->
    <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center flex flex-col items-center">
        
        <!-- Semi-transparent Frosted Glass Container ("Thẻ mờ ẩn" - Initially hidden, reveals on scroll down) -->
        <div id="hero-glass-card" class="w-full bg-black/60 backdrop-blur-lg rounded-2xl border border-white/20 p-5 sm:p-8 md:p-10 shadow-2xl transition-all duration-700 transform opacity-0 pointer-events-none translate-y-10 scale-95 hover:border-secondary/40">
            
            <!-- Typography -->
            <div class="space-y-4 sm:space-y-5 max-w-4xl mx-auto">
                <!-- Eyebrow tag -->
                <div class="inline-flex items-center gap-2 px-4 py-1 border-t border-b border-secondary/60 text-secondary text-[10px] sm:text-xs font-bold uppercase tracking-[0.3em] select-none">
                    Di sản ẩm thực cố đô
                </div>

                <!-- Main Title (Bespoke Typographic Lockup) -->
                <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold font-serif leading-tight text-white drop-shadow-lg tracking-wide">
                    Tinh Hoa <span class="font-accent text-secondary text-2xl sm:text-3xl lg:text-5xl inline-block px-1 rotate-[-2deg] tracking-normal font-normal">ẩm thực</span> <br class="hidden sm:inline">
                    Đất Ngọc 
                    <span class="relative inline-block text-secondary font-black">
                        Hoa Lư
                        <svg class="absolute left-0 right-0 -bottom-2 w-full h-2 text-secondary" viewBox="0 0 100 8" preserveAspectRatio="none" fill="none">
                            <path d="M0,4 Q25,1 50,4 T100,4" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                        </svg>
                    </span>
                </h1>

                <!-- Slogan & Subtext -->
                <div class="space-y-2 pt-1">
                    <p class="text-accent text-base sm:text-xl text-secondary-light font-accent italic tracking-wide drop-shadow">
                        “Hương vị truyền thống – Đậm tình cố hương”
                    </p>
                    <p class="text-text-light/90 text-xs sm:text-sm leading-relaxed max-w-xl mx-auto font-sans font-medium">
                        Thưởng thức cơm niêu chín dẻo bên bếp lửa than hồng và dê núi Ninh Bình ngọt thịt giữa không gian cổ kính, đầm ấm.
                    </p>
                </div>
            </div>

            <!-- Quick Booking Bar Widget -->
            <form action="{{ route('booking.create') }}" method="GET" class="w-full bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-border-custom/40 p-4 sm:p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-5 text-text-primary mt-6 select-none text-left">
                <!-- Guests select -->
                <div class="space-y-1.5">
                    <label for="quick_adults" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider">
                        Số lượng khách
                    </label>
                    <div class="relative">
                        <select name="adults" id="quick_adults" class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-border-custom/60 bg-bg-primary/20 text-xs font-semibold focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 text-text-primary appearance-none">
                            <option value="1">1 Người</option>
                            <option value="2" selected>2 Người</option>
                            <option value="3">3 Người</option>
                            <option value="4">4 Người</option>
                            <option value="5">5 Người</option>
                            <option value="6">6 Người</option>
                            <option value="8">7 - 10 Người</option>
                            <option value="15">Trên 10 Người</option>
                        </select>
                        <div class="absolute left-3 top-3 text-secondary text-xs pointer-events-none">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="absolute right-3 top-3 text-text-secondary/50 text-[10px] pointer-events-none">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- Date picker -->
                <div class="space-y-1.5">
                    <label for="quick_date" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider">
                        Ngày dùng bữa
                    </label>
                    <div class="relative">
                        <input type="date" name="booking_date" id="quick_date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-border-custom/60 bg-bg-primary/20 text-xs font-semibold focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 text-text-primary">
                        <div class="absolute left-3 top-3 text-secondary text-xs pointer-events-none">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>

                <!-- Time picker -->
                <div class="space-y-1.5">
                    <label for="quick_time" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider">
                        Giờ dùng bữa
                    </label>
                    <div class="relative">
                        <select name="booking_time" id="quick_time" class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-border-custom/60 bg-bg-primary/20 text-xs font-semibold focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 text-text-primary appearance-none">
                            <option value="">-- Chọn giờ --</option>
                            <optgroup label="Khung Giờ Trưa">
                                <option value="11:00" selected>11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                            </optgroup>
                            <optgroup label="Khung Giờ Tối">
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                            </optgroup>
                        </select>
                        <div class="absolute left-3 top-3 text-secondary text-xs pointer-events-none">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="absolute right-3 top-3 text-text-secondary/50 text-[10px] pointer-events-none">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- Submit CTA -->
                <div class="flex items-end">
                    <button type="submit" class="w-full py-3 bg-primary hover:bg-secondary border border-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-[0.18em] rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center gap-2">
                        <i class="fas fa-calendar-check text-xs"></i> Đặt bàn ngay
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Scroll Down Cue Indicator (Visible on initial full-screen video intro) -->
    <div id="scroll-cue" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex flex-col items-center space-y-2 cursor-pointer transition-all duration-500 animate-bounce select-none">
        <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-white/90 drop-shadow">Cuộn xuống để khám phá</span>
        <div class="w-8 h-8 rounded-full bg-black/40 border border-white/30 backdrop-blur-xs flex items-center justify-center text-secondary shadow-lg">
            <i class="fas fa-chevron-down text-xs"></i>
        </div>
    </div>
</section>

<!-- 2. Introduction Section -->
<section class="py-20 bg-bg-primary relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left: Text -->
            <div class="space-y-6">
                <div class="space-y-3">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary font-serif leading-tight">Nơi Gìn Giữ <br>Hương Vị Niêu Cơm Đất Cổ</h2>
                    <div class="w-12 h-1 bg-secondary rounded-full"></div>
                </div>
                
                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Nằm ở vùng đất di sản cố đô Hoa Lư - Ninh Bình, <strong>Cơm Cổ Hoa Lư</strong> được sinh ra với sứ mệnh gìn giữ và tôn vinh những giá trị ẩm thực truyền thống Việt Nam. Chúng tôi khôi phục nguyên vẹn cách nấu cơm niêu đất cổ truyền, giữ lửa than hồng cháy đượm để tạo nên hạt cơm chín dẻo, thơm lừng và lớp cháy vàng giòn tan rụm.
                </p>

                <p class="text-text-secondary text-sm sm:text-base leading-relaxed">
                    Bên cạnh niêu cơm giản dị, các món ăn từ dê núi chăn thả tự nhiên trên núi đá Ninh Bình được chế biến công phu theo những bí quyết gia truyền từ ngàn xưa, mang đến cho thực khách những trải nghiệm ẩm thực vô giá.
                </p>

                <div class="grid grid-cols-2 gap-6 pt-4">
                    <div class="border-l-4 border-secondary pl-4">
                        <span class="block text-2xl font-bold text-primary font-serif">100%</span>
                        <span class="text-xs text-text-secondary">Nguyên liệu địa phương tươi sạch</span>
                    </div>
                    <div class="border-l-4 border-secondary pl-4">
                        <span class="block text-2xl font-bold text-primary font-serif">Gia Truyền</span>
                        <span class="text-xs text-text-secondary">Công thức chế biến ngàn năm</span>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="{{ route('about') }}" class="inline-flex items-center text-primary hover:text-primary-dark font-bold text-sm uppercase tracking-wider group transition-all">
                        Tìm hiểu thêm câu chuyện <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Right: Beautiful Layout Collage -->
            <div class="relative grid grid-cols-2 gap-4">
                <!-- Decorative background patch -->
                <div class="absolute -inset-4 bg-secondary/10 rounded-3xl -z-10 transform -rotate-2"></div>
                
                <div class="space-y-4">
                    <div class="rounded-xl overflow-hidden shadow-md h-64">
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=800&auto=format&fit=crop" alt="Ẩm thực Hoa Lư" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden shadow-md h-40 bg-primary/20 flex flex-col justify-center items-center text-center p-6 text-primary border border-primary/10">
                        <i class="fas fa-fire-alt text-3xl text-secondary mb-2"></i>
                        <span class="font-serif font-bold text-base">Cơm Niêu Đất Sét</span>
                        <span class="text-[10px] uppercase text-text-secondary mt-1">Nung lò than hồng</span>
                    </div>
                </div>
                
                <div class="space-y-4 pt-8">
                    <div class="rounded-xl overflow-hidden shadow-md h-40 bg-secondary flex flex-col justify-center items-center text-center p-6 text-bg-dark">
                        <i class="fas fa-leaf text-3xl text-bg-dark/80 mb-2"></i>
                        <span class="font-serif font-bold text-base">Sạch tự nhiên</span>
                        <span class="text-[10px] uppercase text-bg-dark/70 mt-1">Dê núi chăn thả</span>
                    </div>
                    <div class="rounded-xl overflow-hidden shadow-md h-64">
                        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?q=80&w=800&auto=format&fit=crop" alt="Nguyên liệu tươi sạch" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Featured Menu Section (Interactive Tabbed Showcase) -->
<section class="py-20 bg-bg-secondary relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold text-primary font-serif heading-decorator">Món Ngon Đặc Sản Cố Đô</h2>
            <p class="text-text-secondary text-sm md:text-base leading-relaxed max-w-xl mx-auto">
                Những món ăn đại diện cho tinh hoa văn hóa ẩm thực của đất trời Hoa Lư, Ninh Bình được thực khách yêu thích hàng đầu.
            </p>
        </div>

        @php
            $categories = $featuredItems->groupBy(function($item) {
                return $item->category ? $item->category->name : 'Đặc sản khác';
            });
        @endphp

        <!-- Category Tab Selectors -->
        <div class="flex flex-wrap justify-center gap-3 mb-10 select-none">
            <button class="menu-tab-btn px-6 py-2.5 rounded-full border border-border-custom/50 text-xs font-bold uppercase tracking-wider transition-all bg-primary text-white border-primary shadow-sm" data-category="all">
                Tất cả món ngon
            </button>
            @foreach($categories as $categoryName => $items)
                <button class="menu-tab-btn px-6 py-2.5 rounded-full border border-border-custom/50 text-xs font-bold uppercase tracking-wider transition-all bg-white text-text-primary hover:border-secondary hover:text-secondary shadow-sm" data-category="{{ Str::slug($categoryName) }}">
                    {{ $categoryName }}
                </button>
            @endforeach
        </div>

        <!-- Menu Tab Contents Container -->
        <div class="menu-tab-content-container">
            <!-- All items grid -->
            <div class="menu-tab-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="tab-grid-all">
                @include('partials.menu-grid', ['menuItems' => $featuredItems])
            </div>
            
            <!-- Category specific grids -->
            @foreach($categories as $categoryName => $items)
                <div class="menu-tab-grid hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="tab-grid-{{ Str::slug($categoryName) }}">
                    @include('partials.menu-grid', ['menuItems' => $items])
                </div>
            @endforeach
        </div>

        <!-- View All CTA -->
        <div class="text-center mt-14">
            <a href="{{ route('menu') }}" class="inline-block px-8 py-3.5 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02] text-xs uppercase tracking-wider">
                <i class="fas fa-utensils mr-2"></i> Khám phá toàn bộ thực đơn
            </a>
        </div>

    </div>
</section>

<!-- 4. Restaurant Ambiance (Không gian quán - 3-Column Clean Showcase Grid) -->
<section class="py-20 bg-bg-primary relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary font-serif leading-tight">Góc Nhìn Cổ Kính & Ấm Cúng</h2>
            <div class="w-12 h-1 bg-secondary rounded-full mx-auto"></div>
            <p class="text-text-secondary text-sm md:text-base leading-relaxed max-w-xl mx-auto">
                Mỗi góc bàn, mỗi ngọn đèn đều mang hơi thở mộc mạc cổ xưa của cung điện Tràng An, đem lại không gian dùng bữa đầm ấm và yên bình.
            </p>
        </div>

        <!-- Spaces Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Space 1 -->
            <div class="group relative h-[28rem] overflow-hidden rounded-xl border border-border-custom/30 shadow-md">
                <img 
                    src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=800&auto=format&fit=crop" 
                    alt="Đại Sảnh Cổ Kính" 
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-6 text-white space-y-2 select-none">
                    <span class="text-secondary text-[10px] font-bold uppercase tracking-widest">Không gian 01</span>
                    <h3 class="font-serif font-bold text-xl drop-shadow-sm">Đại Sảnh Cổ Kính</h3>
                    <p class="text-white/80 text-xs leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 max-w-sm">
                        Không gian gỗ ấm cúng lợp ngói đỏ truyền thống, thích hợp cho các bữa tiệc sum họp gia đình và gặp gỡ bạn bè thân tình.
                    </p>
                </div>
            </div>

            <!-- Space 2 -->
            <div class="group relative h-[28rem] overflow-hidden rounded-xl border border-border-custom/30 shadow-md">
                <img 
                    src="https://images.unsplash.com/photo-1543007630-9710e4a00a20?q=80&w=800&auto=format&fit=crop" 
                    alt="Phòng VIP Vương Triều" 
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-6 text-white space-y-2 select-none">
                    <span class="text-secondary text-[10px] font-bold uppercase tracking-widest">Không gian 02</span>
                    <h3 class="font-serif font-bold text-xl drop-shadow-sm">Phòng VIP Vương Triều</h3>
                    <p class="text-white/80 text-xs leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 max-w-sm">
                        Sự riêng tư sang trọng tái hiện phong cách cung điện hoàng gia Hoa Lư cổ, thích hợp tiếp đãi đối tác và khách quý.
                    </p>
                </div>
            </div>

            <!-- Space 3 -->
            <div class="group relative h-[28rem] overflow-hidden rounded-xl border border-border-custom/30 shadow-md">
                <img 
                    src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop" 
                    alt="Sân Vườn Yên Bình" 
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 inset-x-0 p-6 text-white space-y-2 select-none">
                    <span class="text-secondary text-[10px] font-bold uppercase tracking-widest">Không gian 03</span>
                    <h3 class="font-serif font-bold text-xl drop-shadow-sm">Sân Vườn Yên Bình</h3>
                    <p class="text-white/80 text-xs leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 max-w-sm">
                        Không gian ăn uống ngoài trời khoáng đạt mát mẻ bên lũy tre xanh mộc mạc, hòa cùng làn gió thiên nhiên dịu mát.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- 5. News & Promotions Section (Overhauled to Split Editorial List) -->
<section class="py-20 bg-bg-secondary relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-3xl font-bold text-primary font-serif mt-2">Góc Chia Sẻ Ẩm Thực</h2>
            </div>
            <div>
                <a href="{{ route('posts.category', 'tin-tuc') }}" class="inline-flex items-center text-primary hover:text-primary-dark font-bold text-sm uppercase tracking-wider group transition-all">
                    Xem tất cả bài viết <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1.5 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Posts Split Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            @if($latestPosts->isNotEmpty())
                @php
                    $featuredPost = $latestPosts->first();
                    $otherPosts = $latestPosts->slice(1);
                @endphp
                
                <!-- Left: Featured Post (col-span-6) -->
                <div class="lg:col-span-6">
                    <article class="premium-card bg-white overflow-hidden h-full flex flex-col justify-between group rounded-2xl border border-border-custom/30 shadow-sm">
                        <div class="relative aspect-[16/10] bg-bg-secondary overflow-hidden">
                            <img 
                                src="{{ $featuredPost->featured_image ? (str_starts_with($featuredPost->featured_image, 'http') ? $featuredPost->featured_image : asset('storage/' . $featuredPost->featured_image)) : asset('images/default-post.jpg') }}" 
                                alt="{{ $featuredPost->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
                                onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                            >
                            @if($featuredPost->category)
                                <span class="absolute top-4 left-4 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded bg-primary text-white">
                                    {{ $featuredPost->category->name }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="text-xs text-text-secondary/70 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-secondary"></i>
                                    <span>{{ $featuredPost->published_at ? $featuredPost->published_at->format('d/m/Y') : $featuredPost->created_at->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="font-serif font-bold text-xl md:text-2xl text-primary hover:text-primary-light transition-colors line-clamp-2">
                                    <a href="{{ route('posts.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                                </h3>
                                <p class="text-text-secondary text-sm leading-relaxed line-clamp-3">
                                    {{ $featuredPost->summary ?: 'Chia sẻ những câu chuyện ẩm thực thú vị, nét đẹp văn hóa và các chương trình ưu đãi lớn chỉ có tại Cơm Cổ Hoa Lư.' }}
                                </p>
                            </div>
                            
                            <div class="pt-4 mt-6 border-t border-border-custom/20">
                                <a href="{{ route('posts.show', $featuredPost->slug) }}" class="text-primary hover:text-primary-dark font-bold text-xs uppercase tracking-wider inline-flex items-center gap-1 transition-all">
                                    Xem bài viết <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Right: Other Posts List (col-span-6) -->
                <div class="lg:col-span-6 flex flex-col justify-start divide-y divide-border-custom/15">
                    @foreach($otherPosts as $post)
                        <article class="py-5 first:pt-0 last:pb-0 flex gap-4 sm:gap-6 items-center group">
                            <!-- Thumbnail -->
                            <div class="w-24 h-16 sm:w-32 sm:h-20 rounded-lg overflow-hidden bg-bg-secondary flex-shrink-0 border border-border-custom/20 select-none">
                                <img 
                                    src="{{ $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/default-post.jpg') }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                                >
                            </div>
                            
                            <!-- Text details -->
                            <div class="flex-grow space-y-1">
                                <div class="text-[10px] text-text-secondary/65 flex items-center gap-2">
                                    <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                                    @if($post->category)
                                        <span class="text-secondary font-bold">•</span>
                                        <span class="text-secondary-dark font-bold uppercase">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                                <h4 class="font-serif font-bold text-sm sm:text-base text-primary hover:text-primary-light transition-colors line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h4>
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-primary hover:text-primary-dark font-bold text-[10px] uppercase tracking-wider inline-flex items-center gap-1 transition-all mt-1">
                                    Đọc tiếp <i class="fas fa-chevron-right text-[8px]"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="col-span-full py-12 text-center text-text-secondary">
                    <p class="font-serif">Chưa có bài viết mới nào được cập nhật.</p>
                </div>
            @endif
        </div>

    </div>
</section>

<!-- 6. Call To Action (Booking Teaser) -->
<section class="py-16 bg-bg-dark text-white relative overflow-hidden">
    <div class="absolute inset-0 viet-pattern-bg opacity-10"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <h2 class="text-3xl md:text-4xl font-bold font-serif text-secondary tracking-wide">Đặt Bàn Thưởng Thức Ngay Hôm Nay</h2>
        <p class="text-text-light/80 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
            Nhà hàng mở cửa phục vụ Trưa (10:00 - 14:00) và Tối (17:00 - 22:00). Quý khách nên đặt bàn trước ít nhất 30 phút để chúng tôi chuẩn bị niêu cơm và các món ngon một cách chu đáo nhất.
        </p>
        <div class="pt-4">
            <a href="{{ route('booking.create') }}" class="inline-block px-8 py-4 bg-secondary hover:bg-secondary-dark text-bg-dark font-bold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-[1.02]">
                <i class="fas fa-calendar-check mr-2"></i>Tiến hành đặt bàn
            </a>
        </div>
        <p class="text-xs text-text-light/65">
            Hotline đặt tiệc trực tiếp: <span class="text-secondary font-semibold">{{ $siteSettings['site_hotline'] ?? '0866.000.000' }}</span>
        </p>
    </div>
</section>

@section('scripts')
<script>
$(document).ready(function() {
    // Menu interactive category tabs filtering
    $('.menu-tab-btn').on('click', function() {
        const cat = $(this).data('category');
        
        // Update button states
        $('.menu-tab-btn').removeClass('bg-primary text-white border-primary').addClass('bg-white text-text-primary');
        $(this).removeClass('bg-white text-text-primary').addClass('bg-primary text-white border-primary');
        
        // Show/hide grids
        $('.menu-tab-grid').addClass('hidden');
        $(`#tab-grid-${cat}`).removeClass('hidden');
    });
});
</script>
@endsection
@endsection
