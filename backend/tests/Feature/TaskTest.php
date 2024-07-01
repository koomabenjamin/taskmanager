<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Support\Str;
use Tests\Feature\factory;

class TaskTest extends TestCase
{
    private function login()
    {
        if ($this->isAuthenticated()) return $this->isAuthenticated();

        //login the user
        $this->postJson('/api/login', [
            'email' => 'admin@projectcode.ug',
            'password' => 'P@ssw0rd',
        ]);
    }

    private function createRecord()
    {
        return $this->postJson('/api/tasks', [
            "project_id" => 1,
            "name" => "test project",
            "color" => "bg-purple-600",
            "priority_id" => 1,
            "category_id" => 1,
            "status_id" => 1,
            "start_date" => "2024-06-27",
            "end_date" => "2024-07-05",
            "description" => "test project description",
            "member_user_ids" => [
                1
            ]
        ]);
    }

    private function deleteRecord($id)
    {
        return $this->deleteJson('/api/tasks/' . $id);
    }

    public function test_user_can_create_priority()
    {
        $this->login();

        $this->assertAuthenticated();

        //create the record
        $response = $this->createRecord();

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );

        // delete the record
        $response = $this->deleteRecord($response["data"]["id"]);
        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );
    }

    public function test_user_can_delete_priority()
    {
        $this->login();

        $this->assertAuthenticated();

        $response = $this->createRecord();

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );

        $this->patchJson('/api/tasks/' . $response["data"]["id"], [
            "name" => "updated - test project",
            "color" => "bg-purple-600",
            "priority_id" => 1,
            "category_id" => 1,
            "status_id" => 1,
            "start_date" => "2024-06-27",
            "end_date" => "2024-07-05",
            "description" => "test project description",
            "member_user_ids" => [
                1
            ]
        ]);

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );

        // delete the record
        $response = $this->deleteRecord($response["data"]["id"]);
        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );
    }
}
