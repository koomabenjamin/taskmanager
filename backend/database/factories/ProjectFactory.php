<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        $projectNames = [
            'Meridian',
            'Risen',
            'Skillex',
            'Statra Insurance'
        ];

        return [
            'name' => $this->faker->randomElement($projectNames),
        ];
    }
}
