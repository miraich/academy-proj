<?php

namespace App\Actions;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CreateCommentAction
{
    public function handle(CommentRequest $request)
    {
        $post = Post::find($request->post_id);
        if ($post->exists()) {
            Comment::create([
                'content' => $request->comment,
                'post_id' => $request->post_id,
                'post_author_id' => $post->user_id,
                'commentator_id' => auth()->user()->id,
            ]);
        }

    }
}
