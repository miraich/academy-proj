<?php

namespace App\Actions;

use App\Mail\NotifySubscribed;
use App\Mail\UserSubscribed;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifySubscribedAction
{
    public function handle(Post $post): void
    {
        $subscriptions = Subscription::where('author', $post->user_id)->get();
        foreach ($subscriptions as $subscription) {
            $user = User::find($subscription->subscriber);
            if ($user->exists()) {
                Mail::to($user)->later(now()->addMinutes(5), new NotifySubscribed($user, $post));
            }
        }
    }
}

