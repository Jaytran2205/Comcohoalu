@extends('layouts.app')

@section('title', 'Thực Đơn Tương Tác 3D - Cơm Cổ Hoa Lư')
@section('meta_description', 'Trải nghiệm sách lật thực đơn 3D đôi cao cấp độc đáo của nhà hàng Cơm Cổ Hoa Lư. Tương tác lật trang chân thực.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Thực Đơn Chi Tiết',
    'items' => [
        ['label' => 'Thực Đơn Chi Tiết', 'url' => null]
    ]
])

<section class="py-16 bg-[#16120e] relative overflow-hidden min-h-[90vh] flex flex-col justify-between text-white">
    <!-- Ambient Lighting & Wooden Table Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#3a271c]/40 via-[#16120e] to-[#0a0807] z-0"></div>
    
    <!-- Top Intro & Toggle -->
    <div class="max-w-7xl mx-auto px-4 text-center z-10 space-y-4">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-secondary">Thực Đơn Bản Sách Lật 3D</h2>
        <div class="w-16 h-0.5 bg-secondary mx-auto"></div>
        <p class="text-text-light/60 text-xs sm:text-sm max-w-md mx-auto">
            Vuốt hoặc nhấp vào mép trang để lật mở thực đơn đôi độc đáo.
        </p>

        <!-- Mode Switcher -->
        <div class="inline-flex p-1 bg-white/5 rounded-xl border border-white/10 shadow-lg">
            <button id="btn-mode-flip" onclick="switchMode('flip')" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-secondary text-bg-dark shadow-md">
                <i class="fas fa-book-open"></i>
                <span>Sách Lật 3D</span>
            </button>
            <button id="btn-mode-grid" onclick="switchMode('grid')" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-light/60 hover:text-white">
                <i class="fas fa-th-large"></i>
                <span>Dạng Lưới</span>
            </button>
        </div>
    </div>

    <!-- ======================= 1. MODE: 3D DUAL-PAGE FLIPBOOK ======================= -->
    <div id="view-mode-flip" class="w-full flex flex-col items-center justify-center my-8 z-10 space-y-8 select-none">
        
        <!-- Book Wrapper with scaling for mobile support -->
        <div class="book-scale-wrapper w-full max-w-4xl px-4 flex items-center justify-center">
            <div class="book-container">
                <div class="book" id="book-3d">
                    
                    <!-- Cover Page / Sheet 1 -->
                    <div class="paper-sheet z-[30]" id="sheet1">
                        <!-- Front (Bìa Menu - Page 1) -->
                        <div class="page-face front-face">
                            <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Bìa Thực Đơn" class="w-full h-full object-fill">
                            <div class="page-overlay-glow"></div>
                        </div>
                        <!-- Back (Khai vị - Page 2) -->
                        <div class="page-face back-face">
                            <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Khai vị" class="w-full h-full object-fill">
                            <div class="page-overlay-glow shadow-left"></div>
                        </div>
                    </div>

                    <!-- Page 3 & 4 / Sheet 2 -->
                    <div class="paper-sheet z-[20]" id="sheet2">
                        <!-- Front (Dê núi Ninh Bình - Page 3) -->
                        <div class="page-face front-face">
                            <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Dê Núi" class="w-full h-full object-fill">
                            <div class="page-overlay-glow"></div>
                        </div>
                        <!-- Back (Món Cá - Page 4) -->
                        <div class="page-face back-face">
                            <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Món Cá" class="w-full h-full object-fill">
                            <div class="page-overlay-glow shadow-left"></div>
                        </div>
                    </div>

                    <!-- Page 5 / Sheet 3 -->
                    <div class="paper-sheet z-[10]" id="sheet3">
                        <!-- Front (Món Gà - Page 5) -->
                        <div class="page-face front-face">
                            <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Món Gà" class="w-full h-full object-fill">
                            <div class="page-overlay-glow"></div>
                        </div>
                        <!-- Back (Leather Back Cover) -->
                        <div class="page-face back-face bg-[#1f1610] flex flex-col items-center justify-center p-6 border-l border-white/5 text-center">
                            <div class="w-24 h-24 rounded-full border-2 border-secondary/30 flex items-center justify-center mb-4 bg-black/40">
                                <i class="fas fa-utensils text-3xl text-secondary"></i>
                            </div>
                            <h4 class="font-serif font-bold text-lg text-secondary">Cơm Cổ Hoa Lư</h4>
                            <p class="text-[10px] text-white/40 mt-1 uppercase tracking-widest">Ninh Bình Quán</p>
                            <div class="page-overlay-glow shadow-left"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Navigation Buttons and Controls -->
        <div class="flex flex-col items-center space-y-4">
            <div class="flex items-center space-x-6">
                <button onclick="flipBack()" class="px-5 py-2.5 rounded-full bg-white/5 hover:bg-secondary hover:text-bg-dark border border-white/10 flex items-center justify-center text-white transition-all shadow-md focus:outline-none text-xs font-bold uppercase tracking-wider">
                    <i class="fas fa-chevron-left mr-2"></i> Trang Trước
                </button>
                <div class="flex items-center space-x-2" id="flipbook-dots">
                    <span onclick="jumpToSheet(0)" class="w-2.5 h-2.5 rounded-full bg-secondary cursor-pointer transition-all duration-300"></span>
                    <span onclick="jumpToSheet(1)" class="w-2 h-2 rounded-full bg-white/20 cursor-pointer transition-all duration-300 hover:bg-secondary/60"></span>
                    <span onclick="jumpToSheet(2)" class="w-2 h-2 rounded-full bg-white/20 cursor-pointer transition-all duration-300 hover:bg-secondary/60"></span>
                    <span onclick="jumpToSheet(3)" class="w-2 h-2 rounded-full bg-white/20 cursor-pointer transition-all duration-300 hover:bg-secondary/60"></span>
                </div>
                <button onclick="flipForward()" class="px-5 py-2.5 rounded-full bg-white/5 hover:bg-secondary hover:text-bg-dark border border-white/10 flex items-center justify-center text-white transition-all shadow-md focus:outline-none text-xs font-bold uppercase tracking-wider">
                    Trang Sau <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>

            <p class="text-white/40 text-[11px] sm:text-xs text-center flex items-center gap-1.5">
                <i class="fas fa-hand-pointer text-secondary"></i>
                <span>Nhấp trực tiếp vào mép sách để lật trang hoặc vuốt ngang trên màn hình điện thoại</span>
            </p>
        </div>
    </div>

    <!-- ======================= 2. MODE: DANG LUOI (UNCROPPED) ======================= -->
    <div id="view-mode-grid" class="hidden max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 my-8 z-10">
        
        <!-- 1. Cover Page -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-white/15 bg-[#1a1410] shadow-xl hover:border-secondary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_3.jpg') }}')">
                <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Bìa Menu" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-secondary text-bg-dark text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to bìa menu
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-semibold text-sm text-secondary/90">Trang 1: Bìa Thực Đơn</h3>
        </div>

        <!-- 2. Khai Vị -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-white/15 bg-[#1a1410] shadow-xl hover:border-secondary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_4.jpg') }}')">
                <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Khai Vị" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-secondary text-bg-dark text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-semibold text-sm text-secondary/90">Trang 2: Khai Vị - Bò - Hải Sản</h3>
        </div>

        <!-- 3. Dê Núi -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-white/15 bg-[#1a1410] shadow-xl hover:border-secondary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_1.jpg') }}')">
                <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Dê núi" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-secondary text-bg-dark text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-semibold text-sm text-secondary/90">Trang 3: Đặc Sản Dê Núi</h3>
        </div>

        <!-- 4. Món Cá -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-white/15 bg-[#1a1410] shadow-xl hover:border-secondary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_2.jpg') }}')">
                <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Món cá" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-secondary text-bg-dark text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-semibold text-sm text-secondary/90">Trang 4: Món Cá - Tôm - Cua</h3>
        </div>

        <!-- 5. Món Lợn Gà -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border-2 border-white/15 bg-[#1a1410] shadow-xl hover:border-secondary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_5.jpg') }}')">
                <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Gà lợn" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-secondary text-bg-dark text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-semibold text-sm text-secondary/90">Trang 5: Món Gà - Thịt Lợn</h3>
        </div>

    </div>

    <!-- Bottom Footer CTA -->
    <div class="w-full text-center z-10 py-6 border-t border-white/5 bg-black/25">
        <a href="{{ route('booking.create') }}" class="px-8 py-3 bg-secondary hover:bg-secondary-dark text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-lg transition-all">
            <i class="fas fa-calendar-alt mr-1.5"></i> Đặt bàn dùng món ngay
        </a>
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

<!-- Premium 3D Book Layout & Animations styling -->
<style>
    /* Book Container - sizing */
    .book-container {
        width: 680px;
        height: 480px;
        perspective: 2000px;
        position: relative;
    }

    .book {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }

    /* Paper Sheets */
    .paper-sheet {
        position: absolute;
        width: 50%;
        height: 100%;
        top: 0;
        right: 0;
        transform-origin: left center;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
        cursor: pointer;
    }

    /* Page Face styling */
    .page-face {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        backface-visibility: hidden;
        overflow: hidden;
        border-radius: 0 12px 12px 0;
        box-shadow: 5px 5px 15px rgba(0,0,0,0.4);
        background: #fbf9f5;
    }

    /* Spine effect on right edge of left page, or left edge of right page */
    .front-face {
        z-index: 2;
        transform: rotateY(0deg);
        border-left: 2px solid rgba(0,0,0,0.1);
    }

    .back-face {
        transform: rotateY(180deg);
        border-radius: 12px 0 0 12px;
        border-right: 2px solid rgba(0,0,0,0.1);
    }

    /* Page Overlay for realism (Glow/Shadow effect during flips) */
    .page-overlay-glow {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(to right, rgba(0,0,0,0.15) 0%, rgba(255,255,255,0.05) 10%, transparent 100%);
        mix-blend-mode: multiply;
        transition: opacity 0.8s;
    }

    .page-overlay-glow.shadow-left {
        background: linear-gradient(to left, rgba(0,0,0,0.15) 0%, rgba(255,255,255,0.05) 10%, transparent 100%);
    }

    /* Flipped sheets rotate left by 180 degrees */
    .paper-sheet.flipped {
        transform: rotateY(-180deg);
    }

    /* Responsive scaling behavior for small/mobile devices */
    @media (max-width: 768px) {
        .book-container {
            width: 320px;
            height: 440px;
        }
        .paper-sheet {
            width: 100%;
            left: 0;
            transform-origin: left center;
        }
        .back-face {
            border-radius: 0 12px 12px 0;
            border-right: none;
            border-left: 2px solid rgba(0,0,0,0.1);
        }
    }
</style>

<script>
    const sheets = [
        document.getElementById('sheet1'),
        document.getElementById('sheet2'),
        document.getElementById('sheet3')
    ];
    
    let currentSheetIndex = 0; // Starts with cover (sheet 0) active
    const totalSheets = sheets.length;

    // Flip book forward
    function flipForward() {
        if (currentSheetIndex < totalSheets) {
            sheets[currentSheetIndex].classList.add('flipped');
            // Z-index correction to overlay flipped pages correctly
            sheets[currentSheetIndex].style.zIndex = 30 + currentSheetIndex;
            currentSheetIndex++;
            updateDots();
        }
    }

    // Flip book back
    function flipBack() {
        if (currentSheetIndex > 0) {
            currentSheetIndex--;
            sheets[currentSheetIndex].classList.remove('flipped');
            // Restore original structural z-indexes
            sheets[currentSheetIndex].style.zIndex = 30 - currentSheetIndex;
            updateDots();
        }
    }

    // Direct sheet navigation jump
    function jumpToSheet(targetIdx) {
        if (targetIdx === currentSheetIndex) return;

        if (targetIdx > currentSheetIndex) {
            while (currentSheetIndex < targetIdx) {
                flipForward();
            }
        } else {
            while (currentSheetIndex > targetIdx) {
                flipBack();
            }
        }
    }

    // Attach click events on the pages themselves to trigger flipping
    sheets.forEach((sheet, idx) => {
        sheet.addEventListener('click', function(e) {
            // Determine if clicking on the left or right side of the book container
            const rect = this.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            
            if (sheet.classList.contains('flipped')) {
                // If it's already flipped, clicking on it (which is now on the left) flips it back
                flipBack();
            } else {
                // If it's not flipped, clicking on it (which is on the right) flips it forward
                flipForward();
            }
        });
    });

    // Update Dots indicator
    function updateDots() {
        const dots = document.querySelectorAll('#flipbook-dots span');
        dots.forEach((dot, idx) => {
            if (idx === currentSheetIndex) {
                dot.className = "w-2.5 h-2.5 rounded-full bg-secondary cursor-pointer transition-all duration-300";
            } else {
                dot.className = "w-2 h-2 rounded-full bg-white/20 cursor-pointer transition-all duration-300 hover:bg-secondary/60";
            }
        });
    }

    // Swipe gestures on mobile
    let touchStartX = 0;
    let touchEndX = 0;
    const bookEl = document.getElementById('book-3d');
    
    bookEl.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });

    bookEl.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const threshold = 50;
        if (touchStartX - touchEndX > threshold) {
            flipForward();
        } else if (touchEndX - touchStartX > threshold) {
            flipBack();
        }
    }

    // Mode Switcher function
    function switchMode(mode) {
        const flipBtn = document.getElementById('btn-mode-flip');
        const gridBtn = document.getElementById('btn-mode-grid');
        const flipView = document.getElementById('view-mode-flip');
        const gridView = document.getElementById('view-mode-grid');

        if (mode === 'flip') {
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-secondary text-bg-dark shadow-md";
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-light/60 hover:text-white";
            flipView.classList.remove('hidden');
            gridView.classList.add('hidden');
        } else {
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-secondary text-bg-dark shadow-md";
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-light/60 hover:text-white";
            gridView.classList.remove('hidden');
            flipView.classList.add('hidden');
        }
    }

    // Lightbox zoom functions
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
