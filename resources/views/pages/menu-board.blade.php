@extends('layouts.app')

@section('title', 'Menu - Cơm Cổ Hoa Lư')
@section('meta_description', 'Xem trọn bộ quyển menu thực đơn ảnh quét chính thức của nhà hàng Cơm Cổ Hoa Lư với các món đặc sản dê núi, cơm niêu và đồ uống truyền thống.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Menu',
    'items' => [
        ['label' => 'Menu', 'url' => null]
    ]
])

<!-- Introduction Section -->
<section class="py-12 bg-bg-primary relative overflow-hidden">
    <!-- Traditional background pattern -->
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-xl mx-auto">
            <span class="text-secondary font-bold text-sm uppercase tracking-widest block">Trải nghiệm trực quan</span>
            <h2 class="text-2xl md:text-3xl font-bold text-primary font-serif mt-2">Quyển Thực Đơn Truyền Thống</h2>
            <div class="w-12 h-1 bg-secondary mx-auto mt-2"></div>
            <p class="text-text-secondary text-xs mt-3">
                Nhấp vào từng trang để phóng to hình ảnh thực đơn in của chúng tôi, tận hưởng sự kết hợp tinh tế giữa nghệ thuật ẩm thực và các thiết kế di sản Cố Đô.
            </p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="pb-20 bg-bg-primary relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($boards->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl border border-border-custom/20 max-w-lg mx-auto shadow-sm">
                <i class="fas fa-images text-5xl text-text-secondary/30 mb-4 block"></i>
                <h3 class="text-lg font-serif font-bold text-primary">Chưa cập nhật Menu</h3>
                <p class="text-text-secondary text-xs mt-2">Nhà hàng đang tiến hành cập nhật hình ảnh thực đơn mới nhất. Quý khách vui lòng tham khảo trang <a href="{{ route('menu') }}" class="text-secondary hover:underline font-semibold">Thực đơn điện tử</a> hoặc quay lại sau.</p>
            </div>
        @else
            <!-- Grid list of menu boards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($boards as $index => $board)
                    <div 
                        class="menu-board-card bg-white rounded-xl shadow-md border border-border-custom/25 overflow-hidden transform hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300 group cursor-pointer"
                        data-index="{{ $index }}"
                        data-image="{{ asset('storage/' . $board->image) }}"
                        data-title="{{ $board->title ?: 'Trang thực đơn ' . ($index + 1) }}"
                    >
                        <!-- Image Container -->
                        <div class="relative aspect-[3/4] overflow-hidden bg-bg-secondary/40 border-b border-border-custom/20">
                            <img 
                                src="{{ asset('storage/' . $board->image) }}" 
                                alt="{{ $board->title ?: 'Trang thực đơn ' . ($index + 1) }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="w-12 h-12 rounded-full bg-secondary text-bg-dark flex items-center justify-center text-lg shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <i class="fas fa-search-plus"></i>
                                </span>
                            </div>
                            <!-- Number badge -->
                            <span class="absolute top-4 left-4 bg-primary text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded shadow-sm z-10 border border-secondary/20">
                                Trang {{ $index + 1 }}
                            </span>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-4 bg-white text-center">
                            <h4 class="text-xs font-bold font-serif text-primary uppercase tracking-wide truncate">
                                {{ $board->title ?: 'Trang thực đơn số ' . ($index + 1) }}
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
@if($boards->isNotEmpty())
<div id="menu-lightbox" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black/95 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <!-- Close button -->
    <button 
        id="lightbox-close" 
        type="button" 
        class="absolute top-6 right-6 text-white hover:text-secondary text-3xl focus:outline-none z-50 w-12 h-12 flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 transition-colors"
        aria-label="Đóng"
    >
        <i class="fas fa-times"></i>
    </button>

    <!-- Prev button -->
    <button 
        id="lightbox-prev" 
        type="button" 
        class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white hover:text-secondary text-3xl focus:outline-none z-50 w-14 h-14 flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 transition-colors"
        aria-label="Trang trước"
    >
        <i class="fas fa-chevron-left"></i>
    </button>

    <!-- Next button -->
    <button 
        id="lightbox-next" 
        type="button" 
        class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white hover:text-secondary text-3xl focus:outline-none z-50 w-14 h-14 flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 transition-colors"
        aria-label="Trang sau"
    >
        <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Image wrapper -->
    <div class="relative max-w-[90%] max-h-[78vh] flex items-center justify-center select-none">
        <img 
            id="lightbox-img" 
            src="" 
            alt="Thực đơn" 
            class="max-w-full max-h-[78vh] object-contain shadow-2xl rounded border border-white/10 transform scale-95 transition-transform duration-300"
        >
    </div>

    <!-- Info bar at bottom -->
    <div class="mt-6 text-center text-white space-y-1 px-4">
        <h3 id="lightbox-title" class="text-sm font-bold font-serif text-secondary tracking-wider uppercase">Tiêu đề thực đơn</h3>
        <p id="lightbox-indicator" class="text-[11px] text-white/60 font-mono tracking-widest uppercase">Trang 1 / 5</p>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if($boards->isNotEmpty())
<script>
    $(document).ready(function() {
        // Collect all menu boards data
        const menuBoards = [];
        $('.menu-board-card').each(function() {
            menuBoards.push({
                image: $(this).data('image'),
                title: $(this).data('title'),
                index: parseInt($(this).data('index'))
            });
        });

        let currentIndex = 0;
        const totalItems = menuBoards.length;

        // Open Lightbox
        $('.menu-board-card').on('click', function() {
            currentIndex = parseInt($(this).data('index'));
            updateLightbox();
            $('#menu-lightbox').removeClass('opacity-0 pointer-events-none').addClass('opacity-100 pointer-events-auto');
            setTimeout(function() {
                $('#lightbox-img').removeClass('scale-95').addClass('scale-100');
            }, 50);
        });

        // Close Lightbox
        function closeLightbox() {
            $('#lightbox-img').removeClass('scale-100').addClass('scale-95');
            $('#menu-lightbox').removeClass('opacity-100 pointer-events-auto').addClass('opacity-0 pointer-events-none');
        }

        $('#lightbox-close').on('click', closeLightbox);
        
        // Close on background click (excluding image and nav buttons)
        $('#menu-lightbox').on('click', function(e) {
            if (e.target === this || e.target.id === 'menu-lightbox') {
                closeLightbox();
            }
        });

        // Prev Slide
        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalItems) % totalItems;
            updateLightbox();
        }

        // Next Slide
        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalItems;
            updateLightbox();
        }

        $('#lightbox-prev').on('click', function(e) {
            e.stopPropagation();
            prevSlide();
        });

        $('#lightbox-next').on('click', function(e) {
            e.stopPropagation();
            nextSlide();
        });

        // Update image inside lightbox
        function updateLightbox() {
            const currentItem = menuBoards[currentIndex];
            
            // Fade effect for smoother transitions
            $('#lightbox-img').css('opacity', '0.2');
            setTimeout(function() {
                $('#lightbox-img').attr('src', currentItem.image);
                $('#lightbox-img').attr('alt', currentItem.title);
                $('#lightbox-title').text(currentItem.title);
                $('#lightbox-indicator').text('Trang ' + (currentIndex + 1) + ' / ' + totalItems);
                $('#lightbox-img').css('opacity', '1');
            }, 100);
        }

        // Keyboard navigation
        $(document).on('keydown', function(e) {
            if ($('#menu-lightbox').hasClass('opacity-100')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            }
        });
    });
</script>
@endif
@endsection
