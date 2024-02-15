<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedPageTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
//    public function test_feed_page(): void
//    {
//
//        $user2 = User::factory()->create();
//        $user1 = User::factory()->create();
//
//        $response = $this->actingAs($user2)->get(route('popular') . '?category=all');
//        $response->assertStatus(200);
//        $response->assertViewIs('popular');
//
//        $posts = Post::factory(10)
//            ->has(Tag::factory()->count(5))
//            ->create();
//
//        $view = $this->view('popular', ['posts' => );
//        $view->assertViewHas('posts');
//
//    }
}
