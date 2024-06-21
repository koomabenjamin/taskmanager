<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_project()
    {
        $response = $this->postJson('/api/projects', [
            'name' => 'Test Project',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'Test Project']);
    }

    public function test_can_show_project()
    {
        $project = Project::factory()->create();

        $response = $this->getJson('/api/projects/'.$project->id);

        $response->assertStatus(200)
                 ->assertJson(['name' => $project->name]);
    }

    public function test_can_list_projects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_delete_project()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson('/api/projects/'.$project->id);

        $response->assertStatus(204);

        $this->assertSoftDeleted('projects', ['id' => $project->id]);
    }
}
