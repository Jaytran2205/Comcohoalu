<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông Báo Liên Hệ Mới - Cơm Cổ Hoa Lư</title>
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
        .message-box {
            background-color: #fcfaf2;
            border: 1px solid #f2edd5;
            padding: 20px;
            border-radius: 8px;
            font-size: 14px;
            color: #444444;
            line-height: 1.6;
            margin-top: 10px;
            white-space: pre-wrap;
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
            <h1>CƠM CỔ Hoa LƯ</h1>
            <p>Hệ Thống Phản Hồi Khách Hàng</p>
        </div>
        <div class="content">
            <div class="title">Thông Báo: Tin Nhắn Liên Hệ Mới</div>
            
            <table class="details-table">
                <tr>
                    <td class="label">Họ tên khách hàng</td>
                    <td class="value">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td class="label">Số điện thoại</td>
                    <td class="value">{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <td class="label">Email khách hàng</td>
                    <td class="value">{{ $contact->email }}</td>
                </tr>
                @if($contact->subject)
                    <tr>
                        <td class="label">Chủ đề</td>
                        <td class="value">{{ $contact->subject }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Thời gian gửi</td>
                    <td class="value">{{ $contact->created_at->format('H:i - d/m/Y') }}</td>
                </tr>
            </table>

            <div style="font-weight: bold; font-size: 14px; color: #3D1E0B; margin-top: 20px;">Nội dung tin nhắn:</div>
            <div class="message-box">{{ $contact->message }}</div>
        </div>
        <div class="footer">
            <p>Hệ thống email tự động của Cơm Cổ Hoa Lư</p>
        </div>
    </div>
</body>
</html>
