<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createPostTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_PostCreation(): void
    {


        $response = $this->post('/api/posts/', [
            'title' => 'post Test',
            'content' => 'Content test',
            'user_id' => '1',
            'category_id' => '1',
            'image_path' => 'this will be an image',
            'is_archived' => '0',
        ]);

        // Check that the response has a 200 status code
        $response->assertStatus(200);

        // Check that the response contains the expected JSON data
        $response->assertJson([
            'status' => true,
            'message' => 'Post Created Successfully',
            // 'message' => 'User Created Successfully',
        ]);
    }
}
