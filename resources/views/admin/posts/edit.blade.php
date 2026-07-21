@extends('admin.layouts.admin')

@section('title', 'Sửa Bài Viết - ' . $post->title)
@section('page_title', 'Sửa bài viết')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Link -->
    <div class="mb-4">
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold uppercase tracking-wider">
            <i class="fas fa-arrow-left mr-1.5"></i> Quay lại bài viết
        </a>
    </div>

    <!-- Form Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20">
            <h3 class="font-serif font-bold text-sm text-primary">
                <i class="fas fa-edit text-secondary mr-2"></i> CHỈNH SỬA NỘI DUNG BÀI VIẾT
            </h3>
        </div>

        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Title & Category Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Title (2 cols) -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Tiêu đề bài viết <span class="text-error">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $post->title) }}" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                    @error('title')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Chuyên mục bài viết <span class="text-error">*</span>
                    </label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Excerpt (Tóm tắt ngắn) -->
            <div>
                <label for="excerpt" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Tóm tắt ngắn <span class="text-text-secondary/60">(Tối đa 500 ký tự - Hiển thị ngoài danh mục)</span>
                </label>
                <textarea 
                    name="excerpt" 
                    id="excerpt" 
                    rows="2" 
                    maxlength="500"
                    class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                >{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Content (Nội dung bài viết) -->
            <div>
                <label for="content" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                    Nội dung chi tiết <span class="text-error">*</span> <span class="text-text-secondary/60">(Hỗ trợ nhập thẻ HTML)</span>
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="12" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs font-mono"
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image preview, upload & Status Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Image upload & Preview -->
                <div>
                    <label class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Hình ảnh tiêu đề (Thumbnail)
                    </label>
                    <div class="flex items-center space-x-4 mb-3">
                        <div class="w-16 h-10 rounded overflow-hidden border border-border-custom/30 bg-bg-secondary flex-shrink-0">
                            <img 
                                src="{{ $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/default-post.jpg') }}" 
                                alt="{{ $post->title }}" 
                                class="w-full h-full object-cover"
                                onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                            >
                        </div>
                        <span class="text-[10px] text-text-secondary leading-snug">Nếu tải lên hình mới, hình cũ sẽ bị ghi đè. Tối đa 2MB.</span>
                    </div>
                    
                    <input 
                        type="file" 
                        name="featured_image" 
                        id="featured_image" 
                        accept="image/*"
                        class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                    >
                    @error('featured_image')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                        Trạng thái bài viết <span class="text-error">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        required
                        class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                    >
                        @foreach(\App\Enums\PostStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status', $post->status->value) == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- SEO metadata section -->
            <div class="pt-4 border-t border-border-custom/20">
                <span class="block text-xs font-bold text-primary uppercase tracking-wider mb-4 flex items-center">
                    <i class="fas fa-globe text-secondary mr-2"></i> TỐI ƯU HÓA SEO (KHÔNG BẮT BUỘC)
                </span>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Thẻ Tiêu đề SEO (Meta Title) <span class="text-text-secondary/60">(Tối đa 60 ký tự)</span>
                        </label>
                        <input 
                            type="text" 
                            name="meta_title" 
                            id="meta_title" 
                            maxlength="60"
                            value="{{ old('meta_title', $post->meta_title) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                        >
                        @error('meta_title')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Thẻ Mô tả SEO (Meta Description) <span class="text-text-secondary/60">(Tối đa 160 ký tự)</span>
                        </label>
                        <input 
                            type="text" 
                            name="meta_description" 
                            id="meta_description" 
                            maxlength="160"
                            value="{{ old('meta_description', $post->meta_description) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                        >
                        @error('meta_description')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-border-custom/20 flex space-x-2">
                <button 
                    type="submit" 
                    class="py-2.5 px-6 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    <i class="fas fa-save mr-1.5"></i> Cập nhật bài viết
                </button>
                <a 
                    href="{{ route('admin.posts.index') }}" 
                    class="py-2.5 px-6 bg-bg-secondary hover:bg-border-custom/40 text-text-secondary font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                >
                    Hủy bỏ
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'undo', 'redo'
            ],
            language: 'vi'
        })
        .then(editor => {
            // Apply min-height to editor
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    /* Styling overrides for CKEditor to align with Tailwind container */
    .ck-editor__editable_inline {
        background-color: rgba(249, 250, 251, 0.2) !important;
        color: var(--color-text-primary) !important;
        font-size: 0.75rem !important; /* text-xs */
        font-family: inherit !important;
        border-bottom-left-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: var(--color-border-custom) !important;
    }
    .ck.ck-editor__main>.ck-editor__editable.ck-focused {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 2px rgba(61, 30, 11, 0.25) !important; /* focus:ring-primary/25 */
    }
    .ck.ck-toolbar {
        background-color: rgba(249, 250, 251, 0.4) !important;
        border-color: var(--color-border-custom) !important;
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
    }
</style>
@endsection
