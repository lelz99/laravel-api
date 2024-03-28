<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Technology;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->text(20);

        Storage::makeDirectory('project_images');
        $img = fake()->image(null, 360, 250);
        $img_url = Storage::putFile('project_images', $img);

        $types_ids = Type::pluck('id')->toArray();
        $types_ids[] = null;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraphs(5, true),
            'preview_project' => $img_url,
            'end_date' => fake()->date(),
            'is_published' => fake()->boolean(),
            'type_id' => Arr::random($types_ids)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Project $project){
            $technology_ids = Technology::pluck('id')->toArray();
            $project->technologies = array_filter($technology_ids, fn() => rand(0,1));
            $project->technologies()->attach($project->technologies);
        });
    }
}
