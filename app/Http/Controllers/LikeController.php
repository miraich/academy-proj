<?php

namespace App\Http\Controllers;

use App\Actions\CreateLikeAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(Request $request, CreateLikeAction $action): RedirectResponse
    {
        $action->handle($request);

        return back();
    }
}
