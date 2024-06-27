<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_user_can_login_with_correct_credentials()
    {

        // Simulate a login post request
        $response = $this->postJson('/api/login', [
            'email' => 'admin@projectcode.ug',
            'password' => 'P@ssw0rd',
        ]);

        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'success')->etc()
        );

        // Assert the user is authenticated (optional)
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@projectcode.ug',
            'password' => 'wrongpassword',
        ]);

        // Assert the user is redirected back to the login page
        $response->assertStatus(200);

        $response->assertJson(
            fn (AssertableJson $json) => $json->where('status', 'error')->etc()
        );

        // Assert the user is not authenticated (optional)
        $this->assertGuest();
    }
}
