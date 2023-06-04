<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Test that a user can successfully register an account.
     */
    public function testUserRegistration()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully.',
            ]);
    }

    /**
     * Test that a user can log in with valid credentials.
     */
    public function testUserLoginWithValidCredentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token'
            ]);
    }

    /**
     * Test that a user cannot log in with invalid credentials.
     */
    public function testUserLoginWithInvalidCredentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials.',
            ]);
    }

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

    // Add more test cases for other user functionality...

}
