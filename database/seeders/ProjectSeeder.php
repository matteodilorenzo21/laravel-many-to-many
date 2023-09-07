<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        // for ($i = 1; $i < 5; $i++) {
        //     $project = new Project();
        //     $project->title = $faker->text(50);
        //     $project->description = $faker->paragraph;
        //     $project->image = $faker->imageurl(250, 250);
        //     $project->url = $faker->url;
        //     $project->slug = Str::slug($project->title, '-');
        //     $project->completion_year = $faker->year;
        //     $project->technologies = $faker->words(3, true);
        //     $project->client = $faker->company;
        //     $project->project_duration = $faker->randomElement(['1 mese', '2 mesi', '3 mesi']);
        //     $project->save();
        // }
    }
}
