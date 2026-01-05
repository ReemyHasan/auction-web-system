<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => Str::slug('Electronics'),
        ]);

        Category::create([
            'name' => 'Phones',
            'slug' => Str::slug('Phones'),
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => 'Laptops',
            'slug' => Str::slug('Laptops'),
            'parent_id' => $electronics->id,
        ]);

        Category::create([
            'name' => 'Art',
            'slug' => Str::slug('Art'),
        ]);

        Category::create([
            'name' => 'Cars',
            'slug' => Str::slug('Cars'),
        ]);

        $asset = Category::create([
            'name' => 'Assets',
            'slug' => Str::slug('Assets'),
        ]);
        Category::create([
            'name' => 'House',
            'slug' => Str::slug('House'),
            'parent_id' => $asset->id,
        ]);
        Category::create([
            'name' => 'Land',
            'slug' => Str::slug('Land'),
            'parent_id' => $asset->id,
        ]);
        Category::create([
            'name' => 'Appartment',
            'slug' => Str::slug('Appartment'),
            'parent_id' => $asset->id,
        ]);
    }
}
