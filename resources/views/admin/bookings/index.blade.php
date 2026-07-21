@extends('admin.layouts.admin')

@section('title', 'Quản Lý Đặt Bàn')
@section('page_title', 'Danh sách đặt bàn')

@section('content')
<!-- Filter Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 mb-8">
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
        <!-- Date filter -->
        <div>
            <label for="date" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">Lọc theo ngày</label>
            <input 
                type="date" 
                name="date" 
                id="date" 
                value="{{ request('date') }}"
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
            >
        </div>

        <!-- Status filter -->
        <div>
            <label for="status" class="block text-[10px] font-bold text-text-secondary uppercase tracking-wider mb-2">Lọc theo trạng thái</label>
            <select 
                name="status" 
                id="status"
                class="w-full px-3 py-2 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary text-xs"
            >
                <option value="">-- Tất cả trạng thái --</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit & Clear Buttons -->
        <div class="flex space-x-2">
            <button 
                type="submit" 
                class="flex-grow py-2 px-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-1.5"
            >
                <i class="fas fa-filter"></i> Lọc đơn
            </button>
            @if(request()->filled('date') || request()->filled('status'))
                <a 
                    href="{{ route('admin.bookings.index') }}" 
                    class="py-2 px-4 bg-bg-secondary hover:bg-border-custom/40 text-text-secondary font-bold rounded-lg text-xs uppercase tracking-wider transition-all flex items-center justify-center"
                    title="Xóa bộ lọc"
                >
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Table List Section -->
<div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-custom/20 text-left">
            <thead class="bg-bg-secondary/40 text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                <tr>
                    <th scope="col" class="px-6 py-4">Mã Đơn</th>
                    <th scope="col" class="px-6 py-4">Khách Hàng</th>
                    <th scope="col" class="px-6 py-4">Ngày Dùng Bữa</th>
                    <th scope="col" class="px-6 py-4">Giờ Đến</th>
                    <th scope="col" class="px-6 py-4">Số Khách</th>
                    <th scope="col" class="px-6 py-4">Trạng Thái</th>
                    <th scope="col" class="px-6 py-4">Ngày Đặt</th>
                    <th scope="col" class="px-6 py-4 text-right">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-custom/15 text-xs text-text-secondary">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-bg-secondary/20 transition-colors">
                        <!-- Booking Code -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-text-primary">
                            {{ $booking->booking_code }}
                        </td>
                        <!-- Customer Info -->
                        <td class="px-6 py-4">
                            <div class="font-semibold text-text-primary">{{ $booking->customer_name }}</div>
                            <div class="text-[10px] text-text-secondary/70">{{ $booking->customer_phone }}</div>
                        </td>
                        <!-- Booking Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-text-primary">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                        </td>
                        <!-- Booking Time -->
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-primary">
                            {{ $booking->booking_time }}
                        </td>
                        <!-- Pax counts -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-medium text-text-primary">{{ $booking->adults }}L</span> 
                            @if($booking->children)
                                <span class="text-text-secondary/70">+ {{ $booking->children }}T</span>
                            @endif
                        </td>
                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($booking->status->value === 'pending')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-warning/10 text-warning">Chờ xác nhận</span>
                            @elseif($booking->status->value === 'confirmed')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-success/10 text-success">Đã xác nhận</span>
                            @elseif($booking->status->value === 'completed')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-primary/10 text-primary">Hoàn thành</span>
                            @elseif($booking->status->value === 'cancelled')
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-error/10 text-error">Đã hủy</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-bg-secondary text-text-secondary">{{ $booking->status->label() }}</span>
                            @endif
                        </td>
                        <!-- Created Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-[10px]">
                            {{ $booking->created_at->format('d/m/Y H:i') }}
                        </td>
                        <!-- Action Buttons -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded transition-all" title="Xem chi tiết & duyệt">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn đặt bàn này? Hành động này không thể hoàn tác.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-error/10 text-error hover:bg-error hover:text-white rounded transition-all" title="Xóa đơn">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-text-secondary">
                            <i class="fas fa-calendar-times text-4xl opacity-35 mb-2 block"></i>
                            Không tìm thấy dữ liệu đặt bàn nào phù hợp.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    @if($bookings->hasPages())
        <div class="px-6 py-4 border-t border-border-custom/20 bg-bg-secondary/10">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection
