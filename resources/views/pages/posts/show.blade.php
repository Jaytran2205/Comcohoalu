@extends('layouts.app')

@section('title', $post->title . ' - Cơm Cổ Hoa Lư')
@section('meta_description', $post->summary ?: Str::limit(strip_tags($post->content), 150))

@section('content')
<!-- Breadcrumb Header -->
@include('partials.breadcrumb', [
    'title' => $post->category->name,
    'items' => [
        ['label' => $post->category->name, 'url' => route('posts.category', $post->category->slug)],
        ['label' => Str::limit($post->title, 25), 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden">
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Article Header -->
        <header class="mb-10 text-center">
            <!-- Category Badge -->
            <a href="{{ route('posts.category', $post->category->slug) }}" class="inline-block px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full mb-4 hover:bg-primary hover:text-white transition-colors">
                {{ $post->category->name }}
            </a>
            
            <!-- Title -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary font-serif leading-tight mb-6">
                {{ $post->title }}
            </h1>

            <!-- Meta details -->
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs text-text-secondary/70 border-y border-border-custom/30 py-3">
                <span class="flex items-center">
                    <i class="fas fa-user text-secondary mr-2"></i>
                    <span>Tác giả: {{ $post->author->name ?? 'Ban biên tập' }}</span>
                </span>
                <span class="hidden sm:inline text-secondary/40">•</span>
                <span class="flex items-center">
                    <i class="far fa-calendar-alt text-secondary mr-2"></i>
                    <span>Đăng ngày: {{ $post->published_at ? $post->published_at->format('H:i - d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                </span>
                <span class="hidden sm:inline text-secondary/40">•</span>
                <span class="flex items-center">
                    <i class="far fa-eye text-secondary mr-2"></i>
                    <span>{{ $post->views_count }} lượt xem</span>
                </span>
            </div>
        </header>

        <!-- Article Featured Image -->
        @if($post->featured_image)
            <div class="rounded-xl overflow-hidden shadow-md mb-10 aspect-[16/9] bg-bg-secondary border border-border-custom/20">
                <img 
                    src="{{ str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image) }}" 
                    alt="{{ $post->title }}"
                    class="w-full h-full object-cover"
                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                >
            </div>
        @endif

        <!-- Article Content (Rich HTML output) -->
        <article class="prose-content text-text-primary text-sm sm:text-base leading-relaxed space-y-6 pb-12 border-b border-border-custom/30">
            {!! $post->content !!}
        </article>

        <!-- Back & Share -->
        <div class="flex justify-between items-center py-6 text-xs mb-16">
            <a href="{{ route('posts.category', $post->category->slug) }}" class="text-primary hover:text-primary-dark font-bold uppercase tracking-wider transition-colors">
                <i class="fas fa-chevron-left mr-1.5"></i> Quay lại mục {{ $post->category->name }}
            </a>
            <div class="flex items-center space-x-2 text-text-secondary">
                <span>Chia sẻ:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer" class="hover:text-primary transition-colors text-sm">
                    <i class="fab fa-facebook-square"></i>
                </a>
            </div>
        </div>

        <!-- Related Posts Section -->
        @if($relatedPosts->isNotEmpty())
            <div class="pt-8 border-t border-border-custom/30">
                <h3 class="font-serif font-bold text-xl text-primary mb-8 text-center sm:text-left">Bài viết liên quan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @foreach($relatedPosts as $relPost)
                        <div class="flex gap-4 items-center bg-white p-4 rounded-xl shadow-sm border border-border-custom/30 group">
                            <!-- Image -->
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-bg-secondary">
                                <img 
                                    src="{{ $relPost->featured_image ? (str_starts_with($relPost->featured_image, 'http') ? $relPost->featured_image : asset('storage/' . $relPost->featured_image)) : asset('images/default-post.jpg') }}" 
                                    alt="{{ $relPost->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                    onerror="this.src='{{ asset('images/default-post.jpg') }}'"
                                >
                            </div>
                            <!-- Title & Info -->
                            <div>
                                <span class="text-[9px] font-bold text-secondary uppercase tracking-widest block mb-0.5">{{ $relPost->published_at ? $relPost->published_at->format('d/m/Y') : $relPost->created_at->format('d/m/Y') }}</span>
                                <h4 class="font-serif font-bold text-sm text-primary group-hover:text-primary-light transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('posts.show', $relPost->slug) }}">{{ $relPost->title }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

<!-- Custom Styling Injection for Article Content Elements -->
<style>
    .prose-content p {
        margin-bottom: 1.25rem;
        text-align: justify;
    }
    .prose-content h2 {
        font-family: var(--font-serif);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .prose-content h3 {
        font-family: var(--font-serif);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .prose-content ul {
        list-style-type: disc;
        list-style-position: inside;
        margin-bottom: 1.25rem;
        padding-left: 1rem;
        space-y: 0.5rem;
    }
    .prose-content ol {
        list-style-type: decimal;
        list-style-position: inside;
        margin-bottom: 1.25rem;
        padding-left: 1rem;
    }
    .prose-content li {
        margin-bottom: 0.5rem;
        color: var(--color-text-secondary);
    }
    .prose-content strong {
        color: var(--color-text-primary);
        font-weight: 600;
    }
    .prose-content img {
        border-radius: 8px;
        margin: 1.5rem auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>
@endsection
