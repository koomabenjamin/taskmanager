<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Carbon\Carbon;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_fetch_all_tasks()
    {
        // Create test data
        $users = User::factory()->count(3)->create();
        $projects = Project::factory()->count(2)->create();

        // Create tasks with random assignments to users and projects
        Task::factory()->count(5)->create([
            'user_id' => $users->random()->id,
            'project_id' => $projects->random()->id,
        ]);

        // Authenticate as a user (doesn't matter which user)
        Sanctum::actingAs($users->first());

        // Make GET request to fetch tasks
        $response = $this->getJson('/api/v1/tasks/all');

        // // Output response content to inspect
        // $response->dump();

        // Assert response status
        $response->assertStatus(200);

        // Assert JSON structure for all tasks (regardless of assignment)
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id', 'name', 'description', 'project_id', 'user_id',
                    'priority', 'category', 'status', 'implementation_date',
                    'created_at', 'updated_at',
                    'project' => [
                        'id', 'name', 'created_at', 'updated_at'
                    ],
                    'user' => [
                        'id', 'name', 'email', 'email_verified_at',
                        'created_at', 'updated_at'
                    ]
                ]
            ]
        ]);
    }

    public function test_authenticated_user_can_store_task()
    {
        // Create test data
        $projects = Project::factory()->count(5)->create();
        $users = User::factory()->count(5)->create();

        // Randomly select a project and user for the task
        $project = $projects->random();
        $user = $users->random();

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

        // Authenticate as a user
        Sanctum::actingAs($user);

        // Make POST request to store task
        $response = $this->postJson('/api/v1/tasks/create', $data);

        // Assert response status and structure
        $response->assertStatus(201)
        ->assertJson([
            'message' => 'Task created successfully',
            'data' => [
                'name' => 'Test Task',
                'description' => 'This is a test task.',
                'project_id' => $project->id,
                'user_id' => $user->id,
                'priority' => 'High',
                'category' => 'Technology',
                'status' => 'todo',
                'implementation_date' => $data['implementation_date'],
                'created_at' => $response['data']['created_at'],
                'updated_at' => $response['data']['updated_at'],
                'id' => $response['data']['id'],
            ],
        ]);
    }

    public function test_authenticated_user_can_update_task()
    {
        // Create a task with project and user
        $project = Project::factory()->create();
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'project_id' => $project->id,
            'user_id' => $user->id
        ]);

        // Authenticate as the user
        Sanctum::actingAs($user);

        // Data to be sent with the request (update only description and status)
        $data = [
            'description' => 'Updated description.',
            'status' => 'in_progress',
        ];

        // Make PUT request to update task
        $response = $this->putJson("/api/v1/tasks/{$task->id}/update", $data);

        // Assert response status and updated data
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Task updated successfully',
            'data' => [
                'id' => $task->id,
                'name' => $task->name, // Keeping the original name
                'description' => 'Updated description.',
                'project_id' => $project->id,
                'user_id' => $user->id,
                'priority' => $task->priority, // Keeping th original priority
                'status' => 'in_progress',
                'implementation_date' => $task->implementation_date,
                'created_at' => $response['data']['created_at'],
                'updated_at' => $response['data']['updated_at'],
                'deleted_at' => $task->deleted_at,
            ],
        ]);
    }

    public function test_authenticated_user_can_delete_task()
    {
        // Create a task with project and user
        $project = Project::factory()->count(2)->create();
        $user = User::factory()->count(4)->create();
        $task = Task::factory()->count(5)->create([
            'project_id' => $project->first()->id,
            'user_id' => $user->first()->id,
        ])->first(); // tEsting with the first task created for simplicity
    
        // Authenticate as the user
        Sanctum::actingAs($user->first());
    
        // Make DELETE request to delete the task
        $response = $this->deleteJson("/api/v1/tasks/{$task->id}/delete");
    
        // Assert response status and message
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Task deleted successfully',
                 ]);
    }

    public function test_authenticated_user_can_show_deleted_tasks()
    {
        // Create a deleted task with project and user
        $project = Project::factory()->count(2)->create();
        $user = User::factory()->count(4)->create();
        $deletedTask = Task::factory()->create([
            'project_id' => $project->first()->id,
            'user_id' => $user->first()->id,
            'deleted_at' => now()->subDay(),  // Any deleted task has this value
        ]);

        // Authenticate as the user
        Sanctum::actingAs($user->first());

        // Make GET request to show deleted tasks
        $response = $this->getJson('/api/v1/tasks/trashed/temp');

        // Assert response status and structure
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Trashed tasks retrieved successfully',
            'data' => [
                [
                    'id' => $deletedTask->id,
                    'name' => $deletedTask->name,
                    'description' => $deletedTask->description,
                    'project_id' => $deletedTask->project_id,
                    'user_id' => $deletedTask->user_id,
                    'priority' => $deletedTask->priority,
                    'category' => $deletedTask->category,
                    'status' => $deletedTask->status,
                    'implementation_date' => $deletedTask->implementation_date,
                    'created_at' => $deletedTask->created_at->toISOString(),
                    'updated_at' => $deletedTask->updated_at->toISOString(),
                    'deleted_at' => $deletedTask->deleted_at->toISOString(),
                ],
            ],
        ]);
    }

    public function test_authenticated_user_can_restore_deleted_task()
    {
        // Create a deleted task with project and user
        $project = Project::factory()->count(2)->create();
        $user = User::factory()->count(4)->create();
        $deletedTask = Task::factory()->create([
            'project_id' => $project->first()->id,
            'user_id' => $user->first()->id,
            'deleted_at' => now()->subDay(),
        ]);

        // Authenticate as the user
        Sanctum::actingAs($user->first());

        // Make POST request to restore the task
        $response = $this->postJson("/api/v1/tasks/trashed/temp/{$deletedTask->id}/restore");

        // Assert response status and message
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Task restored successfully.',
                ]);
    }

    public function test_authenticated_user_can_restore_all_deleted_tasks()
    {
        // Create multiple deleted tasks with project and user
        $project = Project::factory()->count(2)->create();
        $user = User::factory()->count(4)->create();
        $deletedTasks = Task::factory()->count(5)->create([
            'project_id' => $project->first()->id,
            'user_id' => $user->first()->id,
            'deleted_at' => now()->subDay(),
        ]);

        // Authenticate as the user
        Sanctum::actingAs($user->first());

        // Make POST request to restore all deleted tasks
        $response = $this->postJson('/api/v1/tasks/trashed/temp/restore-all');

        // Assert response status and message
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'All tasks restored successfully',
                ]);
    }

    public function test_authenticated_user_can_fetch_tasks_past_implementation_date()
    {
        // Create users and authenticate the first user with Sanctum
        $users = User::factory()->count(4)->create();
        Sanctum::actingAs($users->first());
    
        // Create a project
        $project = Project::factory()->create();
    
        // Create 2 tasks with different implementation dates in the past
        $tasksPast = [
            Task::factory()->create([
                'project_id' => $project->id,
                'user_id' => $users->first()->id,
                'implementation_date' => now()->subDays(10), // Past date- 10 day(s) ago
            ]),
            Task::factory()->create([
                'project_id' => $project->id,
                'user_id' => $users->first()->id,
                'implementation_date' => now()->subDays(400), // Past date- 400 day(s) ago
            ])
        ];
    
        // Create 3 tasks with different implementation dates in the future
        $tasksFuture = [
            Task::factory()->create([
                'project_id' => $project->id,
                'user_id' => $users->first()->id,
                'implementation_date' => now()->addDays(3), // Future date- 3 days from today
            ]),
            Task::factory()->create([
                'project_id' => $project->id,
                'user_id' => $users->first()->id,
                'implementation_date' => now()->addDays(4), // Future date- 4 days from today
            ]),
            Task::factory()->create([
                'project_id' => $project->id,
                'user_id' => $users->first()->id,
                'implementation_date' => now()->addDays(5), // Future date- 5 days from today
            ])
        ];
    
        // Call the endpoint
        $response = $this->getJson('/api/v1/tasks/past-implementation');
    
        // Assert response status and structure
        $response->assertStatus(200)
        ->assertJson([
            'message' => 'Tasks past implementation date retrieved successfully',
            'data' => [
                [
                    'id' => $tasksPast[0]->id,
                    'name' => $tasksPast[0]->name,
                    'description' => $tasksPast[0]->description,
                    'project_id' => $tasksPast[0]->project_id,
                    'user_id' => $tasksPast[0]->user_id,
                    'priority' => $tasksPast[0]->priority,
                    'category' => $tasksPast[0]->category,
                    'status' => $tasksPast[0]->status,
                    'implementation_date' => $tasksPast[0]->implementation_date->toDateString(),
                    'created_at' => $tasksPast[0]->created_at->toISOString(),
                    'updated_at' => $tasksPast[0]->updated_at->toISOString(),
                    'deleted_at' => $tasksPast[0]->deleted_at,
                ],
                [
                    'id' => $tasksPast[1]->id,
                    'name' => $tasksPast[1]->name,
                    'description' => $tasksPast[1]->description,
                    'project_id' => $tasksPast[1]->project_id,
                    'user_id' => $tasksPast[1]->user_id,
                    'priority' => $tasksPast[1]->priority,
                    'category' => $tasksPast[1]->category,
                    'status' => $tasksPast[1]->status,
                    'implementation_date' => $tasksPast[1]->implementation_date->toDateString(),
                    'created_at' => $tasksPast[1]->created_at->toISOString(),
                    'updated_at' => $tasksPast[1]->updated_at->toISOString(),
                    'deleted_at' => $tasksPast[1]->deleted_at,
                ],
            ],
        ]);
    }
}
