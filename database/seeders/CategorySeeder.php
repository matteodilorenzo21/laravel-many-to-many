<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['label' => 'Front-end', 'color' => '#1B72E8'],
            ['label' => 'Back-end', 'color' => '#10131A'],
            ['label' => 'Full-stack', 'color' => '#291749'],
            ['label' => 'UX/UI', 'color' => '#3A546D'],
            ['label' => 'Mobile', 'color' => '#BF3500'],
            ['label' => 'E-commerce', 'color' => '#228B22'],
            ['label' => 'Back-office', 'color' => '#CE2111'],
        ];

        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->label = $categoryData['label'];
            $category->color = $categoryData['color'];
            $category->save();
        }
    }
}
