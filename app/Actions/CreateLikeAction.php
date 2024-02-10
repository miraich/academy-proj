<?php

namespace App\Actions;


use App\Models\Like;
use Illuminate\Http\Request;

class CreateLikeAction
{
    public function handle(Request $request)
    {
        $ref = auth()->user()->likes($request->post_id);
        if ($ref->exists()) {
            $ref->delete();
            return;
        }
        $like = Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id
        ]);
    }
}
