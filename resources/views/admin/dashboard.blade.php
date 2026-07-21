@extends('admin.layouts.admin')

@section('title', 'Bảng Điều Khiển')
@section('page_title', 'Bảng điều khiển')

@section('content')
<!-- 1. Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    
    <!-- Stats Card 1: Bookings Today -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-border-custom/30 flex items-center justify-between">
        <div>
            <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block">Đặt bàn hôm nay</span>
            <span class="text-2xl font-bold font-serif text-primary-light mt-1 block">{{ $stats['bookings_today'] }}</span>
        </div>
        <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xl">
            <i class="fas fa-calendar-day"></i>
        </div>
    </div>

    <!-- Stats Card 2: Pending Bookings -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-border-custom/30 flex items-center justify-between relative overflow-hidden">
        @if($stats['bookings_pending'] > 0)
            <div class="absolute top-0 left-0 w-full h-1 bg-warning"></div>
        @endif
        <div>
            <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block">Đơn chờ xác nhận</span>
            <span class="text-2xl font-bold font-serif text-warning mt-1 block {{ $stats['bookings_pending'] > 0 ? 'animate-pulse' : '' }}">{{ $stats['bookings_pending'] }}</span>
        </div>
        <div class="w-12 h-12 rounded-lg {{ $stats['bookings_pending'] > 0 ? 'bg-warning/10 text-warning' : 'bg-bg-secondary text-text-secondary' }} flex items-center justify-center text-xl">
            <i class="fas fa-spinner"></i>
        </div>
    </div>

    <!-- Stats Card 3: Week Bookings -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-border-custom/30 flex items-center justify-between">
        <div>
            <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block">Tổng đơn tuần này</span>
            <span class="text-2xl font-bold font-serif text-primary mt-1 block">{{ $stats['bookings_this_week'] }}</span>
        </div>
        <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xl">
            <i class="fas fa-calendar-week"></i>
        </div>
    </div>

    <!-- Stats Card 4: Total Menu Items -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-border-custom/30 flex items-center justify-between">
        <div>
            <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block">Thực đơn hiện tại</span>
            <span class="text-2xl font-bold font-serif text-secondary-dark mt-1 block">{{ $stats['total_menu_items'] }} món</span>
        </div>
        <div class="w-12 h-12 rounded-lg bg-secondary/10 text-secondary-dark flex items-center justify-center text-xl">
            <i class="fas fa-hamburger"></i>
        </div>
    </div>

    <!-- Stats Card 5: Unread Contacts -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-border-custom/30 flex items-center justify-between relative overflow-hidden">
        @if($stats['unread_contacts'] > 0)
            <div class="absolute top-0 left-0 w-full h-1 bg-error"></div>
        @endif
        <div>
            <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block">Phản hồi chưa đọc</span>
            <span class="text-2xl font-bold font-serif text-error mt-1 block">{{ $stats['unread_contacts'] }}</span>
        </div>
        <div class="w-12 h-12 rounded-lg {{ $stats['unread_contacts'] > 0 ? 'bg-error/10 text-error' : 'bg-bg-secondary text-text-secondary' }} flex items-center justify-center text-xl">
            <i class="fas fa-envelope-open-text"></i>
        </div>
    </div>

</div>

<!-- 2. Main Dashboard Split-Pane Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Left Panel: Upcoming Bookings (Dùng bữa sắp tới) -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 border-b border-border-custom/20 bg-bg-secondary/40 flex justify-between items-center">
            <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                <i class="fas fa-utensils text-secondary mr-2"></i> LỊCH DÙNG BỮA SẮP TỚI
            </h3>
            <span class="text-[10px] text-text-secondary font-medium italic">Tối đa 10 lượt</span>
        </div>
        
        <div class="divide-y divide-border-custom/15 max-h-[500px] overflow-y-auto">
            @forelse($upcomingBookings as $booking)
                <div class="p-4 hover:bg-bg-secondary/20 transition-colors flex items-center justify-between">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <span class="font-bold text-xs text-text-primary">{{ $booking->customer_name }}</span>
                            <span class="text-[10px] text-text-secondary">({{ $booking->customer_phone }})</span>
                        </div>
                        <div class="text-[10px] text-text-secondary flex items-center space-x-3">
                            <span>
                                <i class="far fa-calendar text-secondary mr-1"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                            </span>
                            <span>
                                <i class="far fa-clock text-secondary mr-1"></i>
                                {{ $booking->booking_time }}
                            </span>
                            <span>
                                <i class="fas fa-user-friends text-secondary mr-1"></i>
                                {{ $booking->adults }}L + {{ $booking->children ?: 0 }}T
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        @if($booking->status->value === 'pending')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-warning/10 text-warning">Chờ duyệt</span>
                        @elseif($booking->status->value === 'confirmed')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-success/10 text-success">Đã xác nhận</span>
                        @endif
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="p-1.5 text-primary hover:text-primary-dark hover:bg-primary/5 rounded transition-all text-xs" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-text-secondary text-xs">
                    <i class="fas fa-clipboard-list text-3xl opacity-35 mb-2 block"></i>
                    Không có đơn đặt bàn nào chuẩn bị dùng bữa.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Right Panel: Recent Activity (Đơn đặt bàn vừa tạo) -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 border-b border-border-custom/20 bg-bg-secondary/40 flex justify-between items-center">
            <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                <i class="fas fa-history text-secondary mr-2"></i> YÊU CẦU ĐẶT BÀN MỚI
            </h3>
            <span class="text-[10px] text-text-secondary font-medium italic">Vừa được tạo</span>
        </div>

        <div class="divide-y divide-border-custom/15 max-h-[500px] overflow-y-auto">
            @forelse($recentBookings as $booking)
                <div class="p-4 hover:bg-bg-secondary/20 transition-colors flex items-center justify-between">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <span class="font-bold text-xs text-text-primary">{{ $booking->customer_name }}</span>
                            <span class="px-1.5 py-0.5 rounded text-[8px] font-bold tracking-wider bg-bg-secondary text-text-secondary border border-border-custom/30">{{ $booking->booking_code }}</span>
                        </div>
                        <div class="text-[10px] text-text-secondary flex items-center space-x-3">
                            <span>
                                <i class="far fa-clock text-secondary mr-1"></i>
                                {{ $booking->created_at->diffForHumans() }}
                            </span>
                            <span>
                                <i class="fas fa-user-friends text-secondary mr-1"></i>
                                {{ $booking->adults }} khách
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        @if($booking->status->value === 'pending')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-warning/10 text-warning">Chờ duyệt</span>
                        @elseif($booking->status->value === 'confirmed')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-success/10 text-success">Đã duyệt</span>
                        @elseif($booking->status->value === 'completed')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-primary/10 text-primary">Hoàn thành</span>
                        @elseif($booking->status->value === 'cancelled')
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-error/10 text-error">Hủy</span>
                        @else
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-bg-secondary text-text-secondary">{{ $booking->status->label() }}</span>
                        @endif
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="p-1.5 text-primary hover:text-primary-dark hover:bg-primary/5 rounded transition-all text-xs" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-text-secondary text-xs">
                    <i class="fas fa-clipboard-list text-3xl opacity-35 mb-2 block"></i>
                    Chưa có đơn đặt bàn nào được tạo.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
