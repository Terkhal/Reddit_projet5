<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Posts;


class deletePostTest extends TestCase
{



    /** 
     * A basic feature test example.
     */
    public function test_deletePost(): void
    {
        $posts = Posts::all();
        $lastPost = $posts->last();
        $response = $this->delete('/api/posts/' . $lastPost->id, []);

        // Check that the response has a 200 status code
        $response->assertStatus(200);

        // Check that the response contains the expected JSON data
        $response->assertJson([
            'status' => true,
            'message' => 'Post deleted Successfully',
            // 'message' => 'User Created Successfully',
        ]);
    }
}
