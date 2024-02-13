<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetProfileLikesAction
{
    public function handle(User $user, Collection $user_posts)
    {
        $total = [];
        foreach ($user_posts as $post) {
            $likes = $post->likes()->where('user_id', '!=', $user->id)->get();
            foreach ($likes as $like) {
                $total[] = $like;
            }
        }
        return $total;
    }
}
