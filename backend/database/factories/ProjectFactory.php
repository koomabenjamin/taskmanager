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
            'Data Analysis',
            'Mobile App',
            'Cloud Computing',
            'Marketing Strategy',
            'Financial Planning',
            'Customer Service',
            'Product Development',
            'Environmental Sustainability',
            'Educational Platform',
            'Infrastructure Upgrade',
        ];

        return [
            'name' => $this->faker->randomElement($projectNames),
            'description' => $this->faker->text(25),
        ];
    }
}
