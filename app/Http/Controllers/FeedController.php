<?php

namespace App\Http\Controllers;

use App\Actions\SortingFeedAction;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    function index(Request $request, SortingFeedAction $action)
    {
        $posts = $action->handle($request);

        return view('feed', ['posts' => $posts]);
    }


}
