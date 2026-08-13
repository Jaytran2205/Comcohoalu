@extends('layouts.app')

@section('title', 'Thực Đơn Chi Tiết - Cơm Cổ Hoa Lư')
@section('meta_description', 'Khám phá thực đơn chi tiết nhà hàng Cơm Cổ Hoa Lư với các món đặc sản dê núi Ninh Bình, cá tầm, bò và các món đồng quê truyền thống.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Thực Đơn Chi Tiết',
    'items' => [
        ['label' => 'Thực Đơn Chi Tiết', 'url' => null]
    ]
])

<!-- Section Selection & Navigation -->
<div class="bg-bg-secondary/40 border-b border-border-custom/20 sticky top-16 z-30 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4 overflow-x-auto scrollbar-none select-none">
        <div class="flex items-center space-x-1.5 whitespace-nowrap text-xs">
            <button onclick="scrollToPage('menu-page-cover')" class="px-4 py-2 rounded-full border border-primary/20 bg-primary/5 text-primary hover:bg-primary hover:text-white font-bold transition-all">
                <i class="fas fa-book-open mr-1"></i> Bìa Menu
            </button>
            <button onclick="scrollToPage('menu-page-khai-vi')" class="px-4 py-2 rounded-full border border-border-custom/50 bg-white text-text-secondary hover:border-primary/50 hover:text-primary font-semibold transition-all">
                <i class="fas fa-cookie-bite mr-1"></i> Khai Vị - Bò - Hải Sản
            </button>
            <button onclick="scrollToPage('menu-page-de-nui')" class="px-4 py-2 rounded-full border border-border-custom/50 bg-white text-text-secondary hover:border-primary/50 hover:text-primary font-semibold transition-all">
                <i class="fas fa-mountain mr-1"></i> Dê Núi Ninh Bình
            </button>
            <button onclick="scrollToPage('menu-page-ca-tom')" class="px-4 py-2 rounded-full border border-border-custom/50 bg-white text-text-secondary hover:border-primary/50 hover:text-primary font-semibold transition-all">
                <i class="fas fa-fish mr-1"></i> Món Cá - Tôm - Cua
            </button>
            <button onclick="scrollToPage('menu-page-lon-ga')" class="px-4 py-2 rounded-full border border-border-custom/50 bg-white text-text-secondary hover:border-primary/50 hover:text-primary font-semibold transition-all">
                <i class="fas fa-feather mr-1"></i> Thịt Lợn - Món Gà
            </button>
        </div>

        <a href="{{ route('booking.create') }}" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm whitespace-nowrap flex-shrink-0 transition-transform active:scale-95">
            <i class="fas fa-calendar-alt mr-1.5"></i> Đặt bàn dùng bữa
        </a>
    </div>
</div>

<section class="py-12 bg-bg-primary relative">
    <div class="max-w-4xl mx-auto px-4 space-y-16">
        
        <!-- Intro text -->
        <div class="text-center max-w-xl mx-auto mb-10 space-y-3">
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-primary">Menu Chi Tiết Nhà Hàng</h2>
            <div class="w-12 h-0.5 bg-secondary mx-auto"></div>
            <p class="text-text-secondary text-xs leading-relaxed">
                Bấm vào từng trang thực đơn để xem ở kích thước phóng to, sắc nét hơn. Cam kết nguyên liệu tự nhiên tươi ngon chuẩn vị cố đô Hoa Lư.
            </p>
        </div>

        <!-- 1. Cover Page -->
        <div id="menu-page-cover" class="space-y-4 text-center scroll-mt-28">
            <span class="inline-block px-3 py-1 bg-secondary/15 text-secondary-dark font-serif font-bold text-xs rounded-full">
                Trang 1 / 5
            </span>
            <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border-4 border-border-custom bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_3.jpg') }}')">
                <img 
                    src="{{ asset('images/menu/media_3.jpg') }}" 
                    alt="Bìa Menu Cơm Cổ Hoa Lư" 
                    class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.01]"
                >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="px-4 py-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. Khai Vị - Bò - Hải Sản -->
        <div id="menu-page-khai-vi" class="space-y-4 text-center scroll-mt-28">
            <span class="inline-block px-3 py-1 bg-secondary/15 text-secondary-dark font-serif font-bold text-xs rounded-full">
                Trang 2 / 5
            </span>
            <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border-4 border-border-custom bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_4.jpg') }}')">
                <img 
                    src="{{ asset('images/menu/media_4.jpg') }}" 
                    alt="Menu Khai vị, Hải sản, Món bò" 
                    class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.01]"
                >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="px-4 py-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
        </div>

        <!-- 3. Dê Núi Ninh Bình -->
        <div id="menu-page-de-nui" class="space-y-4 text-center scroll-mt-28">
            <span class="inline-block px-3 py-1 bg-secondary/15 text-secondary-dark font-serif font-bold text-xs rounded-full">
                Trang 3 / 5
            </span>
            <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border-4 border-border-custom bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_1.jpg') }}')">
                <img 
                    src="{{ asset('images/menu/media_1.jpg') }}" 
                    alt="Menu Đặc sản Dê Núi Ninh Bình" 
                    class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.01]"
                >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="px-4 py-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
        </div>

        <!-- 4. Món Cá - Tôm - Cua - Ốc - Ếch -->
        <div id="menu-page-ca-tom" class="space-y-4 text-center scroll-mt-28">
            <span class="inline-block px-3 py-1 bg-secondary/15 text-secondary-dark font-serif font-bold text-xs rounded-full">
                Trang 4 / 5
            </span>
            <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border-4 border-border-custom bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_2.jpg') }}')">
                <img 
                    src="{{ asset('images/menu/media_2.jpg') }}" 
                    alt="Menu Món cá, Tôm cua ốc ếch" 
                    class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.01]"
                >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="px-4 py-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
        </div>

        <!-- 5. Món Thịt Lợn - Món Gà -->
        <div id="menu-page-lon-ga" class="space-y-4 text-center scroll-mt-28">
            <span class="inline-block px-3 py-1 bg-secondary/15 text-secondary-dark font-serif font-bold text-xs rounded-full">
                Trang 5 / 5
            </span>
            <div class="relative max-w-2xl mx-auto rounded-2xl overflow-hidden border-4 border-border-custom bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_5.jpg') }}')">
                <img 
                    src="{{ asset('images/menu/media_5.jpg') }}" 
                    alt="Menu Món thịt lợn, Món gà" 
                    class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.01]"
                >
                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="px-4 py-2 bg-black/60 backdrop-blur-xs text-white text-xs font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Zoom Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 z-50 hidden bg-black/95 flex flex-col justify-between p-4 select-none">
    <div class="flex justify-between items-center text-white/80 p-2 sm:p-4">
        <span class="text-xs font-semibold uppercase tracking-wider"><i class="fas fa-search-plus mr-2 text-secondary"></i>Đang Xem Thực Đơn</span>
        <button onclick="closeZoom()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all focus:outline-none">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    
    <div class="flex-grow flex items-center justify-center max-h-[80vh] overflow-y-auto pr-1">
        <img id="lightbox-img" src="" alt="Menu phóng to" class="max-w-full max-h-[75vh] object-contain rounded-lg border border-white/20 shadow-2xl">
    </div>

    <div class="py-4 text-center flex flex-col items-center justify-center gap-3">
        <p class="text-white/60 text-[10px] sm:text-xs">Bấm bất kỳ khu vực màu đen hoặc nút X để đóng chế độ xem.</p>
        <a href="{{ route('booking.create') }}" class="px-8 py-3.5 bg-primary hover:bg-secondary border border-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-lg transition-all transform active:scale-95">
            <i class="fas fa-calendar-alt mr-2"></i> Đặt bàn ăn món này ngay
        </a>
    </div>
</div>

<script>
    function scrollToPage(id) {
        const el = document.getElementById(id);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function openZoom(src) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        if (modal && img) {
            img.src = src;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeZoom() {
        const modal = document.getElementById('lightbox-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Close when clicking backdrop outside image
    document.getElementById('lightbox-modal').addEventListener('click', function(e) {
        if (e.target === this || e.target.classList.contains('flex-grow')) {
            closeZoom();
        }
    });
</script>
@endsection
