<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_see_post_page(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $post = Post::factory()
            ->has(Tag::factory()->count(5))->for($user1)
            ->create();

        $response = $this->actingAs($user2)->get(route('show_post', $post->id));
        $response->assertStatus(200);
        $response->assertViewIs('post');

        $view = $this->view('post', ['post' => Post::find($post->id)]);
        $view->assertViewHas('post');
    }

    public function test_can_comment(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $post = Post::factory()
            ->has(Tag::factory()->count(5))->for($user1)
            ->create();

        $response = $this->actingAs($user2)->post(route('create_comment', $post->id), [
            'post_id' => $post->id,
            'comment' => 'test',
            'post_author_id' => $post->user_id,
            'commentator_id' => $user2->id,
        ]);


        $view = $this->view('post', ['post' => Post::find($post->id)]);
        $view->assertViewHas('post');

        $this->assertDatabaseHas('comments', ['content' => 'test']);

    }
}
