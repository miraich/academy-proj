<?php

namespace App\Actions;

use App\Models\Subscription;

class UnsubscribeAction
{
    public function handle(int $id): bool
    {
        $subscription = Subscription::where(['author' => $id]);
        if ($subscription->exists()) {
            $subscription->delete();
            return true;
        }
        return false;
    }
}
