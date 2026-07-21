<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông Báo Đặt Bàn Mới - Cơm Cổ Hoa Lư</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f5f2;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5dfd5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }
        .header {
            background-color: #3D1E0B;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #D4B26F;
            font-family: 'Georgia', serif;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .header p {
            color: #f7f5f2;
            font-size: 12px;
            margin: 5px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .content {
            padding: 40px 30px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #3D1E0B;
            border-left: 4px solid #D4B26F;
            padding-left: 10px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid #f2edd5;
        }
        .details-table td.label {
            font-weight: bold;
            color: #3D1E0B;
            width: 35%;
        }
        .details-table td.value {
            color: #444444;
        }
        .btn-box {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #3D1E0B;
            color: #ffffff !important;
            padding: 12px 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn:hover {
            background-color: #552d13;
        }
        .footer {
            background-color: #fcfbfa;
            border-top: 1px solid #e5dfd5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CƠM CỔ HOA LƯ</h1>
            <p>Hệ Thống Quản Lý Đặt Bàn</p>
        </div>
        <div class="content">
            <div class="title">Thông Báo: Có Lượt Đặt Bàn Mới</div>
            
            <table class="details-table">
                <tr>
                    <td class="label">Mã Đặt Bàn</td>
                    <td class="value" style="font-weight: bold; color: #3D1E0B;">{{ $booking->booking_code }}</td>
                </tr>
                <tr>
                    <td class="label">Tên khách hàng</td>
                    <td class="value">{{ $booking->customer_name }}</td>
                </tr>
                <tr>
                    <td class="label">Số điện thoại</td>
                    <td class="value">{{ $booking->customer_phone }}</td>
                </tr>
                <tr>
                    <td class="label">Email khách hàng</td>
                    <td class="value">{{ $booking->customer_email ?: 'Không cung cấp' }}</td>
                </tr>
                <tr>
                    <td class="label">Ngày dùng bữa</td>
                    <td class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Giờ dùng bữa</td>
                    <td class="value">{{ $booking->booking_time }}</td>
                </tr>
                <tr>
                    <td class="label">Số khách</td>
                    <td class="value">
                        {{ $booking->adults }} người lớn
                        @if($booking->children > 0)
                            , {{ $booking->children }} trẻ em
                        @endif
                    </td>
                </tr>
                @if($booking->special_requests)
                    <tr>
                        <td class="label">Yêu cầu đặc biệt</td>
                        <td class="value">{{ $booking->special_requests }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Thời gian đăng ký</td>
                    <td class="value">{{ $booking->created_at->format('H:i - d/m/Y') }}</td>
                </tr>
            </table>

            <div class="btn-box">
                <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="btn">
                    Đi Tới Trang Quản Trị Đặt Bàn
                </a>
            </div>
        </div>
        <div class="footer">
            <p>Hệ thống email tự động của Cơm Cổ Hoa Lư</p>
        </div>
    </div>
</body>
</html>
