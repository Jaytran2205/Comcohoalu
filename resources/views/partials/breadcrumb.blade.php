<div class="relative py-12 md:py-16 bg-bg-secondary overflow-hidden border-b border-border-custom/40">
    <!-- Traditional background pattern -->
    <div class="absolute inset-0 viet-pattern-bg"></div>
    
    <!-- Decorative side lanterns/icons for premium layout -->
    <div class="absolute top-1/2 left-6 -translate-y-1/2 opacity-20 hidden md:block text-primary text-4xl">
        <i class="fas fa-seedling"></i>
    </div>
    <div class="absolute top-1/2 right-6 -translate-y-1/2 opacity-20 hidden md:block text-primary text-4xl">
        <i class="fas fa-seedling"></i>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Page Title -->
        <h1 class="text-3xl md:text-4xl font-bold font-serif text-primary tracking-wide mb-3">
            {{ $title }}
        </h1>
        
        <!-- Breadcrumb Links -->
        <nav class="flex justify-center items-center space-x-2 text-sm text-text-secondary">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
            
            @if(isset($items) && is_array($items))
                @foreach($items as $item)
                    <span class="text-secondary/50 font-serif">•</span>
                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" class="hover:text-primary transition-colors">{{ $item['label'] }}</a>
                    @else
                        <span class="text-text-primary font-medium">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            @endif
        </nav>
    </div>
</div>
