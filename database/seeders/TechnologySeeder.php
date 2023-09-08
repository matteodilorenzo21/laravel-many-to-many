<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => '#E5532D'],
            ['label' => 'CSS', 'color' => '#2D53E5'],
            ['label' => 'SASS', 'color' => '#CF6C9C'],
            ['label' => 'Javascript', 'color' => '#F7E025'],
            ['label' => 'VueJS', 'color' => '#47BA87'],
            ['label' => 'PHP', 'color' => '#7B7FB5'],
            ['label' => 'Laravel', 'color' => '#FF3427'],
            ['label' => 'SQL', 'color' => '#134462'],
            ['label' => 'Bootstrap', 'color' => '#6F2CF4'],
            ['label' => 'Blade', 'color' => '#FE080A'],
        ];

        foreach ($technologies as $technologyData) {
            $technology = new Technology();
            $technology->label = $technologyData['label'];
            $technology->color = $technologyData['color'];
            $technology->save();
        }
    }
}
