# Design

## Visual Theme
Hơi thở cố đô Hoa Lư cổ kính, mộc mạc và đầm ấm với các yếu tố thiết kế có cấu trúc rõ ràng, tỷ lệ cân đối và các họa tiết di sản được thể hiện một cách tinh tế.

## Colors
Các biến màu sắc chính dựa trên gam màu đất truyền thống:
- **Primary (Terracotta Brown):** `#8B4513` (Sử dụng cho các yếu tố thương hiệu chính, nút bấm nhấn mạnh, tiêu đề chính).
  - Light: `#A0522D`
  - Dark: `#5D2E0C`
- **Secondary (Warm Ochre Gold):** `#D4A855` (Sử dụng cho đường nét trang trí, huy hiệu nổi bật, các trạng thái hover).
  - Light: `#F5E6C8`
  - Dark: `#B8860B`
- **Backgrounds:**
  - Primary (Cream White): `#FFF9F0` (Màu giấy lụa truyền thống)
  - Secondary (Soft Sand): `#F5F0E8`
  - Dark (Espresso Brown): `#2C1810` (Kiến trúc gỗ mun trầm mặc)
- **Text Ink:**
  - Primary (Dark Brown): `#2C1810` (Đảm bảo độ tương phản cao, tránh dùng màu đen thuần túy để tăng cảm giác tự nhiên)
  - Secondary (Muted Sepia): `#6B5B4C`
  - Light (White): `#FFFFFF`
- **Borders:**
  - Custom Gold-tinted Grey: `#D4C5B2`

## Typography
- **Serif Font (Headlines):** `'Playfair Display', Georgia, serif` (Mang tính cổ điển, sang trọng)
- **Sans Font (Body text):** `'Open Sans', 'Segoe UI', system-ui, sans-serif` (Đảm bảo tính dễ đọc cao trên cả thiết bị di động và máy tính)
- **Accent Font (Highlights):** `'Dancing Script', cursive` (Chữ viết tay bay bổng cho các cụm từ thấp hơn mang tính nghệ thuật)
- **Display Heading Rules:**
  - Khoảng cách chữ (letter-spacing) tối thiểu: `-0.03em`
  - Line-height tối thiểu cho chữ nghiêng: `1.1` để tránh cắt descender (`g`, `y`, `j`)
  - Độ dài dòng chữ body: Tối đa `65-75ch` để tối ưu trải nghiệm đọc.

## Spacing & Layout
Bố cục bất đối xứng tinh tế kết hợp với các khoảng trắng hào phóng để tạo nhịp điệu cho trang thương hiệu:
- Sử dụng lưới CSS Grid cho các khu vực nhiều thành phần.
- Bo góc các thẻ (`premium-card`) cố định ở mức `12px` (hoặc `radius-xl`) để đồng bộ trải nghiệm với trang quản lý.
- Độ cao của thanh điều hướng (header nav): Tối đa `80px`.

## Key Components
- **`.premium-card`:** Thẻ sản phẩm/bài viết nền trắng, bóng mờ siêu nhẹ `rgba(44, 24, 16, 0.06)`, bo góc `12px`, viền mờ `1px solid rgba(212, 197, 178, 0.3)`. Khi hover sẽ dịch chuyển lên trên `-4px` và đổi màu viền sang tông màu vàng cổ (`--color-secondary`).
- **`.heading-decorator`:** Dấu gạch dưới trang trí màu vàng dài `60px` cân đối dưới tiêu đề.
- **`.heading-decorator-double`:** Dấu hoa thị trang trí `❦` hai bên tiêu đề cho các không gian truyền thống.
- **`.viet-pattern-bg`:** Họa tiết vòng tròn đồng tâm mờ nhạt lấy cảm hứng từ trống đồng và hoa văn Đông Sơn.
