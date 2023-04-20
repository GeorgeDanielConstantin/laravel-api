<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 40; $i++) {
            $project = new Project;
            $project->title = $faker-> catchPhrase(30);
            $project->slug = Str::of($project->title)->slug('-');
            // $project->image = $faker->imageUrl(640, 480, 'homepage', true);
            $project->text = $faker->paragraph(15);
            $project->save();
        }
    }
}
