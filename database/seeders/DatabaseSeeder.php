<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Thứ tự: Users → Settings → Menu → Posts (vì Posts cần author_id từ Users)
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            MenuSeeder::class,
            PostSeeder::class,
        ]);
    }
}
