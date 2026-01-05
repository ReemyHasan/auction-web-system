<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW auction_views AS
            SELECT
                a.id,
                a.title,
                a.status,
                a.start_time,
                a.end_time,
                a.starting_price,
                ai.image_path AS primary_image,
                u.name AS seller_name,
                c.name AS category_name
            FROM auctions a
            JOIN auction_images ai ON a.id = ai.auction_id AND ai.is_primary = true
            JOIN users u ON u.id = a.user_id
            JOIN categories c ON c.id = a.category_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS auction_views");
    }
};
