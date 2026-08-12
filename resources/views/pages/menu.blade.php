@extends('layouts.app')

@section('title', 'Thực Đơn Nhà Hàng - Cơm Cổ Hoa Lư')
@section('meta_description', 'Khám phá danh sách các món ngon đặc sắc Ninh Bình: cơm niêu đất than hồng vàng giòn, dê núi Tràng An chăn thả tự nhiên, và các set mâm cơm gia đình tại Cơm Cổ Hoa Lư.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Combo Mâm Cơm Hoa Lư',
    'items' => [
        ['label' => 'Combo', 'url' => null]
    ]
])

<!-- 1. Set Menu Section (Mâm Cơm Trọn Vị) -->
@if($setMenus->isNotEmpty())
<section class="py-16 bg-bg-primary border-b border-border-custom/30 relative overflow-hidden">
    <!-- Traditional background pattern -->
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-secondary font-bold text-sm uppercase tracking-widest block">Gợi ý từ bếp trưởng</span>
            <h2 class="text-2xl md:text-3xl font-bold text-primary font-serif mt-2">Mâm Cơm Trọn Vị Cố Đô</h2>
            <div class="w-12 h-1 bg-secondary mx-auto mt-2"></div>
            <p class="text-text-secondary text-xs mt-3">Các set mâm cơm được thiết kế hài hòa, đầy đủ dinh dưỡng, giúp quý khách thưởng thức trọn vẹn hương vị ẩm thực Hoa Lư.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            @foreach($setMenus as $set)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl border border-border-custom/40 overflow-hidden transition-all duration-300 transform hover:-translate-y-1.5 flex flex-col">
                    <!-- Full Uncropped Poster Image -->
                    <div class="relative w-full overflow-hidden bg-bg-secondary">
                        <img 
                            src="{{ str_starts_with($set->image, 'http') ? $set->image : (str_starts_with($set->image, 'images/') ? asset($set->image) : asset('storage/' . $set->image)) }}" 
                            alt="{{ $set->name }}" 
                            class="w-full h-auto object-contain block group-hover:scale-[1.02] transition-transform duration-500"
                            loading="lazy"
                        >
                        <!-- Button Overlaid at bottom of image -->
                        <div class="p-4 bg-gradient-to-t from-black/85 via-black/40 to-transparent flex items-center justify-center">
                            <a href="{{ route('booking.create') }}" class="w-full py-3 text-center bg-primary hover:bg-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center space-x-2 border border-secondary/40">
                                <i class="fas fa-calendar-check text-secondary group-hover:text-bg-dark"></i>
                                <span>Đặt mâm này ngay</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 2. Individual Menu Items Filter & Grid Section -->
<section class="py-16 bg-bg-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search & Filter bar -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12 pb-6 border-b border-border-custom/30">
            <!-- Search field -->
            <div class="relative w-full md:max-w-xs">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-text-secondary/50"></i>
                </span>
                <input 
                    type="text" 
                    id="menu-search-input" 
                    placeholder="Tìm tên món ngon..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-border-custom bg-white text-text-primary placeholder-text-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                >
            </div>

            <!-- Categories Buttons Filter -->
            <div class="flex flex-wrap gap-2 w-full md:w-auto justify-start md:justify-end">
                <button 
                    type="button" 
                    data-category-id="" 
                    class="category-filter-btn px-4 py-2 bg-primary text-white border border-primary hover:bg-primary hover:text-white rounded-full text-xs font-semibold tracking-wide shadow-sm transition-all"
                >
                    Tất cả
                </button>
                @foreach($categories as $cat)
                    <button 
                        type="button" 
                        data-category-id="{{ $cat->id }}" 
                        class="category-filter-btn px-4 py-2 bg-white text-text-secondary border border-border-custom hover:border-primary hover:text-primary rounded-full text-xs font-semibold tracking-wide shadow-sm transition-all"
                    >
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Menu items Grid -->
        <div id="menu-items-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @include('partials.menu-grid', ['menuItems' => $items])
        </div>

        <!-- Load More Pagination -->
        <div id="load-more-container" class="text-center mt-12 @if(!$items->hasMorePages()) hidden @endif">
            <button 
                type="button" 
                id="load-more-btn" 
                data-next-page="{{ $items->currentPage() + 1 }}"
                class="inline-flex items-center px-8 py-3 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02] cursor-pointer"
            >
                <i class="fas fa-spinner fa-spin mr-2 hidden" id="load-more-spinner"></i>
                <span id="load-more-text">Xem thêm món ngon</span>
            </button>
        </div>

    </div>
</section>
@endsection
