<?php

namespace App\Http\Controllers;

use App\Actions\GetProfileLikesAction;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_profile(User $user, GetProfileLikesAction $action)
    {
        $posts = $user->posts;
        $subscriptions = $user->subscriber;
        $likes = $action->handle($user, $posts);
        return view('profile', [
            'user' => $user,
            'posts' => $posts,
            'likes' => $likes,
            'subscriptions' => $subscriptions
        ]);
    }

    public function show_messages()
    {
        return view('messages');
    }


}
