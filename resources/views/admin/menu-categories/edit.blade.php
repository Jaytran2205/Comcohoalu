@extends('admin.layouts.admin')

@section('title', 'Sửa Danh Mục - ' . $menuCategory->name)
@section('page_title', 'Sửa danh mục')

@section('content')
<div class="max-w-xl mx-auto">
    <!-- Back Link -->
    <div class="mb-4">
        <a href="{{ route('admin.menu-categories.index') }}" class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold uppercase tracking-wider">
            <i class="fas fa-arrow-left mr-1.5"></i> Quay lại danh mục
        </a>
    </div>

    <!-- Form Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
            <h3 class="font-serif font-bold text-sm text-primary">
                <i class="fas fa-edit text-secondary mr-2"></i> CHỈNH SỬA THÔNG TIN DANH MỤC
            </h3>
        </div>

        <form method="POST" action="{{ route('admin.menu-categories.update', $menuCategory->id) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Tên danh mục thực đơn <span class="text-error">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $menuCategory->name) }}" 
                    required
                    class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                >
                @error('name')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Icon & Sort Order Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Icon Class -->
                <div>
                    <label for="icon" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Mã FontAwesome Icon <span class="text-text-secondary/60">(Ví dụ: fa-utensils)</span>
                    </label>
                    <input 
                        type="text" 
                        name="icon" 
                        id="icon" 
                        value="{{ old('icon', $menuCategory->icon) }}" 
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('icon')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Thứ tự hiển thị <span class="text-text-secondary/60">(Nhỏ hiển thị trước)</span>
                    </label>
                    <input 
                        type="number" 
                        name="sort_order" 
                        id="sort_order" 
                        min="0"
                        value="{{ old('sort_order', $menuCategory->sort_order) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('sort_order')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Is Active Switch -->
            <div class="flex items-center">
                <label class="flex items-center text-xs font-semibold text-text-primary cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', $menuCategory->is_active) ? 'checked' : '' }}
                        class="w-4.5 h-4.5 text-primary bg-bg-primary border-border-custom rounded focus:ring-primary/50 focus:ring-2 focus:ring-offset-0 mr-2.5 accent-primary"
                    >
                    <span>Hiển thị và hoạt động</span>
                </label>
                @error('is_active')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-border-custom/20 flex space-x-2">
                <button 
                    type="submit" 
                    class="py-2.5 px-6 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    <i class="fas fa-save mr-1.5"></i> Cập nhật danh mục
                </button>
                <a 
                    href="{{ route('admin.menu-categories.index') }}" 
                    class="py-2.5 px-6 bg-bg-secondary hover:bg-border-custom/40 text-text-secondary font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    Hủy bỏ
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
