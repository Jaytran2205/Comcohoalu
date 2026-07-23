@php
    $menuItems = $menuItems ?? $items ?? [];
@endphp
@forelse($menuItems as $item)
    <div class="premium-card group flex flex-col justify-between h-full bg-white overflow-hidden">
        <!-- Dish Image & Badge -->
        <div class="relative overflow-hidden aspect-[4/3] bg-bg-secondary">
            <img 
                src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image)) : asset('images/default-dish.jpg') }}" 
                alt="{{ $item->name }}" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                onerror="this.src='{{ asset('images/default-dish.jpg') }}'"
            >
            
            <!-- Quick View Hover overlay -->
            <div class="absolute inset-0 bg-bg-dark/45 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                <button 
                    type="button" 
                    data-item-id="{{ $item->id }}" 
                    class="quick-view-btn px-4 py-2 bg-white text-primary font-semibold text-xs uppercase tracking-wider rounded-lg shadow-md hover:bg-primary hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-300"
                >
                    <i class="fas fa-search-plus mr-1"></i> Xem Nhanh
                </button>
            </div>

            <!-- Badge -->
            @if($item->badge && $item->badge !== \App\Enums\MenuItemBadge::None)
                <span class="absolute top-3 left-3 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded bg-secondary text-bg-dark shadow-sm">
                    {{ $item->badge->label() }}
                </span>
            @endif
        </div>

        <!-- Details -->
        <div class="p-5 flex-grow flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold text-secondary uppercase tracking-widest block mb-1">
                    {{ $item->category->name }}
                </span>
                <h3 class="text-lg font-bold text-primary hover:text-primary-light transition-colors line-clamp-1 mb-2 font-serif">
                    {{ $item->name }}
                </h3>
                <p class="text-text-secondary text-xs line-clamp-2 leading-relaxed mb-4">
                    {{ $item->description ?: 'Món ăn truyền thống đặc sắc được chế biến tỉ mỉ từ những nguyên liệu tươi ngon nhất của vùng đất Hoa Lư, Ninh Bình.' }}
                </p>
            </div>

            <!-- Bottom Price & Order -->
            <div class="flex items-center justify-between pt-3 border-t border-border-custom/20">
                <span class="text-primary-light font-bold text-lg font-sans tracking-tight">
                    {{ $item->formatted_price }}
                </span>
                <a href="{{ route('booking.create') }}" class="text-secondary hover:text-secondary-dark font-bold text-xs uppercase tracking-wider flex items-center gap-1 transition-all duration-200">
                    Đặt bàn <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-16 text-center">
        <div class="text-secondary/40 text-5xl mb-4">
            <i class="fas fa-utensils"></i>
        </div>
        <p class="text-text-secondary font-serif text-lg">Không tìm thấy món ăn nào khớp với lựa chọn của quý khách.</p>
        <p class="text-text-secondary/60 text-sm mt-1">Vui lòng chọn danh mục khác hoặc thay đổi từ khóa tìm kiếm.</p>
    </div>
@endforelse
