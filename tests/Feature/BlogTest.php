<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Blogs;

class BlogTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Test that a user can create a new blog post.
     */
    public function testUserCreateBlogPost()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $blogData = [
            'title' => 'Test Blog',
            'content' => 'This is a test blog post.',
        ];

        $response = $this->postJson('/api/blogs', $blogData, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Blog created successfully.',
            ]);
    }

    /**
     * Test that a user can view a specific blog post.
     */
    public function testUserViewBlogPost()
    {
        $user = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/blogs/' . $blog->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'user_id',
                'created_at',
                'updated_at',
            ]);
    }

    /**
     * Test that a user can edit their own blog post.
     */
    public function testUserEditOwnBlogPost()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $updatedTitle = 'Updated Blog Title';

        $response = $this->putJson('/api/blogs/' . $blog->id, [
            'title' => $updatedTitle,
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Blog updated successfully.',
                'data' => [
                    'title' => $updatedTitle,
                ],
            ]);
    }

    /**
     * Test that a user cannot edit or delete someone else's blog post.
     */
    public function testUserCannotEditOrDeleteOthersBlogPost()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $token2 = $user2->createToken('test')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user1->id]);

        $updatedTitle = 'Updated Blog Title';

        // Attempt to edit the blog post
        $response = $this->putJson('/api/blogs/' . $blog->id, [
            'title' => $updatedTitle,
        ], [
            'Authorization' => 'Bearer ' . $token2,
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'error' => 'You have no authority over this post',
            ]);

        // Attempt to delete the blog post
        $response = $this->deleteJson('/api/blogs/' . $blog->id, [], [
            'Authorization' => 'Bearer ' . $token2,
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'error' => 'You have no authority over this post',
            ]);
    }

    /**
     * Test that a user can delete their own blog post.
     */
    public function testUserDeleteOwnBlogPost()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/blogs/' . $blog->id, [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(204);
    }

    /**
     * Test that a user cannot delete someone else's blog post.
     */
    public function testUserCannotDeleteOthersBlogPost()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $token2 = $user2->createToken('test')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user1->id]);

        $response = $this->deleteJson('/api/blogs/' . $blog->id, [], [
            'Authorization' => 'Bearer ' . $token2,
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'error' => 'You have no authority over this post',
            ]);
    }

    // Add more test cases for other blog functionality...

}
