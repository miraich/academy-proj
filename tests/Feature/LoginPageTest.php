<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    /**
     * @throws \JsonException
     */
    public function test_login_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertSessionHasNoErrors();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('feed') . '?category=all');
    }

    public function test_login_with_invalid_credentials(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'invalidemail@example.com',
            'password' => '',
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
