@extends('admin.layouts.admin')

@section('title', 'Quản Lý Thực Đơn')
@section('page_title', 'Danh sách thực đơn')

@section('admin_actions')
<a 
    href="{{ route('admin.menu-items.create') }}" 
    class="py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-sm"
>
    <i class="fas fa-plus"></i> Thêm món ăn mới
</a>
@endsection

@section('content')
<!-- Navigation Sub-Tabs -->
<div class="flex items-center space-x-2 border-b border-border-custom/30 mb-6 overflow-x-auto pb-2">
    <a href="{{ route('admin.menu-items.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg bg-primary text-white shadow-sm">
        <i class="fas fa-utensils mr-1.5"></i>Món Ăn Lẻ
    </a>
    <a href="{{ route('admin.set-menus.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-layer-group mr-1.5"></i>Set Mâm Cơm
    </a>
    <a href="{{ route('admin.menu-categories.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-folder mr-1.5"></i>Danh Mục Món
    </a>
    <a href="{{ route('admin.menu-boards.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-images mr-1.5"></i>Ảnh Menu Lá
    </a>
</div>

<!-- Filter Form Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-6 mb-6">
    <form method="GET" action="{{ route('admin.menu-items.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 items-end text-xs">
        
        <!-- Keyword Search -->
        <div class="space-y-2">
            <label for="search" class="block font-bold text-text-primary uppercase tracking-wider">Từ khóa</label>
            <input 
                type="text" 
                name="search" 
                id="search" 
                value="{{ request('search') }}" 
                placeholder="Tên món hoặc mô tả..."
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
            >
        </div>

        <!-- Category Filter -->
        <div class="space-y-2">
            <label for="category_id" class="block font-bold text-text-primary uppercase tracking-wider">Danh mục</label>
            <select 
                name="category_id" 
                id="category_id" 
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs h-[34px]"
            >
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Filter -->
        <div class="space-y-2">
            <label for="status" class="block font-bold text-text-primary uppercase tracking-wider">Trạng thái</label>
            <select 
                name="status" 
                id="status" 
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs h-[34px]"
            >
                <option value="">Tất cả trạng thái</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Còn hàng</option>
                <option value="sold_out" {{ request('status') === 'sold_out' ? 'selected' : '' }}>Tạm hết</option>
                <option value="hidden" {{ request('status') === 'hidden' ? 'selected' : '' }}>Đã ẩn</option>
            </select>
        </div>

        <!-- Featured Filter -->
        <div class="space-y-2">
            <label for="is_featured" class="block font-bold text-text-primary uppercase tracking-wider">Nổi bật</label>
            <select 
                name="is_featured" 
                id="is_featured" 
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs h-[34px]"
            >
                <option value="">Tất cả</option>
                <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>Nổi bật trang chủ</option>
                <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Không nổi bật</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2">
            <button 
                type="submit" 
                class="flex-1 py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg transition-all text-xs uppercase tracking-wider flex items-center justify-center gap-1 h-[34px]"
            >
                <i class="fas fa-filter"></i> Lọc
            </button>
            @if(request()->anyFilled(['search', 'category_id', 'status', 'is_featured']))
                <a 
                    href="{{ route('admin.menu-items.index') }}" 
                    class="py-2 px-3 bg-bg-secondary text-text-secondary hover:bg-border-custom/30 font-bold rounded-lg transition-all text-xs uppercase tracking-wider flex items-center justify-center h-[34px]"
                    title="Xóa bộ lọc"
                >
                    <i class="fas fa-undo"></i>
                </a>
            @endif
        </div>

    </form>
</div>

<!-- Table List Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-custom/20 text-left">
            <thead class="bg-bg-secondary/40 text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                <tr>
                    <th scope="col" class="px-6 py-4">Hình Ảnh</th>
                    <th scope="col" class="px-6 py-4">Tên Món</th>
                    <th scope="col" class="px-6 py-4">Danh Mục</th>
                    <th scope="col" class="px-6 py-4">Đơn Giá</th>
                    <th scope="col" class="px-6 py-4">Nhãn Nổi Bật</th>
                    <th scope="col" class="px-6 py-4">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4">Độ Ưu Tiên</th>
                    <th scope="col" class="px-6 py-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/15 text-xs text-text-secondary">
                @forelse($items as $item)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <!-- Image thumbnail -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-border-custom/30 bg-bg-secondary flex-shrink-0">
                                <img 
                                    src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image)) : asset('images/default-dish.jpg') }}" 
                                    alt="{{ $item->name }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='{{ asset('images/default-dish.jpg') }}'"
                                >
                            </div>
                        </td>
                        <!-- Dish Name -->
                        <td class="px-6 py-4 font-bold text-text-primary">
                            <div class="text-sm">{{ $item->name }}</div>
                            @if($item->is_featured)
                                <span class="inline-flex items-center text-[9px] text-secondary font-bold uppercase tracking-wider mt-0.5">
                                    <i class="fas fa-star mr-1"></i> Trang chủ
                                </span>
                            @endif
                        </td>
                        <!-- Category -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded bg-bg-secondary text-text-secondary font-semibold">
                                {{ $item->category->name }}
                            </span>
                        </td>
                        <!-- Price -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-primary font-serif">
                            {{ $item->formatted_price }}
                        </td>
                        <!-- Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->badge && $item->badge !== \App\Enums\MenuItemBadge::None)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-secondary/20 text-secondary-dark border border-secondary/15">
                                    {{ $item->badge->label() }}
                                </span>
                            @else
                                <span class="text-text-secondary/40 italic">-</span>
                            @endif
                        </td>
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->status->value === 'available')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-success/10 text-success whitespace-nowrap inline-block">Đang bán</span>
                            @elseif($item->status->value === 'sold_out')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-error/10 text-error whitespace-nowrap inline-block">Hết món</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-text-secondary/10 text-text-secondary whitespace-nowrap inline-block">Ẩn</span>
                            @endif
                        </td>
                        <!-- Sort Order -->
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-text-primary">
                            {{ $item->sort_order }}
                        </td>
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.menu-items.edit', $item->id) }}" class="p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded transition-all" title="Sửa món">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa món ăn này? Hành động này sẽ loại bỏ món ăn khỏi thực đơn.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-error/10 text-error hover:bg-error hover:text-white rounded transition-all" title="Xóa món">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-utensils text-4xl opacity-35 mb-2 block"></i>
                            @if(request()->anyFilled(['search', 'category_id', 'status', 'is_featured']))
                                Không tìm thấy món ăn nào khớp với bộ lọc hiện tại.
                            @else
                                Không tìm thấy món ăn nào. Vui lòng bấm nút thêm món ăn mới.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    @if($items->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/10">
            {{ $items->links() }}
        </div>
    @endif
</div>
@endsection
