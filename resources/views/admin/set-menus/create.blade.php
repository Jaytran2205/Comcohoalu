@extends('admin.layouts.admin')

@section('title', 'Thêm Set Mâm Cơm Mới')
@section('page_title', 'Thêm Set Mâm Cơm')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('admin.set-menus.index') }}" class="text-xs text-text-secondary hover:text-primary font-bold inline-flex items-center">
            <i class="fas fa-arrow-left mr-1.5"></i> Quay lại danh sách set
        </a>
    </div>

    <form method="POST" action="{{ route('admin.set-menus.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        @csrf

        <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
            <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                <i class="fas fa-plus-circle text-secondary mr-2"></i> THÔNG TIN SET MÂM CƠM MỚI
            </h3>
        </div>

        <div class="p-6 space-y-6 text-xs">
            <!-- Name & People Count Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Tên Set Mâm Cơm <span class="text-error">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Ví dụ: Set 150k - Thực đơn 3" class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs">
                    @error('name')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @error('name')
                </div>

                <div>
                    <label for="people_count" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Số Lượng Khách (Khẩu phần) <span class="text-error">*</span>
                    </label>
                    <input type="number" name="people_count" id="people_count" value="{{ old('people_count', 6) }}" min="1" required class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs">
                    @error('people_count')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Price per Person & Sort Order Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price_per_person" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Giá Trên 1 Suất/Người (VNĐ) <span class="text-error">*</span>
                    </label>
                    <input type="number" name="price_per_person" id="price_per_person" value="{{ old('price_per_person', 150000) }}" step="1000" min="0" required placeholder="150000" class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs">
                    @error('price_per_person')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Thứ Tự Sắp Xếp
                    </label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Mô Tả Set Mâm Cơm
                </label>
                <textarea name="description" id="description" rows="3" placeholder="Ví dụ: Set mâm cơm gia đình ấm cúng..." class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs">{{ old('description') }}</textarea>
            </div>

            <!-- Items Selection Grid -->
            <div>
                <label class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Chọn Món Ăn Chi Tiết Trong Set (Có thể chọn nhiều món)
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 p-4 rounded-lg border border-border-custom bg-bg-primary/10 max-h-72 overflow-y-auto">
                    @foreach($menuItems as $item)
                        <label class="flex items-center space-x-2.5 p-2 rounded hover:bg-white border border-transparent hover:border-border-custom/30 cursor-pointer">
                            <input type="checkbox" name="items[]" value="{{ $item->id }}" class="rounded text-primary focus:ring-primary h-4 w-4">
                            <div class="flex-grow min-w-0">
                                <span class="block font-semibold text-text-primary text-xs truncate">{{ $item->name }}</span>
                                <span class="block text-[10px] text-text-secondary">{{ number_format($item->price, 0, ',', '.') }}đ</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center space-x-3 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-primary focus:ring-primary h-4 w-4">
                <label for="is_active" class="text-xs font-bold text-text-primary cursor-pointer">
                    Cho phép hiển thị mâm cơm này trên trang Thực Đơn
                </label>
            </div>
        </div>

        <div class="px-6 py-4 bg-bg-secondary/30 border-t border-border-custom/20 flex justify-end space-x-3">
            <a href="{{ route('admin.set-menus.index') }}" class="px-5 py-2.5 rounded-lg border border-border-custom text-text-secondary hover:bg-bg-primary font-bold text-xs uppercase tracking-wider">
                Hủy bỏ
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary hover:bg-secondary text-white hover:text-bg-dark font-bold text-xs uppercase tracking-wider shadow-md">
                <i class="fas fa-save mr-1.5"></i>Lưu Set Mới
            </button>
        </div>
    </form>
</div>
@endsection
