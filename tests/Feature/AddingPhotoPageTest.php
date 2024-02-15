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

class AddingPhotoPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_photo_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('show_adding_post_photo'));
        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
        $response->assertViewIs('adding-post-views.adding-post-photo');
    }

    public function test_adding_photo_page_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post(route('create_post_photo'), [
            'photo_heading' => 'test_title',
            'link' => 'https://aif-s3.aif.ru/images/019/507/eeba36a2a2d37754bab8b462f4262d97.jpg',
            'tags' => '#tag1 #tag2',
            'userpic-file-photo' => $file
        ]);

        Storage::disk('public')->assertExists('post_photo/' . $file->hashName());
        $this->assertDatabaseCount('posts', 1);
        $this->assertDatabaseHas('posts', [
            'title' => 'test_title',
        ]);

        $response->assertRedirect(route('show_post', 2));
    }

    public function test_adding_photo_page_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.pdf');

        $response = $this->post(route('create_post_photo'), [
            'photo_heading' => 'test_title',
            'link' => 'invalidLink',
            'tags' => '',
            'userpic-file-photo' => $file
        ]);

        Storage::disk('public')->assertMissing('post_photo/' . $file->hashName());
        $this->assertDatabaseMissing('posts', [
            'title' => 'test_title',
        ]);
        $response->assertSessionHasErrors();

    }
}
