<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PopularPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_popular_page(): void
    {

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $posts = Post::factory(10)
            ->has(Tag::factory()->count(5))->for($user1)
            ->create();


        $response = $this->actingAs($user2)->get(route('popular') . '?category=all');
        $response->assertStatus(200);
        $response->assertViewIs('popular');

        $view = $this->view('popular', ['posts' => Post::where('user_id', '!=', $user1->id)->simplePaginate(6)]);

        $view->assertViewHas('posts');

    }
}
