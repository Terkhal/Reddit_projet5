<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_userLogin(): void
    {

        $email = 'admin@admin.com';
        $response = $this->post('/api/auth/login', [

            'email' => $email,
            'password' => 'admin123',


        ]);

        // Check that the response has a 200 status code
        $response->assertStatus(200);

        // Check that the response contains the expected JSON data
        $response->assertJson([
            'status' => true,
            'message' => 'User Logged In Successfully',
            // 'message' => 'User Created Successfully',
        ]);

        // Check that the response contains the user data
        $response->assertJsonStructure([
            'token',
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

        ]);
    }
}
