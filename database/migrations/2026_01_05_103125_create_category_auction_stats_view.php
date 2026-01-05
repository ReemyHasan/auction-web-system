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
            CREATE VIEW category_auction_stats AS
            SELECT
                c.id,
                c.name,
                COUNT(a.id) AS total_auctions,
                SUM(CASE WHEN a.status = 'active' THEN 1 ELSE 0 END) AS active_auctions
            FROM categories c
            LEFT JOIN auctions a ON a.category_id = c.id
            GROUP BY c.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS category_auction_stats");
    }
};
