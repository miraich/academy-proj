<?php

namespace App\Actions;

use App\Models\Post;

class RepostAction
{
    public function handle(Post $post)
    {
        if ($post->exists()) {
            $new_post = $post->replicate()->fill([
                'user_id' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'isRepost' => 1,
            ]);
            $new_post->save();
        }
    }
}
