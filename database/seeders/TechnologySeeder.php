<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['label' => 'Html', 'color' => 'text-danger', 'icon' => 'fa-brands fa-html5' ],
            ['label' => 'Css', 'color' => 'text-primary', 'icon' => 'fa-brands fa-css3-alt' ],
            ['label' => 'Bootstrap', 'color' => 'text-primary', 'icon' => 'fa-brands fa-bootstrap' ],
            ['label' => 'Javascript', 'color' => 'text-warning', 'icon' => 'fa-brands fa-js' ],
            ['label' => 'Vuejs', 'color' => 'text-success', 'icon' => 'fa-brands fa-vuejs' ],
            ['label' => 'Php', 'color' => 'text-black', 'icon' => 'fa-brands fa-php' ],
            ['label' => 'Laravel', 'color' => 'text-danger', 'icon' => 'fa-brands fa-laravel' ],
        ];

        foreach($technologies as $technology){
            $new_technology = new Technology();
            $new_technology->fill($technology);
            $new_technology->save();
        }
    }
}
