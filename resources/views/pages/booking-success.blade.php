@extends('layouts.app')

@section('title', 'Đặt Bàn Thành Công - Cơm Cổ Hoa Lư')

@section('content')
<!-- Breadcrumb -->
@include('partials.breadcrumb', [
    'title' => 'Xác Nhận Đặt Bàn',
    'items' => [
        ['label' => 'Đặt bàn', 'url' => route('booking.create')],
        ['label' => 'Thành công', 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden">
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-2xl mx-auto px-4 text-center">
        
        <!-- Big checkmark icon -->
        <div class="w-20 h-20 rounded-full bg-success/10 text-success flex items-center justify-center mx-auto text-4xl mb-8 border-2 border-success/30 shadow-inner">
            <i class="fas fa-check-double"></i>
        </div>

        <h2 class="text-3xl font-bold text-primary font-serif mb-3">Đặt Bàn Thành Công!</h2>
        <p class="text-text-secondary text-sm leading-relaxed max-w-md mx-auto mb-8">
            Cảm ơn quý khách đã tin chọn <strong>Cơm Cổ Hoa Lư</strong>. Nhân viên nhà hàng sẽ liên hệ lại qua số điện thoại dưới đây để xác nhận trạng thái bàn trong vòng 10-15 phút.
        </p>

        <!-- Booking details card -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/50 p-6 md:p-8 text-left mb-8 space-y-5">
            <div class="flex justify-between items-center border-b border-border-custom/20 pb-3">
                <span class="text-xs text-text-secondary/70 uppercase tracking-widest">Mã đặt bàn</span>
                <span class="text-lg font-bold text-primary font-serif tracking-wider">{{ $booking->booking_code }}</span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-text-secondary/70 block mb-1">Khách hàng</span>
                    <span class="font-bold text-text-primary">{{ $booking->customer_name }}</span>
                </div>
                <div>
                    <span class="text-text-secondary/70 block mb-1">Số điện thoại</span>
                    <span class="font-bold text-text-primary">{{ $booking->customer_phone }}</span>
                </div>
                <div>
                    <span class="text-text-secondary/70 block mb-1">Ngày dùng bữa</span>
                    <span class="font-bold text-text-primary">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                </div>
                <div>
                    <span class="text-text-secondary/70 block mb-1">Giờ đến dùng bữa</span>
                    <span class="font-bold text-text-primary">{{ $booking->booking_time }}</span>
                </div>
                <div>
                    <span class="text-text-secondary/70 block mb-1">Số lượng người lớn</span>
                    <span class="font-bold text-text-primary">{{ $booking->adults }} người lớn</span>
                </div>
                <div>
                    <span class="text-text-secondary/70 block mb-1">Số lượng trẻ em</span>
                    <span class="font-bold text-text-primary">{{ $booking->children ?: 0 }} trẻ em</span>
                </div>
            </div>

            @if($booking->special_requests)
                <div class="border-t border-border-custom/20 pt-3 text-xs">
                    <span class="text-text-secondary/70 block mb-1">Yêu cầu đặc biệt</span>
                    <p class="text-text-primary italic">"{{ $booking->special_requests }}"</p>
                </div>
            @endif

            <div class="border-t border-border-custom/20 pt-4 flex justify-between items-center text-xs">
                <span class="text-text-secondary/70">Trạng thái hiện tại</span>
                <span class="px-2.5 py-1 rounded bg-warning/10 text-warning font-semibold">
                    <i class="fas fa-spinner fa-spin mr-1"></i> Chờ xác nhận
                </span>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('home') }}" class="px-6 py-3 border border-primary text-primary hover:bg-primary hover:text-white font-bold rounded-lg transition-colors text-xs uppercase tracking-wider">
                <i class="fas fa-home mr-1.5"></i> Về trang chủ
            </a>
            <a href="{{ route('menu') }}" class="px-6 py-3 bg-secondary hover:bg-secondary-dark text-bg-dark font-bold rounded-lg transition-colors text-xs uppercase tracking-wider shadow-sm">
                <i class="fas fa-utensils mr-1.5"></i> Xem thực đơn
            </a>
        </div>

        <div class="mt-12 text-xs text-text-secondary/80">
            <i class="fas fa-phone mr-1"></i> Hotline khẩn cấp: <span class="font-bold text-primary">{{ $siteSettings['site_hotline'] ?? '0866.000.000' }}</span>
        </div>

    </div>
</section>
@endsection
