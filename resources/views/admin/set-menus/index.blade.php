@extends('admin.layouts.admin')

@section('title', 'Quản Lý Set Mâm Cơm')
@section('page_title', 'Danh sách Set Mâm Cơm')

@section('admin_actions')
    <a href="{{ route('admin.set-menus.create') }}" class="px-4 py-2.5 bg-primary hover:bg-secondary border border-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i>Thêm Set Mới
    </a>
@endsection

@section('content')
<!-- Navigation Sub-Tabs -->
<div class="flex items-center space-x-2 border-b border-border-custom/30 mb-6 overflow-x-auto pb-2">
    <a href="{{ route('admin.menu-items.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-utensils mr-1.5"></i>Món Ăn Lẻ
    </a>
    <a href="{{ route('admin.set-menus.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg bg-primary text-white shadow-sm">
        <i class="fas fa-layer-group mr-1.5"></i>Set Mâm Cơm
    </a>
    <a href="{{ route('admin.menu-categories.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-folder mr-1.5"></i>Danh Mục Món
    </a>
    <a href="{{ route('admin.menu-boards.index') }}" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg text-text-secondary hover:bg-bg-primary transition-all">
        <i class="fas fa-images mr-1.5"></i>Ảnh Menu Lá
    </a>
</div>

<!-- Search & Filter Card -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-4 mb-6">
    <form method="GET" action="{{ route('admin.set-menus.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-1">Từ khóa</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên set hoặc mô tả..." class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-xs text-text-primary focus:outline-none focus:border-primary">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-1">Trạng thái</label>
            <select name="status" class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-xs text-text-primary focus:outline-none focus:border-primary">
                <option value="">Tất cả trạng thái</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Đang hiển thị</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <div class="flex items-end space-x-2">
            <button type="submit" class="w-full py-2 px-4 bg-primary text-white font-bold rounded-lg text-xs uppercase tracking-wider hover:bg-primary-dark transition-all">
                <i class="fas fa-search mr-1"></i>Lọc
            </button>
            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.set-menus.index') }}" class="py-2 px-3 bg-bg-secondary text-text-secondary font-bold rounded-lg text-xs hover:bg-border-custom/40">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-custom/20 text-left">
            <thead class="bg-bg-secondary/40 text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                <tr>
                    <th scope="col" class="px-6 py-4">Tên Set Mâm Cơm</th>
                    <th scope="col" class="px-4 py-4 whitespace-nowrap">Khẩu Phần</th>
                    <th scope="col" class="px-4 py-4 whitespace-nowrap">Giá/Suất</th>
                    <th scope="col" class="px-4 py-4 whitespace-nowrap">Tổng Tiền Mâm</th>
                    <th scope="col" class="px-4 py-4 whitespace-nowrap">Số Món Chi Tiết</th>
                    <th scope="col" class="px-4 py-4 whitespace-nowrap">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4 text-right whitespace-nowrap">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/10 text-xs">
                @forelse($setMenus as $set)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <td class="px-6 py-4 font-bold text-text-primary min-w-[200px]">
                            <span class="text-sm font-serif text-primary block">{{ $set->name }}</span>
                            <span class="text-[10px] text-text-secondary italic font-normal line-clamp-1">{{ $set->description }}</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded bg-secondary/15 text-primary-dark font-bold text-[11px] whitespace-nowrap">
                                {{ $set->people_count }} Người
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap font-semibold text-text-secondary font-sans">
                            {{ number_format($set->price_per_person, 0, ',', '.') }}đ / suất
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap font-bold text-primary text-sm font-sans">
                            {{ number_format($set->price, 0, ',', '.') }}đ
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded-full bg-primary/10 text-primary font-bold text-[10px] whitespace-nowrap">
                                {{ $set->items->count() }} món
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($set->is_active)
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-success/15 text-success whitespace-nowrap inline-block">
                                    Đang bán
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-error/15 text-error whitespace-nowrap inline-block">
                                    Ẩn
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                            <a href="{{ route('admin.set-menus.edit', $set) }}" class="p-1.5 text-text-secondary hover:text-primary hover:bg-bg-secondary rounded transition-colors inline-block" title="Chỉnh sửa">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('admin.set-menus.destroy', $set) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa set mâm cơm {{ $set->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-error hover:bg-error/10 rounded transition-colors" title="Xóa">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-layer-group text-3xl mb-2 block opacity-40"></i>
                            Chưa có set mâm cơm nào. Hãy thêm mâm cơm mới!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($setMenus->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/20">
            {{ $setMenus->links() }}
        </div>
    @endif
</div>
@endsection
