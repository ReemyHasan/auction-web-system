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
        Schema::create('blockchain_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('tx_hash')->unique();
            $table->string('tx_type'); // (bid, refund, finalize)
            $table->decimal('amount', 18, 8);
            $table->string('status');
            $table->unsignedBigInteger('block_number')->nullable();

            $table->timestamps();
            $table->index('auction_id');
            $table->index('user_id');
            $table->index('tx_type');
            $table->index('status');
            $table->index('block_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blockchain_transactions');
    }
};
