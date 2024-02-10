<?php

namespace App\Http\Controllers;

use App\Actions\SubscribeAction;
use App\Actions\UnsubscribeAction;

class SubscribeController extends Controller
{
    public function subscribe($id, SubscribeAction $action)
    {
        if ($action->handle($id)) {
            return back();
        } else {
            back()->withErrors(['error' => 'Пользователь не существует']);
        }
    }

    public function unsubscribe($id, UnsubscribeAction $action)
    {
        if ($action->handle($id)) {
            return back();
        } else {
            return back()->withErrors(['error' => 'Такой подписки не существует']);
        }
    }
}
