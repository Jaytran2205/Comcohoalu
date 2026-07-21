@extends('admin.layouts.admin')

@section('title', 'Chi Tiết Đặt Bàn - ' . $booking->booking_code)
@section('page_title', 'Chi tiết đặt bàn')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Link Button -->
    <div class="mb-4">
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold uppercase tracking-wider">
            <i class="fas fa-arrow-left mr-1.5"></i> Quay lại danh sách
        </a>
    </div>

    <!-- Booking details panel -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Left: Booking Info Card -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
                <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20 flex justify-between items-center">
                    <h3 class="font-serif font-bold text-sm text-primary">
                        <i class="fas fa-info-circle text-secondary mr-2"></i> THÔNG TIN ĐƠN ĐẶT
                    </h3>
                    <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-primary text-white uppercase tracking-wider">
                        {{ $booking->booking_code }}
                    </span>
                </div>

                <div class="p-6 space-y-4 text-xs">
                    <!-- Customer details -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Họ tên khách hàng</span>
                            <span class="font-bold text-text-primary text-sm">{{ $booking->customer_name }}</span>
                        </div>
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Số điện thoại</span>
                            <a href="tel:{{ $booking->customer_phone }}" class="font-bold text-primary hover:underline text-sm">
                                {{ $booking->customer_phone }}
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-3 border-t border-border-custom/10">
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Địa chỉ email</span>
                            <span class="font-semibold text-text-primary">{{ $booking->customer_email ?: 'Không cung cấp' }}</span>
                        </div>
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Ngày gửi yêu cầu</span>
                            <span class="font-semibold text-text-primary">{{ $booking->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                    </div>

                    <!-- Dining details -->
                    <div class="grid grid-cols-3 gap-4 pt-3 border-t border-border-custom/10">
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Ngày dùng bữa</span>
                            <span class="font-bold text-text-primary">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Giờ dùng bữa</span>
                            <span class="font-bold text-primary">{{ $booking->booking_time }}</span>
                        </div>
                        <div>
                            <span class="text-text-secondary/70 block mb-1">Số lượng khách</span>
                            <span class="font-bold text-text-primary">
                                {{ $booking->adults }} Người lớn
                                @if($booking->children)
                                    <br><span class="text-[10px] text-text-secondary/80 font-normal">+ {{ $booking->children }} Trẻ em</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Special request detail -->
                    @if($booking->special_requests)
                        <div class="pt-3 border-t border-border-custom/10 bg-bg-secondary/20 p-3 rounded-lg">
                            <span class="text-text-secondary/70 block mb-1 font-semibold">Ghi chú của khách hàng:</span>
                            <p class="text-text-primary italic">"{{ $booking->special_requests }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Confirmation Log Details -->
            @if($booking->confirmed_at)
                <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 text-xs text-text-secondary space-y-2.5">
                    <h4 class="font-bold text-text-primary flex items-center border-b border-border-custom/10 pb-1.5 mb-2">
                        <i class="fas fa-user-check text-secondary mr-2"></i> Nhật ký xác nhận
                    </h4>
                    <div class="flex justify-between">
                        <span>Nhân viên duyệt đơn:</span>
                        <span class="font-semibold text-text-primary">{{ $booking->confirmer->name ?? 'Hệ thống' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Thời điểm xác nhận:</span>
                        <span class="font-semibold text-text-primary">{{ $booking->confirmed_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right: Status Update Form Card -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-6 space-y-6">
                <h3 class="font-serif font-bold text-sm text-primary border-b border-border-custom/20 pb-2 flex items-center">
                    <i class="fas fa-tasks text-secondary mr-2"></i> XỬ LÝ ĐẶT BÀN
                </h3>

                <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Status Selector -->
                    <div>
                        <label for="status" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">
                            Trạng thái đặt bàn
                        </label>
                        <select 
                            name="status" 
                            id="status"
                            required
                            class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >
                            @foreach(\App\Enums\BookingStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ $booking->status->value === $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Admin Notes -->
                    <div>
                        <label for="admin_notes" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">
                            Ghi chú nội bộ
                        </label>
                        <textarea 
                            name="admin_notes" 
                            id="admin_notes" 
                            rows="4" 
                            placeholder="Nhập số bàn đã xếp, thông tin ghi nhớ..."
                            class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
                        >{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>

                    <!-- Submit Action Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="w-full py-2.5 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all"
                        >
                            Cập nhật đơn đặt
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
