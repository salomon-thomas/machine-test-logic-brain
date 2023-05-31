<?php

namespace Tests\Feature;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_can_view_all_blogs()
    {
        $response = $this->get('/blogs');

        $response->assertStatus(200);
        $response->assertViewIs('blogs.index');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_blog()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/blogs', [
            'title' => 'Test Blog',
            'content' => 'This is a test blog post.',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/blogs');
        $this->assertDatabaseHas('blogs', [
            'title' => 'Test Blog',
            'content' => 'This is a test blog post.',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_edit_their_own_blog()
    {
        $user = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/blogs/{$blog->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/blogs/{$blog->id}");
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);
    }

    /** @test */
    public function an_authenticated_user_cannot_edit_other_users_blogs()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->put("/blogs/{$blog->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('blogs', [
            'id' => $blog->id,
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_delete_their_own_blog()
    {
        $user = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/blogs/{$blog->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/blogs');
        $this->assertDeleted($blog);
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_other_users_blogs()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->delete("/blogs/{$blog->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
        ]);
    }
}
