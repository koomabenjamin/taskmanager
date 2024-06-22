<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 users, ensuring the first user has a specific email and password

        // First user
        User::factory()->janedoe()->create();
        // Create additional users
        User::factory()->count(9)->create();

        // Explicitly create the 4 predefined projects
        $projects = [
            ['name' => 'Meridian'],
            ['name' => 'Risen'],
            ['name' => 'Skillex'],
            ['name' => 'Statra Insurance'],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Create 5 tasks with randomly assigned user and project IDs
        Task::factory()->count(5)->create();
    }
}
