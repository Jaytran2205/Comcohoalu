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
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('TRUNCATE TABLE set_menu_items CASCADE');
            DB::statement('TRUNCATE TABLE menu_items CASCADE');
            DB::statement('TRUNCATE TABLE menu_categories CASCADE');
            DB::statement('TRUNCATE TABLE set_menus CASCADE');
        } else {
            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = OFF');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            }

            DB::table('set_menu_items')->truncate();
            MenuItem::truncate();
            MenuCategory::truncate();
            SetMenu::truncate();

            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = ON');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            }
        }

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
        $catThit = MenuCategory::create(['name' => 'Món Thịt Lợn', 'slug' => 'mon-thit-lon', 'icon' => 'fa-drumstick-bite', 'sort_order' => 10]);
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

        // Khai vị (Ảnh 4)
        $createItem($catKhaiVi->id, 'Khoai tây chiên', 60000, 'Khoai tây cắt lát chiên giòn rụm thơm béo.', 1);
        $createItem($catKhaiVi->id, 'Ngô chiên bơ', 60000, 'Hạt ngô ngọt chiên giòn tẩm bơ thơm nức.', 2);
        $createItem($catKhaiVi->id, 'Khoai Lệ Phố', 60000, 'Khoai môn Lệ Phố bùi ngọt, chiên giòn đặc sản.', 3);

        // Món Bò (Ảnh 4)
        $createItem($catBo->id, 'Bò xào ngồng tỏi', 200000, 'Thịt bò mềm xào cùng ngồng tỏi xanh giòn ngọt.', 1, 'none', true);
        $createItem($catBo->id, 'Bò xào măng trúc', 200000, 'Thịt bò xào măng trúc Yên Tử thơm ngon, giòn sần sật.', 2);
        $createItem($catBo->id, 'Bò xào hành tây', 200000, 'Thịt bò xào hành tây ngọt thơm vị truyền thống.', 3);
        $createItem($catBo->id, 'Gỏi bò kéo pháo', 220000, 'Gỏi bò trộn thính và rau thơm chua ngọt đậm đà vị Cố Đô.', 4, 'best_seller', true);
        $createItem($catBo->id, 'Sách bò xào dứa', 200000, 'Sách bò giòn sần sật xào dứa chua ngọt đậm vị.', 5);

        // Món Hải Sản (Ảnh 4)
        $createItem($catHaiSan->id, 'Mực xào thập cẩm', 250000, 'Mực tươi xào rau củ thập cẩm thanh ngọt mát bổ.', 1);
        $createItem($catHaiSan->id, 'Mực chiên bơ', 250000, 'Mực tươi tẩm bột chiên bơ giòn rụm béo ngậy.', 2, 'best_seller', true);
        $createItem($catHaiSan->id, 'Cá thu sốt cà chua', 230000, 'Cá thu nướng thơm sốt cà chua đậm đà hao cơm.', 3);

        // Đậu Phụ - Trứng (Món phụ hỗ trợ)
        $createItem($catDauTrung->id, 'Đậu tẩm hành', 60000, 'Đậu rán giòn nhúng mắm hành truyền thống.', 1);
        $createItem($catDauTrung->id, 'Đậu sốt cà chua', 60000, 'Đậu phụ rán sốt cà chua đậm đà hương vị quê hương.', 2);
        $createItem($catDauTrung->id, 'Đậu lướt ván', 50000, 'Đậu phụ lướt ván ngoài giòn trong mềm mịn ngậy béo.', 3);
        $createItem($catDauTrung->id, 'Trứng rán', 60000, 'Trứng gà ta rán vàng ươm, thơm ngậy béo.', 4);

        // Món Rau - Canh (Món phụ hỗ trợ)
        $createItem($catRauCanh->id, 'Củ quả luộc', 60000, 'Củ quả luộc thập cẩm chấm kho quẹt đậm đà.', 1);
        $createItem($catRauCanh->id, 'Rau muống xào tỏi', 60000, 'Rau muống xào tỏi xanh giòn, thơm lừng.', 2);
        $createItem($catRauCanh->id, 'Canh cua + Cà gém', 70000, 'Canh cua đồng nấu rau đay mồng tơi ăn kèm cà pháo giòn rụm.', 3, 'best_seller', true);
        $createItem($catRauCanh->id, 'Canh ngao chua', 70000, 'Canh ngao nấu dứa thanh mát giải nhiệt ngày hè.', 4);
        $createItem($catRauCanh->id, 'Bắp cải luộc', 60000, 'Rau bắp cải luộc chấm trứng dầm nước tương.', 5);

        // Món Cá (Ảnh 2)
        $createItem($catCa->id, 'Cá chuối kho tộ', 120000, 'Cá quả chuối kho niêu đất đậm đà hương vị đồng quê.', 1, 'best_seller', true);
        $createItem($catCa->id, 'Cá chép giòn xào ngồng tỏi', 200000, 'Cá chép giòn thái lát xào ngồng tỏi giòn sần sật ngọt lịm.', 2);
        $createItem($catCa->id, 'Cá chép giòn xào cần', 200000, 'Cá chép giòn xào cần tỏi tây thơm lừng đậm đà.', 3);
        $createItem($catCa->id, 'Cá tầm rang muối', 240000, 'Cá tầm cắt khúc rang muối giòn tan thơm bùi đặc sắc.', 4, 'specialty', true);
        $createItem($catCa->id, 'Cá tầm chao giềng', 240000, 'Cá tầm ướp riềng nghệ chao dầu giòn rụm đậm hương quê.', 5);
        $createItem($catCa->id, 'Cá chạch kho niêu đất (Đặc biệt)', 180000, 'Cá chạch đồng kho mục xương trong niêu đất truyền thống.', 6, 'specialty', true);

        // Tôm - Cua - Ốc - Ếch (Ảnh 2)
        $createItem($catTomCuaOcEch->id, 'Tôm đồng rang', 110000, 'Tôm đồng rang cháy cạnh giòn ngọt mặn mà.', 1);
        $createItem($catTomCuaOcEch->id, 'Tôm đồng chao lá chanh', 120000, 'Tôm đồng chao giòn rụm thơm nức mùi lá chanh.', 2);
        $createItem($catTomCuaOcEch->id, 'Cua rang muối', 150000, 'Cua đồng rang muối khô giòn tan thơm ngậy bổ dưỡng.', 3);
        $createItem($catTomCuaOcEch->id, 'Chả ốc', 130000, 'Chả ốc nhồi lá lốt hấp hoặc nướng giòn sần sật.', 4, 'best_seller', true);
        $createItem($catTomCuaOcEch->id, 'Ếch rang muối', 180000, 'Thịt ếch đồng chiên giòn lắc muối thơm bùi ngậy.', 5);
        $createItem($catTomCuaOcEch->id, 'Ếch xào măng', 180000, 'Ếch xào măng củ chua cay đậm đà cực kỳ hao cơm.', 6);

        // Dê Núi Ninh Bình (Ảnh 1)
        $createItem($catDeNui->id, 'Tiết canh dê (Đặt trước)', 50000, 'Tiết canh dê núi sạch sẽ chuẩn vị Ninh Bình.', 1);
        $createItem($catDeNui->id, 'Dê tái chanh', 269000, 'Dê núi thái mỏng chần tái bóp chanh, vừng, sả gừng thanh mát.', 2, 'specialty', true);
        $createItem($catDeNui->id, 'Dê xào lăn', 269000, 'Thịt dê xào lăn cốt dừa sả ớt đậm vị béo ngậy.', 3);
        $createItem($catDeNui->id, 'Dê chao mắc mật', 269000, 'Thịt dê thái quân cờ chao giòn cùng lá mắc mật thơm lừng.', 4, 'specialty', true);
        $createItem($catDeNui->id, 'Dê cuốn mỡ chài', 250000, 'Dê băm viên cuốn mỡ chài nướng than hoa ngậy béo.', 5);
        $createItem($catDeNui->id, 'Dê hấp tương bần', 269000, 'Dê hấp gừng sả chấm tương bần truyền thống ngọt mềm.', 6);
        $createItem($catDeNui->id, 'Dê hấp tía tô', 269000, 'Thịt dê hấp tía tô thơm lừng ngọt nước ăn nóng.', 7);
        $createItem($catDeNui->id, 'Dê ủ trấu', 299000, 'Đặc sản Dê ủ trấu da giòn thịt đỏ hồng ngọt đậm.', 8, 'specialty', true);
        $createItem($catDeNui->id, 'Sốt dê cơm cháy', 150000, 'Nước sốt thịt dê sền sệt ăn kèm cơm cháy Ninh Bình giòn tan.', 9, 'best_seller', true);
        $createItem($catDeNui->id, 'Lòng dê xào dứa', 150000, 'Lòng dê làm sạch xào dứa chua ngọt giòn sần sật.', 10);
        $createItem($catDeNui->id, 'Chân dê hầm thuốc bắc', 150000, 'Chân dê hầm thuốc bắc bổ dưỡng, nước dùng ngọt thanh.', 11);
        $createItem($catDeNui->id, 'Lẩu dê nhúng mẻ', 800000, 'Nồi lẩu dê chua thanh vị mẻ ăn kèm rau sống.', 12);
        $createItem($catDeNui->id, 'Lẩu dê thuốc bắc (Đặc biệt)', 800000, 'Lẩu dê hầm thuốc bắc bổ dưỡng thích hợp cho gia đình.', 13, 'specialty', true);

        // Lẩu Đồng Quê (Món phụ hỗ trợ)
        $createItem($catLau->id, 'Lẩu riêu cua thập cẩm', 800000, 'Lẩu riêu cua đồng gạch xịn kèm sườn sụn, đậu rán, giò tai.', 1, 'best_seller', true);
        $createItem($catLau->id, 'Lẩu riêu cua bắp bò', 800000, 'Lẩu riêu cua nhiều gạch cua chưng thơm ăn cùng thịt bắp bò u.', 2);
        $createItem($catLau->id, 'Lẩu ếch măng', 600000, 'Ếch đồng xào măng chua cay nhúng lẩu giòn đậm đà.', 3);
        $createItem($catLau->id, 'Lẩu cá tầm', 800000, 'Lẩu cá tầm tươi sống chua cay kiểu Tây Bắc sần sật giòn.', 4);

        // Món Thịt Lợn (Ảnh 5)
        $createItem($catThit->id, 'Thịt chao giềng', 130000, 'Thịt heo tẩm riềng nghệ chiên chao dầu vàng giòn thơm.', 1);
        $createItem($catThit->id, 'Thịt rang', 120000, 'Thịt ba chỉ rang cháy cạnh giòn ngọt mỡ hành.', 2);
        $createItem($catThit->id, 'Sườn xào chua ngọt', 140000, 'Sườn heo xào chua ngọt sốt sánh quyện mềm ngon đậm vị.', 3);
        $createItem($catThit->id, 'Thịt trưng mắm tép (Đặc biệt)', 120000, 'Thịt heo băm xào mắm tép chưng đặc sản Ninh Bình.', 4, 'specialty', true);
        $createItem($catThit->id, 'Nầm chiên mắm', 180000, 'Nầm chiên nước mắm tỏi ớt giòn sần sật béo ngậy.', 5);

        // Món Gà (Ảnh 5)
        $createItem($catGa->id, 'Gà xào gừng', 250000, 'Thịt gà rang gừng sả vị truyền thống quê hương ấm nồng.', 1);
        $createItem($catGa->id, 'Gà rang muối', 250000, 'Gà ta chặt khúc lắc muối giòn tan thơm ngon.', 2);
        $createItem($catGa->id, 'Gà luộc (Đặt trước)', 450000, 'Thịt gà luộc chấm lá chanh giòn ngọt đậm đà.', 3);
        $createItem($catGa->id, 'Gà quay (Đặt trước)', 450000, 'Gà quay thơm lừng giòn da ngọt thịt thơm phức.', 4);
        $createItem($catGa->id, 'Gà chiên mắm', 250000, 'Thịt gà ta chiên nước mắm tỏi giòn ngọt đậm đà.', 5);
        $createItem($catGa->id, 'Cánh gà chiên mắm', 220000, 'Cánh gà chiên nước mắm tỏi giòn rụm béo ngậy.', 6);
        $createItem($catGa->id, 'Cánh gà rang muối', 220000, 'Cánh gà lắc muối giòn thơm đậm đà.', 7);

        // Cơm - Mì (Món phụ hỗ trợ)
        $createItem($catComMi->id, 'Cơm trắng', 20000, 'Cơm trắng gạo tám dẻo thơm ăn kèm món kho.', 1);
        $createItem($catComMi->id, 'Cơm niêu cháy', 50000, 'Cơm niêu đất nung than hồng cháy giòn rụm vàng ươm.', 2, 'specialty', true);


        // ── 3. Populate Set Menus ──

        // Helper to find item by name
        $findItem = function($name) {
            $item = MenuItem::where('name', 'like', "%{$name}%")->first();
            if (!$item) {
                $slug = Str::slug($name);
                $item = MenuItem::where('slug', $slug)->first();
            }
            return $item;
        };

        // --- 1. Set 200K (Đầu tiên) ---
        $set200k = SetMenu::create([
            'name' => 'Combo 200k/người/bàn 6 - Set 1',
            'slug' => 'combo-200k-nguoi-ban-6-set-1',
            'description' => 'Mâm cơm đặc sản 200k/người bàn 6 gồm: Dê tái chanh/xào lăn, Gà xào gừng, Cá chép giòn xào ngồng tỏi, Cá chuối kho tộ, Sườn xào, Củ quả luộc, Canh ngao, Cơm trắng.',
            'people_count' => 6,
            'price_per_person' => 200000,
            'image' => 'images/set-menus/set-200k.jpg',
            'is_active' => true,
            'sort_order' => 1
        ]);
        $items200k = [
            'Dê tái chanh' => 1,
            'Gà xào gừng' => 1,
            'Cá chép giòn xào ngồng tỏi' => 1,
            'Cá chuối kho tộ' => 1,
            'Sườn xào chua ngọt' => 1,
            'Củ quả luộc' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items200k as $name => $qty) {
            if ($it = $findItem($name)) {
                $set200k->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- 2. Set 150K (Tiếp theo) ---
        $set150k = SetMenu::create([
            'name' => 'Combo 150k/người/bàn 6 - Set 1',
            'slug' => 'combo-150k-nguoi-ban-6-set-1',
            'description' => 'Mâm cơm truyền thống gia đình 150k/người bàn 6 gồm: Bò xào măng trúc, Thịt rang, Đậu sốt cà chua, Ếch rang muối, Bắp cải luộc, Trứng rán, Cơm trắng, Canh cua.',
            'people_count' => 6,
            'price_per_person' => 150000,
            'image' => 'images/set-menus/set-150k.jpg',
            'is_active' => true,
            'sort_order' => 2
        ]);
        $items150k = [
            'Bò xào măng trúc' => 1,
            'Thịt rang' => 1,
            'Đậu sốt cà chua' => 1,
            'Ếch rang muối' => 1,
            'Bắp cải luộc' => 1,
            'Trứng rán' => 1,
            'Cơm trắng' => 2,
            'Canh cua + Cà gém' => 1,
        ];
        foreach ($items150k as $name => $qty) {
            if ($it = $findItem($name)) {
                $set150k->items()->attach($it->id, ['quantity' => $qty]);
            }
        }

        // --- 3. Set 250K (Tiếp theo) ---
        $set250k = SetMenu::create([
            'name' => 'Combo 250k/người/bàn 6 - Set 1',
            'slug' => 'combo-250k-nguoi-ban-6-set-1',
            'description' => 'Mâm tiệc thượng hạng 250k/người bàn 6 gồm: Cá tầm rang muối, Ếch xào măng, Gà chiên mắm, Dê xào lăn, Thịt rang, Củ quả luộc, Cá thu sốt cà chua, Canh ngao, Cơm trắng.',
            'people_count' => 6,
            'price_per_person' => 250000,
            'image' => 'images/set-menus/set-250k.jpg',
            'is_active' => true,
            'sort_order' => 3
        ]);
        $items250k = [
            'Cá tầm rang muối' => 1,
            'Ếch xào măng' => 1,
            'Gà chiên mắm' => 1,
            'Dê xào lăn' => 1,
            'Thịt rang' => 1,
            'Củ quả luộc' => 1,
            'Cá thu sốt cà chua' => 1,
            'Canh ngao chua' => 1,
            'Cơm trắng' => 2,
        ];
        foreach ($items250k as $name => $qty) {
            if ($it = $findItem($name)) {
                $set250k->items()->attach($it->id, ['quantity' => $qty]);
            }
        }
    }
}
