@extends('layouts.app')

@section('title', $category->name . ' - Cơm Cổ Hoa Lư')
@section('meta_description', 'Các bài viết thuộc danh mục ' . $category->name . ' tại nhà hàng Cơm Cổ Hoa Lư. Cập nhật các thông tin ẩm thực hấp dẫn, chương trình ưu đãi và tin tức tuyển dụng.')

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => $category->name,
    'items' => [
        ['label' => $category->name, 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden">
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($posts->isNotEmpty())
            @if($category->slug === 'khuyen-mai')
                <!-- 1. Promotions (Voucher/Coupon Layout) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <div class="relative bg-white border-2 border-dashed border-secondary/40 rounded-xl overflow-hidden flex flex-col justify-between h-full group shadow-md hover:shadow-lg transition-all duration-300">
                            <!-- Ticket Cutouts -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-bg-primary z-10 border-r-2 border-dashed border-secondary/40"></div>
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-6 h-6 rounded-full bg-bg-primary z-10 border-l-2 border-dashed border-secondary/40"></div>
                            
                            <!-- Banner Image -->
                            <div class="relative aspect-[16/10] bg-bg-secondary overflow-hidden">
                                <img 
                                    src="{{ $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/default-post.jpg') }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
                                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                                >
                                <span class="absolute top-4 left-4 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded bg-secondary text-bg-dark shadow-sm">
                                    <i class="fas fa-percentage mr-1"></i> ƯU ĐÃI ĐẶC BIỆT
                                </span>
                            </div>

                            <!-- Details -->
                            <div class="p-6 flex-grow flex flex-col justify-between relative">
                                <div>
                                    <div class="text-[10px] font-bold text-secondary uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                        <i class="far fa-clock"></i>
                                        <span>Đăng: {{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <h3 class="font-serif font-bold text-lg text-primary hover:text-primary-light transition-colors line-clamp-2 mb-3">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    
                                    <p class="text-text-secondary text-xs line-clamp-2 leading-relaxed mb-6">
                                        {{ $post->excerpt ?: $post->summary ?: 'Chương trình ưu đãi hấp dẫn dành riêng cho thực khách khi ghé Cơm Cổ Hoa Lư Ninh Bình.' }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t-2 border-dashed border-border-custom/20">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block w-full py-2.5 text-center bg-primary hover:bg-primary-dark text-white text-xs font-bold uppercase tracking-wider rounded-lg transition-colors shadow-sm">
                                        <i class="fas fa-gift mr-1.5"></i> Xem & Nhận ưu đãi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($category->slug === 'tuyen-dung')
                <!-- 2. Recruitment (Job Listings Layout - 2 columns, no images) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 hover:border-primary/50 overflow-hidden flex flex-col justify-between h-full group transition-all duration-300 p-6 relative">
                            <!-- Job Header -->
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-briefcase text-xl"></i>
                                </div>
                                <div>
                                    <span class="inline-block px-2 py-0.5 text-[9px] font-bold uppercase bg-secondary text-bg-dark rounded mb-1">
                                        Đang Tuyển dụng
                                    </span>
                                    <h3 class="font-serif font-bold text-lg text-primary hover:text-primary-light transition-colors line-clamp-1">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                </div>
                            </div>

                            <!-- Job Attributes -->
                            <div class="grid grid-cols-2 gap-x-4 gap-y-2 mb-6">
                                <div class="flex items-center text-xs text-text-secondary">
                                    <i class="fas fa-map-marker-alt w-5 text-secondary"></i>
                                    <span class="line-clamp-1">Tràng An, Hoa Lư</span>
                                </div>
                                <div class="flex items-center text-xs text-text-secondary">
                                    <i class="fas fa-money-bill-wave w-5 text-secondary"></i>
                                    <span class="line-clamp-1">Lương thỏa thuận</span>
                                </div>
                                <div class="flex items-center text-xs text-text-secondary">
                                    <i class="fas fa-clock w-5 text-secondary"></i>
                                    <span class="line-clamp-1">Full-time / Part-time</span>
                                </div>
                                <div class="flex items-center text-xs text-text-secondary">
                                    <i class="fas fa-calendar-check w-5 text-secondary"></i>
                                    <span class="line-clamp-1">Tuyển liên tục</span>
                                </div>
                            </div>

                            <!-- Job Description -->
                            <p class="text-text-secondary text-xs line-clamp-3 leading-relaxed mb-6 border-t border-border-custom/20 pt-4">
                                {{ $post->excerpt ?: $post->summary ?: 'Cơ hội làm việc tại nhà hàng ẩm thực truyền thống hàng đầu Ninh Bình với môi trường chuyên nghiệp, năng động và chế độ đãi ngộ tốt.' }}
                            </p>

                            <!-- CTA Button -->
                            <div>
                                <a href="{{ route('posts.show', $post->slug) }}" class="block w-full py-2.5 text-center bg-bg-secondary hover:bg-primary hover:text-white text-text-primary text-xs font-bold uppercase tracking-wider rounded-lg transition-all border border-border-custom hover:border-primary">
                                    Xem yêu cầu & Ứng tuyển
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- 3. Default Blog / News Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="premium-card bg-white overflow-hidden flex flex-col justify-between h-full group">
                            
                            <!-- Thumbnail Image -->
                            <div class="relative aspect-[16/10] bg-bg-secondary overflow-hidden">
                                <img 
                                    src="{{ $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/default-post.jpg') }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102"
                                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                                >
                                <span class="absolute top-4 left-4 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded bg-primary text-white">
                                    {{ $category->name }}
                                </span>
                            </div>
                            
                            <!-- Details -->
                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <!-- Publication Date -->
                                    <div class="text-xs text-text-secondary/70 flex items-center mb-2">
                                        <i class="far fa-calendar-alt mr-2 text-secondary"></i>
                                        <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <i class="far fa-eye mr-1.5 text-secondary"></i>
                                        <span>{{ $post->views_count }} lượt xem</span>
                                    </div>
                                    
                                    <!-- Title -->
                                    <h3 class="font-serif font-bold text-lg text-primary hover:text-primary-light transition-colors line-clamp-2 mb-3">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    
                                    <!-- Summary Excerpt -->
                                    <p class="text-text-secondary text-xs line-clamp-3 leading-relaxed mb-6">
                                        {{ $post->summary ?: 'Tìm hiểu các chia sẻ hữu ích, tin tức ẩm thực đặc sắc hoặc các chương trình tuyển dụng, khuyến mãi từ nhà hàng Cơm Cổ Hoa Lư.' }}
                                    </p>
                                </div>
                                
                                <!-- Read More -->
                                <div class="pt-3 border-t border-border-custom/20">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-primary hover:text-primary-dark font-bold text-xs uppercase tracking-wider inline-flex items-center gap-1 transition-all">
                                        Xem chi tiết bài viết <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>

                        </article>
                    @endforeach
                </div>
            @endif

            <!-- Pagination Links (Laravel standard) -->
            <div class="flex justify-center mt-12">
                {{ $posts->links() }}
            </div>
            
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-border-custom/40">
                <div class="text-secondary/30 text-6xl mb-4">
                    <i class="far fa-newspaper"></i>
                </div>
                <h3 class="font-serif font-bold text-xl text-primary mb-2">Chưa Có Bài Viết</h3>
                <p class="text-text-secondary text-xs max-w-sm mx-auto">Danh mục này hiện tại chưa có nội dung nào được đăng tải. Quý khách vui lòng quay lại sau.</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg text-xs uppercase tracking-wider shadow hover:bg-primary-dark transition-all">
                        Quay lại trang chủ
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
