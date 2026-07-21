<div class="w-64 bg-bg-dark text-text-light flex flex-col flex-shrink-0 border-r border-primary/20">
    <!-- Sidebar Brand -->
    <div class="h-16 flex items-center px-6 bg-black/30 border-b border-primary/10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <span class="text-lg font-bold font-serif text-white tracking-wider">
                Hoa Lư <span class="text-secondary">Admin</span>
            </span>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-grow py-6 px-4 space-y-1 overflow-y-auto">
        <!-- Dashboard Link -->
        <a 
            href="{{ route('admin.dashboard') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-tachometer-alt mr-3 text-sm {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-secondary/80' }}"></i>
            BẢNG ĐIỀU KHIỂN
        </a>

        <!-- Bookings Link -->
        <a 
            href="{{ route('admin.bookings.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->is('admin/bookings*') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-calendar-alt mr-3 text-sm {{ request()->is('admin/bookings*') ? 'text-white' : 'text-secondary/80' }}"></i>
            QUẢN LÝ ĐẶT BÀN
            @php
                $pendingCount = \App\Models\Booking::pending()->count();
            @endphp
            @if($pendingCount > 0)
                <span class="ml-auto px-2 py-0.5 text-[9px] font-bold bg-secondary text-bg-dark rounded-full shadow-inner animate-pulse">
                    {{ $pendingCount }}
                </span>
            @endif
        </a>

        <!-- Menu Items Link -->
        <a 
            href="{{ route('admin.menu-items.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->is('admin/menu-items*') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-utensils mr-3 text-sm {{ request()->is('admin/menu-items*') ? 'text-white' : 'text-secondary/80' }}"></i>
            QUẢN LÝ THỰC ĐƠN
        </a>

        <!-- Menu Categories Link -->
        <a 
            href="{{ route('admin.menu-categories.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->is('admin/menu-categories*') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-folder mr-3 text-sm {{ request()->is('admin/menu-categories*') ? 'text-white' : 'text-secondary/80' }}"></i>
            DANH MỤC MÓN ĂN
        </a>

        <!-- Menu Boards Link -->
        <a 
            href="{{ route('admin.menu-boards.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->is('admin/menu-boards*') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-images mr-3 text-sm {{ request()->is('admin/menu-boards*') ? 'text-white' : 'text-secondary/80' }}"></i>
            QUẢN LÝ MENU
        </a>

        <!-- Posts Link -->
        <a 
            href="{{ route('admin.posts.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->is('admin/posts*') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
        >
            <i class="fas fa-newspaper mr-3 text-sm {{ request()->is('admin/posts*') ? 'text-white' : 'text-secondary/80' }}"></i>
            QUẢN LÝ BÀI VIẾT
        </a>

        <!-- Settings Link (Admin Only) -->
        @if(Auth::user() && Auth::user()->isAdmin())
            <div class="pt-4 mt-4 border-t border-white/5">
                <span class="px-4 text-[10px] font-bold text-text-light/45 uppercase tracking-widest block mb-2">Hệ Thống</span>
                <a 
                    href="{{ route('admin.settings') }}" 
                    class="flex items-center px-4 py-3 rounded-lg text-xs font-semibold tracking-wider transition-all {{ request()->routeIs('admin.settings') ? 'bg-primary text-white shadow-md' : 'text-text-light/75 hover:bg-white/5 hover:text-white' }}"
                >
                    <i class="fas fa-cogs mr-3 text-sm {{ request()->routeIs('admin.settings') ? 'text-white' : 'text-secondary/80' }}"></i>
                    CẤU HÌNH NHÀ HÀNG
                </a>
            </div>
        @endif
    </nav>

    <!-- Sidebar Footer / User Info -->
    <div class="p-4 bg-black/20 border-t border-primary/10 text-center text-xs text-text-light/50">
        <div class="flex items-center justify-center space-x-1">
            <i class="fas fa-shield-alt text-[10px] text-secondary"></i>
            <span>Bảo mật hệ thống</span>
        </div>
        <div class="text-[9px] mt-1 opacity-75">Cơm Cổ Hoa Lư v3.0</div>
    </div>
</div>
