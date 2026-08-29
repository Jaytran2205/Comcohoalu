<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // ── Danh mục bài viết ──
        $tinTuc = PostCategory::firstOrCreate(['slug' => 'tin-tuc'], ['name' => 'Tin tức', 'description' => 'Tin tức và bài viết về ẩm thực Ninh Bình', 'sort_order' => 1]);
        $khuyenMai = PostCategory::firstOrCreate(['slug' => 'khuyen-mai'], ['name' => 'Khuyến mãi', 'description' => 'Chương trình khuyến mãi, ưu đãi', 'sort_order' => 2]);
        $tuyenDung = PostCategory::firstOrCreate(['slug' => 'tuyen-dung'], ['name' => 'Tuyển dụng', 'description' => 'Tin tuyển dụng nhân viên', 'sort_order' => 3]);

        // ── Bài viết mẫu ──
        $posts = [
            [
                'category_id' => $tinTuc->id,
                'title' => 'Đặc sản Dê núi Ninh Bình - Tinh hoa ẩm thực vùng đất cố đô Tràng An',
                'slug' => 'dac-san-de-nui-ninh-binh-tinh-hoa-am-thuc',
                'excerpt' => 'Thịt dê núi Ninh Bình săn chắc, ngọt thơm và ít mỡ nhờ chăn thả tự nhiên trên núi đá vôi đá. Khám phá nét độc đáo của ẩm thực cố đô.',
                'content' => '<p>Thịt dê núi Ninh Bình từ lâu đã trở thành thương hiệu ẩm thực nổi tiếng trong và ngoài nước. Nhờ địa hình nhiều núi đá vôi tự nhiên, dê được nuôi thả tự do, ăn các loại lá cây, thảo dược hoang dã nên thịt có vị thơm đặc trưng, dai ngọt và rất ít mỡ.</p><h2>Nét Độc Đáo Từ Phương Pháp Chăn Thả Tự Nhiên</h2><p>Dê núi Ninh Bình khác biệt hoàn toàn với dê nuôi ở các vùng đồng bằng. Chúng phải leo trèo trên những vách đá dựng đứng, giúp cơ thịt săn chắc và khỏe mạnh. Đặc biệt, nguồn thức ăn từ các loại cây thảo dược mọc tự nhiên trên núi đá vôi chính là bí quyết giúp khử mùi hôi tự nhiên của thịt dê, tạo nên hương vị thơm ngon hảo hạng.</p><h2>Các Món Dê Núi Trứ Danh Không Thể Bỏ Qua</h2><ul><li><strong>Dê Tái Chanh:</strong> Thịt dê thái mỏng, chần tái qua nước sôi rồi bóp đều với nước cốt chanh, sả, gừng, vừng rang. Món này ăn kèm lá sung, khế chua, chuối chát và chấm tương bần thơm lừng.</li><li><strong>Dê Xào Lăn:</strong> Thịt dê xào săn cùng sả, ớt, nước cốt dừa và hành tây, mang lại vị béo ngậy, ngọt thịt đầm đà.</li><li><strong>Chân Dê Hầm Thuốc Bắc:</strong> Món ăn bổ dưỡng với chân dê ninh nhừ cùng các vị thuốc bắc quý hiếm, giúp bồi bổ sức khỏe tối đa.</li></ul><p>Tại <strong>Cơm Cổ Hoa Lư</strong>, chúng tôi tự hào mang đến cho thực khách những món dê núi được tuyển chọn kỹ lưỡng, chế biến chuẩn vị truyền thống bởi các đầu bếp bản địa giàu kinh nghiệm.</p>',
                'meta_title' => 'Đặc sản Dê núi Ninh Bình | Tinh hoa ẩm thực Tràng An',
                'meta_description' => 'Thịt dê núi Ninh Bình săn chắc, dai ngọt tự nhiên nhờ chăn thả trên vách đá vôi. Khám phá các món dê nức tiếng tại Cơm Cổ Hoa Lư.',
            ],
            [
                'category_id' => $tinTuc->id,
                'title' => 'Mâm cơm gia đình truyền thống tại Phố cổ Hoa Lư có gì đặc sắc?',
                'slug' => 'mam-com-gia-dinh-truyen-thong-pho-co-hoa-lu',
                'excerpt' => 'Giữa nhịp sống hiện đại, mâm cơm gia đình mộc mạc với tôm đồng rang, cá kho tộ và thịt chao riềng vẫn giữ trọn hồn cốt văn hóa Việt.',
                'content' => '<p>Ẩm thực không chỉ là để no bụng, mà còn là cầu nối ký ức và gìn giữ văn hóa. Đến với Phố cổ Hoa Lư, bên cạnh cảnh sắc non nước hữu tình, du khách sẽ được trải nghiệm hương vị cơm xưa đầm ấm qua những mâm cơm gia đình truyền thống tại nhà hàng Cơm Cổ Hoa Lư.</p><h2>Hương Vị Đồng Quê Giản Dị Mà Đậm Đà</h2><p>Mâm cơm Việt luôn có sự kết hợp hài hòa giữa các vị mặn, ngọt, chua, cay và thanh mát. Những món ăn tuy dân dã nhưng đòi hỏi sự tỉ mỉ trong khâu chế biến:</p><ul><li><strong>Tôm Đồng Rang Cháy Cạnh:</strong> Những chú tôm đồng tươi rói được rang giòn tan, thơm nức mũi, đậm đà gia vị quê nhà.</li><li><strong>Cá Chuối Kho Tộ:</strong> Thịt cá chuối săn chắc, kho trong tộ đất cùng ba chỉ béo ngậy, đượm màu mật mía và tiêu sọ cay nồng.</li><li><strong>Thịt Chao Riềng:</strong> Thịt heo tẩm ướp riềng nghệ xay nhuyễn rồi chao dầu vàng giòn, tỏa hương thơm đặc trưng đánh thức mọi giác quan.</li></ul><h2>Không Gian Dùng Bữa Ấm Cúng Như Nhà Mình</h2><p>Thưởng thức bát cơm gạo tám thơm dẻo cùng các món ăn thuần Việt giữa không gian nhà cổ mộc mạc, bát đĩa đất nung bình dị sẽ giúp du khách tìm lại cảm giác yên bình, thư thái bên cạnh những người thân yêu.</p>',
                'meta_title' => 'Mâm cơm gia đình truyền thống | Cơm Cổ Hoa Lư',
                'meta_description' => 'Thưởng thức mâm cơm gia đình ấm cúng với tôm đồng rang, cá chuối kho tộ, thịt chao riềng chuẩn vị Bắc Bộ tại Phố cổ Hoa Lư Ninh Bình.',
            ],
            [
                'category_id' => $tinTuc->id,
                'title' => 'Kinh nghiệm chọn quán ăn ngon cho gia đình khi du lịch Ninh Bình',
                'slug' => 'kinh-nghiem-chon-quan-an-ngon-gia-dinh-ninh-binh',
                'excerpt' => 'Bí quyết lựa chọn nhà hàng phù hợp cho gia đình có người lớn tuổi và trẻ nhỏ khi ghé thăm các danh thắng tại Ninh Bình.',
                'content' => '<p>Du lịch Ninh Bình cùng gia đình luôn mang lại những kỷ niệm tuyệt vời. Tuy nhiên, việc lựa chọn địa điểm ăn uống vừa lòng cả người lớn tuổi lẫn trẻ nhỏ là điều không hề dễ dàng. Dưới đây là một số kinh nghiệm hữu ích dành cho bạn.</p><h2>1. Vị Trí Thuận Tiện Di Chuyển</h2><p>Nên chọn các nhà hàng nằm gần các trục đường lớn hoặc các khu du lịch trọng điểm như Tràng An, Chùa Bái Đính, Phố cổ Hoa Lư. Điều này giúp gia đình bạn tiết kiệm thời gian di chuyển và tránh mệt mỏi cho trẻ nhỏ sau chuyến đi dài.</p><h2>2. Thực Đơn Phong Phú, Chiều Lòng Mọi Thành Viên</h2><p>Một nhà hàng lý tưởng cho gia đình cần có thực đơn đa dạng: vừa có các món đặc sản địa phương (dê núi, cơm cháy) cho người lớn thưởng thức, vừa có các món ăn nhẹ, dễ ăn cho trẻ nhỏ như khoai tây chiên, ngô chiên bơ, trứng đúc thịt hay gà luộc.</p><h2>3. Không Gian Rộng Rãi, Sạch Sẽ</h2><p>Gia đình đông người hoặc đi cùng đoàn cần không gian thoáng đãng, bàn ghế sắp xếp khoảng cách hợp lý và khu vực đỗ xe rộng rãi. Nhà hàng Cơm Cổ Hoa Lư tọa lạc ngay trung tâm Phố cổ Hoa Lư với bãi đỗ xe rộng, không gian nhà gỗ cổ kính thoáng mát chính là sự lựa chọn hàng đầu cho các gia đình.</p>',
                'meta_title' => 'Kinh nghiệm chọn nhà hàng ngon cho gia đình ở Ninh Bình',
                'meta_description' => 'Bí quyết chọn quán ăn ngon, vị trí đắc địa, thực đơn phong phú cho gia đình khi đi du lịch danh thắng Ninh Bình.',
            ],
            [
                'category_id' => $khuyenMai->id,
                'title' => 'Ưu đãi mùa hè – Giảm ngay 10% khi đặt bàn trước cho khách đoàn',
                'slug' => 'uu-dai-mua-he-giam-10-phan-tram-khach-doan',
                'excerpt' => 'Chương trình tri ân đặc biệt mùa hè dành cho các đoàn du lịch, công ty khi liên hệ đặt bàn trước tại Cơm Cổ Hoa Lư.',
                'content' => '<p>Để đồng hành cùng quý khách trong mùa du lịch hè sôi động, nhà hàng Cơm Cổ Hoa Lư hân hạnh mang đến chương trình ưu đãi đặc quyền dành riêng cho khách đoàn và các công ty lữ hành du lịch khi ghé thăm Ninh Bình.</p><h2>Chi Tiết Chương Trình Khuyến Mãi</h2><ul><li><strong>Giảm trực tiếp 10%</strong> trên tổng hóa đơn thức ăn cho tất cả các đoàn từ 15 người trở lên.</li><li><strong>Tặng kèm</strong> nước uống và tráng miệng theo mùa cho toàn đoàn.</li><li>Hỗ trợ thiết kế thực đơn (Set Menu) riêng theo ngân sách và sở thích ẩm thực của đoàn.</li></ul><p><strong>Điều kiện áp dụng:</strong> Quý khách chỉ cần liên hệ đặt bàn trước ít nhất 60 phút qua Hotline: <strong>0566 135 135</strong> hoặc <strong>0344 136 136</strong> để chúng tôi chuẩn bị nguyên liệu tươi ngon nhất phục vụ chu đáo.</p>',
                'meta_title' => 'Khuyến mãi hè | Giảm 10% khách đoàn tại Cơm Cổ Hoa Lư',
                'meta_description' => 'Ưu đãi hè đặc biệt: Giảm 10% hóa đơn thức ăn cho đoàn từ 15 người trở lên khi đặt trước tại Cơm Cổ Hoa Lư Ninh Bình.',
            ],
            [
                'category_id' => $tuyenDung->id,
                'title' => 'Tuyển nhân viên phục vụ – Full-time',
                'slug' => 'tuyen-nhan-vien-phuc-vu-full-time',
                'excerpt' => 'Cơm Cổ Hoa Lư tuyển dụng nhân viên phục vụ bàn, làm việc full-time.',
                'content' => '<h2>Mô tả công việc</h2><ul><li>Phục vụ khách hàng tại nhà hàng</li><li>Sắp xếp bàn ghế, dọn dẹp</li></ul><h2>Yêu cầu</h2><ul><li>Nam/Nữ, 18-35 tuổi</li><li>Nhanh nhẹn, giao tiếp tốt</li></ul><h2>Quyền lợi</h2><ul><li>Lương: 5-7 triệu/tháng</li><li>Bao ăn, tip khách</li></ul>',
                'meta_title' => 'Tuyển nhân viên phục vụ | Cơm Cổ Hoa Lư',
                'meta_description' => 'Cơm Cổ Hoa Lư tuyển nhân viên phục vụ bàn full-time. Lương 5-7 triệu, bao ăn.',
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                array_merge($post, [
                    'author_id' => $admin->id,
                    'status' => PostStatus::Published,
                    'published_at' => now()->subDays(rand(1, 30)),
                ])
            );
        }
    }
}
