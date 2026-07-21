@extends('layouts.app')

@section('title', 'Đăng nhập hệ thống')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12 relative overflow-hidden bg-bg-secondary">
    <!-- Background Decorator Pattern -->
    <div class="absolute inset-0 viet-pattern-bg"></div>

    <div class="relative w-full max-w-md bg-white rounded-xl shadow-xl border border-border-custom/50 overflow-hidden z-10">
        <!-- Accent Top Bar -->
        <div class="h-2 bg-gradient-to-r from-primary to-secondary"></div>
        
        <div class="p-8">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block text-3xl font-bold font-serif text-primary tracking-wide mb-2">
                    Cơm Cổ <span class="text-secondary">Hoa Lư</span>
                </a>
                <p class="text-text-secondary text-sm">Hệ thống quản trị nội bộ nhà hàng</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->has('email') && Request::is('login'))
                <div class="mb-6 p-4 bg-error/10 border-l-4 border-error text-error text-sm rounded-r-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-text-primary mb-2">
                        <i class="fas fa-envelope mr-1.5 text-primary-light"></i> Địa chỉ Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        placeholder="admin@comcohoalu.vn"
                        class="w-full px-4 py-3 rounded-lg border border-border-custom bg-bg-primary/30 text-text-primary placeholder-text-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-sm"
                    >
                    @error('email')
                        @if(!Request::is('login'))
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @endif
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-text-primary mb-2">
                        <i class="fas fa-lock mr-1.5 text-primary-light"></i> Mật khẩu
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-lg border border-border-custom bg-bg-primary/30 text-text-primary placeholder-text-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-sm"
                    >
                    @error('password')
                        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-xs text-text-secondary cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 text-primary bg-bg-primary border-border-custom rounded focus:ring-primary/50 focus:ring-2 focus:ring-offset-0 mr-2 accent-primary"
                        >
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full py-3 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center text-sm"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center pt-6 border-t border-border-custom/30">
                <a href="{{ route('home') }}" class="text-xs text-secondary hover:text-secondary-dark font-semibold transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Trở về Trang chủ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
