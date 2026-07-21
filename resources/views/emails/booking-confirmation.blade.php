<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Xác Nhận Đặt Bàn - Cơm Cổ Hoa Lư</title>
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
        .greeting {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #3D1E0B;
        }
        .intro {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #666666;
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
        .code-box {
            background-color: #fcfaf2;
            border: 1px dashed #D4B26F;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #3D1E0B;
            margin-bottom: 30px;
        }
        .footer {
            background-color: #fcfbfa;
            border-top: 1px solid #e5dfd5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            line-height: 1.5;
        }
        .footer a {
            color: #D4B26F;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CƠM CỔ HOA LƯ</h1>
            <p>Tinh Hoa Ẩm Thực Cố Đô</p>
        </div>
        <div class="content">
            <div class="greeting">Kính chào Quý khách {{ $booking->customer_name }},</div>
            <div class="intro">
                Cơm Cổ Hoa Lư xin chân thành cảm ơn Quý khách đã tin tưởng và lựa chọn nhà hàng chúng tôi cho bữa ăn của mình. Chúng tôi xin xác nhận yêu cầu đặt bàn của Quý khách đã được tiếp nhận thành công với các thông tin chi tiết dưới đây:
            </div>
            
            <div class="code-box">
                Mã Đặt Bàn: {{ $booking->booking_code }}
            </div>

            <table class="details-table">
                <tr>
                    <td class="label">Họ tên khách hàng</td>
                    <td class="value">{{ $booking->customer_name }}</td>
                </tr>
                <tr>
                    <td class="label">Số điện thoại</td>
                    <td class="value">{{ $booking->customer_phone }}</td>
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
                    <td class="label">Trạng thái</td>
                    <td class="value" style="color: #d97706; font-weight: bold;">
                        {{ $booking->status->label() }}
                    </td>
                </tr>
            </table>

            <div class="intro" style="margin-bottom: 0;">
                Nhân viên của chúng tôi sẽ liên hệ lại qua số điện thoại <strong>{{ $booking->customer_phone }}</strong> trong vòng 10-15 phút để xác nhận lại thông tin. Nếu Quý khách cần thay đổi thông tin đặt bàn hoặc hỗ trợ gấp, vui lòng liên hệ hotline: <strong>0866.000.000</strong>.
            </div>
        </div>
        <div class="footer">
            <p><strong>Cơm Cổ Hoa Lư</strong></p>
            <p>Địa chỉ: TP Hoa Lư, Ninh Bình | Hotline: 0866.000.000</p>
            <p>Email: <a href="mailto:contact@comcohoalu.vn">contact@comcohoalu.vn</a></p>
        </div>
    </div>
</body>
</html>
