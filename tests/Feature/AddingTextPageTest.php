<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Unit\DownloadFileServiceTest;

class AddingTextPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_text_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('show_adding_post_text'));
        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
        $response->assertViewIs('adding-post-views.adding-post-text');
    }

    public function test_adding_text_page_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $response = $this->post(route('create_post_text'), [
            'text_heading' => 'test_title',
            'description' => 'test_description',
            'tags' => '#tag1 #tag2',
        ]);

        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', [
            'title' => 'test_title',
        ]);

        $response->assertRedirect(route('show_post', 4));
    }

    public function test_adding_text_page_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $response = $this->post(route('create_post_text'), [
            'text_heading' => 'test_title',
            'description' => '',
            'tags' => '',
        ]);

        $this->assertDatabaseMissing('posts', [
            'title' => 'test_title',
        ]);
        $response->assertSessionHasErrors();

    }
}
