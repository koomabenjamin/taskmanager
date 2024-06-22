<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase; // Refresh database for each test method

    public function test_can_fetch_all_tasks()
    {
        // Create test data
        Task::factory()->count(5)->create();

        // Make GET request to fetch tasks
        $response = $this->getJson('/api/v1/tasks/all');

        // Assert response status and structure
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['name', 'description', 'project_id', 'user_id', 'priority', 'category', 'status', 'implementation_date', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_store_task()
    {
        // Create test data
        $project = Project::factory()->count(5)->create();
        $user = User::factory()->count(5)->create();

        // Data to be sent with the request
        $data = [
            'name' => 'Test Task',
            'description' => 'This is a test task.',
            'project_id' => $project->id,
            'user_id' => $user->id,
            'priority' => 'High',
            'category' => 'Technology',
            'status' => 'todo',
            'implementation_date' => now()->addDays(7)->format('Y-m-d'),
        ];

        // Make POST request to store task
        $response = $this->postJson('/api/v1/tasks/create', $data);

        // Assert response status and structure
        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Test Task',
                     'description' => 'This is a test task.',
                     'project_id' => $project->id,
                     'user_id' => $user->id,
                     'priority' => 'High',
                     'category' => 'Technology',
                     'status' => 'todo',
                     'implementation_date' => $data['implementation_date'],
                 ]);
    }

    public function test_can_update_task()
    {
        // Create a task with project and user
        $project = Project::factory()->count(5)->create();
        $user = User::factory()->count(5)->create();
        $task = Task::factory()->count(5)->create([
            'project_id' => $project->id,
            'user_id' => $user->id
        ]);

        // Data to be sent with the request
        $data = [
            'name' => 'Updated Task Name',
            'description' => 'Updated description.',
            'priority' => 'Medium',
            'status' => 'in_progress',
        ];

        // Make PUT request to update task
        $response = $this->putJson("/api/v1/tasks/{$task->id}/update", $data);

        // Assert response status and updated data
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $task->id,
                     'name' => 'Updated Task Name',
                     'description' => 'Updated description.',
                     'priority' => 'Medium',
                     'status' => 'in_progress',
                 ]);
    }

    public function test_can_delete_task()
    {
        // Create a task with project and user
        $project = Project::factory()->count(5)->create();
        $user = User::factory()->count(5)->create();
        $task = Task::factory()->count(5)->create([
            'project_id' => $project->id,
            'user_id' => $user->id
        ]);

        // Make DELETE request to delete task
        $response = $this->deleteJson("/api/v1/tasks/{$task->id}/delete");

        // Assert response status
        $response->assertStatus(204);

        // Assert that task is soft deleted from the database
        $this->assertSoftDeleted('tasks', ['id' => $task->id]);

        // Retrieve the soft deleted task
        $deletedTask = Task::withTrashed()->find($task->id);

        // Assert that the deleted task exists (soft deleted)
        $this->assertNotNull($deletedTask);

        // Restore the soft deleted task (optional)
        // $deletedTask->restore();
    }
}
