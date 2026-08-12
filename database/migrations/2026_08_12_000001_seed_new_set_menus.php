<?php

use App\Models\MenuItem;
use App\Models\SetMenu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();
        if ($driver === 'pgsql') {
            DB::statement('TRUNCATE TABLE set_menu_items CASCADE');
            DB::statement('TRUNCATE TABLE set_menus CASCADE');
        } else {
            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = OFF');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            }
            DB::table('set_menu_items')->truncate();
            SetMenu::truncate();
            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = ON');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            }
        }

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
            'Gà xáo gừng' => 1,
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
            'Thịt rang cháy cạnh' => 1,
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
            'description' => 'Mâm tiệc thượng hạng 250k/người bàn 6 gồm: Cá tầm rang muối, Ếch xào măng/Bò xào măng, Gà chiên mắm, Dê xào lăn/Dê chao, Thịt rang, Rau luộc, Cá thu sốt cà chua, Canh + Cơm.',
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
            'Thịt rang cháy cạnh' => 1,
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

    public function down(): void
    {
        //
    }
};
