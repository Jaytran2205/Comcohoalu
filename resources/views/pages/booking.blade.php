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

                    <!-- Pre-order Selection Section -->
                    <div class="border-t border-b border-border-custom/20 py-6 my-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-bold font-serif text-primary flex items-center">
                                    <i class="fas fa-utensils text-secondary mr-2"></i>Chọn thực đơn trước (Tùy chọn)
                                </h3>
                                <p class="text-[11px] text-text-secondary mt-0.5">Đặt trước mâm cơm hoặc món lẻ để nhà hàng chuẩn bị sẵn sàng khi quý khách đến nơi.</p>
                            </div>
                        </div>

                        <!-- Order Type Selector -->
                        @php
                            $defaultOrderType = request('set_menu') ? 'combo' : (request('dish') ? 'custom_dishes' : 'table_only');
                            $preSelectedSetMenu = request('set_menu', old('set_menu_id'));
                        @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="order-type-btn relative flex items-center p-3 rounded-xl border cursor-pointer transition-all {{ $defaultOrderType === 'combo' ? 'border-primary bg-primary/5 text-primary font-bold shadow-xs' : 'border-border-custom/50 bg-white text-text-secondary hover:border-primary/50' }}">
                                <input type="radio" name="order_type" value="combo" class="hidden" {{ $defaultOrderType === 'combo' ? 'checked' : '' }} onchange="toggleOrderType('combo')">
                                <i class="fas fa-layer-group text-secondary text-base mr-2.5"></i>
                                <div>
                                    <span class="text-xs block leading-tight">Đặt theo Combo</span>
                                    <span class="text-[10px] text-text-secondary font-normal">Mâm cơm trọn vị</span>
                                </div>
                            </label>

                            <label class="order-type-btn relative flex items-center p-3 rounded-xl border cursor-pointer transition-all {{ $defaultOrderType === 'custom_dishes' ? 'border-primary bg-primary/5 text-primary font-bold shadow-xs' : 'border-border-custom/50 bg-white text-text-secondary hover:border-primary/50' }}">
                                <input type="radio" name="order_type" value="custom_dishes" class="hidden" {{ $defaultOrderType === 'custom_dishes' ? 'checked' : '' }} onchange="toggleOrderType('custom_dishes')">
                                <i class="fas fa-list-ul text-secondary text-base mr-2.5"></i>
                                <div>
                                    <span class="text-xs block leading-tight">Đặt món lẻ</span>
                                    <span class="text-[10px] text-text-secondary font-normal">Tự chọn từng món</span>
                                </div>
                            </label>

                            <label class="order-type-btn relative flex items-center p-3 rounded-xl border cursor-pointer transition-all {{ $defaultOrderType === 'table_only' ? 'border-primary bg-primary/5 text-primary font-bold shadow-xs' : 'border-border-custom/50 bg-white text-text-secondary hover:border-primary/50' }}">
                                <input type="radio" name="order_type" value="table_only" class="hidden" {{ $defaultOrderType === 'table_only' ? 'checked' : '' }} onchange="toggleOrderType('table_only')">
                                <i class="fas fa-chair text-secondary text-base mr-2.5"></i>
                                <div>
                                    <span class="text-xs block leading-tight">Chỉ đặt chỗ bàn</span>
                                    <span class="text-[10px] text-text-secondary font-normal">Gọi món khi đến</span>
                                </div>
                            </label>
                        </div>

                        <!-- 1. Combo Selection Panel -->
                        <div id="combo-panel" class="{{ $defaultOrderType === 'combo' ? '' : 'hidden' }} space-y-4 pt-2">
                            <label class="block text-xs font-bold text-text-primary uppercase tracking-wider">
                                Chọn Combo Mâm Cơm:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach($setMenus as $set)
                                    @php
                                        $isSelected = ($preSelectedSetMenu == $set->id) || (!$preSelectedSetMenu && $loop->first);
                                    @endphp
                                    <label class="combo-card relative flex flex-col justify-between p-3.5 rounded-xl border cursor-pointer transition-all {{ $isSelected ? 'border-primary bg-primary/5 ring-2 ring-primary/20' : 'border-border-custom/40 bg-white hover:border-primary/40' }}">
                                        <input type="radio" name="set_menu_id" value="{{ $set->id }}" class="hidden" {{ $isSelected ? 'checked' : '' }} onchange="selectCombo('{{ $set->id }}', {{ $set->price }})">
                                        <div>
                                            @if($set->image)
                                                <img 
                                                    src="{{ str_starts_with($set->image, 'http') ? $set->image : (str_starts_with($set->image, 'images/') ? asset($set->image) : asset('storage/' . $set->image)) }}" 
                                                    alt="{{ $set->name }}" 
                                                    class="w-full h-28 object-cover rounded-lg mb-2.5 border"
                                                >
                                            @endif
                                            <h4 class="font-serif font-bold text-xs text-primary leading-snug">{{ $set->name }}</h4>
                                            <span class="text-[10px] text-text-secondary block mt-0.5">Khẩu phần {{ $set->people_count }} người</span>
                                        </div>
                                        <div class="mt-3 pt-2 border-t border-border-custom/20 flex justify-between items-center">
                                            <span class="text-xs font-bold text-primary-light font-sans">{{ number_format($set->price, 0, ',', '.') }}đ</span>
                                            <span class="combo-check-icon text-xs text-primary {{ $isSelected ? '' : 'hidden' }}"><i class="fas fa-check-circle"></i></span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="flex items-center space-x-3 pt-2">
                                <label for="combo_quantity" class="text-xs font-semibold text-text-primary">Số lượng mâm cơm:</label>
                                <input 
                                    type="number" 
                                    name="combo_quantity" 
                                    id="combo_quantity" 
                                    min="1" 
                                    max="20" 
                                    value="{{ old('combo_quantity', 1) }}" 
                                    class="w-20 px-3 py-1.5 rounded-lg border border-border-custom bg-white text-text-primary text-center font-bold text-xs focus:ring-2 focus:ring-primary/20"
                                    onchange="updateEstimatedTotal()"
                                >
                            </div>
                        </div>

                        <!-- 2. Individual Dishes Selection Panel -->
                        <div id="dishes-panel" class="{{ $defaultOrderType === 'custom_dishes' ? '' : 'hidden' }} space-y-4 pt-2">
                            <label class="block text-xs font-bold text-text-primary uppercase tracking-wider">
                                Chọn Món Ăn Lẻ Trước:
                            </label>
                            <div class="max-h-72 overflow-y-auto pr-1 space-y-4 divide-y divide-border-custom/10 border border-border-custom/30 rounded-xl p-3 bg-bg-secondary/20">
                                @foreach($categories as $category)
                                    @if($category->items->isNotEmpty())
                                        <div class="pt-3 first:pt-0">
                                            <span class="text-[11px] font-bold text-primary uppercase tracking-wider block mb-2">{{ $category->name }}</span>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                @foreach($category->items as $dish)
                                                    <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-border-custom/20 shadow-2xs">
                                                        <div class="truncate mr-2">
                                                            <span class="text-xs font-medium text-text-primary block truncate">{{ $dish->name }}</span>
                                                            <span class="text-[10px] text-text-secondary font-sans">{{ number_format($dish->price, 0, ',', '.') }}đ</span>
                                                        </div>
                                                        <div class="flex items-center space-x-1.5 flex-shrink-0">
                                                            <button type="button" class="w-6 h-6 rounded bg-bg-secondary hover:bg-border-custom text-text-primary flex items-center justify-center text-xs" onclick="adjustDishQty({{ $dish->id }}, -1, {{ $dish->price }})">-</button>
                                                            <input 
                                                                type="number" 
                                                                name="dishes[{{ $dish->id }}]" 
                                                                id="dish-qty-{{ $dish->id }}" 
                                                                value="{{ request('dish') == $dish->id ? 1 : 0 }}" 
                                                                min="0" 
                                                                max="50" 
                                                                class="w-10 text-center text-xs font-bold bg-transparent border-0 p-0 focus:ring-0"
                                                                readonly
                                                            >
                                                            <button type="button" class="w-6 h-6 rounded bg-primary hover:bg-primary-dark text-white flex items-center justify-center text-xs" onclick="adjustDishQty({{ $dish->id }}, 1, {{ $dish->price }})">+</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
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

@push('scripts')
<script>
    function toggleOrderType(type) {
        document.querySelectorAll('.order-type-btn').forEach(btn => {
            const radio = btn.querySelector('input[type="radio"]');
            if (radio && radio.value === type) {
                btn.classList.add('border-primary', 'bg-primary/5', 'text-primary', 'font-bold', 'shadow-xs');
                btn.classList.remove('border-border-custom/50', 'bg-white', 'text-text-secondary');
            } else {
                btn.classList.remove('border-primary', 'bg-primary/5', 'text-primary', 'font-bold', 'shadow-xs');
                btn.classList.add('border-border-custom/50', 'bg-white', 'text-text-secondary');
            }
        });

        const comboPanel = document.getElementById('combo-panel');
        const dishesPanel = document.getElementById('dishes-panel');

        if (type === 'combo') {
            if (comboPanel) comboPanel.classList.remove('hidden');
            if (dishesPanel) dishesPanel.classList.add('hidden');
        } else if (type === 'custom_dishes') {
            if (comboPanel) comboPanel.classList.add('hidden');
            if (dishesPanel) dishesPanel.classList.remove('hidden');
        } else {
            if (comboPanel) comboPanel.classList.add('hidden');
            if (dishesPanel) dishesPanel.classList.add('hidden');
        }
    }

    function selectCombo(id, price) {
        document.querySelectorAll('.combo-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            const checkIcon = card.querySelector('.combo-check-icon');
            if (radio && radio.value == id) {
                card.classList.add('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary/20');
                card.classList.remove('border-border-custom/40', 'bg-white');
                if (checkIcon) checkIcon.classList.remove('hidden');
            } else {
                card.classList.remove('border-primary', 'bg-primary/5', 'ring-2', 'ring-primary/20');
                card.classList.add('border-border-custom/40', 'bg-white');
                if (checkIcon) checkIcon.classList.add('hidden');
            }
        });
    }

    function adjustDishQty(dishId, delta, price) {
        const input = document.getElementById('dish-qty-' + dishId);
        if (!input) return;
        let current = parseInt(input.value) || 0;
        current = Math.max(0, current + delta);
        input.value = current;
    }
</script>
@endpush
@endsection
