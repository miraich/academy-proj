<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Unit\DownloadFileServiceTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddingLinkPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_link_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('show_adding_post_link'));
        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
        $response->assertViewIs('adding-post-views.adding-post-link');
    }

    public function test_adding_link_page_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        Storage::fake('public');

        $response = $this->post(route('create_post_link'), [
            'link_heading' => 'test_title',
            'post_link' => 'https://habr.com/ru/feed/',
            'tags' => '#tag1 #tag2',
        ]);

        Storage::disk('public')->assertExists('previews/' .
            hash('md5', 'https://habr.com/ru/feed/') . '.jpeg');
        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', [
            'title' => 'test_title',
        ]);

        $response->assertRedirect(route('show_post', 1));
    }

    public function test_adding_link_page_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        Storage::fake('public');

        $response = $this->post(route('create_post_link'), [
            'link_heading' => 'test_title',
            'post_link' => 'invalidLink',
            'tags' => '',
        ]);

        Storage::disk('public')->assertMissing('previews/' . md5(now() . 'jpeg'));
        $this->assertDatabaseMissing('posts', [
            'title' => 'test_title',
        ]);
        $response->assertSessionHasErrors();

    }
}
