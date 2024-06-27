<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();

        \App\Models\Tag::factory(4)->create();

        \App\Models\Project::factory(3)->create();

        \App\Models\Task::factory(5)->create();
    }
}
