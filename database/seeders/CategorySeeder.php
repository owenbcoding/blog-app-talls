<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Lifestyle'],
            ['name' => 'Travel'],
            ['name' => 'Food'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

