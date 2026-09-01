@extends('layouts.app')

@section('title', 'Thực Đơn Tương Tác 3D - Cơm Cổ Hoa Lư')
@section('meta_description', 'Trải nghiệm sách lật thực đơn 3D đôi cao cấp độc đáo của nhà hàng Cơm Cổ Hoa Lư. Tối ưu hóa tuyệt hảo cho máy tính và thiết bị di động.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Thực Đơn Chi Tiết',
    'items' => [
        ['label' => 'Thực Đơn Chi Tiết', 'url' => null]
    ]
])

<!-- Menu / Combo Switch Navigation -->
<div class="bg-bg-primary pt-6 pb-2 border-b border-border-custom/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <div class="inline-flex p-1.5 bg-bg-secondary rounded-2xl border border-border-custom/50 shadow-sm">
            <a href="{{ route('menu') }}" class="flex items-center gap-2 px-5 sm:px-7 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all text-text-secondary hover:text-primary hover:bg-white/60">
                <i class="fas fa-layer-group text-secondary"></i>
                <span>Combo Mâm Cơm</span>
            </a>
            <a href="{{ route('menu.board') }}" class="flex items-center gap-2 px-5 sm:px-7 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-primary text-white shadow-md">
                <i class="fas fa-book-open text-secondary"></i>
                <span>Xem Toàn Bộ Menu Món</span>
            </a>
        </div>
    </div>
</div>

<section class="py-12 bg-bg-primary relative overflow-hidden min-h-[85vh] flex flex-col justify-between text-text-primary">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 viet-pattern-bg opacity-[0.03] z-0 pointer-events-none"></div>
    
    <!-- Top Intro & Toggle -->
    <div class="max-w-7xl mx-auto px-4 text-center z-10 space-y-4">
        <h2 class="text-2xl md:text-4xl font-serif font-bold text-primary">Thực Đơn Bản Sách Lật 3D</h2>
        <div class="w-16 h-0.5 bg-secondary mx-auto"></div>

        <!-- Mode Switcher -->
        <div class="inline-flex p-1 bg-bg-secondary rounded-xl border border-border-custom/40 shadow-xs">
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
    <div id="view-mode-flip" class="w-full flex flex-col items-center justify-center my-6 z-10 space-y-6 select-none">
        
        <!-- A. DESKTOP / TABLET DUAL-PAGE VIEW (Shown on >= 640px) -->
        <div class="hidden sm:flex book-scale-wrapper w-full max-w-4xl px-4 items-center justify-center">
            <div class="book-container">
                <div class="book" id="book-3d-desktop">
                    
                    <!-- Cover Page / Sheet 1 -->
                    <div class="paper-sheet z-[30]" id="dsheet1">
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
                    <div class="paper-sheet z-[20]" id="dsheet2">
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
                    <div class="paper-sheet z-[10]" id="dsheet3">
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

        <!-- B. MOBILE SINGLE-PAGE VIEW (Shown on < 640px) -->
        <div class="flex sm:hidden w-full max-w-[340px] px-4 items-center justify-center">
            <div class="relative w-full aspect-[3/4.2] bg-white rounded-xl shadow-2xl border-4 border-amber-900/30 overflow-hidden" id="book-3d-mobile-container">
                <!-- Leather spine spine visual on left -->
                <div class="absolute left-0 top-0 bottom-0 w-3 bg-gradient-to-r from-amber-950 via-amber-900 to-transparent z-30 opacity-70"></div>
                
                <!-- Stack of Pages -->
                <div class="relative w-full h-full" id="mobile-pages-stack">
                    <div class="mobile-page active-page" data-idx="1">
                        <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Trang 1" class="w-full h-full object-fill" onclick="mobileNext()">
                    </div>
                    <div class="mobile-page" data-idx="2">
                        <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Trang 2" class="w-full h-full object-fill" onclick="mobileNext()">
                    </div>
                    <div class="mobile-page" data-idx="3">
                        <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Trang 3" class="w-full h-full object-fill" onclick="mobileNext()">
                    </div>
                    <div class="mobile-page" data-idx="4">
                        <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Trang 4" class="w-full h-full object-fill" onclick="mobileNext()">
                    </div>
                    <div class="mobile-page" data-idx="5">
                        <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Trang 5" class="w-full h-full object-fill" onclick="mobileNext()">
                    </div>
                </div>

                <!-- Page Number Tag for Mobile -->
                <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-xs text-white text-[10px] px-2 py-0.5 rounded-md z-30 font-semibold" id="mobile-page-indicator">
                    Trang 1 / 5
                </div>
            </div>
        </div>

        <!-- Navigation Buttons and Controls -->
        <div class="flex flex-col items-center space-y-4">
            <div class="flex items-center space-x-6">
                <button onclick="handlePrev()" class="px-5 py-2.5 rounded-full bg-white hover:bg-primary hover:text-white border border-border-custom flex items-center justify-center text-text-primary transition-all shadow-xs focus:outline-none text-xs font-bold uppercase tracking-wider">
                    <i class="fas fa-chevron-left mr-2"></i> Trang Trước
                </button>
                <div class="flex items-center space-x-2" id="flipbook-dots">
                    <span onclick="handleJump(0)" class="w-2.5 h-2.5 rounded-full bg-primary cursor-pointer transition-all duration-300"></span>
                    <span onclick="handleJump(1)" class="w-2 h-2 rounded-full bg-border-custom/85 cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                    <span onclick="handleJump(2)" class="w-2 h-2 rounded-full bg-border-custom/85 cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                    <span onclick="handleJump(3)" class="w-2 h-2 rounded-full bg-border-custom/85 cursor-pointer transition-all duration-300 hover:bg-primary/50"></span>
                </div>
                <button onclick="handleNext()" class="px-5 py-2.5 rounded-full bg-white hover:bg-primary hover:text-white border border-border-custom flex items-center justify-center text-text-primary transition-all shadow-xs focus:outline-none text-xs font-bold uppercase tracking-wider">
                    Trang Sau <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>

            <p class="text-text-secondary/70 text-[10px] sm:text-xs text-center flex items-center gap-1.5 px-4">
                <i class="fas fa-hand-pointer text-primary/70"></i>
                <span class="hidden sm:inline">Nhấp vào trang sách để lật trang hoặc vuốt ngang trên màn hình điện thoại</span>
                <span class="inline sm:hidden">Chạm vào trang sách để lật hoặc vuốt ngang màn hình</span>
            </p>
        </div>
    </div>

    <!-- ======================= 2. MODE: DANG LUOI (UNCROPPED) ======================= -->
    <div id="view-mode-grid" class="hidden max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 my-8 z-10">
        
        <!-- 1. Cover Page -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-border-custom/40 bg-[#1a1410] shadow-md hover:border-primary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_3.jpg') }}')">
                <img src="{{ asset('images/menu/media_3.jpg') }}" alt="Bìa Menu" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-primary text-white text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to bìa menu
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-bold text-sm text-primary">Trang 1: Bìa Thực Đơn</h3>
        </div>

        <!-- 2. Khai Vị -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-border-custom/40 bg-[#1a1410] shadow-md hover:border-primary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_4.jpg') }}')">
                <img src="{{ asset('images/menu/media_4.jpg') }}" alt="Khai Vị" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-primary text-white text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-bold text-sm text-primary">Trang 2: Khai Vị - Bò - Hải Sản</h3>
        </div>

        <!-- 3. Dê Núi -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-border-custom/40 bg-[#1a1410] shadow-md hover:border-primary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_1.jpg') }}')">
                <img src="{{ asset('images/menu/media_1.jpg') }}" alt="Dê núi" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-primary text-white text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-bold text-sm text-primary">Trang 3: Đặc Sản Dê Núi</h3>
        </div>

        <!-- 4. Món Cá -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-border-custom/40 bg-[#1a1410] shadow-md hover:border-primary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_2.jpg') }}')">
                <img src="{{ asset('images/menu/media_2.jpg') }}" alt="Món cá" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-primary text-white text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-bold text-sm text-primary">Trang 4: Món Cá - Tôm - Cua</h3>
        </div>

        <!-- 5. Món Lợn Gà -->
        <div class="space-y-3 text-center">
            <div class="relative rounded-xl overflow-hidden border border-border-custom/40 bg-[#1a1410] shadow-md hover:border-primary/40 transition-all duration-300 group cursor-zoom-in" onclick="openZoom('{{ asset('images/menu/media_5.jpg') }}')">
                <img src="{{ asset('images/menu/media_5.jpg') }}" alt="Gà lợn" class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-102">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="px-3.5 py-2 bg-primary text-white text-[11px] font-bold rounded-lg shadow-md">
                        <i class="fas fa-search-plus mr-1.5"></i> Phóng to thực đơn
                    </span>
                </div>
            </div>
            <h3 class="font-serif font-bold text-sm text-primary">Trang 5: Món Gà - Thịt Lợn</h3>
        </div>

    </div>

    <!-- Bottom Footer CTA -->
    <div class="w-full text-center z-10 py-6 border-t border-border-custom/30 bg-bg-secondary/40">
        <a href="{{ route('booking.create') }}" class="px-8 py-3.5 bg-primary hover:bg-primary-dark text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-all inline-flex items-center">
            <i class="fas fa-calendar-alt mr-2 text-secondary"></i> Đặt bàn dùng món ngay
        </a>
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
        box-shadow: 4px 10px 30px rgba(44, 24, 16, 0.15);
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
    /* Mobile Page Deck Flip styles */
    .mobile-page {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        transform-origin: left center;
        transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.6s, z-index 0.6s;
        transform: rotateY(0deg);
        opacity: 0;
        z-index: 0;
        pointer-events: none;
        transform-style: preserve-3d;
        backface-visibility: hidden;
    }
    
    .mobile-page.active-page {
        opacity: 1;
        z-index: 10;
        pointer-events: auto;
        transform: rotateY(0deg);
    }
    
    .mobile-page.turned-page {
        transform: rotateY(-120deg);
        opacity: 0;
        z-index: 0;
        pointer-events: none;
    }
</style>

<script>
    // ─── A. DESKTOP BOOK LOGIC ───
    const dsheets = [
        document.getElementById('dsheet1'),
        document.getElementById('dsheet2'),
        document.getElementById('dsheet3')
    ];
    let dCurrentIndex = 0; 
    const totalDSheets = dsheets.length;

    function flipForwardDesktop() {
        if (dCurrentIndex < totalDSheets) {
            dsheets[dCurrentIndex].classList.add('flipped');
            dsheets[dCurrentIndex].style.zIndex = 30 + dCurrentIndex;
            dCurrentIndex++;
            updateDots();
        }
    }

    function flipBackDesktop() {
        if (dCurrentIndex > 0) {
            dCurrentIndex--;
            dsheets[dCurrentIndex].classList.remove('flipped');
            dsheets[dCurrentIndex].style.zIndex = 30 - dCurrentIndex;
            updateDots();
        }
    }

    dsheets.forEach((sheet, idx) => {
        sheet.addEventListener('click', function(e) {
            if (sheet.classList.contains('flipped')) {
                flipBackDesktop();
            } else {
                flipForwardDesktop();
            }
        });
    });

    // ─── B. MOBILE BOOK LOGIC ───
    let mCurrentPage = 1;
    const totalMPages = 5;
    let isTransitioningMobile = false;

    function mobileNext() {
        if (mCurrentPage >= totalMPages || isTransitioningMobile) return;
        isTransitioningMobile = true;

        const currentEl = document.querySelector(`.mobile-page[data-idx="${mCurrentPage}"]`);
        mCurrentPage++;
        const nextEl = document.querySelector(`.mobile-page[data-idx="${mCurrentPage}"]`);

        // Turn current page away
        currentEl.className = "mobile-page turned-page";
        // Activate next page
        nextEl.className = "mobile-page active-page";
        
        setTimeout(() => {
            updateIndicatorsMobile();
            isTransitioningMobile = false;
        }, 600);
    }

    function mobilePrev() {
        if (mCurrentPage <= 1 || isTransitioningMobile) return;
        isTransitioningMobile = true;

        const currentEl = document.querySelector(`.mobile-page[data-idx="${mCurrentPage}"]`);
        mCurrentPage--;
        const prevEl = document.querySelector(`.mobile-page[data-idx="${mCurrentPage}"]`);

        // Reset current page to unreached stack state
        currentEl.className = "mobile-page";
        // Turn prev page back to active front face
        prevEl.className = "mobile-page active-page";

        setTimeout(() => {
            updateIndicatorsMobile();
            isTransitioningMobile = false;
        }, 600);
    }

    function updateIndicatorsMobile() {
        document.getElementById('mobile-page-indicator').innerText = `Trang ${mCurrentPage} / ${totalMPages}`;
        updateDots();
    }

    // Swipe support for mobile stack
    const mBookContainer = document.getElementById('book-3d-mobile-container');
    if (mBookContainer) {
        let mStartX = 0;
        let mEndX = 0;
        
        mBookContainer.addEventListener('touchstart', e => {
            mStartX = e.changedTouches[0].screenX;
        }, {passive: true});

        mBookContainer.addEventListener('touchend', e => {
            mEndX = e.changedTouches[0].screenX;
            const threshold = 40;
            if (mStartX - mEndX > threshold) {
                mobileNext();
            } else if (mEndX - mStartX > threshold) {
                mobilePrev();
            }
        }, {passive: true});
    }

    // ─── C. GLOBAL CONTROL SYNC ───
    
    // Determine screen type
    function isMobileScreen() {
        return window.innerWidth < 640;
    }

    function handleNext() {
        if (isMobileScreen()) {
            mobileNext();
        } else {
            flipForwardDesktop();
        }
    }

    function handlePrev() {
        if (isMobileScreen()) {
            mobilePrev();
        } else {
            flipBackDesktop();
        }
    }

    function handleJump(targetIndex) {
        if (isMobileScreen()) {
            // Mobile Page Jump (targetIndex ranges from 0 to 3, map to page 1 to 5)
            const targetPage = targetIndex + 1;
            if (targetPage === mCurrentPage || isTransitioningMobile) return;

            if (targetPage > mCurrentPage) {
                mobileNext();
                if (targetPage > mCurrentPage) {
                    setTimeout(() => handleJump(targetIndex), 600);
                }
            } else {
                mobilePrev();
                if (targetPage < mCurrentPage) {
                    setTimeout(() => handleJump(targetIndex), 600);
                }
            }
        } else {
            // Desktop Sheet Jump
            if (targetIndex === dCurrentIndex) return;
            if (targetIndex > dCurrentIndex) {
                while (dCurrentIndex < targetIndex) {
                    flipForwardDesktop();
                }
            } else {
                while (dCurrentIndex > targetIndex) {
                    flipBackDesktop();
                }
            }
        }
    }

    function updateDots() {
        const dots = document.querySelectorAll('#flipbook-dots span');
        const activeIndex = isMobileScreen() ? (mCurrentPage - 1) : dCurrentIndex;
        
        dots.forEach((dot, idx) => {
            if (idx === activeIndex) {
                dot.className = "w-2.5 h-2.5 rounded-full bg-primary cursor-pointer transition-all duration-300";
            } else {
                dot.className = "w-2 h-2 rounded-full bg-border-custom/80 cursor-pointer transition-all duration-300 hover:bg-primary/50";
            }
        });
    }

    // Swipe support for desktop
    const dBookEl = document.getElementById('book-3d-desktop');
    if (dBookEl) {
        let dStartX = 0;
        let dEndX = 0;
        dBookEl.addEventListener('touchstart', e => {
            dStartX = e.changedTouches[0].screenX;
        }, {passive: true});
        dBookEl.addEventListener('touchend', e => {
            dEndX = e.changedTouches[0].screenX;
            const threshold = 40;
            if (dStartX - dEndX > threshold) {
                flipForwardDesktop();
            } else if (dEndX - dStartX > threshold) {
                flipBackDesktop();
            }
        }, {passive: true});
    }

    // Mode Switcher function
    function switchMode(mode) {
        const flipBtn = document.getElementById('btn-mode-flip');
        const gridBtn = document.getElementById('btn-mode-grid');
        const flipView = document.getElementById('view-mode-flip');
        const gridView = document.getElementById('view-mode-grid');

        if (mode === 'flip') {
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-primary text-white shadow-xs";
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-secondary hover:text-primary";
            flipView.classList.remove('hidden');
            gridView.classList.add('hidden');
        } else {
            gridBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-primary text-white shadow-xs";
            flipBtn.className = "flex items-center space-x-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-text-secondary hover:text-primary";
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

    // Auto update dot index when switching view modes/resizing
    window.addEventListener('resize', updateDots);
</script>
@endsection
