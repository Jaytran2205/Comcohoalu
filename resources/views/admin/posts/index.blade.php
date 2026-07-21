@extends('admin.layouts.admin')

@section('title', 'Quản Lý Bài Viết')
@section('page_title', 'Danh sách bài viết')

@section('admin_actions')
<a 
    href="{{ route('admin.posts.create') }}" 
    class="py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-sm"
>
    <i class="fas fa-plus"></i> Viết bài mới
</a>
@endsection

@section('content')
<!-- Filter Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 mb-8">
    <form method="GET" action="{{ route('admin.posts.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
        <!-- Category filter -->
        <div>
            <label for="category" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">Lọc theo chuyên mục</label>
            <select 
                name="category" 
                id="category"
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
            >
                <option value="">-- Tất cả chuyên mục --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status filter -->
        <div>
            <label for="status" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">Lọc theo trạng thái</label>
            <select 
                name="status" 
                id="status"
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
            >
                <option value="">-- Tất cả trạng thái --</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit & Clear Buttons -->
        <div class="flex space-x-2">
            <button 
                type="submit" 
                class="flex-grow py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-1.5"
            >
                <i class="fas fa-filter"></i> Lọc danh sách
            </button>
            @if(request()->filled('category') || request()->filled('status'))
                <a 
                    href="{{ route('admin.posts.index') }}" 
                    class="py-2 px-4 bg-bg-secondary hover:bg-border-custom/40 text-text-secondary font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center justify-center"
                    title="Xóa bộ lọc"
                >
                    <i class="fas fa-times"></i>
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
                    <th scope="col" class="px-6 py-4">Tiêu Đề</th>
                    <th scope="col" class="px-6 py-4">Chuyên Mục</th>
                    <th scope="col" class="px-6 py-4">Người Viết</th>
                    <th scope="col" class="px-6 py-4">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4">Lượt Xem</th>
                    <th scope="col" class="px-6 py-4">Ngày Đăng</th>
                    <th scope="col" class="px-6 py-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/15 text-xs text-text-secondary">
                @forelse($posts as $post)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <!-- Post Thumbnail -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-16 h-10 rounded overflow-hidden border border-border-custom/30 bg-bg-secondary flex-shrink-0">
                                <img 
                                    src="{{ $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/default-post.jpg') }}" 
                                    alt="{{ $post->title }}" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                                >
                            </div>
                        </td>
                        <!-- Post Title -->
                        <td class="px-6 py-4 font-bold text-text-primary max-w-xs md:max-w-md">
                            <div class="truncate text-sm" title="{{ $post->title }}">{{ $post->title }}</div>
                            <div class="text-[9px] text-text-secondary/70 font-normal mt-0.5 font-sans">Slug: {{ $post->slug }}</div>
                        </td>
                        <!-- Category -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-bg-secondary text-text-secondary border border-border-custom/30">
                                {{ $post->category->name }}
                            </span>
                        </td>
                        <!-- Author -->
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-text-primary">
                            {{ $post->author->name ?? 'Ban biên tập' }}
                        </td>
                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->status->value === 'published')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-success/10 text-success">Xuất bản</span>
                            @elseif($post->status->value === 'draft')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-warning/10 text-warning">Bản nháp</span>
                            @elseif($post->status->value === 'archived')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-bg-secondary text-text-secondary">Lưu trữ</span>
                            @endif
                        </td>
                        <!-- Views Count -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-text-primary">
                            <i class="far fa-eye mr-1 text-text-secondary"></i> {{ $post->views_count }}
                        </td>
                        <!-- Published Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-[10px]">
                            {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : ($post->created_at->format('d/m/Y') . ' (chưa đăng)') }}
                        </td>
                        <!-- Action Buttons -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded transition-all" title="Sửa bài viết">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này? Hành động này sẽ gỡ bài viết khỏi hệ thống.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-error/10 text-error hover:bg-error hover:text-white rounded transition-all" title="Xóa bài">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-newspaper text-4xl opacity-35 mb-2 block"></i>
                            Không tìm thấy bài viết nào phù hợp. Vui lòng bấm viết bài mới.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    @if($posts->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/10">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
