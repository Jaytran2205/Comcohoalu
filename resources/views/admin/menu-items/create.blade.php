@extends('admin.layouts.admin')

@section('title', 'Thêm Món Ăn Mới')
@section('page_title', 'Thêm món ăn mới')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Link -->
    <div class="mb-4">
        <a href="{{ route('admin.menu-items.index') }}" class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold uppercase tracking-wider">
            <i class="fas fa-arrow-left mr-1.5"></i> Quay lại thực đơn
        </a>
    </div>

    <!-- Form Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
            <h3 class="font-serif font-bold text-sm text-primary">
                <i class="fas fa-utensils text-secondary mr-2"></i> NHẬP THÔNG TIN MÓN ĂN MỚI
            </h3>
        </div>

        <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Name & Category Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Tên món ăn <span class="text-error">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        required
                        placeholder="Ví dụ: Dê tái chanh Hoa Lư"
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('name')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Danh mục thực đơn <span class="text-error">*</span>
                    </label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Price & Sort Order Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Đơn giá (VNĐ) <span class="text-error">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price" 
                        min="0"
                        step="1000"
                        value="{{ old('price') }}" 
                        required
                        placeholder="Ví dụ: 150000"
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('price')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Độ ưu tiên hiển thị <span class="text-text-secondary/60">(Nhỏ hiển thị trước)</span>
                    </label>
                    <input 
                        type="number" 
                        name="sort_order" 
                        id="sort_order" 
                        min="0"
                        value="{{ old('sort_order', 0) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('sort_order')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Badge & Status Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Badge label -->
                <div>
                    <label for="badge" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Nhãn nổi bật (Badge) <span class="text-error">*</span>
                    </label>
                    <select 
                        name="badge" 
                        id="badge" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                        @foreach(\App\Enums\MenuItemBadge::cases() as $badge)
                            <option value="{{ $badge->value }}" {{ old('badge', 'none') == $badge->value ? 'selected' : '' }}>
                                {{ $badge->label() ?: 'Không có' }}
                            </option>
                        @endforeach
                    </select>
                    @error('badge')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Trạng thái kinh doanh <span class="text-error">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                        @foreach(\App\Enums\MenuItemStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status', 'available') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Mô tả món ăn <span class="text-text-secondary/60">(Giới thiệu nguyên liệu, hương vị)</span>
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    placeholder="Mô tả tóm tắt món ăn ngon..."
                    class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                >{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image upload -->
            <div>
                <label for="image" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Hình ảnh món ăn <span class="text-text-secondary/60">(Tối đa 2MB, định dạng: JPG, PNG, WEBP)</span>
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*"
                    class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                >
                @error('image')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Is Featured Checkbox -->
            <div class="flex items-center">
                <label class="flex items-center text-xs font-semibold text-text-primary cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1" 
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="w-4.5 h-4.5 text-primary bg-bg-primary border-border-custom rounded focus:ring-primary/50 focus:ring-2 focus:ring-offset-0 mr-2.5 accent-primary"
                    >
                    <span>Hiển thị nổi bật trên Trang Chủ</span>
                </label>
                @error('is_featured')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-border-custom/20 flex space-x-2">
                <button 
                    type="submit" 
                    class="py-2.5 px-6 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    <i class="fas fa-save mr-1.5"></i> Lưu thông tin
                </button>
                <a 
                    href="{{ route('admin.menu-items.index') }}" 
                    class="py-2.5 px-6 bg-bg-secondary hover:bg-border-custom/40 text-text-secondary font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    Hủy bỏ
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
