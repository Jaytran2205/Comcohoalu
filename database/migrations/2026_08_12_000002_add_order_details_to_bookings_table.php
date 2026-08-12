<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('set_menu_id')->nullable()->after('children')->constrained('set_menus')->nullOnDelete();
            $table->unsignedSmallInteger('combo_quantity')->default(1)->after('set_menu_id');
            $table->json('ordered_items')->nullable()->after('combo_quantity');
            $table->unsignedBigInteger('estimated_total')->default(0)->after('ordered_items');
            $table->string('order_type', 30)->default('table_only')->after('estimated_total'); // table_only, combo, custom_dishes
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('set_menu_id');
            $table->dropColumn(['combo_quantity', 'ordered_items', 'estimated_total', 'order_type']);
        });
    }
};
