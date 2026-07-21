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
        $tinTuc = PostCategory::create(['name' => 'Tin tức', 'slug' => 'tin-tuc', 'description' => 'Tin tức và bài viết về ẩm thực Ninh Bình', 'sort_order' => 1]);
        $khuyenMai = PostCategory::create(['name' => 'Khuyến mãi', 'slug' => 'khuyen-mai', 'description' => 'Chương trình khuyến mãi, ưu đãi', 'sort_order' => 2]);
        $tuyenDung = PostCategory::create(['name' => 'Tuyển dụng', 'slug' => 'tuyen-dung', 'description' => 'Tin tuyển dụng nhân viên', 'sort_order' => 3]);

        // ── Bài viết mẫu ──
        $posts = [
            [
                'category_id' => $tinTuc->id,
                'title' => 'Quán ăn Ninh Bình ngon: Danh sách được người địa phương yêu thích',
                'slug' => 'quan-an-ninh-binh-ngon',
                'excerpt' => 'Tổng hợp những quán ăn ngon nhất Ninh Bình theo đánh giá của người dân địa phương.',
                'content' => '<p>Ninh Bình nổi tiếng với nhiều món ăn đặc sản hấp dẫn. Dưới đây là danh sách những quán ăn được người địa phương yêu thích nhất.</p><h2>1. Cơm Cổ Hoa Lư</h2><p>Nhà hàng chuyên phục vụ cơm niêu truyền thống và đặc sản dê núi Ninh Bình.</p>',
                'meta_title' => 'Quán ăn ngon Ninh Bình | Top danh sách yêu thích',
                'meta_description' => 'Khám phá danh sách quán ăn ngon nhất Ninh Bình, từ cơm niêu truyền thống đến đặc sản dê núi, được người địa phương đánh giá cao.',
            ],
            [
                'category_id' => $tinTuc->id,
                'title' => 'Nhà hàng có không gian đẹp ở Ninh Bình để tổ chức tiệc',
                'slug' => 'nha-hang-khong-gian-dep-ninh-binh',
                'excerpt' => 'Tìm kiếm nhà hàng có không gian đẹp, rộng rãi ở Ninh Bình phù hợp cho tiệc gia đình, đoàn.',
                'content' => '<p>Nếu bạn đang tìm một nhà hàng có không gian đẹp ở Ninh Bình để tổ chức tiệc, Cơm Cổ Hoa Lư là lựa chọn hoàn hảo.</p>',
                'meta_title' => 'Nhà hàng không gian đẹp Ninh Bình',
                'meta_description' => 'Nhà hàng không gian đẹp ở Ninh Bình phù hợp cho tiệc gia đình, đoàn. Đặt bàn ngay tại Cơm Cổ Hoa Lư.',
            ],
            [
                'category_id' => $tinTuc->id,
                'title' => 'Kinh nghiệm chọn quán ăn cho gia đình ở Ninh Bình',
                'slug' => 'kinh-nghiem-chon-quan-an-gia-dinh-ninh-binh',
                'excerpt' => 'Chia sẻ kinh nghiệm chọn quán ăn phù hợp cho gia đình khi du lịch Ninh Bình.',
                'content' => '<p>Khi du lịch Ninh Bình cùng gia đình, việc chọn quán ăn phù hợp rất quan trọng. Dưới đây là những tiêu chí nên cân nhắc.</p>',
                'meta_title' => 'Kinh nghiệm chọn quán ăn gia đình Ninh Bình',
                'meta_description' => 'Kinh nghiệm chọn quán ăn cho gia đình khi du lịch Ninh Bình. Tiêu chí chọn nhà hàng, menu phù hợp trẻ em.',
            ],
            [
                'category_id' => $khuyenMai->id,
                'title' => 'Ưu đãi mùa hè – Giảm 10% cho đoàn trên 20 khách',
                'slug' => 'uu-dai-mua-he-giam-10-phan-tram',
                'excerpt' => 'Chương trình ưu đãi đặc biệt mùa hè 2026 dành cho khách đoàn.',
                'content' => '<p>Nhân dịp mùa du lịch hè 2026, Cơm Cổ Hoa Lư dành tặng ưu đãi giảm 10% tổng hóa đơn cho đoàn trên 20 khách.</p><p><strong>Thời gian áp dụng:</strong> 01/06 – 31/08/2026</p>',
                'meta_title' => 'Ưu đãi mùa hè – Giảm 10% | Cơm Cổ Hoa Lư',
                'meta_description' => 'Giảm 10% cho đoàn trên 20 khách tại Cơm Cổ Hoa Lư. Ưu đãi mùa hè 2026.',
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
            Post::create(array_merge($post, [
                'author_id' => $admin->id,
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(rand(1, 30)),
            ]));
        }
    }
}
