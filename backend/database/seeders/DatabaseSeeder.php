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
        User::factory()->janedoe()->create();
        // Create additional users
        User::factory()->count(9)->create();

        // Create 5 projects
        Project::factory()->count(5)->create();

        // Create 5 tasks with randomly assigned user and project IDs
        Task::factory()->count(5)->create();
    }
}
