<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();

            $table->string('title');
            $table->text('description');

            $table->decimal('starting_price', 18, 8);
            $table->decimal('reserve_price', 18, 8)->nullable();
            $table->decimal('buy_now_price', 18, 8)->nullable();

            $table->timestamp('start_time');
            $table->timestamp('end_time');

            $table->string('status')->default('draft');
            $table->string('currency')->default('ETH');

            $table->string('blockchain_auction_id')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('start_time');
            $table->index('end_time');
            $table->index('currency');
            $table->index('blockchain_auction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
