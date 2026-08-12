@extends('admin.layouts.admin')

@section('page_title', 'Báo cáo & Thống kê kinh doanh')

@section('admin_actions')
    <a 
        href="{{ route('admin.reports.export', ['range' => $range, 'date_from' => $dateFrom, 'date_to' => $dateTo]) }}" 
        class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-lg shadow-sm hover:shadow transition-all text-xs uppercase tracking-wider"
    >
        <i class="fas fa-file-excel mr-2 text-sm"></i> Xuất Báo Cáo Excel
    </a>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-4">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap items-center justify-between gap-4">
            <!-- Fast Range Buttons -->
            <div class="flex flex-wrap items-center gap-1.5 text-xs">
                <span class="text-text-secondary font-bold mr-1 uppercase text-[10px]">Kỳ báo cáo:</span>
                @php
                    $ranges = [
                        'today' => 'Hôm nay',
                        'this_week' => 'Tuần này',
                        'this_month' => 'Tháng này',
                        'last_month' => 'Tháng trước',
                        'this_year' => 'Năm nay',
                        'custom' => 'Tùy chọn',
                    ];
                @endphp
                @foreach($ranges as $key => $label)
                    <button 
                        type="submit" 
                        name="range" 
                        value="{{ $key }}"
                        class="px-3 py-1.5 rounded-lg border font-semibold transition-all {{ $range === $key ? 'bg-primary text-white border-primary shadow-xs' : 'bg-bg-primary/30 border-border-custom/40 text-text-secondary hover:border-primary/50' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- Custom Date Range Picker -->
            <div class="flex items-center space-x-2 text-xs">
                <input 
                    type="date" 
                    name="date_from" 
                    value="{{ $dateFrom }}" 
                    class="px-3 py-1.5 rounded-lg border border-border-custom/60 bg-white text-text-primary text-xs focus:ring-1 focus:ring-primary"
                >
                <span class="text-text-secondary">đến</span>
                <input 
                    type="date" 
                    name="date_to" 
                    value="{{ $dateTo }}" 
                    class="px-3 py-1.5 rounded-lg border border-border-custom/60 bg-white text-text-primary text-xs focus:ring-1 focus:ring-primary"
                >
                <button 
                    type="submit" 
                    name="range" 
                    value="custom" 
                    class="px-3 py-1.5 bg-primary text-white rounded-lg font-bold text-xs hover:bg-primary-dark transition-all"
                >
                    <i class="fas fa-filter mr-1"></i> Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- KPI Summary Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. Total Estimated Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-text-secondary block mb-1">Tổng Doanh Thu Ước Tính</span>
                <h3 class="text-xl font-bold font-serif text-primary">{{ number_format($totalEstimatedRevenue, 0, ',', '.') }}đ</h3>
                <span class="text-[11px] text-emerald-600 mt-1 block font-medium">
                    <i class="fas fa-chart-line mr-1"></i>Từ đơn hợp lệ
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-coins"></i>
            </div>
        </div>

        <!-- 2. Total Bookings -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-text-secondary block mb-1">Tổng Số Đơn Đặt Bàn</span>
                <h3 class="text-xl font-bold font-serif text-text-primary">{{ $totalBookings }} <span class="text-xs font-normal text-text-secondary">đơn</span></h3>
                <span class="text-[11px] text-text-secondary mt-1 block">
                    {{ $confirmedBookings }} xác nhận • {{ $pendingBookings }} chờ
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-secondary/15 text-secondary-dark flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>

        <!-- 3. Total Diners (Pax) -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-text-secondary block mb-1">Tổng Khách Dùng Bữa</span>
                <h3 class="text-xl font-bold font-serif text-text-primary">{{ $totalAdults + $totalChildren }} <span class="text-xs font-normal text-text-secondary">khách</span></h3>
                <span class="text-[11px] text-text-secondary mt-1 block">
                    {{ $totalAdults }} người lớn, {{ $totalChildren }} trẻ em
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-info/10 text-info flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- 4. Conversion Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 p-5 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-text-secondary block mb-1">Tỷ Lệ Xác Nhận Thành Công</span>
                @php
                    $rate = $totalBookings > 0 ? round(($confirmedBookings / $totalBookings) * 100, 1) : 0;
                @endphp
                <h3 class="text-xl font-bold font-serif text-text-primary">{{ $rate }}%</h3>
                <span class="text-[11px] text-text-secondary mt-1 block">
                    {{ $cancelledBookings }} đơn bị hủy
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-success/10 text-success flex items-center justify-center text-xl flex-shrink-0">
                <i class="fas fa-award"></i>
            </div>
        </div>
    </div>

    <!-- Two-column Top Rankings Grid: Top Combos & Top Dishes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- 1. Top Selling Combos -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
            <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20 flex justify-between items-center">
                <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                    <i class="fas fa-layer-group text-secondary mr-2"></i> TOP COMBO MÂM CƠM BÁN CHẠY
                </h3>
                <span class="text-[10px] uppercase font-bold text-text-secondary">Theo doanh thu</span>
            </div>

            <div class="p-6">
                @if(empty($comboStats))
                    <div class="py-8 text-center text-text-secondary/70 italic text-xs">
                        <i class="fas fa-box-open text-2xl mb-2 block"></i>
                        Chưa có đơn đặt combo nào trong khoảng thời gian này.
                    </div>
                @else
                    <div class="space-y-4">
                        @php
                            $maxComboRevenue = max(array_column($comboStats, 'total_revenue')) ?: 1;
                        @endphp
                        @foreach($comboStats as $idx => $c)
                            <div class="p-3.5 rounded-xl border border-border-custom/20 bg-bg-primary/10 space-y-2">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold {{ $idx === 0 ? 'bg-amber-400 text-bg-dark font-sans' : ($idx === 1 ? 'bg-gray-300 text-bg-dark font-sans' : 'bg-amber-700 text-white font-sans') }}">
                                            #{{ $idx + 1 }}
                                        </span>
                                        <span class="font-bold text-primary font-serif">{{ $c['name'] }}</span>
                                    </div>
                                    <span class="font-bold text-primary-light font-sans">{{ number_format($c['total_revenue'], 0, ',', '.') }}đ</span>
                                </div>

                                <div class="w-full bg-border-custom/30 rounded-full h-2 overflow-hidden">
                                    <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ round(($c['total_revenue'] / $maxComboRevenue) * 100) }}%"></div>
                                </div>

                                <div class="flex justify-between text-[11px] text-text-secondary">
                                    <span>Đơn giá: {{ number_format($c['price'], 0, ',', '.') }}đ / mâm</span>
                                    <span class="font-semibold text-text-primary">Đã bán: {{ $c['total_sets'] }} mâm ({{ $c['orders_count'] }} đơn)</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- 2. Top Selling Dishes -->
        <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
            <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20 flex justify-between items-center">
                <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                    <i class="fas fa-utensils text-secondary mr-2"></i> TOP MÓN ĂN LẺ ĐƯỢC CHỌN NHIỀU
                </h3>
                <span class="text-[10px] uppercase font-bold text-text-secondary">Theo số lượng gọi</span>
            </div>

            <div class="p-6">
                @if(empty($dishStats))
                    <div class="py-8 text-center text-text-secondary/70 italic text-xs">
                        <i class="fas fa-utensils text-2xl mb-2 block"></i>
                        Chưa có đơn đặt món lẻ trước trong khoảng thời gian này.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-border-custom/20 text-xs text-left">
                            <thead class="bg-bg-secondary/30 text-[10px] font-bold text-text-secondary uppercase">
                                <tr>
                                    <th class="py-2.5 px-3">Top</th>
                                    <th class="py-2.5 px-3">Tên món</th>
                                    <th class="py-2.5 px-3 text-right">Đơn giá</th>
                                    <th class="py-2.5 px-3 text-center">Số lượng</th>
                                    <th class="py-2.5 px-3 text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-custom/10">
                                @foreach(array_slice($dishStats, 0, 8) as $idx => $d)
                                    <tr class="hover:bg-bg-secondary/20">
                                        <td class="py-2.5 px-3 font-bold {{ $idx < 3 ? 'text-secondary-dark' : 'text-text-secondary' }}">#{{ $idx + 1 }}</td>
                                        <td class="py-2.5 px-3 font-semibold text-text-primary">{{ $d['name'] }}</td>
                                        <td class="py-2.5 px-3 text-right text-text-secondary font-sans">{{ number_format($d['price'], 0, ',', '.') }}đ</td>
                                        <td class="py-2.5 px-3 text-center font-bold text-primary">{{ $d['quantity'] }}</td>
                                        <td class="py-2.5 px-3 text-right font-bold text-primary-light font-sans">{{ number_format($d['total_revenue'], 0, ',', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Daily Breakdown Table -->
    <div class="bg-white rounded-xl shadow-sm border border-border-custom/30 overflow-hidden">
        <div class="px-6 py-4 bg-bg-secondary/40 border-b border-border-custom/20 flex justify-between items-center">
            <h3 class="font-serif font-bold text-sm text-primary flex items-center">
                <i class="fas fa-calendar-alt text-secondary mr-2"></i> BẢNG DOANH THU &amp; LƯỢT KHÁCH THEO NGÀY
            </h3>
            <span class="text-xs text-text-secondary">Kỳ: {{ Carbon\Carbon::parse($dateFrom)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($dateTo)->format('d/m/Y') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border-custom/20 text-xs text-left">
                <thead class="bg-bg-secondary/20 text-[10px] font-bold text-text-secondary uppercase">
                    <tr>
                        <th class="py-3 px-6">Ngày</th>
                        <th class="py-3 px-6 text-center">Số đơn đặt</th>
                        <th class="py-3 px-6 text-center">Lượt khách</th>
                        <th class="py-3 px-6 text-right">Doanh thu tạm tính</th>
                        <th class="py-3 px-6 text-right">Trạng thái phát sinh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-custom/10">
                    @foreach($dailyStats as $row)
                        <tr class="hover:bg-bg-secondary/15 {{ $row['revenue'] > 0 ? 'bg-primary/2' : '' }}">
                            <td class="py-3 px-6 font-semibold text-text-primary">{{ $row['day_name'] }}</td>
                            <td class="py-3 px-6 text-center font-bold text-text-primary">{{ $row['total_bookings'] }}</td>
                            <td class="py-3 px-6 text-center text-text-secondary">{{ $row['pax'] }} khách</td>
                            <td class="py-3 px-6 text-right font-bold text-primary font-sans">{{ number_format($row['revenue'], 0, ',', '.') }}đ</td>
                            <td class="py-3 px-6 text-right">
                                @if($row['revenue'] > 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-success/10 text-success">
                                        <i class="fas fa-check-circle mr-1"></i>Có doanh thu
                                    </span>
                                @else
                                    <span class="text-[10px] text-text-secondary/50">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-bg-secondary/50 font-bold border-t-2 border-primary/20">
                        <td class="py-3.5 px-6 uppercase text-primary">TỔNG CỘNG</td>
                        <td class="py-3.5 px-6 text-center text-primary font-bold">{{ $totalBookings }} đơn</td>
                        <td class="py-3.5 px-6 text-center text-primary font-bold">{{ $totalAdults + $totalChildren }} khách</td>
                        <td class="py-3.5 px-6 text-right text-primary text-sm font-sans">{{ number_format($totalEstimatedRevenue, 0, ',', '.') }}đ</td>
                        <td class="py-3.5 px-6 text-right text-xs text-text-secondary">Hoàn tất kỳ báo cáo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
