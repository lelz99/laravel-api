<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(Generator $faker): void
    {
        $labels = ['FrontEnd', 'BackEnd', 'FullStack'];

        foreach ($labels as $label) {

            $type = new Type();

            $type->label = $label;
            $type->slug = Str::slug($type->label);
            $type->color = $faker->hexColor();

            $type->save();
        }
    }
}
