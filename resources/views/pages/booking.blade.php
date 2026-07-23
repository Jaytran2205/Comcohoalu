@extends('layouts.app')

@section('title', 'Đặt Bàn Trực Tuyến - Cơm Cổ Hoa Lư')
@section('meta_description', 'Đặt bàn trực tuyến nhanh chóng tại nhà hàng Cơm Cổ Hoa Lư. Tiết kiệm thời gian, nhận bàn dùng bữa ấm cúng cùng gia đình và thưởng thức đặc sản Ninh Bình.')

@section('content')
<!-- Breadcrumb -->
@include('partials.breadcrumb', [
    'title' => 'Đặt Bàn Dùng Bữa',
    'items' => [
        ['label' => 'Đặt bàn', 'url' => null]
    ]
])

<section class="py-16 bg-bg-primary relative overflow-hidden">
    <!-- Decorative Pattern -->
    <div class="absolute inset-0 viet-pattern-bg opacity-5"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left: Booking Form (2 cols wide on large screens) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-border-custom/40 p-6 sm:p-10">
                <h2 class="text-xl font-bold font-serif text-primary border-b border-border-custom/20 pb-4 mb-6">
                    <i class="fas fa-calendar-check text-secondary mr-2"></i>Thông tin đặt bàn
                </h2>

                <form id="booking-form" method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name & Phone Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="customer_name" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Họ tên khách hàng <span class="text-error">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="customer_name" 
                                id="customer_name" 
                                value="{{ old('customer_name') }}" 
                                required
                                placeholder="Ví dụ: Nguyễn Văn A"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('customer_name')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Số điện thoại di động <span class="text-error">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="customer_phone" 
                                id="customer_phone" 
                                value="{{ old('customer_phone') }}" 
                                required
                                placeholder="Ví dụ: 0912345678"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('customer_phone')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email & Date Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="customer_email" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Địa chỉ Email <span class="text-text-secondary/60">(Không bắt buộc)</span>
                            </label>
                            <input 
                                type="email" 
                                name="customer_email" 
                                id="customer_email" 
                                value="{{ old('customer_email') }}"
                                placeholder="khachhang@email.com"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('customer_email')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="booking_date" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Ngày dùng bữa <span class="text-error">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="booking_date" 
                                id="booking_date" 
                                value="{{ old('booking_date', request('booking_date')) }}" 
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('booking_date')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Time & Pax Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label for="booking_time" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Giờ đến dùng bữa <span class="text-error">*</span>
                            </label>
                            <select 
                                name="booking_time" 
                                id="booking_time" 
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                                <option value="">-- Chọn giờ đến --</option>
                                <optgroup label="Khung Giờ Trưa">
                                    <option value="10:00" {{ old('booking_time', request('booking_time')) == '10:00' ? 'selected' : '' }}>10:00</option>
                                    <option value="10:30" {{ old('booking_time', request('booking_time')) == '10:30' ? 'selected' : '' }}>10:30</option>
                                    <option value="11:00" {{ old('booking_time', request('booking_time')) == '11:00' ? 'selected' : '' }}>11:00</option>
                                    <option value="11:30" {{ old('booking_time', request('booking_time')) == '11:30' ? 'selected' : '' }}>11:30</option>
                                    <option value="12:00" {{ old('booking_time', request('booking_time')) == '12:00' ? 'selected' : '' }}>12:00</option>
                                    <option value="12:30" {{ old('booking_time', request('booking_time')) == '12:30' ? 'selected' : '' }}>12:30</option>
                                    <option value="13:00" {{ old('booking_time', request('booking_time')) == '13:00' ? 'selected' : '' }}>13:00</option>
                                    <option value="13:30" {{ old('booking_time', request('booking_time')) == '13:30' ? 'selected' : '' }}>13:30</option>
                                </optgroup>
                                <optgroup label="Khung Giờ Tối">
                                    <option value="17:00" {{ old('booking_time', request('booking_time')) == '17:00' ? 'selected' : '' }}>17:00</option>
                                    <option value="17:30" {{ old('booking_time', request('booking_time')) == '17:30' ? 'selected' : '' }}>17:30</option>
                                    <option value="18:00" {{ old('booking_time', request('booking_time')) == '18:00' ? 'selected' : '' }}>18:00</option>
                                    <option value="18:30" {{ old('booking_time', request('booking_time')) == '18:30' ? 'selected' : '' }}>18:30</option>
                                    <option value="19:00" {{ old('booking_time', request('booking_time')) == '19:00' ? 'selected' : '' }}>19:00</option>
                                    <option value="19:30" {{ old('booking_time', request('booking_time')) == '19:30' ? 'selected' : '' }}>19:30</option>
                                    <option value="20:00" {{ old('booking_time', request('booking_time')) == '20:00' ? 'selected' : '' }}>20:00</option>
                                    <option value="20:30" {{ old('booking_time', request('booking_time')) == '20:30' ? 'selected' : '' }}>20:30</option>
                                    <option value="21:00" {{ old('booking_time', request('booking_time')) == '21:00' ? 'selected' : '' }}>21:00</option>
                                </optgroup>
                            </select>
                            @error('booking_time')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="adults" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Người lớn <span class="text-error">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="adults" 
                                id="adults" 
                                min="1" 
                                max="100" 
                                value="{{ old('adults', request('adults', 2)) }}" 
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('adults')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="children" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                                Trẻ em <span class="text-text-secondary/60">(Dưới 10 tuổi)</span>
                            </label>
                            <input 
                                type="number" 
                                name="children" 
                                id="children" 
                                min="0" 
                                max="50" 
                                value="{{ old('children', 0) }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                            >
                            @error('children')
                                <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="special_requests" class="block text-xs font-bold text-text-primary uppercase tracking-wider mb-2">
                            Yêu cầu đặc biệt khác <span class="text-text-secondary/60">(Không bắt buộc)</span>
                        </label>
                        <textarea 
                            name="special_requests" 
                            id="special_requests" 
                            rows="4" 
                            placeholder="Ví dụ: Ghế ăn cho trẻ nhỏ, phòng VIP, trang trí bàn kỷ niệm ngày cưới, các món ăn muốn chuẩn bị trước..."
                            class="w-full px-4 py-3 rounded-lg border border-border-custom bg-bg-primary/20 text-text-primary focus:outline-none focus:ring-2 focus:ring-primary/25 focus:border-primary transition-all text-xs"
                        >{{ old('special_requests') }}</textarea>
                        @error('special_requests')
                            <span class="text-error text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02] text-xs uppercase tracking-wider"
                        >
                            <i class="fas fa-paper-plane mr-2"></i> Xác nhận gửi đặt bàn
                        </button>
                    </div>

                </form>
            </div>

            <!-- Right: Information & Policy Sidebar -->
            <div class="space-y-8">
                <!-- Session Hours -->
                <div class="bg-white rounded-xl shadow-sm border border-border-custom/40 p-6 space-y-4">
                    <h3 class="font-serif font-bold text-lg text-primary border-b border-border-custom/20 pb-2 flex items-center">
                        <i class="far fa-clock text-secondary mr-2"></i>Giờ mở cửa
                    </h3>
                    <div class="space-y-3 text-xs leading-relaxed text-text-secondary">
                        <div class="flex justify-between">
                            <span class="font-semibold text-text-primary">Khung Giờ Trưa:</span>
                            <span>10:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-text-primary">Khung Giờ Tối:</span>
                            <span>17:00 - 22:00</span>
                        </div>
                        <p class="text-[10px] text-text-secondary/70 italic pt-1 border-t border-border-custom/10">
                            * Vui lòng đặt bàn trước tối thiểu 30 phút để nhà hàng sắp xếp phục vụ chu đáo nhất.
                        </p>
                    </div>
                </div>

                <!-- Contact & Hotline -->
                <div class="bg-white rounded-xl shadow-sm border border-border-custom/40 p-6 space-y-4">
                    <h3 class="font-serif font-bold text-lg text-primary border-b border-border-custom/20 pb-2 flex items-center">
                        <i class="fas fa-phone-alt text-secondary mr-2"></i>Đặt bàn trực tiếp
                    </h3>
                    <div class="space-y-3 text-xs text-text-secondary leading-relaxed">
                        <p>Nếu quý khách muốn đặt tiệc cưới hỏi, hội nghị lớn hoặc đặt bàn nhóm trên 20 người, vui lòng liên hệ trực tiếp qua Hotline:</p>
                        <p class="text-xl font-bold text-primary font-sans tracking-wide flex items-center justify-center py-2 bg-bg-secondary rounded-lg">
                            <i class="fas fa-phone-square-alt text-secondary mr-2"></i>{{ $siteSettings['site_hotline'] ?? '0866.000.000' }}
                        </p>
                        <p>Địa chỉ duy nhất: <br><span class="font-semibold text-text-primary">{{ $siteSettings['site_address'] ?? 'TP Hoa Lư, Ninh Bình' }}</span></p>
                    </div>
                </div>

                <!-- Policies -->
                <div class="bg-white rounded-xl shadow-sm border border-border-custom/40 p-6 space-y-4">
                    <h3 class="font-serif font-bold text-lg text-primary border-b border-border-custom/20 pb-2 flex items-center">
                        <i class="fas fa-info-circle text-secondary mr-2"></i>Quy định giữ bàn
                    </h3>
                    <ul class="space-y-2.5 text-xs text-text-secondary list-disc list-inside leading-relaxed">
                        <li>Bàn đặt trước sẽ được giữ tối đa <span class="font-semibold text-text-primary">15 phút</span> so với giờ hẹn.</li>
                        <li>Trường hợp quý khách đến muộn hơn, vui lòng gọi hotline thông báo để nhà hàng gia hạn thời gian.</li>
                        <li>Mọi thông tin điều chỉnh số lượng khách vui lòng thực hiện trước <span class="font-semibold text-text-primary">1 tiếng</span>.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
