<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ApiTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Test the registration API endpoint with valid user data.
     */
    public function testRegistrationWithValidData()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'test_' . Str::random(8) . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully.',
            ]);
    }

    /**
     * Test the registration API endpoint with invalid user data.
     */
    public function testRegistrationWithInvalidData()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /**
     * Test the login API endpoint with valid credentials.
     */
    public function testLoginWithValidCredentials()
    {
        $email = 'test_' . Str::random(8) . '@example.com';
        User::factory()->create([
            'email' => $email,
            'password' => bcrypt('password'),
            'roles_id' => Role::where('name', 'editor')->pluck('id')->first(),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /**
     * Test the login API endpoint with invalid credentials.
     */
    public function testLoginWithInvalidCredentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'mail@mail.com',
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid credentials.']);
    }

    /**
     * Test the create blog API endpoint with valid data.
     */
    public function testCreateBlogWithValidData()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->postJson('/api/blogs', [
            'title' => 'Test Blog',
            'content' => 'This is a test blog.',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Blog created successfully.',
            ]);
    }

    /**
     * Test the create blog API endpoint with invalid data.
     */
    public function testCreateBlogWithInvalidData()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->postJson('/api/blogs', [
            'title' => '',
            'content' => '',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'content']);
    }

    /**
     * Test the get blog API endpoint to retrieve a specific blog post.
     */
    public function testGetBlog()
    {
        $user = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/blogs/' . $blog->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $blog->content,
            ]);
    }

    /**
     * Test the update blog API endpoint to edit a user's own blog post.
     */
    public function testUpdateOwnBlog()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson('/api/blogs/' . $blog->id, [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Blog updated successfully.',
            ]);
    }

    /**
     * Test the update blog API endpoint to edit someone else's blog post.
     */
    public function testUpdateOthersBlog()
    {
        $user1 = User::factory()->create();
        $token1 = $user1->createToken('test')->plainTextToken;
        $user2 = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user2->id]);

        $response = $this->putJson('/api/blogs/' . $blog->id, [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ], [
            'Authorization' => 'Bearer ' . $token1,
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test the delete blog API endpoint to delete a user's own blog post.
     */
    public function testDeleteOwnBlog()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;
        $blog = Blogs::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/blogs/' . $blog->id, [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(204);
    }

    /**
     * Test the delete blog API endpoint to delete someone else's blog post.
     */
    public function testDeleteOthersBlog()
    {
        $user1 = User::factory()->create();
        $token1 = $user1->createToken('test')->plainTextToken;
        $user2 = User::factory()->create();
        $blog = Blogs::factory()->create(['user_id' => $user2->id]);

        $response = $this->deleteJson('/api/blogs/' . $blog->id, [], [
            'Authorization' => 'Bearer ' . $token1,
        ]);

        $response->assertStatus(403)->assertJson(["error" => "You have no authority over this post"]);
    }

    /**
     * Test that appropriate error responses are returned for validation failures and unauthorized access.
     */
    public function testErrorResponses()
    {
        $response = $this->postJson('/api/blogs');

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);

        $user = User::factory()->create([
            'email' => 'test_' . Str::random(8) . '@example.com',
            'password' => bcrypt('password'),
            'roles_id' => Role::where('name', 'editor')->pluck('id')->first(),
        ]);
        $token = $user->createToken('test')->plainTextToken;
        $response = $this->postJson('/api/blogs', [
            'title' => '',
            'content' => '',
        ], ['Authorization' => 'Bearer ' . $token]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'content']);
    }
}
