<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $taskNames = [
            'Design Wireframes',
            'Develop Backend',
            'Create Database',
            'Write Documentation',
            'Test Application',
        ];

        return [
            'name' => $this->faker->randomElement($taskNames),
            'description' => $this->faker->text(25),
            'project_id' => $this->faker->numberBetween(1, 4),
            'user_id' => $this->faker->numberBetween(1, 10),
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low', 'Critical', 'Urgent']),
            'category' => $this->faker->randomElement(['Technology', 'Healthcare', 'Education', 'Finance', 'Entertainment', 'Infrastructure']),
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done']),
            'implementation_date' => $this->faker->date(),
        ];
    }
}
