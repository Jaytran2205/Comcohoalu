<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\SetMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to truncate safely
        DB::statement('PRAGMA foreign_keys = OFF');
        DB::table('set_menu_items')->truncate();
        MenuItem::truncate();
        MenuCategory::truncate();
        SetMenu::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // ── 1. Create Menu Categories ──
        $catKhaiVi = MenuCategory::create(['name' => 'Khai vị', 'slug' => 'khai-vi', 'icon' => 'fa-cookie-bite', 'sort_order' => 1]);
        $catBo = MenuCategory::create(['name' => 'Món Bò', 'slug' => 'mon-bo', 'icon' => 'fa-cow', 'sort_order' => 2]);
        $catHaiSan = MenuCategory::create(['name' => 'Món Hải Sản', 'slug' => 'mon-hai-san', 'icon' => 'fa-fish-fins', 'sort_order' => 3]);
        $catDauTrung = MenuCategory::create(['name' => 'Đậu Phụ - Trứng', 'slug' => 'dau-phu-trung', 'icon' => 'fa-egg', 'sort_order' => 4]);
        $catRauCanh = MenuCategory::create(['name' => 'Món Rau - Canh', 'slug' => 'mon-rau-canh', 'icon' => 'fa-leaf', 'sort_order' => 5]);
        $catCa = MenuCategory::create(['name' => 'Món Cá', 'slug' => 'mon-ca', 'icon' => 'fa-fish', 'sort_order' => 6]);
        $catTomCuaOcEch = MenuCategory::create(['name' => 'Tôm - Cua - Ốc - Ếch', 'slug' => 'tom-cua-oc-ech', 'icon' => 'fa-shrimp', 'sort_order' => 7]);
        $catDeNui = MenuCategory::create(['name' => 'Dê Núi Ninh Bình', 'slug' => 'de-nui-ninh-binh', 'icon' => 'fa-mountain', 'sort_order' => 8]);
        $catLau = MenuCategory::create(['name' => 'Lẩu Đồng Quê', 'slug' => 'lau-dong-que', 'icon' => 'fa-bowl-food', 'sort_order' => 9]);
        $catThit = MenuCategory::create(['name' => 'Món Thịt', 'slug' => 'mon-thit', 'icon' => 'fa-drumstick-bite', 'sort_order' => 10]);
        $catGa = MenuCategory::create(['name' => 'Món Gà', 'slug' => 'mon-ga', 'icon' => 'fa-feather', 'sort_order' => 11]);
        $catComMi = MenuCategory::create(['name' => 'Cơm - Mì', 'slug' => 'com-mi', 'icon' => 'fa-bowl-rice', 'sort_order' => 12]);

        // Helper function to create items quickly
        $createItem = function($catId, $name, $price, $desc = '', $sort = 0, $badge = 'none', $featured = false) {
            return MenuItem::create([
                'category_id' => $catId,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'price' => $price,
                'badge' => $badge,
                'is_featured' => $featured,
                'sort_order' => $sort
            ]);
        };

        // ── 2. Populate Menu Items ──

        // Khai vị
        $itemsKhaiVi = [
            $createItem($catKhaiVi->id, 'Khoai tây chiên', 30000, 'Khoai tây cắt lát chiên giòn rụm thơm béo.', 1),
            $createItem($catKhaiVi->id, 'Ngô chiên bơ', 60000, 'Hạt ngô ngọt chiên giòn tẩm bơ thơm nức.', 2),
            $createItem($catKhaiVi->id, 'Khoai Lệ Phố', 60000, 'Khoai môn Lệ Phố bùi ngọt, chiên giòn đặc sản.', 3),
        ];

        // Món Bò
        $itemsBo = [
            $createItem($catBo->id, 'Bò xào ngồng tỏi', 200000, 'Thịt bò mềm xào cùng ngồng tỏi xanh giòn ngọt.', 1, 'none', true),
            $createItem($catBo->id, 'Bò xào măng trúc', 200000, 'Thịt bò xào măng trúc Yên Tử thơm ngon, giòn sần sật.', 2),
            $createItem($catBo->id, 'Bò xào hành tây', 200000, 'Thịt bò xào hành tây ngọt thơm vị truyền thống.', 3),
            $createItem($catBo->id, 'Gỏi bò kéo pháo', 220000, 'Gỏi bò trộn thính và rau thơm chua ngọt đậm đà vị Cố Đô.', 4, 'best_seller', true),
            $createItem($catBo->id, 'Sách bò xào dứa', 200000, 'Sách bò giòn sần sật xào dứa chua ngọt đậm vị.', 5),
        ];

        // Món Hải Sản
        $itemsHaiSan = [
            $createItem($catHaiSan->id, 'Mực xào thập cẩm', 200000, 'Mực tươi xào rau củ thập cẩm thanh ngọt mát bổ.', 1),
            $createItem($catHaiSan->id, 'Mực chiên bơ', 200000, 'Mực tươi tẩm bột chiên bơ giòn rụm béo ngậy.', 2, 'best_seller', true),
            $createItem($catHaiSan->id, 'Cá thu sốt cà chua', 230000, 'Cá thu nướng thơm sốt cà chua đậm đà hao cơm.', 3),
        ];

        // Đậu Phụ - Trứng
        $itemsDauTrung = [
            $createItem($catDauTrung->id, 'Đậu tẩm hành', 60000, 'Đậu rán giòn nhúng mắm hành truyền thống thanh đạm.', 1),
            $createItem($catDauTrung->id, 'Đậu sốt cà chua', 60000, 'Đậu phụ rán sốt cà chua đậm đà hương vị quê hương.', 2),
            $createItem($catDauTrung->id, 'Đậu lướt ván', 50000, 'Đậu phụ lướt ván ngoài giòn trong mềm mịn ngậy béo.', 3),
            $createItem($catDauTrung->id, 'Trứng rán', 60000, 'Trứng gà ta rán vàng ươm, thơm ngậy béo.', 4),
        ];

        // Món Rau - Canh
        $itemsRauCanh = [
            $createItem($catRauCanh->id, 'Ngồng tỏi xào', 80000, 'Ngồng tỏi xào tỏi xanh giòn ngọt mát.', 1),
            $createItem($catRauCanh->id, 'Bắp cải xào', 70000, 'Rau bắp cải xào tỏi giòn ngọt tự nhiên.', 2),
            $createItem($catRauCanh->id, 'Bắp cải luộc', 60000, 'Rau bắp cải luộc chấm trứng dầm nước tương.', 3),
            $createItem($catRauCanh->id, 'Mồng tơi xào tỏi', 70000, 'Rau mồng tơi xào tỏi xanh mướt thơm ngon.', 4),
            $createItem($catRauCanh->id, 'Củ quả luộc', 60000, 'Củ quả luộc thập cẩm chấm kho quẹt đậm đà.', 5),
            $createItem($catRauCanh->id, 'Rau muống xào tỏi', 60000, 'Rau muống xào tỏi xanh giòn, thơm lừng.', 6),
            $createItem($catRauCanh->id, 'Canh cua + Cà gém', 70000, 'Canh cua đồng nấu rau đay mồng tơi ăn kèm cà pháo giòn rụm.', 7, 'best_seller', true),
            $createItem($catRauCanh->id, 'Canh chua cá tầm', 150000, 'Canh chua cá tầm nấu dứa, dọc mùng chua ngọt hấp dẫn.', 8),
            $createItem($catRauCanh->id, 'Canh ngao chua', 70000, 'Canh ngao nấu dứa thanh mát giải nhiệt ngày hè.', 9),
        ];

        // Món Cá
        $itemsCa = [
            $createItem($catCa->id, 'Cá chuối kho tộ', 120000, 'Cá quả chuối kho niêu đất đậm đà hương vị đồng quê.', 1, 'best_seller', true),
            $createItem($catCa->id, 'Cá chép giòn xào ngồng tỏi', 200000, 'Cá chép giòn thái lát xào ngồng tỏi giòn sần sật ngọt lịm.', 2),
            $createItem($catCa->id, 'Cá chép giòn xào cần', 200000, 'Cá chép giòn xào cần tỏi tây thơm lừng đậm đà.', 3),
            $createItem($catCa->id, 'Cá tầm rang muối', 240000, 'Cá tầm cắt khúc rang muối giòn tan thơm bùi đặc sắc.', 4, 'specialty', true),
            $createItem($catCa->id, 'Cá tầm chao giềng', 240000, 'Cá tầm ướp riềng nghệ chao dầu giòn rụm đậm hương quê.', 5),
            $createItem($catCa->id, 'Cá chạch kho niêu đất ( Đặc biệt )', 180000, 'Cá chạch đồng kho mục xương trong niêu đất truyền thống.', 6, 'specialty', true),
        ];

        // Tôm - Cua - Ốc - Ếch
        $itemsTomCuaOcEch = [
            $createItem($catTomCuaOcEch->id, 'Tôm đồng rang', 110000, 'Tôm đồng rang cháy cạnh giòn ngọt mặn mà.', 1),
            $createItem($catTomCuaOcEch->id, 'Tôm đồng chao lá chanh', 120000, 'Tôm đồng chao giòn rụm thơm nức mùi lá chanh.', 2),
            $createItem($catTomCuaOcEch->id, 'Cua rang muối', 150000, 'Cua đồng rang muối khô giòn tan thơm ngậy bổ dưỡng.', 3),
            $createItem($catTomCuaOcEch->id, 'Chả ốc', 130000, 'Chả ốc nhồi lá lốt hấp hoặc nướng giòn sần sật.', 4, 'best_seller', true),
            $createItem($catTomCuaOcEch->id, 'Ếch rang muối', 180000, 'Thịt ếch đồng chiên giòn lắc muối thơm bùi ngậy.', 5),
            $createItem($catTomCuaOcEch->id, 'Ếch xào măng', 180000, 'Ếch xào măng củ chua cay đậm đà cực kỳ hao cơm.', 6),
        ];

        // Dê Núi Ninh Bình
        $itemsDeNui = [
            $createItem($catDeNui->id, 'Tiết canh dê (Đặt trước)', 50000, 'Tiết canh dê núi sạch sẽ chuẩn vị Ninh Bình.', 1),
            $createItem($catDeNui->id, 'Dê tái chanh', 269000, 'Dê núi thái mỏng chần tái bóp chanh, vừng, sả gừng thanh mát.', 2, 'specialty', true),
            $createItem($catDeNui->id, 'Dê xào lăn', 269000, 'Thịt dê xào lăn cốt dừa sả ớt đậm vị béo ngậy.', 3),
            $createItem($catDeNui->id, 'Dê chao mắc mật', 269000, 'Thịt dê thái quân cờ chao giòn cùng lá mắc mật thơm lừng.', 4, 'specialty', true),
            $createItem($catDeNui->id, 'Dê cuốn mỡ chài', 250000, 'Dê băm viên cuốn mỡ chài nướng than hoa ngậy béo.', 5),
            $createItem($catDeNui->id, 'Dê hấp tương bần', 269000, 'Dê hấp gừng sả chấm tương bần truyền thống ngọt mềm.', 6),
            $createItem($catDeNui->id, 'Dê hấp tía tô', 269000, 'Thịt dê hấp tía tô thơm lừng ngọt nước ăn nóng.', 7),
            $createItem($catDeNui->id, 'Dê ủ trấu', 299000, 'Đặc sản Dê ủ trấu da giòn thịt đỏ hồng ngọt đậm.', 8, 'specialty', true),
            $createItem($catDeNui->id, 'Sốt dê cơm cháy', 150000, 'Nước sốt thịt dê sền sệt ăn kèm cơm cháy Ninh Bình giòn tan.', 9, 'best_seller', true),
            $createItem($catDeNui->id, 'Lòng dê xào dứa', 150000, 'Lòng dê làm sạch xào dứa chua ngọt giòn sần sật.', 10),
            $createItem($catDeNui->id, 'Chân dê hầm thuốc bắc', 150000, 'Chân dê hầm thuốc bắc bổ dưỡng, nước dùng ngọt thanh.', 11),
            $createItem($catDeNui->id, 'Lẩu dê nhúng mẻ', 800000, 'Nồi lẩu dê chua thanh vị mẻ ăn kèm rau sống.', 12),
            $createItem($catDeNui->id, 'Lẩu dê thuốc bắc (Đặc biệt)', 900000, 'Lẩu dê hầm thuốc bắc bổ dưỡng thích hợp cho gia đình.', 13, 'specialty', true),
        ];

        // Lẩu Đồng Quê
        $itemsLau = [
            $createItem($catLau->id, 'Lẩu riêu cua thập cẩm', 800000, 'Lẩu riêu cua đồng gạch xịn kèm sườn sụn, đậu rán, giò tai.', 1, 'best_seller', true),
            $createItem($catLau->id, 'Lẩu riêu cua bắp bò', 800000, 'Lẩu riêu cua nhiều gạch cua chưng thơm ăn cùng thịt bắp bò u.', 2),
            $createItem($catLau->id, 'Lẩu ếch măng', 600000, 'Ếch đồng xào măng chua cay nhúng lẩu giòn đậm đà.', 3),
            $createItem($catLau->id, 'Lẩu cá tầm', 800000, 'Lẩu cá tầm tươi sống chua cay kiểu Tây Bắc sần sật giòn.', 4),
            $createItem($catLau->id, 'Lẩu gà lá é (Đặt trước)', 600000, 'Lẩu gà ta nấu măng và lá é thơm nồng đặc trưng.', 5),
        ];

        // Món Thịt (phụ trợ cho set menu)
        $itemsThit = [
            $createItem($catThit->id, 'Thịt rang cháy cạnh', 90000, 'Thịt ba chỉ rang cháy cạnh giòn ngọt mỡ hành.', 1),
            $createItem($catThit->id, 'Thịt chao giềng', 110000, 'Thịt heo tẩm riềng nghệ chiên chao dầu vàng giòn thơm.', 2),
            $createItem($catThit->id, 'Thịt trưng mắm tép', 90000, 'Thịt heo băm xào mắm tép chưng đặc sản Ninh Bình.', 3),
            $createItem($catThit->id, 'Sườn xào chua ngọt', 120000, 'Sườn heo xào chua ngọt sốt sánh quyện mềm ngon đậm vị.', 4),
        ];

        // Món Gà
        $itemsGa = [
            $createItem($catGa->id, 'Gà chiên mắm', 150000, 'Thịt gà ta chiên nước mắm tỏi giòn ngọt đậm đà.', 1),
            $createItem($catGa->id, 'Gà xáo gừng', 150000, 'Thịt gà rang gừng sả vị truyền thống quê hương ấm nồng.', 2),
            $createItem($catGa->id, 'Gà rang muối', 150000, 'Gà ta chặt khúc lắc muối giòn tan thơm ngon.', 3),
        ];

        // Cơm - Mì
        $itemsComMi = [
            $createItem($catComMi->id, 'Cơm trắng', 20000, 'Cơm trắng gạo tám dẻo thơm ăn kèm món kho.', 1),
            $createItem($catComMi->id, 'Cơm niêu cháy', 50000, 'Cơm niêu đất nung than hồng cháy giòn rụm vàng ươm.', 2, 'specialty', true),
        ];


        // ── 3. Populate Set Menus ──

        // Helper to find item by name
        $findItem = function($name) {
            $item = MenuItem::where('name', 'like', "%{$name}%")->first();
            if (!$item) {
                // Try clean slug
                $slug = Str::slug($name);
                $item = MenuItem::where('slug', $slug)->first();
            }
            return $item;
        };

        // --- Set 150K Set 1 ---
        $set150k_1 = SetMenu::create([
            'name' => 'Set 150k - Thực đơn 1',
            'slug' => 'set-150k-thuc-don-1',
            'description' => 'Set mâm cơm gia đình 150k/suất ấm cúng với các món truyền thống đặc sắc.',
            'people_count' => 6,
            'price_per_person' => 150000,
            'is_active' => true,
            'sort_order' => 1
        ]);
        $items150k_1 = [
            'Bò xào măng trúc' => 1,
            'Thịt rang cháy cạnh' => 1,
            'Đậu sốt cà chua' => 1,
            'Ếch rang muối' => 1,
            'Bắp cải luộc' => 1,
            'Trứng rán' => 1,
            'Cơm trắng' => 2,
            'Canh cua + Cà gém' => 1,
        ];
        foreach ($items150k_1 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set150k_1->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- Set 150K Set 2 ---
        $set150k_2 = SetMenu::create([
            'name' => 'Set 150k - Thực đơn 2',
            'slug' => 'set-150k-thuc-don-2',
            'description' => 'Bữa cơm trọn vị 150k/suất kết hợp tôm thịt cá canh đầy đủ dinh dưỡng.',
            'people_count' => 6,
            'price_per_person' => 150000,
            'is_active' => true,
            'sort_order' => 2
        ]);
        $items150k_2 = [
            'Bò xào ngồng tỏi' => 1,
            'Thịt trưng mắm tép' => 1,
            'Gà chiên mắm' => 1,
            'Cá chuối kho tộ' => 1,
            'Củ quả luộc' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items150k_2 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set150k_2->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- Set 200K Set 1 ---
        $set200k_1 = SetMenu::create([
            'name' => 'Set 200k - Thực đơn 1',
            'slug' => 'set-200k-thuc-don-1',
            'description' => 'Mâm cơm đặc sản 200k/suất chứa dê tái chanh sả thơm và cá chép giòn ngọt lịm.',
            'people_count' => 6,
            'price_per_person' => 200000,
            'is_active' => true,
            'sort_order' => 3
        ]);
        $items200k_1 = [
            'Dê tái chanh' => 1,
            'Gà xáo gừng' => 1,
            'Cá chép giòn xào ngồng tỏi' => 1,
            'Cá chuối kho tộ' => 1,
            'Sườn xào chua ngọt' => 1,
            'Củ quả luộc' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items200k_1 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set200k_1->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- Set 200K Set 2 ---
        $set200k_2 = SetMenu::create([
            'name' => 'Set 200k - Thực đơn 2',
            'slug' => 'set-200k-thuc-don-2',
            'description' => 'Thực đơn tiệc 200k/suất đậm vị quê hương với dê xào lăn và mực tươi xào thập cẩm.',
            'people_count' => 6,
            'price_per_person' => 200000,
            'is_active' => true,
            'sort_order' => 4
        ]);
        $items200k_2 = [
            'Dê xào lăn' => 1,
            'Mực xào thập cẩm' => 1,
            'Thịt rang cháy cạnh' => 1,
            'Đậu sốt cà chua' => 1,
            'Ếch rang muối' => 1,
            'Củ quả luộc' => 1,
            'Gà chiên mắm' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items200k_2 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set200k_2->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- Set 250K Set 1 ---
        $set250k_1 = SetMenu::create([
            'name' => 'Set 250k - Thực đơn 1',
            'slug' => 'set-250k-thuc-don-1',
            'description' => 'Mâm tiệc thượng hạng 250k/suất hội tụ cá tầm rang muối, dê xào lăn núi đá Ninh Bình.',
            'people_count' => 6,
            'price_per_person' => 250000,
            'is_active' => true,
            'sort_order' => 5
        ]);
        $items250k_1 = [
            'Cá tầm rang muối' => 1,
            'Ếch xào măng' => 1,
            'Gà chiên mắm' => 1,
            'Dê xào lăn' => 1,
            'Thịt rang cháy cạnh' => 1,
            'Củ quả luộc' => 1,
            'Cá thu sốt cà chua' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items250k_1 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set250k_1->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- Set 250K Set 2 ---
        $set250k_2 = SetMenu::create([
            'name' => 'Set 250k - Thực đơn 2',
            'slug' => 'set-250k-thuc-don-2',
            'description' => 'Bàn tiệc VIP 250k/suất đặc sắc từ Dê chao mắc mật, Chả ốc truyền thống, Gà rang muối thơm giòn.',
            'people_count' => 6,
            'price_per_person' => 250000,
            'is_active' => true,
            'sort_order' => 6
        ]);
        $items250k_2 = [
            'Bò xào ngồng tỏi' => 1,
            'Dê chao mắc mật' => 1,
            'Gà rang muối' => 1,
            'Chả ốc' => 1,
            'Tôm đồng rang' => 1,
            'Đậu tẩm hành' => 1,
            'Củ quả luộc' => 1,
            'Ngô chiên bơ' => 1,
            'Thịt chao giềng' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items250k_2 as $name => $qty) {
            if ($it = $findItem($name)) {
                $set250k_2->items()->attach($it->id, ['quantity' => $qty]);
            }
        }
    }
}
