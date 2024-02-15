<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_register_page(): void
    {
        $response = $this->get(route('show_registration'));
        $response->assertStatus(200);
        $response->assertViewIs('register');
    }

    public function test_register_page_with_valid_credentials(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post(route('register'), [
            'login' => 'Andrey',
            'email' => 'test@gmail.com',
            'password' => 12345,
            'password_confirmation' => 12345,
            'userpic_file' => $file
        ]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => 'test@gmail.com',
        ]);
        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_register_page_with_invalid_credentials(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.pdf');

        $response = $this->post(route('register'), [
            'login' => '',
            'email' => 'tesdаddadaddaaasdt@gmail.com',
            'password' => '',
            'password_confirmation' => 12345,
            'userpic_file' => $file
        ]);

        Storage::disk('public')->assertMissing('avatars/' . $file->hashName());
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
