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

            <!-- Order / Menu Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
                <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20 flex justify-between items-center">
                    <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                        <i class="fas fa-utensils text-secondary mr-2"></i> CHI TIẾT THỰC ĐƠN / COMBO ĐÃ ĐẶT
                    </h3>
                    @if($booking->estimated_total > 0)
                        <span class="text-xs font-bold text-secondary-dark font-serif">
                            Tổng tạm tính: {{ number_format($booking->estimated_total, 0, ',', '.') }}đ
                        </span>
                    @endif
                </div>

                <div class="p-6 text-xs">
                    @if($booking->order_type === 'combo' || $booking->setMenu)
                        <!-- Combo Information -->
                        <div class="p-4 rounded-xl bg-bg-primary/20 border border-border-custom/40 space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center space-x-3">
                                    @if($booking->setMenu && $booking->setMenu->image)
                                        <img 
                                            src="{{ str_starts_with($booking->setMenu->image, 'http') ? $booking->setMenu->image : (str_starts_with($booking->setMenu->image, 'images/') ? asset($booking->setMenu->image) : asset('storage/' . $booking->setMenu->image)) }}" 
                                            alt="{{ $booking->setMenu->name }}" 
                                            class="w-16 h-16 object-cover rounded-lg border border-border-custom/50 shadow-sm flex-shrink-0"
                                        >
                                    @endif
                                    <div>
                                        <span class="text-[10px] font-bold text-secondary uppercase tracking-wider block">Combo Mâm Cơm</span>
                                        <h4 class="text-sm font-serif font-bold text-primary">{{ $booking->setMenu->name ?? 'Combo Mâm Cơm Đã Chọn' }}</h4>
                                        <span class="text-[11px] text-text-secondary">
                                            Khẩu phần {{ $booking->setMenu->people_count ?? 6 }} người • {{ number_format($booking->setMenu->price_per_person ?? 0, 0, ',', '.') }}đ / suất
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[11px] font-bold text-text-primary block">Số lượng mâm: <span class="text-primary text-sm font-bold">{{ $booking->combo_quantity ?? 1 }}</span></span>
                                    <span class="text-sm font-bold text-primary-light font-sans">{{ number_format($booking->estimated_total, 0, ',', '.') }}đ</span>
                                </div>
                            </div>

                            @if($booking->setMenu && $booking->setMenu->items->isNotEmpty())
                                <div class="pt-3 border-t border-border-custom/20">
                                    <span class="text-[10px] font-bold text-text-secondary uppercase tracking-wider block mb-2">Các món ăn trong set mâm:</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($booking->setMenu->items as $item)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-white text-text-primary text-[11px] font-medium border border-border-custom/30 shadow-2xs">
                                                <i class="fas fa-check-circle text-secondary text-[9px] mr-1.5"></i>
                                                {{ $item->name }}
                                                @if($item->pivot && $item->pivot->quantity > 1)
                                                    <span class="text-primary font-bold ml-1">(x{{ $item->pivot->quantity }})</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif(!empty($booking->ordered_items) && is_array($booking->ordered_items))
                        <!-- Individual Dishes Information -->
                        <div class="border border-border-custom/30 rounded-xl overflow-hidden shadow-2xs">
                            <table class="min-w-full divide-y divide-border-custom/20 text-left">
                                <thead class="bg-bg-secondary/40 text-[10px] font-bold uppercase tracking-wider text-text-secondary">
                                    <tr>
                                        <th class="px-4 py-2.5">Món ăn đã đặt trước</th>
                                        <th class="px-3 py-2.5 text-center">Số lượng</th>
                                        <th class="px-3 py-2.5 text-right">Đơn giá</th>
                                        <th class="px-4 py-2.5 text-right">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-custom/10 text-xs">
                                    @foreach($booking->ordered_items as $item)
                                        <tr class="hover:bg-bg-secondary/20">
                                            <td class="px-4 py-2.5 font-semibold text-text-primary">{{ $item['name'] ?? '' }}</td>
                                            <td class="px-3 py-2.5 text-center font-bold text-primary">{{ $item['quantity'] ?? 1 }}</td>
                                            <td class="px-3 py-2.5 text-right text-text-secondary font-sans">{{ number_format($item['price'] ?? 0, 0, ',', '.') }}đ</td>
                                            <td class="px-4 py-2.5 text-right font-bold text-primary font-sans">{{ number_format(($item['subtotal'] ?? (($item['price'] ?? 0) * ($item['quantity'] ?? 1))), 0, ',', '.') }}đ</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-bg-secondary/30 font-bold">
                                        <td colspan="3" class="px-4 py-3 text-right uppercase tracking-wider text-[11px] text-text-secondary">Tổng cộng:</td>
                                        <td class="px-4 py-3 text-right text-primary text-sm font-sans">{{ number_format($booking->estimated_total, 0, ',', '.') }}đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-6 text-center text-text-secondary">
                            <i class="fas fa-chair text-3xl text-border-custom mb-2 block"></i>
                            <p class="italic text-xs">Khách hàng chỉ đặt giữ chỗ bàn trước, chưa chọn trước món ăn hoặc combo (sẽ gọi món trực tiếp khi đến nhà hàng).</p>
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
