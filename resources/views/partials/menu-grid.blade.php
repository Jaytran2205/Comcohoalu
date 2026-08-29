@php
    $menuItems = $menuItems ?? $items ?? [];
@endphp
@forelse($menuItems as $item)
    <div class="premium-card group flex flex-col justify-between h-full bg-white overflow-hidden p-3.5">
        <!-- Dish Image & Badge -->
        <div class="relative overflow-hidden rounded-lg bg-bg-secondary border border-border-custom/30" style="aspect-ratio: 1 / 1; width: 100%;">
            <img 
                src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset($item->image)) : asset('images/default-dish.jpg') }}" 
                alt="{{ $item->name }}" 
                class="transition-transform duration-500 group-hover:scale-105"
                style="width: 100%; height: 100%; object-fit: cover;"
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
                <span class="absolute top-2.5 left-2.5 px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider rounded bg-secondary text-bg-dark shadow-sm">
                    {{ $item->badge->label() }}
                </span>
            @endif

            <!-- Illustration Disclaimer -->
            <span class="absolute bottom-2 right-2 px-1.5 py-0.5 text-[8px] text-white/80 bg-black/45 rounded backdrop-blur-[1px] pointer-events-none tracking-wider select-none">
                *Hình ảnh chỉ mang tính chất minh họa
            </span>
        </div>

        <!-- Details -->
        <div class="pt-4 flex-grow flex flex-col justify-between">
            <div>
                <span class="text-[9px] font-bold text-secondary uppercase tracking-widest block mb-1">
                    {{ $item->category->name }}
                </span>
                <h3 class="text-base font-bold text-primary hover:text-primary-light transition-colors line-clamp-1 mb-1.5 font-serif">
                    {{ $item->name }}
                </h3>
                <p class="text-text-secondary text-xs line-clamp-2 leading-relaxed mb-3">
                    {{ $item->description ?: 'Món ăn truyền thống đặc sắc được chế biến tỉ mỉ từ những nguyên liệu tươi ngon nhất của vùng đất Hoa Lư, Ninh Bình.' }}
                </p>
            </div>

            <!-- Bottom Price & Order -->
            <div class="flex items-center justify-between pt-2.5 border-t border-border-custom/20">
                <span class="text-primary-light font-bold text-base font-sans tracking-tight">
                    {{ $item->formatted_price }}
                </span>
                <a href="{{ route('booking.create') }}" class="text-secondary hover:text-secondary-dark font-bold text-[10px] uppercase tracking-wider flex items-center gap-1 transition-all duration-200">
                    Đặt bàn <i class="fas fa-arrow-right text-[8px]"></i>
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
