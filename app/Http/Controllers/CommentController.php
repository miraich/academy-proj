<?php

namespace App\Http\Controllers;

use App\Actions\CreateCommentAction;
use App\Http\Requests\CommentRequest;


class CommentController extends Controller
{
    public function create(CommentRequest $request, CreateCommentAction $action)
    {
        $action->handle($request);

        return back();
    }
}
