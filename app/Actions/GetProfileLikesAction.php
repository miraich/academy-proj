<?php

namespace App\Actions;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetProfileLikesAction
{
    public function handle(User $user, array $postIds)
    {

        $likes = Like::whereIn('post_id', $postIds)->where('user_id', '!=', $user->id)->get();

        return $likes;
    }
}
