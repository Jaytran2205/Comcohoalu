<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MenuItem;
use App\Models\SetMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Hiển thị giao diện báo cáo thống kê chuyên nghiệp.
     */
    public function index(Request $request)
    {
        $range = $request->input('range', 'this_month');
        [$dateFrom, $dateTo] = $this->resolveDateRange($request, $range);

        $data = $this->collectAnalyticsData($dateFrom, $dateTo);

        return view('admin.reports.index', [
            'range' => $range,
            'dateFrom' => $dateFrom->format('Y-m-d'),
            'dateTo' => $dateTo->format('Y-m-d'),
            ...$data
        ]);
    }

    /**
     * Xuất file báo cáo Excel đa bảng (.xls) chuyên nghiệp và chuẩn định dạng.
     */
    public function exportExcel(Request $request): StreamedResponse
    {
        $range = $request->input('range', 'this_month');
        [$dateFrom, $dateTo] = $this->resolveDateRange($request, $range);

        $data = $this->collectAnalyticsData($dateFrom, $dateTo);

        $fileName = 'Bao_Cao_Thong_Ke_Hoa_Lu_' . $dateFrom->format('Ymd') . '_' . $dateTo->format('Ymd') . '.xls';

        return response()->streamDownload(function () use ($data, $dateFrom, $dateTo) {
            echo $this->generateSpreadsheetXml($data, $dateFrom, $dateTo);
        }, $fileName, [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Xử lý khoảng thời gian lọc.
     */
    private function resolveDateRange(Request $request, string $range): array
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        if ($range === 'today') {
            return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
        }

        if ($range === 'yesterday') {
            $yesterday = $now->copy()->subDay();
            return [$yesterday->copy()->startOfDay(), $yesterday->copy()->endOfDay()];
        }

        if ($range === 'this_week') {
            return [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()];
        }

        if ($range === 'last_week') {
            $lastWeek = $now->copy()->subWeek();
            return [$lastWeek->copy()->startOfWeek(), $lastWeek->copy()->endOfWeek()];
        }

        if ($range === 'last_month') {
            $lastMonth = $now->copy()->subMonth();
            return [$lastMonth->copy()->startOfMonth(), $lastMonth->copy()->endOfMonth()];
        }

        if ($range === 'this_year') {
            return [$now->copy()->startOfYear(), $now->copy()->endOfYear()];
        }

        if ($range === 'custom' && $request->filled('date_from') && $request->filled('date_to')) {
            return [
                Carbon::parse($request->date_from, 'Asia/Ho_Chi_Minh')->startOfDay(),
                Carbon::parse($request->date_to, 'Asia/Ho_Chi_Minh')->endOfDay(),
            ];
        }

        // Mặc định: Tháng này
        return [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()];
    }

    /**
     * Tổng hợp toàn bộ số liệu báo cáo doanh thu & món bán chạy.
     */
    private function collectAnalyticsData(Carbon $dateFrom, Carbon $dateTo): array
    {
        $bookings = Booking::with(['setMenu', 'confirmedBy'])
            ->whereBetween('booking_date', [$dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d')])
            ->orderByDesc('created_at')
            ->get();

        // 1. Tổng quan KPI
        $totalBookings = $bookings->count();
        $confirmedBookings = $bookings->whereIn('status.value', ['confirmed', 'completed'])->count();
        $pendingBookings = $bookings->where('status.value', 'pending')->count();
        $cancelledBookings = $bookings->whereIn('status.value', ['cancelled', 'rejected', 'no_show'])->count();

        $totalEstimatedRevenue = $bookings->whereNotIn('status.value', ['cancelled', 'rejected', 'no_show'])
            ->sum('estimated_total');

        $totalAdults = $bookings->sum('adults');
        $totalChildren = $bookings->sum('children');

        // 2. Thống kê Combo bán chạy
        $comboStats = [];
        $setMenus = SetMenu::all()->keyBy('id');

        foreach ($bookings as $b) {
            if ($b->set_menu_id && isset($setMenus[$b->set_menu_id])) {
                $setId = $b->set_menu_id;
                $set = $setMenus[$setId];
                if (!isset($comboStats[$setId])) {
                    $comboStats[$setId] = [
                        'id' => $setId,
                        'name' => $set->name,
                        'price' => $set->price,
                        'total_sets' => 0,
                        'total_revenue' => 0,
                        'orders_count' => 0,
                    ];
                }
                $qty = max(1, (int) $b->combo_quantity);
                $comboStats[$setId]['total_sets'] += $qty;
                $comboStats[$setId]['total_revenue'] += ($set->price * $qty);
                $comboStats[$setId]['orders_count'] += 1;
            }
        }
        usort($comboStats, fn($a, $b) => $b['total_revenue'] <=> $a['total_revenue']);

        // 3. Thống kê Món lẻ bán chạy
        $dishStats = [];
        foreach ($bookings as $b) {
            if (!empty($b->ordered_items) && is_array($b->ordered_items)) {
                foreach ($b->ordered_items as $item) {
                    $name = $item['name'] ?? 'Món ăn';
                    $qty = (int) ($item['quantity'] ?? 1);
                    $price = (int) ($item['price'] ?? 0);
                    $subtotal = (int) ($item['subtotal'] ?? ($price * $qty));

                    if (!isset($dishStats[$name])) {
                        $dishStats[$name] = [
                            'name' => $name,
                            'price' => $price,
                            'quantity' => 0,
                            'total_revenue' => 0,
                            'orders_count' => 0,
                        ];
                    }
                    $dishStats[$name]['quantity'] += $qty;
                    $dishStats[$name]['total_revenue'] += $subtotal;
                    $dishStats[$name]['orders_count'] += 1;
                }
            }
        }
        usort($dishStats, fn($a, $b) => $b['quantity'] <=> $a['quantity']);

        // 4. Doanh thu theo từng ngày
        $dailyStats = [];
        $period = new \DatePeriod(
            $dateFrom->copy()->startOfDay(),
            new \DateInterval('P1D'),
            $dateTo->copy()->endOfDay()
        );

        foreach ($period as $dt) {
            $key = $dt->format('Y-m-d');
            $dailyStats[$key] = [
                'date' => $key,
                'day_name' => $dt->format('d/m/Y'),
                'total_bookings' => 0,
                'revenue' => 0,
                'pax' => 0,
            ];
        }

        foreach ($bookings as $b) {
            $dateKey = Carbon::parse($b->booking_date)->format('Y-m-d');
            if (isset($dailyStats[$dateKey])) {
                $dailyStats[$dateKey]['total_bookings'] += 1;
                $dailyStats[$dateKey]['pax'] += ($b->adults + $b->children);
                if (!in_array($b->status->value, ['cancelled', 'rejected', 'no_show'])) {
                    $dailyStats[$dateKey]['revenue'] += (int) $b->estimated_total;
                }
            }
        }

        return [
            'totalBookings' => $totalBookings,
            'confirmedBookings' => $confirmedBookings,
            'pendingBookings' => $pendingBookings,
            'cancelledBookings' => $cancelledBookings,
            'totalEstimatedRevenue' => $totalEstimatedRevenue,
            'totalAdults' => $totalAdults,
            'totalChildren' => $totalChildren,
            'comboStats' => array_values($comboStats),
            'dishStats' => array_values($dishStats),
            'dailyStats' => array_values($dailyStats),
            'bookings' => $bookings,
        ];
    }

    /**
     * Xuất tệp tin XML Spreadsheet tương thích 100% Microsoft Excel, đẹp và có màu sắc.
     */
    private function generateSpreadsheetXml(array $data, Carbon $dateFrom, Carbon $dateTo): string
    {
        $exportTime = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
        $periodStr = $dateFrom->format('d/m/Y') . ' - ' . $dateTo->format('d/m/Y');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<?mso-application progid="Excel.Sheet"?>' . "\n";
        $xml .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"' . "\n";
        $xml .= ' xmlns:o="urn:schemas-microsoft-com:office:office"' . "\n";
        $xml .= ' xmlns:x="urn:schemas-microsoft-com:office:excel"' . "\n";
        $xml .= ' xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"' . "\n";
        $xml .= ' xmlns:html="http://www.w3.org/TR/REC-html40">' . "\n";

        // Styles
        $xml .= '<Styles>' . "\n";
        $xml .= ' <Style ss:ID="Default" ss:Name="Normal"><Alignment ss:Vertical="Center"/><Font ss:FontName="Calibri" ss:Size="11" ss:Color="#000000"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="Title"><Alignment ss:Horizontal="Center" ss:Vertical="Center"/><Font ss:FontName="Calibri" ss:Size="16" ss:Bold="1" ss:Color="#8B4513"/><Interior ss:Color="#FFF9F0" ss:Pattern="Solid"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="SubTitle"><Alignment ss:Horizontal="Center" ss:Vertical="Center"/><Font ss:FontName="Calibri" ss:Size="11" ss:Italic="1" ss:Color="#555555"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="Header"><Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#FFFFFF"/><Interior ss:Color="#8B4513" ss:Pattern="Solid"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="HeaderGold"><Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#2C1810"/><Interior ss:Color="#D4A855" ss:Pattern="Solid"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#000000"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="KpiLabel"><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#2C1810"/><Interior ss:Color="#F5F0E8" ss:Pattern="Solid"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="KpiValue"><Alignment ss:Horizontal="Right"/><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#8B4513"/><Interior ss:Color="#F5F0E8" ss:Pattern="Solid"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="KpiCurrency"><Alignment ss:Horizontal="Right"/><Font ss:FontName="Calibri" ss:Size="12" ss:Bold="1" ss:Color="#8B4513"/><Interior ss:Color="#F5F0E8" ss:Pattern="Solid"/><NumberFormat ss:Format="#,##0\ &quot;₫&quot;"/></Style>' . "\n";
        $xml .= ' <Style ss:ID="Cell"><Alignment ss:Vertical="Center"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="CellCenter"><Alignment ss:Horizontal="Center" ss:Vertical="Center"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="CellCurrency"><Alignment ss:Horizontal="Right" ss:Vertical="Center"/><NumberFormat ss:Format="#,##0\ &quot;₫&quot;"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="CellNumber"><Alignment ss:Horizontal="Right" ss:Vertical="Center"/><NumberFormat ss:Format="#,##0"/><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/><Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E0E0E0"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="TotalRow"><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#2C1810"/><Interior ss:Color="#F5E6C8" ss:Pattern="Solid"/><Borders><Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2" ss:Color="#8B4513"/><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2" ss:Color="#8B4513"/></Borders></Style>' . "\n";
        $xml .= ' <Style ss:ID="TotalCurrency"><Alignment ss:Horizontal="Right"/><Font ss:FontName="Calibri" ss:Size="11" ss:Bold="1" ss:Color="#8B4513"/><Interior ss:Color="#F5E6C8" ss:Pattern="Solid"/><NumberFormat ss:Format="#,##0\ &quot;₫&quot;"/><Borders><Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2" ss:Color="#8B4513"/><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2" ss:Color="#8B4513"/></Borders></Style>' . "\n";
        $xml .= '</Styles>' . "\n";

        // ══════════════ TAB 1: TỔNG QUAN & DOANH THU ══════════════
        $xml .= '<Worksheet ss:Name="Tổng Quan Doanh Thu">' . "\n";
        $xml .= '<Table ss:DefaultRowHeight="20">' . "\n";
        $xml .= '<Column ss:Width="160"/>' . "\n";
        $xml .= '<Column ss:Width="130"/>' . "\n";
        $xml .= '<Column ss:Width="130"/>' . "\n";
        $xml .= '<Column ss:Width="140"/>' . "\n";
        $xml .= '<Column ss:Width="160"/>' . "\n";

        // Title
        $xml .= '<Row ss:Height="30"><Cell ss:MergeAcross="4" ss:StyleID="Title"><Data ss:Type="String">BÁO CÁO DOANH THU &amp; HOẠT ĐỘNG KINH DOANH</Data></Cell></Row>' . "\n";
        $xml .= '<Row ss:Height="20"><Cell ss:MergeAcross="4" ss:StyleID="SubTitle"><Data ss:Type="String">Nhà hàng Cơm Cổ Hoa Lư • Kỳ báo cáo: ' . $periodStr . ' (Xuất lúc: ' . $exportTime . ')</Data></Cell></Row>' . "\n";
        $xml .= '<Row ss:Height="12"></Row>' . "\n";

        // KPI Summary Box
        $xml .= '<Row><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">CHỈ SỐ TỔNG QUAN</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">GIÁ TRỊ</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">CHỈ SỐ ĐƠN</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">SỐ LƯỢNG</Data></Cell><Cell></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Tổng Doanh Thu Ước Tính</Data></Cell><Cell ss:StyleID="KpiCurrency"><Data ss:Type="Number">' . $data['totalEstimatedRevenue'] . '</Data></Cell><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Tổng Đơn Đặt Bàn</Data></Cell><Cell ss:StyleID="KpiValue"><Data ss:Type="Number">' . $data['totalBookings'] . '</Data></Cell><Cell></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Tổng Khách Dùng Bữa</Data></Cell><Cell ss:StyleID="KpiValue"><Data ss:Type="Number">' . ($data['totalAdults'] + $data['totalChildren']) . '</Data></Cell><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Đơn Đã Xác Nhận / Hoàn Thành</Data></Cell><Cell ss:StyleID="KpiValue"><Data ss:Type="Number">' . $data['confirmedBookings'] . '</Data></Cell><Cell></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Người Lớn / Trẻ Em</Data></Cell><Cell ss:StyleID="KpiValue"><Data ss:Type="String">' . $data['totalAdults'] . ' NL / ' . $data['totalChildren'] . ' TE</Data></Cell><Cell ss:StyleID="KpiLabel"><Data ss:Type="String">Đơn Chờ Xử Lý / Đã Hủy</Data></Cell><Cell ss:StyleID="KpiValue"><Data ss:Type="String">' . $data['pendingBookings'] . ' Chờ / ' . $data['cancelledBookings'] . ' Hủy</Data></Cell><Cell></Cell></Row>' . "\n";
        $xml .= '<Row ss:Height="15"></Row>' . "\n";

        // Daily Breakdown Table
        $xml .= '<Row><Cell ss:MergeAcross="4" ss:StyleID="Header"><Data ss:Type="String">CHI TIẾT DOANH THU THEO NGÀY TRONG KỲ</Data></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="Header"><Data ss:Type="String">Ngày</Data></Cell><Cell ss:StyleID="Header"><Data ss:Type="String">Số Đơn Đặt</Data></Cell><Cell ss:StyleID="Header"><Data ss:Type="String">Tổng Số Khách</Data></Cell><Cell ss:StyleID="Header"><Data ss:Type="String">Doanh Thu Trong Ngày</Data></Cell><Cell ss:StyleID="Header"><Data ss:Type="String">Ghi Chú</Data></Cell></Row>' . "\n";

        foreach ($data['dailyStats'] as $d) {
            $xml .= '<Row>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $d['day_name'] . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellNumber"><Data ss:Type="Number">' . $d['total_bookings'] . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellNumber"><Data ss:Type="Number">' . $d['pax'] . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . $d['revenue'] . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="Cell"><Data ss:Type="String">' . ($d['revenue'] > 0 ? 'Có phát sinh doanh thu' : '-') . '</Data></Cell>';
            $xml .= '</Row>' . "\n";
        }

        $xml .= '<Row ss:StyleID="TotalRow">';
        $xml .= '<Cell ss:StyleID="TotalRow"><Data ss:Type="String">TỔNG CỘNG</Data></Cell>';
        $xml .= '<Cell ss:StyleID="TotalRow"><Data ss:Type="Number">' . $data['totalBookings'] . '</Data></Cell>';
        $xml .= '<Cell ss:StyleID="TotalRow"><Data ss:Type="Number">' . ($data['totalAdults'] + $data['totalChildren']) . '</Data></Cell>';
        $xml .= '<Cell ss:StyleID="TotalCurrency"><Data ss:Type="Number">' . $data['totalEstimatedRevenue'] . '</Data></Cell>';
        $xml .= '<Cell ss:StyleID="TotalRow"><Data ss:Type="String"></Data></Cell>';
        $xml .= '</Row>' . "\n";

        $xml .= '</Table>' . "\n";
        $xml .= '</Worksheet>' . "\n";

        // ══════════════ TAB 2: MÓN ĂN & COMBO BÁN CHẠY ══════════════
        $xml .= '<Worksheet ss:Name="Món &amp; Combo Bán Chạy">' . "\n";
        $xml .= '<Table ss:DefaultRowHeight="20">' . "\n";
        $xml .= '<Column ss:Width="50"/>' . "\n";
        $xml .= '<Column ss:Width="250"/>' . "\n";
        $xml .= '<Column ss:Width="120"/>' . "\n";
        $xml .= '<Column ss:Width="100"/>' . "\n";
        $xml .= '<Column ss:Width="140"/>' . "\n";

        // Combo Ranking
        $xml .= '<Row ss:Height="26"><Cell ss:MergeAcross="4" ss:StyleID="Header"><Data ss:Type="String">TOP COMBO MÂM CƠM ĐƯỢC ĐẶT NHIỀU NHẤT</Data></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Hạng</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Tên Set Mâm Cơm</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Đơn Giá / Mâm</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Số Mâm Đã Đặt</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Tổng Doanh Số</Data></Cell></Row>' . "\n";

        if (empty($data['comboStats'])) {
            $xml .= '<Row><Cell ss:MergeAcross="4" ss:StyleID="CellCenter"><Data ss:Type="String">Chưa có dữ liệu đặt combo trong kỳ này</Data></Cell></Row>' . "\n";
        } else {
            $rank = 1;
            foreach ($data['comboStats'] as $c) {
                $xml .= '<Row>';
                $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="Number">' . $rank++ . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="Cell"><Data ss:Type="String">' . htmlspecialchars($c['name']) . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . $c['price'] . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellNumber"><Data ss:Type="Number">' . $c['total_sets'] . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . $c['total_revenue'] . '</Data></Cell>';
                $xml .= '</Row>' . "\n";
            }
        }

        $xml .= '<Row ss:Height="20"></Row>' . "\n";

        // Dishes Ranking
        $xml .= '<Row ss:Height="26"><Cell ss:MergeAcross="4" ss:StyleID="Header"><Data ss:Type="String">TOP MÓN ĂN LẺ BÁN CHẠY NHẤT (ĐẶT TRƯỚC)</Data></Cell></Row>' . "\n";
        $xml .= '<Row><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Hạng</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Tên Món Ăn</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Đơn Giá</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Số Lượng Đặt</Data></Cell><Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Tổng Doanh Số</Data></Cell></Row>' . "\n";

        if (empty($data['dishStats'])) {
            $xml .= '<Row><Cell ss:MergeAcross="4" ss:StyleID="CellCenter"><Data ss:Type="String">Chưa có dữ liệu đặt món lẻ trước trong kỳ này</Data></Cell></Row>' . "\n";
        } else {
            $rank = 1;
            foreach ($data['dishStats'] as $d) {
                $xml .= '<Row>';
                $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="Number">' . $rank++ . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="Cell"><Data ss:Type="String">' . htmlspecialchars($d['name']) . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . $d['price'] . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellNumber"><Data ss:Type="Number">' . $d['quantity'] . '</Data></Cell>';
                $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . $d['total_revenue'] . '</Data></Cell>';
                $xml .= '</Row>' . "\n";
            }
        }

        $xml .= '</Table>' . "\n";
        $xml .= '</Worksheet>' . "\n";

        // ══════════════ TAB 3: DANH SÁCH ĐƠN ĐẶT BÀN ══════════════
        $xml .= '<Worksheet ss:Name="Danh Sách Đơn Đặt Bàn">' . "\n";
        $xml .= '<Table ss:DefaultRowHeight="20">' . "\n";
        $xml .= '<Column ss:Width="110"/>' . "\n";
        $xml .= '<Column ss:Width="140"/>' . "\n";
        $xml .= '<Column ss:Width="95"/>' . "\n";
        $xml .= '<Column ss:Width="85"/>' . "\n";
        $xml .= '<Column ss:Width="65"/>' . "\n";
        $xml .= '<Column ss:Width="65"/>' . "\n";
        $xml .= '<Column ss:Width="200"/>' . "\n";
        $xml .= '<Column ss:Width="110"/>' . "\n";
        $xml .= '<Column ss:Width="100"/>' . "\n";
        $xml .= '<Column ss:Width="125"/>' . "\n";

        $xml .= '<Row ss:Height="26"><Cell ss:MergeAcross="9" ss:StyleID="Header"><Data ss:Type="String">DANH SÁCH TẤT CẢ ĐƠN ĐẶT BÀN TRONG KỲ (' . count($data['bookings']) . ' ĐƠN)</Data></Cell></Row>' . "\n";
        $xml .= '<Row>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Mã Đơn</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Khách Hàng</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Số Điện Thoại</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Ngày Dùng</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Giờ Đến</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Số Khách</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Thực Đơn Đã Đặt</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Tổng Tiền</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Trạng Thái</Data></Cell>';
        $xml .= '<Cell ss:StyleID="HeaderGold"><Data ss:Type="String">Thời Điểm Đặt</Data></Cell>';
        $xml .= '</Row>' . "\n";

        foreach ($data['bookings'] as $b) {
            $orderDetail = 'Chỉ đặt bàn';
            if ($b->set_menu_id && $b->setMenu) {
                $orderDetail = $b->setMenu->name . ' (' . ($b->combo_quantity ?? 1) . ' mâm)';
            } elseif (!empty($b->ordered_items) && is_array($b->ordered_items)) {
                $itemNames = array_map(fn($it) => ($it['name'] ?? '') . ' x' . ($it['quantity'] ?? 1), $b->ordered_items);
                $orderDetail = implode(', ', $itemNames);
            }

            $xml .= '<Row>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $b->booking_code . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="Cell"><Data ss:Type="String">' . htmlspecialchars($b->customer_name) . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $b->customer_phone . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . Carbon::parse($b->booking_date)->format('d/m/Y') . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . substr($b->booking_time, 0, 5) . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $b->adults . 'L' . ($b->children ? ' +' . $b->children . 'T' : '') . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="Cell"><Data ss:Type="String">' . htmlspecialchars($orderDetail) . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCurrency"><Data ss:Type="Number">' . ($b->estimated_total ?? 0) . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $b->status->label() . '</Data></Cell>';
            $xml .= '<Cell ss:StyleID="CellCenter"><Data ss:Type="String">' . $b->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') . '</Data></Cell>';
            $xml .= '</Row>' . "\n";
        }

        $xml .= '</Table>' . "\n";
        $xml .= '</Worksheet>' . "\n";

        $xml .= '</Workbook>';

        return $xml;
    }
}
