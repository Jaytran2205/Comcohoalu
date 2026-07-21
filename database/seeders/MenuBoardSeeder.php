<?php

namespace Database\Seeders;

use App\Models\MenuBoard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MenuBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Truncate existing menu boards in DB
        MenuBoard::truncate();

        // 2. Clear old files in public storage directory
        $targetDir = 'menu_boards';
        Storage::disk('public')->deleteDirectory($targetDir);
        Storage::disk('public')->makeDirectory($targetDir);

        // 3. Source directory where the user uploaded the menu images
        $sourceDir = '/Users/vudovn/Desktop/project/quan-com/menu';

        if (!File::isDirectory($sourceDir)) {
            $this->command->error("Thư mục nguồn không tồn tại: {$sourceDir}");
            return;
        }

        // Get all files in source directory
        $files = File::files($sourceDir);
        
        // Sort files by name numerically (e.g. 1.jpg, 2.jpg... 9.jpg)
        usort($files, function ($a, $b) {
            $aName = pathinfo($a->getFilename(), PATHINFO_FILENAME);
            $bName = pathinfo($b->getFilename(), PATHINFO_FILENAME);
            return (int)$aName <=> (int)$bName;
        });

        $this->command->info("Tìm thấy " . count($files) . " trang menu ảnh. Bắt đầu sao chép...");

        // 4. Copy each file and insert record
        foreach ($files as $index => $file) {
            $fileName = $file->getFilename();
            $targetPath = $targetDir . '/' . $fileName;

            // Copy file to storage
            File::copy($file->getRealPath(), Storage::disk('public')->path($targetPath));

            // Create record
            MenuBoard::create([
                'title' => 'Trang thực đơn ' . ($index + 1),
                'image' => $targetPath,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            $this->command->line("- Đã nạp: {$fileName} -> {$targetPath} (Thứ tự: " . ($index + 1) . ")");
        }

        $this->command->info("Hoàn tất nạp thực đơn ảnh!");
    }
}
