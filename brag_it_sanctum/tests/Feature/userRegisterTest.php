<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userRegisterTest extends TestCase
{
    public $userId = -1;

    public function test_userRegistration(): string
    {

        $email = 'test_' . time() . '@example.com';
        $response = $this->post('/api/auth/register', [
            'username' => 'testuser',
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => $email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'is_admin' => false,
            'date_of_birth' => '1990-01-01',
            'avatar_path' => 'path/to/avatar.png',
        ]);

        // Check that the response has a 200 status code
        $response->assertStatus(200);

        // Check that the response contains the expected JSON data
        $response->assertJson([
            'status' => true,
            'message' => 'User Created Successfully',
            // 'message' => 'User Created Successfully',
        ]);

        // Check that the response contains the user data
        $response->assertJsonStructure([
            'user' => [
                'id',
                'username',
                'firstname',
                'lastname',
                'email',
                'is_admin',
                'date_of_birth',
                'avatar_path',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);

        $this->userId = $response["user"]["id"];
        // Check that the user was actually created in the database
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
        return $response["user"]["id"];
    }

    /**
     * @depends test_userRegistration
     */
    public function test_deleteUser($id): void
    {

        $response = $this->delete('/api/users/' . $id, []);

        // Check that the response has a 200 status code
        $response->assertStatus(200);

        // Check that the response contains the expected JSON data
        $response->assertJson([
            'status' => true,
            'message' => 'User deleted Successfully',
            // 'message' => 'User Created Successfully',
        ]);
    }
}
