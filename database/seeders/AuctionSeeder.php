<?php

namespace Database\Seeders;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $electronics = Category::where('slug', 'electronics')->first();
        $phones = Category::where('slug', 'phones')->first();
        $laptops = Category::where('slug', 'laptops')->first();
        $cars = Category::where('slug', 'cars')->first();
        $art = Category::where('slug', 'art')->first();

        Auction::insert([
            [
                'user_id' => $user->id,
                'category_id' => $electronics->id,
                'title' => 'Smart TV 55"',
                'description' => '4K UHD Smart TV, barely used.',
                'starting_price' => 0.8,
                'start_time' => now(),
                'end_time' => now()->addDays(7),
                'status' => AuctionStatus::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $phones->id,
                'title' => 'iPhone 14 Pro',
                'description' => 'Excellent condition, full box.',
                'starting_price' => 1.1,
                'start_time' => now(),
                'end_time' => now()->addDays(5),
                'status' => AuctionStatus::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $laptops->id,
                'title' => 'MacBook Air M2',
                'description' => 'Light usage, perfect battery health.',
                'starting_price' => 1.4,
                'start_time' => now(),
                'end_time' => now()->addDays(6),
                'status' => AuctionStatus::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $cars->id,
                'title' => 'BMW 320i 2018',
                'description' => 'Well maintained, low mileage.',
                'starting_price' => 8.5,
                'start_time' => now(),
                'end_time' => now()->addDays(10),
                'status' => AuctionStatus::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $art->id,
                'title' => 'Modern Art Painting',
                'description' => 'Original hand-painted artwork.',
                'starting_price' => 2.0,
                'start_time' => now(),
                'end_time' => now()->addDays(4),
                'status' => AuctionStatus::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
