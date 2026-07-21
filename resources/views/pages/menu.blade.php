@extends('layouts.app')

@section('title', 'Thực Đơn Nhà Hàng - Cơm Cổ Hoa Lư')
@section('meta_description', 'Khám phá danh sách các món ngon đặc sắc Ninh Bình: cơm niêu đất than hồng vàng giòn, dê núi Tràng An chăn thả tự nhiên, và các set mâm cơm gia đình tại Cơm Cổ Hoa Lư.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => 'Thực Đơn Cơm Cổ Hoa Lư',
    'items' => [
        ['label' => 'Thực đơn', 'url' => null]
    ]
])

<!-- 1. Set Menu Section (Mâm Cơm Trọn Vị) -->
@if($setMenus->isNotEmpty())
<section class="py-16 bg-bg-primary border-b border-border-custom/30 relative overflow-hidden">
    <!-- Traditional background pattern -->
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-secondary font-bold text-sm uppercase tracking-widest block">Gợi ý từ bếp trưởng</span>
            <h2 class="text-2xl md:text-3xl font-bold text-primary font-serif mt-2">Mâm Cơm Trọn Vị Cố Đô</h2>
            <div class="w-12 h-1 bg-secondary mx-auto mt-2"></div>
            <p class="text-text-secondary text-xs mt-3">Các set mâm cơm được thiết kế hài hòa, đầy đủ dinh dưỡng, giúp quý khách thưởng thức trọn vẹn hương vị ẩm thực Hoa Lư.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($setMenus as $set)
                <div class="premium-card bg-white p-6 md:p-8 flex flex-col justify-between border-t-4 border-t-primary">
                    <div>
                        <!-- Title & Price -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-primary font-serif">{{ $set->name }}</h3>
                                <span class="text-[10px] text-text-secondary uppercase tracking-widest mt-1 block">Dành cho {{ $set->pax_range }} người</span>
                            </div>
                            <span class="text-primary-light font-bold text-lg font-serif">
                                {{ number_format($set->price, 0, ',', '.') }}đ
                            </span>
                        </div>
                        
                        <p class="text-text-secondary text-xs italic mb-6">
                            "{{ $set->description ?: 'Bữa cơm sum họp ấm cúng mang hương vị truyền thống quê hương Ninh Bình.' }}"
                        </p>

                        <!-- Items List -->
                        <div class="space-y-3 mb-8">
                            <span class="text-xs font-bold text-text-primary uppercase tracking-wider block border-b border-border-custom/20 pb-2">
                                <i class="fas fa-utensils text-secondary mr-2"></i>Chi tiết mâm cơm:
                            </span>
                            <ul class="space-y-2">
                                @forelse($set->items as $menuItem)
                                    <li class="flex items-center text-xs text-text-secondary">
                                        <i class="fas fa-circle text-[6px] text-secondary mr-2.5"></i>
                                        <span class="font-medium text-text-primary mr-1.5">{{ $menuItem->name }}</span>
                                        @if($menuItem->pivot && $menuItem->pivot->quantity > 1)
                                            <span class="text-primary-light font-semibold">(x{{ $menuItem->pivot->quantity }})</span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="text-xs text-text-secondary italic">Đang cập nhật các món ăn...</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Book Set -->
                    <div>
                        <a href="{{ route('booking.create') }}" class="block w-full py-3 text-center bg-primary hover:bg-primary-dark text-white text-xs font-bold uppercase tracking-wider rounded-lg transition-colors shadow-sm">
                            Đặt mâm này ngay
                        </a>
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
