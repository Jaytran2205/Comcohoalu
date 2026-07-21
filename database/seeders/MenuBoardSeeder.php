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

        $targetDir = 'menu_boards';

        try {
            // 2. Clear old files in public storage directory
            Storage::disk('public')->deleteDirectory($targetDir);
            Storage::disk('public')->makeDirectory($targetDir);
        } catch (\Exception $e) {
            // Ignore filesystem errors on read-only environments
        }

        // 3. Source directory where the user uploaded the menu images
        $sourceDir = '/Users/vudovn/Desktop/project/quan-com/menu';

        if (File::isDirectory($sourceDir)) {
            // Get all files in source directory
            $files = File::files($sourceDir);
            
            // Sort files by name numerically (e.g. 1.jpg, 2.jpg... 9.jpg)
            usort($files, function ($a, $b) {
                $aName = pathinfo($a->getFilename(), PATHINFO_FILENAME);
                $bName = pathinfo($b->getFilename(), PATHINFO_FILENAME);
                return (int)$aName <=> (int)$bName;
            });

            if ($this->command) {
                $this->command->info("Tìm thấy " . count($files) . " trang menu ảnh. Bắt đầu sao chép...");
            }

            // 4. Copy each file and insert record
            foreach ($files as $index => $file) {
                $fileName = $file->getFilename();
                $targetPath = $targetDir . '/' . $fileName;

                try {
                    // Copy file to storage
                    File::copy($file->getRealPath(), Storage::disk('public')->path($targetPath));
                } catch (\Exception $e) {
                    // Ignore copy errors
                }

                // Create record
                MenuBoard::create([
                    'title' => 'Trang thực đơn ' . ($index + 1),
                    'image' => $targetPath,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);

                if ($this->command) {
                    $this->command->line("- Đã nạp: {$fileName} -> {$targetPath} (Thứ tự: " . ($index + 1) . ")");
                }
            }
        } else {
            // Fallback: Create records for files 1.jpg to 9.jpg
            if ($this->command) {
                $this->command->warn("Thư mục nguồn không tồn tại. Nạp danh sách thực đơn mặc định...");
            }
            for ($i = 1; $i <= 9; $i++) {
                MenuBoard::create([
                    'title' => 'Trang thực đơn ' . $i,
                    'image' => $targetDir . '/' . $i . '.jpg',
                    'sort_order' => $i,
                    'is_active' => true,
                ]);
            }
        }

        if ($this->command) {
            $this->command->info("Hoàn tất nạp thực đơn ảnh!");
        }
    }
}
