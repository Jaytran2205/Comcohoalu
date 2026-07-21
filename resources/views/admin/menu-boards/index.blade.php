@extends('admin.layouts.admin')

@section('title', 'Quản Lý Menu')
@section('page_title', 'Menu')

@section('admin_actions')
<a 
    href="{{ route('admin.menu-boards.create') }}" 
    class="py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-sm"
>
    <i class="fas fa-plus"></i> Thêm trang mới
</a>
@endsection

@section('content')
<!-- Table List Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-custom/20 text-left">
            <thead class="bg-bg-secondary/40 text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                <tr>
                    <th scope="col" class="px-6 py-4">Hình Ảnh</th>
                    <th scope="col" class="px-6 py-4">Tiêu Đề Trang</th>
                    <th scope="col" class="px-6 py-4">Đường Dẫn File</th>
                    <th scope="col" class="px-6 py-4">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4">Độ Ưu Tiên</th>
                    <th scope="col" class="px-6 py-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/15 text-xs text-text-secondary">
                @forelse($boards as $board)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <!-- Image thumbnail -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ asset('storage/' . $board->image) }}" target="_blank" class="block w-16 h-20 rounded-lg overflow-hidden border border-border-custom/40 hover:border-primary transition-all">
                                <img src="{{ asset('storage/' . $board->image) }}" alt="{{ $board->title ?: 'Menu page' }}" class="w-full h-full object-cover">
                            </a>
                        </td>
                        <!-- Title -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-text-primary">
                            {{ $board->title ?: 'Trang thực đơn #' . $board->id }}
                        </td>
                        <!-- Image path -->
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-[10px] max-w-xs truncate">
                            {{ $board->image }}
                        </td>
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($board->is_active)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-success/10 text-success">Hiển thị</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-error/10 text-error">Ẩn</span>
                            @endif
                        </td>
                        <!-- Sort Order -->
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-text-primary">
                            {{ $board->sort_order }}
                        </td>
                        <!-- Action Buttons -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.menu-boards.edit', $board->id) }}" class="p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded transition-all" title="Sửa trang thực đơn">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <form action="{{ route('admin.menu-boards.destroy', $board->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa trang thực đơn này? Ảnh gốc sẽ bị xóa khỏi hệ thống.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-error/10 text-error hover:bg-error hover:text-white rounded transition-all" title="Xóa trang thực đơn">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-images text-4xl opacity-35 mb-2 block"></i>
                            Chưa có trang Menu nào. Vui lòng bấm thêm trang mới.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    @if($boards->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/10">
            {{ $boards->links() }}
        </div>
    @endif
</div>
@endsection
