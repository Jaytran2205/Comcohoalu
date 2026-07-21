@extends('admin.layouts.admin')

@section('title', 'Quản Lý Danh Mục Thực Đơn')
@section('page_title', 'Danh mục thực đơn')

@section('admin_actions')
<a 
    href="{{ route('admin.menu-categories.create') }}" 
    class="py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-sm"
>
    <i class="fas fa-plus"></i> Thêm danh mục mới
</a>
@endsection

@section('content')
<!-- Table List Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-custom/20 text-left">
            <thead class="bg-bg-secondary/40 text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                <tr>
                    <th scope="col" class="px-6 py-4">Mã Icon</th>
                    <th scope="col" class="px-6 py-4">Tên Danh Mục</th>
                    <th scope="col" class="px-6 py-4">Slug</th>
                    <th scope="col" class="px-6 py-4">Số Món Ăn</th>
                    <th scope="col" class="px-6 py-4">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4">Độ Ưu Tiên</th>
                    <th scope="col" class="px-6 py-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/15 text-xs text-text-secondary">
                @forelse($categories as $cat)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <!-- Icon representation -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="w-8 h-8 rounded-lg bg-bg-secondary text-primary flex items-center justify-center text-sm border border-border-custom/30">
                                <i class="fas {{ $cat->icon ?: 'fa-utensils' }}"></i>
                            </span>
                        </td>
                        <!-- Category Name -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-text-primary">
                            {{ $cat->name }}
                        </td>
                        <!-- Slug -->
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-[10px]">
                            {{ $cat->slug }}
                        </td>
                        <!-- Items Count -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-text-primary">
                            <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary">
                                {{ $cat->items_count }} món
                            </span>
                        </td>
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($cat->is_active)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-success/10 text-success">Đang hoạt động</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-error/10 text-error">Tạm ngưng</span>
                            @endif
                        </td>
                        <!-- Sort Order -->
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-text-primary">
                            {{ $cat->sort_order }}
                        </td>
                        <!-- Action Buttons -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.menu-categories.edit', $cat->id) }}" class="p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded transition-all" title="Sửa danh mục">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <form action="{{ route('admin.menu-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Hành động này sẽ loại bỏ danh mục và chỉ thành công khi danh mục không có món ăn.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-error/10 text-error hover:bg-error hover:text-white rounded transition-all" title="Xóa danh mục">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-folder-open text-4xl opacity-35 mb-2 block"></i>
                            Chưa có danh mục thực đơn nào. Vui lòng bấm thêm danh mục mới.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/10">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
