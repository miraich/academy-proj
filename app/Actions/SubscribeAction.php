<?php

namespace App\Actions;

use App\Mail\UserSubscribed;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SubscribeAction
{
    public function handle(int $id): bool
    {
        $user = User::find($id);

        if ($user->exists()) {
            $sub = Subscription::create([
                'author' => $user->id,
                'subscriber' => auth()->user()->id
            ]);
            Mail::to($user)->later(now()->addMinutes(5), new UserSubscribed($user, $sub));
            return true;
        }
        return false;
    }
}
