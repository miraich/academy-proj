<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_profile_page_user_posts(): void
    {
        $user2 = User::factory()->create();

        $posts = Post::factory(5)
            ->has(Tag::factory()->count(5))->for($user2)
            ->create();

        $response = $this->actingAs($user2)->get(route('profile', $user2->id) . '?show=posts');
        $response->assertStatus(200);
        $response->assertViewIs('profile');

        $view = $this->view('profile', [
            'posts' => Post::where('user_id', '==', $user2->id),
            'user' => $user2
        ]);
        $view->assertViewHas('posts');
        $view->assertViewHas('user');
    }

//    public function test_profile_page_user_likes(): void
//    {
//        $user1 = User::factory()->create();
//        $user2 = User::factory()->create();
//
//        $post = Post::factory(1)
//            ->has(Tag::factory()->count(5))->for($user2)
//            ->create();
//
//        $like = Like::factory()->for($user1)->for($post)->create();
//
//        $response = $this->actingAs($user2)->get(route('profile', $user2->id) . '?show=likes');
//        $response->assertStatus(200);
//        $response->assertViewIs('profile');
//
//        $posts = $user2->posts()->with('tags')->get();
//        $postIds = $posts->pluck('id')->all();
//        $likes = Like::whereIn('post_id', $postIds)->where('user_id', '!=', $user2->id)->get();
//
//        $view = $this->view('profile', [
//            'likes' => $likes,
//            'user' => $user2
//        ]);
//        $view->assertViewHas('user');
//        $view->assertViewHas('likes');
//    }
}
