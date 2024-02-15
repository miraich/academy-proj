<?php

namespace App\Actions;

use App\Enums\CategoryEnum;
use App\Models\Post;
use Illuminate\Http\Request;

class SortingFeedAction
{
    public function handle(Request $request)
    {
        $page_posts = [];
        $user = auth()->user();

        switch ($request->category) {
            case 'all':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->
                        with(['user', 'tags'])->get() as $post) {
                            $page_posts[] = $post;
                        }
                    }
                }
                break;

            case 'photo':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->with(['user', 'tags'])->get() as $post) {
                            if ($post->category == CategoryEnum::PHOTO->value) {
                                $page_posts[] = $post;
                            }
                        }
                    }
                }
                break;

            case 'video':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->with(['user', 'tags']) as $post) {
                            if ($post->category == CategoryEnum::VIDEO->value) {
                                $page_posts[] = $post;
                            }
                        }
                    }
                }
                break;

            case 'text':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->with(['user', 'tags']) as $post) {
                            if ($post->category == CategoryEnum::TEXT->value) {
                                $page_posts[] = $post;
                            }
                        }
                    }
                }
                break;

            case 'quote':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->with(['user', 'tags']) as $post) {
                            if ($post->category == CategoryEnum::QUOTE->value) {
                                $page_posts[] = $post;
                            }
                        }
                    }
                }
                break;

            case 'link':
                if ($user->subscriber()->exists()) {
                    foreach ($user->subscriber as $subscription) {
                        foreach ($subscription->user_author->posts()->with(['user', 'tags']) as $post) {
                            if ($post->category == CategoryEnum::PHOTO->value) {
                                $page_posts[] = $post;
                            }
                        }
                    }
                }
        }
        return $page_posts;

    }
}
