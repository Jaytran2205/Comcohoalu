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

<section class="py-16 bg-bg-primary relative">
    <div class="max-w-7xl mx-auto px-4 space-y-12">
        
        <!-- Intro text -->
        <div class="text-center max-w-2xl mx-auto space-y-4">
            <h2 class="text-3xl font-serif font-bold text-primary">Thực Đơn Bản Ảnh Chi Tiết</h2>
            <div class="w-12 h-0.5 bg-secondary mx-auto"></div>
            <p class="text-text-secondary text-sm leading-relaxed max-w-xl mx-auto">
                Nhấp chuột hoặc chạm vào trang thực đơn bất kỳ để phóng to xem rõ giá tiền và chi tiết món ăn.
            </p>
            <div class="pt-2">
                <a href="{{ route('booking.create') }}" class="inline-flex items-center px-6 py-2.5 bg-primary hover:bg-primary-dark text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-all transform active:scale-95">
                    <i class="fas fa-calendar-alt mr-2"></i> Đặt bàn dùng bữa ngay
                </a>
            </div>
        </div>

        <!-- Responsive Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 pt-4">
            
            <!-- 1. Cover Page -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_3.jpg') }}')">
                    <img 
                        src="{{ asset('images/menu/media_3.jpg') }}" 
                        alt="Bìa Menu Cơm Cổ Hoa Lư" 
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md flex items-center">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to bìa menu
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 1: Bìa Thực Đơn</h3>
                    <span class="text-[10px] text-text-secondary uppercase">Cơm Cổ Hoa Lư</span>
                </div>
            </div>

            <!-- 2. Khai Vị - Bò - Hải Sản -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_4.jpg') }}')">
                    <img 
                        src="{{ asset('images/menu/media_4.jpg') }}" 
                        alt="Menu Khai vị, Hải sản, Món bò" 
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md flex items-center">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 2: Khai Vị - Bò - Hải Sản</h3>
                    <span class="text-[10px] text-text-secondary uppercase">Khoai chiên, Ngô chiên, Mực, Cá thu...</span>
                </div>
            </div>

            <!-- 3. Dê Núi Ninh Bình -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_1.jpg') }}')">
                    <img 
                        src="{{ asset('images/menu/media_1.jpg') }}" 
                        alt="Menu Đặc sản Dê Núi Ninh Bình" 
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md flex items-center">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 3: Đặc Sản Dê Núi</h3>
                    <span class="text-[10px] text-text-secondary uppercase">Dê tái chanh, Dê chao, Dê ủ trấu...</span>
                </div>
            </div>

            <!-- 4. Món Cá - Tôm - Cua -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_2.jpg') }}')">
                    <img 
                        src="{{ asset('images/menu/media_2.jpg') }}" 
                        alt="Menu Món cá, Tôm cua ốc ếch" 
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md flex items-center">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 4: Món Cá - Tôm - Cua</h3>
                    <span class="text-[10px] text-text-secondary uppercase">Cá chuối, Cá tầm, Ếch đồng, Chả ốc...</span>
                </div>
            </div>

            <!-- 5. Món Thịt Lợn - Món Gà -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_5.jpg') }}')">
                    <img 
                        src="{{ asset('images/menu/media_5.jpg') }}" 
                        alt="Menu Món thịt lợn, Món gà" 
                        class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105"
                    >
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md flex items-center">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 5: Món Gà - Thịt Lợn</h3>
                    <span class="text-[10px] text-text-secondary uppercase">Gà rang muối, Sườn xào, Thịt chưng mắm tép...</span>
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
