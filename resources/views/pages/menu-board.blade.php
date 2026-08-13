@extends('layouts.app')

@section('title', 'Thực Đơn Tương Tác - Cơm Cổ Hoa Lư')
@section('meta_description', 'Khám phá thực đơn chi tiết nhà hàng Cơm Cổ Hoa Lư với trải nghiệm sách lật 3D tương tác độc đáo và sang trọng.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Thực Đơn Chi Tiết',
    'items' => [
        ['label' => 'Thực Đơn Chi Tiết', 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden min-h-[85vh]">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary/3 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-secondary/3 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 space-y-10 relative">
        
        <!-- Intro text & Mode Switcher -->
        <div class="text-center max-w-2xl mx-auto space-y-4">
            <h2 class="text-3xl font-serif font-bold text-primary">Thực Đơn Chi Tiết</h2>
            <div class="w-12 h-0.5 bg-secondary mx-auto"></div>
            <p class="text-text-secondary text-sm leading-relaxed max-w-md mx-auto">
                Trải nghiệm sách lật thực đơn 3D chân thực hoặc chuyển sang chế độ lưới truyền thống.
            </p>
            
            <!-- Mode Selector Switch -->
            <div class="inline-flex p-1 bg-bg-secondary rounded-xl border border-border-custom/50 shadow-xs">
                <button id="btn-mode-flip" onclick="switchMode('flip')" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-primary text-white shadow-xs">
                    <i class="fas fa-book-open"></i>
                    <span>Sách Lật 3D</span>
                </button>
                <button id="btn-mode-grid" onclick="switchMode('grid')" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-secondary hover:text-primary">
                    <i class="fas fa-th-large"></i>
                    <span>Dạng Lưới</span>
                </button>
            </div>
        </div>

        <!-- ======================= 1. MODE: 3D FLIPBOOK ======================= -->
        <div id="view-mode-flip" class="space-y-6 max-w-lg mx-auto transition-all duration-300">
            <!-- Book Container -->
            <div class="relative w-full aspect-[3/4.2] xs:aspect-[3/4.1] sm:aspect-[3/4] bg-white rounded-2xl shadow-2xl border-4 border-amber-900/35 overflow-hidden group select-none">
                <!-- Leather Spine Binder Effect -->
                <div class="absolute left-0 top-0 bottom-0 w-4 bg-gradient-to-r from-amber-950 via-amber-900 to-amber-950/20 z-30 shadow-inner"></div>
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-white/10 z-30"></div>

                <!-- Page Stack -->
                <div class="relative w-full h-full" id="flipbook-pages">
                    <!-- Page 1 (Cover) -->
                    <div class="flipbook-page active absolute inset-0 w-full h-full transition-transform duration-500 origin-left z-10" data-page="1">
                        <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Bìa Menu" class="w-full h-full object-fill">
                    </div>

                    <!-- Page 2 (Khai Vị) -->
                    <div class="flipbook-page absolute inset-0 w-full h-full transition-transform duration-500 origin-left z-0 pointer-events-none opacity-0" data-page="2">
                        <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Menu Khai Vị Bò Hải Sản" class="w-full h-full object-fill">
                    </div>

                    <!-- Page 3 (Dê Núi) -->
                    <div class="flipbook-page absolute inset-0 w-full h-full transition-transform duration-500 origin-left z-0 pointer-events-none opacity-0" data-page="3">
                        <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Menu Dê Núi Ninh Bình" class="w-full h-full object-fill">
                    </div>

                    <!-- Page 4 (Cá Tôm) -->
                    <div class="flipbook-page absolute inset-0 w-full h-full transition-transform duration-500 origin-left z-0 pointer-events-none opacity-0" data-page="4">
                        <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Menu Cá Tôm Cua" class="w-full h-full object-fill">
                    </div>

                    <!-- Page 5 (Thịt Lợn Gà) -->
                    <div class="flipbook-page absolute inset-0 w-full h-full transition-transform duration-500 origin-left z-0 pointer-events-none opacity-0" data-page="5">
                        <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Menu Thịt Lợn Gà" class="w-full h-full object-fill">
                    </div>
                </div>

                <!-- Interactive left/right click areas to turn pages -->
                <div class="absolute top-0 bottom-0 left-4 w-1/3 z-20 cursor-w-resize" onclick="prevPage()"></div>
                <div class="absolute top-0 bottom-0 right-0 w-2/3 z-20 cursor-e-resize" onclick="nextPage()"></div>

                <!-- Page Number Tag -->
                <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-xs text-white text-[10px] sm:text-xs px-2.5 py-1 rounded-md z-30 font-semibold" id="page-indicator">
                    Trang 1 / 5
                </div>
            </div>

            <!-- Controls and Indicators -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <!-- Navigation Buttons -->
                <div class="flex items-center space-x-4">
                    <button onclick="prevPage()" class="w-10 h-10 rounded-full bg-white hover:bg-primary hover:text-white border border-border-custom flex items-center justify-center text-text-primary transition-all shadow-xs focus:outline-none">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <!-- Indicators Dot matrix -->
                    <div class="flex items-center space-x-2" id="dot-indicators">
                        <span onclick="goToPage(1)" class="w-2.5 h-2.5 rounded-full bg-primary cursor-pointer transition-all duration-300"></span>
                        <span onclick="goToPage(2)" class="w-2 h-2 rounded-full bg-border-custom cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                        <span onclick="goToPage(3)" class="w-2 h-2 rounded-full bg-border-custom cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                        <span onclick="goToPage(4)" class="w-2 h-2 rounded-full bg-border-custom cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                        <span onclick="goToPage(5)" class="w-2 h-2 rounded-full bg-border-custom cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                    </div>
                    <button onclick="nextPage()" class="w-10 h-10 rounded-full bg-white hover:bg-primary hover:text-white border border-border-custom flex items-center justify-center text-text-primary transition-all shadow-xs focus:outline-none">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-3 text-xs text-text-secondary">
                    <span><i class="fas fa-hand-pointer mr-1 text-primary"></i> Nhấp chuột vào trang bên phải để lật tiếp</span>
                </div>

                <a href="{{ route('booking.create') }}" class="px-8 py-3.5 bg-primary hover:bg-secondary border border-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-all">
                    <i class="fas fa-calendar-alt mr-1.5"></i> Đặt bàn dùng bữa ngay
                </a>
            </div>
        </div>

        <!-- ======================= 2. MODE: DANG LUOI (UNCROPPED) ======================= -->
        <div id="view-mode-grid" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-4 transition-all duration-300">
            
            <!-- 1. Cover Page -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_3.jpg') }}')">
                    <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Bìa Menu" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to bìa menu
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 1: Bìa Thực Đơn</h3>
                </div>
            </div>

            <!-- 2. Khai Vị - Bò - Hải Sản -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_4.jpg') }}')">
                    <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Menu Khai vị, Hải sản, Món bò" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 2: Khai Vị - Bò - Hải Sản</h3>
                </div>
            </div>

            <!-- 3. Dê Núi Ninh Bình -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_1.jpg') }}')">
                    <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Menu Đặc sản Dê Núi" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 3: Đặc Sản Dê Núi</h3>
                </div>
            </div>

            <!-- 4. Món Cá - Tôm - Cua -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_2.jpg') }}')">
                    <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Menu Món cá, Tôm cua" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 4: Món Cá - Tôm - Cua</h3>
                </div>
            </div>

            <!-- 5. Món Thịt Lợn - Món Gà -->
            <div class="space-y-3 text-center">
                <div class="relative rounded-xl overflow-hidden border-2 border-border-custom bg-white shadow-md hover:shadow-xl transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_5.jpg') }}')">
                    <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Menu Món lợn, Gà" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-3.5 py-2 bg-black/60 backdrop-blur-xs text-white text-[11px] font-bold rounded-lg shadow-md">
                            <i class="fas fa-search-plus mr-1.5 text-secondary"></i> Phóng to thực đơn
                        </span>
                    </div>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-sm text-primary">Trang 5: Món Gà - Thịt Lợn</h3>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Zoom Lightbox Modal (For Grid Mode) -->
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

<!-- CSS 3D page fold animation -->
<style>
    .flipbook-page {
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
    
    /* Turning forward fold (rotating left) */
    .page-turn-forward {
        animation: turnForward 0.6s cubic-bezier(0.645, 0.045, 0.355, 1) forwards;
    }
    
    /* Turning backward unfold (rotating right) */
    .page-turn-backward {
        animation: turnBackward 0.6s cubic-bezier(0.645, 0.045, 0.355, 1) forwards;
    }

    @keyframes turnForward {
        0% {
            transform: rotateY(0deg);
            opacity: 1;
            z-index: 10;
        }
        50% {
            opacity: 0.8;
        }
        100% {
            transform: rotateY(-120deg);
            opacity: 0;
            z-index: 0;
        }
    }

    @keyframes turnBackward {
        0% {
            transform: rotateY(-120deg);
            opacity: 0;
            z-index: 0;
        }
        50% {
            opacity: 0.8;
        }
        100% {
            transform: rotateY(0deg);
            opacity: 1;
            z-index: 10;
        }
    }
</style>

<script>
    let currentPage = 1;
    const totalPages = 5;
    let isTransitioning = false;

    function switchMode(mode) {
        const flipBtn = document.getElementById('btn-mode-flip');
        const gridBtn = document.getElementById('btn-mode-grid');
        const flipView = document.getElementById('view-mode-flip');
        const gridView = document.getElementById('view-mode-grid');

        if (mode === 'flip') {
            // Activate flip view
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-primary text-white shadow-xs";
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-secondary hover:text-primary";
            flipView.classList.remove('hidden');
            gridView.classList.add('hidden');
        } else {
            // Activate grid view
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-primary text-white shadow-xs";
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-secondary hover:text-primary";
            gridView.classList.remove('hidden');
            flipView.classList.add('hidden');
        }
    }

    function nextPage() {
        if (currentPage >= totalPages || isTransitioning) return;
        isTransitioning = true;

        const currentEl = document.querySelector(`.flipbook-page[data-page="${currentPage}"]`);
        currentPage++;
        const nextEl = document.querySelector(`.flipbook-page[data-page="${currentPage}"]`);

        // Prepare next page
        nextEl.classList.remove('pointer-events-none', 'opacity-0');
        nextEl.style.zIndex = '5';
        nextEl.style.transform = 'rotateY(0deg)';

        // Animate current page away
        currentEl.className = "flipbook-page absolute inset-0 w-full h-full origin-left page-turn-forward";
        
        setTimeout(() => {
            currentEl.classList.add('pointer-events-none', 'opacity-0');
            currentEl.style.zIndex = '0';
            nextEl.style.zIndex = '10';
            nextEl.classList.add('active');
            currentEl.classList.remove('active');
            updateIndicators();
            isTransitioning = false;
        }, 580);
    }

    function prevPage() {
        if (currentPage <= 1 || isTransitioning) return;
        isTransitioning = true;

        const currentEl = document.querySelector(`.flipbook-page[data-page="${currentPage}"]`);
        currentPage--;
        const prevEl = document.querySelector(`.flipbook-page[data-page="${currentPage}"]`);

        // Prepare previous page
        prevEl.classList.remove('pointer-events-none', 'opacity-0');
        prevEl.style.zIndex = '15'; // Put on top to slide back down
        prevEl.className = "flipbook-page absolute inset-0 w-full h-full origin-left page-turn-backward";

        setTimeout(() => {
            currentEl.classList.add('pointer-events-none', 'opacity-0');
            currentEl.style.zIndex = '0';
            prevEl.style.zIndex = '10';
            prevEl.classList.add('active');
            currentEl.classList.remove('active');
            updateIndicators();
            isTransitioning = false;
        }, 580);
    }

    function goToPage(target) {
        if (target === currentPage || isTransitioning || target < 1 || target > totalPages) return;
        
        // Quick jumps
        if (target > currentPage) {
            nextPage();
            if (target > currentPage) {
                setTimeout(() => goToPage(target), 600);
            }
        } else {
            prevPage();
            if (target < currentPage) {
                setTimeout(() => goToPage(target), 600);
            }
        }
    }

    function updateIndicators() {
        // Update page text
        document.getElementById('page-indicator').innerText = `Trang ${currentPage} / ${totalPages}`;

        // Update dot indicators
        const dots = document.querySelectorAll('#dot-indicators span');
        dots.forEach((dot, idx) => {
            if (idx + 1 === currentPage) {
                dot.className = "w-2.5 h-2.5 rounded-full bg-primary cursor-pointer transition-all duration-300";
            } else {
                dot.className = "w-2 h-2 rounded-full bg-border-custom cursor-pointer transition-all duration-300 hover:bg-primary/50";
            }
        });
    }

    // Touch gesture support for mobile swiping
    let touchStartX = 0;
    let touchEndX = 0;

    const book = document.getElementById('flipbook-pages');
    book.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });

    book.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const threshold = 50;
        if (touchStartX - touchEndX > threshold) {
            nextPage(); // swipe left -> next page
        } else if (touchEndX - touchStartX > threshold) {
            prevPage(); // swipe right -> prev page
        }
    }

    // Grid Lightbox Zoom functions
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
